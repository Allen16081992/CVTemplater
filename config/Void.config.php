<?php // Dhr. Allen Pieter

    // Use the (improved) database connection.
    include 'idb.config.php';

    // These variables are free to use by anything.
    $_POST['pwd']; 

    class Crusified {
        private $pdo;
        
        public function __construct() {
            $database = new Database();
            $this->pdo = $database->connect();
        }
        
        public function deleteUser() {
            // Check that the user ID exists
            if (isset($_POST['user_id'])) {
                // Select the record that is to be 'crucified'
                $stmt = $this->pdo->prepare('SELECT * FROM accounts WHERE userID = ?');
                $stmt->execute([$_POST['user_id']]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if (!$user) {
                    $user = null;
                    header('location: ../account.php?error=usernotfound');
                    exit();
                }
                
                // Make sure the user has confirmed before deletion
                if (isset($_POST['delete'])) {
                    $stmt = $this->pdo->prepare('DELETE FROM accounts WHERE userID = ?');
                    $stmt->execute([$_POST['user_id']]);
                    $stmt = null;

                    // When removal is completed, Wipe everything related to the session.
                    session_start();
                    session_unset();
                    session_destroy();
                    header('Location: ../index.html?report=deletedDone');
                    exit;
                }
            }
        }

        public function verifyUser() {
            // Activate the private function beneath.
            if($this->emptyInput() == false ) {
                // Empty input, no values given for account.
                header('location: ../account.php?error=emptyinput');          
                exit();
            }
            $this->verifyPassword();
        }

        private function emptyInput() {
            // Make sure the submitted value is not empty.
            if (empty($_POST['pwd'])) {
                $report = false; // The password field cannot be empty.
            } else { $report = true; } return $report;
        }

        private function verifyPassword() {
            // Select the record to be compared.
            $stmt = $this->pdo->prepare('SELECT * FROM accounts WHERE userID = ?');
            $passHash = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!password_verify($_POST['pwd'], $passHash[0]['password'])) {
                $passHash = false; 
            } else { $passHash = true; }

            if($passHash = false) {
                // Passwords don't match!
                header('location: ../account.php?error=hashmismatch');          
                exit();
            }
            elseif($passHash = true) {
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