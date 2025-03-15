<?php // Dhr. Allen Pieter
    // Start a session to destroy, and for displaying error messages.
    require_once 'peripherals/session_management.config.php';

    // Use the (improved) database connection.
    require_once 'idb.config.php';

    class CrusifiedUser {
        private $pdo;

        public function __construct() {
            $database = new Database();
            $this->pdo = $database->connect();
        }

        public function deleteUser() {
            // Verify if the userID exists
            if (isset($_POST['user_id'])) {

                // Make sure the user has confirmed before deletion
                if (isset($_POST['delete'])) {
                    $this->deleteProfileData();
                    $this->deleteDataIfExists('contact', 'userID');
                    $this->deleteDataIfExists('experience', 'userID');
                    $this->deleteDataIfExists('education', 'userID');
                    $this->deleteDataIfExists('technical', 'userID');
                    //$this->deleteDataIfExists('languages', 'userID');
                    //$this->deleteDataIfExists('interests', 'userID');
                    $this->deleteDataIfExists('motivation', 'userID');
                    $this->deleteDataIfExists('resume', 'userID');

                    // Erase data from Accounts
                    $stmt = $this->pdo->prepare('DELETE FROM accounts WHERE userID = ?');
                    $stmt->execute([$_POST['user_id']]);

                    // Reset auto increment for all tables
                    $stmt = $this->pdo->prepare("SHOW TABLES");
                    $stmt->execute();
                    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

                    foreach ($tables as $tableID) {
                        // Get the list of columns for the table
                        $stmt = $this->pdo->prepare("DESCRIBE `$tableID`");
                        $stmt->execute();
                        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);

                        // Get the first column name
                        $firstColumn = $columns[0];

                        // Get the maximum ID value for the table
                        $stmt = $this->pdo->prepare("SELECT MAX(`$firstColumn`) FROM `$tableID`");
                        $stmt->execute();
                        $maxID = $stmt->fetchColumn();
                    
                        // Reset auto-increment to the next available ID
                        $stmt = $this->pdo->prepare("ALTER TABLE `$tableID` AUTO_INCREMENT = :maxID");
                        $stmt->bindValue(':maxID', $maxID + 1, PDO::PARAM_INT);
                        $stmt->execute();
                    }                    

                    // When removal is completed, erase the session and make a new one.
                    session_unset();
                    session_destroy();
                    session_start();

                    // Error Messages by session instead of URL parsing.
                    $_SESSION['success'] = 'User deleted successfully';
                    header('Location: ../index.php?');
                    exit();
                }
            } else {
                // User ID is missing, browser crashed or user is not logged in
                $_SESSION['error'] = '401: Access denied. You must be signed in.';
                header('Location: ../index.php');
                exit();
            }
        }

        public function verifyUser() {
            // Activate the private function beneath.
            if (!$this->emptyInput()) {
                // Empty input, no values given for account.
                $_SESSION['error'] = 'No password provided.';
                header('location: ../account.php');
                exit();
            }
            $this->verifyPassword();
        }

        private function emptyInput() {
            // Check if the submitted values are not empty.
            return !(empty($_POST['pwd']));
        }

        private function verifyPassword() {
            // Select the record to be compared.
            $stmt = $this->pdo->prepare('SELECT password, salt FROM accounts WHERE userID = ?');

            // Bind the input parameter to use parameterized queries.
            $stmt->bindValue(1, $_POST['user_id'], PDO::PARAM_INT);
            $stmt->execute();
            $passHash = $stmt->fetch(PDO::FETCH_ASSOC);
            $salt = $passHash['salt'];

            if (!password_verify($_POST['pwd'].$salt, $passHash['password'])) {
                // Passwords do not match.
                $_SESSION['error'] = 'Invalid password.';
                header('location: ../account.php');
                exit();
            }

            // Password matches, invoke Crusification Operations.
            $this->deleteUser();     
            // Clear sensitive data from memory
            unset($passHash);
        }

        private function deleteDataIfExists($table, $column) {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM `$table` WHERE $column = ?");
            $stmt->execute([$_POST['user_id']]);
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                $stmt = $this->pdo->prepare("DELETE FROM `$table` WHERE $column = ?");
                $stmt->execute([$_POST['user_id']]);
            }
        }

        private function deleteProfileData() {
            $table = 'profile';
            $column = 'userID';
        
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM `$table` WHERE $column = ?");
            $stmt->execute([$_POST['user_id']]);
            $count = $stmt->fetchColumn();
        
            if ($count > 0) {
                // Retrieve the existing profile record
                $stmt = $this->pdo->prepare("SELECT `fileName` FROM `$table` WHERE $column = ?");
                $stmt->execute([$_POST['user_id']]);
                $existingImage = $stmt->fetch();
        
                // Remove the associated image file
                if (file_exists('../img/avatars/' . $existingImage['fileName'])) {
                    unlink('../img/avatars/' . $existingImage['fileName']);
                }
        
                $stmt = $this->pdo->prepare("DELETE FROM `$table` WHERE $column = ?");
                $stmt->execute([$_POST['user_id']]);
                $stmt = null;
            }
        }
    }

    // Create an object from our class
    $crusifyUser = new CrusifiedUser();
    // Error handlers
    $crusifyUser->verifyUser($_POST['pwd']);