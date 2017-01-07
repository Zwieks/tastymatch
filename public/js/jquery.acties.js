
// iNav options
jQuery(document).iNav({
	// @TODO: Optional settings here, see defaults in '/js/jquery.inav.js'
});

// Init function (scroll offset, minimum viewport width)
var tiny_header_scroll_offset = 200,
	tiny_header_min_screen_width = 1024,
	$doc = jQuery(document),
	$window = jQuery(window);

setHeader(tiny_header_scroll_offset, tiny_header_min_screen_width);

jQuery(document).ready(function($){
	$doc.on('click', function(e){
		var $search_box = $('#js-page-searchbox, #js-ajax-search-results'),
			$search_bar = $('#search-bar'),
			$autocomplete = $('#js-googemap-filter, #js-autocomplete-results'),
			$autocomplete_bar = $('#js-filter-input');

		// Close when clicked outside search container
		if( !$search_box.is(e.target) && $search_box.has(e.target).length === 0){
			$('html').removeClass('open-search');
		}

		// Close when clicked outside autocomplete container
		if( !$autocomplete.is(e.target) && $autocomplete.has(e.target).length === 0){
			$('html').removeClass('open-autocomplete');
		}

		// Show search when there is a click on the searchbar
		if( $search_bar.is(e.target)){
			if($search_bar.val() != '') {
				$('html').addClass('open-search');
			}
		}

		// Show search when there is a click on the autocomplete bar
		if( $autocomplete_bar.is(e.target)){
			if($autocomplete_bar.val() != ''){
				$('html').addClass('open-autocomplete');
			}
		}

	}).on('keyup', function(e){
		// Close with escape button
		if(e.keyCode === 27){
			$('html').removeClass('open-search, open-autocomplete');
		}
	});

	//SAVE ALL THE CUSTOM TEMPLATE CONTENT
	$('.js-save-template').on('click', function(e){

		//Contains all the TinyMce changes
		var save_components = [];

		//Get the TINYMCE and put the changed components in the object
		for (var i = 0; i < tinymce.editors.length; i++)
		{
			//Get the content of the changed TINYMCE component
			var content = TinyMceSave(tinymce.editors[i].id);

			if(typeof content != 'undefined'){
				save_components[content.componentId] = content;
			}
		}

		//Get the DROPZONE files en put them in the object
		for(var key in dropZoneObjects) {
			// Merge save_components into dropZoneObjects, recursively
			if(key in save_components){
				$.extend( true, dropZoneObjects, save_components);
			}

			save_components = dropZoneObjects;

			//Upload the image
			dropZoneObjects[key].file.processQueue();
		}

		//Save each component to database
		for(var key in save_components) {
			//Find the table name	
			var arr = save_components[key].componentId.split('-');
			//Put table name in object
			save_components[key].table = arr[1];
			

        	//saveMediaComponent(save_components[key]);
        }	

		console.log(save_components);
	});

	//Add media item to template
	$('#js_add_mediaitem').on('click', function(){
		addMediaItem();
	});	

	//Remove media item from template
	$(document).on('click','.js-remove-mediaitem',function(){
		removeMediaItem($(this));
	});	

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

	function removeMediaItem(object){
		object.parent().fadeOut( 0, function() {
		    object.parent().remove();
		});
	}

	function addMediaItem() {

        var formData = {
            count: ($('#js-editable-wrapper .editable-wrapper').children().length)+1,
        };
		var token = $('meta[name="csrf-token"]').attr('content'),
			url = '/ajax/addMediaItem',
			count = 'test';

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

	                    this.on("addedfile", function(file) { 
	                        var id = file.previewTemplate.previousSibling.parentElement.id;
	                        count = objectLength(dropZoneObjects)+1;

	                        myObject.num = count;
	                        myObject.id = id;
	                        myObject.name = file.name;
	                        myObject.file = $.fn.myDropzoneThethird;

	                        dropZoneObjects['component-media-'+count] = myObject;
	                    });

	                    this.on("success", function(file, response){
	                        myObject.path = jQuery.parseJSON(response);  
	                        dropZoneObjects['component-media-'+count] = myObject;
	                    });

	                    this.on("removedfile", function(file) { 
	                        removeItem(file.name);
	                    });
	                }
	            }
	        );

	        tinymce.init({
	        	setup:function(ed) {
                	var placeholderText = 'asdf';
                	ContentCheck.setupVideo(ed,placeholderText);
	            }, 
	            selector: mce_video_id,
	            menubar:false,
	            inline: true,
	            plugins: " media",
	            toolbar: [
	                'undo redo media'
	            ]
	        });

	        tinymce.init({
	        	setup:function(ed) {
	                var placeholderText = 'asdfasdf',
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
});

jQuery(window).on('load', function(){

	// Remove class when Javascript is loaded
	jQuery('body').removeClass('preload');

	// Load the Custom Scrollbars
	if($('#js-ajax-search-results').length) {
		$("#js-ajax-search-results").mCustomScrollbar({
			theme:"light-3"
		});
	}

	// Init Google Analytics tracker
	jQuery(window).analyticsTracker();

}).on('resize scroll', function(){

	// Calculate header on resize and scroll
	setHeader(tiny_header_scroll_offset, tiny_header_min_screen_width);

});