<script type="text/javascript">
    Dropzone.autoDiscover = false;

    $(document).ready(function($) {
        var myDropzoneTheFirst = new Dropzone(
            '#DropzoneElementId', //id of drop zone element 2
            {
                paramName: 'photos',
                url: '/ajax/upload',
                dictDefaultMessage: "{!! Lang::get('dropzone.header-image-text') !!}",
                dictRemoveFile: "",
                clickable: true,
                enqueueForUpload: true,
                maxFilesize: 1,
                maxFiles: 1,
                uploadMultiple: false,
                addRemoveLinks: true,
                parallelUploads: 1,
                thumbnailWidth: 1680,
                thumbnailHeight: 1040,
                init: function() {
                    this.on("maxfilesexceeded", function(file) {
                        this.removeAllFiles();
                        this.addFile(file);
                    });
                }
            }
        );

        var myDropzoneTheSecond = new Dropzone(
            '.dropzoneMedia', //id of drop zone element 2
            {
                paramName: 'photos',
                url: '/ajax/upload',
                dictDefaultMessage: "",
                dictRemoveFile: "",
                clickable: true,
                enqueueForUpload: true,
                maxFilesize: 1,
                maxFiles: 1,
                uploadMultiple: false,
                addRemoveLinks: true,
                parallelUploads: 1,
                thumbnailWidth: 1680,
                thumbnailHeight: 1040,
                init: function() {
                    this.on("maxfilesexceeded", function(file) {
                        this.removeAllFiles();
                        this.addFile(file);
                    });
                }
            }
        );
    });
</script>