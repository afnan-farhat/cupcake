function validateForm(isLogin = false) {
    let isValid = true;

    // Clear previous errors
    clearErrors();

    // Get field values
    const email = document.getElementById("email");
    const password = document.getElementById("password");

    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email.value)) {
        showError(email, "Please enter a valid email address.");
        isValid = false;
    }

    // Password validation for Sign-Up
    if (!isLogin) {
        const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).{8,}$/;
        if (!passwordRegex.test(password.value)) {
            showError(password, "Password must have 8+ characters, one uppercase letter, one number, and one special character.");
            isValid = false;
        }
    }

    return isValid;
}

// Function to show error message under field
function showError(inputElement, message) {
    const errorDiv = document.createElement("div");
    errorDiv.className = "error";
    errorDiv.innerText = message;
    inputElement.classList.add("invalid");
    inputElement.parentNode.appendChild(errorDiv);
}

// Clear all previous errors
function clearErrors() {
    const errorMessages = document.querySelectorAll(".error");
    errorMessages.forEach(error => error.remove());

    const inputs = document.querySelectorAll("input");
    inputs.forEach(input => input.classList.remove("invalid"));
}
