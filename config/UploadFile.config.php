<?php // Dhr. Allen Pieter
    // Start a session for displaying error messages.
    require 'peripherals/session_start.config.php';

    // Use the (improved) database connection.
    require 'idb.config.php';

    class Avatars {
        private $pdo;

        public function __construct() {
            $database = new Database();
            $this->pdo = $database->connect();
        } 

        public function setAvatar() {
            if (isset($_POST['saveProfile'])) {
                if (isset($_FILES['file-upload'])) {
                    // Uploaded file details
                    $fileTmpPath = $_FILES['file-upload']['tmp_name'];
                    $fileName = $_FILES['file-upload']['name'];
                    $fileSize = $_FILES['file-upload']['size'];
                    $fileType = $_FILES['file-upload']['type'];
                    $fileNameCmps = explode(".", $fileName);
                    $fileExtension = strtolower(end($fileNameCmps));
            
                    // Removing extra spaces
                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            
                    // File extensions allowed
                    $allowedfileExtensions = array('jpg', 'png');
            
                    if (in_array($fileExtension, $allowedfileExtensions)) {
                        // Directory where the file will be moved
                        $uploadFileDir = '../img/avatars/';
                        $dest_path = $uploadFileDir . $newFileName;
            
                        if (move_uploaded_file($fileTmpPath, $dest_path)) {
                            // Store file information in the database
                            $userID = $_SESSION['user_id']; // Assuming you have the user ID stored in the session
                            $resumeID = $_SESSION['resume_id'];
                            $intro = $_POST['intro'];
                            $desc = $_POST['desc'];
                            $filePath = $dest_path;
                            $uploadedFileName = $fileName;
            
                            // Prepare and execute the database query
                            $stmt = $this->pdo->prepare("INSERT INTO profile (profileintro, profiledesc, file_path, file_name, resumeID, userID) VALUES (?, ?, ?, ?, :resumeID, :userID)");
                            $stmt = $this->pdo->bindParam(":resumeID", $resumeID);
                            $stmt = $this->pdo->bindParam(":userID", $userID);
                            $stmt->execute([$userID, $filePath, $uploadedFileName]);
            
                            $_SESSION['success'] = 'File uploaded.';
                        } else {
                            $_SESSION['error'] = 'Failed to access file destination.';
                        }
                    } else {
                        $_SESSION['error'] = 'Filetype not allowed. Use: ' . implode(',', $allowedfileExtensions);
                    }
                } else {
                    $_SESSION['error'] = 'File upload failed.' . $_FILES['file-upload']['error'];
                }

                header("Location: ../client.php");
                exit();
            }
        }
    }
?>
