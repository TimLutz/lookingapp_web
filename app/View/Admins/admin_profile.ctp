<div class="header">
    <h1 class="page-title">Update Profile</h1>
</div>

<div class="well">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#home" data-toggle="tab">Profile</a></li>
        <li><a href="#profile" data-toggle="tab">Password</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">

        <div class="tab-pane active in" id="home">
            <?php echo $this->Form->create('Admin'); ?>
            <?php echo $this->Form->input('action', array('type' => 'hidden', 'value' => 'profile')); ?>
<!--            <label>Email</label>-->
            <?php // echo $this->Form->input('email', array('type' => 'text', 'id' => 'email', 'label' => FALSE, 'div' => FALSE, 'value' => $this->Session->read('Auth.Admin.email'), 'class' => 'input-xlarge')); ?>
            <label>Display Name</label>
            <?php echo $this->Form->input('display_name', array('type' => 'text', 'id' => 'display_name', 'label' => FALSE, 'div' => FALSE, 'value' => $this->Session->read('Auth.Admin.display_name'), 'class' => 'input-xlarge')); ?>
            <div>
                <button class="btn btn-primary">Update</button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>

        <div class="tab-pane fade" id="profile">
            <?php echo $this->Form->create('Admin'); ?>
            <?php echo $this->Form->input('action', array('type' => 'hidden', 'value' => 'password')); ?>
            <label>Old Password</label>
            <?php echo $this->Form->input('old_password', array('type' => 'password', 'id' => 'old_password', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge')); ?>
            <label>New Password</label>
            <?php echo $this->Form->input('password', array('type' => 'password', 'id' => 'password', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge')); ?>
            <div>
                <button class="btn btn-primary">Update</button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>