function createItemBaseContents(item, show_stock=true) {
    // Create div to hold item card parts
                        
    const div = document.createElement("div");

    // Item name and description

    const name = document.createElement("h3");
    name.id = "item_name";
    name.textContent = item["NAME"];

    const desc = document.createElement("p");
    desc.id = "item_desc";
    desc.textContent = item["DESC"];
    
    // Price and stock info
                        
    const price_stock = document.createElement("p");
    price_stock.id = "price_stock";

    const currency = document.createElement("span");
    currency.textContent = "$";
    
    const price = document.createElement("input");
    price.id = "item_price";
    price.readOnly = true;
    price.value = item["PRICE"];
    
    price_stock.appendChild(currency);
    price_stock.appendChild(price);
    
    if (show_stock) {
        const stock = document.createElement("span");
        stock.id = "item_stock";
        const stock_val = item["STOCK"];
        if (stock_val > 25) {
            stock.textContent = "In Stock";
        } else if (stock_val > 0) {
            stock.textContent = "Only " + stock_val + " left!";
        } else {
            stock.textContent = "Out of Stock";
        }
        
        price_stock.appendChild(stock);
    }
    
    // Compose div from parts & return it
    div.appendChild(name);
    div.appendChild(desc);
    div.appendChild(price_stock);
    
    return div;
}

async function setCatalogDisplay(target) {
        
    let data  = await fetch(
        "DisplayCatalogController.php"
    ).then(response => response.json());
    
    const ul = document.createElement("ul");
    ul.className = "catalog_list";

    data.forEach(
        item => {
            
            const li = document.createElement("li");
            li.className = "catalog_item";
            li.id = "item-"+item["ID_ITEM"];

            // Create & fill base item div contents
            const div = createItemBaseContents(item);

            // Quantity selection

            const quant_select = document.createElement("div");
            quant_select.id = "quant_select";
            if (item["IN_CART"] === "1") {
                quant_select.className = "disabled";
            }

            const quant_label = document.createElement("span");
            quant_label.id = "quant_label";
            quant_label.textContent = "Quantity:";

            const quant = document.createElement("select");
            quant.id = "item_quant";
            quant.disabled = (item["IN_CART"] === "1");
            for (let i = 1; i <= 25; i++) {
                const option = document.createElement("option");
                option.value = i;
                option.text = i;
                quant.add(option);
            }

            quant_select.appendChild(quant_label);
            quant_select.appendChild(quant);

            // Add to cart option
            const add = document.createElement("button");
            add.id = "add_item";
            add.textContent = (item["IN_CART"] === "1") ? "In cart" : "Add to cart";
            add.disabled = (item["IN_CART"] === "1" || item["STOCK"] < 1);
            add.setAttribute("id_item", item["ID_ITEM"]);
            add.onclick = function() {
                let id_item = this.getAttribute("id_item");
                let quant = document.querySelector("#item-"+id_item+" #item_quant").value;
                addItemToCart(id_item, quant);
                location.reload();
            };

            // Create & compose div to hold quantity selection and add to cart option

            const quant_option = document.createElement("div");
            quant_option.id = "quant_option";

            quant_option.appendChild(quant_select);
            quant_option.appendChild(add);

            // Compose the item card from its parts
            div.appendChild(quant_option);

            // Compose the list of items

            li.appendChild(div);
            ul.appendChild(li);
        }
    );
    target.appendChild(ul);
}

async function getCartItems() {
    return await fetch("DisplayCartController.php").then(response => response.json());
}

async function setCartDisplay(target, data) {
    
    const ul = document.createElement("ul");
    ul.className = "cart_list";

    data.forEach(
        item => {

            // Create list item to hold item card
            const li = document.createElement("li");
            li.className = "catalog_item";

            // Create & fill base item div contents
            const div = createItemBaseContents(item);

            // Quantity selection

            const quant_select = document.createElement("div");
            quant_select.id = "quant_select";

            const quant_label = document.createElement("span");
            quant_label.id = "quant_label";
            quant_label.textContent = "Quantity:";

            const quant = document.createElement("select");
            quant.id = "item_quant";
            for (let i = 1; i <= 25; i++) {
                const option = document.createElement("option");
                option.value = i;
                option.text = i;
                quant.add(option);
            }
            quant.value = item["QUANT"];
            quant.setAttribute("id_cartitem", item["ID_CARTITEM"]);
            quant.onchange = function() {
                let id_cartitem = this.getAttribute("id_cartitem");
//                console.log(this.value);
                updateCartItemQuant(id_cartitem, this.value);
                location.reload();
            };

            quant_select.appendChild(quant_label);
            quant_select.appendChild(quant);

            // Remove from cart option
            const remove = document.createElement("button");
            remove.id = "remove_item";
            remove.textContent = "Remove";
            remove.setAttribute("id_cartitem", item["ID_CARTITEM"]);
            remove.onclick = function() {
                let id_cartitem = this.getAttribute("id_cartitem");
                remItemFromCart(id_cartitem);
                location.reload();
            };

            // Create & compose div to hold quantity selection and remove from cart option

            const quant_option = document.createElement("div");
            quant_option.id = "quant_option";

            quant_option.appendChild(quant_select);
            quant_option.appendChild(remove);

            // Compose the item card from its parts
            div.appendChild(quant_option);

            // Compose the list of items
            li.appendChild(div);
            ul.appendChild(li);
        }
    );
    target.appendChild(ul);
}

function updateCartItemQuant(id_cartitem, quant) {
    fetch("UpdateQuantInCartController.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `id_cartitem=${encodeURIComponent(id_cartitem)}&quant=${encodeURIComponent(quant)}`
        }
    );
}

function addItemToCart(id_item, quant) {
    fetch("AddItemToCartController.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `id_item=${encodeURIComponent(id_item)}&quant=${encodeURIComponent(quant)}`
        }
    );
}

function remItemFromCart(id_cartitem) {
//    console.log(id_cartitem);
    fetch("RemoveItemFromCartController.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `id_cartitem=${encodeURIComponent(id_cartitem)}`
        }
    );
}

async function setOrderSummaryDisplay(target, items) {
    
    const ul = document.createElement("ul");
    ul.className = "order-summary-list";
    
//    console.log("IN setOrderHistoryItemsDisplay");  //DEBUG
//    console.log("ITEMS = " + items);  //DEBUG
//    console.log("TARGET = " + target);  //DEBUG
    
    let total = 0;
    
    items.forEach(
        item => {
        
            let quantvar = item["QUANT"];
            let pricevar = item["PRICE"];
            let subtotalvar = (quantvar * pricevar).toFixed(2);
//            console.log(subtotalvar);
            total += Number(subtotalvar);
            
            // Create list item to hold item card
            const li = document.createElement("li");
            li.className = "order-summary-item";
                           
            // Create base item div
            const div = document.createElement("div");
            
            // Item name and price
            
            const name_price_container = document.createElement("p");
            name_price_container.className = "order-name-price-container";
            
            const name = document.createElement("span");
            name.className = "order-item-name";
            name.textContent = item["NAME"];
            
            const price = document.createElement("span");
            price.className = "order-item-price";
            price.textContent = "($" + pricevar + " each)";
            
            name_price_container.appendChild(name);
            name_price_container.appendChild(price);
            
            // Item price x quantity 
            
            const price_quant_container = document.createElement("p");
            
            const quant = document.createElement("span");
            quant.className = "order-item-quant";
            quant.textContent = " x " + quantvar;
            
            price_quant_container.appendChild(quant);
            
            // Item subtotal
            
            const subtotal_container = document.createElement("p");
            
            const subtotal = document.createElement("div");
            subtotal.id = "order-item-subtotal";
            subtotal.textContent = "$" + subtotalvar;
            
            subtotal_container.appendChild(subtotal);
            
            // Compose the item info from its parts
            div.append(name_price_container);
            div.append(price_quant_container);
            div.append(subtotal_container);
            
            // Compose the list of items
            li.appendChild(div);
            ul.appendChild(li);            
        }
    );
    
    // Order total
    const order_total_container = document.createElement("p");
    
    const order_total_label = document.createElement("span");
    const b = document.createElement("b");
    b.textContent = "Order Total";
    const br = document.createElement("br");
    order_total_label.appendChild(b);
    order_total_label.appendChild(br);
    
    const order_total_value = document.createElement("span");
    order_total_value.id = "order-total";
    order_total_value.textContent = "$" + total.toFixed(2);
    
    order_total_container.appendChild(order_total_label);
    order_total_container.appendChild(order_total_value);
    
    // Compose the order summary    
    target.appendChild(ul);
    target.appendChild(order_total_container);
    
}

async function getOrderTotal() {
    const items = document.querySelectorAll(".cart_list li");
    let total = 0.0;
    
    items.forEach(item => {
            const quant = item.querySelector("#item_quant").value;
            const price = item.querySelector("#item_price").value;
            total += (quant * price);
        }
    );
    return total;
}

async function getOrders() {
    return await fetch(
        "DisplayOrderHistoryController.php"
    ).then(response => response.json());
}

async function setOrdersDisplay(orders_history_target, order_items_target, data) {
    
    const ul = document.createElement("ul");
    ul.className = "orders-history-list";

    let i = 0;
    data.forEach(
        item => {

            // Create list item to hold item card
            const li = document.createElement("li");
            li.className = "order-history-item";
//                    li.id = `item-id-${item["ID_ORDER"]}`;
            li.setAttribute("id_order", item["ID_ORDER"]);

            li.onclick = async function() {
                
                let id_order = this.getAttribute("id_order");
                let order_summary_target = this.querySelector(".order-summary");
                
                // Clear active order
                let active_order_element = document.querySelector(
                    ".order-history-item.active"
                );
                active_order_element.querySelector(".order-summary").innerHTML = null;
                active_order_element.classList.remove("active");
                
//                console.log("CLICKED ORDER " + id_order);  //DEBUG
//                console.log("DISPLAYED: " + displayed);  //DEBUG
//                console.log("ORDER SUMMARY: " + order_summary);  //DEBUG
                order_items_target.innerHTML = null;
                order_summary_target.innerHTML = null;
                this.classList.add("active");
                let order_items_data = await getOrderItems(id_order);
                await setOrderItemsDisplay(order_items_target, order_items_data);
                await setOrderSummaryDisplay(order_summary_target, order_items_data);
            };

            // Create base item div
            const div = document.createElement("div");
            div.className = "order-number-date";

            const order_date = document.createElement("span");
            order_date.className = "order-date";
            let date = item["ORDER_DATE"];
            order_date.textContent = date;
                   
            // Compose the item info from its parts
            div.appendChild(order_date);

            // Create order summary container
            const order_summary = document.createElement("div");
            order_summary.className = "order-summary";
            
            if (i === 0) {
                let id_order = li.getAttribute("id_order");
                li.classList.add("active");
                async function init_state() {
                    let order_items_data = await getOrderItems(id_order);
                    await setOrderItemsDisplay(order_items_target, order_items_data);
                    await setOrderSummaryDisplay(order_summary, order_items_data);
                }
                init_state();
            }
            
            // Compose the list of items
            li.appendChild(div);
            li.appendChild(order_summary);
            ul.appendChild(li);
            if (i < data.length-1) {
                const divider = document.createElement("li");
                divider.className = "divider";
                ul.appendChild(divider);
            }
            i+=1;
        }
    );
    orders_history_target.appendChild(ul);
}

async function getOrderItems(id_order) {
    return await fetch(
        "DisplayOrderHistoryItemsController.php",
        {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `id_order=${encodeURIComponent(id_order)}`
        }
    ).then(response => response.json());
}
async function setOrderItemsDisplay(target, data) {
    
//    console.log("IN setOrderHistoryItemsDisplay");  //DEBUG
//    console.log("id_order = " + id_order);  //DEBUG
//    console.log(target);  //DEBUG
    
    const ul = document.createElement("ul");
    ul.className = "order-history-items-list";

    data.forEach(
        item => {

            // Create list item to hold item card
            const li = document.createElement("li");
            li.className = "catalog_item";

            // Create & fill base item div contents
            const div = createItemBaseContents(item, false);

            // Quantity selection

            const quant_select = document.createElement("div");
            quant_select.id = "quant_select";

            const quant_label = document.createElement("span");
            quant_label.id = "quant_label";
            quant_label.textContent = "Quantity:";

            const quant = document.createElement("select");
            quant.id = "item_quant";
            quant.disabled = true;
            for (let i = 1; i <= 25; i++) {
                const option = document.createElement("option");
                option.value = i;
                option.text = i;
                quant.add(option);
            }
            quant.value = item["QUANT"];

            quant_select.appendChild(quant_label);
            quant_select.appendChild(quant);


            // Compose the item info from its parts
            div.appendChild(quant_select);

            // Compose the list of items
            li.appendChild(div);
            ul.appendChild(li);
        }
    );
    target.appendChild(ul);
}

