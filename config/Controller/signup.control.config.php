<?php // Dhr. Allen Pieter
    // This session_start is solely for displaying error messages.
    require_once '././peripherals/session_start.config.php';
    require_once 'errorhandlers.control.config.php';

    class RegistrateControl extends Registration {
        use ErrorHandlers;
        // Account info
        private $uid;
        private $passw;
        private $passwRepeat;
        private $email;
        // Contact info
        private $phone;
        private $firstname;
        private $lastname;
        private $country;
        private $birth;
        private $street;
        private $city;
        private $postal;

        public function __construct($uid, $passw, $passwRepeat, $email, $phone,$firstname,$lastname,$country,$birth,$street,$city,$postal) {
            // Part 1 of registration
            $this->uid = $uid;
            $this->passw = $passw;
            $this->passwRepeat = $passwRepeat;
            $this->email = $email;
            // Part 2 of registration
            $this->phone = $phone;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->country = $country;
            $this->birth = $birth;
            $this->street = $street;
            $this->city = $city;
            $this->postal = $postal;
        }

        public function signupUser() {
            if(!$this->emptyNames()) {
                // No firstname or lastname provided.
                $_SESSION['error'] = 'No firstname or lastname provided.';
            } elseif(!$this->emptyCountry()) {
                // No country information provided.
                $_SESSION['error'] = 'No country or nationality provided.';
            } elseif(!$this->emptyBirth()) {
                // No country information provided.
                $_SESSION['error'] = 'No country or nationality provided.';
            } elseif(!$this->emptyPhone()) {
                // No phone information provided.
                $_SESSION['error'] = 'No phone number provided.';
            } elseif(!$this->emptyStreet()) {
                // No street information provided.
                $_SESSION['error'] = 'No street provided.';
            } elseif(!$this->emptyZip()) {
                // No street information provided.
                $_SESSION['error'] = 'No zip code provided.';
            } elseif(!$this->emptyCity()) {
                // No city information provided.
                $_SESSION['error'] = 'No city provided.';
            } elseif(!$this->emptyUsername()) {
                // No username information provided.
                $_SESSION['error'] = 'No username provided.';
            } elseif(!$this->emptyEmail()) {
                // No email information provided.
                $_SESSION['error'] = 'No email provided.';
            } elseif(!$this->emptyPasswords()) {
                // No passwords information provided.
                $_SESSION['error'] = 'No password(s) provided.';
            } elseif(!$this->invalidAlpha()) {
                // Invalid username.
                $_SESSION['error'] = 'Only alphanumeric characters allowed!';
            } elseif(!$this->invalidEmail()) {
                // Invalid emailaddress.
                $_SESSION['error'] = 'Please enter a valid email address!';
            } elseif(!$this->passwMatcher()) {
                // Passwords are not equal!
                $_SESSION['error'] = "Passwords don't match!";
            } elseif(!$this->uidTakenVerify()) {
                // Username or email already taken.
                $_SESSION['error'] = "This username/email is already used!";
            } else {
                $this->setUser(
                    $this->uid, $this->passw, $this->email, 
                    $this->phone, $this->firstname, $this->lastname, $this->country, 
                    $this->birth, $this->street, $this->city, $this->postal
                );
            }       
            header('location: ../index.php');
            exit();
        }
    }