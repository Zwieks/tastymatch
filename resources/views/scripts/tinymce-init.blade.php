<script type="text/javascript">

    function initTinyMce(){
        tinymce.init({
            selector:'#content01',
            menubar:false
        });
    }

    $(document).ready(function(e) {
        // Close when clicked outside search container
        $(document).on('click', function(e){

            var $edit_box = $('.editable-wrapper');

            // Close when clicked outside search container
            if( !$edit_box.is(e.target) && $edit_box.has(e.target).length === 0){
                $('#content01').removeClass('text-editor').attr('contenteditable','false');

                //Remove Tiny MCE functionality
                tinymce.remove();
            }
        });

        $(document).on('click', '#content01', function(e) {
            if(!$(this).hasClass('text-editor')){
                $(this).addClass('text-editor').attr('contenteditable','true');
                //Init Tiny MCE
                initTinyMce();
            }
        });
    });
</script>