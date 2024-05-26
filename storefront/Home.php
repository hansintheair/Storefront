<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Big4Shopping</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="messages.css">
    </head>
    
    <body>
        
        <h1>Big4Shopping</h1>
        
        <div>
            <form action="LoginHandler.php" method="post">
                E-mail: <input type="email" name="email" pattern="^[A-Za-z0-9._\-]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$" title="invalid email address format" required><br>
                Password: <input type="password" name="password" required><br>
                <input type="submit" value="Log in">
                <span class="error" id="error"><?php echo isset($_SESSION['login_error']) ? $_SESSION['login_error'] : "";?></span>
            </form>
        </div>
        
        <div>
            <h3>Don't have an account?</h3>
            <button type="button" onclick="location.href='\CreateAccount.php'">Create Account</button>
        </div>
        
    </body>
    
</html>

