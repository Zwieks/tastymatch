
// iNav options
jQuery(document).iNav({
	// @TODO: Optional settings here, see defaults in '/js/jquery.inav.js'
});

// Init function (scroll offset, minimum viewport width)
var tiny_header_scroll_offset = 200,
	tiny_header_min_screen_width = 1024,
	$doc = jQuery(document),
	$window = jQuery(window);

setHeader(tiny_header_scroll_offset, tiny_header_min_screen_width);

jQuery(document).ready(function($){


	$doc.on('click', function(e){
		var $search_box = $('#js-page-searchbox, #js-ajax-search-results');
		// Close when clicked outside search container
		if( !$search_box.is(e.target) && $search_box.has(e.target).length === 0)
			$('html').removeClass('open-search');
	}).on('keyup', function(e){
		// Close with escape button
		if(e.keyCode === 27)
			$('html').removeClass('open-search');
	});
});

jQuery(window).on('load', function(){

	// Remove class when Javascript is loaded
	jQuery('body').removeClass('preload');

	// Load the Custom Scrollbars
	if($('#js-ajax-search-results').length) {
		$("#js-ajax-search-results").mCustomScrollbar({
			theme:"light-3"
		});
	}

	// Init Kirra and Google Analytics tracker
	jQuery(window).analyticsTracker();

}).on('resize scroll', function(){

	// Calculate header on resize and scroll
	setHeader(tiny_header_scroll_offset, tiny_header_min_screen_width);

});