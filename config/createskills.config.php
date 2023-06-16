<?php // Khaqan
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
// Start a session for resume to userID assignment.
require 'peripherals/session_start.config.php';

require "idb.config.php";
require_once "Classes/createskills.class.config.php";

if (isset($_POST['addSkill'])){
    $language = $_POST['language'];
    $interest = $_POST['interest'];
    $techtitle = $_POST['technical'];
    $resumeID = $_SESSION["resumeID"];
    $userID = $_SESSION["user_id"];
    $nieuwelanguage = new Skills($interest, $language, $techtitle, $resumeID, $userID);
    $nieuwelanguage->Createskills();

    //    // Refresh client page.
    $_SESSION['success'] = 'Experience has been created.';
    header('location: ../client.php?');
    exit();
}