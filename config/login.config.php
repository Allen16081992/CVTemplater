<?php // Dhr. Allen Pieter
    // These variables are free to use by anything.
    if(isset($_POST['submit'])) {

        // Absorb the first part provided data from the registration form.
        $uid = $_POST['username']; 
        $passw = $_POST['pwd']; 

        // Initialise login class
        require_once "idb.config.php"; // (improved) database connection.
        require_once "Classes/login.class.config.php";
        require_once "Controller/login.control.config.php";

        $login = new loginControl($uid, $passw);

        // Error handlers inside
        $login->loginUser();

        // When loginUser() completed verification, open the client environment MyResume.
        header('Location: ../client.php');
    }