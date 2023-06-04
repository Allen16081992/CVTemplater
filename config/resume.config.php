<?php
    // Start a session for resume to userID assignment.
    require 'peripherals/session_start.config.php';

    // Verify if a new resume was submitted
    if (isset($_POST['creResume'])) {
        // Initialise resume class
        require "Classes/resume.class.config.php";
        $nieuweresume = new Resume($_POST['cv-name']);
        $nieuweresume->Create();

        // Refresh client page.
        $_SESSION['success'] = 'The resume has been created.';
        header('location: ../client.php?');
        exit();
    }

    // If we receive an AJAX request.
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        // Initialise read resume
        require 'ViewResume.config.php';

        if ($action === 'selectResumeInfo') {
            $selectedTitle = $_POST['title'];
            // create an object from this class
            $ajax = new ViewResume();
            $ajax->selectResumeInfo($selectedTitle);

        } elseif ($action === 'function2') {
          // $ajax->function2();
        }
    }
?>