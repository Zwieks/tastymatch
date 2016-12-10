<script type="text/javascript">

    function initTinyMce(){
        tinymce.init({
            selector:'#js-editable-intro',
            menubar:false,
            inline: true,
            plugins: "textcolor colorpicker",
            toolbar: [
                'undo redo forecolor'
            ]
        });

        tinymce.init({
            selector: '#js-editable-contact',
            menubar:false,
            inline: true,
            plugins: "textcolor colorpicker",
            toolbar: [
                'undo redo forecolor'
            ]
        });

        tinymce.init({
            selector: '#js-editable-menu',
            menubar:false,
            inline: true,
            plugins: "textcolor colorpicker",
            toolbar: [
                'undo redo forecolor'
            ]
        });

        tinymce.init({
            selector: '.js-editable-video',
            menubar:false,
            inline: true,
            plugins: " media",
            toolbar: [
                'undo redo media'
            ]
        });

        tinymce.init({
            selector: '.js-editable-media',
            menubar:false,
            inline: true,
            plugins: "textcolor colorpicker",
            toolbar: [
                'undo redo forecolor'
            ]
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