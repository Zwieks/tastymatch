tinymce.init({
    setup:function(ed) {
        ed.on('init', function() {
            var placeholderText = '{!! Lang::get('tinymce.detailpage-foodstand-mediaitem') !!}',
            content = {!! $page_content['getMediaItems'] !!},
            tag = '<p id="tinyMceElementId'+ContentCheck.COUNT+'" class="js-editable-media content editable editable-default mce-content-body" contenteditable="true" spellcheck="false">' + placeholderText + '</p>',
            tag_empty = '<p id="tinyMceElementId'+ContentCheck.COUNT+'" class="js-editable-media content editable editable-default mce-content-body" contenteditable="true" spellcheck="false"></p>';

            ContentCheck.SAVED_CONTENT = '';

            if(typeof content[ContentCheck.COUNT] != 'undefined'){
                ContentCheck.SAVED_CONTENT = content[ContentCheck.COUNT].content;
            }

            ContentCheck.setupDefault(ed,placeholderText,tag,tag_empty,ContentCheck.SAVED_CONTENT);
        });
    },
    selector: '.js-editable-media',
    menubar:false,
    inline: true,
    plugins: "textcolor colorpicker",
    toolbar: [
        'undo redo forecolor'
    ],
    init_instance_callback : function(ed) {
        var content = {!! $page_content['getMediaItems'] !!};

        if(typeof content[ContentCheck.COUNT] != 'undefined'){
            ContentCheck.SAVED_CONTENT = content[ContentCheck.COUNT].content;
            ContentCheck.COUNT++
        }

        if(ContentCheck.SAVED_CONTENT != '')
            ContentCheck.setSavedContent(ed,ContentCheck.SAVED_CONTENT);
    }
});

tinymce.init({
    setup:function(ed) {
        var placeholderText = '',
            content = {!! $page_content['getMediaItems'] !!};

        if(typeof content[ContentCheck.COUNT] != 'undefined'){
            ContentCheck.SAVED_VIDEO = content[ContentCheck.COUNT].video;
        }

        ContentCheck.setupVideo(ed,placeholderText,ContentCheck.SAVED_VIDEO)
    },
    selector:'.js-editable-video',
    menubar:false,
    inline: true,
    plugins: " media",
    toolbar: [
        'undo redo media'
    ],
    init_instance_callback : function(ed) {
        var content = {!! $page_content['getMediaItems'] !!};

        if(typeof content[ContentCheck.COUNT] != 'undefined'){
            ContentCheck.SAVED_CONTENT = content[ContentCheck.COUNT].content;
            ContentCheck.COUNT++
        }

        if(ContentCheck.SAVED_CONTENT != '')
            ContentCheck.setSavedContent(ed,ContentCheck.SAVED_CONTENT);
    }    
});