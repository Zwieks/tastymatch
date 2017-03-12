<script type="text/javascript">
    $(document).ready(function(){
        $('input[data-dp="true"]').datepicker({
            container:'#modal',
           	format: 'd M yyyy',
        }).on('changeDate', function (ev) {
    		if($('.datepicker').is(":visible")){
    			$(ev.target).attr('data-update', 'true');
    			$('#js-filter-input').attr('data-changed', 'true');
    		}
		});
    });
</script>