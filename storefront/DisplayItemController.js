
function createItemBaseContents(li, item) {
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

    price_stock.appendChild(currency);
    price_stock.appendChild(price);
    price_stock.appendChild(stock);
    
    // Compose div from parts & return it
    div.appendChild(name);
    div.appendChild(desc);
    div.appendChild(price_stock);
    
    return div;
}

function setCatalogDisplay(target) {
        fetch("DisplayCatalogController.php")
        .then(response => response.json()
        .then(data => {
                const ul = document.createElement("ul");
                ul.className = "catalog_list";

                data.forEach(item => {
                        const li = document.createElement("li");
                        li.className = "catalog_item";
                        li.id = "item-"+item["ID_ITEM"];
                        
                        // Create & fill base item div contents
                        const div = createItemBaseContents(li, item);
                        
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
                        add.disabled = (item["IN_CART"] === "1");
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
        )
    );
}

async function setCartDisplay(target) {
        await fetch("DisplayCartController.php")
        .then(response => response.json()
        .then(data => {
                const ul = document.createElement("ul");
                ul.className = "cart_list";

                data.forEach(item => {
                    
                        // Create list item to hold item card
                        const li = document.createElement("li");
                        li.className = "catalog_item";
                        
                        // Create & fill base item div contents
                        const div = createItemBaseContents(li, item);
                        
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
                            console.log(this.value);
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
        )
    );
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
    console.log(id_cartitem);
    fetch("RemoveItemFromCartController.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `id_cartitem=${encodeURIComponent(id_cartitem)}`
        }
    );
}

async function getOrderSummary(target) {
    const items = document.querySelectorAll(".cart_list li");
    
    const ul = document.createElement("ul");
    ul.className = "order-summary-list";
    
    items.forEach(item => {
        
            let quantvar = item.querySelector("#item_quant").value;
            let pricevar = item.querySelector("#item_price").value;
            let subtovar = (quantvar * pricevar).toFixed(2);
            
            // Create list item to hold item card
            const li = document.createElement("li");
            li.className = "order-summary-item";
            
//            // Define reusable currency element
//            const currency = document.createElement("span");
//            currency.textContent = "$";
                
            // Create base item div
            const div = document.createElement("div");
            
            // Item name and price
            
            const name_price_container = document.createElement("p");
            name_price_container.className = "order-name-price-container";
            
            const name = document.createElement("span");
            name.className = "order-item-name";
            name.textContent = item.querySelector("#item_name").textContent;
            
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
            subtotal.textContent = "$" + subtovar;
            
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
    target.appendChild(ul);
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