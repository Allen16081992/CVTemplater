<?php
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
            if(!$this->emptyInput()) {
                // No username or password provided.
                $_SESSION['error'] = 'No username or password provided!';
            } elseif(!$this->emptyContact()) {
                // No values given for contact information.
                $_SESSION['error'] = 'No contact information provided!';
            } elseif(!$this->invalidUid()) {
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

        private function emptyInput() {
            // Make sure the submitted values are not empty.
            return !(empty($this->uid) || empty($this->passw) || empty($this->passwRepeat) || empty($this->email));
        }
        
        private function emptyContact() {
            // Make sure the submitted values are not empty.
            return !(empty($this->phone) || empty($this->firstname) || empty($this->lastname) || empty($this->birth) ||
                empty($this->country) || empty($this->street) || empty($this->postal) || empty($this->city));
        }
        
        private function invalidUid() {
            // Make sure the submitted values contain permitted characters.
            return preg_match("/^[a-zA-Z0-9]*$/", $this->uid);
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
?>