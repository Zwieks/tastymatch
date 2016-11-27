
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
		var $search_box = $('#js-page-searchbox, #js-ajax-search-results'),
			$search_bar = $('#search-bar'),
			$autocomplete = $('#js-googemap-filter, #js-autocomplete-results'),
			$autocomplete_bar = $('#js-filter-input');

		// Close when clicked outside search container
		if( !$search_box.is(e.target) && $search_box.has(e.target).length === 0){
			$('html').removeClass('open-search');
		}

		// Close when clicked outside autocomplete container
		if( !$autocomplete.is(e.target) && $autocomplete.has(e.target).length === 0){
			$('html').removeClass('open-autocomplete');
		}

		// Show search when there is a click on the searchbar
		if( $search_bar.is(e.target)){
			$('html').addClass('open-search');
		}

		// Show search when there is a click on the autocomplete bar
		if( $autocomplete_bar.is(e.target)){
			$('html').addClass('open-autocomplete');
		}

	}).on('keyup', function(e){
		// Close with escape button
		if(e.keyCode === 27){
			$('html').removeClass('open-search, open-autocomplete');
		}
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

	// Init Google Analytics tracker
	jQuery(window).analyticsTracker();

}).on('resize scroll', function(){

	// Calculate header on resize and scroll
	setHeader(tiny_header_scroll_offset, tiny_header_min_screen_width);

});