<?php
    include "SecureSessionComponent.php";
    include "SecureAdminSessionComponent.php";
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>User Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="styles/navbar.css">
        <link rel="stylesheet" href="styles/sidebar.css">
        <link rel="stylesheet" href="styles/admin_catalog.css">
        <script type="text/javascript" src="AdminDisplayItemController.js"></script>
        <script type="text/javascript" src="navbarTabManager.js"></script>
    </head>
    
    <body>
        
        <?php include 'AdminNavbarComponent.php';?>
        
        <div class="items-pane">
            <div class="sidebar">
                <div id="add-item-to-catalog">
                    <h3>Add Catalog Item</h3>
                    <form action="AddItemToCatalogController.php" method="POST">
                        <label for="item_name">Name:</label>
                        <input name="item_name" type="text" required pattern="^[a-zA-Z0-9 ]*$" title="Only numbers, letters, and spaces allowed">
                        <label for="item_desc">Description:</label>
                        <input name="item_desc" type="text" required pattern="^[a-zA-Z0-9 ]*$" title="Only numbers, letters, and spaces allowed">
                        <label for="item_price">Price:</label>
                        <input name="item_price" type="number" required step="0.01" min="0.01">
                        <label for="item_quant">Quantity:</label>
                        <input name="item_quant" type="number" required step="1" min="0">
                        <button type="submit">Add Item</button>
                        <span class="error"><?php echo isset($_SESSION["password_update_error"]) ? $_SESSION["password_update_error"] : "";?></span>
                        <span class="success"><?php echo isset($_SESSION["password_update_success"]) ? "Successfully registered" : "";?></span>
                    </form>
                </div>   
            </div>
            <div class="items_list">
                <script>
                    
                    setActive("catalog-tab");
                    
                    async function main() {
                        await setCatalogDisplay(document.querySelector(".items_list"));
                    }
                    
                    main();
                
                </script>
            </div>
        </div>
        
    </body>
    
</html>