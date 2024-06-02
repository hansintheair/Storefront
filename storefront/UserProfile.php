<?php
    include "SecureSessionComponent.php"
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>User Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script type="text/javascript" src="UserProfileController.js"></script>
        <script type="text/javascript" src="messages.js"></script>
        <link rel="stylesheet" href="styles/navbar.css">
        <link rel="stylesheet" href="styles/user_profile.css">
        <link rel="stylesheet" href="styles/messages.css">
    </head>
    
    <body>
        
        <?php 
        if ($_SESSION["admin"] == 0) {
            include 'UserNavbarComponent.php';
        }
        else {
            include "AdminNavbarComponent.php";
        }
        ?>
        
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
                            <span class="success"><?php echo isset($_SESSION["email_update_success"]) ? "Successfully registered" : "";?></span>
                        </form>
                    </div>
                </li>
                <li>
                    <div>
                        <span>Change password</span>
                        <form action="ChangePasswordHandler.php" method="post">
                            <input name="old_password" type="password" placeholder="Old Password" required><br>
                            <input name="new_password" type="password" placeholder="New Password" pattern="((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,20})" title="Password must be at between 8 and 20 characters long, contain at least one of each: uppercase letter, lowercase letter, number, and special character !@#$%^&*" required>
                            <button type="submit">Save Changes</button>
                            <span class="error"><?php echo isset($_SESSION["password_update_error"]) ? $_SESSION["password_update_error"] : "";?></span>
                            <span class="success"><?php echo isset($_SESSION["password_update_success"]) ? "Successfully registered" : "";?></span>
                        </form>
                    </div>
                </li>
                <li><p id="dangerzone"><b>Danger Zone</b></p></li>
                <li>
                    <div>
                        <span>Delete account</span>
                        <form action="DeleteAccountHandler.php" method="post">
                            <input name="password" type="password" placeholder="Verify Password" required>
                            <button type="submit">Delete</button>
                            <span class="error"><?php echo isset($_SESSION["delete_account_error"]) ? $_SESSION["delete_account_error"] : "";?></span>
                        </form>
                    </div>
                </li>
            </ul>
            
            <script>
                document.addEventListener("DOMContentLoaded", getUserData());
            </script>
        </div>
        
        <script>
            
            setActive("profile-tab");
            
            successMessageTimeout();
            errorMessageTimeout();
        </script>
        
        <?php
            unset($_SESSION["email_update_error"]);    
            unset($_SESSION["email_update_success"]);
            unset($_SESSION["password_update_error"]);
            unset($_SESSION["password_update_success"]);
            unset($_SESSION["delete_account_error"]);
        ?>
    
    </body>
    
</html>