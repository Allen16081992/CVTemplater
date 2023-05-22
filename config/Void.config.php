<?php
include 'functioniser.php';

class Crusified {
    private $pdo;
    
    public function __construct() {
        $database = new Database();
        $this->pdo = $database->pdo_connect();
    }
    
    public function deleteUser() {
        // Check that the user ID exists
        if (isset($_POST['user_id'])) {
            // Select the record that is to be 'crucified'
            $stmt = $this->pdo->prepare('SELECT * FROM accounts WHERE userID = ?');
            $stmt->execute([$_POST['user_id']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$user) {
                $user = null;
                header('location: ../account.php?error=usernotfound');
                exit();
            }
            // Make sure the user confirms before deletion
            if (isset($_POST['delete'])) {
                $stmt = $this->pdo->prepare('DELETE FROM accounts WHERE userID = ?');
                $stmt->execute([$_POST['user_id']]);
                $stmt = null;
                header('Location: ../index.html?report=deletedDone');
                exit;
            }
        }
    }
}

$void = new Crusified();
$void->deleteUser();
