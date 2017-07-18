<div class="header">
    <h1 class="page-title">Add User</h1>
</div>

<?php echo $this->Form->create('User', array('type' => 'file')); ?>
<!-- Button panel start -->
<div class="btn-toolbar">
    <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
</div>
<!-- Button panel end -->

<!-- Form panel start -->
<div class="well">
    <div class="tab-pane active in" id="home">
        <label>User Name *</label>
        <?php echo $this->Form->input('user_name', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'user_name',)); ?>

        <label>Email *</label>
        <?php echo $this->Form->input('email_id', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'email_id',)); ?>

        <label>Password *</label>
        <?php echo $this->Form->input('password', array('label' => FALSE, 'div' => FALSE, 'type' => 'password', 'class' => 'input-xlarge', 'id' => 'password')); ?>

        <label>First Name *</label>
        <?php echo $this->Form->input('first_name', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'first_name')); ?>

        <label>Last Name *</label>
        <?php echo $this->Form->input('last_name', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'last_name')); ?>

        <label>Gender *</label>
        <?php $status_options = array('' => '---Select---', 'Male' => 'Male', 'Female' => 'Female'); ?>
        <?php echo $this->Form->input('gender', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'gender', 'options' => $status_options)); ?>

        <label>Dob *</label>
        <?php echo $this->Form->input('dob', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'dob')); ?>

        <label>Location *</label>
        <?php echo $this->Form->input('location', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'location')); ?>

        <!--<label>Country</label>
        <?php $status_options = array('' => '---Select---', 'India' => 'India', 'USA' => 'USA'); ?>
        <?php echo $this->Form->input('country', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'country', 'options' => $status_options)); ?>
        -->
        <label>Relationship Status</label>
        <?php $status_options = array('' => '---Select---', 'Single' => 'Single', 'Commited' => 'Commited', 'Others' => 'Others'); ?>
        <?php echo $this->Form->input('relationship_status', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'relationship_status', 'options' => $status_options)); ?>

        <label>Interested In</label>
        <?php $status_options = array('' => '---Select---', 'Male' => 'Male', 'Female' => 'Female', 'Others' => 'Others'); ?>
        <?php echo $this->Form->input('interested_in', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'interested_in', 'options' => $status_options)); ?>

        <label>About Me</label>
        <?php echo $this->Form->input('about_me', array('type' => 'textarea', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'about_me')); ?>

        <label>My Ethnicity</label>
        <?php $status_options = array('' => '---Select---', 'Asian' => 'Asian', 'American' => 'American', 'African' => 'African', 'Others' => 'Others'); ?>
        <?php echo $this->Form->input('my_ethnicity', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'my_ethnicity', 'options' => $status_options)); ?>

        <label>Hobbies</label>
        <?php echo $this->Form->input('hobbies', array('type' => 'text', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'hobbies')); ?>

        <label>My Sextual Orientation</label>

        <?php $status_options = array('' => '---Select---', 'Straight' => 'Straight', 'Bisexual' => 'Bisexual', 'Homosexual' => 'Homosexual', 'Lesbian' => 'Lesbian', 'Others' => 'Others'); ?>
        <?php echo $this->Form->input('my_sextual_orientation', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'my_sextual_orientation', 'options' => $status_options)); ?>

        <label>My_Height</label>
        <?php $status_options = array('' => '---Select---', "4" . "'" . "11" . '"' => "4" . "'" . "11" . '"', "5" . "'" => "5" . "'", "5" . "'" . "1" . '"' => "5" . "'" . "1" . '"', "5" . "'" . "2" . '"' => "5" . "'" . "2" . '"', "5" . "'" . "3" . '"' => "5" . "'" . "3" . '"', "5" . "'" . "4" . '"' => "5" . "'" . "4" . '"', "5" . "'" . "5" . '"' => "5" . "'" . "5" . '"', "5" . "'" . "6" . '"' => "5" . "'" . "6" . '"', "5" . "'" . "7" . '"' => "5" . "'" . "7" . '"', "5" . "'" . "8" . '"' => "5" . "'" . "8" . '"', "5" . "'" . "9" . '"' => "5" . "'" . "9" . '"', "5" . "'" . "10" . '"' => "5" . "'" . "10" . '"', "5" . "'" . "11" . '"' => "5" . "'" . "11" . '"', "6" . "'" => "6" . "'", "6" . "'" . "1" . '"' => "6" . "'" . "1" . '"', "6" . "'" . "2" . '"' => "6" . "'" . "2" . '"', "6" . "'" . "3" . '"' => "6" . "'" . "3" . '"', "6" . "'" . "4" . '"' => "6" . "'" . "4" . '"'); ?>
        <?php echo $this->Form->input('my_height', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'my_height', 'options' => $status_options)); ?>

        <label>MY Body Type</label>
        <?php $status_options = array('' => '---Select---', 'Athletic' => 'Athletic', 'Mascular' => 'Mascular', 'Slim/Petite' => 'Slim/Petite', 'Average' => 'Average', 'Curvy' => 'Curvy', 'Few' => 'Few', 'Extrapounds' => 'Extrapounds', 'Large' => 'Large'); ?>
        <?php echo $this->Form->input('my_body_type', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'my_body_type', 'options' => $status_options)); ?>

        <label>Status</label>
        <?php $status_options = array('1' => 'Active', '0' => 'Inactive'); ?>
        <?php echo $this->Form->input('status', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'status', 'options' => $status_options)); ?>

        <label>Profile Status</label>
        <?php $status_options = array('1' => 'Public', '2' => 'Private'); ?>
        <?php echo $this->Form->input('profile_status', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'profile_status', 'options' => $status_options)); ?>

       <!-- <label>Search Limit(km)</label>
        <?php echo $this->Form->input('search_limit', array('label' => FALSE,'default'=>0, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'search_limit')); ?>

        <label>Search By Gender</label>
        <?php $status_options = array('Male' => 'Male', 'Female' => 'Female'); ?>
        <?php echo $this->Form->input('search_by_gender', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => 'input-xlarge', 'id' => 'search_by_gender', 'options' => $status_options)); ?>-->

        <label>Image</label>
        <?php echo $this->Form->input('image', array('label' => FALSE, 'div' => FALSE, 'type' => 'file', 'class' => 'input-xlarge', 'id' => 'image')); ?>
    </div>

</div>
<!-- Form panel end -->
<?php echo $this->Form->end(); ?>

