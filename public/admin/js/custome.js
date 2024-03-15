$(document).ready(function () {
    $("#current_password").keyup(function () {
        var current_password = $("#current_password").val();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/check-current-password",
            data: { current_password: current_password },
            success: function (response) {
                if (response == "false") {
                    $("#verifyCurrentPwd").html(
                        "current password is incorrect"
                    );
                } else if (response == "true") {
                    $("#verifyCurrentPwd").html("current password is correct");
                }
            },
            error: function () {
                alert("error");
            },
        });
    });
    // update Cms Page Status
    $(document).on("click", ".updateCmsPageStatus", function () {
        var status = $(this).find("i").attr("status");
        var page_id = $(this).attr("page_id");

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-cms-pages-status",
            data: { status: status, page_id: page_id },
            success: function (response) {
                if (response["status"] == 0) {
                    $("#page-" + page_id).html(
                        "<i class='fas fa-toggle-off' style='color:grey;' status='Inactive'></i>"
                    );
                } else if (response["status"] == 1) {
                    $("#page-" + page_id).html(
                        "<i class='fas fa-toggle-on' style='color:blue;' status='Active'></i>"
                    );
                }
            },
            error: function () {
                alert("Error occurred during AJAX request");
            },
        });
    });
    // delete confirm delete cms page
    $(document).on("click", ".confirmDelete", function () {
        var record = $(this).attr("record");
        var recordid = $(this).attr("recordid");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success",
                });
                window.location.href =
                    "/admin/delete-" + record + "/" + recordid;
            }
        });
    });

    // ---------------------------- Add Attr Script --------------------------------
    var maxField = 10; //Input fields increment limitation
    var addButton = $(".add_button"); //Add button selector
    var wrapper = $(".field_wrapper"); //Input field wrapper
    var fieldHTML =
        '<div><input type="text" name="size[]" style=" width: 120px;" placeholder="Size" /> <input type="text" name="sku[]" style=" width: 120px;" placeholder="sku"/> <input type="text" name="price[]" style=" width: 120px;"placeholder="price" /> <input type="text" name="stock[]" style=" width: 120px;"placeholder="stock" /><a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    // Once add button is clicked
    $(addButton).click(function () {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increase field counter
            $(wrapper).append(fieldHTML); //Add field html
        } else {
            alert(
                "A maximum of " + maxField + " fields are allowed to be added. "
            );
        }
    });

    // Once remove button is clicked
    $(wrapper).on("click", ".remove_button", function (e) {
        e.preventDefault();
        $(this).parent("div").remove(); //Remove field html
        x--; //Decrease field counter
    });

    // show/hide coupon field for manual/automatic
    $("#ManualCoupon").click(function () {
        $("#couponField").show();
    });
    // show/hide coupon field for manual/automatic
    $("#AutomticCoupon").click(function () {
        $("#couponField").hide();
    });
    // show courier name and tracking number in case of shipped order status
    $("#courier_name").hide();
    $("#tracking_number").hide();
    $("#order_status").on("change", function () {
        if (this.value == "Shipped") {
            $("#courier_name").show();
            $("#tracking_number").show();
        } else {
            $("#courier_name").hide();
            $("#tracking_number").hide();
        }
    });
});
