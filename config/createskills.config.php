<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
// Start a session for resume to userID assignment.
require 'peripherals/session_start.config.php';

require "idb.config.php";
require_once "Classes/createskills.class.config.php";

if (isset($_POST['addSkills'])){
    $userID = $_SESSION["user_id"];
    $resumeID = $_SESSION["resumeID"];
    $language = $_POST['language'];
    $interest = $_POST['interest'];
    $techtitle = $_POST['technical'];
    $nieuwelanguage = new Skills($language, $interest, $techtitle, $userID, $resumeID);
    $nieuwelanguage->Createskills();
    //    // Refresh client page.
    $_SESSION['success'] = 'Experience has been created.';
    header('location: ../client.php?');
    exit();

}
if (isset($_POST['addSkills'])){
    $userID = $_SESSION["user_id"];
    $resumeID = $_SESSION["resumeID"];
    $interest = $_POST['interest'];
    $techtitle = $_POST['technical'];
    $language = $_POST['language'];
    $nieuweinterest = new Skills($language, $interest, $techtitle,  $userID, $resumeID);
    $nieuweinterest->Createskills();
    //    // Refresh client page.
    $_SESSION['success'] = 'Experience has been created.';
    header('location: ../client.php?');
    exit();

}
if (isset($_POST['addSkills'])){
    $userID = $_SESSION["user_id"];
    $resumeID = $_SESSION["resumeID"];
    $techtitle = $_POST['technical'];
    $language = $_POST['language'];
    $interest = $_POST['interest'];
    $nieuwetechtitle = new Skills($language, $interest, $techtitle ,$userID, $resumeID);
    $nieuwetechtitle->Createskills();
    //    // Refresh client page.
    $_SESSION['success'] = 'Experience has been created.';
    header('location: ../client.php?');
    exit();

}
