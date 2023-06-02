<?php
// Start a session for resume to userID assignment.
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 'On');
include_once "resume.class.config.php";

// Als het formulier is verzonden
if (isset($_POST['creResume'])) {
    $nieuweresume = new resume($_POST['cv-name']);
    $nieuweresume->Create();
}
// Ga terug naar account page.
$_SESSION['success'] = 'The resume has been created.';
header('location: ../../client.php?');
exit();
?>



