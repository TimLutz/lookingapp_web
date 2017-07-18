<div class="header">
    <h1 class="page-title">Edit Restriction</h1>
</div>

<?php echo $this->Form->create('UserRestriction', array('type' => 'file')); ?>
<!-- Button panel start -->
<div class="btn-toolbar">
    <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
</div>
<!-- Button panel end -->

<!-- Form panel start -->
<div class="well">
    <div class="tab-pane active in" id="home">
        <label>Limit *</label>
        <?php echo $this->Form->input('limit', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'limit',)); ?>

    </div>

</div>
<!-- Form panel end -->
<?php echo $this->Form->end(); ?>

