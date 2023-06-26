<?php // Khaqan Ul Haq Awan
    // Start a session for resume to userID assignment.
    require_once 'peripherals/session_start.config.php';
    // Use the (improved) database connection.
    require_once "idb.config.php";
    require_once "Classes/education.class.config.php";
    require_once "Classes/TrashTables.class.config.php";

    // Verify if a new resume was submitted
    if (isset($_POST['addEducation'])) {
        $userID = $_SESSION['user_id'];
        $resumeID = $_SESSION["resumeID"];
        $edutitle = $_POST['program'];
        $nieuweedutitle = new Education($edutitle, $_POST['edudesc'], $_POST['company'], $_POST['from'], $_POST['until'], $userID, $resumeID );
        $nieuweedutitle->verifyEducation();

        // Refresh client page.
        $_SESSION['success'] = 'Education has been created.';
        header('location: ../client.php?');
        exit();
    } elseif (isset($_POST['saveEducation'])) {
        $userID = $_SESSION['user_id'];
        $resumeID = $_SESSION["resumeID"];
        $edutitle = $_POST['program'];
        $nieuweedutitle = new Education($edutitle, $_POST['edudesc'], $_POST['company'], $_POST['from'], $_POST['until'], $userID, $resumeID );
        $nieuweedutitle->verifyEducation();

        // Refresh client page.
        $_SESSION['success'] = 'Education has been updated.';
        header('location: ../client.php?');
        exit();
    } elseif(isset($_POST['trashEducation'])) {
        $resumeID = $_SESSION['resumeID'];
        $userID = $_SESSION['user_id'];
    
        // Initialise the Multipurose trash class
        $multidelete = new MultiTrash($resumeID, $userID);
        $multidelete->multiTrash();
    
        // When trashing process completes, open the client environment MyResume.
        header('location: ../client.php');
        exit();   
    }