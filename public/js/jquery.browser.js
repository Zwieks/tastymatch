;(function($) {

	window.browserDetect = function() {

		var $html = $('html');

		// Add an IE10 class to the html-tag (only for IE10 off course)
		if( Function('/*@cc_on return document.documentMode===10@*/')() ) {
			$html.addClass('ie10');
		}

		// Add an IE11 class to the html-tag (only for IE11 off course)
		if( !!navigator.userAgent.match(/Trident.*rv\:11\./) ) {
			$html.addClass('ie11');
		}

		// Add an edge class to the html-tag (only for IE11 off course)
		if( /Edge\/12./i.test(navigator.userAgent) ) {
			$html.addClass('browser-edge');
		}

		// Detect touch devices
		if( 'ontouchstart' in window || navigator.msMaxTouchPoints ){
			$html.addClass('touch-device');
		}

	};

	browserDetect();

})(jQuery);