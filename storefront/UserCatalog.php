<?php
    include "SecureSession.php";
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>User Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="navbar.css">
        <link rel="stylesheet" href="catalog.css">
        <script type="text/javascript" src="ItemDisplay.js"></script>
    </head>
    
    <body>
        
        <?php include 'UserNavbar.php';?>
        
        <div class="items_pane">
            <div class="sidebar"></div>
            <div class="items_list">
                <script>
                    getCatalogDisplay();
                </script>
            </div>
        </div>
        
    </body>
    
</html>