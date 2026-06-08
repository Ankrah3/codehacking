import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;
Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".toggle-password").forEach((button) => {
        button.addEventListener("click", () => {
            const wrapper = button.closest(".input-group");
            const passwordField = wrapper.querySelector(".password-field");
            const icon = button.querySelector("i");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.replace("bi-eye", "bi-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.replace("bi-eye-slash", "bi-eye");
            }
        });
    });
});
