// Execute the following script after the page has loaded
$(document).ready(function () {
    // Select all elements with the 'capitalize' class and apply custom capitalization
    $(".capitalize").each(function () {
        var text = $(this).text();
        // Convert the entire word to lowercase and then capitalize the first letter
        $(this).text(
            text.toLowerCase().replace(/^(.)|\s(.)/g, function ($1) {
                return $1.toUpperCase();
            })
        );
    });
});
