<?php $__env->startSection('title'); ?>
	Approved	
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('content'); ?>
<h3 class="page-title">
	Approved Employees
</h3><br>
<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo e(url( 'admin/dashboard')); ?>">Dashboard</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo e(url( 'admin/list-approvedemployee' )); ?>"> Approved Employees</a>
			
		</li>
	</ul>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="row">
		<div class="col-md-12">
			<!-- Begin: life time stats -->
			<div class="portlet">
				<div class="portlet-body">
					<div class="table-container">
						<input type="hidden" name="action" value="filter-jobseekerapproved"/>
						<div class="table-custom table-responsive">
						<table class="table table-striped table-bordered table-hover" id="datatable_ajax_for_approved_jokseeker">
							<thead>
							<tr role="row" class="heading">
								<th width="5%">S.No.</th>
								<th width="15%">Profile Pic</th>
								<th width="15%">Name</th>
								<th width="15%">Email</th>
								<th width="10%">Mobile Number</th>
								<th width="10%">Rating</th>
								<th width="15%">Status</th>
								<th width="15%">Action</th>
							</tr>
							<tr role="row" class="filter">
								<td></td>
								<td></td>
								<td><input type="text" class="form-control form-filter input-sm" name="first_name" id="skillname" autocomplete="off"/></td>
								<td><input type="text" class="form-control form-filter input-sm" name="email" autocomplete="off"/></td>
								<td><input type="text" class="form-control form-filter input-sm" name="phone_num" autocomplete="off"/></td>
								<td class="star-color"></td>
								<td><?php echo e(Form::select('status', array(''=>'--select--','1' => 'Active', '0' => 'Inactive' ),null,['class' => 'form-control form-filter input-sm'])); ?></td>
								<td>
									<button style="display:none;" class="btn btn-sm yellow filter-submit margin-bottom"></button>
									<button title="Reset" class="btn btn-sm red filter-cancel">Reset</button>	
								</td>
							</tr>
							</thead>
						</table>
						</div>
					</div>
				</div>
			</div>
		</div><!-- End: life time stats -->
	</div><!-- END PAGE CONTENT-->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset( 'public/admin/js/mwapprovedjobseeker.js')); ?>"></script>
<script>
jQuery(document).ready(function() {
 
 /***********user ajax view *******/

	/*$(document).on( "click", ".proved-improved", function () {
        var id = $(this).attr('data-id');
        var pendingstatus= $(this).attr('pending-status');
        var token ="<?php echo e(csrf_token()); ?>";

        bootbox.confirm("Are you sure you want to improve?", function (result) {
            if (result) {
	         	$.ajax({
	         		url: path+'admin/improve-disimprove-user/'+id,
	         		type: "POST",
	         		 data: {id: id,_token:token, pendingstatus: pendingstatus },
	         		success  : function(data) {
						if( data.success == true ){
							window.location = path+'admin/list-jobwaitlists';
						}
						if( data.success == false ){
							window.location = path+'admin/list-jobwaitlists';
						}
					},
	         	});
            }
        });
    });*/

   /** Change Ststus **/
   $(document).on('click','#change-common-status', function(){
		var $this = $(this);
		var table = $this.data('table');
		var token = $('meta[name=csrf-token]').attr("content");
		var id = $this.data('id');
		var status = $this.data('status');
		var action = $this.data('action');
		bootbox.confirm('Are you sure you want to change the status to '+(status == true ? "Inactive" : "Active")+' ?', function (result) {
            if (result) {
                $.ajax({
					url: path+'admin/change-status',
					data : $this.closest('form').serialize()+'&id='+id+'&table='+table+'&status='+status+'&action='+action+'&_token='+token,
					dataType: 'json',
					type: 'post',
					beforeSend: function(){
						$this.html('<i class="fa fa-spin fa-spinner"></i>');
					},
					success: function(json){
						if ( json.success ) {
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>