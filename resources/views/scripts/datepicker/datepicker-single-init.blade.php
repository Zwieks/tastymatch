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

        $('input[data-dp-event="true"]').datepicker({
            container:'body',
            format: 'd M yyyy',
        }).on('changeDate', function (ev) {
            if($('.datepicker').is(":visible")){

            }
        });
    });
</script>