<?php Auth::check();
Auth::user(); ?>

<?php $__env->startSection('title'); ?>
	Edit Profile
<?php $__env->stopSection(); ?>
<?php $__env->startSection('heading'); ?>
	Edit Profile
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-md-6">
		<div class="flash-message">
			<?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
		<div class="portlet box">
			
			<?php echo e(Form::model($user = new App\Model\User,['url'=> url('admin/edit-profile'),'files'=>'true','id'=>'form_sample_1'])); ?>

				<div class="portlet-body form col-md-6">
					<?php echo $__env->make('errors.user_error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			  
		 			<div class="form-group">
						<?php echo e(Form::label('Name', 'First Name: ')); ?> <span class="star">*</span>
						<?php echo e(Form::text('first_name',Auth::user()->first_name,['class' => 'form-control','maxlength' => '30'])); ?>

					</div>

					<div class="form-group">
						<?php echo e(Form::label('Name', 'Last Name: ')); ?> <span class="star">*</span>
						<?php echo e(Form::text('last_name',Auth::user()->last_name,['class' => 'form-control','maxlength' => '30'])); ?>

					</div>
			  
					<div class="form-group">
						<?php echo e(Form::label('email', 'Email: ')); ?>

						<span><?php echo e(Form::text('',Auth::user()->email,['class' => 'form-control','maxlength' => '30', 'readonly'=>'true'] )); ?> </span>
					</div>
					<?php echo e(Form::label('profile_picture', 'Profile Picture: ')); ?>

						<div class="pull-left image col-xs-12"><?php
							$image=Auth::user()->image;
								if( $image==null ) {
									$url_img = asset('uploads/no_image.jpg');
								} else {
									$url_img = asset('uploads/'.$image); ?>
									<div>
										<img src="<?php echo e($url_img); ?>" width="150" height="150" class="img-circle preview" alt="User Image"/>
									</div><?php
								} ?>
						</div>
					<a class="btn btn-primary" id="clear-preview" style="display:none" >Clear</a>
					<?php echo e(Form::file( 'pic', $attributes = array( 'class' => 'form-group', 'id' =>'pic' ))); ?>


					
					
					<div class="form-group">
						<?php echo e(Form::submit('Update Profile', ['class' => 'btn btn-primary'])); ?>

						<a class="btn default" href="<?php echo e(url( 'admin/dashboard' )); ?>">Cancel</a>
					</div>		
				</div>
        <?php echo e(Form::close()); ?>   
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>