<script type="text/javascript">
    $(document).ready(function($) {

        // # Ready owl carousel slider.

        // Determine where the slider has to start (current year)
        var $slider = $('#js-agenda-scroller'),
                current_year = $slider.data('current-year'),
                start_slide;

        $slider.find('.timeline-item').each(function(e){
            if ($(this).hasClass( "timelinestarter" )) {
                start_slide = e;
                return false;
            };
        });

        // Init carousel
        $slider.owlCarousel({
            responsiveRefreshRate: 100, // Make it fit better on resize
            dots: false,
            autoWidth: true,
            startPosition: start_slide
        });

        // Go to the previous slide
        $('#js-timeline-prev').on('click', function() {
            $slider.trigger('prev.owl.carousel');
        });

        // Go to the next slide
        $('#js-timeline-next').on('click', function() {
            $slider.trigger('next.owl.carousel');
        });
    });
</script>