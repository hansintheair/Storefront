<?php
    include "SecureSession.php";
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>User Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="navbar.css">
    </head>
    
    <body>
        
        <?php include 'UserNavbar.php';?>
        <script>
            document.getElementsByClassName("searchbar")[0].style.display = "none";
            document.getElementsByClassName("cart")[0].style.display = "none";
            document.getElementsByClassName("orders")[0].style.display = "none";
        </script>
        
        
    </body>
    
</html>