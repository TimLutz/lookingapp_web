<div class="header">
    <h1 class="page-title">Add Phrases</h1>
</div>

<?php echo $this->Form->create('Phrase', array('type' => 'file')); ?>
<?php //echo $this->Form->input('id', array('type' => 'hidden')); ?>

<!-- Button panel start -->
<div class="btn-toolbar">
    <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
</div>
<!-- Button panel end -->

<!-- Form panel start -->
<div class="well">
    <div class="tab-pane active in" id="home">
         <?php
    $options1=array(''=>'----select----');
    $options1=$options1+$options;
    ?>
         <label>User*</label>
         <?php
   
        echo $this->Form->input('user_id', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => 'selectpicker btn-default', 'data-live-search'=>'true', 'id' => 'user_id','options' => $options1,'required'=>true ));
    ?><br/>
        <label>Phrases*</label>
        <?php echo $this->Form->input('phrases', array('label' => FALSE, 'div' => FALSE, 'type' => 'textarea', 'class' => 'input-xlarge', 'id' => 'phrases','required'=>true)); ?>
    </div>

</div>
<!-- Form panel end -->
<?php echo $this->Form->end(); ?>

