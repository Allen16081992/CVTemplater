<?php// Loubna Faress

// use the (improved) database connection.
include 'idb.config.php';

// Start a session to destroy, and for displaying error messages.
session_start();

// These variables are free to use by anything.
$_POST['pwd']; 

class deleteResume {
    private $pdo;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->connect();
    }

    public function deleteUser() {
      // Verify if the user ID exists
      if (isset($_POST['user_id'])) {

        // Select the record that is to be 'deleteResume'

      }  
    }
}