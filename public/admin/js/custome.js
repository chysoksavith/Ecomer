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
                })
                window.location.href = "/admin/delete-"+record+"/"+recordid;
            }
        });
    });
});
