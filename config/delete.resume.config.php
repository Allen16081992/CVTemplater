<?php // Loubna Faress

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
          $stmt = $this->pdo->prepare('SELECT *  FROM accounts WHERE userID = ?');
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

              // Erase data from Accounts
              $stmt = $this->pdo->prepare('DELETE FROM accounts WHERE userID = ?');
              $stmt->execute([$_POST['user_id']]);
              $stmt = null;

              // Queries voor de andere tabellen zijn niet meer nodig dankzij het volgende.
                    // Buiten accounts, heeft nu elk tabel de foreign key: ON DELETE & UPDATE (van userID) CASCADE.

              // Reset auto increment in Accounts from the current highest userID.
              $stmt = $this->pdo->prepare('SELECT MAX(`userID`) FROM `accounts`;');
              $edit = $stmt->fetch(PDO::FETCH_ASSOC);
              $stmt = $this->pdo->prepare("ALTER TABLE `accounts` AUTO_INCREMENT = '$edit';");
              $stmt = null; $edit = null;
              
              // Reset auto increment in Contact from the current highest contactID.
              $stmt = $this->pdo->prepare('SELECT MAX( `contactID` ) FROM `contact`;');
              $edit = $stmt->fetch(PDO::FETCH_ASSOC);
              $stmt = $this->pdo->prepare("ALTER TABLE `contact` AUTO_INCREMENT = '$edit';");
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

      public function 
  }
?>