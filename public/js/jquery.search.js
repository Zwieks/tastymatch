//Searchbar AJAX request and normal handling
jQuery('#search-bar').on('keyup', function(e){
	e.preventDefault();
	ajaxSearch($(this).val());
});

//Search using Ajax
function ajaxSearch($search_input) {

	var token = $('meta[name="csrf-token"]').attr('content'),
		url = '/ajax/search',
		data = {q: $search_input};

	$.ajax({
		type: 'POST',
		url: url,
		headers: {'X-CSRF-TOKEN': token},
		data: data,
		datatype: 'JSON',
		success: function (data) {
			if(data.success == true) {
				//Put the results in de container
				$('html').addClass('open-search');
				$('#js-ajax-search-results .mCSB_container').html(data.html);
			}
		}
	});
}

//Autocomplete GoogleMaps using Ajax
function ajaxAutocomplete($search_input) {
	var token = $('meta[name="csrf-token"]').attr('content'),
		url = '/ajax/autocomplete',
		data = {q: $search_input};

	$.ajax({
		type: 'POST',
		url: url,
		headers: {'X-CSRF-TOKEN': token},
		data: data,
		datatype: 'JSON',
		success: function (data) {
			if(data.success == true) {
				//Put the results in de container
				$('html').addClass('open-search');
				$('#js-ajax-autocomplete-results .mCSB_container').html(data.html);
			}
		}
	});
}

//Autocomplete Events using Ajax
function ajaxSearchEvents($search_input) {

	var token = $('meta[name="csrf-token"]').attr('content'),
		url = '/ajax/search',
		data = {q: $search_input};

	$.ajax({
		type: 'POST',
		url: url,
		headers: {'X-CSRF-TOKEN': token},
		data: data,
		datatype: 'JSON',
		success: function (data) {
			if(data.success == true) {
				//Put the results in de container
				$('html').addClass('open-autocomplete');

				//Check if the returned data is empty
				if(data.html != ''){
					$('#js-autocomplete-results .mCSB_container').html(data.html);
				}else{
					removeDefaultInputs();
				}

				//Remove all the foodstands and entertainers results
				$('#js-autocomplete-results .mCSB_container .items-wrapper-entertainers, #js-autocomplete-results .mCSB_container .items-wrapper-foodstands').remove();
			}
		}
	});
}

function removeDefaultInputs(){
    //Remove the ID as attribute of the object
    $("#js-filter-input").attr('data-eventid','');
    $("#js-filter-input").attr('data-neweventid','');
    //Set the data searchable back to empty
    $("#js-filter-input").attr('data-searchable','0');
    //Empty the EVENT DESCRIPTION in the textarea
    $("textarea[name='description']").val('').prop('readonly', false);
    //Empty the EVENT LOCATION in the inputfield
    $("input[name='location']").val('').prop('readonly', false);
	//Empty the EVENT TYPE in the inputfield
	$("select[name='eventtype']").prop('selectedIndex',0).attr("disabled", false);
	//Hide the autocomplete
    $('html').removeClass('open-search, open-autocomplete');
}