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
                // Round the final price and discount percent to 2 decimal places
                var finalPrice = resp["final_price"].toFixed(2);
                var discountPercent = resp["discount_percent"].toFixed(2);

                if (resp["discount"] > 0) {
                    $(".getAttributePrice").html(
                        "<span class='FinalPrice'>" +
                            finalPrice +
                            "$</span> <span class='offerPercentage'>( " +
                            discountPercent +
                            " % OFF)</span> <span class='dicPrice'>" +
                            resp["product_price"] +
                            "$</span> "
                    );
                } else {
                    $(".getAttributePrice").html(
                        " <span class='FinalPrice'>" + finalPrice + "$</span> "
                    );
                }
            },
            error: function () {
                showToast("something went wrong", "error");
            },
        });
    });
    // add to wishlist
    $(".updateWishlist").click(function (e) {
        e.preventDefault();
        var product_id = $(this).data("productid");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/update-wishlist",
            data: { product_id: product_id },
            success: function (resp) {
                if (resp.state == "add") {
                    showToast(resp.message);
                    $("span[data-productid=" + product_id + "]").html(
                        ' <i class="fa-solid fa-heart icoHead"></i>'
                    );
                } else if (resp.state == "remove") {
                    showToast(resp.message);
                    $("span[data-productid=" + product_id + "]").html(
                        ' <i class="fa-regular fa-heart icoHead"></i>'
                    );
                }
            },
            error: function () {
                showToast("Something went wrong", "error");
            },
        });
    });
    // delete wishlist item
    $(".deletewishlistItems").click(function (e) {
        e.preventDefault();
        var wishlist_id = $(this).data("wishlistid");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/delete-wishlist-item",
            data: { wishlist_id: wishlist_id },
            success: function (resp) {
                showToast(resp.message);
                $("#appendWishlist").html(resp.View);
            },
            error: function () {
                showToast("Something went wrong", "error");
            },
        });
    });

    // add to cart
    $("#addToCart").submit(function (event) {
        event.preventDefault();
        $(".loader").show();
        var formData = $(this).serialize();

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/add-to-cart",
            type: "post",
            data: formData,
            success: function (resp) {
                $(".loader").hide();
                $(".totalCartItems").html(resp["totalCartItems"]);
                $("#appendCartItems").html(resp.view);
                $("#appendHeaderCartItems").html(resp.miniCartview);
                if (resp.status === true) {
                    showToast(resp.message);
                } else {
                    showToast(resp.message, "error");
                }
            },
            error: function () {
                $(".loader").hide();
                showToast(
                    "Please select your Size first before you added to cart",
                    "error"
                );
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
        var page = $(this).data("page");

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
                if (page === "details") {
                    $(".MainMainContainerDetails").html(resp.detailPageView);
                }

                if (page == "Checkout") {
                    window.location.href = "/checkout";
                }
                window.location.reload();

                // You may want to add some handling here for the success case if needed
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
                    showToast("No items to delete.", "error");
                }
            },
            error: function () {
                showToast("An error occurred", "error");
            },
        });
    });
    // apply Coupon
    $(document).on("click", "#ApplyCoupon", function (event) {
        event.preventDefault(); // Prevent the default form submission behavior

        var user = $(this).attr("user");
        var message = "Please login first before you can apply.";
        if (user == 1) {
        } else {
            showToast(message);
        }

        var code = $("#code").val();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            data: { code: code },
            url: "/apply-coupon",
            success: function (resp) {
                if (resp.status == false) {
                    showToast(resp.message, "error");
                } else if (resp.status == true) {
                    if (resp.couponAmount > 0) {
                        $(".couponAmount").text(resp.couponAmount + "$");
                    } else {
                        $(".couponAmount").text("0$");
                    }
                    if (resp.grand_total > 0) {
                        $(".grandTotal").text(resp.grandTotal + "$");
                        $(".miniCartTotalPrice").text(resp.grandTotal + "$");
                    }
                    showToast(resp.message);
                    $(".totalCartItems").html(resp["totalCartItems"]);
                    $("#appendCartItems").html(resp.view);
                    $("#appendHeaderCartItems").html(resp.miniCartView);
                }
            },
            error: function () {
                showToast("An error occurred", "error");
            },
        });
    });
    // Submit NewSeller
    $(document).on("click", "#AddSubscriber", function (e) {
        e.preventDefault();
        var subscriber_email = $("#subscriber_email").val();
        var mailFormat = /\S+@\S+\.\S+/;
        if (subscriber_email.match(mailFormat)) {
        } else {
            showToast("Please enter valid Email.", "error");
            return false;
        }

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/add-subscriber-email",
            type: "post",
            data: { subscriber_email: subscriber_email },
            success: function (resp) {
                if (resp == "exists") {
                    showToast("You already subscribe", "error");
                } else if (resp == "saved") {
                    showToast("Thanks for subscribe");
                }
            },
            error() {
                showToast(
                    "Something went wrong please check your email",
                    "error"
                );
            },
        });
    });
    // review
    $(document).ready(function () {
        $("#formRating").on("submit", function (e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var rating = $('input[name="rating"]:checked').val();
            var review = $('textarea[name="review"]').val();

            if (!rating || !review) {
                showToast(
                    "Please rate and provide feedback before submitting",
                    "error"
                );
                return;
            }
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: "/add-rating",
                type: "POST",
                data: formData,
                success: function (response) {
                    if (response.success) {
                        showToast(response.message);
                        $(".loader").hide();
                        $("#formRating")[0].reset();
                        window.location.reload();
                    } else {
                        if (response.error) {
                            showToast(response.message, "error");
                        } else {
                            showToast(response.message, "error");
                        }
                    }
                },
                error: function () {
                    showToast("An error occurred", "error");
                },
            });
        });
    });
    // contact us
    $("#formContactUs").submit(function (e) {
        e.preventDefault();
        var form = $(this);

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: form.attr("action"),
            method: form.attr("method"),
            data: form.serialize(),
            beforeSend: function () {
                $(".loader").show(); // Show loader before AJAX request
            },
            success: function (response) {
                if (response.success) {
                    showToast(response.message);
                    $("#formContactUs")[0].reset(); // Reset form
                } else {
                    var errorMessage = "";
                    if (response.errors) {
                        $.each(response.errors, function (key, value) {
                            errorMessage += value + "<br>";
                        });
                    } else {
                        errorMessage =
                            "An error occurred. Please try again later.";
                    }
                    showToast(errorMessage, "Error");
                }
            },
            error: function () {
                showToast("An error occurred. Please try again later.");
            },
            complete: function () {
                $(".loader").hide(); // Hide loader after AJAX request completes
            },
        });
    });
    // Save delivery Address
    $(document).on("click", "#btnShipping", function () {
        $(".loader").show();
        var formData = $("#addressAddEditForm").serialize();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/save-delivery-address",
            type: "post",
            data: formData,
            success: function (resp) {
                if (resp.type == "error") {
                    $(".loader").hide();

                    $.each(resp.errors, function (field, error) {
                        $("#" + field + "-error").html(error[0]); // Assuming you have elements with IDs like delivery_name-error, delivery_address-error, etc.
                        $("#" + field + "-error").show();
                        setTimeout(function () {
                            $("#" + field + "-error").hide();
                        }, 4000);
                    });
                } else {
                    $(".loader").hide();
                    showToast("success");
                    $("#deliveryAddress").html(resp.view);
                    // Reset the form
                    $("#addressAddEditForm")[0].reset();
                    $(".deliveryText").text("Add New Delivery Address");
                    window.location.href = "checkout";
                }
            },
            error: function () {
                showToast(
                    "An error occurred. Please try again later.",
                    "Error"
                );
            },
        });
    });
    // edit checkout delivery address
    $(document).on("click", "#editAddress", function () {
        var addressid = $(this).data("addressid");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { addressid: addressid },
            url: "/get-delivery-address",
            type: "post",
            success: function (resp) {
                $(".deliveryText").text("Edit Delivery Address");
                $("[name=delivery_id]").val(resp.address["id"]);
                $("[name=delivery_name]").val(resp.address["name"]);
                $("[name=delivery_address]").val(resp.address["address"]);
                $("[name=delivery_city]").val(resp.address["city"]);
                $("[name=delivery_state]").val(resp.address["state"]);
                $("[name=delivery_country]").val(resp.address["country"]);
                $("[name=delivery_pincode]").val(resp.address["pincode"]);
                $("[name=delivery_mobile]").val(resp.address["mobile"]);
            },
            error: function () {
                showToast(
                    "An error occurred. Please try again later.",
                    "Error"
                );
            },
        });
    });
    // delete checkout delivery address
    $(document).on("click", "#deleteaddress", function () {
        var addressid = $(this).data("addressid");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { addressid: addressid },
            url: "/remove-delivery-address",
            type: "post",
            success: function (resp) {
                $("#deliveryAddress").html(resp.view);
                showToast(resp.message);
                window.location.href = "checkout";
            },
            error: function () {
                showToast(
                    "An error occurred. Please try again later.",
                    "Error"
                );
            },
        });
    });
    // default status delivery address
    $(document).on("click", ".setDefaultStatus", function () {
        var addressid = $(this).data("addressid");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/set-default-delivery-address",
            type: "post",
            data: { addressid: addressid },
            success: function (resp) {
                $("#deliveryAddress").html(resp.view);
                window.location.href = "checkout";
            },
            error: function () {
                showToast(
                    "An error occurred. Please try again later.",
                    "Error"
                );
            },
        });
    });
    // Cancel order
    $(document).on("click", "#cancelBtn", function () {
        var reason = $("#cancelReason").val();
        if (reason == "") {
            showToast(
                "Please Select The Reason For Canceling The Order",
                "Error"
            );
            return false;
        }
    });

    // live search

    $(document).on("keyup", "#searchHeader", function () {
        var value = $(this).val();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/search-live",
            type: "GET",
            data: { search: value },
            success: function (data) {
                if (value.trim() === "") {
                    $(".card__live").empty(); // Clear search results if input is empty
                } else {
                    $(".card__live").html(data); // Update search results with data
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    });
    // $(document).on("click", "#onClickBg", function(){
    //     $(".header_nav").toggleClass("white-backgroud");
    // })

    // show loader when place order
    $(document).on("click", "#placeOrderLoader", function () {
        $(".loader").show();
    });
    // toggle overflow scroll
});
