<?php
    include "SecureSession.php"
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>User Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script type="text/javascript" src="UserProfileController.js"></script>
        <link rel="stylesheet" href="navbar.css">
        <link rel="stylesheet" href="user_profile.css">
        <link rel="stylesheet" href="errors.css">
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
            <p><b>Email</b><br><span id="email"></span></p>
            
        </div>
        
        <div id="profile_options">
            <h3>Options</h3>
            <ul>
                <li>
                    <div>
                        <span>Change email</span>
                        <form action="ChangeEmailHandler.php" method="post">
                            <input name="email" type="email" placeholder="New Email" pattern="^[A-Za-z0-9._\-]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$" title="invalid email address format" required>
                            <button type="submit">Save Changes</button>
                            <span class="error"><?php echo isset($_SESSION["email_update_error"]) ? $_SESSION["email_update_error"] : "";?></span>
                            <span><?php echo isset($_SESSION["email_update_success"]) ? "Successfully registered" : "";?></span>
                        </form>
                    </div>
                </li>
                <li>
                    <div>
                        <span>Change password</span>
                        <form action="NOT_IMPLEMENTED" method="post">
                            <input type="old_password" placeholder="Old Password"><br>
                            <input type="new_password" placeholder="New Password">
                            <button type="submit">Save Changes</button>
                        </form>
                    </div>
                </li>
                <li><p id="dangerzone"><b>Danger Zone</b></p></li>
                <li><a>Delete account</a></li>
            </ul>
            
            <script>
                document.addEventListener("DOMContentLoaded", getUserData());
            </script>
        </div>
        
        <?php
            unset($_SESSION["email_update_error"]);    
            unset($_SESSION["email_update_success"]);
        ?>
    
    </body>
    
</html>