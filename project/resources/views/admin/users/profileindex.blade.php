@extends('admin.layout')
@section('title')
	Profile Text
@endsection
@section('content')
<h3 class="page-title">
Profile Text
</h3><br>
<!-- BEGIN PAGE CONTENT-->
@include('flash::message')
<div class="row">
	<div class="col-md-12">
		
		<!-- Begin: life time stats -->
		<div class="portlet">
			<div class="portlet-body">
				<div class="table-container">
					
					<input type="hidden" name="action" value="profiletext/list-all-profile"/>
					
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
							 Profile Text
						</th>
						
						<th width="15%">
							Email
						</th>
						<th width="15%">
							Post Date
						</th>
						<th width="10%">
							Action(Approve,Ban)
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
						</td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="email" id="email" autocomplete="off">
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
			<!-- END PAGE CONTENT-->
@endsection
@section('js')
<script>
jQuery(document).ready(function() {
   $(document).on('click','#change-common-status', function(){
		var $this = $(this);
		var table = $this.data('table');
		var token = $('meta[name=csrf-token]').attr("content");
		var id = $this.data('id');
		var status = $this.data('status');
		var action = $this.data('action');
		var addU = "<?php echo getenv('adminurl') ?>";
		 bootbox.confirm('Are Sure you want to '+(status == true ? "Ban" : "Unban")+' User?', function (result) {
            if (result) {
                $.ajax({
						url: path+addU+'/profiletext/change-status',
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
							else
							{
								alert('sdxcbnc');
								showErrorMessage('Something went wrong!!');
								TableAjax.refresh();	
							}
						},
						error : function(xhr, ajaxOptions, thrownError) {
							showErrorMessage('Something went wrong!!');
							TableAjax.refresh();	
						}
					});
            }
        });
	});

   	$(document).on('click','#change-profiletext-status', function(){
		var $this = $(this);
		var table = $this.data('table');
		var token = $('meta[name=csrf-token]').attr("content");
		var id = $this.data('id');
		var status = $this.data('profilestatus');
		alert(status);
		var action = $this.data('action');
		var addU = "<?php echo getenv('adminurl') ?>";
		 bootbox.confirm('Are Sure you want to '+(status == true ? "Approve" : "approve")+' User?', function (result) {
            if (result) {
                $.ajax({
						url: path+addU+'/profiletext/change-text',
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
								showSuccessMessage('Profile Text has been Approved Successfully');
								TableAjax.refresh();
							} else if (json.exception_message) {
								showErrorMessage('Something went wrong!!');
								TableAjax.refresh();
							}
							else
							{
								showErrorMessage('Something went wrong!!');
								TableAjax.refresh();	
							}
						},
						error : function(xhr, ajaxOptions, thrownError) {
							showErrorMessage('Something went wrong!!');
							TableAjax.refresh();	
						}
					});
            }
        });
	});
 
	TableAjax.init();
	TableAjax.update();
});
</script>
<script src="{{ asset('js/profiletext.js') }}"></script>
@endsection


