<script type="text/javascript">
    $.fn.Global = {
        DELETE_IMAGES : [],
        AGENDA_ITEMS : [],
        DELETE_COMPONENTS : []
    };

    /**
     * Update agenda item in the Global save object
     * @param NYS
     * @return NYS
     */
    function updateAgendaItemsToGlobalSaveObject(agendaitem){
        var newAgendaObject = new Object(),
            count = 0;

        //Create a better workable object
        for(var prop in agendaitem) {
            if (agendaitem.hasOwnProperty(prop)) {
                for(var item in agendaitem[prop]) {
                    newAgendaObject[item] = agendaitem[prop][item];
                }
                count++;
            }
        }

        //Update the items
        $.each($.fn.locations_object, function(index, value) {
            if( value.event_id == newAgendaObject.eventid){
                //Set the update NAME
                $.fn.locations_object[index]['info'].name = newAgendaObject.searchevents;
                //Set the update TYPE
                $.fn.locations_object[index]['info'].type_id = newAgendaObject.eventtype;
                //Set the update DESCRIPTION
                $.fn.locations_object[index]['info'].description = newAgendaObject.description;
                //Set the update LOCATION
                $.fn.locations_object[index]['info'].location = newAgendaObject.location;
                //Set the update DATE START
                $.fn.locations_object[index].date_start = newAgendaObject.datestart;
                //Set the update DATE END
                $.fn.locations_object[index].date_end = newAgendaObject.dateend;
            }
        });

        //Update the agenda items
        setAgendaItems();
    }

    /**
     * Adds the new create agenda item to the Global save object
     * @param NYS
     * @return NYS
     */
    function addAgendaItemsToGlobalSaveObject(agendaitem){
        var newAgendaObject = new Object(),
            count = 0;

        for(var prop in agendaitem) {
            if (agendaitem.hasOwnProperty(prop)) {
                for(var item in agendaitem[prop]) {
                    newAgendaObject[item] = agendaitem[prop][item];
                }
                count++;
            }
        }

        $.fn.Global.AGENDA_ITEMS.push(newAgendaObject);

        $.each($.fn.locations_object, function(index, value) {
            if(value.id == $.fn.Global.AGENDA_ITEMS[0].id && typeof $.fn.Global.AGENDA_ITEMS[0].eventid != 'undefined'){
                $.fn.locations_object[index].event_id = $.fn.Global.AGENDA_ITEMS[0].eventid;
                $.fn.locations_object[index]['info'].id = $.fn.Global.AGENDA_ITEMS[0].eventid;
                $.fn.locations_object[index]['info'].searchable = $.fn.Global.AGENDA_ITEMS[0].searchable.toString();
            }else{
                $.fn.locations_object[index]['info'].searchable = '0';
            }
            $.fn.locations_object[index]['info'].new = true;
        });
    }

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
        //Validate form
        function validateForm(formData,dataArray){
            var token = $('meta[name="csrf-token"]').attr('content'),
                url = '/ajax/validateForm',
               error_response = false;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: url,
                headers: {'X-CSRF-TOKEN': token},
                data: {jsondata: formData},
                async:false,
                success: function (data) {
                    if(data.success == true) {
                        var status = '';
                        //Create object for the GM handles
                        formData = createNiceFormObject(dataArray);

                        //Get the object status
                        $.each(formData, function(index, value) {
                            if(typeof value['status'] != 'undefined')
                                status = value['status'];
                        });

                        //Check if the marker has state 'new', if not create a new one
                        if(status == 'new'){
                            //Create the new marker
                            create_new_marker(formData);
                        }else{
                            //Add the data to the global save object
                            updateAgendaItemsToGlobalSaveObject(formData);

                            //Close the modal
                            $('#modal').modal('toggle');
                        }
                    }else{
                        console.log('Something went wrong.. please let us know if you see this text');
                    }
                },
                error: function(data){
                    // Error...
                    var errors = data.responseJSON,
                        inputname,
                        error_response = true;
                    $.each(errors, function(index, error) {
                        var result = error[0].split(' ');

                        $.each(result, function(key, item){
                            var search = 'jsondata';

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
                data: {jsondata: newObject, userDetail: userObject},
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
                            var search = 'jsondata';

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
            var object_key = object.parent().attr('id'),
                remove_array = [],
                text_element = $('#'+object_key).find('.js-editable-media ').attr('id');
                video_element = $('#'+object_key).find('.js-editable-video').attr('id');

            //Remove TINYMCE text
            tinymce.remove('#'+text_element);

            //Remove TINYMCE video
            tinymce.remove('#'+video_element);

            //Check if the object contains a media tag. If so it is in the database,
            //then add the number to the global delete components array 
            if(object.parent().attr('media').length > 0){
                remove_array.push(object.parent().attr('media'));
                remove_array.push(object_key);

                if(typeof dropZoneObjects[object_key] != 'undefined')
                    remove_array.push(dropZoneObjects[object_key].path);

                if(typeof dropZoneObjects[object_key] != 'undefined')
                    dropZoneObjects[object_key].file = '';

                $.fn.Global.DELETE_COMPONENTS.push(remove_array);
            }

            //Remove the object from the HTML
            object.parent().fadeOut( 0, function() {
                object.parent().remove();
            });
        }

        function deleteComponents(){
            var token = $('meta[name="csrf-token"]').attr('content');

            var userObject = new Object();
                userObject['pageid'] = $('input[name=pageid]').val();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/ajax/deleteComponents',
                headers: {'X-CSRF-TOKEN': token},
                data: {jsondata: $.fn.Global.DELETE_COMPONENTS, userDetail: userObject},
                success: function () {
                    $.fn.Global.DELETE_COMPONENTS = [];
                },
                error: function(){
                    $.fn.Global.DELETE_COMPONENTS = [];
                }
            });
        }

        function deleteImages(){
            var token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/ajax/deleteImages',
                headers: {'X-CSRF-TOKEN': token},
                data: {jsondata: $.fn.Global.DELETE_IMAGES},
                success: function () {
                    $.fn.Global.DELETE_IMAGES = [];
                },
                error: function(){
                    $.fn.Global.DELETE_IMAGES = [];
                }
            });
        }

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function addDefaultMediaObject(save_components){
            var key = 'component-mediaitems-0';

            save_components[key] = new Object();

            save_components[key].elementid = key;
            save_components[key].file = '';

            if(typeof save_components[key].content === 'undefined' && key != 'component-headerimage')
            save_components[key].content = '';

            save_components[key].num = 0;
            save_components[key].name = '';
            save_components[key].path = '';
            save_components[key].randomname = '';

            //Set object items
            save_components[key] = setObjectItems(save_components, key); 

            return save_components;
        }

        function setObjectItems(save_components, key){
            //Find the table name
            if(typeof save_components[key].componentId != 'undefined'){
                var arr = save_components[key].componentId.split('-');
            }else{
                var arr = key.split('-');
            }
            //Put table name in object
            save_components[key].table = 'component_'+arr[1];

            //Put the URL in the object
            if(typeof arr[1] != 'undefined'){
                save_components[key].url = 'Save'+capitalizeFirstLetter(arr[1])+'Component';
            }else{
                save_components[key].url = '';
            }

            //Put the element id also in the object
            save_components[key].elementid = key;

            if(typeof $('#'+save_components[key].elementid).attr("media") != 'undefined' && $('#'+save_components[key].elementid).attr("media") != ''){
                save_components[key].mediaid = $('#'+save_components[key].elementid).attr("media");
            }

            return save_components[key];
        }

        function createNiceFormObject(dataArray){
            var formData = [],
                count = 0;

            $.each(dataArray, function(i, fd) {
                if(fd.value != ""){
                    var myObject = new Object();
                        myObject[fd.name] = fd.value;

                    formData[count] = myObject;
                    count++;
                }
            });

            return formData; 
        }

        function createValidateObject(dataArray){
            var formData = {};

            $.each(dataArray, function(i, fd) {
                formData[fd.name] = fd.value;
            });

            return formData;
        }

        function addMediaItem() {

            var formData = {
                count: ($('#js-editable-wrapper .editable-wrapper').children().length),
            };
            var token = $('meta[name="csrf-token"]').attr('content'),
                    url = '/ajax/addMediaItem';

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
                                var random = (new Date).getTime();
                                count = suffix[0];

                                myObject.num = count;
                                myObject.id = id;
                                myObject.name = file.name;
                                myObject.file = $.fn.myDropzoneThethird;
                                myObject.randomname = random+'.'+file.type.split('/').pop();

                                dropZoneObjects['component-mediaitems-'+count] = myObject;
                            });

                            this.on("success", function(file, response){
                                dropZoneObjects['component-mediaitems-'+count] = myObject;
                                dropZoneObjects['component-mediaitems-'+count].name =  myObject.randomname;

                            });

                            this.on("removedfile", function(file) {
                                removeItem(file);
                                myObject.file = '';
                                myObject.path = '';
                                myObject.randomname = '';
                            });
                        }
                    }
                );

                tinymce.init({
                    setup:function(ed) {
                        var placeholderText = '';

                        ContentCheck.SAVED_VIDEO = '';    

                        ContentCheck.setupVideo(ed,placeholderText,ContentCheck.SAVED_VIDEO)
                    },
                    selector: mce_video_id,
                    menubar:false,
                    inline: true,
                    plugins: " media",
                    toolbar: [
                        'media'
                    ]
                });

                tinymce.init({
                    setup:function(ed){
                        var placeholderText = '',
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

        //Remove VIDEO ITEM
        $(document).on('click','.js-remove-video', function(){
            var video_element = $(this).parent().find('.js-editable-video').attr('id'),
                id = '#'+video_element,
                object = $(this).parent().find('.js-editable-video');

            // Empty the content
            tinymce.activeEditor.setContent('');
            ContentCheck.emptyBox(tinymce.activeEditor,object,'','video');
            ContentCheck.SAVED_VIDEO = '';
            tinymce.EditorManager.execCommand('mceAddEditor',true, video_element);

            //Remove the classes that had been set if there was content
            if($(id).parent().hasClass('hasvideo')){
                $(id).parent().removeClass('hasvideo changed-content');
                $(id).removeClass('changed-content');
            }
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
            for (var i = 0; i < tinymce.editors.length; i++){

                //Get the content of the changed TINYMCE component
                var content = TinyMceSave(tinymce.editors[i].id),
                    has_video = false;

                if(typeof content != 'undefined'){
                    //Check if there is a video in the media item
                    if(content.componentId in save_components){
                        if(typeof content.video != 'undefined' && content.video != '') {
                            //Add only the video item
                            save_components[content.componentId].video = content.video;
                            has_video = true;
                        }
                    }

                    //If object does not contain a video add it to the array
                    if(has_video != true)
                        save_components[content.componentId] = content;
                }
            }

            //Save the AGENDA FORM content
            var count = 0;
            $.each($.fn.locations_object, function(index, value) {
                if(typeof value.new != 'undefined'){
                    save_components['component-agendaitems-'+count] = value;
                    count++;
                }
            });

            //Save check if components got any FORM childs
            $( ".changed" ).each(function( index ) {
                var key = $(this).closest('.product-wrapper').attr('id');

                //Check if the object already has been set
                if(typeof save_components[key] === 'undefined') {
                    var myObject = {};
                        myObject.componentId = key;
                        myObject.selector = key;
                        save_components[key] = myObject;
                }
                var target = save_components[key].componentId;

                //Find the form
                if($('#'+target).parent().find('form').length > 0){
                    var dataArray = $('#'+target).find('form').serializeArray(),
                    formData = createNiceFormObject(dataArray);   

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
                if(save_components[key].randomname != ''){
                    save_components[key].path = 'uploads/'+{{ Session::get('user.global.id') }}+'/'+save_components[key].randomname;
                }else{
                    save_components[key].path = '';
                    //Add the remove item to tell this image have to be removed
                }

                //Upload the image or add the path to delete array
                if(typeof dropZoneObjects[key].file != 'undefined' && dropZoneObjects[key].file != '' && dropZoneObjects[key].file != 'uploaded'){
                    dropZoneObjects[key].file.processQueue();
                }
                else if(dropZoneObjects[key].file === ''){
                    var object_key = dropZoneObjects[key].elementid,
                        media_id = dropZoneObjects[key].mediaid,
                        remove_array = [];

                    remove_array.push('/app/public/uploads/'+'{{ Session::get('user.global.id') }}/'+dropZoneObjects[key].name);
                    remove_array.push(object_key);
                    remove_array.push(media_id);
                    //Delete image file inside the folder by add the name inside the delete_image array
                    $.fn.Global.DELETE_IMAGES.push(remove_array);
                }
            }


            //Save each component to database
            for(var key in save_components) {
                //Check if the key is inside the delete array
                $.each($.fn.Global.DELETE_COMPONENTS, function(ind, item) {
                    if(key === item[1]){
                        save_components[key].delete = 'true';
                    }
                });

                //Set object items
                save_components[key] = setObjectItems(save_components, key);
            }

            //Check if both the image and text are empty if so remove the media
            var total_media_blocks = $('.media').not('.add-item').length,
                index_key,
                media_id;

            if(typeof save_components['component-mediaitems-0'] === 'undefined'){
                addDefaultMediaObject(save_components);       
            }    

            $('.media').not('.add-item').each(function( index ) {
                if(total_media_blocks > 1){
                    index_key = $(this).attr('id');
                    media_id = $(this).attr('media');
                }else if(total_media_blocks == 1){
                    var index_key = $(this).attr('id'),
                        media_id = $(this).attr('media');
                    setObjectItems(save_components, index_key);
                }else{
                    addDefaultMediaObject(save_components);
                }    

                if(total_media_blocks > 1){
                    if((typeof dropZoneObjects[index_key] === 'undefined' && 
                        typeof save_components[index_key] === 'undefined' && 
                        typeof media_id != 'undefined' && 
                        media_id != '') ||
                        (typeof save_components[index_key] === 'undefined' ||
                          save_components[index_key].path == '' &&
                          save_components[index_key].randomname == '' &&
                          typeof save_components[index_key].content === 'undefined')){
                            var remove_array = [];

                            if(typeof save_components[index_key] != 'undefined')
                                save_components[index_key].delete = 'true';

                            remove_array.push($(this).attr('media'));
                            remove_array.push(index_key);

                            $.fn.Global.DELETE_COMPONENTS.push(remove_array);
                    }
                }    
            });

            //SAVE the component
            if(objectLength(save_components) > 0){
                saveMediaComponents(save_components);
            }

            //Remove components if the file is empty
            if($.fn.Global.DELETE_COMPONENTS.length > 0){
                deleteComponents();
            }

            //Remove images
            if($.fn.Global.DELETE_IMAGES.length > 0){
                deleteImages();
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


        /**
         * Form handeling when the user wants to save the agenda item
         */
        $(document).on('click','.js-add-agenda-item',function(){
            // Get the form data
            var dataArray = $('#js-modal-create-agenda-items').serializeArray(),
                eventIdObject = {},
                searchObject = {},
                statusObject = {},
            countObject = {};

            eventIdObject['name'] = 'eventid';
            eventIdObject['value'] = $('#js-filter-input').attr('eventid').toString();

            searchObject['name'] = 'searchable';
            statusObject['name'] = 'status';

            if($('#js-filter-input').attr('searchable') != ''){
                searchObject['value'] = $('#js-filter-input').attr('searchable').toString();
                statusObject['value'] = 'update';
            }else if(eventIdObject['value'] != ''){
                searchObject['value'] = '1';
                statusObject['value'] = 'new';
            }else{
                searchObject['value'] = '0';
                statusObject['value'] = 'new';
            }

            countObject['name'] = 'id';
            countObject['value'] = objectLength($.fn.locations_object)+1;

            dataArray.push(eventIdObject,searchObject,countObject,statusObject);

            var validateData = createValidateObject(dataArray);

            //Check form inputs
            validateForm(validateData,dataArray);
        });    
    });
</script>