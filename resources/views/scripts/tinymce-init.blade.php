<script type="text/javascript">
    var ContentCheck = {
        PLACEHOLDER_TEXT : '',
        emptyBox : function(ed,object,placeholderText,tag) {
            //Get component ID
            var id = object.attr('id');
            $('#' + ed.id).addClass('empty-content');
            ed.setContent(tag);
            $('#'+ed.id).removeClass('changed-content');
        },

         fillBox : function(ed,object){
            var id = object.attr('id');

            $('#'+ed.id).removeClass('empty-content');
            $('#'+ed.id).addClass('changed-content');
        },

        setupDefault : function(ed,placeholderText,tag,tag_empty){
            ed.on('ProgressState', function(e) {
                console.log('ProgressState event', e);
            }),
            ed.on('focus', function(e) {
                if(!$('#'+ed.id).hasClass('changed-content')){
                    //Empty the textbox
                    var placeholderText = '';
                    ContentCheck.emptyBox(ed,$(this),placeholderText,tag_empty);
                }
            }),
            ed.on('blur', function(e) {
                var content = ed.getContent({format: 'text'});

                if($.trim(content) == '' || $.trim(content) == placeholderText){
                    ContentCheck.emptyBox(ed,$(this),placeholderText,tag);
                    //Loose the focus
                    $('#'+ed.id).blur();
                }else{
                    ContentCheck.fillBox(ed,$(this),placeholderText);
                }
            });
        },

        setupVideo : function(ed,placeholderText){
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
        }
    };

    $.fn.initTinyMce = function initTinyMce(){
        tinymce.init({
            setup:function(ed) {
                var placeholderText = '{!! Lang::get('tinymce.detailpage-foodstand-title') !!}',
                tag = '<h2 id="js-page-title" class="editable-default">' + placeholderText + '</h2>',
                tag_empty = '<h2 id="js-page-title" class="editable-default"></h2>';
                ContentCheck.setupDefault(ed,placeholderText,tag,tag_empty);
            },
            selector:'#js-editable-title',
            menubar:false,
            inline: true
        });

        tinymce.init({
            setup:function(ed) {
                var placeholderText = '{!! Lang::get('tinymce.detailpage-foodstand-description') !!}',
                tag = ' <p class="editable-default">' + placeholderText + '</p>',
                tag_empty = ' <p class="editable-default"></p>';
                ContentCheck.setupDefault(ed,placeholderText,tag,tag_empty);
            },
            selector:'#js-editable-intro',
            menubar:false,
            inline: true
        });

        tinymce.init({
            setup:function(ed) {
                var placeholderText = '{!! Lang::get('tinymce.detailpage-foodstand-contact-description') !!}',
                tag = '<p class="editable-default">' + placeholderText + '</p>',
                tag_empty = '<p class="contact-intro"></p>';
                ContentCheck.setupDefault(ed,placeholderText,tag,tag_empty);
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
                var placeholderText = '{!! Lang::get('tinymce.detailpage-foodstand-title') !!}',
                tag = '<p>' + placeholderText + '</p>',
                tag_empty = '<p></p>';
                ContentCheck.setupDefault(ed,placeholderText,tag,tag_empty);
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
                var placeholderText = '{!! Lang::get('tinymce.detailpage-foodstand-title') !!}';
                ContentCheck.setupVideo(ed,placeholderText);
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
                var placeholderText = '{!! Lang::get('tinymce.detailpage-foodstand-title') !!}',
                tag = '<p id="tinyMceElementId0" class="js-editable-media content editable editable-default mce-content-body" contenteditable="true" spellcheck="false">' + placeholderText + '</p>';
                tag_empty = '<p id="tinyMceElementId0" class="js-editable-media content editable editable-default mce-content-body" contenteditable="true" spellcheck="false"></p>';
                ContentCheck.setupDefault(ed,placeholderText,tag,tag_empty);
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

                var componentid = object_componentid,
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