$(document).ready(function () {
    // register form validation
    $("#registerForm").submit(function (event) {
        event.preventDefault(); // Prevent the default form submission
        $(".loader").show();
        var formData = $(this).serialize();

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/user/register",
            type: "post",
            data: formData,
            success: function (data) {
                $(".loader").hide();
                if (data.type === "validation") {
                    $.each(data.error, function (field, error) {
                        $("#register-" + field).attr(
                            "style",
                            "color:red; font-size: 14px"
                        );
                        $("#register-" + field).html(error);
                        setTimeout(function () {
                            $("#register-" + field).css({ display: "none" });
                        }, 4000);
                    });
                } else if (data.type === "success") {
                    $("#register-success").attr("style", "color:green");
                    showToast(data.message, "success");
                    // Redirect after showing the toast
                    setTimeout(function () {
                        window.location.href = data.url;
                    }, 5000); // Adjust the timeout as needed
                }
            },
            error: function () {
                $(".loader").hide();
                showToast("something went wrong", "error");
            },
        });
    });
    // Function to handle userlogin form submission

    // $("#sidebarLoginForm").submit(function () {
    //     // Validation and submission logic for userlogin form
    //     var formData = $(this).serialize();
    //     var formId = $(this).attr("id");
    //     $(".loader").show();

    //     $.ajax({
    //         headers: {
    //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    //         },
    //         url: "/user/login",
    //         type: "post",
    //         data: formData,
    //         success: function (resp) {
    //             $(".loader").hide();

    //             if (resp.type === "error") {
    //                 $.each(resp.error, function (field, error) {
    //                     $("#" + formId + " #" + field + "-error")
    //                         .html(error)
    //                         .css({
    //                             color: "red",
    //                             "font-size": "14px",
    //                         })
    //                         .show();
    //                     setTimeout(function () {
    //                         $("#" + formId + " #" + field + "-error").hide();
    //                     }, 4000);
    //                 });
    //             } else if (resp.type === "inactive") {
    //                 showToast(resp.message, "error", "Account Inactive");
    //             } else if (resp.type === "incorrect") {
    //                 showToast(resp.message, "error", "Incorrect Credentials");
    //             } else if (resp.type === "success") {
    //                 window.location.href = resp.url;
    //             }
    //         },
    //         error: function () {
    //             $(".loader").hide();

    //             showToast("Something went wrong", "error");
    //         },
    //     });
    // });
    // $("#userLoginForm").submit(function () {
    //     // Validation and submission logic for userlogin form
    //     var formData = $(this).serialize();
    //     var formId = $(this).attr("id");
    //     $(".loader").show();

    //     $.ajax({
    //         headers: {
    //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    //         },
    //         url: "/user/login",
    //         type: "post",
    //         data: formData,
    //         success: function (resp) {
    //             $(".loader").hide();
    //             if (resp.type === "error") {
    //                 $.each(resp.error, function (field, error) {
    //                     $("#" + formId + " #" + field + "-error")
    //                         .html(error)
    //                         .css({
    //                             color: "red",
    //                             "font-size": "14px",
    //                         })
    //                         .show();
    //                     setTimeout(function () {
    //                         $("#" + formId + " #" + field + "-error").hide();
    //                     }, 4000);
    //                 });
    //             } else if (resp.type === "inactive") {
    //                 showToast(resp.message, "error", "Account Inactive");
    //             } else if (resp.type === "incorrect") {
    //                 showToast(resp.message, "error", "Incorrect Credentials");
    //             } else if (resp.type === "success") {
    //                 window.location.href = resp.url;
    //             }
    //         },
    //         error: function () {
    //             $(".loader").hide();
    //             showToast("Something went wrong", "error");
    //         },
    //     });
    // });

    // // Function to handle aside form submission
    // $("#asideLoginForm").submit(function () {
    //     // Validation and submission logic for aside form
    //     var formData = $(this).serialize();
    //     var formId = $(this).attr("id");
    //     $(".loader").show();

    //     $.ajax({
    //         headers: {
    //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    //         },
    //         url: "/user/login",
    //         type: "post",
    //         data: formData,
    //         success: function (resp) {
    //             $(".loader").hide();

    //             if (resp.type === "error") {
    //                 $.each(resp.error, function (field, error) {
    //                     $("#" + formId + " #" + field + "-error")
    //                         .html(error)
    //                         .css({
    //                             color: "red",
    //                             "font-size": "14px",
    //                         })
    //                         .show();
    //                     setTimeout(function () {
    //                         $("#" + formId + " #" + field + "-error").hide();
    //                     }, 4000);
    //                 });
    //             } else if (resp.type === "inactive") {
    //                 showToast(resp.message, "error", "Account Inactive");
    //             } else if (resp.type === "incorrect") {
    //                 showToast(resp.message, "error", "Incorrect Credentials");
    //             } else if (resp.type === "success") {
    //                 window.location.href = resp.url;
    //             }
    //         },
    //         error: function () {
    //             $(".loader").hide();

    //             showToast("Something went wrong", "error");
    //         },
    //     });
    // });
    function handleFormSubmission(formId) {
        var formData = $("#" + formId).serialize();
        $(".loader").show(); // Show loader

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/user/login",
            type: "post",
            data: formData,
            success: function (resp) {
                $(".loader").hide(); // Hide loader after AJAX request

                if (resp.type === "error") {
                    $.each(resp.error, function (field, error) {
                        $("#" + formId + " #" + field + "-error")
                            .html(error)
                            .css({
                                color: "red",
                                "font-size": "14px",
                            })
                            .show();
                        setTimeout(function () {
                            $("#" + formId + " #" + field + "-error").hide();
                        }, 4000);
                    });
                } else if (resp.type === "inactive") {
                    showToast(resp.message, "error", "Account Inactive");
                } else if (resp.type === "incorrect") {
                    showToast(resp.message, "error", "Incorrect Credentials");
                } else if (resp.type === "success") {
                    showToast(resp.message);
                    window.location.href = resp.url;
                }
            },
            error: function () {
                $(".loader").hide(); // Hide loader on AJAX error
                showToast("Something went wrong", "error");
            },
        });
    }

    // Form submissions
    $("#sidebarLoginForm").submit(function () {
        handleFormSubmission("sidebarLoginForm"); // Call function to handle sidebar form submission
    });

    $("#userLoginForm").submit(function () {
        handleFormSubmission("userLoginForm"); // Call function to handle user login form submission
    });

    // Function to handle aside form submission
    $("#asideLoginForm").submit(function () {
        handleFormSubmission("asideLoginForm"); // Call function to handle aside form submission
    });
    // ----------------------------------------------------------------------------------------
    //forgot password
    $("#forgotForm").submit(function () {
        $(".loader").show();
        var formData = $(this).serialize();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/user/forgot-password",
            type: "post",
            data: formData,
            success: function (resp) {
                $(".loader").hide();
                if (resp.type === "error") {
                    $.each(resp.errors, function (i, error) {
                        showToast(error, "error", "Error");
                    });
                } else if (resp.type === "success") {
                    showToast(resp.message, "success", "Success");
                }
            },
            error: function () {
                $(".loader").hide();
                showToast("something went wrong", "error");
            },
        });
    });
    // reset password
    $("#resetFormPwd").submit(function () {
        $(".loader").show();
        var formData = $(this).serialize();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/user/reset-password",
            type: "post",
            data: formData,
            success: function (resp) {
                $(".loader").hide();
                if (resp.type === "error") {
                    $.each(resp.errors, function (i, error) {
                        showToast(error, "error", "Error");
                    });
                } else if (resp.type === "success") {
                    showToast(resp.message, "success", "Success");
                }
            },
            error: function () {
                $(".loader").hide();
                showToast("something went wrong", "error");
            },
        });
    });
    // show pass
});
