<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Create Your Big4Shopping Account</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="errors.css">
    </head>
    <body>
        
        <h1>Create Your Big4Shopping Account</h1>
        <div>
            <form action="CreateAccountHandler.php" method="post">
                E-mail: <input type="email" name="email" pattern="^[A-Za-z0-9._\-]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$" title="invalid email address format" required><br>
                Password: <input type="password" name="password" pattern="((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,20})" title="Password must be at between 8 and 20 characters long, contain at least one of each: uppercase letter, lowercase letter, number, and special character !@#$%^&*" required><br>
                <input type="submit" value="Register">
                <span id="error"><?php echo isset($_SESSION["register_error"]) ? $_SESSION["register_error"] : "";?></span>
            </form>
        </div>
        
        <div id="registered">
            <p><?php echo isset($_SESSION["register_success"]) ? "Successfully registered" : "";?></p>
            <span>Already have an account?</span> <a href="Home.php">Sign in</a>
        </div>
        
    </body>
    
    <?php
        unset($_SESSION["register_error"]);    
        unset($_SESSION["register_success"]);
    ?>
    
</html>