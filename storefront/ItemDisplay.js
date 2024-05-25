
function getCatalogDisplay() {
        document.innerHTML = fetch("DisplayCatalog.php")
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
                        name.className = "item_name";
                        name.textContent = item[0];
                        
                        const desc = document.createElement("p");
                        desc.className = "item_desc";
                        desc.textContent = item[1];
                        
                        const price = document.createElement("span");
                        price.className = "item_price";
                        price.textContent = "$" + item[2];
                        
                        const quant = document.createElement("span");
                        quant.className = "item_quant";
                        const quant_val = item[3];
                        if (quant_val > 25) {
                            quant.textContent = "In Stock";
                        } else if (quant_val > 0) {
                            quant.textContent = "Only " + quant_val + " left!";
                        } else {
                            quant.textContent = "Out of Stock";
                        }
                        
                        div.appendChild(name);
                        div.appendChild(desc);
                        div.appendChild(price);
                        div.appendChild(quant);
                        
                        ul.appendChild(li);
                    }
                );
                document.querySelector(".items_list").appendChild(ul);
            }
        )
    );
}
