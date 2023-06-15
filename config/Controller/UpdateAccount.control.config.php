<?php // Dhr. Allen Pieter
    // Start a session for displaying error messages.
    require '././peripherals/session_start.config.php';

    class UpdateAccount extends Account {
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
            if(!$this->emptyUser()) {
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

        private function emptyUser() {
            // Make sure the submitted value isn't empty.
            return !(empty($this->uid));
        }
        private function invalidUid() {
            // Make sure the submitted values contain permitted characters.
            return preg_match("/^[a-zA-Z0-9]*$/", $this->uid);
        }
        private function emptyEmail() {
            // Make sure the submitted value isn't empty.
            return !(empty($this->email));
        }
        private function invalidEmail() {
            // Make sure the submitted values contain an @ character.
            return filter_var($this->email, FILTER_VALIDATE_EMAIL);
        }
        private function emptyPassword() {
            // Make sure the submitted values aren't empty.
            return !(empty($this->passw) || empty($this->passwRepeat));
        }
        private function passwMatcher() {
            // Make sure the submitted values are equal.
            return $this->passw === $this->passwRepeat;
        }
    }

    class UpdateAddress extends Address {
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
                $_SESSION['error'] = 'No hometown provided.';               
            } elseif(!$this->emptyCountry()) {
                // No values given for contact information.
                $_SESSION['error'] = 'No nationality provided.';                
            } else {
                $this->setAddress($this->street, $this->postal, $this->city, $this->country);
            }
            header('location: ../account.php');          
            exit();
        }

        private function emptyStreet() {
            // Make sure the submitted value isn't empty.
            return !(empty($this->street));
        }
        private function emptyZip() {
            // Make sure the submitted value isn't empty.
            return !(empty($this->postal));
        }
        private function emptyCity() {
            // Make sure the submitted value isn't empty.
            return !(empty($this->city));
        }
        private function emptyCountry() {
            // Make sure the submitted value isn't empty.
            return !(empty($this->country));
        }
    }

    class UpdatePersonal extends Personal {
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
            } elseif(!$this->emptyNumber()) {
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

        private function emptyNames() {
            // Make sure the submitted values aren't empty.
            return !(empty($this->firstname) || empty($this->lastname));
        }
        private function emptyNumber() {
            // Make sure the submitted value isn't empty.
            return !(empty($this->phone));
        }
        private function emptyBirth() {
            // Make sure the submitted value isn't empty.
            return !(empty($this->birth));
        }
    }