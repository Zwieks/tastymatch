//INIT FOR MEDIA ITEMS
{!! $page_content['getMediaItems'] !!}
@forelse ($page_content['getMediaItems'] as $item)
    var drop_id = 'DropzoneElementId'+{!! $loop->index !!},
        component_id = '{!! $item->component_mediaitem_id !!}';

    if(component_id != ''){
        $('#component-mediaitems-'+{!! $loop->index !!}).attr( "media", component_id );
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
                    count = objectLength(dropZoneObjects);

                    //Add the image to the delete array on change
                    if(typeof myObject.file != 'undefined'){
                        //Add the image to a global variable
                        $.fn.Global.DELETE_IMAGES.push('/app/public/uploads/'+'{{ Session::get('user.global.id') }}/'+myObject.name);
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
                    removeItem(file);
                    myObject.file = '';
                    myObject.path = '';
                    myObject.name = '';
                    myObject.randomname = '';
                });

                //Check there is already an image uploaded
                @if(isset($page_content['getMediaItems'][$loop->index]->image) && $page_content['getMediaItems'][$loop->index]->image != '')
                    var path =  '{!! asset('storage/'.$page_content['getMediaItems'][$loop->index]->image) !!}',
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
    <p>No users</p>
@endforelse    