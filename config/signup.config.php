<?php // Dhr. Allen Pieter
    // These variables are free to use by anything.
    if(isset($_POST['submit'])) {
        
        // Absorb data in the first step of the registration form
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        // Absorb data in the second step
        $country = $_POST['nationality'];
        $birth = $_POST['day'].'/'.$_POST['month'].'/'.$_POST['year'];
        // Absorb data in the third step
        $phone = $_POST['phone'];
        $street = $_POST['streetname'];
        // Absorb data in the fourth step
        $postal = $_POST['postalcode'];
        $city = $_POST['city'];
        // Absorb data in the fifth step
        $uid = $_POST['username']; 
        $email = $_POST['email']; 
        // Absorb data in the sixth and last step
        $passw = $_POST['pwd']; 
        $passwRepeat = $_POST['pwdR']; 
        
        // Initialise signup class
        require_once "idb.config.php";
        require_once "Classes/signup.class.config.php";
        require_once "Controller/signup.control.config.php";

        $registrate = new RegistrateControl($uid, $passw, $passwRepeat, $email, $phone,$firstname,$lastname,$birth,$country,$street,$postal,$city);

        // Error handlers
        $registrate->signupUser();

        // Dismiss to homepage
        header('location: ../index.php');
        exit();
    }