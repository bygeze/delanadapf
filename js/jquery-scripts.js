$(document).ready(function() {
    // Function to rotate the logo on Y axis
    function rotateLogo() {
        // Toggle a CSS class to trigger the rotation animation
        $("#logo").toggleClass('rotate');
    }

    // Call the rotateLogo function on click or any other event
    $("#logo").on("click", function() {
        rotateLogo();
    });
});