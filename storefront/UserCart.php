<?php
    include "SecureSessionComponent.php";
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>User Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script type="text/javascript" src="UserDisplayItemController.js"></script>
        <script type="text/javascript" src="messages.js"></script>
        <link rel="stylesheet" href="styles/navbar.css">
        <link rel="stylesheet" href="styles/catalog.css">
        <link rel="stylesheet" href="styles/cart_summary.css">
        <link rel="stylesheet" href="styles/sidebar.css">
        <link rel="stylesheet" href="styles/messages.css">
    </head>
    
    <body>
        
        <?php include 'UserNavbarComponent.php';?>
        
        <div class="items-pane">
            <div class="sidebar">
                <h3 id="cart-summary">Cart Summary</h3>
                <div class="order-summary"></div>
                <div>
                    <form action="PlaceOrderController.php" method="post">
                        <button type="submit">Place order</button>
                        <span class="error" id="error"><?php echo isset($_SESSION['is_empty']) ? $_SESSION['is_empty'] : "";?></span>
                    </form>
                    
                </div>
            </div>
            
            <div class="items_list"></div>
        </div>
        
    </body>
    
    <script>
        
        async function main() {
            let cart_items = await getCartItems();
            await setCartDisplay(document.querySelector(".items_list"), cart_items);
            await setOrderSummaryDisplay(
                document.querySelector(".order-summary"),
                cart_items
            );
            let total = await getOrderTotal();
        }
        
        main();
        
        errorMessageTimeout();
        
    </script>
    
    <?php
        unset($_SESSION['is_empty']);
    ?>
    
</html>