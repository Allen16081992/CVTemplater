<?php // Loubna Faress

  // Start the session to enable session data use and error messages.
  session_start();

  // Use the (improved) database connection.
  include 'idb.config.php';

  class deleteResume {
    private $pdo;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->connect();
    }

    public function deleteResume($resumetitle, $userID) {
      // Verify if the userID exists
      if (isset($resumetitle, $userID)) {

        // Select the record that is to be deleted
        $stmt = $this->pdo->prepare('SELECT resumeID FROM `resume` WHERE resumetitle = ? AND userID = ?');
        $stmt->execute([$resumetitle, $userID]);
        $delete = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$delete) {
            $delete = null;
            // Error message by sessions instead of URL parsing.
            $_SESSION['error'] = 'User not found';
            header('location: ../account.php');
            exit();
        }

        // Make sure the user has confirmed before deletion
        if (isset($_POST['delete'])) {

          // Erase data from resume
          $stmt = $this->pdo->prepare('DELETE FROM `resume` WHERE resumeID = ? AND userID = ?');
          $stmt->execute([$delete['resumeID'], $userID]);
          $stmt = null;

          // Reset auto increment in resume from the current highest resumeID
          $stmt = $this->pdo->prepare('SELECT MAX(`resumeID`) FROM `resume`');
          $stmt->execute();
          $edit = $stmt->fetch(PDO::FETCH_ASSOC);
          $stmt = $this->pdo->prepare("ALTER TABLE `resume` AUTO_INCREMENT = :edit");
          $stmt->bindValue(':edit', $edit['resumeID']);
          $stmt->execute();

          // Success message by session instead of URL parsing
          $_SESSION['success'] = 'User deleted successfully';
          header('Location: ../index.php');
          exit();
        }
      } 
    }

    public function __destruct() {
      $this->pdo = null;
    }
  }

  if (isset($_POST['selectCv']) && isset($_SESSION['user_id'])) {
    $resumetitle = $_POST['selectCv'];
    $userID = $_SESSION['user_id'];
    
    // Create an instance of deleteResume and delete the resume
    $deleteResume = new deleteResume();
    $deleteResume->deleteResume($resumetitle, $userID);
  }    
?>
