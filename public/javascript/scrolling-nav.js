$(document).ready(function () {
	$(window).scroll(function() {
	    if ($("#navbar").offset().top > 81) {
	        $("#navbar").addClass("navbar-fixed-top");
	        $("#navbar").find('.navbar-brand').show();
	    } else {
	        $("#navbar").removeClass("navbar-fixed-top");
	        $("#navbar").find('.navbar-brand').hide();
	    }
	});
});