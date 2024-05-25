<?php
    include "SecureSession.php"
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>User Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="navbar.css">
        <link rel="stylesheet" href="user_profile.css">
    </head>
    
    <body>
        
        <?php include 'UserNavbar.php';?>
        <script>
            document.getElementsByClassName("searchbar")[0].style.display = "none";
            document.getElementsByClassName("cart")[0].style.display = "none";
            document.getElementsByClassName("orders")[0].style.display = "none";
        </script>
        
        <div id="profile_info">
            <h3>Account Info</h3>
            <p><b>Email</b><br><span id="email">test</span></p>
            
        </div>
        
        <div id="profile_options">
            <h3>Options</h3>
            <ul>
                <li><a>Change email</a></li>
                <li><a>Change password</a></li>
                <li><p id="dangerzone"><b>Danger Zone</b></p></li>
                <li><a>Delete Account</a></li>
            </ul>
            
                
        </div>
    
    </body>
    
</html>