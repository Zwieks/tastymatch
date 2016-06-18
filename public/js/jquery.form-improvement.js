;(function($) {

	window.formImprovement = function() {

		// Wrap select boxes so we can style them
		$('select:not([multiple])').each(function(){
			if( !$(this).parent().hasClass('style-select') )
				$(this).wrap('<div class="style-select">');
		});


		// Add classname to the wrapper of a disabled select
		$('select:disabled').parent('.style-select').addClass('disabled');


		// Simulate focus on style select elements
		$('select').focus(function() {
			$(this).parent('.style-select').addClass('focus');
		}).focusout(function(){
			$(this).parent('.style-select').removeClass('focus');
		});


		// Standaard word er geen label geplaatst in een radio button met textfield, met dit stukje code word dat wel gedaan + een for attribute voor de radio button
		$('.form-input-radio-textfield').wrap('<label for="' + $('.form-input-radio-textfield').prev().attr('id') + '"></label>');

	};

	formImprovement();

})(jQuery);