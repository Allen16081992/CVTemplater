<?php // Dhr. Allen Pieter
    trait ErrorHandlers {

        private function emptyNames() {
            // Make sure the submitted values are not empty.
            return !(empty($this->firstname) || empty($this->lastname));
        }

        private function emptyCountry() {
            // Make sure the submitted values are not empty.
            return !(empty($this->country));
        }

        private function emptyBirth() {
            // Make sure the submitted value isn't empty.
            return !(empty($this->birth));
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

        private function emptyResumetitle() {
            // Check if the submitted values are not empty.
            return !(empty($this->resumetitle));
        }

        private function emptyInterest() {
            // Check if the submitted values are not empty.
            return !(empty($this->interest));
        }

        private function emptyLanguage() {
            // Check if the submitted values are not empty.
            return !(empty($this->language));
        }

        private function emptyTech() {
            // Check if the submitted values are not empty.
            return !(empty($this->techtitle));
        }

        private function emptyPassw() {
            // Make sure the submitted values are not empty.
            return !(empty($this->passw));
        }

        private function emptyPasswords() {
            // Make sure the submitted values are not empty.
            return !(empty($this->passw) || empty($this->passwRepeat));
        }

        private function invalidUid() {
            // Make sure the submitted values contain permitted characters.
            return preg_match("/^[a-zA-Z0-9]*$/", $this->uid);
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

        // Beta (improved) emptyInputs method
        public function emptyInputs($value, $fieldName, $form) {
            if (empty($value)) {
                $_SESSION['error'] = "No $fieldName provided.";

                // Define and map forms to redirect locations
                $redirect = [
                    'login' => '../index.php',
                    'signup' => '../signup.php',
                    'resume' => '../client.php',
                    // Add more field names and corresponding redirect locations
                ];
                
                // Redirect based on the $fieldName, or use a default location
                $redirect = isset($redirect[$form])
                    ? $redirect[$form]
                    : '../error404.php';
                
                header("location: $redirect");
                exit();
            }
        }
    }