<?php
    session_start();
    
    // Redirect to login page if no no user session
    if (!isset($_SESSION["user_id"])) {
        header("Location: Home.php");
    }
