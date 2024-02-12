
document.addEventListener('DOMContentLoaded', function () {
    AOS.init({
        offset: 200, // Adjust this value based on when you want the animation to trigger
        duration: 600, // Animation duration in milliseconds
        easing: 'ease-in-out', // Animation easing
        once: true, // Only animate once
    });
});
