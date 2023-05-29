<?php // Dhr. Allen Pieter
    // Start a session for displaying error messages.
    session_start();

    class Account extends Database {
        protected function setAccount($uid, $email, $passw) {
            if(isset($_SESSION['user_id'])) {
                // Let's apply some hashing and salting security.
                $HashThisNOW = password_hash($passw, PASSWORD_DEFAULT);   
                $stmt = $this->connect()->prepare("UPDATE accounts SET username = ?, email = ?, password = ? WHERE userID = ?;");  

                // If this fails, kick back to homepage.
                if(!$stmt->execute(array($uid, $email, $HashThisNOW, $_SESSION['user_id']))) {
                    $stmt = null;
                    $_SESSION['error'] = 'Database query failed.';
                    header('location: ../account.php');
                    exit();
                } else {
                    // Error Messages by session instead of url parsing.
                    $_SESSION['success'] = 'Account Information saved';
                }
                $stmt = null;
            }
        }
    }

    class Address extends Database {
        protected function setAddress($street, $postal, $city, $country) {
            if(isset($_SESSION['user_id'])) {
                $stmt = $this->connect()->prepare("UPDATE contact SET streetname = ?, postalcode = ?, city = ?, nationality = ? WHERE userID = ?;");  

                // If this fails, kick back to homepage.
                if(!$stmt->execute(array($street, $postal, $city, $country, $_SESSION['user_id']))) {
                    $stmt = null;
                    $_SESSION['error'] = 'Database query failed.';
                    header('location: ../account.php');
                    exit();
                } else {
                    // Error Messages by session instead of url parsing.
                    $_SESSION['success'] = 'Address Information saved';
                }
                $stmt = null; 
            }
        }     
    }

    class Personal extends Database {
        protected function setPersonal($firstname, $lastname, $phone, $birth) {
            if(isset($_SESSION['user_id'])) {
                $stmt = $this->connect()->prepare("UPDATE contact SET firstname = ?, lastname = ?, phone = ?, birth = ? WHERE userID = ?;");  

                // If this fails, kick back to homepage.
                if(!$stmt->execute(array($firstname, $lastname, $phone, $birth, $_SESSION['user_id']))) {
                    $stmt = null;
                    $_SESSION['error'] = 'Database query failed.';
                    header('location: ../account.php');
                    exit();
                } else {
                    // Error Messages by session instead of url parsing.
                    $_SESSION['success'] = 'Account Information saved';
                }
                $stmt = null; 
            }
        }         
    }
?>