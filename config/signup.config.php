<?php
    // These variables are free to use by anything.
    if(isset($_POST['submit'])) {

        // Absorb the first part provided data from the registration form.
        $uid = $_POST['username']; 
        $passw = $_POST['pwd']; 
        $passwRepeat = $_POST['pwdR']; 
        $email = $_POST['email']; 

        // Absorb the rest of the provided data from the registration form.
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $country = $_POST['nationality'];
        $birth = $_POST['birth'];
        $street = $_POST['streetname'];
        $city = $_POST['city'];
        $postal = $_POST['postalcode'];
        $phone = $_POST['phone'];

        // Initialise signup class
        include "idb.config.php";
        include "Classes/signup.class.config.php";
        include "Controller/signup.control.config.php";

        $registrate = new RegistrateControl($uid, $passw, $passwRepeat, $email, $phone,$firstname,$lastname,$birth,$country,$street,$postal,$city);

        // Error handlers
        $registrate->signupUser();

        // Dismiss to homepage
        header('location: ../index.php?error=none');
    }
?>