    
function setActive(id) {

    let prev_active_tab = document.querySelector(".tab.active");
    if (prev_active_tab) {
        prev_active_tab.classList.remove("active");
    }

    let curr_active_tab = document.querySelector(`#${id}`);
    curr_active_tab.classList.add("active");
}
