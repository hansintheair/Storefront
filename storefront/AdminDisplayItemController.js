
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
                        form_delete.id = "form-delete";
                        form_delete.action = "DeleteItemFromCatalogController.php";
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

function setAccountsListDisplay(target, id_adminuser) {
        fetch("DisplayAccountsListController.php")
            .then(response => response.json()
            .then(data => {
                const ul = document.createElement("ul");
                ul.className = "accounts_list";

                data.forEach(item => {
                        const li = document.createElement("li");
                        li.className = "account_item";
                        li.id = "account-"+item["ID_USER"];
                        
                        // Create & fill base item div contents
                        const div = document.createElement("div");
                        
                        // User info  NOTE: Initially allowed update, but decided decided not to because:
                        //  - Only users can change their e-mail address
                        //  - A user account cannot be changed to an admin account and vice versa (because
                        //    admins do not have a cart or orders, and so changing user to admin would re-
                        //    quire deleting user account's cart and orders (or dissassociating them).
                        
                        const form_update = document.createElement("form");
//                        form_update.action = "UpdateAccountAsAdmin.php";
//                        form_update.method = "POST";
                        
                        const id_user_upd = document.createElement("input");
                        id_user_upd.type = "hidden";
                        id_user_upd.name = "id_user";
                        id_user_upd.value = item["ID_USER"];
                        
                        const email_label = document.createElement("label");
                        email_label.textContent = "E-mail:";
                        email_label.setAttribute("for", "email");
                        const email = document.createElement("input");
                        email.id = "email";
                        email.name = "email";
                        email.type = "email";
//                        email.setAttribute("pattern", "^[A-Za-z0-9._\\-]+@[A-Za-z0-9.\\-]+\\.[A-Za-z]{2,}$");
//                        email.setAttribute("title", "invalid email address format");
                        email.disabled = true;
                        email.value = item["EMAIL"];
                          
                        const isadmin_label = document.createElement("label");
                        isadmin_label.textContent = "Is Admin:";
                        isadmin_label.setAttribute("for", "isadmin");
                        const isadmin = document.createElement("input");
                        isadmin.id = "isadmin";
                        isadmin.name = "isadmin";
                        isadmin.type = "checkbox";
                        isadmin.disabled = true;
                        isadmin.checked = (item["TYPE"]==="1");

//                        const update = document.createElement("button");
//                        update.type = "submit";
//                        update.textContent = "Update";
                        
                        form_update.appendChild(id_user_upd);
                        form_update.appendChild(email_label);
                        form_update.appendChild(email);
                        form_update.appendChild(isadmin_label);
                        form_update.appendChild(isadmin);
//                        form_update.appendChild(update);
                        
                        // Form for deleting item
                        
                        const form_delete = document.createElement("form");
                        form_delete.id = "form-delete";
                        form_delete.action = "DeleteAccountAsAdminController.php";
                        form_delete.method = "POST";
                        
                        const id_item_del = document.createElement("input");
                        id_item_del.type = "hidden";
                        id_item_del.name = "id_user";
                        id_item_del.value = item["ID_USER"];
                        
                        const del = document.createElement("button");
                        del.type = "submit";
                        del.textContent = "Delete";
                        if (id_adminuser === Number(item["ID_USER"])) {
                            del.disabled = true;
                        }
                        
                        form_delete.appendChild(id_item_del);
                        form_delete.appendChild(del);
                        
                        // Form for resetting password
                        const form_reset = document.createElement("form");
                        form_reset.id = "form-reset-passw";
                        form_reset.action = "";
                        form_reset.method = "POST";
                        
                        const id_user_reset = document.createElement("input");
                        id_user_reset.type = "hidden";
                        id_user_reset.name = "id_user";
                        id_user_reset.value = item["ID_USER"];
                        
                        const reset = document.createElement("button");
                        reset.type = "submit";
                        reset.textContent = "Reset Password";
                        if (id_adminuser === Number(item["ID_USER"])) {
                            reset.disabled = true;
                        }
                        
                        form_reset.appendChild(id_user_reset);
                        form_reset.appendChild(reset);
                        
                        // Compose the item card from its parts
                        div.appendChild(form_update);
                        div.appendChild(form_delete);
                        div.appendChild(form_reset)
                        
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

async function getAllOrders() {
//    console.log("IN getAllOrders");  //DEBUG
    return await fetch(
        "DisplayOrderHistoryForAdminController.php"
    ).then(response => response.json());
}

async function getAllOrderItems() {
    console.log("IN getAllOrders");  //DEBUG
    return await fetch(
        "GetAllOrderItemsController.php"
    ).then(response => response.json());
}
async function setEarningsSummaryDisplay(number_orders_target, total_earnings_target) {
    
    let orders = await getAllOrders();
    let num_orders = orders.length;
    
    number_orders_target.textContent = num_orders;

    let order_items = await getAllOrderItems();
    let total = 0;
    order_items.forEach(
        item => {
            total += item["QUANT"] * item["PRICE"];
            
        }
    );
    
    total_earnings_target.textContent = "$" + total.toFixed(2);
    
    
}