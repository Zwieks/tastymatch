<script type="text/javascript">
    $(document).ready(function(){
        //This is kind of a hack because we need to use an exception of the user object
        @if(isset($user))
            <?php $page_content = $user; ?>
        @endif

        var user_agenda = {!! $page_content['agenda']->sortBy('date_start') !!},
            last_user_agenda_start_date = {!! $page_content['agenda']->sortBy('date_start')->last() !!};

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