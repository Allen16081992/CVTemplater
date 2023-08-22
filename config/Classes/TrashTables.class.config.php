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

                    // Error message by sessions instead of URL parsing.
                    $_SESSION['success'] = 'Profile is trashed';
                } else {
                    $stmt = null;
                    // Error message by sessions instead of URL parsing.
                    $_SESSION['error'] = "Profile data doesn't exist.";           
                }

            } elseif(isset($_POST['trashExperience'])) {
                // Check if a row id was submitted
                if(isset($_POST['workID'])) {
                    $workID = $_POST['workID'];
                } else {
                    $workID = null;
                    // Error message by sessions instead of URL parsing.
                    $_SESSION['error'] = 'Failed to verify Experience.';
                    header('location: ../client.php');
                }

                if ($this->tableHasData('experience')) {
                    // Instantiate the Trashing of data
                    $stmt = $this->connect()->prepare('DELETE FROM `experience` WHERE workID = :workID AND resumeID = :resumeID AND userID = :userID');
                    $stmt->bindParam(":workID", $workID);
                    $stmt->bindParam(":resumeID", $this->resumeID);
                    $stmt->bindParam(":userID", $this->userID);
                    $stmt->execute(); $stmt = null;

                    // Error message by sessions instead of URL parsing.
                    $_SESSION['success'] = 'Experience is trashed';
                } else {
                    $stmt = null;
                    // Error message by sessions instead of URL parsing.
                    $_SESSION['error'] = "Experience data doesn't exist.";
                }

            } elseif(isset($_POST['trashEducation'])) {
                // Check if a row id was submitted
                if(isset($_POST['eduID'])) {
                    $eduID = $_POST['eduID'];
                } else {
                    $eduID = null;
                    // Error message by sessions instead of URL parsing.
                    $_SESSION['error'] = 'Failed to verify Education.';
                    header('location: ../client.php');
                }

                if ($this->tableHasData('education')) {
                    // Instantiate the Trashing of data
                    $stmt = $this->connect()->prepare('DELETE FROM `education` WHERE eduID = :eduID AND resumeID = :resumeID AND userID = :userID');
                    $stmt->bindParam(":eduID", $eduID);
                    $stmt->bindParam(":resumeID", $this->resumeID);
                    $stmt->bindParam(":userID", $this->userID);
                    $stmt->execute(); $stmt = null; 

                    // Error message by sessions instead of URL parsing.
                    $_SESSION['success'] = 'Education is trashed';
                } else {
                    $stmt = null;
                    // Error message by sessions instead of URL parsing.
                    $_SESSION['error'] = 'Failed to verify Education.';
                }

            } elseif(isset($_POST['trashSkill'])) {
                // Check if we received any row id(s)
                if(isset($_POST['techID']) && isset($_POST['langID']) && isset($_POST['interestID'])) {
                    $techID = $_POST['techID'];
                    $langID = $_POST['langID'];
                    $interestID = $_POST['interestID'];
                } else {
                    $techID = null; $langID = null; $interestID = null;
                    // Error message by sessions instead of URL parsing.
                    $_SESSION['error'] = 'Technical Skills not found.';
                    header('location: ../client.php');
                }
                
                if ($this->tableHasData('technical')) {
                    // Instantiate the Trashing of data
                    $stmt = $this->connect()->prepare('DELETE FROM `technical` WHERE `techID` = :techID AND resumeID = :resumeID AND userID = :userID');
                    $stmt->bindParam(":techID", $techID);
                    $stmt->bindParam(":resumeID", $this->resumeID);
                    $stmt->bindParam(":userID", $this->userID);
                    $stmt->execute(); $stmt = null; 
                }

                if ($this->tableHasData('languages')) {
                    // Instantiate the Trashing of data
                    $stmt = $this->connect()->prepare('DELETE FROM `languages` WHERE `langID` = :langID AND resumeID = :resumeID AND userID = :userID');
                    $stmt->bindParam(":langID", $langID);
                    $stmt->bindParam(":resumeID", $this->resumeID);
                    $stmt->bindParam(":userID", $this->userID);
                    $stmt->execute(); $stmt = null; 
                }
                
                if ($this->tableHasData('interests')) {
                    // Instantiate the Trashing of data
                    $stmt = $this->connect()->prepare('DELETE FROM `interests` WHERE `interestID` = :interestID AND resumeID = :resumeID AND userID = :userID');
                    $stmt->bindParam(":interestID", $interestID);
                    $stmt->bindParam(":resumeID", $this->resumeID);
                    $stmt->bindParam(":userID", $this->userID);
                    $stmt->execute(); $stmt = null; 
                }

                // Error message by sessions instead of URL parsing.
                $_SESSION['success'] = 'Skills have been trashed';
            }
        }

        private function tableHasData($tableName) {
            $stmt = $this->connect()->prepare("SELECT COUNT(*) FROM `$tableName` WHERE resumeID = :resumeID AND userID = :userID");
            $stmt->bindParam(":resumeID", $this->resumeID);
            $stmt->bindParam(":userID", $this->userID);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count > 0;
        }
    }