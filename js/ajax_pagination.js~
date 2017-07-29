$(document).ready(function() {

		$("#filter").click(function(e)
		{
			e.preventDefault();
						var sort_field = $('#sort_field').val();
						var sort_type = $('#sort_type').val();
						var category_id = $('#category_id').val();

					if(category_id == "" && sort_field == "" && sort_type == "")
					{
						$("#sort_field_error").addClass(".form-group has-error");
						$("#sort_type_error").addClass(".form-group has-error");
						$("#cat").addClass(".form-group has-error");
						return false;
					} 
					
					if(sort_field != '' && sort_type != '')
					{
						$("#sort_field_error").removeClass(".form-group has-error");
						$("#sort_type_error").removeClass(".form-group has-error");
					}
					else if(sort_field != '')
					{
						$("#sort_type_error").addClass(".form-group has-error");
						$("#sort_field_error").removeClass(".form-group has-error");
						return false;
					}
					else if(sort_type != '')
					{
						$("#sort_field_error").addClass(".form-group has-error");
						$("#sort_type_error").removeClass(".form-group has-error");
						return false;
					}
					var action = $('input[name="action"]').val();
					search_data(action);	
				});	
	});
	
	$(document).on('click', '.pagination a', function (e) 
	 {
		e.preventDefault();
		addLoader();
		var url=$(this).attr('href');
alert(url);
		search_data(url);
	 });
	
	
	
/*
	 * to filter articles by category and status
	 * */
 	 function search_data(req_url){
		 //alert(path+'admin/'+req_url);
		//serialize filter's form and pass it in ajax request.
		var form_data = $("#filter_form").serialize();
		//send ajax request to search articles.
		 $.ajax({
			url : path+'admin/'+req_url,
			data : form_data,
			dataType : 'html',
			beforeSend : function() {
				addLoader();
				$("#sort_field_error").removeClass(".form-group has-error");
				$("#sort_type_error").removeClass(".form-group has-error");
				$("#cat").removeClass(".form-group has-error");
			},
			complete : function() {
				removeLoader();
			},
			success : function(html) {
				$('#results').html(html);
			},
			error : function(xhr, ajaxOptions, thrownError) {
										console.log(xhr);
						new PNotify({
							type: 'error',
							title: xhr.statusText,
							text: 'Something went wrong!!!'
						});
				}
		});
	}
