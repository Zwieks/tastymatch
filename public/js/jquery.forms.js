function getKvkApi(object){
	if(typeof(object) == "undefined" && object == null){
		object = jQuery('#js-kvkapi');
	}

	jQuery("#js-kvkinfo-wrapper").html("");
	jQuery('.api-error').hide();

	jQuery.ajax({
		url: '/getRequestKvkDetails',
		data: { "value": object.val() },
		type: 'get',
		dataType: 'json',
		success: function(data){
			if(data.success != false){
				jQuery('#js-kvkinfo-wrapper').append(data.html);
			}else{
				jQuery('.api-error').show();
			}
		}
	});
}

$(document).bind("contextmenu",function(e) {
	e.preventDefault();
});

jQuery(document).on('change', '#js-kvkapi', function($) {
	var object = jQuery(this);
	getKvkApi(object);
});


//Check if the commercial api is visible
jQuery("form[name=general-registration]").submit(function(){
	var type = jQuery('.typechange:checked').val();

	if(type == 'commercial' && jQuery('.detail-summary').is(":visible") == false){

		jQuery('.api-error').show();
		return false;
	}
});

jQuery(document).ready(function($){
	if(jQuery('form[name=general-registration]').length){
		var type = jQuery('.typechange:checked').val();

		if(type == 'commercial'){
			jQuery("#js-typechange").css({'display':'block'});
			getKvkApi();
		}
	}
});

jQuery(document).on('change', '.typechange', function($) {
	var value = jQuery(this).val();

	if(value == 2){
		jQuery('#js-typechange').fadeIn();
	}else{
		jQuery('#js-typechange').fadeOut();
	}
});