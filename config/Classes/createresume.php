<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
include_once "resume.class.config.php";

// Als het formulier is verzonden
if (isset($_POST['creResume'])) {
    $nieuweresume = new resume($_POST['cv-name']);
    $nieuweresume->Create();
}
?>



