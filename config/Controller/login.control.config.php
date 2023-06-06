<?php 
    // This session_start is solely for displaying error messages.
    require '././peripherals/session_start.config.php';

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
            if(!$this->emptyInput()) {
                // Empty input, no values given for account.
                $_SESSION['error'] = 'No username or password provided!';
                header('location: ../index.php');          
                exit();
            }
            $this->getUser($this->uid, $this->passw);
        }

        private function emptyInput() {
            // Check if the submitted values are not empty.
            return !(empty($this->uid) || empty($this->passw));
        }
    }
?>