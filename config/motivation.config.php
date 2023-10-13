<?php // Dhr. Allen Pieter
    // Start a session for resume to userID assignment.
    require_once 'peripherals/session_management.config.php';

    require_once "idb.config.php";
    require_once "Classes/motivation.class.config.php";

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

        protected function setMotivation() {
            if (isset($this->userID) && isset($this->resumeID) && !empty($this->resumeID)) {
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

                if($stmt->rowCount() == 0 ) {
                    $stmt = null;
                    // SQL statement for all data and file details
                    $stmt = $this->pdo->prepare('INSERT INTO `motivation` (motdesc, resumeID, userID) VALUES (:letter, :resumeID, :userID)');
                } else { 
                    $stmt = null;
                    // Existing profile record found, use syntax update
                    $stmt = $this->pdo->prepare('UPDATE `motivation` SET motdesc = :letter WHERE resumeID = :resumeID AND userID = :userID');
                }

                $stmt->bindParam(':motdesc', $this->letter);
                $stmt->bindParam(':resumeID', $this->resumeID);
                $stmt->bindParam(':userID', $this->userID);
                $stmt->execute();

                // display a message
                $_SESSION['success'] = "Motivation saved.";
                // Redirect to the appropriate page
                header('Location: ../client.php');
                exit();
            } else {
                // No resume selected.
                $_SESSION['error'] = 'You should create a resume first.';
                header('location: ../client.php');
                exit();                 
            }
        }

        public function verifyMotivation() {
            if(!$this->emptyInput()) {
               // No resume name.
               $_SESSION['error'] = 'No motivation letter provided.';
               header('location: ../client.php');
               exit(); 
            } else {
                $this->setMotivation();
            }
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

        // Refresh client page.
        $_SESSION['success'] = 'Motivation created.';
        header('location: ../client.php?');
        exit();
    }