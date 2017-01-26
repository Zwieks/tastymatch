<script type="text/javascript">
    Dropzone.autoDiscover = false;
    var dropZoneObjects = [],
    componentWrapper = [];

    //Remove item from upload list in array
    function removeItem(file){
        for (var i = 0; i < dropZoneObjects.length; i++){
            if(dropZoneObjects[i].name == file.name){
               dropZoneObjects.splice(dropZoneObjects[i-1], 1);
            }
        }   
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

    $(document).ready(function($) {
        //INIT FOR HEADERIMAGE
        var drop_id = 'DropzoneElementIdHeader';
        $.fn.myDropzoneTheFirst = new Dropzone(
            '#'+drop_id, //id of drop zone element 2
            {
                paramName: 'photos',
                url: '/ajax/upload',
                dictDefaultMessage: "{!! Lang::get('dropzone.header-image-text') !!}",
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
                        myObject.file = $.fn.myDropzoneTheFirst;
                        myObject.randomname = '{!! str_random(30) !!}'+'.'+file.type.split('/').pop();

                        dropZoneObjects['component-headerimage'] = myObject;
                    });

                    this.on("success", function(file, response){
                        dropZoneObjects['component-headerimage'] = myObject;
                        dropZoneObjects['component-headerimage'].name =  myObject.randomname;
                    });

                    this.on("removedfile", function(file) {
                        removeItem(file);
                        myObject.file = '';
                        myObject.path = '';
                        myObject.name = '';
                        myObject.randomname = '';
                    });

                    this.on("drop", function(file) {
                        if (this.files.length > 1) {
                            this.emit("removedfile", mockFile);
                        }
                    });

                    //Check there is already an image uploaded
                    @if(isset($page_content['getHeaderimage']->path) && $page_content['getHeaderimage']->path != '')
                        var path =  '{!! asset('storage/'.$page_content['getHeaderimage']->path) !!}',
                            component_image = '{!! $page_content['getHeaderimage']->path !!}',
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

        @if(isset($page_content) )
            @include('scripts.dropzone.dropzone-multiple-init',compact('page_content'));
        @else
            @include('scripts.dropzone.dropzone-single-init');
        @endif
    });
</script>