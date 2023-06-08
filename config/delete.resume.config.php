<?php // Loubna Faress

  // Dhr. A Pieter: we moeten een specifieke resume pakken, niet alles via *.
  //SELECT resumeID FROM `resume` WHERE resumetitle = ? AND userID = ?'

  // Dhr. A Pieter: Login naar client.php, Druk op de knop 'Delete Resume'. Wordt er een wachtwoord gevraagd?
  //if (isset($_POST['selectCv']) && isset($_SESSION['user_id'])) {
  //  $resumetitle = $_POST['selectCv'];
  //  $userID = $_SESSION['user_id'];
    
    // Create an instance of FetchResumeID and fetch the resume ID
  //  $deleteResume = new deleteResume();
  //  $deleteResume->deleteResume($resumetitle, $userID);
  //}

  // use the (improved) database connection.
  include 'idb.config.php';

  // Start a session to destroy, and for displaying error messages.
  include 'peripherals/session_start.config.php';

  // These variables are free to use by anything.
  $_POST['pwd']; 

  class deleteResume {
      private $pdo;

      public function __construct() {
          $database = new Database();
          $this->pdo = $database->connect();
      }

      public function deleteResume() {
        // Verify if the userID exists
        if (isset($_POST['user_id'])) {

          // Select the record that is to be 'deleteResume'
          $stmt = $this->pdo->prepare('SELECT resumeID FROM `resume` WHERE resumetitle = ? AND userID = ?');
          $stmt->execute([$_POST['user_id']]);
          $user = $stmt->fetch(PDO::FETCH_ASSOC);

          if (!$user) {
              $user = null;
              // Success message by sessions instead of url parsing.
              $_SESSION['error'] = 'User not found';
              header('location: ../account.php?');
              exit();
          }
          // Make sure the user has confirmed before deletion
          if (isset($_POST['delete'])) {

              // Erase data from resume
              $stmt = $this->pdo->prepare('DELETE FROM `resume` WHERE userID = ?');
              $stmt->execute([$_POST['user_id']]);
              $stmt = null;

              // Queries voor de andere tabellen zijn niet meer nodig dankzij het volgende.
                    // Buiten accounts, heeft nu elk tabel de foreign key: ON DELETE & UPDATE (van userID) CASCADE.

              // Reset auto increment in resume from the current highest userID.
              $stmt = $this->pdo->prepare('SELECT MAX(`userID`) FROM `resume`;');
              $edit = $stmt->fetch(PDO::FETCH_ASSOC);
              $stmt = $this->pdo->prepare("ALTER TABLE `resume` AUTO_INCREMENT = '$edit';");
              $stmt = null; $edit = null;
              
              // When removal is completed, erase the session and make a new one.
              session_unset();
              session_destroy();

              // Error Messages by session instead of url parsing.
              session_start();
              $_SESSION['success'] = 'User deleted successfully';
              header('Location: ../index.php?');
              exit();
          }
        } 
      }
    }
      if (isset($_POST['selectCv']) && isset($_SESSION['user_id'])) {
          $resumetitle = $_POST['selectCv'];
          $userID = $_SESSION['user_id'];
          
            Create an instance of FetchResumeID and fetch the resume ID
          $deleteResume = new deleteResume();
          $deleteResume->deleteResume($resumetitle, $userID);
          $this->deleteUser();
        }    
?>