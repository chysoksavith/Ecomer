// update status in admin panel dashboard
$(document).ready(function () {
    // update subadmin Status
    $(document).on("click", ".updateSubAdmin", function () {
        var status = $(this).find("i").attr("status");
        var subadmin_id = $(this).attr("subadmin_id");

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-subadmin-status",
            data: { status: status, subadmin_id: subadmin_id },
            success: function (response) {
                if (response["status"] == 0) {
                    $("#subadmin-" + subadmin_id).html(
                        "<i class='fas fa-toggle-off' style='color:grey;' status='Inactive'></i>"
                    );
                } else if (response["status"] == 1) {
                    $("#subadmin-" + subadmin_id).html(
                        "<i class='fas fa-toggle-on' style='color:blue;' status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error occurred during AJAX request");
            },
        });
    });
    // update Category Status
    $(document).on("click", ".updateCategoryStatus", function () {
        var status = $(this).find("i").attr("status");
        var category_id = $(this).attr("category_id");

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-category-status",
            data: { status: status, category_id: category_id },
            success: function (response) {
                if (response["status"] == 0) {
                    $("#category-" + category_id).html(
                        "<i class='fas fa-toggle-off' style='color:grey;' status='Inactive'></i>"
                    );
                } else if (response["status"] == 1) {
                    $("#category-" + category_id).html(
                        "<i class='fas fa-toggle-on' style='color:blue;' status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error occurred during AJAX request");
            },
        });
    });
    // update Product Status
    $(document).on("click", ".updateProductStatus", function () {
        var status = $(this).find("i").attr("status");
        var product_id = $(this).attr("product_id");

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-product-status",
            data: { status: status, product_id: product_id },
            success: function (response) {
                if (response["status"] == 0) {
                    $("#product-" + product_id).html(
                        "<i class='fas fa-toggle-off' style='color:grey;' status='Inactive'></i>"
                    );
                } else if (response["status"] == 1) {
                    $("#product-" + product_id).html(
                        "<i class='fas fa-toggle-on' style='color:blue;' status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error occurred during AJAX request");
            },
        });
    });
    // update Attr Status
    $(document).on("click", ".updateAttributeStatus", function () {
        var status = $(this).find("i").attr("status");
        var attribute_id = $(this).attr("attribute_id");

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-attribute-status",
            data: { status: status, attribute_id: attribute_id },
            success: function (response) {
                if (response["status"] == 0) {
                    $("#attribute-" + attribute_id).html(
                        "<i class='fas fa-toggle-off' style='color:grey;' status='Inactive'></i>"
                    );
                } else if (response["status"] == 1) {
                    $("#attribute-" + attribute_id).html(
                        "<i class='fas fa-toggle-on' style='color:blue;' status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error occurred during AJAX request");
            },
        });
    });
    // update Attr Status
    $(document).on("click", ".updateBrandStatus", function () {
        var status = $(this).find("i").attr("status");
        var brand_id = $(this).attr("brand_id");

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-brand-status",
            data: { status: status, brand_id: brand_id },
            success: function (response) {
                if (response["status"] == 0) {
                    $("#brand-" + brand_id).html(
                        "<i class='fas fa-toggle-off' style='color:grey;' status='Inactive'></i>"
                    );
                } else if (response["status"] == 1) {
                    $("#brand-" + brand_id).html(
                        "<i class='fas fa-toggle-on' style='color:blue;' status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error occurred during AJAX request");
            },
        });
    });
    // update Banner Status
    $(document).on("click", ".updatebannerStatus", function () {
        var status = $(this).find("i").attr("status");
        var banner_id = $(this).attr("banner_id");

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-banner-status",
            data: { status: status, banner_id: banner_id },
            success: function (response) {
                if (response["status"] == 0) {
                    $("#banner-" + banner_id).html(
                        "<i class='fas fa-toggle-off' style='color:grey;' status='Inactive'></i>"
                    );
                } else if (response["status"] == 1) {
                    $("#banner-" + banner_id).html(
                        "<i class='fas fa-toggle-on' style='color:blue;' status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error occurred during AJAX request");
            },
        });
    });
    // update status Coupon
    $(document).on("click", ".updatecouponStatus", function () {
        var status = $(this).find("i").attr("status");
        var coupon_id = $(this).attr("coupon_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-coupon-status",
            data: { status: status, coupon_id: coupon_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#coupon-" + coupon_id).html(
                        "<i class='fas fa-toggle-off' style='color:grey;' status='Inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#coupon-" + coupon_id).html(
                        "<i class='fas fa-toggle-on' style='color:blue;' status='Active'></i>"
                    );
                }
            },
        });
    });
    // update status Users
    $(document).on("click", ".updateuserstatus", function () {
        var status = $(this).find("i").attr("status");
        var user_id = $(this).attr("user_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-user-status",
            data: { status: status, user_id: user_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#user-" + user_id).html(
                        "<i class='fas fa-toggle-off' style='color:grey;' status='Inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#user-" + user_id).html(
                        "<i class='fas fa-toggle-on' style='color:blue;' status='Active'></i>"
                    );
                }
            },
        });
    });
    // update status subscribe
    $(document).on("click", ".updatesubscriberstatus", function () {
        var status = $(this).find("i").attr("status");
        var subscriber_id = $(this).attr("subscriber_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-user-subscriber",
            data: { status: status, subscriber_id: subscriber_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#subscriber-" + subscriber_id).html(
                        "<i class='fas fa-toggle-off' style='color:grey;' status='Inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#subscriber-" + subscriber_id).html(
                        "<i class='fas fa-toggle-on' style='color:blue;' status='Active'></i>"
                    );
                }
            },
        });
    });
    // update status Rating
    $(document).on("click", ".updateRatingstatus", function () {
        var status = $(this).find("i").attr("status");
        var rating_id = $(this).attr("rating_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-user-rating",
            data: { status: status, rating_id: rating_id },
            success: function (resp) {
                if (resp.status == 0) {
                    $("#rating-" + rating_id).html(
                        "<i class='fas fa-toggle-off' style='color:grey;' status='Inactive'></i>"
                    );
                } else if (resp.status == 1) {
                    $("#rating-" + rating_id).html(
                        "<i class='fas fa-toggle-on' style='color:blue;' status='Active'></i>"
                    );
                }
            },
        });
    });
    // update status shipping
    $(document).on("click", ".updatShippingstatus", function () {
        var status = $(this).find("i").attr("status");
        var shipping_id = $(this).attr("shipping_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-shipping-status",
            data: { status: status, shipping_id: shipping_id },
            success: function (resp) {
                if (resp.status == 0) {
                    $("#shipping-" + shipping_id).html(
                        "<i class='fas fa-toggle-off' style='color:grey;' status='Inactive'></i>"
                    );
                } else if (resp.status == 1) {
                    $("#shipping-" + shipping_id).html(
                        "<i class='fas fa-toggle-on' style='color:blue;' status='Active'></i>"
                    );
                }
            },
        });
    });
    // update status color
    $(document).on("click", ".updateColorStatus", function () {
        var status = $(this).find("i").attr("status");
        var color_id = $(this).attr("color_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-color-status",
            data: { status: status, color_id: color_id },
            success: function (resp) {
                if (resp.status == 0) {
                    $("#color-" + color_id).html(
                        "<i class='fas fa-toggle-off' style='color:grey;' status='Inactive'></i>"
                    );
                } else if (resp.status == 1) {
                    $("#color-" + color_id).html(
                        "<i class='fas fa-toggle-on' style='color:blue;' status='Active'></i>"
                    );
                }
            },
        });
    });
    // update status color
    $(document).on("click", ".updatLocalShippingstatus", function () {
        var status = $(this).find("i").attr("status");
        var localshipping_id = $(this).attr("localshipping_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-Localshipping-status",
            data: { status: status, localshipping_id: localshipping_id },
            success: function (resp) {
                if (resp.status == 0) {
                    $("#localshipping-" + localshipping_id).html(
                        "<i class='fas fa-toggle-off' style='color:grey;' status='Inactive'></i>"
                    );
                } else if (resp.status == 1) {
                    $("#localshipping-" + localshipping_id).html(
                        "<i class='fas fa-toggle-on' style='color:blue;' status='Active'></i>"
                    );
                }
            },
        });
    });
    // logo
    $(document).on("click", ".updateLogoStatus", function () {
        var status = $(this).find("i").attr("status");
        var logo_id = $(this).attr("logo_id");

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/logo-update-status",
            data: { status: status, logo_id: logo_id },
            success: function (resp) {
                if (resp.status == 0) {
                    $("#logo-" + logo_id).html(
                        "<i class='fas fa-toggle-off' style='color:grey;' status='Inactive'></i>"
                    );
                } else if (resp.status == 1) {
                    $("#logo-" + logo_id).html(
                        "<i class='fas fa-toggle-on' style='color:blue;' status='Active'></i>"
                    );
                }
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
                alert("Something went wrong. Please try again.");
            },
        });
    });
});
