<?php // Khaqan Ul Haq Awan
    // Start a session for resume to userID assignment.
    require 'peripherals/session_start.config.php';

    require "idb.config.php";
    require_once "Classes/createresume.class.config.php";

    // Verify if a new resume was submitted
    if (isset($_POST['creResume'])) {
        $resumetitle = $_POST['cvname'];
        $nieuweresume = new Resume($resumetitle);
        $nieuweresume->verifyResume();

        // Refresh client page.
        $_SESSION['success'] = 'The resume has been created.';
        header('location: ../client.php?');
        exit();
    }
?>



