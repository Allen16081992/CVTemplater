<?php // Khaqan Ul Haq Awan
    // Start a session for resume to userID assignment.
    require_once 'peripherals/session_start.config.php';

    require_once "idb.config.php";
    require_once "Classes/createresume.class.config.php";

    // Verify if a new resume was submitted
    if (isset($_POST['creResume'])) {
        $resumetitle = $_POST['cvname'];

        // This class also contains the update function
        $nieuweresume = new createResume($resumetitle);
        $nieuweresume->verifyResume();

        // Refresh client page.
        $_SESSION['success'] = 'Resume created. You can now select it.';
        header('location: ../client.php?');
        exit();
    }