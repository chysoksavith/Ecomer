window.onscroll = function() {
    scrollFunction()
};

function scrollFunction() {
    var button = document.querySelector('.bt-nav');
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        button.style.opacity = "1"; /* Show button if scroll position is not at the top */
    } else {
        button.style.opacity = "0"; /* Hide button if scroll position is at the top */
    }
}

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
}
