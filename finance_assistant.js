function checkWidth(init)
{
    /*If browser resized, check width again */
    if ($(window).width() < 768) {
			$('.nav-pills').removeClass('navbar-center');
			$('.nav-pills').addClass('nav-stacked');
			$('.nav-pills').addClass('text-center');
    } else {
        if (!init) {
            $('.nav-pills').removeClass('nav-stacked');
			$('.nav-pills').removeClass('text-center');
			$('.nav-pills').addClass('navbar-center');
        }
    }
}

$(document).ready(function() {
    checkWidth(true);

    $(window).resize(function() {
        checkWidth(false);
    });
});