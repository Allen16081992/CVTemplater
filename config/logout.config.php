<?php
    // These variables are free to use by anything.
    if(isset($_POST['delete'])) {  
        // Absorb the session data and the confirmed password.    
        $uid = $user[0]['userID'];
        $passw = $_POST['pwd']; 

        // Initialise delete class
        include "db.config.php";
        include "Classes/delete.class.config.php";
        include "Controller/delete.control.config.php";

        $purge = new purgeControl($uid, $passw);

        // Error handlers inside
        $purge->purgeUser();

        // When purgeUser() is completed, execute the steps below.
    }

    // Wipe everything related to the session.
    session_start();
    session_unset();
    session_destroy();
    // Push back to homepage.
    header('location:../index.html');
?>