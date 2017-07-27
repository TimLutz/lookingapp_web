<?php $__env->startSection('css'); ?>
<link  href="<?php echo e(asset('public/employer/css/main.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
Job History
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="white_inner_sec wow fadeInUp">
<?php echo Form::open(['url'=>'employer/history-listing','id'=>'filter_form']); ?>

<div class="search_input">
		<!-- <input type="text" placeholder="Search by Job name"> -->
		<?php echo Form::text('search',null,['placeholder'=>'Search by Job name','id'=>'jobname']); ?>

		<span><i class="fa fa-search" aria-hidden="true"></i></span>
</div>

<div class="filter_reset_div pull-right">
<!-- <button>Filter</button> -->
<?php echo Form::button('Filter',['class'=>'jobsearch']); ?>

<!-- <button class="reset">Reset</button> -->
<?php echo Form::button('Reset',['class'=>'reset']); ?>

</div>
<?php echo Form::close(); ?>

</div>

<div class="table_dashboard wow fadeInUp">
 	<div class="jobdata">
 	</div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('public/employer/js/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/employer/js/loader.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/bootbox.min.js')); ?>" type="text/javascript"></script> 
 <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
		
		var url = $('#filter_form').attr('action');
		postJob(url);

		var token = $('meta[name="csrf-token"]').attr('content');
		Loader();
		$.ajax({
			type     : 'POST',
			url		:	path+'employer/employer-jobs',
			data		:	{'_token':token},
			datatype : 'json',
			success : function(data) 
			{
				RemoveLoader();
				 $("#jobname").autocomplete({
					source: data.location,
				});
			},
			error: function(data) {
				RemoveLoader();
			}
		});	
	});

	$(document).on('click', '.pagination a', function (e) 
	 {
		e.preventDefault();
		
		var url=$(this).attr('href');

		postJob(url);
	 });

	function postJob(url)
	{
		var record =  '';
		if($('.selectrecords').val()!='' && $('.selectrecords').val() != undefined)
		{
			record = $('.selectrecords').val();
		}
		var filter_data = $('#filter_form').serialize();
		Loader();
		$.ajax({
					type : 'post',
					url : url,
					data : filter_data+'&records='+record,
					dataType : 'html',
					beforesend:function(){
						Loader();
					},
					success : function(data){
						RemoveLoader();
						$('.jobdata').empty().html(data);
					},
					error : function(data,ajaxOptions, thrownError){
						RemoveLoader();

						var errors = jQuery.parseJSON(data.responseText);
						if(errors.success==false){
							new PNotify({
								type: 'error',
								title: Error,
								text: 'Something went wrong!!!'
							});
						}
						
					}
				});
	}

	$(document).on('change','.selectrecords',function(){
		var url = $('#filter_form').attr('action');
		postJob(url);
	});

	$(document).on('click','.jobsearch',function(){
		var url = $('#filter_form').attr('action');
		postJob(url);
	});

	$(document).on('click','.reset',function(){
		$('#filter_form')[0].reset();
		var url = $('#filter_form').attr('action');
		postJob(url);
	});




	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('employer.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>