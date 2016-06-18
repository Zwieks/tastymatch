;(function($) {

	window.setHeader = function(scroll_offset, min_screen_width) {
		var $html = $('html');

		if( $(window).scrollTop() > scroll_offset && window.getViewportWidth() >= min_screen_width ) {
			$html.addClass('tiny-header');
		} else {
			$html.removeClass('tiny-header');
		}
	};

	// This scripts is called in 'js/jquery.acties.js'

})(jQuery);