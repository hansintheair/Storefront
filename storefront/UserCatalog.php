<?php
    session_start();
    
    // Redirect to login page if no no user session
    if (!isset($_SESSION["user_id"])) {
        header("Location: Home.php");
    }
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
        
        <div class="navbar">
            <?php include 'UserNavbar.php';?>
        </div>
        
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