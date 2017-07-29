$(document).ready(function() {
$('#username').typeahead({
	
	ajax:{
		url : path+'admin/waitlisted/search-name',
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

$('#email').typeahead({
	
	ajax:{
		url : path+'admin/waitlisted/search-email',
		loadingClass:'loading',
		preDispatch: function (query) {
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			return {
			search: query,
			_token:CSRF_TOKEN
			}
		},
		method :'post',
		displayField: "email"
	},
	items:40,
	scrollBar:true
});

$('#approved_username').typeahead({
	
	ajax:{
		url : path+'admin/approved/search-name',
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

$('#approved_useremail').typeahead({
	
	ajax:{
		url : path+'admin/approved/search-email',
		loadingClass:'loading',
		preDispatch: function (query) {
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			return {
			search: query,
			_token:CSRF_TOKEN
			}
		},
		method :'post',
		displayField: "email"
	},
	items:40,
	scrollBar:true
});
	  
});
