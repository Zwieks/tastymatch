//INIT FOR DEFAULT EMPTY media item
var drop_id = 'DropzoneElementId0',
    mce_id = '#tinyMceElementId0',
    mce_video_id = '#tinyMceVideoElementId0';
$.fn.myDropzoneEmpty = new Dropzone(
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
                count = 0;

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
                }

                myObject.num = 0;
                myObject.id = id;
                myObject.name = file.name;
                myObject.file = $.fn.myDropzoneEmpty;
                myObject.randomname = '{!! str_random(30) !!}'+'.'+file.type.split('/').pop();

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

            this.on("drop", function(file) {
                if (this.files.length > 1) {
                    this.emit("removedfile", mockFile);
                }
            });
        }
    }
);