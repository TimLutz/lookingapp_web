

		  <?php echo $__env->make('emails.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
		  
	 <?php echo $__env->yieldContent('content'); ?>  
		
			
	
	  <?php echo $__env->make('emails.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
