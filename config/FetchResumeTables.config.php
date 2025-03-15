<?php // Dhr. Allen Pieter
    // Start a session for displaying error messages.
    require_once 'peripherals/session_management.config.php';

    // Use the (improved) database connection.
    require_once 'idb.config.php';

    class FetchData {
        private $pdo;

        public function __construct() {
            $database = new Database();
            $this->pdo = $database->connect();
        }

        public function fetchAllData($resumeID, $userID) {
            $data = array();

            // Fetch data from the 'technical' table
            $stmt = $this->pdo->prepare('SELECT * FROM `technical` WHERE resumeID = ? AND userID = ?');
            $stmt->execute([$resumeID, $userID]);
            $data['technical'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Fetch data from the 'profile' table
            $stmt = $this->pdo->prepare('SELECT * FROM `profile` WHERE resumeID = ? AND userID = ?');
            $stmt->execute([$resumeID, $userID]);
            $data['profile'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Fetch data from the 'experience' table
            $stmt = $this->pdo->prepare('SELECT * FROM `experience` WHERE resumeID = ? AND userID = ?');
            $stmt->execute([$resumeID, $userID]);
            $data['experience'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Fetch data from the 'education' table
            $stmt = $this->pdo->prepare('SELECT * FROM `education` WHERE resumeID = ? AND userID = ?');
            $stmt->execute([$resumeID, $userID]);
            $data['education'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // In addition, fetch data from the 'motivation' table
            $stmt = $this->pdo->prepare('SELECT * FROM `motivation` WHERE resumeID = ? AND userID = ?');
            $stmt->execute([$resumeID, $userID]);
            $data['motivation'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $_SESSION['error'] = 'No data found.';  
            }
            
            return $data;
        }
    }

    if (isset($_SESSION['resumeID'])) {
        $resumeID = $_SESSION['resumeID'];
        $userID = $_SESSION['user_id'];
        
        // Create a new instance of FetchData
        $fetchData = new FetchData();
        $data = $fetchData->fetchAllData($resumeID, $userID);
    }