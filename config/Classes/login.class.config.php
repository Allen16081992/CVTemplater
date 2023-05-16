<?php
    class Login extends Database {

        // Verify if the user already exists in the database.
        protected function getUser($uid, $passw) {
            $stmt = $this->connect()->prepare('SELECT userID, password FROM accounts WHERE username = ? OR email = ?;');

            // If this fails, kick back to homepage.
            if(!$stmt->execute(array($uid, $passw))) {
                $stmt = null;
                header('location: ../index.html?error=failed');
                exit();
            }

            // If we got nothing from the database, do this.
            if($stmt->rowCount() == 0 ) {
                $stmt = null;
                header('location: ../index.html?error=usernotfound');
                exit();
            }

            // If we got something from the database, verify the hash.
            if ($stmt->rowCount() > 0) {
                $passHash = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (!password_verify($passw, $passHash[0]['password'])) {
                    $passHash = false; 
                }
                else { $passHash = true; }
            }

            // If there was no match from the database, do this.
            if($passHash == false) {
                $stmt = null;
                header('location: ../index.html?error=NoMatch');
                exit();
            }
            elseif($passHash == true) {
                $stmt = $this->connect()->prepare('SELECT * FROM accounts WHERE username = ? OR email = ? AND password = ?;');

                // If this fails, stay on the homepage.
                if(!$stmt->execute(array($uid, $uid, $passw))) {
                    $stmt = null;
                    header('location: ../index.html?error=failed');
                    exit();
                }
                // If we received nothing, stay on the homepage.
                if($stmt->rowCount() == 0) {
                    $stmt = null;
                    header('location: ../index.html?error=failed');
                    exit();                   
                }

                $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
                session_start();
                $_SESSION['user_id'] = $user[0]['userID'];
                $_SESSION['user_name'] = $user[0]['username'];
                $stmt = null;
            }
            $stmt = null;
        }

    }
?>