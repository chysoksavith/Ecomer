$(document).ready(function () {
    $("#current_password").keyup(function () {
        var current_password = $("#current_password").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: '/admin/check-current-password',
            data: { current_password: current_password },
            success: function (response) {
                if (response == "false") {
                    $("#verifyCurrentPwd").html(
                        "current password is incorrect"
                    );
                } else if (response == "true") {
                    $("#verifyCurrentPwd").html(
                        "current password is correct"
                    );
                }
            },
            error: function () {
                alert("error");
            },
        });
    });
});
