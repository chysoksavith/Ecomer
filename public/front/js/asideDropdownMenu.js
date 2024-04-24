document.addEventListener("DOMContentLoaded", function () {
    const dropdownItems = document.querySelectorAll(".dropdown__item");

    dropdownItems.forEach((item) => {
        const dropdownLink = item.querySelector(".nav__link");
        const dropdownMenu = item.querySelector(".dropdown__menu");
        const hoverCate = dropdownLink.querySelector(".hover__cate");

        dropdownLink.addEventListener("click", function (event) {
            event.preventDefault();

            // Check if this item is already active
            const isActive = item.classList.contains("active");

            // Close all other dropdowns
            const activeDropdowns = document.querySelectorAll(
                ".dropdown__menu.show"
            );
            activeDropdowns.forEach((dropdown) => {
                dropdown.classList.remove("show");
                dropdown.closest(".dropdown__item").classList.remove("active");
                const hoverCate = dropdown
                    .closest(".dropdown__item")
                    .querySelector(".hover__cate");
                hoverCate.classList.remove("active");
            });

            // Open or close this dropdown based on its current state
            if (!isActive) {
                dropdownMenu.classList.add("show");
                item.classList.add("active");
                hoverCate.classList.add("active");
            }
        });

        // Handle subcategories
        const dropdownSubmenus = item.querySelectorAll(".dropdown__submenu");
        dropdownSubmenus.forEach((submenu) => {
            submenu.addEventListener("click", function (event) {
                event.stopPropagation();
            });
        });

        // Open submenus on click
        const dropdownLinks = item.querySelectorAll(".dropdown__link");
        dropdownLinks.forEach((link) => {
            link.addEventListener("click", function (event) {
                const submenu = link.nextElementSibling;
                submenu.classList.toggle("show");

                // Close other submenus
                const activeSubmenus = item.querySelectorAll(
                    ".dropdown__submenu.show"
                );
                activeSubmenus.forEach((sub) => {
                    if (sub !== submenu) {
                        sub.classList.remove("show");
                    }
                });
            });
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener("click", function (event) {
        if (!event.target.closest(".dropdown__item")) {
            const activeDropdowns = document.querySelectorAll(
                ".dropdown__menu.show"
            );
            activeDropdowns.forEach((dropdown) => {
                dropdown.classList.remove("show");
                dropdown.closest(".dropdown__item").classList.remove("active");
                const hoverCate = dropdown
                    .closest(".dropdown__item")
                    .querySelector(".hover__cate");
                hoverCate.classList.remove("active");
            });
        }
    });
});
