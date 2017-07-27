$(document).ready(function() {

$('#username').typeahead({
	
	ajax:{
		url : path+'admin/dashboard/search',
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
		url : path+'admin/dashboard/search-email',
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
	  
/*
$(document).on('click','.changeRole', function(){
	
		$this = $(this);
		bootbox.confirm($this.data('confirm-message'), function(result) {
			if(result){
				$.ajax({
					url : path+"admin/dashboard/change-role",
					type: 'post',
					data : {
						'id'		 : $this.data('id')
					},
					dataType : 'json',
					beforeSend : function() {
						addLoader();
					},
					complete : function() {
						removeLoader();
					},
					success : function(data) {
						window.location = data.redirect_url;
					},
					error : function(xhr, ajaxOptions, thrownError) {
												console.log(xhr);
							
								new PNotify({
									type: 'error',
									title: Error,
									text: 'Something went wrong!!!'
								});
						}
				});
			}
		});
	});
*/
	//$(document).ready(function() {
		
		/*$("#reason_form").validate({
			rules:{
					reason_to_delete:{
							required:true,
							minlength:8,
							maxlength:500
							}
				  }
		});*/
	
		
$(document).on('click','.deleteuserRecord',function(){
		$this = $(this);
		var id = $(this).attr('data-id');

	//	alert(id);
		bootbox.confirm($this.data('confirm-message'), function(result) {
			if(result){
			//	$('#reasonModal').modal('show');
			//	$('#reason').on('click', function(){
					
				//	if($("#reason_form").valid()){
						addLoader();
						var formdata = $("#deletePageForm").serialize();
						//alert(formdata+'&id='+$this.data('id'));
						//$('#reasonModal').modal('hide');
						$.ajax({
						url : path+"admin/multidelete/delete",
						type: 'post',
						data : formdata+'&id='+$this.data('id'),
						dataType : 'json',
						success : function(data) {
							removeLoader();
							//alert(data.success);
							console.log(data);
							if(data.success == true)
						 	{
						/*	new PNotify({
										type: 'success',
										title: 'Success',
										text: 'Record deleted successfully'
									});*/
									setTimeout(function(){ window.location.reload(); }, 200);
									//var action = $('input[name="action"]').val();
								//	search_data(action);	
									}
									
									if(data.success == 'sentback')
						 	{
							new PNotify({
										type: 'error',
										title: 'Error',
										text: 'This record is associated with some other table'
									});
									setTimeout(function(){ window.location.reload(); }, 200);
									//var action = $('input[name="action"]').val();
								//	search_data(action);	
									}
						},
						error : function(xhr, ajaxOptions, thrownError) {
													console.log(xhr);
								removeLoader();
								if(data.success == false)
							{
									new PNotify({
										type: 'error',
										title: Error,
										text: 'Something went wrong!!!'
									});
									}
									setTimeout(function(){ window.location.reload(); }, 200);
							}
					});
						
						
					//}
					
			//	});
			}
			//else
			//{
				//alert("hgih");
			//}
		});
	});


$(document).on('click','.deletebookRecord',function(){
		$this = $(this);
		var id = $(this).attr('data-id');

	//	alert(id);
		bootbox.confirm($this.data('confirm-message'), function(result) {
			if(result){
			//	$('#reasonModal').modal('show');
			//	$('#reason').on('click', function(){
					
				//	if($("#reason_form").valid()){
						addLoader();
						var formdata = $("#deleteBookForm").serialize();
						//$('#reasonModal').modal('hide');
						$.ajax({
						url : path+"admin/multidelete/bookeddelete",
						type: 'post',
						data : formdata+'&id='+$this.data('id'),
						dataType : 'json',
						success : function(data) {
							removeLoader();
							//alert(data.success);
							if(data.success == true)
							{
							new PNotify({
										type: 'success',
										title: 'Success',
										text: 'Record deleted successfully'
									});
								setTimeout(function(){ window.location.reload(); }, 1200);
									//var action = $('input[name="action"]').val();
								//	search_data(action);	
									}
						},
						error : function(xhr, ajaxOptions, thrownError) {
													console.log(xhr);
								removeLoader();
							if(data.success == false)
							{
									new PNotify({
										type: 'error',
										title: Error,
										text: 'Something went wrong!!!'
									});
									setTimeout(function(){ window.location.reload(); }, 1200);
									}
							}
					});
						
						
					//}
					
			//	});
			}
		});
	});
	
	
	

$(document).on('click','#multiple_record',function(){
	
addLoader();
					var formData = {
							table : $('input[name=table_name]').val(),
							id : $('input[name=record_id]').val(),
							_token : $('meta[name="csrf-token"]').attr('content')
						}
						$.ajax({
							type     : 'POST',
							url      : path+'admin/multidelete/delete',
							data     : formData,
							datatype : 'json',
							success  : function(data) {
								removeLoader();
								if(data.success == true)
								{
									
									new PNotify({
										type: 'success',
										title: 'Success',
										text: 'Record deleted successfully'
									});
									
									var action = $('input[name="action"]').val();
									
									search_data(action);	
								}
							},
							error: function(data) {
							
								removeLoader();
								if(data.success == false)
							{
									new PNotify({
										type: 'error',
										title: Error,
										text: 'Something went wrong!!!'
									});
									}
								 
							}

						});
});	
//});

	
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
				$('#results').empty().html(html);
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
	
$(document).on('click','.deletequoteRecord',function(){
		$this = $(this);
		var id = $(this).attr('data-id');
		var type = $(this).attr('data-type');
	//	alert(id);
		bootbox.confirm($this.data('confirm-message'), function(result) {
			if(result){
			//	$('#reasonModal').modal('show');
			//	$('#reason').on('click', function(){
					
				//	if($("#reason_form").valid()){
						addLoader();
						var formdata = $("#deleteQuoteForm").serialize();
						//$('#reasonModal').modal('hide');
						$.ajax({
						url : path+"admin/multidelete/quotedelete",
						type: 'post',
						data : formdata+'&id='+$this.data('id')+'&type='+$this.data('type'),
						dataType : 'json',
						success : function(data) {
							removeLoader();
							//alert(data.success);
							if(data.success == true)
							{
							new PNotify({
										type: 'success',
										title: 'Success',
										text: 'Record deleted successfully'
									});
									setTimeout(function(){ window.location.reload(); }, 500);
									//var action = $('input[name="action"]').val();
								//	search_data(action);	
									}
						},
						error : function(xhr, ajaxOptions, thrownError) {
													console.log(xhr);
								removeLoader();
								if(data.success == false)
							{
									new PNotify({
										type: 'error',
										title: Error,
										text: 'Something went wrong!!!'
									});
									}
									setTimeout(function(){ window.location.reload(); }, 500);
							}
					});
						
						
					//}
					
			//	});
			}
		});
	});	



