<?php
    //extend influence to puppeteer
    class purgeControl extends Purge {
        // Account info
        private $uid;
        private $passw; 

        public function __construct($uid, $passw) {
            // Part 1 of registration data.
            $this->uid = $uid;
            $this->passw = $passw;
        }

        public function purgeUser() {
            // Activate the private function beneath.
            if($this->emptyInput() == false ) {
                // Empty input, no values given for account.
                header('location: ../account.php?error=emptyinput');               
                exit();
            }
            $this->deleteUser($this->uid, $this->passw);
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

    // You are free to create a new class with 'Error Validations' for Delete, or build upon the Class Purge.
    // For Delete functions that involve the database, place these in the folder Classes if you are not making the CRUD folder.
    // If you like, you may create new CRUD folder inside config (if that doesn't exist) for all CRUD related stuff...
?>