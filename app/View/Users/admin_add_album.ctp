<div class="header">
    <h1 class="page-title">Add Album Image</h1>
</div>

<?php echo $this->Form->create('User_album',array('type' => 'file')); ?>
<!-- Button panel start -->
<div class="btn-toolbar">
    <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
</div>
<!-- Button panel end -->

<!-- Form panel start -->
<div class="well">
    <div class="tab-pane active in" id="home">
        <?php 
        //$users1=array(''=>'----select----');
        //$users1=$users1+$users;
        //$friends1=array(''=>'----select----');
        //$friends1=$friends1+$friends;
        ?>
        <label>Users *</label>
        <?php echo $this->Form->input('user_id', array('type' => 'select','empty'=>'--- select---', 'label' => FALSE, 'div' => FALSE, 'class' => 'selectpicker btn-default', 'data-live-search'=>'true','required'=>'true', 'id' => 'user_id','options' => $users)); ?>
        <?php //echo $this->Form->input('user', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => '','required'=>'true', 'id' => 'user','options' => $users1)); ?>
        <label>Image *</label>
        <div id="friends_list">
       <?php echo $this->Form->input('photo_name', array('type' => 'file','empty'=>'--- select---' ,'label' => FALSE, 'div' => FALSE, 'class' => '','required'=>'true', 'id' => 'photo_name' )); ?>
        </div>
     
    </div>

</div>
<!-- Form panel end -->
<?php echo $this->Form->end(); ?>

