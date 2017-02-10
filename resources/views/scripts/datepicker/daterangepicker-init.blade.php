<script type="text/javascript">
    $(document).ready(function(){
        var user_agenda = {!! $user['agenda']->sortBy('date_start') !!},
            last_user_agenda_start_date = {!! $user['agenda']->sortBy('date_start')->last() !!};

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
    });
</script>