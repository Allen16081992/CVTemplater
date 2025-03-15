<?php // Dhr. Allen Pieter
    // Start a session for displaying error messages.
    require_once 'peripherals/session_management.config.php';

    class MultiTrash extends Database {
        private $resumeID;
        private $userID;

        public function __construct($resumeID, $userID) {
            $this->resumeID = $resumeID;
            $this->userID = $userID;
        }

        public function MultiTrash() {
            // Verify which tab was submitted
            if(isset($_POST['trashProfile'])) {
                // Retrieve the fileName from the profile record
                $stmt = $this->connect()->prepare('SELECT `fileName` FROM `profile` WHERE resumeID = :resumeID AND userID = :userID');
                $stmt->bindParam(":resumeID", $this->resumeID);
                $stmt->bindParam(":userID", $this->userID);
                $stmt->execute();
                $existingImage = $stmt->fetch();

                // Check if the fileName column has actual data
                if ($existingImage && !empty($existingImage['fileName'])) {
                    // Remove the associated image file
                    $imageFilePath = '../img/avatars/' . $existingImage['fileName'];
                    if (file_exists($imageFilePath)) {
                        unlink($imageFilePath);
                    }
                }

                if ($this->tableHasData('profile')) {
                    // Instantiate the Trashing of data
                    $stmt = $this->connect()->prepare('DELETE FROM `profile` WHERE resumeID = :resumeID AND userID = :userID');
                    $stmt->bindParam(":resumeID", $this->resumeID);
                    $stmt->bindParam(":userID", $this->userID);
                    $stmt->execute(); $stmt = null;

                    // message by sessions instead of URL parsing.
                    $_SESSION['success'] = 'Profile is trashed';
                } else {
                    $stmt = null;
                    // message by sessions instead of URL parsing.
                    $_SESSION['error'] = "Profile data doesn't exist.";           
                }

            } elseif(isset($_POST['trashExperience'])) {
                // Check if a row id was submitted
                if(!isset($_POST['workID'])) {
                    // message by sessions instead of URL parsing.
                    $_SESSION['error'] = 'Failed to verify Experience.';
                    header('location: ../client.php');
                }

                if ($this->tableHasData('experience')) {
                    // Instantiate the Trashing of data. Add row, table name and column name.
                    $rowID = $_POST['workID']; 
                    $this->tableTrasher('experience', 'workID', $rowID);

                    // message by sessions instead of URL parsing.
                    $_SESSION['success'] = 'Experience has been trashed';
                } else {
                    // message by sessions instead of URL parsing.
                    $_SESSION['error'] = "Experience data doesn't exist.";
                }

            } elseif(isset($_POST['trashEducation'])) {
                // Check if a row id was submitted
                if(!isset($_POST['eduID'])) {
                    // message by sessions instead of URL parsing.
                    $_SESSION['error'] = 'Failed to verify Education.';
                    header('location: ../client.php');
                }

                if ($this->tableHasData('education')) {
                    // Instantiate the Trashing of data. Add row, table name and column name.
                    $rowID = $_POST['eduID'];
                    $this->tableTrasher('education', 'eduID', $rowID);

                    // message by sessions instead of URL parsing.
                    $_SESSION['success'] = 'Education has been trashed';
                } else {
                    // message by sessions instead of URL parsing.
                    $_SESSION['error'] = "Education data doesn't exist.";
                }

            } elseif(isset($_POST['trashSkill'])) {
                // Check if we received any row id(s)
                if (isset($_POST['techID']) && $this->tableHasData('technical')) {
                    // Instantiate the Trashing of data. Add row, table name and column name.
                    $this->tableTrasher('technical', 'techID', $_POST['techID']);
                }

                // message by sessions instead of URL parsing.
                $_SESSION['success'] = "Technical Skills trashed";

            } elseif(isset($_POST['trashMotivation'])) { 
                // Check if we received any row id(s)
                if (!isset($_POST['motID'])) {
                    // message by sessions instead of URL parsing.
                    $_SESSION['error'] = 'Motivation not found.';
                    header('location: ../client.php');  
                } 

                if ($this->tableHasData('motivation')) {
                    // Instantiate the Trashing of data. Add row, table name and column name.
                    $rowID = $_POST['motID'];
                    $this->tableTrasher('motivation', 'motID', $rowID);

                    // message by sessions instead of URL parsing.
                    $_SESSION['success'] = 'Motivation has been trashed';
                } else {
                    // message by sessions instead of URL parsing.
                    $_SESSION['error'] = "Motivation doesn't exist.";
                }
            }
        }

        // Table Data Finder
        private function tableHasData($tableName) {
            $stmt = $this->connect()->prepare("SELECT COUNT(*) FROM `$tableName` WHERE resumeID = :resumeID AND userID = :userID");
            $stmt->bindParam(":resumeID", $this->resumeID);
            $stmt->bindParam(":userID", $this->userID);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count > 0;
        }

        // Table Data Deletor. (pun intended to Cardfight Vanguard)
        private function tableTrasher($tableName, $column, $rowID) {
            // Instantiate the Trashing of data
            $stmt = $this->connect()->prepare("DELETE FROM `$tableName` WHERE `$column` = :rowID AND resumeID = :resumeID AND userID = :userID");
            $stmt->bindParam(":rowID", $rowID);
            $stmt->bindParam(":resumeID", $this->resumeID);
            $stmt->bindParam(":userID", $this->userID);

            if (!$stmt->execute()) {
                $stmt = null;
                // message by sessions instead of URL parsing.
                $_SESSION['error'] = 'Failed to delete '.$tableName.'';
                header('location: ../client.php');
            } 
        }
    }