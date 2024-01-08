const headerNav = document.getElementById('headerNav');
let lastScrollTop = 0;

window.addEventListener('scroll', function() {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop) {
        headerNav.classList.add('nav-scroll');
    } else {
        headerNav.classList.remove('nav-scroll');
    }

    lastScrollTop = scrollTop;
});

document.addEventListener('click', e => {
    const isDropdownMenu = e.target.matches("[data-dropdown-button]");

    if (!isDropdownMenu && e.target.closest('[data-dropdown]') !== null) return;

    let currentDropdown;

    if (isDropdownMenu) {
        currentDropdown = e.target.closest('[data-dropdown]');
        currentDropdown.classList.toggle('active');
    }

    document.querySelectorAll("[data-dropdown].active").forEach(dropdown => {
        if (dropdown === currentDropdown) return;
        dropdown.classList.remove('active');
    });
});

const openMenu = () => {
    document.querySelector('.backdrop').classList.add('active');
    document.querySelector('aside').classList.add('active');
};

const closeMenu = () => {
    document.querySelector('.backdrop').classList.remove('active');
    document.querySelector('aside').classList.remove('active');
};

document.getElementById('menuBtn').addEventListener('click', e => {
    e.preventDefault();
    openMenu();
});

document.querySelector('aside button.close').addEventListener('click', e => {
    closeMenu();
});

document.querySelector('.backdrop').addEventListener('click', e => {
    closeMenu();
});
