 
<?php $__env->startSection('content'); ?>
<?php echo htmlspecialchars_decode($content); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('emails.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>