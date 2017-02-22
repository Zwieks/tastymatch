<script type="text/javascript">
    $(document).ready(function(e) {

        //Remove the input errors and empty all the input fields when the modal has been closed
        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').find('div.input-error').hide();
            $('#modal').find('li.input-error').removeClass('input-error');
            $('#js-filter-input').attr('eventid','');
            $('#js-filter-input').attr('searchable','');
            $('#js-filter-input').attr('delete','');
            $('#js-filter-input').attr('agendaid','');
            $('#js-modal-create-agenda-items').trigger("reset");
        });

        //Click on the agenda item
        $( "#modal" ).on('show.bs.modal', function(e){
            if($(e.relatedTarget).attr('class') != 'btn-wrapper' && typeof $(e.relatedTarget).attr('class') != 'undefined'){
                //Get the session
                var agenda_items = $.fn.locations_object;
                var marker_id = $(e.relatedTarget).attr('marker-id'),
                    eventId = $(e.relatedTarget).attr('event-id'),
                    agendaId = $(e.relatedTarget).attr('id'),
                    agenda_item = agenda_items[marker_id],
                    agenda_item_name = agenda_item['info'].name,
                    agenda_item_type = agenda_item['info'].type_id,
                    agenda_item_description = agenda_item['info'].description,
                    agenda_item_location = agenda_item['info'].location,
                    agenda_item_date_start = agenda_item.date_start,
                    agenda_item_searchable = agenda_item['info'].searchable,
                    agenda_item_date_end = agenda_item.date_end;

                //Set event id if there is one
                if(typeof eventId != 'undefined' && eventId != '') {
                    $(e.currentTarget).find("input[name='searchevents']").attr('eventid', eventId);
                    $(e.currentTarget).find("input[name='searchevents']").attr('searchable', agenda_item_searchable);
                }

                //Set agenda id if there is one
                if(typeof agendaId != 'undefined' && agendaId != '') {
                    $(e.currentTarget).find("input[name='searchevents']").attr('agendaid', agendaId);
                }

                //Set new to false while this is an update
                $(e.currentTarget).find('input[name="searchevents"]').attr('new', false);
                //Set update is true or when it's an searchable event to false
                if(agenda_item_searchable != '1'){
                    $(e.currentTarget).find('input[name="searchevents"]').attr('update', true);
                }else{
                    $(e.currentTarget).find('input[name="searchevents"]').attr('update', false);
                }
                //Set title
                $(e.currentTarget).find('h2').text('{!! Lang::get('agenda.modal-agenda-update-title') !!}');
                //populate the title
                $(e.currentTarget).find('input[name="searchevents"]').val(agenda_item_name);
                //populate the type
                $(e.currentTarget).find('select[name="eventtype"]').prop('selectedIndex',agenda_item_type);
                //populate the description
                $(e.currentTarget).find('textarea[name="description"]').val(agenda_item_description);
                //populate the location
                $(e.currentTarget).find('input[name="location"]').val(agenda_item_location);
                //Set DatePicker to October 3, 2008
                $(e.currentTarget).find('input[name="datestart"]').datepicker("setDate", new Date(agenda_item_date_start) );
                //Set DatePicker to October 3, 2008
                $(e.currentTarget).find('input[name="dateend"]').datepicker("setDate", new Date(agenda_item_date_end) );

                //Block editing
                if(agenda_item_searchable == 1){
                    addAgendaItemBlocking(e);
                }
                else{
                    removeAgendaItemBlocking(e);
                }
            }else{
                //Set title
                $(e.currentTarget).find('h2').text('{!! Lang::get('agenda.modal-agenda-create-title') !!}');
                if(typeof $(e.currentTarget).find('input[name="searchevents"]').attr('searchable') != 'undefined' &&
                    $(e.currentTarget).find('input[name="searchevents"]').attr('searchable') == '')
                $(e.currentTarget).find('input[name="searchevents"]').attr('searchable', 'bla');
                $(e.currentTarget).find('input[name="searchevents"]').attr('update', false);
                $(e.currentTarget).find('input[name="searchevents"]').attr('new', true);
                $(e.currentTarget).find('input[name="searchevents"]').attr('agendaid', '');
                removeAgendaItemBlocking(e);
            }
        });
    });

    function addAgendaItemBlocking(e){
        //Put the EVENT DESCRIPTION in READONLY
        $(e.currentTarget).find("textarea[name='description']").prop('readonly', true);
        //Put the EVENT LOCATION in READONLY
        $(e.currentTarget).find("input[name='location']").prop('readonly', true);
        //Empty the EVENT TYPE in READONLY
        $(e.currentTarget).find("select[name='eventtype']").attr("disabled", true);
    }

    function removeAgendaItemBlocking(e){
        //Put the EVENT TITLE in READONLY
        $(e.currentTarget).find("input[name='searchevents']").prop('readonly', false);
        //Put the EVENT DESCRIPTION in READONLY
        $(e.currentTarget).find("textarea[name='description']").prop('readonly', false);
        //Put the EVENT LOCATION in READONLY
        $(e.currentTarget).find("input[name='location']").prop('readonly', false);
        //Empty the EVENT TYPE in READONLY
        $(e.currentTarget).find("select[name='eventtype']").attr("disabled", false);
    }
</script>