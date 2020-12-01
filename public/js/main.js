// Main Javascript File
$(document).ready(function(){

    // Home Page, arrow button click to scroll down
    $("#scroll-button").click(function() {
        $('html').animate({
            scrollTop: $("#goto").offset().top
        }, 1000);
    });

});