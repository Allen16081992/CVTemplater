<?php // Dhr. Allen Pieter

    // Use the (improved) database connection.
    include 'idb.config.php';

    // Start a session to destroy, and for displaying error messages.
    session_start();

    // These variables are free to use by anything.
    $_POST['pwd']; 

    class Crusified {
        private $pdo;
        
        public function __construct() {
            $database = new Database();
            $this->pdo = $database->connect();
        }
        
        public function deleteUser() {
            // Verify if the user ID exists
            if (isset($_POST['user_id'])) {

                // Select the record that is to be 'crucified'
                $stmt = $this->pdo->prepare('SELECT * FROM accounts WHERE userID = ?');
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
                    $stmt = $this->pdo->prepare('SELECT MAX( `userID` ) FROM `accounts`;');
                    $edit = $stmt->fetch(PDO::FETCH_ASSOC);
                    $stmt = $this->pdo->prepare("ALTER TABLE `table` AUTO_INCREMENT = '$edit';");
                    $stmt = null; $edit = null;

                    // Reset auto increment in Contact from the current highest contactID.
                    $stmt = $this->pdo->prepare('SELECT MAX( `contactID` ) FROM `contact`;');
                    $edit = $stmt->fetch(PDO::FETCH_ASSOC);
                    $stmt = $this->pdo->prepare("ALTER TABLE `contact` AUTO_INCREMENT = '$edit';");
                    $stmt = null; $edit = null;

                    // When removal is completed, Wipe everything related to the session.
                    session_unset();
                    session_destroy();

                    // This session is only for displaying messages.
                    session_start();
                    // Error Messages by session instead of url parsing.
                    $_SESSION['success'] = 'User deleted successfully';
                    header('Location: ../index.php?');
                    exit();
                }
            }
        }

        public function verifyUser() {
            // Activate the private function beneath.
            if($this->emptyInput()) {
                // Empty input, no values given for account.
                $_SESSION['error'] = 'Empty input';
                header('location: ../account.php');          
                exit();
            }
            $this->verifyPassword();
        }

        private function emptyInput() {
            // Make sure the submitted value is not empty.
            if (empty($_POST['pwd'])) {
                return true; // The password field is empty.
            } else { 
                return false; 
            } 
        }

        private function verifyPassword() {
            // Select the record to be compared.
            $stmt = $this->pdo->prepare('SELECT password FROM accounts WHERE userID = ?');

            // Bind the input parameter to use parameterized queries.
            $stmt->bindValue(1, $_POST['user_id'], PDO::PARAM_INT);
            $stmt->execute();
            $passHash = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if (!password_verify($_POST['pwd'], $passHash['password'])) {
                // Passwords don't match!
                $_SESSION['error'] = "Passwords don't match!";
                header('Location: ../account.php?');
                exit();
            } else {
                // Password matches, delete the user.
                $this->deleteUser();
            }
        }     
    }

    // Create an object from our class
    $void = new Crusified();
    // Error handlers
    $void->verifyUser($_POST['pwd']);
?>