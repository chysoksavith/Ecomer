const headerNav = document.getElementById("headerNav");
let lastScrollTop = 0;

window.addEventListener("scroll", function () {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop) {
        headerNav.classList.add("nav-scroll");
    } else {
        headerNav.classList.remove("nav-scroll");
    }

    lastScrollTop = scrollTop;
});

// document.addEventListener("click", (e) => {
//     const isDropdownMenu = e.target.matches("[data-dropdown-button]");

//     if (!isDropdownMenu && e.target.closest("[data-dropdown]") !== null) return;

//     let currentDropdown;

//     if (isDropdownMenu) {
//         currentDropdown = e.target.closest("[data-dropdown]");
//         currentDropdown.classList.toggle("active");
//     }

//     document.querySelectorAll("[data-dropdown].active").forEach((dropdown) => {
//         if (dropdown === currentDropdown) return;
//         dropdown.classList.remove("active");
//         $(".header_nav").removeClass("white-background");
//     });
// });
document.addEventListener("click", (e) => {
    const isDropdownMenu = e.target.matches("[data-dropdown-button]");
    const headerNav = document.getElementById("headerNav");

    if (!isDropdownMenu && e.target.closest("[data-dropdown]") !== null) return;

    let currentDropdown;

    if (isDropdownMenu) {
        currentDropdown = e.target.closest("[data-dropdown]");
        const isActive = currentDropdown.classList.contains("active");
        document.querySelectorAll("[data-dropdown].active").forEach((dropdown) => {
            dropdown.classList.remove("active");
        });
        if (!isActive) {
            currentDropdown.classList.add("active");
            headerNav.classList.add("active-header");
        } else {
            headerNav.classList.remove("active-header");
        }
    } else {
        document.querySelectorAll("[data-dropdown].active").forEach((dropdown) => {
            dropdown.classList.remove("active");
        });
        headerNav.classList.remove("active-header");
    }
});

// sidebar menu header
const openMenu = () => {
    document.querySelector(".backdrop").classList.add("active");
    document.querySelector("aside").classList.add("active");
};

const closeMenu = () => {
    document.querySelector(".backdrop").classList.remove("active");
    document.querySelector("aside").classList.remove("active");
};

document.getElementById("menuBtn").addEventListener("click", (e) => {
    e.preventDefault();
    openMenu();
});

document.querySelector("aside button.close").addEventListener("click", (e) => {
    closeMenu();
});

document.querySelector(".backdrop").addEventListener("click", (e) => {
    closeMenu();
});
// side bar account in page  header
const openSideBarAcc = () => {
    document.querySelector(".backdrop_Account").classList.add("active");
    var elements = document.getElementsByClassName("side_Account_wrapper");
    for (var i = 0; i < elements.length; i++) {
        elements[i].classList.add("active");
    }
};
const closeSideBarAcc = () => {
    document.querySelector(".backdrop_Account").classList.remove("active");
    var elements = document.getElementsByClassName("side_Account_wrapper");
    for (var i = 0; i < elements.length; i++) {
        elements[i].classList.remove("active");
    }
};
document.getElementById("myDropdownAccount").addEventListener("click", (e) => {
    openSideBarAcc();
});
var closeAccountElements = document.getElementsByClassName("closeAccount");
for (var i = 0; i < closeAccountElements.length; i++) {
    closeAccountElements[i].addEventListener("click", function (e) {
        e.preventDefault();
        closeSideBarAcc();
    });
}

var backdropAccountElements =
    document.getElementsByClassName("backdrop_Account");
for (var j = 0; j < backdropAccountElements.length; j++) {
    backdropAccountElements[j].addEventListener("click", function () {
        closeSideBarAcc();
    });
}
