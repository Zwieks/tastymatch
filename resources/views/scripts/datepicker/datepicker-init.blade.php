<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

<script type="text/javascript">
    $(document).ready(function(){  
        $('input[name="daterange"]').daterangepicker({
            autoclose: true,
            opens: "center",
            drops: "up",
            locale: {
                format: 'YYYY-MM-DD'
            },
            startDate: '2013-01-01',
            endDate: '2013-12-31'
        });
    });    
</script>