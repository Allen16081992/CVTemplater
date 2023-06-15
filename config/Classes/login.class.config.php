<?php // Dhr. Allen Pieter
    // This session_start is solely for displaying error messages.
    require '././peripherals/session_start.config.php';

    class Login extends Database {

        // Verify if the user already exists in the database.
        protected function getUser($uid, $passw) {
            $stmt = $this->connect()->prepare('SELECT userID, password FROM accounts WHERE username = ? OR email = ?;');

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

            // If there was no match from the database, do this.
            $passHash = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['password'];
            if (!password_verify($passw, $passHash)) {
                $_SESSION['error'] = "Passwords don't match!";
                header('location: ../index.php');
                exit();
            }

            $stmt = $this->connect()->prepare('SELECT * FROM accounts WHERE username = ? OR email = ? AND password = ?;');

            // If this fails, stay on the homepage.
            if(!$stmt->execute(array($uid, $uid, $passw))) {
                $stmt = null;
                $_SESSION['error'] = 'Database query failed.';
                header('location: ../index.php');
                exit();
            }
            // If we received nothing, stay on the homepage.
            if($stmt->rowCount() == 0) {
                $stmt = null;
                $_SESSION['error'] = 'Database record not found.';
                header('location: ../index.php');
                exit();                   
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['user_id'] = $user[0]['userID'];
            $_SESSION['user_name'] = $user[0]['username'];
            $stmt = null;
        }
    }