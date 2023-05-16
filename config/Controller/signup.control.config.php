<?php
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
            if($this->emptyInput() == false ) {
                // Empty input, no values given for account.
                header('location: ../index.html?error=emptyinput');
                exit();
            }
            if($this->emptyContact() == false ) {
                // Empty input, no values given for personal and contact info.
                header('location: ../index.html?error=emptyinput');
                exit();
            }
            if($this->invalidUid() == false) {
                // Invalid username.
                header('location: ../index.html?error=username');
                exit();              
            }
            if($this->invalidEmail() == false) {
                // Invalid emailaddress.
                header('location: ../index.html?error=email');
                exit();              
            }
            if($this->passwMatcher() == false) {
                // Passwords are not equal!
                header('location: ../index.html?error=password');
                exit();              
            }
            if($this->uidTakenVerify() == false) {
                // Username or email already taken.
                header('location: ../index.html?error=usernameOremailTaken');
                exit();              
            }

            $this->setUser(
                $this->uid, $this->passw, $this->email, 
                $this->phone, $this->firstname, $this->lastname, $this->country, 
                $this->birth, $this->street, $this->city, $this->postal
            );
        }

        private function emptyInput() {
            // Make sure the submitted values are not empty.
            if (empty($this->uid) || empty($this->passw) || empty($this->passwRepeat) || empty($this->email) ) {
                $report = false;
                // One or more values are empty.
            }
            else { $report = true; }
            return $report;
        }

        private function emptyContact() {
            // Make sure the submitted values are not empty.
            if (empty($this->phone) || empty($this->firstname) || empty($this->lastname) || empty($this->birth) || 
                empty($this->country) || empty($this->street) || empty($this->postal) || empty($this->city)) {
                $report = false;
                // One or more values are empty.
            }
            else { $report = true; }
            return $report;
        }

        private function invalidUid() {
            // Make sure the submitted values contain permitted characters.
            if (!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)) {
                $report = false;
            }
            else { $report = true; }
            return $report;
        }

        private function invalidEmail() {
            // Make sure the submitted values contain an @ character.
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $report = false;
            }
            else { $report = true; }
            return $report;
        }

        private function passwMatcher() {
            // Make sure the submitted values are equal.
            if ($this->passw !== $this->passwRepeat) {
                $report = false;
            }
            else { $report = true; }
            return $report;
        }

        private function uidTakenVerify() {
            if (!$this->verifyUser($this->uid, $this->email)) {
                $report = false;
            }
            else { $report = true; }
            return $report;
        }
    }
?>