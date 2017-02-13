<script type="text/javascript">
    //Using jQuery to handle the inputfield on key-up
    $(document).on('keyup','#js-filter-input',function(e) {
        //Filter the object based on the user input
        e.preventDefault();
        //Perform the search
        ajaxSearchEvents($(this).val());
    });

    $(document).on('click','.autocomplete-item',function(e) {
        e.preventDefault();

        addDefaultInputs($(this));
        return false;
    });

    function addDefaultInputs(object){
        //Get the name and id
        var id = object.attr('id'),
            name = object.attr('name'),
            description = object.attr('des'),
            type = object.attr('type'),
            location = object.attr('loc');

        //Put the EVENT NAME in the inputfield
        $("input[name='searchevents']").val(name);
        //Put the ID as attribute of the object
        $("input[name='searchevents']").attr('eventid',id);
        //Put the EVENT DESCRIPTION in the textarea
        $("textarea[name='description']").val(description).prop('readonly', true);
        //Put the EVENT LOCATION in the inputfield
        $("input[name='location']").val(location).prop('readonly', true);
        //Empty the EVENT TYPE in the inputfield
        $("select[name='eventtype']").prop('selectedIndex',type).attr("disabled", true);
        //Hide the autocomplete
        $('html').removeClass('open-search, open-autocomplete');
    }
</script>