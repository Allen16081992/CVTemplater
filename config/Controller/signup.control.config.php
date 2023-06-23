<?php // Dhr. Allen Pieter
    // This session_start is solely for displaying error messages.
    require '././peripherals/session_start.config.php';

    class RegistrateControl extends Registration {
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
            } elseif(!$this->emptyPassw()) {
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

        private function emptyNames() {
            // Make sure the submitted values are not empty.
            return !(empty($this->firstname) || empty($this->lastname));
        }
        private function emptyCountry() {
            // Make sure the submitted values are not empty.
            return !(empty($this->country) || empty($this->birth));
        }
        private function emptyPhone() {
            // Make sure the submitted values are not empty.
            return !(empty($this->phone));
        }
        private function emptyStreet() {
            // Make sure the submitted values are not empty.
            return !(empty($this->street));
        }
        private function emptyZip() {
            // Make sure the submitted values are not empty.
            return !(empty($this->postal));
        }
        private function emptyCity() {
            // Make sure the submitted values are not empty.
            return !(empty($this->city));
        }
        private function emptyUsername() {
            // Make sure the submitted values are not empty.
            return !(empty($this->uid));
        }
        private function emptyEmail() {
            // Make sure the submitted values are not empty.
            return !(empty($this->email));
        }
        private function emptyPassw() {
            // Make sure the submitted values are not empty.
            return !(empty($this->passw) || empty($this->passwRepeat));
        }
        private function invalidAlpha() {
            // Make sure the submitted values contain permitted characters.
            return !(
                preg_match("/^[a-zA-Z0-9]*$/", $this->uid) &&
                preg_match("/^[a-zA-Z0-9]*$/", $this->phone) &&
                preg_match("/^[a-zA-Z0-9]*$/", $this->street) &&
                preg_match("/^[a-zA-Z0-9]*$/", $this->postal) &&
                preg_match("/^[a-zA-Z0-9]*$/", $this->firstname) &&
                preg_match("/^[a-zA-Z0-9]*$/", $this->lastname) &&
                preg_match("/^[a-zA-Z0-9]*$/", $this->country) &&
                preg_match("/^[a-zA-Z0-9]*$/", $this->city)
            );
        }     
        private function invalidEmail() {
            // Make sure the submitted values contain an @ character.
            return filter_var($this->email, FILTER_VALIDATE_EMAIL);
        }      
        private function passwMatcher() {
            // Make sure the submitted values are equal.
            return $this->passw === $this->passwRepeat;
        }        
        private function uidTakenVerify() {
            // Make sure the submitted values aren't in use.
            return $this->verifyUser($this->uid, $this->email);
        }       
    }