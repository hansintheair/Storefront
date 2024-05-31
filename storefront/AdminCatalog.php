<?php
    include "SecureSessionComponent.php";
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>User Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="styles/navbar.css">
        <script type="text/javascript" src="DisplayItemController.js"></script>
    </head>
    
    <body>
        
        <?php include 'AdminNavbarComponent.php';?>
        
        <div class="items-pane">
            <div class="sidebar"></div>
            <div class="items_list">
                <script>
                    setCatalogDisplay(document.querySelector(".items_list"));
                </script>
            </div>
        </div>
        
        <div id="test"></div>
        
    </body>
    
</html>