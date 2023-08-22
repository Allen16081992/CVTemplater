<?php // Khaqan
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
// Start a session for resume to userID assignment.
require_once 'peripherals/session_management.config.php';

// Initialise update class
require_once "idb.config.php";
require_once "Classes/updateresume.class.config.php";

if (isset($_POST['saveResume']) && isset($_SESSION['resumeID'])) {
    $resid = $_POST['resid']; // Dhr. Allen Pieter: een cv id is wel nodig.
    $resumetitle = $_POST['cvname'];
    $userID = $_SESSION["user_id"];
    $nieuweresume = new updateResume($resid, $resumetitle);
    $nieuweresume->verifyResume();
} else {
    // No resume selected.
    $_SESSION['error'] = 'You should create a resume first.';
    header('location: ../client.php');              
}
