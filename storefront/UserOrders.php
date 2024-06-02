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
        <link rel="stylesheet" href="styles/sidebar.css">
        <link rel="stylesheet" href="styles/orders_history.css">
        <script type="text/javascript" src="UserDisplayItemController.js"></script>
    </head>
    
    <body>
        
        <?php include 'UserNavbarComponent.php';?>
        
        <div class="items-pane">
            <div class="sidebar">
                <h3 id="orders-title">Orders</h3>
                <div class="orders-history"></div>
            </div>
            <div class="items_list">
            </div>
        </div>
        
        <script>
            
            async function main() {
                await setOrdersDisplay(
                    document.querySelector(".orders-history"),
                    document.querySelector(".items_list"),
                    await getUserOrders()
                );
            }
            
            main();
            
        </script>
        
    </body>
    
</html>