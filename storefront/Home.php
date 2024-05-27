<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Big4Shopping</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="styles/messages.css">
        <link rel="stylesheet" href="styles/home.css">
    </head>
    
    <body>
        
        <h1>Big4Shopping</h1>
        <h3>Log in to your Account</h3>
        
        <div>
            <form class="menu-container" action="LoginHandler.php" method="post">
                <!--<label for="email">Email</label><br>-->
                E-mail<input type="email" name="email" pattern="^[A-Za-z0-9._\-]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$" title="invalid email address format" required><br>
                <!--<label for="password">Password</label><br>-->
                Password<input type="password" name="password" required><br>
                <input type="submit" value="Log in">
                <span class="error" id="error"><?php echo isset($_SESSION['login_error']) ? $_SESSION['login_error'] : "";?></span>
            </form>
        </div>
        
        <div>
            <span id="registered"></span>
            <h3>Don't have an account?</h3>
            <button type="button" onclick="location.href='\CreateAccount.php'">Create Account</button>
        </div>
        
    </body>
    
    <?php
        unset($_SESSION['login_error']);
    ?>
    
</html>

