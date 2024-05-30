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
        
        <div class="items-pane">
            <div class="sidebar">
                <h3 id="cart-summary">Cart Summary</h3>
                <div class="order-summary"></div>
                <div>
                    <form action="" method="post">
                        <p><span><b>Order total</b></span><br><span>$</span><span id="order-total"></span></p>
                        <button type="submit">Place order</button>
                    </form>
                    
                </div>
            </div>
            
            <div class="items_list"></div>
        </div>
        
        
        
    </body>
    
    <script>
        async function main() {
            await setCartDisplay(document.querySelector(".items_list"));
            await getOrderSummary(document.querySelector(".order-summary"));
            let total = await getOrderTotal();
            document.getElementById("order-total").textContent = total.toFixed(2);
        }
        main();
        
        
        
    </script>
    
</html>