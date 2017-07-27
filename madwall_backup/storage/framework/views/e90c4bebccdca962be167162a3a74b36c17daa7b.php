<?php $__env->startSection('css'); ?>

<link rel="stylesheet" href="<?php echo e(asset('public/employer/css/developer.css')); ?>">
<link  href="<?php echo e(asset('public/employer/css/main.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
About
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="white_inner_sec wow fadeInUp">

<div class="row">
<div class="col-md-12">
<?php  
//print_r($user);
 ?>
<p><?php echo e($user->company_description); ?></p>
</div>
</div>

</div>
<div class="white_inner_sec wow fadeInUp">
<?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo Form::open(['id'=>'about','url'=>'employer/about-us']); ?>

<div class="field_forms"><div class="label_form"><label>Send us your feedback  </label></div>
<div class="form_grp">
<?php echo Form::textarea('message',null,['placeholder'=>'Write your message...','rows'=>8,'id'=>'message']); ?>

<span class="error_msgg" style="display:none;"></span>
</div></div>
<div class="date_time_div_post_job">

<div class="buttons">
<!-- <button>Submit</button> -->

<button type="button" id="aboutmadwall">Submit</button>
</div>
</div>
<?php echo Form::close(); ?>


</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('public/employer/js/moment.min.js')); ?>"></script>  
<script src="<?php echo e(asset('public/employer/js/jquery.validate.min.js')); ?>" type="text/javascript"></script>    
<script type="text/javascript">
	$(document).on('click','#aboutmadwall',function(){
		$.ajax({
            url: $('form#about').attr('action'),
            type: 'post',
            dataType: 'json',
            data: $('form#about').serialize(),
            beforeSend:function(){
                Loader();
            },
            success: function(data) {
              if(data.status==1)
              {
                window.location.reload();
              }
            },
            error: function(error) { 
              RemoveLoader();
              $('span.error_msgg').hide();
              var result_errors = error.responseJSON;
              if(result_errors)
              {
                 $.each(result_errors, function(i,obj)
                 {
                    $('textarea[name='+i+']').parent('.form_grp').find('span.error_msgg').slideDown(400).html(obj);
                 }) 
              }

            },
            complete: function() { //RemoveLoader() 
              }
          });
	});
	
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('employer.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>