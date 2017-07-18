<div class="header">
    <h1 class="page-title">Current Reports</h1>
</div>


<!-- Search start -->
<div class="search-well">
    <?php
    echo $this->Form->create('Flag',array('type' => 'post','url' => array('controller' => 'reports','action' => 'index','admin' => TRUE)));
        echo $this->Form->input('search', array('type' => 'text', 'label' => FALSE, 'div' => FALSE, 'class' => '', 'id' => 'search', 'placeholder' => '--Search by Violation/Email--'));
    ?>
    <button class="btn" style="margin-bottom: 9px;"><i class="icon-search"></i> Go</button>
   <?php
   echo $this->Form->end();
   ?>
</div>
<!-- Search end -->


<!-- New user button start -->
<!--<div class="btn-toolbar">
    <a href="<?php echo $this->Html->url(array('action' => 'add_subscription', 'admin' => TRUE)); ?>" class="btn btn-primary"><i class="icon-plus"></i> Add</a>
</div>-->
<!-- New user button start -->


<!-- Listing start -->
<div class="well">
    <div style="float: left">
		<label for="show">Show entries </label>
	</div>
    <div>
		<?php
			//echo 'Show '.$this->Form->select(
			//	'field',
			//	[25, 50, 100],
			//	['empty' => '10'] 
			//) .' entries';
			if(!isset($this->params['pass']['0'])){
				$selected=10;
			}else {
				$selected=$this->params['pass']['0'];
			}
			echo $this->Form->input('show', array(
    'selected' => $selected,
	'label' => false,
    'options' => array(
        '10' =>'10', 
        '25' => '25',
        '50' => '50',
		'100' => '100')
));

		?>
	</div>
	<script>
		$("#show").change(function(){
			$limit=$("#show").val(); 
          location.href="<?php echo ROOT_URL;?>admin/reports/index/"+$limit;
     });
	</script>
    <table class="table">
        <thead>
            <tr>
                <th class="sort <?php if(isset($this->params['paging']['Flag']['order']['Flag.id']) && ($this->params['paging']['Flag']['order']['Flag.id']=='asc')){ echo 'asc';}elseif(isset($this->params['paging']['Flag']['order']['Flag.id']) && $this->params['paging']['Flag']['order']['Flag.id']=='desc'){echo 'desc';} ?>"><?php echo $this->Paginator->sort('Flag.id', 'SR #',['direction' => 'asc']);?></th>
                <!--<th>Section</th>-->
                <th class="sort <?php if(isset($this->params['paging']['Flag']['order']['UserSender.email']) && ($this->params['paging']['Flag']['order']['UserSender.email']=='asc')){ echo 'asc';}elseif(isset($this->params['paging']['Flag']['order']['UserSender.email']) && $this->params['paging']['Flag']['order']['UserSender.email']=='desc'){echo 'desc';} ?>"><?php echo $this->Paginator->sort('UserSender.email', 'From Account');?></th>
                
                <th class="sort <?php if(isset($this->params['paging']['Flag']['order']['UserReceiver.email']) && ($this->params['paging']['Flag']['order']['UserReceiver.email']=='asc')){ echo 'asc';}elseif(isset($this->params['paging']['Flag']['order']['UserReceiver.email']) && $this->params['paging']['Flag']['order']['UserReceiver.email']=='desc'){echo 'desc';} ?>"><?php echo $this->Paginator->sort('UserReceiver.email', 'About Account');?></th>
                
                <th class="sort <?php if(isset($this->params['paging']['Flag']['order']['Flag.flag']) && ($this->params['paging']['Flag']['order']['Flag.flag']=='asc')){ echo 'asc';}elseif(isset($this->params['paging']['Flag']['order']['Flag.flag']) && $this->params['paging']['Flag']['order']['Flag.flag']=='desc'){echo 'desc';} ?>"><?php echo $this->Paginator->sort('Flag.flag', 'Violation');?></th>
                
                <th class="sort <?php if(isset($this->params['paging']['Flag']['order']['Flag.creation_date']) && ($this->params['paging']['Flag']['order']['Flag.creation_date']=='asc')){ echo 'asc';}elseif(isset($this->params['paging']['Flag']['order']['Flag.creation_date']) && $this->params['paging']['Flag']['order']['Flag.creation_date']=='desc'){echo 'desc';} ?>"><?php echo $this->Paginator->sort('Flag.creation_date', 'Date');?></th>
                
                 <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($count) {
                //pr($results);
                foreach ($results as $loop => $result) {
                    ?>
                    <tr>
                        <td><?php echo $result['Flag']['id'];
                        //print_r($this->params['paging']['User']['order']['User.screen_name']);
                        //print_r($this->params);?></td>
                       <!-- <td><?php echo $result['UserRestriction']['limit_type']; ?></td>-->
                        <td><?php echo $result['UserSender']['email']; ?> </td>
                        <td><?php echo $result['UserReceiver']['email']; ?> </td>
                        <td><?php echo $result['Flag']['flag']; ?> </td>
                         <td><?php echo date('Y-m-d h:i:s',strtotime($result['Flag']['creation_date'])); ?> </td>
                        <td>
                        <span class="archive">
                        <a onclick='if (confirm("Are Sure you want to move Archive?")) { return true; } return false;' href="<?php echo $this->Html->url(array('action' => 'move_archive', 'admin' => TRUE,$result['Flag']['id'])); ?>" title="Move to Archive">
                        <img src="<?php echo $this->webroot;?>/img/archive.png"/>
                        </a>
                        </span>    
                        <span>
                        <?php
                            if ($result['UserReceiver']['status'] == 0) {
                                $class = 'fa fa-ban';
                                $status = 'Unban';
                                $statusval = 1;
                            } else {
                                $class = 'fa fa-check-circle';
                                $status = 'Ban';
                                $statusval = 0;
                            }
                            ?>
                            <a onclick='if (confirm("Are Sure you want to <?php echo $status;?> User?")) { return true; } return false;' href="<?php echo $this->Html->url(array('action' => 'change_status', 'admin' => TRUE, $result['UserReceiver']['id'], $statusval)); ?>" title="Change Status to <?php echo $status; ?>"><i class="<?php echo $class; ?>"></i></a>
                        </span>
                        
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

