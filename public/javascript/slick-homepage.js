$(document).ready(function(){
	$('.slick-hot-product').slick({
		centerMode: true,
		centerPadding: '60px',
		slidesToShow: 3,
		autoplay: true,
		autoplaySpeed: 3000,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					arrows: false,
					centerMode: true,
					centerPadding: '40px',
					slidesToShow: 2
				}
			},
			{
				breakpoint: 480,
				settings: {
					arrows: false,
					centerMode: true,
					centerPadding: '40px',
					slidesToShow: 1
				}
			}
		]
	});

	$('.slick-popular-product').slick({
		centerMode: true,
		centerPadding: '60px',
		slidesToShow: 3,
		autoplay: true,
		autoplaySpeed: 3500,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					arrows: false,
					centerMode: true,
					centerPadding: '40px',
					slidesToShow: 2
				}
			},
			{
				breakpoint: 480,
				settings: {
					arrows: false,
					centerMode: true,
					centerPadding: '40px',
					slidesToShow: 1
				}
			}
		]
	});	
});