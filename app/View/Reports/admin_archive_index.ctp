<div class="header">
    <h1 class="page-title">Reported Users</h1>
</div>


<!-- Search start -->
<!--<div class="search-well">
    <?php
    echo $this->Form->create('Trial',array('type' => 'post','url' => array('controller' => 'users','action' => 'index','admin' => TRUE)));
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
                <th>SR #</th>
                <!--<th>Section</th>-->
                <th>From Account</th>
                <th>About Account</th>
                <th>Violation</th>
                <th>Date</th>
                 <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($count) {
                pr($results);
                foreach ($results as $loop => $result) {
                    ?>
                    <tr>
                        <td><?php echo $result['Flag']['id'];; ?></td>
                       <!-- <td><?php echo $result['UserRestriction']['limit_type']; ?></td>-->
                        <td><?php echo $result['UserSender']['email']; ?> </td>
                        <td><?php echo $result['UserReceiver']['email']; ?> </td>
                        <td><?php echo $result['Flag']['flag']; ?> </td>
                         <td><?php echo date('d-M-Y',strtotime($result['Flag']['creation_date'])); ?> </td>
                        <td><span class="archive"><img src="<?php echo $this->webroot;?>/img/archive.png"/></span><span><i class="fa fa-check-circle"></i></span></td>
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
    <?php echo $this->element('admin/pagination'); ?>
<?php } ?>

