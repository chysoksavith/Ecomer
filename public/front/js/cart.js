// side bar menu cart in page header
const openMenuCart = () => {
    const backdropCart = document.querySelector(".backdrop_cart");
    if (backdropCart) {
        backdropCart.classList.add("active");
        backdropCart.addEventListener("click", closeMenuCart);
    }

    const sideBarMenuCart = document.getElementsByClassName("side_Cart_wrapper");
    for (let i = 0; i < sideBarMenuCart.length; i++) {
        sideBarMenuCart[i].classList.add("active");
    }
};

const closeMenuCart = () => {
    const backdropCart = document.querySelector(".backdrop_cart");
    if (backdropCart) {
        backdropCart.classList.remove("active");
        backdropCart.removeEventListener("click", closeMenuCart);
    }

    const sideBarMenuCart = document.getElementsByClassName("side_Cart_wrapper");
    for (let i = 0; i < sideBarMenuCart.length; i++) {
        sideBarMenuCart[i].classList.remove("active");
    }
};

var closeAccountElements = document.getElementsByClassName("closeCart");
for (var i = 0; i < closeAccountElements.length; i++) {
    closeAccountElements[i].addEventListener("click", function (e) {
        e.preventDefault();
        closeMenuCart(); // Call closeMenuCart() function when close icon is clicked
    });
}

document.getElementById("bagIcon").addEventListener("click", (e) => {
    console.log("bagIcon clicked."); // Check if bagIcon click event is triggered
    openMenuCart();
});
