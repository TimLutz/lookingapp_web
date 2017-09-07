@extends('admin.layout')
@section('title')
	Reports Management
@endsection
@section('content')
<h3 class="page-title">
Archived Reports
</h3><br>
<!-- BEGIN PAGE CONTENT-->
@include('flash::message')
<div class="row">
	<div class="col-md-12">
		
		<!-- Begin: life time stats -->
		<div class="portlet">
			<div class="portlet-body">
				<div class="table-container">
					
					<input type="hidden" name="action" value="reports/all-archives-users"/>
					
					<table class="table table-striped table-bordered table-hover" id="datatable_ajax_for_realtor">
					<thead>
					<tr role="row" class="heading">
<!--
						<th width="2%">
							<input type="checkbox" name="selectall" class="group-checkable">
						</th>
-->
						<th width="5%">
							 SR#
						</th>
						<th width="15%">
							 Free Account
						</th>
						<th width="15%">
							 About Account
						</th>
						<th width="15%">
							Violation
						</th>
						<th width="15%">
							Date
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
								<input type="text" class="form-control form-filter input-sm" name="senderemail" id="approved_planname" autocomplete="off">
						</td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="recevieremail" id="approved_planname" autocomplete="off">
						</td>
						<td>	
							<input type="text" class="form-control form-filter input-sm" name="flag" id="approved_planname" autocomplete="off">						
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
<script src="{{ asset('js/reports.js') }}"></script>
@endsection


