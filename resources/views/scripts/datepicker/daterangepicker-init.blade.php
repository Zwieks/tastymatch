<script type="text/javascript">
    $(document).ready(function(){
        var last_user_agenda_start_date = [];
        //This is kind of a hack because we need to use an exception of the user object
        @if(isset($user))
            <?php $page_content = $user; ?>
        @endif

        var user_agenda = [];

        @if(isset($page_content['agenda']))
            user_agenda = {!! $page_content['agenda']->sortBy('date_start') !!};  
        @endif

        if(user_agenda.length > 0){
            @if(isset($page_content['agenda']))
                last_user_agenda_start_date = '{!! $page_content['agenda']->sortBy('date_start')->last() !!}';
            @endif    
        }
        else{
            last_user_agenda_start_date = '{!! Carbon::now() !!}';
        }

        $('input[name="daterange"]').daterangepicker({
            "alwaysShowCalendars": true,
            opens: "embed",
            drops: "up",
            locale: {
                format: 'YYYY-MM-DD'
            },
            startDate: '{!! Carbon::now() !!}',
            endDate: last_user_agenda_start_date.date_start
        });

        //Set label
        $('.js-filter-label').text( '{!! Lang::get('daterangepicker.label') !!}' );

        $(document).on('apply.daterangepicker', function(ev, picker) {
            //do something, like clearing an input
            var selector = picker.parentEl.selector,
                modal_id = $(selector).closest('.modal').attr('id');
            //Toggle the modal
            $('#'+modal_id).modal('hide');
        });

        $(document).on('cancel.daterangepicker', function(ev, picker) {
            //do something, like clearing an input
            var selector = picker.parentEl.selector,
                modal_id = $(selector).closest('.modal').attr('id');
            //Toggle the modal
            $('#'+modal_id).modal('hide');
        });
    });
</script>