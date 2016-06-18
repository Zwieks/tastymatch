;(function($) {

	var crumb_timer,
		crumb_resize_delay = 100,
		$breadcrumb = $('#js-breadcrumb'),
		$breadcrumb_toggler = $('#js-toggle-breadcrumb'),
		$last_crumb = $breadcrumb.find('li.crumb-level1').last();

	// Toggle mobile breadcrumb with button
	$breadcrumb_toggler.on('click', function(){
		$breadcrumb.toggleClass('open-breadcrumb');
	});

	// Close mobile breadcrumb
	$(document).on('keydown', function(e){

		// Close breadcrumb with escape button
		if( e.keyCode === 27 ) {
			$breadcrumb.removeClass('open-breadcrumb');
		}

	}).on('click', function(e){

		// Close breadcrumb when clicked outside it
		if( !$breadcrumb.is(e.target) && $breadcrumb.has(e.target).length === 0 ) {
			$breadcrumb.removeClass('open-breadcrumb');
		}

	});

	function truncateLastCrumb(){
		if( $breadcrumb_toggler.is(':hidden') ){
			var crumbs_width = 0,
				crumb_container_width = $breadcrumb.outerWidth(),
				crumb_width = $breadcrumb.children('ol').outerWidth(),
				$crumbs = $breadcrumb.find('li.crumb-level1:not(:last-child)');

			if( crumb_container_width <= crumb_width ){
				$crumbs.each(function () {
					crumbs_width = crumbs_width + $(this).outerWidth();
				});

				$last_crumb.css('max-width', crumb_container_width - crumbs_width);
			} else {
				$last_crumb.removeAttr('style');
			}
		} else {
			$last_crumb.removeAttr('style');
		}
	}

	// Truncate last item
	truncateLastCrumb();


	$(window).on('resize', function(){
		clearTimeout(crumb_timer);
		crumb_timer = setTimeout(truncateLastCrumb , crumb_resize_delay);
	});
})(jQuery);