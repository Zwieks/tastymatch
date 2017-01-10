<script type="text/javascript">
    $(document).ready(function(e) {
        //Add media item to template
        $('#js_add_mediaitem').on('click', function(){
            addMediaItem();
        });

        //Remove media item from template
        $(document).on('click','.js-remove-mediaitem',function(){
            removeMediaItem($(this));
        });

        function saveMediaComponent(component){
            var token = $('meta[name="csrf-token"]').attr('content'),
                    url = '/ajax/saveMediaComponent';

            var obj_component = {
                imagepath: component.path,
                content: component.content
            }

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: url,
                headers: {'X-CSRF-TOKEN': token},
                data: obj_component,
                success: function (data) {
                    if(data.success == true) {
                        //Put the results in de container
                        console.log('Component is opgeslagen');
                    }
                }
            });
        }

        function objectLength(obj) {
            var result = 0;
            for(var prop in obj) {
                if (obj.hasOwnProperty(prop)) {
                    // or Object.prototype.hasOwnProperty.call(obj, prop)
                    result++;
                }
            }
            return result;
        }

        function removeMediaItem(object){
            object.parent().fadeOut( 0, function() {
                object.parent().remove();
            });
        }

        function addMediaItem() {

            var formData = {
                count: ($('#js-editable-wrapper .editable-wrapper').children().length)+1,
            };
            var token = $('meta[name="csrf-token"]').attr('content'),
                    url = '/ajax/addMediaItem',
                    count = 'test';

            $.ajax({
                type: 'POST',
                url: url,
                headers: {'X-CSRF-TOKEN': token},
                data: formData,
                success: function (data) {
                    if(data.success == true) {
                        //Put the results in de container
                        $('#js-editable-wrapper .editable-wrapper').append(data.html);
                    }
                }
            })
            .done(function(data) {
                var drop_id = 'DropzoneElementId'+data.id,
                        mce_id = '#tinyMceElementId'+data.id,
                        mce_video_id = '#tinyMceVideoElementId'+data.id;
                $.fn.myDropzoneThethird = new Dropzone(
                    '#'+drop_id, //id of drop zone element 2
                    {
                        paramName: 'photos',
                        url: '/ajax/upload',
                        dictDefaultMessage: "",
                        dictRemoveFile: "",
                        clickable: true,
                        autoProcessQueue: false,
                        maxFilesize: 1,
                        maxFiles: 1,
                        uploadMultiple: false,
                        addRemoveLinks: true,
                        parallelUploads: 1,
                        thumbnailWidth: 1680,
                        thumbnailHeight: 1040,
                        acceptedFiles: '.jpg, .png, .gif',
                        init: function() {
                            var count;
                            var myObject = new Object();

                            this.on("maxfilesexceeded", function(file) {
                                this.removeAllFiles();
                                this.addFile(file);
                            });

                            this.on("addedfile", function(file) {
                                var id = file.previewTemplate.previousSibling.parentElement.id;
                                count = objectLength(dropZoneObjects)+1;

                                myObject.num = count;
                                myObject.id = id;
                                myObject.name = file.name;
                                myObject.file = $.fn.myDropzoneThethird;

                                dropZoneObjects['component-media-'+count] = myObject;
                            });

                            this.on("success", function(file, response){
                                myObject.path = jQuery.parseJSON(response);
                                dropZoneObjects['component-media-'+count] = myObject;
                            });

                            this.on("removedfile", function(file) {
                                removeItem(file.name);
                            });
                        }
                    }
                );

                tinymce.init({
                    setup:function(ed) {
                        var placeholderText = 'asdf';
                        ContentCheck.setupVideo(ed,placeholderText);
                    },
                    selector: mce_video_id,
                    menubar:false,
                    inline: true,
                    plugins: " media",
                    toolbar: [
                        'undo redo media'
                    ]
                });

                tinymce.init({
                    setup:function(ed) {
                        var placeholderText = 'asdfasdf',
                            tag = '<p id="tinyMceElementId0" class="js-editable-media content editable editable-default mce-content-body" contenteditable="true" spellcheck="false">' + placeholderText + '</p>';
                        tag_empty = '<p id="tinyMceElementId0" class="js-editable-media content editable editable-default mce-content-body" contenteditable="true" spellcheck="false"></p>';
                        ContentCheck.setupDefault(ed,placeholderText,tag,tag_empty);
                    },
                    selector: mce_id,
                    menubar:false,
                    inline: true,
                    plugins: "textcolor colorpicker",
                    toolbar: [
                        'undo redo forecolor'
                    ]
                });
            });
        }

        //Add MENU ITEM
        $('.js-add-menuitem').on('click', function(e){
            var count = $(".detailpage-menu li").length + 1;
            $('<li class="form-input-textfield"><input placeholder="{{ Lang::get('tinymce.detailpage-foodstand-menu') }}" type="text" name="detailpage-menuitem-'+count+'"><div class="remove-menuitem js-remove-menuitem" data-icon="U"></div></li>').appendTo(".detailpage-menu .velden");
        });    
        
        //Remove MENU ITEM
        $(document).on('click','.js-remove-menuitem',function(){    
            $(this).parent().remove();
        });   

        //SAVE ALL THE CUSTOM TEMPLATE CONTENT
        $('.js-save-template').on('click', function(e){

            //Contains all the TinyMce changes
            var save_components = [];

            //Get the TINYMCE and put the changed components in the object
            for (var i = 0; i < tinymce.editors.length; i++)
            {
                //Get the content of the changed TINYMCE component
                var content = TinyMceSave(tinymce.editors[i].id);

                if(typeof content != 'undefined'){
                    save_components[content.componentId] = content;
                }
            }

            //Save check if components got any FORM childs
            $( ".changed" ).each(function( index ) {
                var key = $(this).closest('.product-wrapper').attr('id');

                //Check if the object already has been set
                if(typeof save_components[key] === 'undefined') {
                    var myObject = new Object();
                    myObject.componentId = key;
                    myObject.selector = key;
                    save_components[key] = myObject;
                }
                var target = save_components[key].componentId;

                //Find the form
                if($('#'+target).parent().find('form').length > 0){
                    var dataArray = $('#'+target).parent().find('form').serializeArray(),
                            formData = [];


                    $.each(dataArray, function(i, fd) {
                        if(fd.value != ""){
                            formData[fd.name] = fd.value;
                        }
                    });

                    if(objectLength(formData) != 0){
                        save_components[key].form = formData;
                    }
                }
            });

            //Get the DROPZONE files en put them in the object
            for(var key in dropZoneObjects) {
                // Merge save_components into dropZoneObjects, recursively
                if(key in save_components){
                    $.extend( true, dropZoneObjects, save_components);
                }

                save_components = dropZoneObjects;

                //Upload the image
                dropZoneObjects[key].file.processQueue();
            }

            //Save each component to database
            for(var key in save_components) {
                //Find the table name
                var arr = save_components[key].componentId.split('-');
                //Put table name in object
                save_components[key].table = arr[1];


                //saveMediaComponent(save_components[key]);
            }

            console.log(save_components);
        });

        //Check if the form has been altered
        $(document).on('change','form :input',function(){    
            var $fields = $(this);
            var $emptyFields = $fields.filter(function() {
                // remove the $.trim if whitespace is counted as filled
                return $.trim(this.value) === "";
            });
            if (!$emptyFields.length) {
                $(this).closest('.product-wrapper').addClass('changed');
            } else {
                $(this).closest('.product-wrapper').removeClass('changed');
            }
        });
    });
</script>