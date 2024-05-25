<!DOCTYPE html>
<html>
    <head>
        <title>User Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="navbar.css">
    </head>
    
    <body>
        
        <div class="navbar">
            <div class="shopping">
                <div class="active"><a href="#about">Home</a></div>
                <div class="searchbar"><input type="text" placeholder="Search..."></div>
                <div><a href="#cart">Cart</a></div>
                <div><a href="#orders">Orders</a></div>
            </div>
            <div class="account">
                <div><a href="#profile">Profile</a></div>
                <div class="logout"><a href="#logout">Logout</a></div>
            </div>
            
        </div>
        
        <div class="items_pane">
            <div class="sidebar"></div>
            <div class="items_list">
                <script>
                    document.innerHTML = fetch("DisplayCatalog.php")
                        .then(response => response.json()
                        .then(data => {
                                document.querySelector(".items_list").innerHTML = JSON.stringify(data, null, 2);
                            }
                        )
                    );
                </script>
            </div>
        </div>
        
    </body>
    
</html>