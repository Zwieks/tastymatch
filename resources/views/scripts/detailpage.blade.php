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

        function setDataAtributeMediaItems(components){
            $.each(components, function(key, item){
                $('#'+item.elementid).attr( "media", item.componentid );
            });
        }

        function saveMediaComponents(components){
            var token = $('meta[name="csrf-token"]').attr('content'),
                url = '/ajax/saveComponents';

            var newObject = objectReplaceKeyNamesToNumbers(components);

            var userObject = new Object();
                userObject['userid'] = {{ Session::get('user.global.id') }};
                userObject['pageid'] = $('input[name=pageid]').val();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: url,
                headers: {'X-CSRF-TOKEN': token},
                data: {jsonData: newObject, userDetail: userObject},
                success: function (data) {
                    if(data.success == true) {
                        //Put the results in de container
                        if(jQuery.parseJSON(data.mediaComponents).length > 0){
                            setDataAtributeMediaItems(jQuery.parseJSON(data.mediaComponents));
                        }
                        console.log('Component is opgeslagen');
                    }else{
                        console.log('Oeps..');
                    }
                },
                error: function(data){
                    // Error...
                    var errors = data.responseJSON,
                       inputname;

                    $.each(errors, function(index, error) {
                        var result = error[0].split(' ');

                        $.each(result, function(key, item){
                            var search = 'jsonData';
                            if (item.indexOf(search) !== -1){
                                var location = index.split('.');
                                inputname = location[location.length-1];
                                var object =  $( "input[name="+inputname+"]");

                                var text = error[0].replace(item, inputname);

                                object.parent().find('.input-error p').text(text);
                                object.parent().addClass('input-error');
                                object.parent().find('.input-error').show();
                            }
                        });
                    });
                }
            });
        }

        function objectReplaceKeyNamesToNumbers(obj) {
            var result = [],
            num = 0;
            for(var prop in obj) {
                if (obj.hasOwnProperty(prop)) {
                    result[num] = obj[prop];

                    if(typeof result[num].file != 'undefined'){
                        result[num].file =  'uploaded';
                    }

                    num++;    
                }
            }
            return result;
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

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
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

                            this.on('sending', function(file, xhr, formData){
                                formData.append('name', myObject.randomname);
                            });

                            this.on("addedfile", function(file) {
                                var id = file.previewTemplate.previousSibling.parentElement.id;
                                var suffix = id.match(/\d+/);
                                count = suffix[0];

                                myObject.num = count;
                                myObject.id = id;
                                myObject.name = file.name;
                                myObject.file = $.fn.myDropzoneThethird;
                                myObject.randomname = '{!! str_random(30) !!}'+'.'+file.type.split('/').pop();

                                dropZoneObjects['component-mediaitems-'+count] = myObject;
                            });

                            this.on("success", function(file, response){
                                myObject.path = jQuery.parseJSON(response);
                                dropZoneObjects['component-mediaitems-'+count] = myObject;
                            });

                            this.on("removedfile", function(file) {
                                removeItem(file.name);
                            });

                            //Check there is already an image uploaded
                            @if(isset($page_content['getHeaderimage']))
                                var path =  '{!! asset('storage/'.$page_content['getHeaderimage']->path) !!}';
                            @endif

                            if(typeof path != 'undefined' && path != ''){
                                var mockFile = { name: "logo.png", type: 'image/png' };
                                this.emit("addedfile", mockFile);
                                this.createThumbnailFromUrl(mockFile, path);
                            }
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
            $('<li class="form-input-textfield"><input placeholder="{{ Lang::get('tinymce.detailpage-foodstand-menu') }}" type="text" name="menuitem"><div class="remove-menuitem js-remove-menuitem" data-icon="U"></div></li>').appendTo(".detailpage-menu .velden");
        });    
        
        //Remove MENU ITEM
        $(document).on('click','.js-remove-menuitem',function(){
            $(this).parent().remove();
        });

        //SAVE ALL THE CUSTOM TEMPLATE CONTENT WITH THE CRTL+S
        $(document).bind('keydown', function(e) {
            if(e.ctrlKey && (e.which == 83)) {
                e.preventDefault();
                $('.js-save-template').trigger('click');
                return false;
            }
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
                    var dataArray = $('#'+target).find('form').serializeArray(),
                        formData = [],
                        count = 0;

                    $.each(dataArray, function(i, fd) {
                        if(fd.value != ""){
                            var myObject = new Object();
                                myObject[fd.name] = fd.value;

                            formData[count] = myObject;
                            count++;
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

                save_components[key] = dropZoneObjects[key];

                //Set image path
                save_components[key].path = 'uploads/'+{{ Session::get('user.global.id') }}+'/'+save_components[key].randomname;  

                //Upload the image
                if(typeof dropZoneObjects[key].file != 'undefined' && dropZoneObjects[key].file != 'uploaded')
                    dropZoneObjects[key].file.processQueue();
            }

            //Save each component to database
            for(var key in save_components) {

                //Find the table name
                if(typeof save_components[key].componentId != 'undefined'){
                    var arr = save_components[key].componentId.split('-');
                }else{
                    var arr = key.split('-');
                }
                //Put table name in object
                save_components[key].table = 'component_'+arr[1];

                //Put the URL in the object
                save_components[key].url = 'Save'+capitalizeFirstLetter(arr[1])+'Component';

                //Put the element id also in the object
                save_components[key].elementid = key;

                if(typeof $('#'+save_components[key].elementid).attr("media") != 'undefined' && $('#'+save_components[key].elementid).attr("media") != ''){
                    save_components[key].mediaid = $('#'+save_components[key].elementid).attr("media");
                }
            }

            if(objectLength(save_components) > 0){
                //Save the component
                saveMediaComponents(save_components);
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

            if($(this).parent().hasClass('input-error')){
                $(this).removeClass('input-error');
                $(this).parent().find('.input-error').hide();
            }

            if (!$emptyFields.length) {
                $(this).closest('.product-wrapper').addClass('changed');
            } else {
                $(this).closest('.product-wrapper').removeClass('changed');
            }
        });
    });
</script>