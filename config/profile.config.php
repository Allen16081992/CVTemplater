<?php // Dhr. Allen Pieter
    // Start a session for displaying error messages.
    require_once 'peripherals/session_management.config.php';

    // Use the (improved) database connection.
    require_once 'idb.config.php';
    require_once "Classes/TrashTables.class.config.php";

    class Profile {
        private $pdo;
        private $intro;
        private $desc;
        private $fileUpload;
        private $resumeID;
        private $userID;
        
        public function __construct($intro, $desc, $fileUpload, $resumeID, $userID) {
            $database = new Database();
            $this->pdo = $database->connect();
            $this->intro = $intro;
            $this->desc = $desc;
            $this->fileUpload = $fileUpload;
            $this->resumeID = $resumeID;
            $this->userID = $userID;
        } 

        public function setProfileInfo() {
            if (isset($this->userID) && isset($this->resumeID) && !empty($this->resumeID)) {
                // Select user record
                $stmt = $this->pdo->prepare('SELECT * FROM `profile` WHERE resumeID = :resumeID AND userID = :userID');
                $stmt->bindParam(':resumeID', $this->resumeID);
                $stmt->bindParam(':userID', $this->userID);

                if (!$stmt->execute()) {
                    $stmt = null;
                    $_SESSION['error'] = 'Profile database query failed.';
                    header('location: ../client.php');
                    exit(); 
                }

                if($stmt->rowCount() == 0 ) {
                    $stmt = null;
                    // SQL statement for all data and file details
                    $stmt = $this->pdo->prepare('INSERT INTO `profile` (resumeID, userID, profileintro, profiledesc, filePath, fileName) VALUES (:resumeID, :userID, :intro, :desc, :filepath, :filename)');
                } else { 
                    // Fetch the data from the executed statement as an associative array
                    $profile = $stmt->fetch(PDO::FETCH_ASSOC);

                    if(!empty($profile['fileName']) || !empty($profile['filePath'])) {
                        // Remove the associated image file
                        $imageFilePath = '../img/avatars/' . $profile['fileName'];
                        if (file_exists($imageFilePath)) {
                            unlink($imageFilePath);
                        }

                        // manage system memory management
                        $imageFilePath = null; unset($imageFilePath);
                        $profile = null; unset($profile);                        
                    }

                    // Existing profile record found, use syntax update
                    $stmt = $this->pdo->prepare('UPDATE `profile` SET profileintro = IF(:intro <> "", :intro, profileintro), profiledesc = IF(:desc <> "", :desc, profiledesc), filePath = IF(:filepath <> "", :filepath, filePath), fileName = IF(:filename <> "", :filename, fileName) WHERE resumeID = :resumeID AND userID = :userID');
                }

                // Check if any of the fields have a value and bind the corresponding parameters
                if (!empty($this->intro)) {
                    $stmt->bindParam(':intro', $this->intro);
                } else {
                    $stmt->bindValue(':intro', '');
                }
                if (!empty($this->desc)) {
                    $stmt->bindParam(':desc', $this->desc);
                } else {
                    $stmt->bindValue(':desc', '');
                }
                if (!empty($this->fileUpload['name'])) {
                    // Generate a unique file name
                    $filename = uniqid() . '_' . $this->fileUpload['name'];
                    $filepath = '../img/avatars/' . $filename;
                    $stmt->bindParam(':filepath', $filepath);
                    $stmt->bindParam(':filename', $filename);

                    // Move the uploaded file to the desired location
                    move_uploaded_file($this->fileUpload['tmp_name'], $filepath);
                } else {
                    // Generate a unique file name
                    //$filename = uniqid() . '_' . $this->fileUpload['name'];
                    //$filepath = '../img/avatars/' . $filename;
                    $stmt->bindValue(':filepath', '');
                    $stmt->bindValue(':filename', '');

                    // Move the uploaded file to the desired location
                    //move_uploaded_file($this->fileUpload['tmp_name'], $filepath);
                }

                $stmt->bindParam(':resumeID', $this->resumeID);
                $stmt->bindParam(':userID', $this->userID);

                // echo "Query: ";
                // echo $stmt->queryString;
                // echo "<br>";

                // echo "Bound Parameters: ";
                // print_r($stmt->debugDumpParams());
                // echo "<br>";

                if (!$stmt->execute()) {
                    $stmt = null;
                    $_SESSION['error'] = 'Unable to save profile data.';
                    header('location: ../client.php');
                    exit();
                }

                // display a message
                $_SESSION['success'] = "Profile info saved.";
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

        public function verifyProfile() {
            if(!$this->emptyInput()) {
               // No resume name.
               $_SESSION['error'] = 'No introduction provided.';
               header('location: ../client.php');
               exit(); 
            } elseif(!$this->invalidInput()) {
                // Invalid characters.
                $_SESSION['error'] = 'Only letters, "," and numbers allowed.';
                header('location: ../client.php');
                exit(); 
            } else {
                $this->setProfileInfo();
            }
        }
        
        private function emptyInput() {
            // Check if any of the required fields are empty
            return !(empty($this->intro) && empty($this->desc) && empty($this->fileUpload['name']));
        }
        private function invalidInput() {
            // Make sure the submitted values are valid.
            $regex = '/^[a-zA-Z0-9,\.]+$/';
            return !preg_match($regex, $this->intro) || !preg_match($regex, $this->desc);
        }
        
    }

    // Check if the form is submitted
    if (isset($_POST['saveProfile'])) {
        // Get the form data
        $intro = $_POST['intro'];
        $desc = $_POST['desc'];
        $fileUpload = $_FILES['file-upload'];
        $resumeID = $_POST['resumeid'];
        $userID = $_SESSION['user_id'];
        
        $profile = new Profile($intro, $desc, $fileUpload, $resumeID, $userID);
        $profile->verifyProfile();
    } elseif(isset($_POST['trashProfile'])) {
        $resumeID = $_SESSION['resumeID'];
        $userID = $_SESSION['user_id'];
    
        // Initialise the Multipurose trash class
        $multidelete = new MultiTrash($resumeID, $userID);
        $multidelete->multiTrash();
    
        // When trashing process completes, open the client environment MyResume.
        header('location: ../client.php');
    }