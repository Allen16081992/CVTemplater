<?php // Khaqan
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
// Start a session for resume to userID assignment.
require_once 'peripherals/session_management.config.php';
// Use the (improved) database connection.
require_once "idb.config.php";
require_once "Classes/technical.class.php";
require_once "Classes/TrashTables.class.config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $technical = htmlspecialchars($_POST['technical']);
    $language = htmlspecialchars($_POST['language']);
    $interest = htmlspecialchars($_POST['interest']);
    $resumeID = $_SESSION["resumeID"];
    $userID = $_SESSION["user_id"];

    if (isset($_POST['addSkill'])){
        // Initialise the Multipurose trash class
        $nt = new Technicals($technical, $language, $interest, $resumeID, $userID);
        $nt->Createskills();
    
    } elseif (isset($_POST['saveSkill'])){
        // Initialise the Multipurose trash class
        $nt = new Technicals($technical, $language, $interest, $resumeID, $userID);
        $nt->Updateskills();
    
    } elseif(isset($_POST['trashSkill'])) {
        // Initialise the Multipurose trash class
        $multidelete = new MultiTrash($resumeID, $userID);
        $multidelete->multiTrash();
    
        // When trashing is completed, open the client environment MyResume.
        header('location: ../client.php');  
    }
}