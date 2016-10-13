jQuery(document).ready(function($) {
	$.fn.inView = function(){
		//Window Object
		var win = $(window);
		//Object to Check
		obj = $(this);
		//the top Scroll Position in the page
		var scrollPosition = win.scrollTop();
		//the end of the visible area in the page, starting from the scroll position
		var visibleArea = win.scrollTop() + win.height();
		//the end of the object to check
		var objEndPos = (obj.offset().top + 70);
		return(visibleArea >= objEndPos && scrollPosition <= objEndPos ? true : false)
	};

	inviewelements = $(".inviewelement");

	function inviewinit () {
		console.log('test');
		inviewelements.each(function(){
			if ($(this).inView() && !$(this).hasClass('inview')) {
				$(this).addClass('inview');
			}
		});
	}

	$(window).scroll(function(){
		inviewinit();
	});
	inviewinit();
});