<script type="text/javascript">
    $(document).ready(function($) {
        Dropzone.autoDiscover = false;
        $("#DropzoneElementId ").dropzone({
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
        });

        $("#DropzoneElementId2").dropzone({
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
        });
    });
</script>