const headerNav = document.getElementById('headerNav');
let lastScrollTop = 0;

window.addEventListener('scroll', function() {
    let scrollTop = window.pageYOffset || document.documenrElement.scrollTop;
    if (scrollTop > lastScrollTop) {
        headerNav.classList.add('nav-scroll');
    } else {
        headerNav.classList.remove('nav-scroll');
    }
    lastScrollTop = scrollTop;
})
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
    document.querySelector('.backdrop').className = 'backdrop active';
    document.querySelector('aside').className = 'active';
}
const closeMenu = () => {
    document.querySelector('.backdrop').className = 'backdrop';
    document.querySelector('aside').className = '';
}

document.getElementById('menuBtn').onclick = e => {
    e.preventDefault();
    openMenu();
}
document.querySelector('aside button.close').onclick = e => {
    closeMenu();
}
document.querySelector('.backdrop').onclick = e => {
    closeMenu();
}
