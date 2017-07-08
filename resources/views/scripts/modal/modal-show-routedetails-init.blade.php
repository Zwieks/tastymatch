<script type="text/javascript">
    $(document).ready(function(e) {

        //Remove the input errors and empty all the input fields when the modal has been closed
        $('#modal-routedetails').on('hidden.bs.modal', function () {
            $('#modal-routedetails .modal-body').empty();
        });

        //Click on the agenda item
        $( "#modal-routedetails" ).on('show.bs.modal', function(e){

        });
    });
</script>