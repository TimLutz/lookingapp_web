<div class="header">
    <h1 class="page-title">Looking Date Profile</h1>
</div>


<!-- Search start -->
<div class="search-well">
    <?php
    $options1 = array('' => '----select----');
    $options1 = $options1 + $options;
    echo $this->Form->create('User', array('type' => 'post', 'url' => array('controller' => 'users', 'action' => 'looking_date', 'admin' => TRUE)));
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
    <a href="<?php echo $this->Html->url(array('action' => 'add_lookdate', 'admin' => TRUE, 'user')); ?>" class="btn btn-primary"><i class="icon-plus"></i> Add</a>
</div>
<!-- New user button start -->


<!-- Listing start -->
<div class="well">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
<!--                <th>My Traits</th>-->
                
              <th>My Interest</th>
              <!--  <th>Email</th>-->
<!--                <th>Email</th>
                <th>Dob</th>-->
                <th >Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($count) {

               // pr($results);
                foreach ($results as $loop => $result) {
                    
                    ?>
                    <tr>
                        <td><?php echo $loop + 1; ?></td>
                        
<!--                        <td><?php echo $result['UserLookdate']['my_traits']; ?></td>-->
                        
                        <td><?php echo $result['UserLookdate']['my_interest']; ?></td>
        <!--                        <td><?php echo date('d-M-Y', strtotime($result['User']['dob'])); ?></td>-->

                        <td>

                            
                             <a href="<?php echo $this->Html->url(array('action' => 'edit_lookdate', 'admin' => TRUE, $result['UserLookdate']['id'])); ?>" title="Edit"><i class="icon-pencil"></i></a>
                             <a href="<?php echo $this->Html->url(array('action' => 'delete_lookdate', 'admin' => TRUE, $result['UserLookdate']['id'])); ?>" onclick="if (!confirm('Are you sure want to delete this record permanently?'))
                                        return false;" title="Delete"><i class="icon-remove"></i></a>

                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No records found</td>
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
