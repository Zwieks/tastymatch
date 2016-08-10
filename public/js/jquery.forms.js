jQuery(document).on('change', '#js-kvkapi', function($) {
	jQuery("#js-kvkinfo-wrapper").html("");
	jQuery('.api-error').hide();

	jQuery.ajax({
		url: '/getRequestKvkDetails',
		data: { "value": jQuery(this).val() },
		type: 'get',
		dataType: 'json',
		success: function(data){
			var response = jQuery.parseJSON(data);
			if(response.totalItemCount != 0 && response != false){
				var handelsnaam = response._embedded['rechtspersoon'][0]['handelsnaam'];
				var straat = response._embedded['rechtspersoon'][0]['straat'];
				var huisnummer = response._embedded['rechtspersoon'][0]['huisnummer'];
				var huisnummertoevoeging = response._embedded['rechtspersoon'][0]['huisnummertoevoeging'];

				if(huisnummertoevoeging != '' && typeof huisnummertoevoegings !== "undefined"){
					huisnummer = huisnummer+response._embedded['rechtspersoon'][0]['huisnummertoevoeging'];
				}

				var postcode = response._embedded['rechtspersoon'][0]['postcode'];
				var plaats = response._embedded['rechtspersoon'][0]['plaats'];

				var html = "<ul class='detail-summary'><li><input type='hidden' value='"+handelsnaam+"' name='tradename' readonly='readonly'/><input type='text' value='"+handelsnaam+"' name='tradename-dummy' readonly='readonly'/></li><li><input type='hidden' value='"+straat+" "+huisnummer+"'  name='streetnumber' readonly='readonly'/><input type='text' value='"+straat+" "+huisnummer+"'  name='streetnumber-dummy' readonly='readonly'/></li><li><input type='hidden' value='"+postcode+"' name='zip' readonly='readonly'/></li><input type='text' value='"+postcode+"' name='zip-dummy' readonly='readonly'/></li><li><input type='hidden' value='"+plaats+"' name='city' readonly='readonly'/><input type='text' value='"+plaats+"' name='city-dummy' readonly='readonly'/></li></ul>";
			}else{
				jQuery('.api-error').show();
			}

			jQuery("#js-kvkinfo-wrapper").append(html);
		}
	});
});


//Check if the commercial api is visible
jQuery("form[name=general-registration]").submit(function(){
	var type = jQuery('.typechange:checked').val();

	if(type == 'commercial' && jQuery('.detail-summary').is(":visible") == false){

		jQuery('.api-error').show();
		return false;
	}
});

jQuery(document).on('change', '.typechange', function($) {
	var value = jQuery(this).val();

	if(value == 'commercial'){
		jQuery('#js-typechange').fadeIn();
	}else{
		jQuery('#js-typechange').fadeOut();
	}
});