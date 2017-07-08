<script type="text/javascript">
    $(document).ready(function(){
        //Create the autocomplete list
        if($('#js-autocomplete-results').length) {
            $("#js-autocomplete-results").mCustomScrollbar({
                theme:"light-3"
            });
        }

        if($('.agendaitems-wrapper').length){
            $(".agendaitems-wrapper").mCustomScrollbar({
                theme:"light-3"
            });
        }

        if($('#route-description-wrapper').length){
            $("#route-description-wrapper").mCustomScrollbar({
                theme:"light-3"
            });
        }
    });
</script>