// side bar menu filter in age listing
const openMenuFiler = () => {
    document.querySelector(".backdrop_filter").classList.add("active");

    const sideFilterWrappers = document.getElementsByClassName(
        "side_filter_wrapper"
    );
    for (let i = 0; i < sideFilterWrappers.length; i++) {
        sideFilterWrappers[i].classList.add("visible");
    }
};

const closeMenuFilter = () => {
    document.querySelector(".backdrop_filter").classList.remove("active");
    const sideFilterWrappers = document.getElementsByClassName(
        "side_filter_wrapper"
    );
    for (let i = 0; i < sideFilterWrappers.length; i++) {
        sideFilterWrappers[i].classList.remove("visible");
    }
};

document.addEventListener("DOMContentLoaded", function () {
    // Your JavaScript code here
    document
        .getElementById("menuBtnFilterListing")
        .addEventListener("click", (e) => {
            e.preventDefault();
            openMenuFiler();
        });

    document
        .querySelector(".backdrop_filter")
        .addEventListener("click", (e) => {
            closeMenuFilter();
        });

    document
        .querySelector(".side_filter_wrapper .closeFilter")
        .addEventListener("click", (e) => {
            closeMenuFilter();
        });
});
