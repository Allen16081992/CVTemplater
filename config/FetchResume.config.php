<?php // Dhr. Allen Pieter
    // Start a session for displaying error messages.
    require_once 'peripherals/session_management.config.php';

    // Use the (improved) database connection.
    require_once 'idb.config.php';

    class FetchResumeID {
        private $pdo;
        
        public function __construct() {
            $database = new Database();
            $this->pdo = $database->connect();
        }       

        public function fetchResumeID($resumetitle, $userID) {
            // Select resume ID based on resumetitle and userID
            $stmt = $this->pdo->prepare('SELECT resumeID, resumetitle FROM `resume` WHERE resumetitle = ? AND userID = ?');
            $stmt->execute([$resumetitle, $userID]);
            $resume = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if (!$resume) {
                $_SESSION['error'] = 'Resume not found';
                return;
            }
        
            // Store the resume ID in session
            $_SESSION['resumeID'] = $resume['resumeID'];
            $_SESSION['resumetitle'] = $resume['resumetitle'];
            $_SESSION['golden'] = 'Resume: '.$resumetitle;
            header('location: ../client.php?');
            exit();
        }
    }
    
    // Fetch the selected resumetitle and userID from the form submission
    if (isset($_POST['selectCv']) && isset($_SESSION['user_id'])) {
        $resumetitle = $_POST['selectCv'];
        $userID = $_SESSION['user_id'];
        
        // Create an instance of FetchResumeID and fetch the resume ID
        $fetchResumeID = new FetchResumeID();
        $fetchResumeID->fetchResumeID($resumetitle, $userID);
    }