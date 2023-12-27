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

                if (resp["status"] == true) {
                    $(".print-success-msg").show();
                    $(".print-success-msg").delay(3000).fadeOut("slow");
                    $(".print-success-msg").html(
                        "<div class='success'>" +
                            "<span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span>" +
                            resp["message"] +
                            "</div>"
                    );
                } else {
                    $(".print-error-msg").show();
                    $(".print-error-msg").delay(3000).fadeOut("slow");
                    $(".print-error-msg").html(
                        "<div class='alert'>" +
                            "<span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span>" +
                            resp["message"] +
                            "</div>"
                    );
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
});
