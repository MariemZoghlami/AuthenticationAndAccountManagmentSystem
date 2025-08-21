document.addEventListener("DOMContentLoaded", () => {
    const menuBtn = document.getElementById("menu-btn");
    const menuOptions = document.getElementById("menu-options");

    menuBtn.addEventListener("click", () => {
        menuOptions.classList.toggle("hidden");
    });
});
