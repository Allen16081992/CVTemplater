<?php // Dhr. Allen Pieter
    // Start a session for displaying error messages.
    require_once 'peripherals/session_management.config.php';

    // Use the (improved) database connection.
    require_once 'idb.config.php';

    class ViewResumes {
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

                if (!$stmt->execute([$userID])) {
                    $_SESSION['error'] = 'Failed to retrieve resume info.';
                    return [];
                } else {
                    // Return the resume data
                    $cv = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return $cv;                   
                }
            }
            // Return an empty array if user ID is not set
            return [];
        }
    }

    // Create an instance of ViewResume
    $resume = new ViewResumes();
    $resumeData = $resume->viewResumeTitles();