$(function() {
	$(document).on('click','.updateQuery', function(){
//		alert("gj");
		var $this = $(this);
		var table = $this.data('table');
		var id = $this.data('id');
		var status = $this.data('status');
		var action = $this.data('action');
		bootbox.confirm('Are you sure you want to '+(status ? "Reply" : "Unanswered")+' this query?', function(result) {
			if(result){
				$.ajax({
					url: path+'admin/contact/change-status',
					data : $this.closest('form').serialize()+'&id='+id+'&table='+table+'&status='+status+'&action='+action,
					dataType: 'json',
					type: 'post',
					beforeSend: function(){
						$this.html('<i class="fa fa-spin fa-spinner"></i>');
					},
					complete: function(){
						
					},
					success: function(json){
						console.log(json);
						if (json.success) {
							if(status){
								//alert(status);
								$this.data('status',0);
								//$this.html('<i class="fa fa-circle active"></i>');
								new PNotify({
								   type: 'success',
								   title: 'Success',
								   text: 'Status changed'
								   });
								setTimeout(function(){ window.location.reload(); }, 3000);
							}
							else{
								$this.data('status',1);
								//$this.html('<i class="fa fa-circle inactive"></i>');
								new PNotify({
								   type: 'success',
								   title: 'Success',
								   text: 'Status changed'
								   });
								setTimeout(function(){ window.location.reload(); }, 3000);
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
							setTimeout(function(){ window.location.reload(); }, 3000);
						}
					},
					error : function(xhr, ajaxOptions, thrownError) {
						
					}
				});
			}
		});
	});
});
