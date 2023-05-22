<?php
    // These variables are free to use by anything.
    if(isset($_POST['submit'])) {

        // Absorb the first part provided data from the registration form.
        $uid = $_POST['username']; 
        $passw = $_POST['pwd']; 

        // Initialise login class
        include "idb.config.php";
        include "Classes/login.class.config.php";
        include "Controller/login.control.config.php";

        $login = new loginControl($uid, $passw);

        // Error handlers inside
        $login->loginUser();

        // When loginUser() completed verification, open the client environment MyResume.
        header('Location: ../client.php');
    }
?>