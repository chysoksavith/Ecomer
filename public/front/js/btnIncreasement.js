$(document).ready(function () {
    $(".d-c").on("click", function () {
        var inputField = $(this).closest(".countInput").find(".qty");
        var minValue = parseInt(inputField.data("min"));
        var value = parseInt(inputField.val());

        if (value > minValue) {
            inputField.val(value - 1);
        }
    });

    $(".i-c").on("click", function () {
        var inputField = $(this).closest(".countInput").find(".qty");
        var value = parseInt(inputField.val());

        inputField.val(value + 1);
    });
});
