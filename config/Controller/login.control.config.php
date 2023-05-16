<?php
    //extend influence to puppeteer
    class loginControl extends Login {
        // Account info
        private $uid;
        private $passw;

        public function __construct($uid, $passw) {
            // Part 1 of registration data.
            $this->uid = $uid;
            $this->passw = $passw;
        }

        public function loginUser() {
            // Activate the private function beneath.
            if($this->emptyInput() == false ) {
                // Empty input, no values given for account.
                header('location: ../index.php?error=emptyinput');          
                exit();
            }
            $this->getUser($this->uid, $this->passw);
        }

        private function emptyInput() {
            // Make sure the submitted values are not empty.
            if (empty($this->uid) || empty($this->passw)) {
                $report = false;
                // One or more values are empty.
                //exit('Please complete the registration form');
            }
            else { $report = true; }
            return $report;
        }
    }
?>