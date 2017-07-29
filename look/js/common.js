// shows the pnotify success messages.......

//function to show success messages
function showSuccessMessage(message){
	PNotify.removeAll();
	var stack_topleft = {"dir1": "down", "dir2": "left", "push": "top"};
	new PNotify({
	   type: 'success',
	   title: 'Success',
	   text: message,
	   addclass: "stack_topleft",
	   stack: stack_topleft
	});
}

//function to show error messages
function showErrorMessage(message){
	PNotify.removeAll();
	var stack_topleft = {"dir1": "down", "dir2": "left", "push": "top"};
	new PNotify({
	   type: 'error',
	   title: 'Error',
	   text: message,
	   addclass: "stack_topleft",
	   stack: stack_topleft
	});
}

$(function() {
	$(document).on('click','.changeStatus', function(){
		var $this = $(this);
		var table = $this.data('table');
		var id = $this.data('id');
		var status = $this.data('status');
		var action = $this.data('action');
		bootbox.confirm('Are you sure you want to '+(status ? "activate" : "Inactivate")+' this status?', function(result) {
			if(result){
				addLoader();
				$.ajax({
					url: path+'admin/dashboard/change-status',
					data : $this.closest('form').serialize()+'&id='+id+'&table='+table+'&status='+status+'&action='+action,
					dataType: 'json',
					type: 'post',
					beforeSend: function(){
						$this.html('<i class="fa fa-spin fa-spinner"></i>');
					},
					complete: function(){
						
					},
					success: function(json){
						//console.log(json);
						removeLoader();
						if (json.success) {
							if(status){
								$this.data('status',0);
								$this.html('<i class="fa fa-circle active"></i>');
								new PNotify({
								   type: 'success',
								   title: 'Success',
								   text: 'Status changed'
								   });
								setTimeout(function(){ window.location.reload(); }, 500);
							}
							else{
								$this.data('status',1);
								$this.html('<i class="fa fa-circle inactive"></i>');
								new PNotify({
								   type: 'success',
								   title: 'Success',
								   text: 'Status changed'
								   });
								
								setTimeout(function(){ window.location.reload(); }, 500);
							}
						} else if (json.exception_message) {
							if(status){
								$this.html('<i class="fa fa-circle inactive"></i>');
							}
							else{
								$this.html('<i class="fa fa-circle active"></i>');
							}
							new PNotify({
								   type: 'error',
								   title: 'Error',
								   text: 'Sorry, Something went wrong!!'
								   });
						}
					},
					error : function(xhr, ajaxOptions, thrownError) {
						
					}
				});
			}
		});
	});
	
	 /* $(document).on('click','.deleteRecord', function(){
	 
		$this = $(this);
		bootbox.confirm($this.data('confirm-message'), function(result) {
			if(result){
			$.ajax({
   type     : 'GET',
   url      : path+'/admin/testimonials',
   data     : formData,
   datatype : 'html',
   success  : function(data) {
    __removeOverlay2();
    console.log(data); 
    if(data.success == false)
    {
     new PNotify({
     type: 'error',
     title: 'Error',
     text: 'Sorry, something went wrong. Please try again.'
     });
    }
    else
    {
     $('#total_donations').hide();
     $('#updated_donations').html(data);
     new PNotify({
      type: 'success',
      title: 'Success',
      text: 'Donation loaded successfully !'
      });
	  var toot_id = $this.closest('tr').find('.toot_id').text();

    }
    
   },
     
   error: function(data) {
   // Error...
   __removeOverlay2();
    var errors = data.responseJSON;
      console.log(errors);
    new PNotify({
     type: 'error',
     title: 'Error',
     text: errors.donation_type
     });
   }
   
  })
  }
  });
		
	}); 
				//$($this).closest('form').submit();
				
				//var id_toot = $this.closest('tr').find('.id_toot').val();
				//alert('span'+toot_id);
				//alert('input'+id_toot);
			// }
		//});
		
	//});  */
 


//This is to clear Filter form
$('#clear_filter').on('click',function(){
	//	alert("hi");
		$('#filter_form')[0].reset();

	//	$('#DropDownList1').val(0);
	//$("#DropDownList1").attr('selectedIndex', '-1');
	
		var action = $('input[name="action"]').val();
		//clear_data(window.location);
		clear_data(action);
		
	});


/*
This function redirect to current page

*/
 	 function clear_data(req_url){
		 
		 $.ajax({
			//url : req_url,
			url : path+'admin/'+req_url,
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



















	
	$("#delete_story_record").on('click',function(){
		addLoader();
		$('#deleteModal').modal('hide');
    var action = $('input[name=action_name]').val();
	var formData = {
        table : $('input[name=table_name]').val(),
        id : $('input[name=record_id]').val()
	}
	formData._token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		type     : 'POST',
		url      : path+'admin/'+action+'/destroy',
		data     : formData,
		datatype : 'html',
		success  : function(data) {
			removeLoader();
			if(data.success == true)
			{
				window.location = data.redirect_url;
			}
			if(data.success == false) 
			{
				window.location = data.redirect_url;
			}
		},
		error: function(data) {
			 var errors = data.responseJSON;
		}
	});
});

	$("#delete_multiple_record").on('click',function(){
		addLoader();
		$('#deleteModal').modal('hide');
	var formData = {
        table : $('input[name=table_name]').val(),
        id : $('input[name=record_id]').val(),
		action : $('input[name=action_name]').val()
	}
	formData._token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		type     : 'POST',
		url      : path+'admin/dashboard/delete-records',
		data     : formData,
		datatype : 'html',
		success  : function(data) {
			removeLoader();
			if(data.success == true)
			{
				window.location = data.redirect_url;
			}
			if(data.success == false) 
			{
				window.location = data.redirect_url;
			}
		},
		error: function(data) {
			 var errors = data.responseJSON;
		}
	});
});

});

$(document.body).on('change' , '.selectall', function(){
    $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
});

$('.records_id').on('click',function(){
        if($('.records_id:checked').length == $('.records_id').length){
            $('.selectall').prop('checked',true);
        }else{
            $('.selectall').prop('checked',false);
        }
    });
	
function deleteMultipleRecords(table,action)
{
	var searchIDs = $("input.records_id:checkbox:checked").map(function(){
        return this.value;
    }).toArray();
	if(searchIDs == "")
	{
		//$('.multi_delete').text('Please check at least one record');
		//alert('Please check at least one record');
		new PNotify({
										type: 'error',
										title: 'error',
										text: 'Please check at least one record'
									});
	
		return false;
	}
	else{
		$('#deleteModal').modal();
		$('#record_id').val(searchIDs);
		$('#table_name').val(table);
		$('#action').val(action);
	}
    
}

function changeMultipleStatus(table,action)
{
	var searchIDs = $("input.records_id:checkbox:checked").map(function(){
        return this.value;
    }).toArray();
	if(searchIDs == "")
	{
		//alert('Please check at least one record');
		new PNotify({
										type: 'error',
										title: 'error',
										text: 'Please check at least one record'
									});
		return false;
	}
	else{
		$('#statusModal').modal();
		$('#record_id').val(searchIDs);
		$('#table_name').val(table);
		$('#action').val(action);
	}
    
}

$(".change_multiple_status").on('click',function(){
	addLoader();
	$('#statusModal').modal('hide');
	var formData = {
		table : $('input[name=table_name]').val(),
		action : $('input[name=action_name]').val(),
		id : $('input[name=record_id]').val(),
		status : $(this).attr('value'),
		_token     : $('meta[name="csrf-token"]').attr('content')
	}

	$.ajax({
		type     : 'POST',
		url      : path+'admin/dashboard/change-status',
		data     : formData,
		datatype : 'json',
		success  : function(data) {
			removeLoader();
			console.log(data);
			if(data.success == true)
			{
				window.location.reload();
			}
			if(data.success == false) 
			{
				window.location = data.redirect_url;
			}
		},
		error: function(data) {
			 var errors = data.responseJSON;
		}
	});

});	
