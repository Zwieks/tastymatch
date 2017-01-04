<script type="text/javascript">
    $.fn.initTinyMce = function initTinyMce(){
        tinymce.init({
            setup:function(ed) {
                ed.on('ProgressState', function(e) {
                    console.log('ProgressState event', e);
                }),
                ed.on('focus', function(e) {
                    if(!$('#'+ed.id).hasClass('changed-content')){
                        //Get component ID
                        var id = $(this).attr('id');
                        //Empty the textbox
                        tinymce.get(id).setContent('');
                        $('#'+ed.id).addClass('empty-content');
                    }
                }),

                ed.on('blur', function(e) {
                    //Get the placeholder text
                    var placeholderText =  $('#'+ed.id).attr('placeholder');

                    if(ed.getContent({format: 'text'}) != ''){
                        $('#'+ed.id).removeClass('empty-content');
                        $('#'+ed.id).addClass('changed-content');
                        $('#'+ed.id).addClass('changed-content');
                    }else{
                        $('#'+ed.id).removeClass('changed-content');
                        $('#'+ed.id).addClass('empty-content');
                        ed.setContent('<h2 id="js-page-title" class="editable-default">'+placeholderText+'</h2>');
                    }
                }),

                ed.on('Change', function(e) {
                    //Get component ID
                    if(ed.getContent({format: 'text'}) === ''){
                        ed.setContent('<h2 id="js-page-title" class="editable-default"></h2>');
                    }
                });
            },
            selector:'#js-editable-title',
            menubar:false,
            inline: true
        });

        tinymce.init({
            setup:function(ed) {
                ed.on('ProgressState', function(e) {
                    console.log('ProgressState event', e);
                });
            },

            selector:'#js-editable-intro',
            menubar:false,
            inline: true
        });

        tinymce.init({
            setup:function(ed) {
                ed.on('ProgressState', function(e) {
                    console.log('ProgressState event', e);
                });
            },
            selector: '#js-editable-contact',
            menubar:false,
            inline: true,
            plugins: "textcolor colorpicker",
            toolbar: [
                'undo redo forecolor'
            ]
        });

        tinymce.init({
            setup:function(ed) {
                ed.on('ProgressState', function(e) {
                    console.log('ProgressState event', e);
                });
            },
            selector: '#js-editable-menu',
            menubar:false,
            inline: true,
            plugins: "textcolor colorpicker",
            toolbar: [
                'undo redo forecolor'
            ]
        });

        tinymce.init({
            setup:function(ed) {
                ed.on('NodeChange', function(e){
                    if(ed.getContent() != ''){
                        $('#'+ed.id).parent().addClass('hasvideo');
                    }else{
                        if($('#'+ed.id).parent().hasClass('hasvideo')){
                            $('#'+ed.id).parent().removeClass('hasvideo');
                        }    
                    }    
                });

                ed.on('ProgressState', function(e) {
                   console.log('ProgressState event', e);
                });
            },    

            selector: '.js-editable-video',
            menubar:false,
            inline: true,
            plugins: " media",
            toolbar: [
                'undo redo media'
            ]
        });

        tinymce.init({
            setup:function(ed) {
                ed.on('ProgressState', function(e) {
                    console.log('ProgressState event', e);
                });
            },
            selector: '.js-editable-media',
            menubar:false,
            inline: true,
            plugins: "textcolor colorpicker",
            toolbar: [
                'undo redo forecolor'
            ]
        });
    }

    function TinyMceSave(id) {
        //Use get without #
        if($('#'+id).hasClass('changed-content')){

            //Get component ID
            id = tinymce.get(id);

            if(typeof $('#'+id.id).parent().attr('id') != "undefined"){
                var object_componentid = $('#'+id.id).parent().attr('id');
            }else if(typeof $('#'+id.id).parent().parent().attr('id') != "undefined"){
                var object_componentid = $('#'+id.id).parent().parent().attr('id');
            }else{
                return 'No components found';
            }

                componentid = object_componentid,
                userid = {!! Session::get('user.global.id') !!},
                content = id.getContent();

            // Do you ajax call here, window.setTimeout fakes ajax call
            if(typeof content != "undefined"){
                var myObject = new Object();
                myObject.componentId = componentid;
                myObject.selector = id.id;
                myObject.userid = userid;
                myObject.content = content;

                return myObject;
            }
        };
    }

    $(document).ready(function(e) {
        //Init Tiny MCE
        $.fn.initTinyMce();

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