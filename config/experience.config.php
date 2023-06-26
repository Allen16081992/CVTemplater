<?php // Khaqan
    //error_reporting(E_ALL);
    //ini_set('display_errors', 'On');
    // Start a session for resume to userID assignment.
    require_once 'peripherals/session_start.config.php';
    // Use the (improved) database connection.
    require_once "idb.config.php";
    require_once "Classes/experience.class.config.php";
    require_once "Classes/TrashTables.class.config.php";

    // Verify if a new resume was submitted
    if (isset($_POST['addExperience'])) {
        $userID = $_SESSION['user_id'];
        $resumeID = $_SESSION["resumeID"];
        $worktitle = $_POST['worktitle'];
        $nieuweworktitle = new Experience($worktitle, $_POST['workdesc'], $_POST['company'], $_POST['from'], $_POST['until'], $userID, $resumeID );
        $nieuweworktitle->Createexperience();

        // Refresh client page.
        $_SESSION['success'] = 'Experience has been created';
        header('location: ../client.php?');
        exit();
    } elseif (isset($_POST['saveExperience'])) {
        $userID = $_SESSION['user_id'];
        $resumeID = $_SESSION["resumeID"];
        $worktitle = $_POST['worktitle'];
        $nieuweworktitle = new Experience($worktitle, $_POST['workdesc'], $_POST['company'], $_POST['from'], $_POST['until'], $userID, $resumeID );
        $nieuweworktitle->Updateexperience();

        // Refresh client page.
        $_SESSION['success'] = 'Experience has been saved';
        header('location: ../client.php?');
        exit();
    } elseif(isset($_POST['trashExperience'])) {
        $resumeID = $_SESSION['resumeID'];
        $userID = $_SESSION['user_id'];
    
        // Initialise the Multipurose trash class
        $multidelete = new MultiTrash($resumeID, $userID);
        $multidelete->multiTrash();
    
        // When trashing process completes, open the client environment MyResume.
        header('location: ../client.php');
        exit();   
    }