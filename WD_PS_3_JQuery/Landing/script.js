// for Landing Page 

$(document).ready(function() {
	let middleOFWindow = $(window).height() / 2;

	// animate button and run to top of page
    $(window).scroll(function() {
        if ($(window).scrollTop() > 500) {
            $(".button_to_top").css("opacity", "1");
        } else {
            $(".button_to_top").css("opacity", "0");
        }
    });

    $(".button_to_top").click(function() {
        $('html, body').animate({ scrollTop: '0' }, 1000, function() {
            $(".button_to_top").css("opacity", "0");
        });
    });


    // offset to center of window
    $("a").click(function(){
    	let item = $(this).attr("href");
    	$("html, body").animate({scrollTop: $(item).offset().top - middleOFWindow}, 1000);
    });
});