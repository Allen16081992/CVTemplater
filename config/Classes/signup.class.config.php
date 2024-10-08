<?php // Dhr. Allen Pieter
    // This session_start is solely for displaying error messages.
    require_once '././peripherals/session_management.config.php';
    
    class Registration extends Database {

        // Verify if the user already exists in the database.
        protected function setUser($uid, $passw, $email, $phone,$firstname,$lastname,$birth,$country,$street,$postal,$city) {

            // Now generate a unique salt.
            $salt = bin2hex(random_bytes(16));

            // Add a defensive delay against bruto-force attacks, updating PASSWORD_DEFAULT.
            $seal = [ 'cost' => 12 ];

            // Let's apply some hashing and salting security.
            $HashThisNOW = password_hash($passw.$salt, PASSWORD_BCRYPT, $seal);

            // Insert user into the accounts table
            $stmt = $this->connect()->prepare("INSERT INTO accounts (username, password, email, salt) VALUES (?, ?, ?, ?);");  

            // If this fails, kick back to homepage.
            if(!$stmt->execute(array($uid, $HashThisNOW, $email, $salt))) {
                $stmt = null;
                $_SESSION['error'] = 'Database query failed.';
                header('location: ../index.php');
                exit();
            }

            // Immediately grab the newly generated userID like thunder strike
            $stmtB = $this->connect()->prepare('SELECT userID FROM accounts WHERE username = ? AND email = ?;');
            $stmtB->execute([$uid, $email]);
            $userID = $stmtB->fetchColumn();

            if (!$userID) {
                // Handle the case where userID is not found
                $stmtB = null;
                $_SESSION['error'] = 'Failed to retrieve userID.';
                header('location: ../index.php');
                exit();
            }

            // Insert contact information into the contact table
            $stmtC = $this->connect()->prepare('INSERT INTO contact (phone, firstname, lastname, birth, country, streetname, postalcode, city, userID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);');

            if (!$stmtC->execute(array($phone, $firstname, $lastname, $birth, $country, $street, $postal, $city, $userID))) {
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