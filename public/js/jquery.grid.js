;(function($) {

	var grid_timer,
		grid_resize_delay = 100;

	window.setGrid = function() {
		$('[data-width]').each(function(){

			// Main variables
			var $this = $(this),
				$block = $this.find('.page-overview-block'),
				column_width = $this.data('width');

			// Remove the styling (for resizing)
			$block.removeAttr('style');

			// Set the minimum block width from the data-attribute on the container
			$block.css({
				minWidth:   column_width,
				flexBasis:  column_width
			});

			// Check if the blocks aren't one column, then the calculations aren't necessary
			if( $this.outerWidth() >= column_width * 2 ) {

				// Set variables here
				var $first_block = $block.first(),
					$block_width = $first_block.outerWidth(),
					$last_block = $block.last(),
					$last_block_width = $last_block.outerWidth();

				// Check if the last row is not completely filled
				if($block_width - $last_block_width <= 1 && $block_width - $last_block_width >= -1) {

					// Remove styling, CSS will solve this (in combination with the min-width set below)
					$block.removeAttr('style').css('min-width', column_width);

				} else {

					// Loop through all the blocks (to check the last row)
					$block.each(function(){
						var $this = $(this);

						// Filter the blocks in the last row
						if( $this.offset().top == $last_block.offset().top ) {

							// Set the correct styling on the lat row
							$this.css({
								minWidth:   $block_width,
								width:      $block_width,
								flex:       '0 0 auto'
							});
						}
					});
				}
			}
		});
	};

	setGrid();

	$(window).on('resize', function(){

		clearTimeout(grid_timer);
		grid_timer = setTimeout(setGrid, grid_resize_delay);

	});

})(jQuery);