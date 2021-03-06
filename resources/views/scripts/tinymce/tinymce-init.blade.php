<script type="text/javascript">
    var ContentCheck = {
        PLACEHOLDER_TEXT : '',
        SAVED_CONTENT : '',
        SAVED_VIDEO : '',
        COUNT : 0,
        COUNT_VIDEO : 0,
        emptyBox : function(ed,object,placeholderText,tag) {
            //Get component ID
            var id = object.attr('id');
            $('#' + ed.id).addClass('empty-content');

            if(tag != 'video'){
                ed.setContent(placeholderText);
            }

            $('#'+ed.id).removeClass('changed-content');
        },

        fillBox : function(ed,object){
            var id = object.attr('id');
            $('#'+ed.id).removeClass('empty-content');
            $('#'+ed.id).addClass('changed-content');
        },

        setupDefault : function(ed,placeholderText,tag,tag_empty,saved_content){
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
                var content = ed.getContent(),
                    str = ed.id,
                    arr = str.split('-'),
                    strPart = arr[2];  

                if($.trim(content) == '' || $.trim(content) == placeholderText){
                    var placeholderText = '';

                    if(strPart == 'intro'){
                        placeholderText = '{!! Lang::get('tinymce.detailpage-foodstand-description') !!}';
                    }else if(strPart == 'contact'){
                        placeholderText = '{!! Lang::get('tinymce.detailpage-foodstand-contact-description') !!}';
                    }else{
                        placeholderText = '{!! Lang::get('tinymce.detailpage-foodstand-mediaitem') !!}';
                    }
                    
                    ContentCheck.emptyBox(ed,$(this),placeholderText,tag_empty);
                    //Loose the focus
                    $('#'+ed.id).blur();
                }else if($.trim(content) != ''){
                    ed.setContent(content);
                    ContentCheck.fillBox(ed,$(this),placeholderText);
                }else{
                    ContentCheck.setSavedContent(ed,saved_content);
                    ContentCheck.fillBox(ed,$(this),placeholderText);
                }
            });
        },

        setupVideo : function(ed,placeholderText,saved_video){
            ed.on('NodeChange', function(e){
                var content;

                if(ed.getContent() != ''){
                    content = ed.getContent();
                }else if($('#'+ed.id).hasClass('empty-content')){
                    content = '';
                }else{
                    content = saved_video;
                }

                if(content != ''){
                    $('#'+ed.id).parent().addClass('hasvideo changed-content');
                }else{
                    if($('#'+ed.id).parent().hasClass('hasvideo')){
                        $('#'+ed.id).parent().removeClass('hasvideo changed-content');
                    }
                }

                if($.trim(content) == ''){
                    ContentCheck.emptyBox(ed,$(this),placeholderText,'video');
                }else if($.trim(content) != ''){
                    ed.setContent(content);
                    ContentCheck.fillBox(ed,$(this),placeholderText);
                }else{
                    ContentCheck.setSavedContent(ed,saved_video);
                    ContentCheck.fillBox(ed,$(this),placeholderText);
                }
            }),

            ed.on('ProgressState', function(e) {
                console.log('ProgressState event', e);
            });
        },

        setSavedContent : function(ed,content,type){
            if(typeof content != 'undefined') {
                ContentCheck.fillBox(ed, $(this));
                if(typeof type != 'undefined'){
                    ed.setContent(content);
                }else{
                    ed.setContent($('<div/>').html(content).text());
                }
                ContentCheck.SAVED_CONTENT = '';
            }
        },
    };

    $.fn.initTinyMce = function initTinyMce(){
        tinymce.init({
            setup:function(ed) {
                var placeholderText = '{!! Lang::get('tinymce.detailpage-foodstand-description') !!}',
                    tag = ' <p class="editable-default">' + placeholderText + '</p>',
                    tag_empty = ' <p class="editable-default"></p>';

                ContentCheck.SAVED_CONTENT = '';

                @if(isset($page_content) && !is_null($page_content['getIntro']))
                    ContentCheck.SAVED_CONTENT = "{{ $page_content['getIntro']->content }}";
                @endif
                ContentCheck.setupDefault(ed,placeholderText,tag,tag_empty,ContentCheck.SAVED_CONTENT);
            },
            selector:'#js-editable-intro',
            element_format : 'html',
            entity_encoding : 'raw',
            force_br_newlines : false,
            force_p_newlines : false,
            forced_root_block : '',
            menubar:false,
            inline: true,
            init_instance_callback : function(ed) {
                @if(isset($page_content) && !is_null($page_content['getIntro']))
                    ContentCheck.SAVED_CONTENT = "{{ $page_content['getIntro']->content }}";
                @endif

                if(ContentCheck.SAVED_CONTENT != '')
                    ContentCheck.setSavedContent(ed,ContentCheck.SAVED_CONTENT);
            }
        });

        tinymce.init({
            setup:function(ed) {
                var placeholderText = "{!! Lang::get('tinymce.detailpage-foodstand-contact') !!}",
                    tag = '<p class="editable-default">' + placeholderText + '</p>',
                    tag_empty = '<p class="contact-intro"></p>';

                ContentCheck.SAVED_CONTENT = '';

                @if(isset($page_content) && !is_null($page_content['getContact']))
                    ContentCheck.SAVED_CONTENT = "{{ $page_content['getContact']->content }}";
                @endif

                ContentCheck.setupDefault(ed,placeholderText,tag,tag_empty,ContentCheck.SAVED_CONTENT);
            },
            selector: '#js-editable-contact',
            element_format : 'html',
            entity_encoding : 'raw',
            force_br_newlines : false,
            force_p_newlines : false,
            forced_root_block : '',
            menubar:false,
            inline: true,
            plugins: "textcolor colorpicker",
            toolbar: [
                'undo redo forecolor'
            ],
            init_instance_callback : function(ed) {
                @if(isset($page_content) && !is_null($page_content['getContact']))
                    ContentCheck.SAVED_CONTENT = "{{ $page_content['getContact']->content }}";
                @endif

                if(ContentCheck.SAVED_CONTENT != '')
                    ContentCheck.setSavedContent(ed,ContentCheck.SAVED_CONTENT);
            }
        });
        
        @if(isset($page_content))
            @include('scripts.tinymce.tinymce-multiple-init',compact('page_content'))
        @else
            @include('scripts.tinymce.tinymce-single-init')
        @endif
    }

    function TinyMceSave(GetId) {
        //Use get without #
        if($('#'+GetId).hasClass('changed-content') || $('#'+GetId).hasClass('empty-content')){

            //Get component ID
            var id = tinymce.get(GetId),
                media_video = false,
                object_componentid;

            if(typeof $('#'+id.id).parent().attr('id') != "undefined"){
                object_componentid = $('#'+id.id).parent().attr('id');
            }else if(typeof $('#'+id.id).parent().parent().attr('id') != "undefined"){
                object_componentid = $('#'+id.id).parent().parent().attr('id');
            }else if(typeof $('#'+id.id).closest('.media').attr('id') != "undefined"){
                //Most likely contains a video
                object_componentid = $('#'+id.id).closest('.media').attr('id');
                media_video = true;
            }else{
                return 'No components found';
            }

            var componentid = object_componentid,
                userid = {!! Session::get('user.global.id') !!},
                content = id.getContent();

            if(content == ''){
                tinymce.get(GetId).setContent('');
            }

            // Do you ajax call here, window.setTimeout fakes ajax call
            if(typeof content != "undefined"){
                var myObject = new Object();
                    myObject.componentId = componentid;
                    myObject.selector = id.id;
                    myObject.userid = userid;
                    if(media_video != true){
                        myObject.content = content;
                    }else{
                        myObject.video = content;
                    }
            }

            return myObject;
        }
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