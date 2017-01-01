<script type="text/javascript">
    Dropzone.autoDiscover = false;
    var dropZoneObjects = [],
    componentWrapper = [];

    //Remove item from upload list in array
    function removeItem(name){
        for (var i = 0; i < dropZoneObjects.length; i++){
            if(dropZoneObjects[i].name == name){
               dropZoneObjects.splice(dropZoneObjects[i-1], 1);
            }
        }   
    }

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

    $(document).ready(function($) {

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

                    this.on("addedfile", function(file) { 
                        var id = file.previewTemplate.previousSibling.parentElement.id;
                        count = objectLength(dropZoneObjects);

                        myObject.num = count;
                        myObject.id = id;
                        myObject.name = file.name;
                        myObject.file = $.fn.myDropzoneTheFirst;

                        dropZoneObjects['component-header'] = myObject;
                    });

                    this.on("success", function(file, response){
                        myObject.path = jQuery.parseJSON(response);  
                        dropZoneObjects['component-header'] = myObject;

                        //Save each component to database
                        saveMediaComponent(myObject);
                    });

                    this.on("removedfile", function(file) { 
                        removeItem(file.name);
                    });
                }
            }
        );

        var drop_id = 'DropzoneElementId';
        $.fn.myDropzoneTheSecond = new Dropzone(
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
                        count = objectLength(dropZoneObjects);

                        myObject.num = count;
                        myObject.id = id;
                        myObject.name = file.name;
                        myObject.file = $.fn.myDropzoneTheSecond;

                        dropZoneObjects['component-media'] = myObject;
                    });

                    this.on("success", function(file, response){
                        myObject.path = jQuery.parseJSON(response);  
                        dropZoneObjects['component-media'] = myObject;

                        //Save each component to database
                        saveMediaComponent(myObject);
                    });

                    this.on("removedfile", function(file) { 
                        removeItem(file.name);
                    });
                }
            }
        );
    });
</script>