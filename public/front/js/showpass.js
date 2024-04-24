document.addEventListener("DOMContentLoaded", function () {
    // Your JavaScript code here
    document
        .getElementById("showPasswordCheckbox")
        .addEventListener("change", function () {
            var passwordInput = document.getElementById("passwordInput");
            passwordInput.type = this.checked ? "text" : "password";
        });
});
