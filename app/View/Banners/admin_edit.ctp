<div class="header">
    <h1 class="page-title">Edit Banner</h1>
</div>

<?php echo $this->Form->create('Banner', array('type' => 'file')); ?>
<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
<!-- Button panel start -->
<div class="btn-toolbar">
    <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
</div>
<!-- Button panel end -->

<!-- Form panel start -->
<div class="well">
    <div class="tab-pane active in" id="home">
        <?php
        if ($banner_details['Banner']['banner_image']) {
            $path = "banners/thumb/" . $banner_details['Banner']['banner_image'];
        } else {
            $path = "img/no_image.png";
        }
        ?>

        <label>Image(upload minimum size required 640*100)</label><br/>
        <img src="<?php echo $this->webroot; ?><?php echo $path; ?>" height="100" width="640"><br/><br/>
        <?php echo $this->Form->input('banner_image', array('label' => FALSE, 'div' => FALSE, 'type' => 'file', 'class' => 'input-xlarge', 'id' => 'banner_image')); ?>
    </div>

</div>
<!-- Form panel end -->
<?php echo $this->Form->end(); ?>

