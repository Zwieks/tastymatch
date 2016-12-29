<script type="text/javascript">
    Dropzone.autoDiscover = false;
    var dropZoneObjects = [];

    //Remove item from upload list in array
    function removeItem(name){
        for (var i = 0; i < dropZoneObjects.length; i++){
            if(dropZoneObjects[i].name == name){
               dropZoneObjects.splice(dropZoneObjects[i-1], 1);
            }
        }   
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

                    this.on("maxfilesexceeded", function(file) {
                        this.removeAllFiles();
                        this.addFile(file);
                    });

                    this.on("addedfile", function(file) { 
                        var id = file.previewTemplate.previousSibling.parentElement.id;
                        count = dropZoneObjects.length;

                        dropZoneObjects.push({
                            num:count,
                            id:id, 
                            name:file.name,
                            file:$.fn.myDropzoneTheFirst
                        });
                    });

                    this.on("success", function(file, response){
                        dropZoneObjects[count].path = jQuery.parseJSON(response);  
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

                    this.on("maxfilesexceeded", function(file) {
                        this.removeAllFiles();
                        this.addFile(file);
                    });

                    this.on("addedfile", function(file) {
                        var id = file.previewTemplate.previousSibling.parentElement.id;
                        count = dropZoneObjects.length;

                        dropZoneObjects.push({ 
                            num:count,
                            id:id, 
                            name:file.name,
                            file:$.fn.myDropzoneTheSecond
                        });
                    });

                    this.on("success", function(file, response){
                        dropZoneObjects[count].path = jQuery.parseJSON(response);  
                    });

                    this.on("removedfile", function(file) { 
                        removeItem(file.name);
                    });
                }
            }
        );
    });
</script>