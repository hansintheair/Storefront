<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Battleships</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="Home.css">
    </head>
    
    <body>
        
        <h1>StoreFront</h1>
        
        <div>
            
            <form action="LoginHandler.php" method="post">
                Username: <input type="text" name="username"><br>
                Password: <input type="password" name="password"><br>
                <input type="submit">
                <span id="error"><?php echo isset($_SESSION['login_error']) ? $_SESSION['login_error'] : "";?></span>
            </form>
        </div>
        
        <div>
            <h3>Don't have an account?</h3>
            <button type="button" onclick="location.href='\CreateAccount.html'">Create Account</button>
        </div>
        
        <?php
            session_unset();
            session_destroy();
        ?>
        
    </body>
    
</html>

