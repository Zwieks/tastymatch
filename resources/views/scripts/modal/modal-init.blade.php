<script type="text/javascript">
    $(document).ready(function(e) {

        //Remove the input errors and empty all the input fields when the modal has been closed
        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').find('div.input-error').hide();
            $('#modal').find('li.input-error').removeClass('input-error');
            $('#js-filter-input').attr('eventid','');
            $('#js-modal-create-agenda-items').trigger("reset");
        });
    });
</script>