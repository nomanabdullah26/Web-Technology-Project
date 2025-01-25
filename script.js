// Form Validation
function validateForm(event) {
    event.preventDefault(); // Prevent default form submission
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    if (username === "" || password === "") {
        alert("Both fields are required!");
        return false;
    }

    if (password.length < 4) {
        alert("Password must be at least 4 characters long!");
        return false;
    }

    // If everything is valid, submit the form
    document.getElementById("loginForm").submit();
}

// Toggle Password Visibility
function togglePasswordVisibility() {
    const passwordField = document.getElementById("password");
    const toggleIcon = document.getElementById("togglePassword");
    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.textContent = "🙈"; // Change icon
    } else {
        passwordField.type = "password";
        toggleIcon.textContent = "👁️"; // Change icon
    }
}

// Add Visual Effects on Input Focus
function addFocusEffect(input) {
    input.style.borderColor = "#333";
    input.style.boxShadow = "0 0 10px #333";
}

function removeFocusEffect(input) {
    input.style.borderColor = "#ccc";
    input.style.boxShadow = "none";
}

// Attach Event Listeners
document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("loginForm");
    loginForm.addEventListener("submit", validateForm);

    const passwordToggle = document.getElementById("togglePassword");
    passwordToggle.addEventListener("click", togglePasswordVisibility);

    const inputs = document.querySelectorAll("input");
    inputs.forEach(input => {
        input.addEventListener("focus", () => addFocusEffect(input));
        input.addEventListener("blur", () => removeFocusEffect(input));
    });
});
