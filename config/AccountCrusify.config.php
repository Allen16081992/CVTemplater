<?php // Dhr. Allen Pieter
    // Start a session to destroy, and for displaying error messages.
    require 'peripherals/session_start.config.php';

    // Use the (improved) database connection.
    require 'idb.config.php';

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
                    $this->deleteDataIfExists('contact', 'userID');
                    $this->deleteDataIfExists('profile', 'userID');
                    $this->deleteDataIfExists('experience', 'userID');
                    $this->deleteDataIfExists('education', 'userID');
                    $this->deleteDataIfExists('technical', 'userID');
                    $this->deleteDataIfExists('languages', 'userID');
                    $this->deleteDataIfExists('interests', 'userID');
                    $this->deleteDataIfExists('resume', 'userID');

                    // Erase data from Accounts
                    $stmt = $this->pdo->prepare('DELETE FROM accounts WHERE userID = ?');
                    $stmt->execute([$_POST['user_id']]);

                    // Reset auto increment for all tables
                    $stmt = $this->pdo->prepare("SHOW TABLES");
                    $stmt->execute();
                    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

                    foreach ($tables as $table) {
                        // Get the maximum ID value for the table
                        $stmt = $this->pdo->prepare("SELECT MAX(`id`) FROM `$table`");
                        $stmt->execute();
                        $maxID = $stmt->fetchColumn();

                        // Reset auto-increment to the next available ID
                        $stmt = $this->pdo->prepare("ALTER TABLE `$table` AUTO_INCREMENT = :maxID");
                        $stmt->bindValue(':maxID', $maxID + 1, PDO::PARAM_INT);
                        $stmt->execute();
                    }

                    // When removal is completed, erase the session and make a new one.
                    session_unset();
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
            $stmt = $this->pdo->prepare('SELECT password FROM accounts WHERE userID = ?');

            // Bind the input parameter to use parameterized queries.
            $stmt->bindValue(1, $_POST['user_id'], PDO::PARAM_INT);
            $stmt->execute();
            $passHash = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!password_verify($_POST['pwd'], $passHash['password'])) {
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
    }

    // Create an object from our class
    $crusifyUser = new CrusifiedUser();
    // Error handlers
    $crusifyUser->verifyUser($_POST['pwd']);