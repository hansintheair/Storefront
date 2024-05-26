
function successMessageTimeout() {
    setTimeout(function() {
            let elements = document.getElementsByClassName("success");
            for (let i = 0; i < elements.length; i++) {
                elements[i].style.display = "none";
            }
        }, 2000
    );
}

function errorMessageTimeout() {
    setTimeout(function() {
            let elements = document.getElementsByClassName("error");
            for (let i = 0; i < elements.length; i++) {
                elements[i].style.display = "none";
            }
        }, 2000
    );
}