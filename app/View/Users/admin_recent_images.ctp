<div class="header">
    <h1 class="page-title">Recent Images List</h1>
</div>


<!-- Search start -->
<div class="search-well">
    <?php
    $options1 = array('' => '----select----');
    $options1 = $options1 + $options;
    echo $this->Form->create('User', array('type' => 'post', 'url' => array('controller' => 'users', 'action' => 'recent_images', 'admin' => TRUE)));
    echo $this->Form->input('search', array('type' => 'select', 'selected' => $selected, 'label' => FALSE, 'div' => FALSE, 'class' => 'selectpicker btn-default', 'data-live-search' => 'true', 'id' => 'search', 'options' => $options1));
    ?>
    <button class="btn"><i class="icon-search"></i> Go</button>
    <?php
    echo $this->Form->end();
    ?>
</div>
<!-- Search end -->


<!-- New user button start -->
<div class="btn-toolbar">
    <a href="<?php echo $this->Html->url(array('action' => 'add_recent_image', 'admin' => TRUE)); ?>" class="btn btn-primary"><i class="icon-plus"></i> Add</a>
</div>
<!-- New user button start -->


<!-- Listing start -->
<div class="well">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Created On</th>
<!--                <th>Token</th>
                <th>Email</th>-->
<!--                <th>Email</th>
                <th>Dob</th>-->
                <th >Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($count) {
                //pr($results);
                foreach ($results as $loop => $result) {
                    if ($result['RecentImage']['image']) {
                        $path = "recent_images/" . $result['RecentImage']['image'];
                    } else {
                        $path = "img/no_image.png";
                    }
                    ?>
                    <tr>
                        <td><?php echo $loop + 1; ?></td>
                        <td><img src="<?php echo $this->webroot; ?><?php echo $path; ?>" height="100" width="100"></td>
                        <td><?php echo date('d-M-Y',strtotime($result['RecentImage']['creation_date'])); ?></td>
                       

                        <td>

                            <a href="<?php echo $this->Html->url(array('action' => 'delete_recent_image', 'admin' => TRUE, $result['RecentImage']['id'])); ?>" onclick="if (!confirm('Are you sure want to delete this record permanently?'))
                                        return false;" title="Delete"><i class="icon-remove"></i></a>  
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
    <?php echo $this->element('admin/pagination'); ?>
<?php } ?>

