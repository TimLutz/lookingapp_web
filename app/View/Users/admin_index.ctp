<div class="header">
    <h1 class="page-title">Users</h1>
</div>


<!-- Search start -->
<div class="search-well">
    <?php
    echo $this->Form->create('User',array('type' => 'post','url' => array('controller' => 'users','action' => 'index','admin' => TRUE)));
        echo $this->Form->input('search', array('type' => 'text', 'label' => FALSE, 'div' => FALSE, 'class' => '', 'id' => 'search', 'placeholder' => '--Search by Name/Email--'));
    ?>
    <button class="btn" style="margin-top: -3px;"><i class="icon-search"></i> Go</button>
   <?php
   echo $this->Form->end();
   ?>
</div>
<!-- Search end -->


<!-- New user button start -->
<!--<div class="btn-toolbar" style="margin-bottom:15px;">
    <a href="<?php echo $this->Html->url(array('action' => 'add', 'admin' => TRUE, 'user')); ?>" class="btn btn-primary"><i class="icon-plus"></i> Add</a>
</div>-->
<?php
	if ($count>0) {
		?>
<div class="btn-toolbar" style="margin-bottom:15px;">
	<a href="<?php echo $this->Html->url(array('action' => 'export', 'admin' => TRUE,'ext' => 'csv')); ?>" class="btn btn-primary"><i class="icon-plus"></i> Export</a>
<?php 
//echo $this->Html->link('Export Email', array(
//	'controller' => 'users', 
//	'action' => 'export',
//	'admin' => TRUE,
//	'ext' => 'csv'
//));
?>
</div>
<?php } ?>
<!-- New user button start -->


<!-- Listing start -->
<?php
	if ($count) {
		//pr($results);
		foreach ($results as $loop => $result) {
	?>
<div id="myModal<?php echo $loop; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
           <div class="modal-body">
			
        <p><?php echo $result['Profile']['about_me'];?></p>
         <a href="#" class="close_btn" data-dismiss="modal"><img src="<?php echo $this->webroot;?>/img/close_btn.png"/></a>
		
      </div>
     
    </div>

  </div>
</div>
 <?php
		 }
	}
?>
<div class="well main-row">
<div class="drop-down-area">
		<label for="show" >Show entries </label>

    <div class="drop-down-class">
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
</div>
	<script>
		$("#show").change(function(){
			$limit=$("#show").val(); 
          location.href="<?php echo ROOT_URL;?>admin/users/index/"+$limit;
     });
	</script>
	
<div class="table-block">
<div class="table-responsive user-table">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
				
                <th>Image</th>
				
                <th class="sort <?php if(isset($this->params['paging']['User']['order']['User.screen_name']) && ($this->params['paging']['User']['order']['User.screen_name']=='asc')){ echo 'asc';}elseif(isset($this->params['paging']['User']['order']['User.screen_name']) && $this->params['paging']['User']['order']['User.screen_name']=='desc'){echo 'desc';} ?>"><?php echo $this->Paginator->sort('User.screen_name', 'Screen Name');?></th>
				
                <th class="sort <?php if(isset($this->params['paging']['User']['order']['User.token']) && ($this->params['paging']['User']['order']['User.token']=='asc')){ echo 'asc';}elseif(isset($this->params['paging']['User']['order']['User.token']) && $this->params['paging']['User']['order']['User.token']=='desc'){echo 'desc';} ?>"><?php echo $this->Paginator->sort('User.token', 'User Id');?></th>
				
                <th class="sort <?php if(isset($this->params['paging']['User']['order']['User.email']) && ($this->params['paging']['User']['order']['User.email']=='asc')){ echo 'asc';}elseif(isset($this->params['paging']['User']['order']['User.email']) && $this->params['paging']['User']['order']['User.email']=='desc'){echo 'desc';} ?>"><?php echo $this->Paginator->sort('User.email', 'Email');?></th>
				
                <th class="sort <?php if(isset($this->params['paging']['User']['order']['User.member_type']) && ($this->params['paging']['User']['order']['User.member_type']=='asc')){ echo 'asc';}elseif(isset($this->params['paging']['User']['order']['User.member_type']) && $this->params['paging']['User']['order']['User.member_type']=='desc'){echo 'desc';} ?>"><?php echo $this->Paginator->sort('User.member_type', 'Member Type');?></th>
				
				<th class="sort <?php if(isset($this->params['paging']['User']['order']['User.creation_date']) && ($this->params['paging']['User']['order']['User.creation_date']=='asc')){ echo 'asc';}elseif(isset($this->params['paging']['User']['order']['User.creation_date']) && $this->params['paging']['User']['order']['User.creation_date']=='desc'){echo 'desc';} ?>"><?php echo $this->Paginator->sort('User.creation_date', 'Joined');?></th>
				
                <th class="sort <?php if(isset($this->params['paging']['User']['order']['User.valid_upto']) && ($this->params['paging']['User']['order']['User.valid_upto']=='asc')){ echo 'asc';}elseif(isset($this->params['paging']['User']['order']['User.valid_upto']) && $this->params['paging']['User']['order']['User.valid_upto']=='desc'){echo 'desc';} ?>"><?php echo $this->Paginator->sort('User.valid_upto', 'Expires');?></th>
				
                 <th>Profile text</th>
                <th>Action (Ban,Unban)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($count) {
                //pr($results);
                foreach ($results as $loop => $result) {
                    if($result['User']['profile_pic']) {
                        $path="profile_pic/". $result['User']['profile_pic'];
                    }
                    else {
                        $path="img/no_image.png";
                    }
                    ?>
                    <tr>

					   <td>
							<?php
							  //print_r($this->params['paging']['User']['options']['direction']);
							  //print_r($this->params['paging']['User']['order']['User.screen_name']);
							  //print_r($this->params['pass'][0]);
							   //$url = $_SERVER['REQUEST_URI'];
							   $page= $this->params['paging']['User']['page'];
							   if(isset($page)) {
								 echo (($page-1)*$selected)+$loop+1;
							   }else{
								 echo $loop + 1;
							   }
						
							   
							   //echo  (($page[1]-1)*10)+$loop;
							?>
					   </td>
                       <!-- <td><img src="<?php echo $this->webroot;?><?php echo $path; ?>" height="50" width="50"></td>-->


                    
                        <td>   <a class="example-image-link" href="<?php echo $this->webroot;?><?php echo $path; ?>" data-lightbox="example-set"><img class="example-image" src="<?php echo $this->webroot;?><?php echo $path; ?>" alt="" height="50" width="50"/></a></td>




                        <td><?php
                        $screen_name=ereg_replace('\u.{4}', '', $result['User']['screen_name']);
                        echo str_replace("\\","",$screen_name); ?>
                        </td>
                        <td><?php echo $result['User']['token']; ?></td>
                        <td><?php echo $result['User']['email']; ?></td>
						<td><?php
						if($result['User']['member_type']==1 && strtotime($result['User']['valid_upto'])>=strtotime(date('Y-m-d')) && $result['User']['is_trial']==1){	
								echo 'Trial' ;	
						}else if($result['User']['member_type']==1 && strtotime($result['User']['valid_upto'])>=strtotime(date('Y-m-d'))){
								echo 'Paid';
							
						}else{
							if($result['User']['removead']==1 && strtotime($result['User']['removead_valid_upto'])>=strtotime(date('Y-m-d'))){
								echo 'Ad Free';
							}else{
								echo 'Free' ;
							}
							} ?></td>
						<td><?php echo date('Y-m-d h:i:s',strtotime($result['User']['creation_date']));?></td>
                        <td><?php if($result['User']['member_type']==1 && strtotime($result['User']['valid_upto'])<strtotime(date('Y-m-d')) || $result['User']['member_type']==0){ echo '----';}else {echo date('Y-m-d',strtotime($result['User']['valid_upto']));} ?></td>

                        <td><?php echo substr($result['Profile']['about_me'],0,47);?>
						<?php if(strlen($result['Profile']['about_me'])>47){
							echo '<br/><a style="color:#e96b5e;" data-toggle="modal" data-target="#myModal'.$loop.'"href="#">read more..</a>';
						}
						?>
                        </td>


                        
                        <td>
                           <!-- <a href="<?php echo $this->Html->url(array('action' => 'edit', 'admin' => TRUE, $result['User']['id'])); ?>" title="Edit"><i class="icon-pencil"></i></a>-->

                            <?php
                            if ($result['User']['status'] == 0) {
                                $class = 'fa fa-ban';
                                $status = 'Unban';
                                $statusval = 1;
                            } else {
                                $class = 'fa fa-check-circle';
                                $status = 'Ban';
                                $statusval = 0;
                            }
                            ?>
                            <a onclick='if (confirm("Are Sure you want to <?php echo $status;?> User?")) { return true; } return false;' href="<?php echo $this->Html->url(array('action' => 'change_status', 'admin' => TRUE, $result['User']['id'], $statusval)); ?>" title="Change Status to <?php echo $status; ?>"><i class="<?php echo $class; ?>"></i></a>

<!--                            <a href="<?php echo $this->Html->url(array('action' => 'delete', 'admin' => TRUE, $result['User']['id'])); ?>" onclick="if (!confirm('Are you sure want to delete this record permanently?')) return false;" title="Delete"><i class="icon-remove"></i></a>-->
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="10" style="text-align: center;">No records found</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>


</div>
</div>
<!-- Listing end -->

<?php if ($count > 0) { ?>
    <?php echo $this->element('admin/pagination'); ?>
<?php } ?>

