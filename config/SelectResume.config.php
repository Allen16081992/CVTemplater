<?php // Dhr. Allen Pieter
    // Start a session for displaying error messages.
    require '././peripherals/session_start.config.php';

    // Verify if a resume was selected. These variables are free to use by anything.
    if (isset($_POST['selectCv'])) {

        // Absorb the provided data from the client.
        $targetID = $_POST['selectCv'];
        $userID = $_SESSION['user_id'];

        // Initialise login class
        require "idb.config.php";


    }
?>