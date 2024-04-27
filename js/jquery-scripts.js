$(document).ready(function() {
    // Function to rotate the logo on Y axis
    function rotateLogo() {
        $("#logo").animate({
            // Rotate 360 degrees around the Y axis
            transform: 'rotateY(360deg)'
        }, 1000, function() {
            // Animation complete
            // Reset the rotation to 0 degrees
            $(this).css('transform', 'rotateY(0deg)');
        });
    }

    // Call the rotateLogo function on click or any other event
    $("#logo").on("click", function() {
        rotateLogo();
    });
});
