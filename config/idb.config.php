<?php
    // Database Configuration
    include_once 'config.php';
    
    class Database {
        public function connect() {
            try { //Try to run this.
                $DB_HOST = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD,
                    //SET this to deny 'charset encoding injections' that could cause SQL injections with or without prepared statements.
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
                );
                return $DB_HOST;
            } catch (PDOException $e) {
                // Log the exception details
                error_log("Failed to connect to the database: " . $e->getMessage(), 0);
                // Throw a custom exception with a user-friendly message
                throw new Exception("Failed to connect to the database. MySQL may have crashed.");
            }
        }
    }
?>