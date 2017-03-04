<script type="text/javascript">
    $(document).ready(function(e) {

        //Remove the input errors and empty all the input fields when the modal has been closed
        $('.modal-media').on('hidden.bs.modal', function () {
            $('.modal-body').empty();
        });

        //Click on the agenda item
        $( ".modal" ).on('show.bs.modal', function(e){
            //Get the media
            var media = $(e.relatedTarget).attr('data-content');
            //Get the media item
            var media_type = $(e.relatedTarget).attr('data-type');

            if(media_type == 'image'){
                media = "<figure><img src='"+media+"'/></figure>";
            }

            //Put the media inside the body of the modal
            $('.modal-body').html(media);
        });
    });
</script>