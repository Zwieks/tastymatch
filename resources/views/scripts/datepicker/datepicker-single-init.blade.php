<script type="text/javascript">
    $(document).ready(function(){
        $('input[data-dp="true"]').datepicker({
            container:'#modal-form',
           	format: 'd M yyyy',
        }).on('changeDate', function (ev) {
    		if($('.datepicker').is(":visible")){
    			$(ev.target).attr('data-update', 'true');
    			$('#js-filter-input').attr('data-changed', 'true');
    		}
		});

        $('input[data-dp-event-from="true"]').datepicker({
            container:'body',
            format: 'd M yyyy',
            minDate : 0,
            startDate: new Date(),
        }).on('changeDate', function (ev) {
            $('input[data-dp-event-to="true"]').datepicker('setStartDate', ev.date);
        });

        $('input[data-dp-event-to="true"]').datepicker({
            container:'body',
            format: 'd M yyyy',
            minDate : 0,
            startDate: $.fn.Global.ToEndDate,
        }).on('changeDate', function (ev) {
            //console.log(ev);
        });
    });
</script>