<?php // Turned into a requirement for file inclusion. 
    // Bypasses the server warning: 'ignoring session_start() because a session is already active'.
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
?>