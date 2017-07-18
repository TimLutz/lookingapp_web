<div class="header">
    <h1 class="page-title">Banners</h1>
</div>

<!-- New user button start -->
<!--<div class="btn-toolbar">
    <a href="<?php echo $this->Html->url(array('action' => 'add', 'admin' => TRUE, 'user')); ?>" class="btn btn-primary"><i class="icon-plus"></i> Add</a>
</div>-->
<!-- New user button start -->


<!-- Listing start -->
<div class="well">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Banner</th>
				<th >Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($count) {
                //pr($results);
                foreach ($results as $loop => $result) {
                    if($result['Banner']['banner_image']) {
                        $path="banners/thumb/". $result['Banner']['banner_image'];
                    }
                    else {
                        $path="img/no_image.png";
                    }
                    ?>
                    <tr>
                        <td><?php echo $loop + 1; ?></td>
						 <td><?php echo $result['Banner']['name']; ?></td>
                        <td><img src="<?php echo $this->webroot;?><?php echo $path; ?>" height="100" width="640"></td>
						<td>
                           <a href="<?php echo $this->Html->url(array('action' => 'edit', 'admin' => TRUE, $result['Banner']['id'])); ?>" title="Edit"><i class="icon-pencil"></i></a>
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
    <?php //echo $this->element('admin/pagination'); ?>
<?php } ?>

