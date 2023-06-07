<?php
    if (!isset($_SESSION['user_id'])) {
        // Start a session to display error messages.
        session_start();
        $_SESSION['error'] = '401: Access denied. You must be signed in.';
        
        header('Location: ././index.php');
        exit;
    } else { $userID = $_SESSION['user_id']; }
?>