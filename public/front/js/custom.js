$(document).ready(function () {
    $(".getPrice").change(function () {
        var size = $(this).val();
        var product_id = $(this).attr("product_id");

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/get-attribute-price",
            data: { size: size, product_id: product_id },
            type: "post",
            success: function (resp) {
                if (resp["discount"] > 0) {
                    $(".getAttributePrice").html(
                        "<span class='FinalPrice'>" +
                            resp["final_price"] +
                            "$</span> <span class='offerPercentage'>( " +
                            resp["discount_percent"] +
                            " /% OFF)</span> <span class='dicPrice'>" +
                            resp["product_price"] +
                            "$</span> "
                    );
                } else {
                    $(".getAttributePrice").html(
                        " <span class='FinalPrice'>" +
                            resp["final_price"] +
                            "$</span> "
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });
    // add to cart
    $("#addToCart").submit(function (event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/add-to-cart",
            type: "post",
            data: formData,
            success: function (resp) {
                console.log(resp); // Log the response for debugging
                $(".totalCartItems").html(resp["totalCartItems"]);
                $("#appendCartItems").html(resp.view);
                $("#appendHeaderCartItems").html(resp.miniCartview);
                if (resp.status === true) {
                    showToast(resp.message);
                } else {
                    showToast(resp.message, "error");
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                alert(
                    "Error occurred during the AJAX request. Check the console for details."
                );
                console.log(xhr.responseText); // Log the response text for additional details
            },
        });
    });
    // update qty in cart items
    $(document).on("click", ".updateCartItem", function () {
        var quantity = $(this).data("qty");

        if ($(this).hasClass("fa-plus")) {
            new_qty = parseInt(quantity) + 1;
        }

        if ($(this).hasClass("fa-minus")) {
            if (quantity <= 1) {
                showToast("Item quantity must be 1 or greater", "error");
                return false; // Optionally, prevent further execution if needed
            }
            new_qty = parseInt(quantity) - 1;
        }
        var cartid = $(this).data("cartid");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { cartid: cartid, qty: new_qty },
            url: "/update-cart-item-qty",
            type: "post",
            success: function (resp) {
                $(".totalCartItems").html(resp.totalCartItems);
                if (resp.status === false) {
                    showToast(resp.message, "error");
                }
                $("#appendCartItems").html(resp.view);
                $("#appendHeaderCartItems").html(resp.miniCartview);
            },
            error: function () {
                showToast("error", "error");
            },
        });
    });
    // delete
    $(document).on("click", ".deleteCartItems", function () {
        var cartid = $(this).data("cartid");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { cartid: cartid },
            url: "/delete-cart-item",
            type: "post",
            success: function (resp) {
                $(".totalCartItems").html(resp.totalCartItems);
                showToast(resp.message); // Assuming your server response has a 'message' key
                $("#appendCartItems").html(resp.view);
                $("#appendHeaderCartItems").html(resp.miniCartview);
            },
            error: function () {
                showToast("An error occurred", "error");
            },
        });
    });
    // delete empty
    $(document).on("click", ".emptyCart", function () {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/empty-cart",
            type: "post",
            success: function (resp) {
                $(".totalCartItems").html(resp.totalCartItems);

                // Check if the cart was successfully emptied
                if (resp.status === true) {
                    showToast(resp.message);
                    $("#appendCartItems").html(resp.view);
                    $("#appendHeaderCartItems").html(resp.miniCartview);
                } else {
                    // Handle the case where the cart is already empty
                    showToast("No items to delete.", "info");
                }
            },
            error: function () {
                showToast("An error occurred", "error");
            },
        });
    });
    // register form
    $("#registerForm").submit(function (event) {
        event.preventDefault(); // Prevent the default form submission

        var formData = $(this).serialize();

        $.ajax({
            url: "/user/register",
            type: "post",
            data: formData,
            success: function (resp) {
                window.location.href = resp.url;
            },
            error: function () {
                alert("error");
            },
        });
    });
});
