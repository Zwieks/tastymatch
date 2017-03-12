@forelse ($page_content['getMediaItems'] as $item)
    var drop_id = 'DropzoneElementId'+{!! $loop->index !!},
        mce_id = '#tinyMceElementId0'+{!! $loop->index !!},
        mce_video_id = '#tinyMceVideoElementId'+{!! $loop->index !!},
        component_id = '{!! $item->component_mediaitem_id !!}';

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

            ed.on('change', function(e,content) {
                var parent_object = $('#'+ed.id).closest('.media');
                
                if(parent_object.attr('data-media') != ''){
                    parent_object.attr('data-status','updated');
                }
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
                ContentCheck.COUNT++;
            }

            if(ContentCheck.SAVED_CONTENT != '')
                ContentCheck.setSavedContent(ed,ContentCheck.SAVED_CONTENT);
        }
    });

    tinymce.init({
        setup:function(ed) {
            var placeholderText = '',
                content = {!! $page_content['getMediaItems'] !!};

            ContentCheck.SAVED_VIDEO = '';    
            if(typeof content[ContentCheck.COUNT_VIDEO] != 'undefined'){
                ContentCheck.SAVED_VIDEO = content[ContentCheck.COUNT_VIDEO].video;
                ContentCheck.COUNT_VIDEO++;
            }

            ContentCheck.setupVideo(ed,placeholderText,ContentCheck.SAVED_VIDEO);

        },
        selector:mce_video_id,
        menubar:false,
        inline: true,
        plugins: " media",
        toolbar: [
            'media'
        ],
        init_instance_callback : function(ed) {
            var content = {!! $page_content['getMediaItems'][$loop->index] !!};

            if(typeof content != 'undefined'){
                ContentCheck.SAVED_VIDEO = content.video;
            }

            if(ContentCheck.SAVED_VIDEO != ''){
                ContentCheck.setSavedContent(ed,ContentCheck.SAVED_VIDEO,'video');
                ContentCheck.COUNT_VIDEO++;
            }
        }    
    });
@empty
    console.log('empty');
@endforelse        