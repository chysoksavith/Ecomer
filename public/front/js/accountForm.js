$(document).ready(function () {
    $("#accountForm").submit(function () {
        var formData = $(this).serialize();
        $(".loader").show();
        $.ajax({
            url: "/user/account",
            type: "post",
            data: formData,
            success: function (data) {
                $(".loader").hide();

                if (data.type === "validation") {
                    $.each(data.errors, function (field, errors) {
                        $("#account-" + field)
                            .css({
                                color: "red",
                                fontSize: "13px",
                            })
                            .html(errors.join("<br>"))
                            .show()
                            .delay(4000) // Delay before fading out
                            .fadeOut(400); // Adjust the fadeOut duration
                    });
                    showToast("Error: Please fix the validation errors.");
                } else if (data.type === "success") {
                    showToast(data.message);
                }
            },

            error: function () {
                showToast("An error occurred", "error");
            },
        });
    });
});
