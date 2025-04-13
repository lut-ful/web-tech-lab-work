document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("customerForm");

    form.addEventListener("submit", function (e) {
        let valid = true;
        let messages = [];

        const fullName = document.getElementById("full_name").value.trim();
        const email = document.getElementById("email").value.trim();
        const username = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirm_password").value;
        const terms = document.getElementById("terms").checked;

        if (fullName.length < 3) {
            valid = false;
            messages.push("Full Name must be at least 3 characters.");
        }

        const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        if (!emailPattern.test(email)) {
            valid = false;
            messages.push("Enter a valid email address.");
        }

        if (username.length < 4) {
            valid = false;
            messages.push("Username must be at least 4 characters.");
        }

        if (password.length < 8) {
            valid = false;
            messages.push("Password must be at least 6 characters.");
        }

        if (password !== confirmPassword) {
            valid = false;
            messages.push("Passwords do not match.");
        }

        if (!terms) {
            valid = false;
            messages.push("You must agree to the terms and conditions.");
        }

        if (!valid) {
            e.preventDefault();
            alert(messages.join("\n"));
        }
    });
});
