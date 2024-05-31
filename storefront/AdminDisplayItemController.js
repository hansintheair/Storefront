
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
                        const div = document.createElement("div");
                        
                        // Form for updating item values
                        
                        const form_update = document.createElement("form");
                        form_update.action = "UpdateCatalogItemValues.php";
                        form_update.method = "POST";
                        
                        const id_item_upd = document.createElement("input");
                        id_item_upd.type = "hidden";
                        id_item_upd.name = "id_item";
                        id_item_upd.value = item["ID_ITEM"];
                        
                        const name_label = document.createElement("label");
                        name_label.textContent = "Name:";
                        name_label.setAttribute("for", "item_name");
                        const name = document.createElement("input");
                        name.id = "item_name";
                        name.name = "item_name";
                        name.type = "text";
                        name.value = item["NAME"];
                        
                        const desc_label = document.createElement("label");
                        desc_label.textContent = "Description:";
                        desc_label.setAttribute("for", "item_desc");
                        const desc = document.createElement("input");
                        desc.id = "item_desc";
                        desc.name = "item_desc";
                        desc.type = "text";
                        desc.value = item["DESC"];
                        
                        const price_label = document.createElement("label");
                        price_label.textContent = "Price:";
                        price_label.setAttribute("for", "item_price");
                        const price = document.createElement("input");
                        price.id = "item_price";
                        price.name = "item_price";
                        price.type = "number";
                        price.step = 0.01;
                        price.value = item["PRICE"];

                        const quant_label = document.createElement("label");
                        quant_label.setAttribute("for", "item_quant");
                        quant_label.textContent = "Quantity:";
                        const quant = document.createElement("input");
                        quant.id = "item_quant";
                        quant.name = "item_quant";
                        quant.type = "number";
                        quant.step = 1;
                        quant.value = item["STOCK"];
                        
                        const update = document.createElement("button");
                        update.type = "submit";
                        update.textContent = "Update";
                        
                        form_update.appendChild(id_item_upd);
                        form_update.appendChild(name_label);
                        form_update.appendChild(name);
                        form_update.appendChild(desc_label);
                        form_update.appendChild(desc);
                        form_update.appendChild(price_label);
                        form_update.appendChild(price);
                        form_update.appendChild(quant_label);
                        form_update.appendChild(quant);
                        form_update.appendChild(update);
                        
                        // Form for deleting item
                        
                        const form_delete = document.createElement("form");
                        form_delete.action = "DeleteCatalogItem.php";
                        form_delete.method = "POST";
                        
                        const id_item_del = document.createElement("input");
                        id_item_del.type = "hidden";
                        id_item_del.name = "id_item";
                        id_item_del.value = item["ID_ITEM"];
                        
                        const del = document.createElement("button");
                        del.type = "submit";
                        del.textContent = "Delete";
                        
                        form_delete.appendChild(id_item_del);
                        form_delete.appendChild(del);
                        
                        // Compose the item card from its parts
                        div.appendChild(form_update);
                        div.appendChild(form_delete);
                        
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