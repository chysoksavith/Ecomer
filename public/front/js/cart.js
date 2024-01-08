// document.addEventListener("DOMContentLoaded", function () {
//     var bagIcon = document.getElementById("bagIcon");
//     var sidebar = document.getElementById("sidebar");
//     var closeBtn = document.getElementById("closeBtn");

//     bagIcon.addEventListener("click", function () {
//         console.log("Bag icon clicked");
//         toggleSidebar();
//     });

//     closeBtn.addEventListener("click", function () {
//         console.log("Close button clicked");
//         closeSidebar();
//     });

//     function toggleSidebar() {
//         console.log("Toggling sidebar");
//         sidebar.classList.toggle("open");
//     }

//     function closeSidebar() {
//         console.log("Closing sidebar");
//         sidebar.classList.remove("open");
//     }
// });
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdownminiCart").classList.toggle("show");
  }

  // Close the dropdown if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtnminiCart')) {
      var dropdowns = document.getElementsByClassName("dropdown-contentminiCart");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
