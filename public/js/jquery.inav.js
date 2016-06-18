;(function($) {

	// Some variables
	var iNavTimer;

	var iNav = function(elem, options) {
		this.options 		= options;
		this.clickCounter 	= 0;
		this.settings 		= {};
	};

	iNav.prototype = {
		defaults: {
			navTrigger: 		'#js-nav-trigger', // The hamburger checbox trigger
			navOpener: 			'#js-nav-toggle', // The hamburger button
			navCloser: 			'#js-nav-closer', // The overlay to close the navigation
			navWrapper: 		'#js-nav-wrapper', // The container that holds al the navigation elements
			mainNavigation: 	'#js-mainmenu', // Primairy navigation
			navContainers: 	    [] // Array of elements that are pushed in the responsive navigation
		},

		init: function() {
			var settings = this.settings = $.extend({}, this.defaults, this.options),
				self = this;

			if (!settings.navContainers.length) {
				settings.navContainers.push($(settings.mainNavigation));
			}

			// Move all menu's to the mobile navigation container
			if( settings.navWrapper ){
				$.each(settings.navContainers, function() {
					$(settings.navWrapper).append($(this).html());
				});
			}

			// Handle desktop menu submenu functionalities on touch-devices
			if( $(settings.navOpener).find('.subnav').length > 0 ) {
				$(this.settings.mainNavigation).on('touchstart', '.subnav > a', function(e){
					if( $(settings.navOpener).is(':hidden') ){
						if( self.clickCounter == 0 ){
							// Catch first click and open dropdown menu
							self.clickCounter ++;
							$(this).parent('li').addClass('hover');
							e.preventDefault();
						} else if ( $(this).parent('li').hasClass('hover') ) {
							// Go to the link on second click
							window.location.href = $(this).attr('href');
							$(this).parent('li').removeClass('hover');
						} else {
							// Reset
							self.clickCounter = 0;
							e.preventDefault();
							$(this).find('.subnav').removeClass('hover');
						}
					}
				});
			}

			// Open responsive sub navigation
			$('.js-open-subnav').on('click', function(e) {
				e.preventDefault();
				$(this).prev('ul').toggleClass('open').parent().siblings().children('ul').removeClass('open');
			});

			// Open active resonsive sub navigation
			$(settings.navWrapper).find('ul > .active > ul').addClass('open');

			// Close nav with escape button
			$(document).on('keydown', function(e){
				if( e.keyCode === 27 ) {
					self.clearNav();
				}
			});

			// Close nav on click / touch outside the responsive menu
			$(settings.navCloser).on('click', function(){
				self.clearNav();
			});

			// resetNav on resize (or orientationchange for touch devices)
			$(window).on('resize', function() {
				clearTimeout(iNavTimer);
				iNavTimer = setTimeout(function(){
					self.resetNav();
				}, 100);
			});
		},

		clearNav: function() {
			$(this.settings.navTrigger).prop('checked', false);
		},

		resetNav: function() {
			if( $(this.settings.navOpener).is(':hidden') ) {
				this.clearNav();
			}
		}
	};


	// Initialize plugin
	iNav.defaults = iNav.prototype.defaults;
	$.fn.iNav = function(options) {
		return this.each(function() {
			new iNav(this, options).init();
		});
	}

})(jQuery);