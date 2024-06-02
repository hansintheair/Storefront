<?php
    include "SecureSessionComponent.php";
    include "SecureAdminSessionComponent.php";
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>User Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="styles/navbar.css">
        <link rel="stylesheet" href="styles/sidebar.css">
        <link rel="stylesheet" href="styles/admin_accountslist.css">
        <link rel="stylesheet" href="styles/messages.css">
        <script type="text/javascript" src="AdminDisplayItemController.js"></script>
        <script type="text/javascript" src="messages.js"></script>
    </head>
    
    <body>
        
        <?php include 'AdminNavbarComponent.php';?>
        
        <div class="items-pane">
            <div class="sidebar">
                <div id="add-account">
                    <h3>Add Account</h3>
                    <form action="CreateAccountHandler.php" method="POST">
                        <label for="email">E-mail:</label>
                        <input name="email" type="email" pattern="^[A-Za-z0-9._\-]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$" title="invalid email address format" required>
                        <label for="password">Password:</label>
                        <input name="password" type="password" pattern="((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,20})" title="Password must be at between 8 and 20 characters long, contain at least one of each: uppercase letter, lowercase letter, number, and special character !@#$%^&*" required>
                        <label for="isadmin">Is Admin:</label>
                        <input name="isadmin" type="checkbox">
                        <input name="return_location" type="hidden" value="AdminAccountsManager.php">
                        <button type="submit">Add Account</button>
                        <span class="error"><?php echo isset($_SESSION["register_error"]) ? $_SESSION["register_error"] : "";?></span>
                        <span class="success"><?php echo isset($_SESSION["register_success"]) ? "Successfully registered" : "";?></span>
                    </form>
                </div>   
            </div>
            <div class="items_list">
                <script>
                    setAccountsListDisplay(document.querySelector(".items_list"), <?php echo $_SESSION["user_id"]?>);
                    successMessageTimeout();
                    errorMessageTimeout();
                </script>
            </div>
        </div>
        
    </body>
    
    <?php
        unset($_SESSION["register_error"]);
        unset($_SESSION["register_success"]);
    ?>
    
</html>