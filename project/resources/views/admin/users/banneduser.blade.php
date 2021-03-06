@extends('admin.layout')
@section('title')
	Users Management
@endsection
@section('content')
<h3 class="page-title">
Banned Users
<a href="{{ url(getenv('adminurl').'/users/genrateCsv1') }}" class="btn btn-danger pull-right">Export</a>
</h3><br>
<!-- BEGIN PAGE CONTENT-->
@include('flash::message')
<div class="row">
	<div class="col-md-12">
		
		<!-- Begin: life time stats -->
		<div class="portlet">
			<div class="portlet-body">
				<div class="table-container">
					
					<input type="hidden" name="action" value="users/list-all-banned-users"/>
					
					<table class="table table-striped table-bordered table-hover" id="datatable_ajax_for_realtor">
					<thead>
					<tr role="row" class="heading">
<!--
						<th width="2%">
							<input type="checkbox" name="selectall" class="group-checkable">
						</th>
-->
						<th width="5%">
							 S.No.
						</th>
						<th width="15%">
							 Image
						</th>
						<th width="15%">
							 Screen Name
						</th>
						<th width="15%">
							User Id
						</th>
						<th width="15%">
							Email
						</th>
						<th width="15%">
							Member Type
						</th>
						

						<th width="10%">
							Joined 
						</th>

						<th width="10%">
							Expires
						</th>
						<th width="10%">
							Profile Text
						</th>
						<th width="10%">
							Action(Ban,Unban)
						</th>

					</tr>
					<tr role="row" class="filter">
<!--
						<td></td>
-->
						<td>
								
						</td>
						<td>
								
						</td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="name" id="approved_planname" autocomplete="off">
						</td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="profile_id" id="email" autocomplete="off">
						</td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="email" id="email" autocomplete="off">
						</td>
						
						<td>					

						</td>

						<td>							
						</td>
						<td>
								
						</td>
						<td>

						</td>		
						
						<td>
						<button style="display:none;" class="btn btn-sm yellow filter-submit margin-bottom"></button>
						<button title="Reset" class="btn btn-sm red filter-cancel">Reset</button>	
						</td>
					


					</tr>
					</thead>
					<tbody>
						
					</tbody>
					</table>
					
				</div>
			</div>
		</div>
		<!-- End: life time stats -->
	</div>
</div>

@include('models.profiletext')
			<!-- END PAGE CONTENT-->
@endsection
@section('js')
<script>
jQuery(document).ready(function() {
	
	
	$(document).on("click", "#view", function () {
		
		
        /***********user ajax view *******/
        var url_for_user_view = adminname+'/users/showrealtor';

        

        var userid = $(this).attr("userid");
        var token ="{{csrf_token()}}";
        $.ajax({
            url: path+url_for_user_view,
          
            type: "POST",
            data: {id: userid,_token:token},
            dataType: "JSON",
            success: function (result) {
                
                if (result.status == 'error')
                    bootbox.alert('some problem occur try again.....');
                else
                {                   
                   console.log(result);
                   if(result.reslutset.name)
                    $('#name_user').text(result.reslutset.name);
                    else
                    $('#name_user').text('NA');
                    
                    if(result.reslutset.email)
                     $('#email_user').text(result.reslutset.email);
                     else
                     $('#email_user').text('NA');
                     
                     if(result.reslutset.phone)
                     $('#phone_user').text(result.reslutset.phone);
                      else
                     $('#phone_user').text('NA');
                     
                     if(result.reslutset.address)
                     $('#address_user').text(result.reslutset.address);
                     else
                     $('#address_user').text('NA');
                       
                   if(result.reslutset.photo)
                     $('#grey_image').html('<image src="'+path+'/'+result.reslutset.photo+ '"  alt="Image" style="height: 100px; width: 150px; display: block;"/>');
					 else
                     $('#grey_image').text('NA');
					
                   $('#myModal').modal('show');
                   
                   
                }
            }
        });
        /***********user ajax view ends here*******/

    });
	
	
	$(document).on("click", ".delete", function () {
		
		//alert('sdjfldsl');
        var deleteLink = $(this).attr('deleteLink');
        bootbox.confirm("Are you sure you want to delete?", function (result) {
            if (result) {
                window.location = deleteLink;
            }
        });
    });
	
	
	
	
   $(document).on('click','#change-common-status', function(){
		var $this = $(this);
		var table = $this.data('table');
		var token = $('meta[name=csrf-token]').attr("content");
		var id = $this.data('id');
		var status = $this.data('status');
		var action = $this.data('action');
		 bootbox.confirm('Are Sure you want to '+(status == true ? "Ban" : "Unban")+' User?', function (result) {
            if (result) {
                $.ajax({
						url: path+'common/change-status',
						data : $this.closest('form').serialize()+'&id='+id+'&table='+table+'&status='+status+'&action='+action+'&_token='+token,
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
								showSuccessMessage('Status changed');
								TableAjax.refresh();
							} else if (json.exception_message) {
								showErrorMessage('Something went wrong!!');
								TableAjax.refresh();
							}
						},
						error : function(xhr, ajaxOptions, thrownError) {
							showErrorMessage('Something went wrong!!');
						}
					});
            }
        });
	});
	
	
	
	
 
	TableAjax.init();
	TableAjax.update();
});
</script>
<script src="{{ asset('js/realtor.js') }}"></script>
@endsection


