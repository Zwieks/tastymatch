<script type="text/javascript">
    //Using jQuery to handle the inputfield on key-up
    $(document).on('keyup','#js-filter-input',function(e) {
        //Filter the object based on the user input
        e.preventDefault();
        //Perform the search
        ajaxSearchEvens($(this).val());
    });

    $(document).ready(function(){
        //Create the autocomplete list
        if($('#js-autocomplete-results').length) {
            $("#js-autocomplete-results").mCustomScrollbar({
                theme:"light-3"
            });
        }
    });
</script>