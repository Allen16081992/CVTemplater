<?php // Khaqan Ul Haq Awan
// Start a session for resume to userID assignment.
require 'peripherals/session_start.config.php';

require "idb.config.php";
require_once "Classes/createeducation.class.config.php";

// Verify if a new resume was submitted
if (isset($_POST['createEducation'])) {
    $edutitle = $_POST['edutitle'];
    $nieuweedutitle = new Education($_POST['edutitle'], $_POST['edudesc'], $_POST['company'], $_POST['firstDate'], $_POST['lastDate']);
    $nieuweedutitle->verifyEducation();

    // Refresh client page.
    //$_SESSION['success'] = 'The education has been created.';
    //header('location: ../client.php?');
    //exit();
}
?>