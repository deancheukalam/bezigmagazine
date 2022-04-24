var businessCapitalSliderAutoplay = false;

if ( '1' == businessCapitalSliderOptions.slider.autoplay ) {
	businessCapitalSliderAutoplay = {
	    delay: businessCapitalSliderOptions.slider.autoplayDelay,
	};
}

var mainSlider = new Swiper ( '#slider-section', {
	autoHeight: true, //enable auto height
	// If we need pagination
	pagination: {
		el: '#slider-section .swiper-pagination',
		type: 'bullets',
		clickable: 'true',
	},

	autoplay: businessCapitalSliderAutoplay,
	// Navigation arrows
	navigation: {
		nextEl: '#slider-section .swiper-button-next',
		prevEl: '#slider-section .swiper-button-prev',
	},

	// And if we need scrollbar
	scrollbar: {
		el: '#slider-section .swiper-scrollbar',
	},
});

if ( 'undefined' != typeof mainSlider.el && '1' == businessCapitalSliderOptions.slider.autoplay && '1' == businessCapitalSliderOptions.slider.pauseOnHover ) {
	mainSlider.el.addEventListener( 'mouseenter', function( event ) {
		mainSlider.autoplay.stop();
	}, false);

	mainSlider.el.addEventListener( 'mouseleave', function( event ) {
		mainSlider.autoplay.start();
	}, false);
}
