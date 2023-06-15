<?php // Loubna Faress
  // Start a session for displaying error messages.
  require 'peripherals/session_start.config.php';

  // Use the (improved) database connection.
  require 'idb.config.php';

  class deleteResume {
    private $resumetitle;
    private $database;

    public function __construct($resumetitle) {
        $this->resumetitle = $resumetitle;
        $this->database = new Database();
    }

    public function deleteResume() {
      // Verify if the userID exists
      if (isset($_SESSION['user_id'])) {
        $userID = $_SESSION['user_id'];

        // Select the record that is to be deleted
        $stmt = $this->database->connect()->prepare('SELECT resumeID FROM `resume` WHERE resumetitle = :resumetitle AND userID = :userID');
        $stmt->bindParam(":resumetitle", $this->resumetitle);
        $stmt->bindParam(":userID", $userID);
        $stmt->execute();
        $resID = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$resID) {
            $resID = null;
            // Error message by sessions instead of URL parsing.
            $_SESSION['error'] = 'Resume not found';
            header('location: ../client.php');
            exit();
        }

        // Make sure the user has confirmed before deletion
        if (isset($resID)) {

          // Erase data from resume
          $stmt = $this->database->connect()->prepare('DELETE FROM `resume` WHERE resumeID = :resID AND userID = :userID');
          $stmt->bindParam(":resID", $resID['resumeID']);
          $stmt->bindParam(":userID", $userID);
          $stmt->execute();          

          // get rid of variables
          $resID = null;
          $this->resumetitle = null;

          // Purge the data from the session
          unset($_SESSION['resumeID']);
          unset($_SESSION['resumetitle']);
          
          // Success message by session instead of URL parsing
          $_SESSION['success'] = 'Resume deleted successfully';
          header('Location: ../client.php');
          exit();
        }
      } 
    }

    public function __destruct() {
      $this->database = null;
    }
  }

  if (isset($_POST['delResume'])) { 
    $resumetitle = $_POST['selectCv'];  
    // Create an instance of deleteResume and delete the resume
    $deleteResume = new deleteResume($resumetitle);
    $deleteResume->deleteResume();
  }