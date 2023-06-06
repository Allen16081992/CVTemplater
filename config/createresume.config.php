<?php
    // Start a session for resume to userID assignment.
    require 'peripherals/session_start.config.php';

    // error_reporting(E_ALL);
    // ini_set('display_errors', 'On');
    require "idb.config.php";
    require_once "Classes/createresume.class.config.php";

    // Verify if a new resume was submitted
    if (isset($_POST['creResume'])) {
        $nieuweresume = new Resume($_POST['cv-name']);
        $nieuweresume->Create();

        // Refresh client page.
        $_SESSION['success'] = 'The resume has been created.';
        header('location: ../client.php?');
        exit();
    }
?>



