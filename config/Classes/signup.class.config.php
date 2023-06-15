<?php // Dhr. Allen Pieter
    // This session_start is solely for displaying error messages.
    require '././peripherals/session_start.config.php';
    
    class Registration extends Database {

        // Verify if the user already exists in the database.
        protected function setUser($uid, $passw, $email, $phone,$firstname,$lastname,$birth,$country,$street,$postal,$city) {
            // Let's apply some hashing and salting security.
            //$random = (mt_rand(0,255)); // Generate a random number between 0 and... let's do 255.
            //$salty = array($random); // Set the number into an array for password_hash not to whine about having no array...
            $HashThisNOW = password_hash($passw, PASSWORD_DEFAULT);   
            $stmt = $this->connect()->prepare("INSERT INTO accounts (username, password, email) VALUES (?, ?, ?);");  

            // If this fails, kick back to homepage.
            if(!$stmt->execute(array($uid, $HashThisNOW, $email))) {
                $stmt = null;
                $_SESSION['error'] = 'Database query failed.';
                header('location: ../index.php');
                exit();
            }

            // The $stmtC is used for the contact table.
            $stmtC = $this->connect()->prepare('INSERT INTO contact (phone, firstname, lastname, birth, nationality, streetname, postalcode, city) VALUES (?, ?, ?, ?, ?, ?, ?, ?);');

            // If this fails, kick back to homepage.
            if(!$stmtC->execute(array($phone,$firstname,$lastname,$birth,$country,$street,$postal,$city))) {
                $stmtC = null;
                $_SESSION['error'] = 'Database query failed.';
                header('location: ../index.php');
                exit();
            }
            $stmt = null;
            $stmtC = null;
            $_SESSION['success'] = 'You have successfully registered.';
        }

        // Verify if the user already exists in the database.
        protected function verifyUser($uid, $email) {
            $stmt = $this->connect()->prepare('SELECT userID FROM accounts WHERE username = ? OR email = ?;');
            // If this fails, kick back to homepage.
            if(!$stmt->execute(array($uid, $email))) {
                $stmt = null;
                $_SESSION['error'] = 'Database query failed.';
                header('location: ../index.php');
                exit();
            }
            // If we got anything back from the database, do this.
            return $stmt->rowCount() === 0;
        }
    }