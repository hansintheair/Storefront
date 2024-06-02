<?php
    include "SecureSessionComponent.php";
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>User Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script type="text/javascript" src="UserDisplayItemController.js"></script>
        <script type="text/javascript" src="AdminDisplayItemController.js"></script>
        <link rel="stylesheet" href="styles/navbar.css">
        <link rel="stylesheet" href="styles/sidebar.css">
        <link rel="stylesheet" href="styles/catalog.css">
        <link rel="stylesheet" href="styles/fields.css">
        <link rel="stylesheet" href="styles/orders_history.css">
    </head>
    
    <body>
        
        <?php include 'AdminNavbarComponent.php';?>
        
        <div class="items-pane">
            <div class="sidebar">
                
                <h3>Total Store Earnings Summary</h3>
                <div class="earnings-summary">
                    <p class="field"><span>Total Orders</span><span class="field-value" id="total-orders"></span></p>
                    <p class="field"><span>Total Earnings</span><span class="field-value" id="total-earnings"></span></p>
                </div>
                <h3>Orders History</h3>
                <div class="orders-history"></div>
                
            </div>
            
            <div class="items_list"></div>
        </div>
        
    </body>
    
    <script>
        
        async function main() {
            await setOrdersDisplay(
                document.querySelector(".orders-history"),
                document.querySelector(".items_list"),
                await getAllOrders(),
                true
            );
            await setEarningsSummaryDisplay(
                document.querySelector("#total-orders"),
                document.querySelector("#total-earnings")
            );
        }
            
        main();
            
    </script>
    
    
</html>