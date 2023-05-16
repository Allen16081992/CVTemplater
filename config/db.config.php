<?php //Dhr. Allen Pieter 
    //A random class to apply some security measures...
    class Database {
        //Deny access from anywhere outside, unless they extend over this class.
        protected function connect() {
            try { //Try to run this code... Still using capitals since procedural habit.
                $DB_USER = "root"; 
                $DB_PASSWORD = "";
                $DB_HOST = new PDO('mysql:host=localhost;dbname=curriculumdb', $DB_USER, $DB_PASSWORD, 
                    //Set the charset to deny 'charset encoding injections' that could cause SQL injections with or without prepared statements.
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
                return $DB_HOST; 
                echo "<a>Connected!</a>";
            }
            catch (PDOException $e) { //If we catch an error by the crotch, yell it.
                print "Failed to Connect!: " . $e->getMessage() . "<br>";
                die(); //Give the connection an order to hang itself...
            }
        }
    }
?>