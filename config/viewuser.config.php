<?php // Dhr. Allen Pieter
    // Start a session for displaying error messages.
    require 'peripherals/session_start.config.php';

    // Use the (improved) database connection.
    require 'idb.config.php';

    class ViewUser {
        private $pdo;
        
        public function __construct() {
            $database = new Database();
            $this->pdo = $database->connect();
        }       

        public function viewUserInfo() {
            // Verify if the user ID exists
            if (isset($_SESSION['user_id'])) {
                $userID = $_SESSION['user_id'];
        
                // Select user record
                $stmt = $this->pdo->prepare('SELECT username, email FROM accounts WHERE userID = ?');
                $stmt->execute([$userID]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if (!$user) {
                    $_SESSION['error'] = 'User information not found';
                    return;
                }
        
                // Select contact record
                $stmtC = $this->pdo->prepare('SELECT phone, firstname, lastname, birth, nationality, streetname, postalcode, city FROM contact WHERE userID = ?');
                $stmtC->execute([$userID]);
                $contact = $stmtC->fetch(PDO::FETCH_ASSOC);
        
                if (!$contact) {
                    $_SESSION['error'] = 'Contact information not found';
                    return;
                }
        
                // Return the combined user and contact data
                return ['user' => $user, 'contact' => $contact];
            }
        
            // Return an empty array if user ID is not set
            return [];
        }       
    }
    // Create an object from our class
    $viewData = new ViewUser();
    // Error handlers
    $viewData->viewUserInfo();
?>
