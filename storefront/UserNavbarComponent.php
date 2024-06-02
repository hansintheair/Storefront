<div class="navbar">
    <div class="shopping">
        <div id="catalog-tab" class="tab"><a href="UserCatalog.php">Shop</a></div>
<!--        <div class="searchbar"><input type="text" placeholder="Search..."></div>-->
        <div id="cart-tab" class="tab"><a href="UserCart.php">Cart</a></div>
        <div id="orders-tab" class="tab"><a href="UserOrders.php">Orders</a></div>
    </div>
    <div class="account">
        <div id="profile-tab" class="tab"><a href="UserProfile.php">Profile</a></div>
        <div id="logout-tab" class="tab"><a href="LogoutHandler.php">Logout</a></div>
    </div>
</div>

<script>
    
    function setActive(id) {
        
        let prev_active_tab = document.querySelector(".tab.active");
        if (prev_active_tab) {
            prev_active_tab.classList.remove("active");
        }
        
        let curr_active_tab = document.querySelector(`#${id}`);
        curr_active_tab.classList.add("active");
    }

</script>