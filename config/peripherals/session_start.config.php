<?php // Dhr. Allen Pieter 
    // Bypasses the server warning: 'ignoring session_start() because a session is already active'.
    if(!isset($_SESSION)) { 
        session_start(); 
    }