<?php
//pr($this->Session);
?>




<div class="row-fluid">
    <div class="dialog adminLogin">
        <?php
        $myFlash = $this->Session->flash('auth');
        if ($myFlash) {
            ?>
            <!-- Message div start -->
            <div class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span id="message"><strong><?php echo $myFlash; ?></strong></span>
            </div>
            <!-- Message div end -->
            <?php
        }
        ?>

        <div class="block">
            <p class="block-heading">Sign In</p>
            <div class="block-body">
                <?php echo $this->Form->create('Admin', array('admin' => TRUE)); ?>
                <label>Username</label>
                <?php echo $this->Form->input('username', array('type' => 'text', 'div' => FALSE, 'label' => FALSE, 'value' => $cookieEmail, 'class' => 'span12', 'tabindex' => 1)); ?>
                <label>Password</label>
                <?php echo $this->Form->input('password', array('type' => 'password', 'div' => FALSE, 'label' => FALSE, 'value' => $cookiePassword, 'class' => 'span12', 'tabindex' => 2)); ?>
                <input type="submit" class="btn btn-primary pull-right" value="Sign In" tabindex="4" />
                <label class="remember-me"><input name="remember_me" type="checkbox" value="1" tabindex="3" <?php if ($cookieEmail) echo 'checked="checked"'; ?>> Remember me</label>
                <div class="clearfix"></div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
        <!--<p class="pull-right" style=""></p>
        <p><a href="reset-password.html">Forgot your password?</a></p>-->
    </div>
</div>

