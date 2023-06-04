<?php // Dhr. Allen Pieter
    // Start a session for displaying error messages.
    require 'peripherals/session_start.config.php';

    if(isset($_POST['saveProfile'])) {

        if(isset($_FILES['file-upload'])) {
            // uploaded file details
            $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
            $fileName = $_FILES['uploadedFile']['name'];
            $fileSize = $_FILES['uploadedFile']['size'];
            $fileType = $_FILES['uploadedFile']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // removing extra spaces
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

            // file extensions allowed
            $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');

            if (in_array($fileExtension, $allowedfileExtensions)) {
                // directory where file will be moved
                $uploadFileDir = 'C:\xampp\htdocs\CVTemplater\img\avatars';
                $dest_path = $uploadFileDir . $newFileName;

                if(move_uploaded_file($fileTmpPath, $dest_path)) {
                    $_SESSION['success'] = 'File uploaded successfully.';
                    return;
                } else {
                    $_SESSION['error'] = 'Failed to access file destination.';
                    return;
                }
            } 
            else {
                $_SESSION['error'] = 'Filetype not allowed. Use:'.implode(',', $allowedfileExtensions);
                return;
            }
        } 
        else {
            $_SESSION['error'] = 'File upload failed.'.$_FILES['uploadedFile']['error'];
            return;
        }
        header("Location: ../client.php");
    }
?>