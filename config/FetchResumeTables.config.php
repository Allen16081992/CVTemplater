<?php
    //if (!class_exists('Database')) {
        // Database Configuration
        require_once 'config.php';
    //}

    class FetchData {
        private $pdo;

        public function __construct() {
            $database = new Database();
            $this->pdo = $database->connect();
        }

        public function fetchAllData($resumeID, $userID) {
            $data = array();

            // Fetch data from the 'experience' table
            $stmt = $this->pdo->prepare('SELECT * FROM `experience` WHERE resumeID = ? AND userID = ?');
            $stmt->execute([$resumeID, $userID]);
            $data['experience'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Fetch data from the 'education' table
            $stmt = $this->pdo->prepare('SELECT * FROM `education` WHERE resumeID = ? AND userID = ?');
            $stmt->execute([$resumeID, $userID]);
            $data['education'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Fetch data from the 'interests' table
            $stmt = $this->pdo->prepare('SELECT * FROM `interests` WHERE resumeID = ? AND userID = ?');
            $stmt->execute([$resumeID, $userID]);
            $data['interests'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Fetch data from the 'languages' table
            $stmt = $this->pdo->prepare('SELECT * FROM `languages` WHERE resumeID = ? AND userID = ?');
            $stmt->execute([$resumeID, $userID]);
            $data['languages'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Fetch data from the 'profile' table
            $stmt = $this->pdo->prepare('SELECT * FROM `profile` WHERE resumeID = ? AND userID = ?');
            $stmt->execute([$resumeID, $userID]);
            $data['profile'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Fetch data from the 'technical' table
            $stmt = $this->pdo->prepare('SELECT * FROM `technical` WHERE resumeID = ? AND userID = ?');
            $stmt->execute([$resumeID, $userID]);
            $data['technical'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $_SESSION['error'] = 'No data found.';  
            }
            
            return $data;
        }
    }
?>
