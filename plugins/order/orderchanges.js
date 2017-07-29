$(function() {
	$(document).on('click','.orderstatusedit', function(){ 
		var order_id = $(this).attr('data-id');
		//alert(order_id);
		var item = $(this).attr('data-item');

		var order_status = $(this).attr('data-orderstatus');
		//alert(order_id);
		var token = $('form input:hidden').attr('value');
	//	alert(token);
		//var action = $('form.form1').attr('action');
		var action = path+"admin/order/"+order_id;
		var cancelled = ''; 
		var refund = '';
		var wait = '';
		var inprocess = '';
		var delivered = '';
		var cancel = '';
		var refundd = '';

		if(order_status == '3' || order_status == '5')
		{
			cancelled = order_status;
			 
			cancel = 'selected';
		}
		else
		{
			cancelled = '5'; 
		}

		if(order_status == '4' || order_status == '6')
		{
			refund = order_status;
			refundd = 'selected';
		}
		else
		{
			refund = '6'; 
		}

		if(order_status == '0')
		{
			wait = 'selected';
		}

		if(order_status == '1')
		{
			inprocess = 'selected';
		}

		if(order_status == '2')
		{
			delivered = 'selected';
		}	

		//var table = $this.data('table');
		if(order_id != '')
		{
			var str = "<form id='add_template-"+item+"' accept-charset='UTF-8' action='"+action+"' method='POST'>"+
				"<input type='hidden' value='"+token+"' name='_token'>"+
				"<select onchange='updatestatus("+'"'+$.trim(order_id)+'",'+item+")' data-placeholder='Select...' title='' name='order_status' id='order_status-"+item+"'>"+
				"<option value=''>Select Order Status</option>"+
				"<option value='0' "+wait+">Waiting for delivery</option>"+
				"<option value='1' "+inprocess+">Inprocess</option>"+
				"<option value='2' "+delivered+">Delivered</option>"+
				"<option value='"+cancelled+"' "+cancel+">Cancelled</option>"+
				"<option value='"+refund+"' "+refundd+">Refund</option>"+
			"</select></form>";
		}
		//alert('"'+"#td-"+$.trim(order_id)+'"');
		$("#td-"+item).html(str);
	});
});	


$(function(){
	$(document).on('click','.updatecomment', function(){ 

		var formdata = $('#comment_form').serialize();
		var commnt = $('#comment').val(); 
		//alert(commnt);
		if(commnt != '')
		{
			
			$('#commentModal').modal('hide');
			addLoader();
			$.ajax({
							url: path+'admin/order/changeOrderStatus',
							data : formdata,
							dataType: 'json',
							type: 'post',
							
							complete: function(){
								
							},
							success: function(json){
								removeLoader();
								console.log(json);
							if(json.success == true)
									{
									new PNotify({
												type: 'success',
												title: 'Success',
												text: 'Record Updated successfully'
											});
											setTimeout(function(){ window.location.reload(); }, 60);
											//var action = $('input[name="action"]').val();
										//	search_data(action);	
											}
								
							},
							error : function(xhr, ajaxOptions, thrownError) {
								if(json.success == false)
									{
											new PNotify({
												type: 'error',
												title: Error,
												text: 'Something went wrong!!!'
											});
											setTimeout(function(){ window.location.reload(); }, 60);
											}
							}
						});
		}
		else
		{
			$('#msg').html('Please enter comment!');
			
			return false;
		}
	});
});

$(function(){
	$(document).on('click','.statusexit', function(){ 
		window.location.reload();
		});
});