
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
window.onclick = function (event) {
    // Check if the click is on the miniCart dropdown button
    if (event.target.matches('.dropbtnminiCart')) {
        var miniCartDropdown = document.getElementById("myDropdownminiCart");
        miniCartDropdown.classList.toggle("show");

        // Close the Account dropdown if it's open
        var accountDropdown = document.getElementById("myDropdownAccount");
        if (accountDropdown.classList.contains('show')) {
            accountDropdown.classList.remove('show');
        }
    }
    // Check if the click is on the Account dropdown button
    else if (event.target.matches('.dropbtnAccount')) {
        var accountDropdown = document.getElementById("myDropdownAccount");
        accountDropdown.classList.toggle("show");

        // Close the miniCart dropdown if it's open
        var miniCartDropdown = document.getElementById("myDropdownminiCart");
        if (miniCartDropdown.classList.contains('show')) {
            miniCartDropdown.classList.remove('show');
        }
    }
    // If the click is outside both dropdowns, close both
    else {
        var miniCartDropdown = document.getElementById("myDropdownminiCart");
        if (miniCartDropdown.classList.contains('show')) {
            miniCartDropdown.classList.remove('show');
        }

        var accountDropdown = document.getElementById("myDropdownAccount");
        if (accountDropdown.classList.contains('show')) {
            accountDropdown.classList.remove('show');
        }
    }
};
