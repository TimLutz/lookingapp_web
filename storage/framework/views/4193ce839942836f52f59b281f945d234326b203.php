<?php $__env->startSection('content'); ?>
<div class="logo">
    <a href="<?php echo e(url('login')); ?>">
        <?php echo e(Html::image('public/logos/admin-logo.png', 'alt', array( 'width' => 150 ) )); ?>

    </a>
</div>
<div class="content">
    <form class="form-horizontal login-form" role="form" method="POST" action="<?php echo e(route('login')); ?>">
        <?php echo e(csrf_field()); ?>

        <h3 class="form-title">Sign In</h3>

        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">   
            <input id="email" type="text" placeholder="Email*" class="form-control form-control-solid placeholder-no-fix" name="email" autofocus>
            <?php if($errors->has('email')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('email')); ?></strong>
                </span>
            <?php endif; ?>
        </div>
        

        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
            <input id="password" type="password" placeholder="Password*" class="form-control form-control-solid placeholder-no-fix" name="password">
            <?php if($errors->has('password')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('password')); ?></strong>
                </span>
            <?php endif; ?>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-success uppercase">Sign In </button>
                <!-- <label>
                    <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>/> Remember Me
                </label> -->
           <!--  <a href="<?php echo e(route('password.request')); ?>" id="forget-password" class="forget-password">Forgot Password?</a>

        </div>
        </form>    
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>