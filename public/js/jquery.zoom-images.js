// Make images zoomable on desktop devices
;(function($) {

	// Check if images ar higher than the viewport
	function unsetLargeImages() {
		// Wait for images to be loaded
		$(document).ready(function(){
			$('.comp-image img, .comp-imageuitlijning img').each(function(){
				var $image = $(this),
					original_zoom_value = $image.parents('.compblock').data('zoom');

				if( $image.height() > $(window).outerHeight() ){
					// When the images is taller than the viewport, remove the data-attribute so it can not be zoomed with Javscript below
					$image.parents('.compblock').removeAttr('data-zoom');
				} else{
					// Else, reset the data-attribute to it's original value
					$image.parents('.compblock').attr('data-zoom', original_zoom_value);
				}
			});
		});
	}

	unsetLargeImages();

	$(window).on('resize', unsetLargeImages);

	// Make images zoomable
	$('body').on('click', '[data-zoom] img', function() {

		// First, append image container to the body
		$('body').append('<div class="zoom-container"><img src="/img/loader.svg" alt="Loader" class="loader"><div class="zoom-wrapper"><img class="large-image" src="' + $(this).parents('[data-zoom]').data('zoom') + '"></div></div>');

		// Some variables
		var $window = $(window),
			windowWidth = $window.width(),
			windowHeight = $window.height(),
			scrollTop = $window.scrollTop(),
			$this = $(this),
			$imgContainer = $('div.zoom-container'),
			$imgWrapper = $('div.zoom-wrapper'),
			$preloader = $imgContainer.find('img.loader'),
			imgWidth = $this.width(),
			imgHeight = $this.height(),
			imgTop = $this.offset().top,
			imgLeft = $this.offset().left;

		// Give current active image a class name
		$('[data-zoom] img').removeClass('active-image');
		$this.addClass('active-image');

		// Position image
		$imgWrapper.css({
			top: imgTop - scrollTop,
			left: imgLeft,
			right: windowWidth - (imgLeft + imgWidth),
			bottom: windowHeight - (imgTop - scrollTop + imgHeight)
		});

		// Position preloader
		$preloader.css({
			top: imgTop - scrollTop + (imgHeight/2),
			left: imgLeft + (imgWidth/2)
		});

		// If image is ready, place it in the container and animate it with CSS
		$imgContainer.find('img.large-image').on('load', function(){
			$imgContainer.addClass('enlarge-image'); // Half the CSS animation speed
		});
	});

	$('body').on('click', 'div.zoom-container', function(){

		// Some variables
		var $this = $(this),
			$window = $(window),
			$imgWrapper = $('div.zoom-wrapper'),
			$activeImg = $('img.active-image'),
			windowWidth = $window.width(),
			windowHeight = $window.height(),
			scrollTop = $window.scrollTop(),
			imgWidth = $activeImg.width(),
			imgHeight = $activeImg.height(),
			imgTop = $activeImg.offset().top,
			imgLeft = $activeImg.offset().left;

		// Remove preloader
		$('img.loader').remove();

		// Position image
		$imgWrapper.css({
			top: imgTop - scrollTop,
			left: imgLeft,
			right: windowWidth - (imgLeft + imgWidth),
			bottom: windowHeight - (imgTop - scrollTop + imgHeight)
		});

		// Animation out effect
		$this.removeClass('enlarge-image');

		// Remove the container when the animation is finished
		setTimeout(function(){
			$this.remove();
		}, 300); // Same as CSS animation speed
	});

})(jQuery);