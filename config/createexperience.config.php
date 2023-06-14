<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
// Start a session for resume to userID assignment.
require 'peripherals/session_start.config.php';

require "idb.config.php";
require_once "Classes/createexperience.class.config.php";

// Verify if a new resume was submitted
if (isset($_POST['addExperience'])) {
    $userID = $_SESSION['user_id'];
    $resumeID = $_SESSION["resumeID"];
    $worktitle = $_POST['worktitle'];
    $nieuweworktitle = new Experience($worktitle, $_POST['workdesc'], $_POST['company'], $_POST['from'], $_POST['until'], $userID, $resumeID );
    $nieuweworktitle->Createexperience();

//    // Refresh client page.
    $_SESSION['success'] = 'Experience has been created.';
    header('location: ../client.php?');
    exit();
}
