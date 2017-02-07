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

    $(document).on('click','.autocomplete-item',function(e) {
        e.preventDefault();

        //Get the name and id
        var id = $(this).attr('id'),
            name = $(this).attr('name'),
            description = $(this).attr('des'),
            location = $(this).attr('loc');

        $("input[name='search-events']").val(name);
        $("input[name='search-events']").attr('eventid',id);
        $("textarea[name='description']").val(description);
        $("input[name='location']").val(location);
        return false;
    });
</script>