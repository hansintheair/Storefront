<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Create Your Big4Shopping Account</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="styles/messages.css">
        <link rel="stylesheet" href="styles/home.css">
    </head>
    <body>
        
        <h1>Big4Shopping</h1>
        <h3>Create Your Account</h3>
        <div>
            <form class="menu-container" action="CreateAccountHandler.php" method="post">
                E-mail<input type="email" name="email" pattern="^[A-Za-z0-9._\-]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$" title="invalid email address format" required><br>
                Password<input type="password" name="password" pattern="((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,20})" title="Password must be at between 8 and 20 characters long, contain at least one of each: uppercase letter, lowercase letter, number, and special character !@#$%^&*" required><br>
                <input type="hidden" name="isadmin" value="false">
                <input name="return_location" type="hidden" value="CreateAccount.php">
                <input type="submit" value="Register">
                <span class="error"><?php echo isset($_SESSION["register_error"]) ? $_SESSION["register_error"] : "";?></span>
            </form>
        </div>
        
        <div>            
            <span class="success" id="registered"><?php echo isset($_SESSION["register_success"]) ? "Successfully registered" : "";?></span>
            <h3>Already have an account?</h3>
            <button onclick="location.href='Home.php'">Log in</button>
        </div>
        
    </body>
    
    <?php
        unset($_SESSION["register_error"]);
        unset($_SESSION["register_success"]);
    ?>
    
</html>