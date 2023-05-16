<?php
    class Purge extends Database {

        // Verify if the user already exists in the database.
        protected function deleteUser($uid, $passw) {
            $stmt = $this->connect()->prepare('SELECT userID FROM accounts WHERE password = ?;');

            // If this fails, kick back to account.
            if(!$stmt->execute(array($uid, $passw))) {
                $stmt = null;
                header('location: ../account.php?error=failed');
                exit();
            }

            // If we got nothing from the database, do this.
            if($stmt->rowCount() == 0 ) {
                $stmt = null;
                header('location: ../account.php?error=usernotfound');
                exit();
            }

            // If we got something from the database, verify the hash.
            if ($stmt->rowCount() > 0) {
                $passHash = $stmt->fetchAll(PDO::FETCH_ASSOC);
                password_verify($passw, $passHash[0]['password']);
            }

            // If there was no match from the database, do this.
            if($passHash == false) {
                $stmt = null;
                header('location: ../account.php?error=NoMatch');
                exit();
            }
            elseif($passHash == true) {
                // If it matches, delete the row.
                $stmt = $this->connect()->prepare('DELETE FROM accounts WHERE userID = "'.$uid.'"');
                $stmt->bind_param("userID", $uid);
                $stmt->execute();
                $stmt = null;
            }
            $stmt = null;
        }
    }
?>