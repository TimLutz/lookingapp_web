<div class="header">
    <h1 class="page-title">Private Images List</h1>
</div>


<!-- Search start -->
<div class="search-well">
    <?php
    $options1=array(''=>'----select----');
    $options1=$options1+$options;
    echo $this->Form->create('User',array('type' => 'post','url' => array('controller' => 'users','action' => 'album','admin' => TRUE)));
        echo $this->Form->input('search', array('type' => 'select','selected' => $selected, 'label' => FALSE, 'div' => FALSE, 'class' => 'selectpicker btn-default', 'data-live-search'=>'true', 'id' => 'search','options' => $options1 ));
    ?>
    <button class="btn"><i class="icon-search"></i> Go</button>
   <?php
   echo $this->Form->end();
   ?>
</div>
<!-- Search end -->


<!-- New user button start -->
<div class="btn-toolbar">
    <a href="<?php echo $this->Html->url(array('action' => 'add_album', 'admin' => TRUE, 'user')); ?>" class="btn btn-primary"><i class="icon-plus"></i> Add</a>
</div>
<!-- New user button start -->


<!-- Listing start -->
<div class="well">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
<!--                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Dob</th>-->
                <th >Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($count) {
                //echo $user_id;
                foreach ($results as $loop => $result) {
                    if($result['User_album']['photo_name']) {
                        $path="profile_pic/". $result['User_album']['photo_name'];
                    }
                    else {
                        $path="img/no_image.png";
                    }
                    ?>
                    <tr>
                        <td><?php echo $loop + 1; ?></td>
                        <td><img src="<?php echo $this->webroot;?><?php echo $path; ?>" height="200" width="200"></td>                       
                        
                        <td>
                            <a href="<?php echo $this->Html->url(array('action' => 'move_archive', 'admin' => TRUE, $result['User_album']['id'])); ?>" title="Move to archive"><i class="icon-pencil"></i></a>
                            <a href="<?php echo $this->Html->url(array('action' => 'delete', 'admin' => TRUE,$result['User_album']['id'])); ?>" onclick="if (!confirm('Are you sure want to delete this record permanently?')) return false;" title="Delete"><i class="icon-remove"></i></a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="3" style="text-align: center;">No records found</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<!-- Listing end -->

<?php if ($count > 0) { ?>
    <?php echo $this->element('admin/pagination'); ?>
<?php } ?>

