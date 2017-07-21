<script type="text/javascript">
    $.fn.Global = {
        DELETE_IMAGES : [],
        DELETE_AGENDA_ITEMS : [],
        AGENDA_ITEMS : [],
        SAVE_COMPONENTS : [],
        AJAX_COMPLETE : false,
        TYPES : ['foodstand','entertainer','event'],
        DELETE_COMPONENTS : []
    };

    /**
     * Update agenda item in the Global save object
     * @param NYS
     * @return NYS
     * TAG: UPDATEAGENDAGLOBALOBJECT
     */
    function updateAgendaItemsToGlobalSaveObject(agendaitem){
        var newAgendaObject = new Object(),
            delete_from_location_object = [],
            isUpdate = false,
            inCheck = false,
            deleted = false,
            delete_array = [],
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

        $.each($.fn.locations_object, function(index, value) {
            if(inCheck == false){
                //Check if the new agenda item is already in the location object so an UPDATE
                if(typeof newAgendaObject.eventid != 'undefined' && value.event_id == newAgendaObject.eventid){
                    //Now we know the item already exist in de database
                    //It have to be an update but check if it only need to update the dates or other fields
                    if(newAgendaObject.status == 'update-agenda-only'){
                        $.fn.locations_object[index]['info'].status = 'update-agenda-only';
                         //Set the update DATE START
                        $.fn.locations_object[index].date_start = newAgendaObject.datestart;
                        //Set the update DATE END
                        $.fn.locations_object[index].date_end = newAgendaObject.dateend;

                        inCheck = true;
                    }else if(newAgendaObject.status == 'update'){
                        //Check if the location has been changed
                        //This needs to be check because of the new marker thats needs to be added/removed
                        if(value['info'].location != newAgendaObject.location){
                            var newObject = {};
                                newObject['status'] = 'update';

                            agendaitem.push(newObject);

                            //Remove the item from the location object
                            delete_array.push(index);
                        }else{

                            //Set the update NAME
                            $.fn.locations_object[index]['info'].name = newAgendaObject.searchevents;
                            //Set the update TYPE
                            $.fn.locations_object[index]['info'].type_id = newAgendaObject.type_id;
                            //Set the update DESCRIPTION
                            $.fn.locations_object[index]['info'].description = newAgendaObject.description;
                            //Set the update DATE START
                            $.fn.locations_object[index].date_start = newAgendaObject.datestart;
                            //Set the update DATE END
                            $.fn.locations_object[index].date_end = newAgendaObject.dateend;
                            //Set the update STATYS
                            $.fn.locations_object[index]['info'].status = 'update';
                        }    

                        inCheck = true;
                    }else if(newAgendaObject.status == 'delete'){   
                        $.fn.locations_object[index]['info'].status = 'delete';
                        createRemoveArray(parseInt(value.id), parseInt(value['info'].id), value['info'].searchable);
                        //Remove the item from the location object
                        delete_array.push(index); 

                        inCheck = true;
                    }else if(newAgendaObject.status == 'new'){
                        var newObject = {};
                            newObject['searchable'] = '1';
                        agendaitem.push(newObject);

                        //Remove the item from the location object
                        delete_array.push(index); 

                        deleteMarkers();
                        
                        create_new_marker(agendaitem);

                        inCheck = true;
                    }   

                    isUpdate = true;
                }else if(typeof newAgendaObject.eventid == 'undefined' && typeof value.event_id == 'undefined' && typeof newAgendaObject.status != 'undefined' && newAgendaObject.status == 'delete'){
                    createRemoveArray(parseInt(value.id), parseInt(value['info'].id), value['info'].searchable);
                    //Remove the item from the location object
                    delete_array.push(index); 
                    
                    inCheck = true;
                }
            } 
        });

        //Remove item from location object
        if(delete_array.length != 0){
            $.each(delete_array, function(index, value) {
                $.fn.locations_object.splice(value,1);

                deleteMarkers();

                initMap();
            }); 

            deleted = true;
        }

        //If there is no 
        if(isUpdate == false && deleted == false){
            var newObject = {};
                newObject['status'] = 'new';
            agendaitem.push(newObject);

            //Set the update LOCATION marker en put data in array
            deleteMarkers();
            create_new_marker(agendaitem);
        }

        //Update the agenda items
        setAgendaItems(agendaitem);
        //Close the modal
        $('#modal-form').modal('toggle');
    }

    /**
     * Adds the new create agenda item to the Global save object
     * @param agenda_id(int), event_id(int), searchable(int)
     *
     */
    function createRemoveArray(agenda_id, event_id, searchable){
        var in_delete_object = false;

        if($.fn.Global.DELETE_AGENDA_ITEMS.length > 0) {
            $.each($.fn.Global.DELETE_AGENDA_ITEMS, function (delete_index, delete_value) {
                if (typeof delete_value['agenda_id'] != 'undefined' && delete_value['agenda_id'] == agenda_id) {
                    in_delete_object = true;
                }
            });
        }

        if(in_delete_object == true)
            return false;

        var remove_agendaitem_array = {};
        //Set the delete item
        remove_agendaitem_array['deleteitem'] = 'true';

        //Set the agenda id that can be removed
        remove_agendaitem_array['agenda_id'] = agenda_id;

        //Set the eventid if the searchable is 0. When this is 0 the even can be deleted
        remove_agendaitem_array['event_id'] = event_id;

        //Put the Agenda item in the DELETE AGENDA ITEM array.
        //This will be used to delete the agenda item in this array on deletion
        $.fn.Global.DELETE_AGENDA_ITEMS.push(remove_agendaitem_array);
    }

    $(document).ready(function(e) {
        $(document).ajaxComplete(function(){
            if($.fn.Global.AJAX_COMPLETE == true){
                resetSession();
                $.fn.Global.AJAX_COMPLETE = false;
            }
            return false;
        });

        //Show more category items 
        //Showed on Entertainer detailpages
        $('.js-toggle-dropdown').on('click', function(){
            var item = $(this).parent().parent().find('.submenu-wrapper');
            item.toggleClass('active');

            //Unset all checkboxes on toggle
            if(!item.hasClass('active')){
                //Check if the items are already saved
                if(!item.hasClass('js-saved')){
                    item.find('input[type=checkbox]').attr('checked',false);
                }
                item.parent().find('.dropdown').attr('data-icon','O');
            }else{
                item.parent().find('.dropdown').attr('data-icon','M');
            }
        });

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
                $('#'+item.elementid).attr( "data-media", item.componentid );
            });
        }

        function setDataAtributeAgendaItems(items){
            $.each(items, function(key, item){
                var object = $('#js-agenda-overview').find('li[data-random="'+item.random+'"]');
                object.attr( "id", item.agendaid );
                object.attr( "data-event-id", item.eventid );
            });
        }

        function checkIfSingleObjectIsEmpty(index,value){
            var key = 'component-agendaitems-updateagendaonly-'+index,
            animationParams = {};
            animationParams[key] = value;

            var result = jQuery.isEmptyObject(animationParams);

            return result;
        }

        function countStringNumberInKeys(object,string){
            var count = 0;
            for(var prop in object) {
                if (object.hasOwnProperty(prop)) {
                    // or Object.prototype.hasOwnProperty.call(obj, prop)
                    if (prop.toLowerCase().indexOf(string) >= 0){
                        count++;
                    }
                }
            }

            return count;
        }

        /**
         * Validate form
         * TAG: VALIDATEFORM
         */
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
                        var status = '',
                            new_item ='';

                        //Create object for the GM handles
                        formData = createNiceFormObject(dataArray);

                        //Add the data to the global save object
                        updateAgendaItemsToGlobalSaveObject(formData);

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

        function updateLocationObject(items){
            $.each(items, function(key, item){
                if(typeof item.random != 'undefined' && item.random != ''){
                    $.each($.fn.locations_object, function(index, value) {
                        if(typeof value['info'].random != 'undefined' && item.random == value['info'].random){
                            $.fn.locations_object[index].event_id = item.eventid;
                            $.fn.locations_object[index].id = item.agendaid;
                            $.fn.locations_object[index]['info'].status = 'delete';
                            $.fn.locations_object[index]['info'].id = item.eventid;
                        }
                    });
                }
            });
        }

        function saveMediaComponents(components, object){
            var token = $('meta[name="csrf-token"]').attr('content'),
                url = '/ajax/saveComponents',
                type = '{!! Request::segment(2) !!}',
                save = object.attr("data-save"),
                status = '{!! Request::segment(1) !!}';

            if(jQuery.inArray(type, $.fn.Global.TYPES) == -1){
               return false;
            }

            var newObject = objectReplaceKeyNamesToNumbers(components);
            var userObject = new Object();

            @if(!is_null(Session::get('user.global.id')))
                userObject['userid'] = {{ Session::get('user.global.id') }};
            @else
                userObject['userid'] = '';
            @endif 

            userObject['pageid'] = $('input[name=pageid]').val();
            var newWindow = window.open('/', '_blank');
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: url,
                headers: {'X-CSRF-TOKEN': token},
                data: {jsondata: newObject, userDetail: userObject, itemType: type, itemStatus: status, saveType: save},
                success: function (data) {
                    if(data.success == true) {
                        //Put the results in de container
                        if(jQuery.parseJSON(data.mediaComponents).length > 0){
                            setDataAtributeMediaItems(jQuery.parseJSON(data.mediaComponents));
                        }
                        //Update the new create agenda items data attributes
                        if(jQuery.parseJSON(data.agendaItems).length > 0){
                            setDataAtributeAgendaItems(jQuery.parseJSON(data.agendaItems));
                            //Update the location object
                            updateLocationObject(jQuery.parseJSON(data.agendaItems));
                        }    

                        console.log('Component is opgeslagen');
                        //Toggle save modal
                        $('#modal-success').modal('toggle');
                    }else if(data.success == false && data.preview == true){
                        //If preview op 
                        newWindow.location = '/preview/'+data.type+'/'+data.cache_id;
                    }else{
                        console.log('Oeps..');
                        //Toggle save modal
                        $('#modal-error').modal('toggle');
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
            }).done(function(data){
                if(data.success == true) {
                    $.fn.Global.AJAX_COMPLETE = true;
                }

                setTimeout(function(){ 
                    $('.notification').modal('hide'); 
                }, 1500);
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

        //REMOVE MEDIA ITEM onclick
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
            if(object.parent().attr('data-media').length > 0){
                remove_array.push(object.parent().attr('data-media'));
                remove_array.push(object_key);

                if(typeof dropZoneObjects[object_key] != 'undefined'){
                    remove_array.push(dropZoneObjects[object_key].path);
                    dropZoneObjects[object_key].file = '';
                }
                    
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

        function deleteAgendaItems(){
            var token = $('meta[name="csrf-token"]').attr('content');

            var userObject = new Object();
                userObject['pageid'] = $('input[name=pageid]').val();

            @if(!is_null(Session::get('user.global.id')))
                userObject['userid'] = {{ Session::get('user.global.id') }};
            @else
                userObject['userid'] = '';
            @endif 

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/ajax/deleteAgendaItems',
                headers: {'X-CSRF-TOKEN': token},
                data: {jsondata: $.fn.Global.DELETE_AGENDA_ITEMS, userDetail: userObject},
                success: function () {
                    console.log('Agenda item deleted');
                    //Update the location object
                  //  $.fn.Global.DELETE_AGENDA_ITEMS = [];
                },
                error: function(){
                    console.log('Error');
                }
            });
        }


        function resetSession(){
            var token = $('meta[name="csrf-token"]').attr('content');

            var userObject = new Object();
                userObject['pageid'] = $('input[name=pageid]').val();

            @if(!is_null(Session::get('user.global.id')))
                userObject['userid'] = {{ Session::get('user.global.id') }};
            @else
                userObject['userid'] = null;
            @endif 

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/ajax/resetSession',
                headers: {'X-CSRF-TOKEN': token},
                data: {userDetail: userObject},
                success: function () {
                    console.log('Session has been reset');
                },
                error: function(){
                    console.log('Error');
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


        //Extends the object with the TABLE NAME,URL and ID
        function setObjectItems(save_components, key){
            //Find the table name
            if(typeof save_components[key].componentId != 'undefined'){
                var arr = save_components[key].componentId.split('-');
            }else{
                var arr = key.split('-');
            }
            //Put table name in object
            if(arr[1] == 'locationdetails'){
                //Exception voor de event details
                save_components[key].table = 'events';
            }else{
                save_components[key].table = 'component_'+arr[1];
            }

            //Put the URL in the object
            if(typeof arr[1] != 'undefined'){
                save_components[key].url = 'Save'+capitalizeFirstLetter(arr[1])+'Component';
            }else{
                save_components[key].url = '';
            }

            //Put the element id also in the object
            save_components[key].elementid = key;

            if(typeof $('#'+save_components[key].elementid).attr("data-media") != 'undefined' && $('#'+save_components[key].elementid).attr("data-media") != ''){
                save_components[key].mediaid = $('#'+save_components[key].elementid).attr("data-media");
                save_components[key].status = $('#'+save_components[key].elementid).attr("data-status");
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
            $(this).parent().find('input').val("");
            $(this).parent().remove();
        });

        //Remove VIDEO ITEM
        $(document).on('click','.js-remove-video', function(){
            var video_element = $(this).parent().find('.js-editable-video').attr('id'),
                id = '#'+video_element,
                object = $(this).parent().find('.js-editable-video'),
                parent_object = $(id).closest('.media'),
                component_id = parent_object.attr('id');

            if($(parent_object).attr('data-media') != ''){
                $(parent_object).attr('data-status','updated');
            }

            if(typeof $.fn.Global.SAVE_COMPONENTS[component_id] != 'undefined'){
                $.fn.Global.SAVE_COMPONENTS[component_id].video = '';
            }

            // Empty the content
            tinymce.get(video_element).setContent('');
            ContentCheck.emptyBox(tinymce.get(video_element),object,'','video');
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
        $(document).on('click','.js-save-template', function(){
            //Contains all the TinyMce change
            var formdata = '',
                object = $(this);

            $.fn.Global.SAVE_COMPONENTS.length = 0;

            //Get the TINYMCE and put the changed components in the object
            for (var i = 0; i < tinymce.editors.length; i++){

                //Get the content of the changed TINYMCE component
                var content = TinyMceSave(tinymce.editors[i].id),
                    has_video = false;

                if(typeof content != 'undefined'){
                    //Check if there is a video in the media item
                    if(content.componentId in $.fn.Global.SAVE_COMPONENTS){
                        if(typeof content.video != 'undefined' && content.video != '') {
                            //Add only the video item
                            $.fn.Global.SAVE_COMPONENTS[content.componentId].video = content.video;
                            has_video = true;
                        }
                    }

                    //If object does not contain a video add it to the array
                    if(has_video != true)
                        $.fn.Global.SAVE_COMPONENTS[content.componentId] = content;
                }
            }

            //Save the AGENDA FORM content
            $.each($.fn.locations_object, function(index, value) {
                if(typeof value['info'].status != 'undefined'){
                    if(value['info'].status == 'new'){
                        var count = countStringNumberInKeys($.fn.Global.SAVE_COMPONENTS,'component-agendaitems-new');
                        $.fn.Global.SAVE_COMPONENTS['component-agendaitems-new-'+count] = value;
                    }else if(value['info'].status == 'update-agenda-only'){
                        var count = countStringNumberInKeys($.fn.Global.SAVE_COMPONENTS,'component-agendaitems-updateagendaonly');    
                        $.fn.Global.SAVE_COMPONENTS['component-agendaitems-updateagendaonly-'+count] = value;
                    }else if(value['info'].status == 'update'){
                        var count = countStringNumberInKeys($.fn.Global.SAVE_COMPONENTS,'component-agendaitems-update');
                        $.fn.Global.SAVE_COMPONENTS['component-agendaitems-update-'+count] = value;
                    }
                }
            });

            //Get the DROPZONE files en put them in the object
            for(var key in dropZoneObjects) {
                // Merge $.fn.Global.SAVE_COMPONENTS into dropZoneObjects, recursively
                if(key in $.fn.Global.SAVE_COMPONENTS){
                    $.extend( true, dropZoneObjects, $.fn.Global.SAVE_COMPONENTS);
                }

                $.fn.Global.SAVE_COMPONENTS[key] = dropZoneObjects[key];

                //Set image path
                if($.fn.Global.SAVE_COMPONENTS[key].randomname != '' && typeof $.fn.Global.SAVE_COMPONENTS[key].randomname != 'undefined'){
                    @if(!is_null(Session::get('user.global.id')))
                        var session = {{ Session::get('user.global.id') }};
                    @else
                         var session = userObject['userid'] = '';
                    @endif 
                    $.fn.Global.SAVE_COMPONENTS[key].path = 'uploads/'+session+'/'+$.fn.Global.SAVE_COMPONENTS[key].randomname;
                }else{
                    $.fn.Global.SAVE_COMPONENTS[key].path = '';
                    //Add the remove item to tell this image have to be removed
                }

                //Upload the image or add the path to delete array
                if(typeof dropZoneObjects[key].file != 'undefined' && dropZoneObjects[key].file != '' && dropZoneObjects[key].file != 'uploaded'){
                    if(object.attr("data-save") === 'preview'){
                        $.fn.myDropzoneTheFirst.options.url = "/ajax/temp";   
                    }

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


            //Save check if components got any FORM childs
            $.each($( ".changed" ), function(index, value) {
                var key = $(value).closest('.product-wrapper').attr('id');
                //Find the form
                if($(value).length > 0 && !$(value).hasClass('calendar-filter')){
                    if(typeof $.fn.Global.SAVE_COMPONENTS[key] === 'undefined'){
                        $.fn.Global.SAVE_COMPONENTS[key] = {};
                        $.fn.Global.SAVE_COMPONENTS[key].componentId = key;
                        $.fn.Global.SAVE_COMPONENTS[key].selector = key;
                    }

                    var dataArray = $(value).closest('form').serializeArray();
                    formData = createNiceFormObject(dataArray); 
                    $.fn.Global.SAVE_COMPONENTS[key].form = formData;
                }
            }); 

            //Save each MEDIA ITEM to database
            for(var key in $.fn.Global.SAVE_COMPONENTS) {
                //Check if the key is inside the delete array
                $.each($.fn.Global.DELETE_COMPONENTS, function(ind, item) {
                    if(key === item[1]){
                        $.fn.Global.SAVE_COMPONENTS[key].delete = 'true';
                    }
                });

                //EXTEND object item
                $.fn.Global.SAVE_COMPONENTS[key] = setObjectItems($.fn.Global.SAVE_COMPONENTS, key);
            }

            //Check if both the image and text are empty if so remove the media
            var total_media_blocks = $('.media').not('.add-item').length,
                index_key,
                media_id;

            if(typeof $.fn.Global.SAVE_COMPONENTS['component-mediaitems-0'] === 'undefined'){
                addDefaultMediaObject($.fn.Global.SAVE_COMPONENTS);       
            }    

            $('.media').not('.add-item').each(function( index ) {
                if(total_media_blocks > 1){
                    index_key = $(this).attr('id');
                    media_id = $(this).attr('data-media');
                }else if(total_media_blocks == 1){
                    var index_key = $(this).attr('id'),
                        media_id = $(this).attr('data-media');
                    setObjectItems($.fn.Global.SAVE_COMPONENTS, index_key);
                }else{
                    addDefaultMediaObject($.fn.Global.SAVE_COMPONENTS);
                }    

                //Check if the items must be removed
                if(total_media_blocks > 1){
                    if((typeof dropZoneObjects[index_key] === 'undefined' && 
                        typeof $.fn.Global.SAVE_COMPONENTS[index_key] === 'undefined' && 
                        typeof media_id != 'undefined' && 
                        media_id != '') ||
                        (typeof $.fn.Global.SAVE_COMPONENTS[index_key] === 'undefined' ||
                          $.fn.Global.SAVE_COMPONENTS[index_key].path == '' &&
                          $.fn.Global.SAVE_COMPONENTS[index_key].randomname == '' &&
                          typeof $.fn.Global.SAVE_COMPONENTS[index_key].content === 'undefined') ||
                        ($.fn.Global.SAVE_COMPONENTS[index_key].path == '' &&
                          $.fn.Global.SAVE_COMPONENTS[index_key].video == '')){
                            var remove_array = [];
                            if(typeof $.fn.Global.SAVE_COMPONENTS[index_key] != 'undefined')
                                $.fn.Global.SAVE_COMPONENTS[index_key].delete = 'true';

                            remove_array.push($(this).attr('data-media'));
                            remove_array.push(index_key);

                            $.fn.Global.DELETE_COMPONENTS.push(remove_array);
                    }else{
                        if($.fn.Global.SAVE_COMPONENTS[index_key].delete != '' && typeof $.fn.Global.SAVE_COMPONENTS[index_key].delete != 'undefined'){
                            delete $.fn.Global.SAVE_COMPONENTS[index_key].delete;
                        }
                    }
                }    
            });

            //SAVE the component
            if(objectLength($.fn.Global.SAVE_COMPONENTS) > 0){
                saveMediaComponents($.fn.Global.SAVE_COMPONENTS, object);

                //Remove components if the file is empty
                if($.fn.Global.DELETE_COMPONENTS.length > 0){
                    deleteComponents();
                }

                //Remove images
                if($.fn.Global.DELETE_IMAGES.length > 0){
                    deleteImages();
                }

                //Remove agenda items
                if($.fn.Global.DELETE_AGENDA_ITEMS.length > 0){
                    deleteAgendaItems();
                }
            }
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
         * Delete AGENDA item
         * TAG: AGENDAHANDLER
         */
        $(document).on('click','.js-delete-agenda-item',function(){
            //Set the delete attribute to true
            $('#js-filter-input').attr('data-delete','true');
            $('#js-filter-input').attr('data-changed','true');

            //Trigger the normal handling
            $('.js-add-agenda-item').trigger('click');
        });
            
        /**
         * Form handeling when the user wants to save the agenda item
         * TAG: AGENDAHANDLER
         */
        $(document).on('click','.js-add-agenda-item',function(){
            // Get the form data
            var dataArray = $('#js-modal-create-agenda-items').serializeArray(),
                searchable = $('#js-filter-input').attr('data-searchable'),
                newEventId = $('#js-filter-input').attr('data-neweventid'),
                deleteItem = $('#js-filter-input').attr('data-delete'),
                removeItem = $('#js-filter-input').attr('data-remove','true'),
                agendaId = $('#js-filter-input').attr('data-agendaid'),
                eventId = $('#js-filter-input').attr('data-eventid'),
                newItem = $('#js-filter-input').attr('data-new'),
                updateItem = $('#js-filter-input').attr('data-update'),
                status = $('#js-filter-input').attr('data-status'),
                changed = $('#js-filter-input').attr('data-changed'),
                eventIdObject = {},
                searchObject = {},
                newEventObject = {},
                deleteObject = {},
                newObject = {},
                updateObject = {},
                statusObject = {},
                agendaidObject = {},
                updateAgendaObject = {},
                countObject = {};

            newObject['name'] = 'new';
            newObject['value'] = newItem; 

            updateObject['name'] = 'update';
            updateObject['value'] = updateItem; 

            eventIdObject['name'] = 'eventid';
            eventIdObject['value'] = eventId;

            searchObject['name'] = 'searchable';
            statusObject['name'] = 'status';

            if(typeof deleteItem != 'undefined' && deleteItem != ''){
                deleteObject['name'] = 'delete';
                deleteObject['value'] = deleteItem;
            }

            if(typeof searchable != 'undefined'){
                searchObject['value'] = searchable;
            }else if(eventId != ''){
                searchObject['value'] = '1';
            }else{
                searchObject['value'] = '0';
            }

            if(typeof newEventId != 'undefined'){
                newEventObject['name'] = 'neweventid';
                newEventObject['value'] = newEventId;
            }

            if(searchable != 1){
                searchObject['value'] = searchable;
            }else{
                searchObject['value'] = '1';
            }

            countObject['name'] = 'count';
            countObject['value'] = objectLength($.fn.locations_object)+1;

            agendaidObject['name'] = 'id';
            agendaidObject['value'] = agendaId;

            $.each($('input[data-dp="true"]'), function(key, value) {
                updateAgendaObject['name'] = 'updateagenda';
                updateAgendaObject['value'] = $(value).attr('data-update');
                return false;
            });

            //Set status for update/update-agenda-only/delete/new
            statusObject['value'] = '';

            if(changed == 'true'){
                if(deleteItem == 'true'){
                    newObject['value'] = 'false'; 
                    statusObject['value'] = 'delete';
                }else if(updateItem == 'true'){
                    statusObject['value'] = 'update';
                }else if(updateAgendaObject['value'] == 'true' && searchable == '1'){
                    statusObject['value'] = 'update-agenda-only';
                } 
            }

            dataArray.push(eventIdObject,searchObject,countObject,statusObject,updateAgendaObject,agendaidObject,deleteObject,newObject,updateObject,newEventObject);

            var validateData = createValidateObject(dataArray);

            //Check form inputs
            validateForm(validateData,dataArray);
        });
    });
</script>