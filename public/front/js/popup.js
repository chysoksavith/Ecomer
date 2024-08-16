$(document).ready(function() {
    // Get the modal
    var modal = $("#myModal");

    // Get the button that opens the modal
    var btn = $("#openModalBtn");

    // Get the <span> element that closes the modal
    var span = $(".close");

    // When the user clicks the button, open the modal
    if (btn.length) {
        btn.on("click", function() {
            modal.show();
        });
    }

    // When the user clicks on <span> (x), close the modal
    if (span.length) {
        span.on("click", function() {
            modal.hide();
        });
    }

    // When the user clicks anywhere outside of the modal, close it
    $(window).on("click", function(event) {
        if ($(event.target).is(modal)) {
            modal.hide();
        }
    });
});
