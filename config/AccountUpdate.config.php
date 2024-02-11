<?php // Dhr. Allen Pieter
    // Start a session for displaying error messages.
    require_once 'peripherals/session_management.config.php';

    // Initialise update class
    require_once "idb.config.php";
    require_once "Classes/UpdateAccount.class.config.php";
    require_once "Controller/UpdateAccount.control.config.php";

    if(isset($_POST['saveAccount'])) {
        // Absorb this provided data.
        $uid = $_POST['username'];
        $email = $_POST['email'];
        $passw = $_POST['pwd'];
        $passwRepeat = $_POST['pwdR'];

        $update = new UpdateAccount($uid, $email, $passw, $passwRepeat);
        $update->verifyAccount(); // Error handlers

    } elseif(isset($_POST['saveBook'])) {
        // Absorb this provided data.
        $street = $_POST['streetname'];
        $postal = $_POST['postalcode'];
        $city = $_POST['city'];
        $country = $_POST['nationality'];

        $update = new UpdateAddress($street, $postal, $city, $country);
        $update->verifyAddress(); // Error handlers

    } elseif(isset($_POST['savePersonal'])) {
        // Absorb this provided data.
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $birth = $_POST['day'].'/'.$_POST['month'].'/'.$_POST['year'];

        $update = new UpdatePersonal($firstname, $lastname, $phone, $birth);
        $update->verifyPersonal(); // Error handlers

    }
    // Refresh account page.
    header('location: ../account.php?');
    exit();