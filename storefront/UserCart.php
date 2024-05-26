<?php
    include "SecureSessionComponent.php";
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>User Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="styles/navbar.css">
        <link rel="stylesheet" href="styles/catalog.css">
        <script type="text/javascript" src="DisplayItemController.js"></script>
    </head>
    
    <body>
        
        <?php include 'UserNavbarComponent.php';?>
        
        <div class="items_pane">
            <div class="sidebar"></div>
            <div class="items_list">
                <script>
                    getCartDisplay();
                </script>
            </div>
        </div>
        
    </body>
    
</html>