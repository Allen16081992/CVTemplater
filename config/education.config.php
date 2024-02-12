<?php // Khaqan Ul Haq Awan
    // Start a session for resume to userID assignment.
    require_once 'peripherals/session_management.config.php';
    // Use the (improved) database connection.
    require_once "idb.config.php";
    require_once "Classes/education.class.config.php";
    require_once "Classes/TrashTables.class.config.php";

    // Verify if a new resume was submitted
    if (isset($_POST['addEducation']) || isset($_POST['saveEducation'])) {
        $userID = $_SESSION['user_id'];
        $resumeID = $_SESSION["resumeID"];
        $edutitle = $_POST['program'];
        $edudesc = $_POST['edudesc'];
        $company = $_POST['company'];
        $firstDate = $_POST['first_day'].'/'.$_POST['first_month'].'/'.$_POST['first_year'];
        $lastDate = $_POST['last_day'].'/'.$_POST['last_month'].'/'.$_POST['last_year'];
        $nieuweedutitle = new Education($edutitle, $edudesc, $company, $firstDate, $lastDate, $userID, $resumeID);
        $nieuweedutitle->verifyEducation();

    } elseif(isset($_POST['trashEducation'])) {
        $resumeID = $_SESSION['resumeID'];
        $userID = $_SESSION['user_id'];
    
        // Initialise the Multipurose trash class
        $multidelete = new MultiTrash($resumeID, $userID);
        $multidelete->multiTrash();
    
        // When trashing process completes, open the client environment MyResume.
        header('location: ../client.php'); 
    }