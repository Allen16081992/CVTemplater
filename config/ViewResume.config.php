<?php // Dhr. Allen Pieter
    // Start a session for displaying error messages.
    require 'peripherals/session_start.config.php';

    // Use the (improved) database connection.
    require 'idb.config.php';

    class ViewResume {
        private $pdo;
        
        public function __construct() {
            $database = new Database();
            $this->pdo = $database->connect();
        }       

        public function viewResumeTitles() {
            // Verify if the user ID exists
            if (isset($_SESSION['user_id'])) {
                $userID = $_SESSION['user_id'];
        
                // Select user records
                $stmt = $this->pdo->prepare('SELECT resumetitle FROM `resume` WHERE userID = ?');
                $stmt->execute([$userID]);
                $cv = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                if (!$cv) {
                    $_SESSION['error'] = 'Work information not found';
                    return [];
                }
                // Return the resume data
                return $cv;
            }
            // Return an empty array if user ID is not set
            return [];
        } 
    }
?>