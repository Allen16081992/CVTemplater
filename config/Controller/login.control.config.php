<?php // Dhr. Allen Pieter
    // This session_start is solely for displaying error messages.
    require_once '././peripherals/session_start.config.php';
    require_once 'errorhandlers.control.config.php';

    //extend influence
    class loginControl extends Login {
        use ErrorHandlers;
        // Account info
        private $uid;
        private $passw;

        public function __construct($uid, $passw) {
            // Part 1 of registration data.
            $this->uid = $uid;
            $this->passw = $passw;
        }

        public function loginUser() {
            // Activate security function beneath.
            if(!$this->emptyUsername()) {
                // Empty input, no values given for account.
                $_SESSION['error'] = 'No username or password provided!';
                header('location: ../index.php');          
                exit();
            } elseif(!$this->emptyPassw()) {
                // No passwords information provided.
                $_SESSION['error'] = 'No password provided.';
                header('location: ../index.php');          
                exit();
            } else { $this->getUser($this->uid, $this->passw); }
        }
    }