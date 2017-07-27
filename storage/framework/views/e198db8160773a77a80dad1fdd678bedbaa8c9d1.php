<?php echo $__env->make('employer.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- BEGIN CONTENT -->
	<div class="main_sub_sec">
		<div class="container">
			<div class="dashboard_sec">
			<?php echo $__env->yieldContent('content'); ?>
			</div>
		</div>
	</div>
			
			</div>
	</div>
<div class="clearfix"></div>
	<!-- END CONTENT -->
<?php echo $__env->make('employer.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>