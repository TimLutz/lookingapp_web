<?php $__env->startSection('css'); ?>
<link  href="<?php echo e(asset('public/employer/css/main.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="white_inner_sec wow fadeInUp">
<?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo Form::open(['url'=>'employer/jobdata','id'=>'filter_form']); ?>

	<?php echo Form::hidden('url','jobdata',['class'=>'url']); ?>	
	<?php echo Form::hidden('timezone',null,['id'=>'timezone']); ?>	
	<div class="search_input">
	<!-- 	<input type="text" placeholder="Search by Job name"> -->
			<?php echo Form::text('job_name',null,['placeholder'=>'Search by Job name','id'=>'jobname']); ?>

		<span><i class="fa fa-search" aria-hidden="true"></i></span>
	</div>
	<div class="category_input job_category">
		<!-- <input type="text" placeholder="Category"> -->
		
		<?php echo Form::select('category',[''=>'Category']+$category,null,['class'=>'customselect','data-jcf'=>'{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}']); ?>

	</div>
	<div class="category_input">
		<!-- <input type="text" placeholder="Status"> -->
		
		<?php echo Form::select('status',[''=>'Status',1=>'Active',2=>'Filled',3=>'Progress',4=>'Completed'],null,['class'=>'customselect','data-jcf'=>'{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}']); ?>

	</div>
	<div class="filter_reset_div">
		<button class="jobsearch" type="button">Filter</button>
		<button class="reset" type="button">Reset</button>
	</div>
	<?php echo Form::close(); ?>

</div>

	<div class="table_dashboard wow fadeInUp jobdata">
				
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('public/employer/js/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/employer/js/loader.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/bootbox.min.js')); ?>" type="text/javascript"></script> 

<script type="text/javascript">
 	 wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100,
        callback:     function(box) {
          console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
      }
    );
    wow.init();
	$(document).ready(function(){
		
		var url = $('#filter_form').attr('action');
		postJob(url);
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
					type : 'get',
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

	$(document).on('click','.jobsearch',function(){
		var url = $('#filter_form').attr('action');
		postJob(url);
	});
	$(document).on('change','.selectrecords',function(){
		var url = $('#filter_form').attr('action');
		postJob(url);
	});


	$(document).on('change','#jobrating',function(){
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		Loader();
		$.ajax({

				type : 'post',
				url : $('.rating').attr('action'),
				data : 'value='+$(this).data('jobvalue')+'&rating='+$(this).val()+'&_token='+CSRF_TOKEN,
				dataType : 'html',
				beforesend:function(){
					Loader();
				},
				success : function(data){
					window.location.reload();
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
	})

	$(document).on('click','.reset',function(){
		$('#filter_form')[0].reset();
		var url = $('#filter_form').attr('action');
		postJob(url);
	});
 </script> 
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript">
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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('employer.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>