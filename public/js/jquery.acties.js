
// iNav options
jQuery(document).iNav({
	// @TODO: Optional settings here, see defaults in '/js/jquery.inav.js'
});

// Init function (scroll offset, minimum viewport width)
var tiny_header_scroll_offset = 200,
	tiny_header_min_screen_width = 1024;
setHeader(tiny_header_scroll_offset, tiny_header_min_screen_width);

jQuery(document).ready(function($){
	// Custom project Javascript goes here

});

jQuery(window).on('load', function(){

	// Remove class when Javascript is loaded
	jQuery('body').removeClass('preload');


	// Init Kirra and Google Analytics tracker
	jQuery(window).analyticsTracker();

}).on('resize scroll', function(){

	// Calculate header on resize and scroll
	setHeader(tiny_header_scroll_offset, tiny_header_min_screen_width);

});

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

	        	var html = "<ul class='detail-summary'><li><input type='text' value='"+handelsnaam+"' name='tradename' readonly='readonly'/></li><li><input type='text' value='"+straat+" "+huisnummer+"'  name='streetnumber' readonly='readonly'/></li><li><input type='text' value='"+postcode+"' name='zip' readonly='readonly'/></li><li><input type='text' value='"+plaats+"' name='city' readonly='readonly'/></li></ul>";
  			}else{
	        	jQuery('.api-error').show();
  			}

    		jQuery("#js-kvkinfo-wrapper").append(html);
		}
	});
});