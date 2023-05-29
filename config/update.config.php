<?php // Dhr. Allen Pieter
    // Start a session for displaying error messages.
    session_start();

    // Initialise update class
    include "idb.config.php";
    include "Classes/update.class.config.php";
    include "Controller/update.control.config.php";

    if(isset($_POST['saveAccount'])) {
        // Absorb this provided data.
        $uid = $_POST['username'];
        $email = $_POST['email'];
        $passw = $_POST['pwd'];
        $passwRepeat = $_POST['pwdR'];

        $update = new UpdateAccount($uid, $email, $passw, $passwRepeat);
        $update->verifyAccount();

    } elseif(isset($_POST['saveBook'])) {
        // Absorb this provided data.
        $street = $_POST['streetname'];
        $postal = $_POST['postalcode'];
        $city = $_POST['city'];
        $country = $_POST['nationality'];

        $update = new UpdateAddress($street, $postal, $city, $country);
        $update->verifyAddress();

    } elseif(isset($_POST['savePersonal'])) {
        // Absorb this provided data.
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $birth = $_POST['birth'];

        $update = new UpdatePersonal($firstname, $lastname, $phone, $birth);
        $update->verifyPersonal();

    }
    // Refresh account page.
    header('location: ../account.php?');
    exit();
?>