<script type="text/javascript">
    $(document).ready(function(){  
        $('input[name="daterange"]').daterangepicker({
            "alwaysShowCalendars": true,
            opens: "embed",
            drops: "up",
            locale: {
                format: 'YYYY-MM-DD'
            },
            startDate: '2017-01-01',
            endDate: '2017-12-31'
        });
    });    
</script>