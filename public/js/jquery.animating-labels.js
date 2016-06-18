;(function($) {

	/**
	 * Animate labels above the input field when the form has a class 'label-
	 * placeholder'.
	 */

	window.animateLabels = function() {

		/**
		 * @param {jQuery} $field
		 */
		function setValue($field) {
			setTimeout(function() {
				var $parents = $field.parents('li');
				$field.val() ? $parents.addClass('has-value') : $parents.removeClass('has-value');
			}, 0); // Timeout so this is executed after the Kirra forms Javascript
		}

		// These children are also specified in /css/projects/components/form-animating-label.less
		$('.velden').children('.form-input-textfield, .form-input-textarea, .form-input-select:not(.form-input-radio):not(.form-input-multipleselect), .field-email, .field-textfield').each(function() {
			var $this = $(this);

			// Give fields that can animate a classname
			$this.addClass('animating-label');

			// Create an empty option for single selects so we can place the label there as a placeholder
			if( $this.hasClass('form-input-select') ) {
				$this.find('option').removeAttr('selected');
				$this.find('select').prepend('<option selected="selected"></option>');
			}

			// We can select all inputs, textareas and selects bacause the .config.php of the form is stripped out
			var $formfields = $this.find('input, textarea, select');


			// Check if there is already a value
			$formfields.each(function() {
				setValue($(this));
			}).focus(function() {
				$(this).parents('li').addClass('has-focus');
			}).focusout(function() {
				$(this).parents('li').removeClass('has-focus');
			});

			$formfields.on('keyup.animatelabels change.animatelabels', function(e) {
				setValue($(this));
			});
		});
	};

	animateLabels();

})(jQuery);