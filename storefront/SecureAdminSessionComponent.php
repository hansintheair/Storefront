<?php

// Redirect to login page if no no user session
if ($_SESSION["admin"] != 1) {
    header("Location: Home.php");
}