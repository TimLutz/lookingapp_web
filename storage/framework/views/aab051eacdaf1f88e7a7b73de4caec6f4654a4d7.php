<?php echo $__env->make('header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<section class="page-title">
				<h1>
					<?php echo $__env->yieldContent('heading'); ?>
				</h1>
			</section>
			
			<?php echo $__env->yieldContent('content'); ?>
			
			<div class="clearfix"></div>
		</div>
	</div>
	<!-- END CONTENT -->
<?php echo $__env->make('footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


