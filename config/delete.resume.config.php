<?php // Loubna Faress
  // Start a session for displaying error messages.
  require_once 'peripherals/session_management.config.php';

  // Use the (improved) database connection.
  require_once 'idb.config.php';

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
          $pdo = $this->database->connect();

          // Erase resume related profile data if there is any
          if ($this->tableHasData('profile', $resID, $userID)) {
            // Retrieve the fileName from the profile record
            $stmt = $pdo->prepare('SELECT `fileName` FROM `profile` WHERE resumeID = :resID AND userID = :userID');
            $stmt->bindParam(":resID", $resID['resumeID']);
            $stmt->bindParam(":userID", $userID);
            $stmt->execute();
            $existingImage = $stmt->fetch();

            // Check if the fileName column has actual data
            if ($existingImage && !empty($existingImage['fileName'])) {
              // Remove the associated image file
              $imageFilePath = '../img/avatars/' . $existingImage['fileName'];
              if (file_exists($imageFilePath)) {
                  unlink($imageFilePath);
              }
              $existingImage = null;
            }

            $stmtPro = $pdo->prepare('DELETE FROM `profile` WHERE resumeID = :resID AND userID = :userID');
            $stmtPro->bindParam(":resID", $resID['resumeID']);
            $stmtPro->bindParam(":userID", $userID);
            $stmtPro->execute();
            $stmtPro = null;
          }

          // Erase resume related experience data if there is any
          if ($this->tableHasData('experience', $resID, $userID)) {
            $stmtExp = $pdo->prepare('DELETE FROM `experience` WHERE resumeID = :resID AND userID = :userID');
            $stmtExp->bindParam(":resID", $resID['resumeID']);
            $stmtExp->bindParam(":userID", $userID);
            $stmtExp->execute();
            $stmtExp = null;
          }

          // Erase resume related education data if there is any
          if ($this->tableHasData('education', $resID, $userID)) {
            $stmtEdu = $pdo->prepare('DELETE FROM `education` WHERE resumeID = :resID AND userID = :userID');
            $stmtEdu->bindParam(":resID", $resID['resumeID']);
            $stmtEdu->bindParam(":userID", $userID);
            $stmtEdu->execute();
            $stmtEdu = null;
          }
          
          // Erase resume related techskill data if there is any
          if ($this->tableHasData('techskill', $resID, $userID)) {
            $stmtTech = $pdo->prepare('DELETE FROM `techskill` WHERE resumeID = :resID AND userID = :userID');
            $stmtTech->bindParam(":resID", $resID['resumeID']);
            $stmtTech->bindParam(":userID", $userID);
            $stmtTech->execute();
            $stmtTech = null;
          }

          // Erase resume related language data if there is any
          // if ($this->tableHasData('languages', $resID, $userID)) {
          //   $stmtLang = $pdo->prepare('DELETE FROM `languages` WHERE resumeID = :resID AND userID = :userID');
          //   $stmtLang->bindParam(":resID", $resID['resumeID']);
          //   $stmtLang->bindParam(":userID", $userID);
          //   $stmtLang->execute();
          //   $stmtLang = null;
          // }

          // Erase resume related interest data if there is any
          // if ($this->tableHasData('interests', $resID, $userID)) {
          //   $stmtInt = $pdo->prepare('DELETE FROM `interests` WHERE resumeID = :resID AND userID = :userID');
          //   $stmtInt->bindParam(":resID", $resID['resumeID']);
          //   $stmtInt->bindParam(":userID", $userID);
          //   $stmtInt->execute();
          //   $stmtInt = null;
          // } 

          // Erase data from resume
          $stmtRes = $pdo->prepare('DELETE FROM `resume` WHERE resumeID = :resID AND userID = :userID');
          $stmtRes->bindParam(":resID", $resID['resumeID']);
          $stmtRes->bindParam(":userID", $userID);
          $stmtRes->execute();
          $stmtRes = null;          

          // Erase variables and session data
          $resID = null;
          $this->resumetitle = null;
          unset($_SESSION['resumeID']);
          unset($_SESSION['resumetitle']);

          // Start cleanup and Reset auto increment for all tables
          $stmt = $pdo->prepare("SHOW TABLES");
          $stmt->execute();
          $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

          foreach ($tables as $tableID) {
            // Get the list of columns for the table
            $stmt = $pdo->prepare("DESCRIBE `$tableID`");
            $stmt->execute();
            $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Get the first column name
            $firstColumn = $columns[0];

            // Get the maximum ID value for the table
            $stmt = $pdo->prepare("SELECT MAX(`$firstColumn`) FROM `$tableID`");
            $stmt->execute();
            $maxID = $stmt->fetchColumn();
        
            // Reset auto-increment to the next available ID
            $stmt = $pdo->prepare("ALTER TABLE `$tableID` AUTO_INCREMENT = :maxID");
            $stmt->bindValue(':maxID', $maxID + 1, PDO::PARAM_INT);
            $stmt->execute();
          }
          
          // Success message by session instead of URL parsing
          $_SESSION['success'] = 'Resume deleted successfully';
          header('Location: ../client.php');
          exit();
        }
      } 
    }

    private function tableHasData($tableName, $resID, $userID) {
      $stmt = $this->database->connect()->prepare("SELECT COUNT(*) FROM `$tableName` WHERE resumeID = :resID AND userID = :userID");
      $stmt->bindParam(":resID", $resID['resumeID']);
      $stmt->bindParam(":userID", $userID);
      $stmt->execute();
      $count = $stmt->fetchColumn();
      return $count > 0;
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