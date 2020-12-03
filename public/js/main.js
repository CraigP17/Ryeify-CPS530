// Main Javascript File

AOS.init();

$(document).ready(function(){
    let height;
    let width;

    height = $( window ).height();
    width  = $( window ).width();

    // +=+=+=+=+ HOME PAGE (/) jQuery functions +=+=+=+=+

    // Used on home page, arrow button click to scroll down smoothly
    $("#scroll-button").click(function() {
        $('html').animate({
            scrollTop: $("#goto").offset().top
        }, 1000);
    });


    // +=+=+=+=+ ERROR PAGE (/error) jQuery functions +=+=+=+=+

    /**
     * Rotates and animates the spaceman image on /error page to look like he's floating around in space
     */
    function loop() {
        rotateAnimation(1 * width / 2, 2 * height / 3, 6000, true);
        rotateAnimation(4 * width / 5, 1 * height / 2, 4000, true);
        rotateAnimation(1 * width / 2, 0             , 5000, true);
        rotateAnimation(1 * width / 4, 2 * height / 3, 5500, true);
        rotateAnimation(0            , 1 * height / 2, 3500, true);
        rotateAnimation(1 * width / 4, 0             , 4500, true);
        rotateAnimation(3 * width / 5, 2 * height / 3, 5000, false);
        rotateAnimation(4 * width / 5, 1 * height / 2, 2000, true);
        rotateAnimation(1 * width / 5, 0             , 6000, true);
        rotateAnimation(0            , 1 * height / 5, 3000, true);
        // Recursive to continue animations
        loop();
    }

    /**
     * Performs single animation for spaceman, given its parameters
     *
     * @param {number} x_position       x position (px) to end animation on
     * @param {number} y_position       y position (px) to end animation on
     * @param {number} duration_time    milliseconds duration for the animation
     * @param {boolean} reverse         whether to reverse rotation to be rotating clockwise or CCW
     */
    function rotateAnimation(x_position, y_position, duration_time, reverse)
    {
        let reverse_deg;
        $('#spaceman').animate({ left: x_position, top: y_position }, {
            duration: duration_time,
            easing: 'linear',
            step: function(now) {
                // Rotate the image every step
                reverse_deg = reverse ? 180 : 0;
                // now = flip ? now/2 : -(now/2) + reverse_deg
                now = now/2
                $(this).css('transform','rotate('+now+'deg)');
            }
        });
    }

    // If #spaceman id (img) exists, call loop animation
    if ($('#spaceman').length)
    {
        loop();
    }


});