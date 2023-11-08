<?php // Dhr. Allen Pieter
    // Start a session for resume to userID assignment.
    require_once 'peripherals/session_management.config.php';
    require_once 'idb.config.php';
    require_once 'Classes/TrashTables.class.config.php';

    class Motivation {
        private $pdo;
        private $letter;
        private $resumeID;
        private $userID;

        public function __construct($letter, $resumeID, $userID) {
            $database = new Database();
            $this->pdo = $database->connect();
            $this->letter = $letter;
            $this->resumeID = $resumeID;
            $this->userID = $userID;
        }

        private function findData() {
            // Select letter record
            $stmt = $this->pdo->prepare('SELECT * FROM `motivation` WHERE resumeID = :resumeID AND userID = :userID');
            $stmt->bindParam(':resumeID', $this->resumeID);
            $stmt->bindParam(':userID', $this->userID);
    
            if (!$stmt->execute()) {
                $stmt = null;
                $_SESSION['error'] = 'Failed to query Motivation.';
                header('location: ../client.php');
                exit(); 
            } 

            return $stmt->rowCount() > 0;
        }

        protected function setMotivation() {
            if (isset($this->userID) && isset($this->resumeID) && !empty($this->resumeID)) {
                // Select letter record
                $isInsert = !$this->findData();
                $stmt = null;
        
                // SQL statement for all data and file details
                $stmt = $isInsert
                    ? $this->pdo->prepare('INSERT INTO `motivation` (letter, resumeID, userID) VALUES (:letter, :resumeID, :userID)')
                    : $this->pdo->prepare('UPDATE `motivation` SET letter = :letter WHERE resumeID = :resumeID AND userID = :userID');
        
                // Display a message
                $_SESSION['success'] = $isInsert ? 'Motivation created.' : 'Motivation saved.';
        
                $stmt->bindParam(':letter', $this->letter);
                $stmt->bindParam(':resumeID', $this->resumeID);
                $stmt->bindParam(':userID', $this->userID);
                $stmt->execute();
            } else {
                // No resume selected.
                $_SESSION['error'] = 'You should create a resume first.';                
            }
        
            // Redirect to the appropriate page
            header('Location: ../client.php');
            exit();
        }

        public function verifyMotivation() {
            if(!$this->emptyInput()) {
               // No resume name.
               $_SESSION['error'] = 'No motivation letter provided.';
               header('location: ../client.php');
               exit(); 
            } 
            $this->setMotivation();
        }
        
        private function emptyInput() {
            // Check if any of the required fields are empty
            return !(empty($this->letter));
        }
    }

    // Verify if a new resume was submitted
    if (isset($_POST['saveMotivation'])) {
        $userID = $_SESSION['user_id'];
        $resumeID = $_SESSION["resumeID"];
        $letter = $_POST['letter'];

        // This class also contains the update function
        $nieuweresume = new Motivation($letter, $resumeID, $userID);
        $nieuweresume->verifyMotivation();

    } elseif (isset($_POST['trashMotivation'])) {
        $resumeID = $_SESSION['resumeID'];
        $userID = $_SESSION['user_id'];
    
        // Initialise the Multipurose trash class
        $multidelete = new MultiTrash($resumeID, $userID);
        $multidelete->multiTrash();
    
        // When trashing process completes, open the client environment MyResume.
        header('location: ../client.php');
    }