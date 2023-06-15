<?php
    // Start a session for displaying error messages.
    require_once 'peripherals/session_start.config.php';

    // Use the (improved) database connection.
    require 'idb.config.php';

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

                if (isset($this->userID) && (isset($this->resumeID))) {
                    // Check if a file was submitted
                    if ($this->fileUpload['name'] !== '') {
                        // Generate a unique file name
                        $filename = uniqid() . '_' . $this->fileUpload['name'];
                        $filepath = '../img/avatars/' . $filename;

                        // Move the uploaded file to the desired location
                        move_uploaded_file($this->fileUpload['tmp_name'], $filepath);
                    }

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
                        $stmt = $this->pdo->prepare(
                            'INSERT INTO `profile` (profileintro, profiledesc, filePath, fileName, resumeID, userID)
                             VALUES (:intro, :desc, :filepath, :filename, :resumeID, :userID)'
                        ); 
                        $stmt->bindParam(':intro', $this->intro);
                        $stmt->bindParam(':desc', $this->desc);   
                        $stmt->bindParam(':filepath', $filepath);
                        $stmt->bindParam(':filename', $filename);
                        $stmt->bindParam(':resumeID', $this->resumeID);
                        $stmt->bindParam(':userID', $this->userID);

                        if (!$stmt->execute()) {
                            $stmt = null;
                            $_SESSION['error'] = 'Unable to insert profile data.';
                            header('location: ../client.php');
                            exit(); 
                        }

                        // Check if something was inserted
                        if ($stmt->rowCount() > 0) {
                            // Profile insert successful
                            $_SESSION['success'] = "Profile info created.";
                        }
                    } 

                    if ($stmt->rowCount() > 0) {
                        $stmt = null;

                        // SQL statement for all data and file details
                        $stmt = $this->pdo->prepare(
                            'UPDATE `profile` SET profileintro = :intro, profiledesc = :desc, filePath = :filepath, fileName = :filename 
                             WHERE resumeID = :resumeID AND userID = :userID'
                        );    
                        $stmt->bindParam(':intro', $this->intro);
                        $stmt->bindParam(':desc', $this->desc); 
                        $stmt->bindParam(':filepath', $filepath);
                        $stmt->bindParam(':filename', $filename);
                        $stmt->bindParam(':resumeID', $this->resumeID);
                        $stmt->bindParam(':userID', $this->userID);

                        if (!$stmt->execute()) {
                            $stmt = null;
                            $_SESSION['error'] = 'Unable to update profile data.';
                            header('location: ../client.php');
                            exit(); 
                        }

                        // display a message
                        $_SESSION['success'] = "Profile info updated.";
                    }
                    $stmt = null;

                    // Redirect to the appropriate page
                    header('Location: ../client.php');
                    exit();
                }

        }
    }

    $resumeID = $_POST['resumeid'];
    $userID = $_SESSION['user_id'];

    // Check if the form is submitted
    if (isset($_POST['saveProfile'])) {
        // Get the form data
        $intro = $_POST['intro'];
        $desc = $_POST['desc'];
        $fileUpload = $_FILES['file-upload'];

        if ($fileUpload['name'] !== '') {
            // Generate a unique file name
            $filename = uniqid() . '_' . $fileUpload['name'];
            $filepath = '../img/avatars/' . $filename;

            // Move the uploaded file to the desired location
            move_uploaded_file($fileUpload['tmp_name'], $filepath);
        }
        
        $profile = new Profile($intro, $desc, $fileUpload, $resumeID, $userID);
        $profile->setProfileInfo();
    }