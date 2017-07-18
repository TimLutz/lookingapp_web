<div class="header">
    <h1 class="page-title">Add User</h1>
</div>

<?php echo $this->Form->create('RemoveAd', array('type' => 'file')); ?>
<!-- Button panel start -->
<div class="btn-toolbar">
    <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
</div>
<!-- Button panel end -->

<!-- Form panel start -->
<div class="well">
    <div class="tab-pane active in" id="home">
        <label>Month *</label>
        <?php echo $this->Form->input('month', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'month',)); ?>

        <label>Price *</label>
        <?php echo $this->Form->input('price', array('label' => FALSE, 'div' => FALSE, 'type' => 'text', 'class' => 'input-xlarge', 'id' => 'price',)); ?>

    </div>

</div>
<!-- Form panel end -->
<?php echo $this->Form->end(); ?>

