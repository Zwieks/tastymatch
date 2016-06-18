;(function($) {

	// Calculate the exact viewportWidth excluding the scrollbar (for Windows e.g.)
	$('body').append('<div class="scrollbar-measure" id="scrollbar-measure"></div>');

	window.getViewportWidth = function() {
		var scrollDiv = document.getElementById('scrollbar-measure');

		if (!scrollDiv) {
			return false;
		}

		var windowWidth = $(window).width(),
			scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth;

		if( $('html').outerHeight() > $(window).outerHeight() ) {
			return windowWidth + scrollbarWidth;
		} else {
			return windowWidth;
		}
	};

	getViewportWidth();

	$(window).on('resize', getViewportWidth);

})(jQuery);