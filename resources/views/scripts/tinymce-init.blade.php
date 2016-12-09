<script type="text/javascript">

    function initTinyMce(){
        tinymce.init({
            selector:'.content',
            menubar:false,
            inline: true
        });
    }

    $(document).ready(function(e) {
        //Init Tiny MCE
        initTinyMce();

        // Close when clicked outside search container
        $(document).on('click', function(e){

            var $edit_box = $('.editable-wrapper');

            // Close when clicked outside search container
            if( !$edit_box.is(e.target) && $edit_box.has(e.target).length === 0){
                $('.content').removeClass('text-editor');
            }
        });

        $(document).on('click', '.content', function(e) {
            if(!$(this).hasClass('text-editor')){
                $(this).addClass('text-editor');
            }
        });
    });
</script>