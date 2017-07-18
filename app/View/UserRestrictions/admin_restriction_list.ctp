<div class="header">
    <h1 class="page-title">Restrictions for <?php if($type==0){echo 'free users';}else{echo 'paid users';}?></h1>
</div>


<!-- Search start -->
<!--<div class="search-well">
    <?php
    echo $this->Form->create('User',array('type' => 'post','url' => array('controller' => 'users','action' => 'index','admin' => TRUE)));
        echo $this->Form->input('search', array('type' => 'text', 'label' => FALSE, 'div' => FALSE, 'class' => '', 'id' => 'search', 'placeholder' => '--Search by Name/Email--'));
    ?>
    <button class="btn" style="margin-bottom: 9px;"><i class="icon-search"></i> Go</button>
   <?php
   echo $this->Form->end();
   ?>
</div>-->
<!-- Search end -->


<!-- New user button start -->
<!--<div class="btn-toolbar">
    <a href="<?php echo $this->Html->url(array('action' => 'add_subscription', 'admin' => TRUE)); ?>" class="btn btn-primary"><i class="icon-plus"></i> Add</a>
</div>-->
<!-- New user button start -->


<!-- Listing start -->
<div class="well">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Section</th>
                <th>Limit</th>
               <!-- <th>Creation Date</th>-->
                <th >Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($count) {
                //pr($results);
                foreach ($results as $loop => $result) {
                    if($result['UserRestriction']['member_type']==1){
                        $member_type='paid';
                    }else{
                        $member_type='free';
                    }
                    ?>
                    <tr>
                        <td><?php echo $loop + 1; ?></td>
                        <td><?php echo $result['UserRestriction']['name']; ?></td>
                        <td><?php if($result['UserRestriction']['limit']==0){echo 'Unlimited';}else{echo $result['UserRestriction']['limit'];} ?></td>
                        <!--<td><?php echo date('d-M-Y',strtotime($result['UserRestriction']['creation_date'])); ?></td>-->
                        
                        <td>
                            <a href="<?php echo $this->Html->url(array('action' => 'edit_restriction', 'admin' => TRUE, $result['UserRestriction']['id'],$member_type)); ?>" title="Edit"><i class="icon-pencil"></i></a>
                           <!-- <a href="<?php echo $this->Html->url(array('action' => 'delete_subscription', 'admin' => TRUE, $result['Subscription']['id'])); ?>" onclick="if (!confirm('Are you sure want to delete this record permanently?')) return false;" title="Delete"><i class="icon-remove"></i></a>-->
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5" style="text-align: center;">No records found</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<!-- Listing end -->

<?php if ($count > 0) { ?>
    <?php //echo $this->element('admin/pagination'); ?>
<?php } ?>

