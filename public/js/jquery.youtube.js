;(function($) {

	$('.comp-youtube:not(.has-autoplay)').each(function(){
		// Youtube variables
		var $video = $(this),
			overiFrame = false,
			isBlurred = false;

		// Set variable on iframe hover
		$video.hover(function(){
			overiFrame = true;
		}, function(){
			overiFrame = false;
			if( isBlurred ){
				$(window).focus();
				isBlurred = false;
			}
		});

		// Detect click in iframe (also right click, which doesn't play the video, kinda buggy)
		$(window).blur(function(){
			isBlurred = true;
			if( overiFrame ) {
				$video.addClass('hideoverlay');
				$(window).focus();
			}
		});
	});

})(jQuery);