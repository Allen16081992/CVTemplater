<?php // Dhr. Allen Pieter
    // Start a session for displaying error messages.
    require_once '././peripherals/session_start.config.php';
    require_once 'errorhandlers.control.config.php';

    class UpdateAccount extends Account {
        use ErrorHandlers;
        // Account info
        private $uid;
        private $email;
        private $passw;
        private $passwRepeat;

        public function __construct($uid, $email, $passw, $passwRepeat) {
            $this->uid = $uid;
            $this->email = $email;
            $this->passw = $passw;
            $this->passwRepeat = $passwRepeat;
        }

        public function verifyAccount() {
            if(!$this->emptyUsername()) {
                // No username or password provided.
                $_SESSION['error'] = 'No username provided.';
            } elseif(!$this->invalidUid()) {
                // Invalid username.
                $_SESSION['error'] = 'Only characters from A-Z and 0-9 allowed.';                
            } elseif(!$this->emptyEmail()) {
                // No username or password provided.
                $_SESSION['error'] = 'No email provided.';
            } elseif(!$this->invalidEmail()) {
                // Invalid emailaddress.
                $_SESSION['error'] = 'Please enter a valid email address.';
            } elseif(!$this->passwMatcher() && !empty($this->passw)) {
                // Passwords aren't equal.
                $_SESSION['error'] = "Passwords aren't the same.";
            } else { 
                $this->setAccount($this->uid, $this->email, $this->passw); 
            }
            header('location: ../account.php');          
            exit();
        }
    }

    class UpdateAddress extends Address {
        use ErrorHandlers;
        private $street;
        private $postal;
        private $city;
        private $country;

        public function __construct($street, $postal, $city, $country) {
            $this->street = $street;         
            $this->postal = $postal;
            $this->city = $city;
            $this->country = $country;
        }

        public function verifyAddress() {
            if(!$this->emptyStreet()) {
                // No street info provided.
                $_SESSION['error'] = 'No streetname provided.';
            } elseif(!$this->emptyZip()) {
                // No values given for contact information.
                $_SESSION['error'] = 'No zip code provided.';
            } elseif(!$this->emptyCity()) {
                // No values given for contact information.
                $_SESSION['error'] = 'No city provided.';               
            } elseif(!$this->emptyCountry()) {
                // No values given for contact information.
                $_SESSION['error'] = 'No country or nationality provided.';                
            } else {
                $this->setAddress($this->street, $this->postal, $this->city, $this->country);
            }
            header('location: ../account.php');          
            exit();
        }
    }

    class UpdatePersonal extends Personal {
        use ErrorHandlers;
        private $firstname;
        private $lastname;
        private $phone;
        private $birth;

        public function __construct($firstname, $lastname, $phone, $birth) {
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->phone = $phone;
            $this->birth = $birth;
        }

        public function verifyPersonal() {
            if(!$this->emptyNames()) {
                // No name or surname provided.
                $_SESSION['error'] = 'No firstname or surname provided.';
            } elseif(!$this->emptyPhone()) {
                // No phone provided.
                $_SESSION['error'] = 'No phone number provided.';               
            } elseif(!$this->emptyBirth()) {
                // No birthday provided.
                $_SESSION['error'] = 'No birthday provided.';                    
            } else {
                $this->setPersonal($this->firstname, $this->lastname, $this->phone, $this->birth);
            }
            header('location: ../account.php');          
            exit();
        }
    }