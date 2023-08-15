<?php // Dhr. Allen Pieter
    // This session_start is solely for displaying error messages.
    require_once '././peripherals/session_start.config.php';

    class Login extends Database {

        // Verify if the user already exists in the database.
        protected function getUser($uid, $passw) {
            $stmt = $this->connect()->prepare('SELECT userID, password, salt FROM accounts WHERE username = ? OR email = ?;');

            // If this fails, kick back to homepage.
            if(!$stmt->execute(array($uid, $passw))) {
                $stmt = null;
                $_SESSION['error'] = 'User verification failed!';
                header('location: ../index.php');
                exit();
            }

            // If we got nothing from the database, do this.
            if($stmt->rowCount() == 0 ) {
                $stmt = null;
                $_SESSION['error'] = 'Unable to find User!';
                header('location: ../index.php');
                exit();
            }

            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            // If there was no match from the database, do this.
            if(!$userData) {
                $_SESSION['error'] = 'Unable to find User!';
                header('location: ../index.php');
                exit();
            }

            $passHash = $userData['password'];
            $salt = $userData['salt'];

            if (!password_verify($passw . $salt, $passHash)) {
                $_SESSION['error'] = "Incorrect password.";
                header('location: ../index.php');
                exit();
            }
            
            $_SESSION['user_id'] = $userData['userID'];
            $_SESSION['user_name'] = htmlspecialchars($userData['username']);
            $stmt = null;
        }
    }