<div class="header">
    <h1 class="page-title">Update Settings</h1>
</div>

<div class="well">

    <div class="tab-pane active in" id="home">
        <?php echo $this->Form->create('Admin', array('action' => 'settings', 'admin' => TRUE)); ?>
        
        <label>Site Title <span class="text-info">(This will be the page title if no title defined for a particular page)</span></label>
        <?php echo $this->Form->input('site_title', array('type' => 'text', 'id' => 'site_title', 'label' => FALSE, 'div' => FALSE, 'value' => $settings['site_title'], 'class' => 'input-xlarge')); ?>
        
        <label>Meta Description</label>
        <?php echo $this->Form->input('meta_description', array('type' => 'text', 'id' => 'meta_description', 'label' => FALSE, 'div' => FALSE, 'value' => $settings['meta_description'], 'class' => 'input-xlarge')); ?>
        
        <label>Meta Keywords</label>
        <?php echo $this->Form->input('meta_keyeards', array('type' => 'text', 'id' => 'meta_keyeards', 'label' => FALSE, 'div' => FALSE, 'value' => $settings['meta_keyeards'], 'class' => 'input-xlarge')); ?>
        
        <label>Admin Email <span class="text-info">(All the admin email will be sent to this address)</span></label>
        <?php echo $this->Form->input('admin_notification_email', array('type' => 'text', 'id' => 'admin_notification_email', 'label' => FALSE, 'div' => FALSE, 'value' => $settings['admin_notification_email'], 'class' => 'input-xlarge')); ?>
        
        <label>Website Email <span class="text-info">(Users will receive email from this email)</span></label>
        <?php echo $this->Form->input('website_email', array('type' => 'text', 'id' => 'website_email', 'label' => FALSE, 'div' => FALSE, 'value' => $settings['website_email'], 'class' => 'input-xlarge')); ?>
        
        
        
        <div>
            <button class="btn btn-primary">Update</button>
        </div>
        
        <?php echo $this->Form->end(); ?>
    </div>

</div>