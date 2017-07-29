$(document).ready(function() {
	
	$(".notifications-menu").click(function(){
		$('#count').html('');
	});
	
	$('.notification').click(function(){
		
		var formData = {
			id : $(this).find('input').attr('value')
		}
		formData._token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type     : 'GET',
			url      :  path+'story/notify-status',
			data     :  formData,
			datatype : 'html',
			success  : function(data) {
				console.log(data);	
			},
			error: function(data) {
				console.log(data.exception_message);
			}
			
		})
	});
});