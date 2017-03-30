<script type="text/javascript">
    $(document).ready(function(e) {

        //Remove the input errors and empty all the input fields when the modal has been closed
        $('#modal-media').on('hidden.bs.modal', function () {
            $('#modal-media .modal-body').empty();
        });

        //Click on the agenda item
        $( "#modal-media" ).on('show.bs.modal', function(e){
            //Get the media
            var media = $(e.relatedTarget).attr('data-content');
            //Get the media item
            var media_type = $(e.relatedTarget).attr('data-type');

            if(media_type == 'image'){
                media = "<figure><img src='"+media+"'/></figure>";
            }else{
                media = $(media).attr("src", $(media).attr("src")+'?autoplay=1');
            }

            //Put the media inside the body of the modal
            $('#modal-media .modal-body').html(media);
        });
    });
</script>