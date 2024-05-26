
function getUserData() {
    return fetch("UserProfileController.php")
        .then(response => response.json()
        .then(data => {
                document.getElementById("email").textContent = data["EMAIL"];
            }
        )
    );
}

function showChangeEmailForm() {
    
}

