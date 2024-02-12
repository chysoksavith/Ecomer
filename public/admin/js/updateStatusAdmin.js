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
});
