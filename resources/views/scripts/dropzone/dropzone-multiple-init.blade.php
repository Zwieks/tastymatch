//INIT FOR MEDIA ITEMS
@forelse ($page_content['getMediaItems'] as $item)
    var drop_id = 'DropzoneElementId'+{!! $loop->index !!},
        mce_id = '#tinyMceElementId0'+{!! $loop->index !!},
        mce_video_id = '#tinyMceVideoElementId'+{!! $loop->index !!},
        component_id = '{!! $item->component_mediaitem_id !!}';

    if(component_id != ''){
        $('#component-mediaitems-'+{!! $loop->index !!}).attr( "data-media", component_id );
    }
    
    $.fn.myDropzone{!! $loop->index !!} = new Dropzone(
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
                    count = objectLength(dropZoneObjects)-1;

                    //Add the image to the delete array on change
                    if(typeof myObject.file != 'undefined'){
                        var object_key = myObject.elementid,
                            media_id = myObject.mediaid,
                            remove_array = [];

                        remove_array.push('/app/public/uploads/'+'{{ Session::get('user.global.id') }}/'+myObject.name);
                        remove_array.push(object_key);
                        remove_array.push(media_id);

                        //Add the image to a global variable
                        $.fn.Global.DELETE_IMAGES.push(remove_array);

                        //Add the update class on the parent media element
                        var parent_object = $('#'+id).closest('.media');
                        if(parent_object.attr('data-media') != ''){
                            parent_object.attr('data-status','updated');
                        } 
                    }

                    myObject.num = count;
                    myObject.id = id;
                    myObject.name = file.name;
                    myObject.file = $.fn.myDropzone{!! $loop->index !!};
                    myObject.randomname = '{!! str_random(30) !!}'+'.'+file.type.split('/').pop();

                    dropZoneObjects['component-mediaitems-'+{!! $loop->index !!}] = myObject;
                });

                this.on("success", function(file, response){
                    dropZoneObjects['component-mediaitems-'+{!! $loop->index !!}] = myObject;
                    dropZoneObjects['component-mediaitems-'+{!! $loop->index !!}].name =  myObject.randomname;
                });

                this.on("removedfile", function(file) { 
                    removeItemTest(file, myObject);
                    console.log('hallo daar');
                    myObject.file = '';
                    myObject.path = '';
                    myObject.name = '';
                    myObject.randomname = '';
                });

                this.on("drop", function(file) {
                    if (this.files.length > 1) {
                        this.emit("removedfile", mockFile);
                    }else{
                        this.emit("removedfile", mockFile);
                    }
                });

                //Check there is already an image uploaded
                @if(isset($page_content['getMediaItems'][$loop->index]->image) && $page_content['getMediaItems'][$loop->index]->image != '')
                    var path =  '{!! asset('storage/app/public/'.$page_content['getMediaItems'][$loop->index]->image) !!}',
                        component_image = '{!! $item->image !!}',
                        image_name = component_image.split('/').pop(),
                        image_ext = component_image.split('.').pop();

                    myObject.path = component_image;
                @endif

                if(typeof path != 'undefined' && path != ''){
                    var mockFile = { name: image_name, type: 'image/'+image_ext };
                    this.emit("addedfile", mockFile);
                    myObject.randomname = path.split('/').pop();
                    this.createThumbnailFromUrl(mockFile, path);
                }
            }
        }
    );
@empty
    console.log('empty');
@endforelse    