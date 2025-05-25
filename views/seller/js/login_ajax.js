// Login AJAX functionality
document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.getElementById("login-form");
    
    if (loginForm) {
        loginForm.addEventListener("submit", function(event) {
            event.preventDefault();
            
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            const messageContainer = document.getElementById("message-container");
            const loading = document.getElementById("loading");
            
            // Clear any previous messages
            messageContainer.innerHTML = "";
            
            // Show loading message
            loading.style.display = "block";
            
            // Create form data
            const formData = new FormData();
            formData.append("email", email);
            formData.append("password", password);
            
            // Send AJAX request
            fetch("../../control/seller/login_process.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                loading.style.display = "none";
                
                if (data.success) {
                    // Show success message
                    const successMessage = document.createElement("p");
                    successMessage.classList.add("success-message");
                    successMessage.textContent = data.message;
                    messageContainer.appendChild(successMessage);
                    
                    // Redirect after a short delay
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                } else {
                    // Show error message
                    const errorMessage = document.createElement("p");
                    errorMessage.classList.add("error-message");
                    errorMessage.textContent = data.message;
                    messageContainer.appendChild(errorMessage);
                }
            })
            .catch(error => {
                loading.style.display = "none";
                
                // Show error message
                const errorMessage = document.createElement("p");
                errorMessage.classList.add("error-message");
                errorMessage.textContent = "An error occurred during login. Please try again.";
                messageContainer.appendChild(errorMessage);
                
                console.error("Error:", error);
            });
        });
    }
});