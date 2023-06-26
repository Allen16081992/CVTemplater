<?php // Khaqan
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
// Start a session for resume to userID assignment.
require_once 'peripherals/session_start.config.php';
// Use the (improved) database connection.
require_once "idb.config.php";
require_once "Classes/technical.skills.class.config.php";
require_once "Classes/TrashTables.class.config.php";

if (isset($_POST['addSkill'])){
    $language = $_POST['language'];
    $interest = $_POST['interest'];
    $techtitle = $_POST['technical'];
    $resumeID = $_SESSION["resumeID"];
    $userID = $_SESSION["user_id"];
    $nieuwelanguage = new Skills($interest, $language, $techtitle, $resumeID, $userID);
    $nieuwelanguage->verifySkills();

    // Refresh client page.
    $_SESSION['success'] = 'Skills has been created.';
    header('location: ../client.php?');
    exit();
} elseif (isset($_POST['saveSkill'])){
    $language = $_POST['language'];
    $interest = $_POST['interest'];
    $techtitle = $_POST['technical'];
    $resumeID = $_SESSION["resumeID"];
    $userID = $_SESSION["user_id"];
    $nieuwelanguage = new Skills($interest, $language, $techtitle, $resumeID, $userID);
    $nieuwelanguage->verifySkills();

    // Refresh client page.
    $_SESSION['success'] = 'Skills has been updated.';
    header('location: ../client.php?');
    exit();
} elseif(isset($_POST['trashSkill'])) {
    $resumeID = $_SESSION['resumeID'];
    $userID = $_SESSION['user_id'];

    // Initialise the Multipurose trash class
    $multidelete = new MultiTrash($resumeID, $userID);
    $multidelete->multiTrash();

    // When trashing process completes, open the client environment MyResume.
    header('location: ../client.php');
    exit();   
}