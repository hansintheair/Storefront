
function getCatalogDisplay() {
        fetch("DisplayCatalogController.php")
        .then(response => response.json()
        .then(data => {
                const ul = document.createElement("ul");
                ul.className = "catalog_list";

                data.forEach(item => {
                        const li = document.createElement("li");
                        li.className = "catalog_item";
                        
                        const div = document.createElement("div");
                        li.appendChild(div);
                        
                        const name = document.createElement("h3");
                        name.id = "item_name";
                        name.textContent = item[0];
                        
                        const desc = document.createElement("p");
                        desc.id = "item_desc";
                        desc.textContent = item[1];
                        
                        const price = document.createElement("span");
                        price.id = "item_price";
                        price.textContent = "$" + item[2];
                        
                        const stock = document.createElement("span");
                        stock.id = "item_stock";
                        const stock_val = item[3];
                        if (stock_val > 25) {
                            stock.textContent = "In Stock";
                        } else if (stock_val > 0) {
                            stock.textContent = "Only " + stock_val + " left!";
                        } else {
                            stock.textContent = "Out of Stock";
                        }
                        
                        div.appendChild(name);
                        div.appendChild(desc);
                        div.appendChild(price);
                        div.appendChild(stock);
                        
                        ul.appendChild(li);
                    }
                );
                document.querySelector(".items_list").appendChild(ul);
            }
        )
    );
}

function getCartDisplay() {
        fetch("DisplayCartController.php")
        .then(response => response.json()
        .then(data => {
                const ul = document.createElement("ul");
                ul.className = "cart_list";

                data.forEach(item => {
                    
                        // Create list item to hold item card
                        
                        const li = document.createElement("li");
                        li.className = "catalog_item";
                        
                        // Create div to hold item card parts
                        
                        const div = document.createElement("div");
                        li.appendChild(div);
                        
                        // Item name and description
                        
                        const name = document.createElement("h3");
                        name.id = "item_name";
                        name.textContent = item[0];
                        
                        const desc = document.createElement("p");
                        desc.id = "item_desc";
                        desc.textContent = item[1];
                        
                        // Price and stock info
                        
                        const price_stock = document.createElement("p");
                        price_stock.id = "price_stock";
                        
                        const price = document.createElement("span");
                        price.id = "item_price";
                        price.textContent = "$" + item[2];
                                               
                        const stock = document.createElement("span");
                        stock.id = "item_stock";
                        const stock_val = item[3];
                        if (stock_val > 25) {
                            stock.textContent = "In Stock";
                        } else if (stock_val > 0) {
                            stock.textContent = "Only " + stock_val + " left!";
                        } else {
                            stock.textContent = "Out of Stock";
                        }
                        
                        price_stock.appendChild(price);
                        price_stock.appendChild(stock);
                        
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
                        quant.value = item[4];
                        
                        quant_select.appendChild(quant_label);
                        quant_select.appendChild(quant);
                        
                        // Remove from cart option
                        const remove = document.createElement("button");
                        remove.id = "remove_item";
                        remove.textContent = "Remove";
                        
                        // Div to hold quantity selection and remove from cart option
                        
                        const quant_remove = document.createElement("div");
                        quant_remove.id = "quant_remove";
                        
                        
                        quant_remove.appendChild(quant_select);
                        quant_remove.appendChild(remove);
                        
                        // Compose the item card from its parts
                        
                        div.appendChild(name);
                        div.appendChild(desc);
                        div.appendChild(price_stock);
                        div.appendChild(quant_remove);
                        
                        // Compose the list of items
                        
                        ul.appendChild(li);
                    }
                );
                document.querySelector(".items_list").appendChild(ul);
            }
        )
    );
}