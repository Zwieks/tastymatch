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