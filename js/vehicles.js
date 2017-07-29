$(document).ready(function() {
$('#vehicle_name').typeahead({
	
	ajax:{
		url : path+'admin/vehicles/search-name',
		loadingClass:'loading',
		preDispatch: function (query) {
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			var field = $('.typeahead').attr("name");
			return {
			search: query,
			_token:CSRF_TOKEN,
			name:field,
			}
		},
		method :'post',
		displayField: "name"
	},
	items:40,
	scrollBar:true
	//onSelect: displayResult
});

$('#vehicle_number').typeahead({
	
	ajax:{
		url : path+'admin/vehicles/search-number',
		loadingClass:'loading',
		preDispatch: function (query) {
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			return {
			search: query,
			_token:CSRF_TOKEN
			}
		},
		method :'post',
		displayField: "number"
	},
	items:40,
	scrollBar:true
});
	  
});
