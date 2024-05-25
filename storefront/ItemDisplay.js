
function getCatalogDisplay() {
        document.innerHTML = fetch("DisplayCatalog.php")
        .then(response => response.json()
        .then(data => {
                const ul = document.createElement("ul");
                ul.class = "catalog_list";

                data.forEach(item => {
                        const li = document.createElement("li");
                        li.class = "catalog_item";
                        li.textContent = item[0];
                        ul.appendChild(li);
                    }
                );
                document.querySelector(".items_list").appendChild(ul);
            }
        )
    );
}
