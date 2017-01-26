tinymce.init({
    setup:function(ed) {
        var placeholderText = '{!! Lang::get('tinymce.detailpage-foodstand-title') !!}',
        tag = '<p id="tinyMceElementId0" class="js-editable-media content editable editable-default mce-content-body" contenteditable="true" spellcheck="false">' + placeholderText + '</p>',
        tag_empty = '<p id="tinyMceElementId0" class="js-editable-media content editable editable-default mce-content-body" contenteditable="true" spellcheck="false"></p>';

        ContentCheck.SAVED_CONTENT = '';

        @if(isset($page_content['getMediaItems'][0]) && !is_null($page_content['getMediaItems']))
            ContentCheck.SAVED_CONTENT = '{!! $page_content['getMediaItems'][0]->content !!}';
        @endif

        ContentCheck.setupDefault(ed,placeholderText,tag,tag_empty,ContentCheck.SAVED_CONTENT);
    },
    selector: '.js-editable-media',
    menubar:false,
    inline: true,
    plugins: "textcolor colorpicker",
    toolbar: [
        'undo redo forecolor'
    ],
    init_instance_callback : function(ed) {
        @if(isset($page_content) && !is_null($page_content['getMediaItems']))
            ContentCheck.SAVED_CONTENT = '{!! $page_content['getMediaItems'][0]->content !!}';
        @endif

        if(ContentCheck.SAVED_CONTENT != '')
            ContentCheck.setSavedContent(ed,ContentCheck.SAVED_CONTENT);
    }
});

tinymce.init({
    setup:function(ed) {
        var placeholderText = '';
        ContentCheck.setupVideo(ed,placeholderText);
    },
    selector:'.js-editable-video',
    menubar:false,
    inline: true,
    plugins: " media",
    toolbar: [
        'undo redo media'
    ]
});