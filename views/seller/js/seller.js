document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");

    // Collect all input elements
    const fields = {
        fullName: document.getElementById("full_name"),
        email: document.getElementById("email"),
        password: document.getElementById("password"),
        confirmPassword: document.getElementById("confirm_password"),
        profilePicture: document.getElementById("profile_picture"),
        phone: document.getElementById("phone"),
        dob: document.getElementById("dob"),
        skills: document.getElementById("skills"),
        portfolio: document.getElementById("portfolio"),
        hours: document.getElementById("hours"),
        paymentMethods: document.getElementsByName("payment"),
        aboutYou: document.getElementById("about_you"),
        termsAndConditions: document.getElementById("terms"),
    };

    // event listener for form submission
    form.addEventListener("submit", (event) => {
        let isFormValid = true;

        // Clear any existing warnings
        document.querySelectorAll(".warning").forEach(warning => warning.remove());

        // Validate each field
        if (!validateFullName(fields.fullName)) isFormValid = false;
        if (!validateEmail(fields.email)) isFormValid = false;
        if (!validatePassword(fields.password)) isFormValid = false;
        if (!validatePasswordConfirmation(fields.password, fields.confirmPassword)) isFormValid = false;
        if (!validateProfilePicture(fields.profilePicture)) isFormValid = false;
        if (!validatePhoneNumber(fields.phone)) isFormValid = false;
        if (!validateDateOfBirth(fields.dob)) isFormValid = false;
        if (!validateSkillsSelection(fields.skills)) isFormValid = false;
        if (!validatePortfolioLink(fields.portfolio)) isFormValid = false;
        if (!validateWorkingHours(fields.hours)) isFormValid = false;
        if (!validatePaymentMethod(fields.paymentMethods)) isFormValid = false;
        if (!validateAboutYouSection(fields.aboutYou)) isFormValid = false;
        if (!validateTermsAgreement(fields.termsAndConditions)) isFormValid = false;

        // Prevent form submission if validation fails
        if (!isFormValid) {
            event.preventDefault();
        }
    });

    // Validation functions
    function validateFullName(input) {
        if (!input.value.trim()) {
            displayWarning(input, "Please enter your full name.");
            return false;
        }
        for (let char of input.value.trim()) {
            if (!((char >= 'A' && char <= 'Z') || (char >= 'a' && char <= 'z') || char === ' ')) {
            displayWarning(input, "Full name can only contain letters and spaces.");
            return false;
            }
        }
        return true;
    }

    function validateEmail(input) {
        if (!input.value.trim()) {
            displayWarning(input, "Email address is required.");
            return false;
        }
        if (!input.value.includes("@") || !input.value.includes(".")) {
            displayWarning(input, "Please enter a valid email address.");
            return false;
        }
        return true;
    }

    function validatePassword(input) {
        if (!input.value.trim()) {
            displayWarning(input, "Password cannot be empty.");
            return false;
        }
        return true;
    }

    function validatePasswordConfirmation(passwordInput, confirmPasswordInput) {
        if (passwordInput.value !== confirmPasswordInput.value) {
            displayWarning(confirmPasswordInput, "Passwords do not match.");
            return false;
        }
        return true;
    }

    function validateProfilePicture(input) {
        if (!input.value) {
            displayWarning(input, "Please upload a profile picture.");
            return false;
        }
        return true;
    }

    function validatePhoneNumber(input) {
        if (!input.value.trim() || input.value.trim().length !== 10 || isNaN(input.value.trim())) {
            displayWarning(input, "Phone number must be exactly 10 digits and contain only numbers.");
            return false;
        }
        return true;
    }

    function validateDateOfBirth(input) {
        if (!input.value) {
            displayWarning(input, "Date of birth is required.");
            return false;
        }
        return true;
    }

    function validateSkillsSelection(input) {
        if (!input.value) {
            displayWarning(input, "Please select at least one skill.");
            return false;
        }
        return true;
    }

    function validatePortfolioLink(input) {
        if (!input.value) {
            displayWarning(input, "Portfolio link is required.");
            return false;
        }
        return true;
    }

    function validateWorkingHours(input) {
        const hours = parseInt(input.value, 10);
        if (!hours || hours < 1 || hours > 168) {
            displayWarning(input, "Working hours must be between 1 and 168.");
            return false;
        }
        return true;
    }

    function validatePaymentMethod(paymentInputs) {
            if (![...paymentInputs].some(payment => payment.checked)) {
                displayWarning(paymentInputs[0].parentElement, "Please select a payment method.");
                return false;
            }
        return true;
    }

    function validateAboutYouSection(input) {
        if (!input.value.trim()) {
            displayWarning(input, "Tell us something about yourself.");
            return false;
        }
        return true;
    }

    function validateTermsAgreement(input) {
        if (!input.checked) {
            displayWarning(input, "You must agree to the terms and conditions.");
            return false;
        }
        return true;
    }

    // Helper function to display warnings
    function displayWarning(element, message) {
        const warningMessage = document.createElement("div");
        warningMessage.className = "warning";
        warningMessage.style.color = "red";
        warningMessage.style.fontSize = "10px";
        warningMessage.textContent = message;
        element.parentElement.appendChild(warningMessage);
    }
});


