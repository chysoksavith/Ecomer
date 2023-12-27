$(document).ready(function() {
    // Set the main image initially
    var mainImage = $('#mainImage');

    // Handle click events on sub-images
    $('.subImage').on('click', function() {
        var subImageSrc = $(this).attr('src');
        mainImage.attr('src', subImageSrc);
    });
});
