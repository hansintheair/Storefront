<?php
    include "SecureSessionComponent.php";
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>User Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script type="text/javascript" src="UserDisplayItemController.js"></script>
        <link rel="stylesheet" href="styles/navbar.css">
        <link rel="stylesheet" href="styles/sidebar.css">
    </head>
    
    <body>
        
        <?php include 'AdminNavbarComponent.php';?>
        
        <div class="items-pane">
            <div class="sidebar">
                <h3 id="earnings-summary">Cart Summary</h3>
                
                <div>
                    <form action="PlaceOrderController.php" method="post">
                        <p><span><b>Order total</b></span><br><span>$</span><span id="order-total"></span></p>
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
            await setCartDisplay(document.querySelector(".items_list"));
            await setOrderSummaryDisplay(
                document.querySelector(".order-summary"),
                document.querySelectorAll(".cart_list li")
            );
            let total = await getOrderTotal();
            document.getElementById("order-total").textContent = total.toFixed(2);
        }
        main();
        errorMessageTimeout();
    </script>
    
    <?php
        unset($_SESSION['is_empty']);
    ?>
    
</html>