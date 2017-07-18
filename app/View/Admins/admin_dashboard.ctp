 
<?php
//pr($this->Session);
?>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
<!--<script>-->

<div class="header">
    <h1 class="page-title">Dashboard</h1>
</div>
<div class="row-fluid">
    <div class="main">
    	<div class="row">
       <!-- Welcome to <strong><?php //echo $this->Session->read('Auth.Admin.display_name'); ?> App</strong>-->
        <!--<img src="<?php echo $this->webroot; ?>img/page_show-logo.png" alt="logo">-->

        <div class="menu-box">
            <!-- small box -->
            <div class="small-box bg-fuchsia">
                <div class="inner">
                    <!--<h3>Users</h3>-->
                    <p></p>
                    <h3><?php echo $totaluser;?><span> Users</span></h3>
                </div>
                <div class="icon">
                   <i class="fa fa-users"></i>
                </div>
                <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'index', 'admin' => TRUE)); ?>" class="small-box-footer">More Info <i class="icon-circle-arrow-right"></i></a>
            </div>
        </div>
        <div class="menu-box">
                            <!-- small box -->
            <div class="small-box bg-lime-active">
                <div class="inner">
                    <!--<h3>Banned user</h3>-->
                   <p></p>
                    <h3><?php echo $banuser;?><span> Banned user</span></h3>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'banuser', 'admin' => TRUE)); ?>" class="small-box-footer">More Info <i class="icon-circle-arrow-right"></i></a>
            </div>
        </div>

        <div class="menu-box">
                            <!-- small box -->
            <div class="small-box bg-aqua-active">
                <div class="inner">
                    <!--<h3>Reports</h3>-->
                    <p></p>
                    <h3><?php echo $reports;?><span> Reports</span></h3>
                </div>
                <div class="icon">
                  <i class="fa fa-calendar-o" aria-hidden="true"></i>
                </div>
                <a href="<?php echo $this->Html->url(array('controller' => 'reports', 'action' => 'index', 'admin' => TRUE)); ?>" class="small-box-footer">More Info <i class="icon-circle-arrow-right"></i></a>
            </div>
        </div>
		
		<!-- ------------------------------snehadeep------------------------------------------------->

<div class="menu-box" id="photo">
                            <!-- small box -->
            <div class="small-box bg-yellow-active">
                <div class="inner">
                    <!--<h3>Photos</h3>-->
                    <p></p>
                    <h3><?php echo $photos;?><span> Photos</span></h3>
                </div>
                <div class="icon">
                  <i class="fa fa fa-photo" aria-hidden="true"></i>
                </div>
                <a href="<?php echo $this->Html->url(array('controller' => 'photos', 'action' => 'admin_photos', 'admin' => TRUE)); ?>" class="small-box-footer">More Info <i class="icon-circle-arrow-right"></i></a>
            </div>
        </div>

<div class="menu-box">
                            <!-- small box -->
            <div class="small-box bg-olive-active">
                <div class="inner">
                    <!--<h3>Profile Text</h3>-->
                    <p></p>
                    <h3><?php echo $profiletext;?><span> Profile Text</span></h3>
                </div>
                <div class="icon">
                  <i class="fa fa-calendar-o" aria-hidden="true"></i>
                </div>
                <a href="<?php echo $this->Html->url(array('controller' => 'profiletext', 'action' => 'admin_profiletext', 'admin' => TRUE)); ?>" class="small-box-footer">More Info <i class="icon-circle-arrow-right"></i></a>
            </div>
        </div>


<!--$("#photo").click(function(){-->
<!--    <?php //echo $this->Html->url(array('controller' => 'photos', 'action' => 'admin_photos', 'admin' => TRUE)); ?>-->
<!--});-->

<!------------------------------------------------------------------------------------------->

  <!-- <div class="menu-box">
                            <div class="small-box bg-olive-active">
                                <div class="inner">
                                    <h3>Reports</h3>
                                    <p>Management</p>
                                </div>
                                <div class="icon">
                              <i class="fa fa-list-alt" aria-hidden="true"></i>
                                </div>
                                <a href="Posts.php" class="small-box-footer">More Info <i class="icon-circle-arrow-right"></i></a>
                            </div>
                        </div> 



</div>
<div class="row">


  <div class="menu-box">
                            <div class="small-box bg-yellow-active">
                                <div class="inner">
                                    <h3>Banner</h3>
                                    <p>Management</p>
                                </div>
                                <div class="icon">
                   <i class="fa fa-picture-o" aria-hidden="true"></i>
                                </div>
                                <a href="Posts.php" class="small-box-footer">More Info <i class="icon-circle-arrow-right"></i></a>
                            </div>
                        </div> 

          <div class="menu-box">
                            <div class="small-box bg-blue-active">
                                <div class="inner">
                                    <h3>Website</h3>
                                    <p>Admin</p>
                                </div>
                                <div class="icon">
                       <i class="fa fa-sign-in" aria-hidden="true"></i>
                                </div>
                                <a href="Posts.php" class="small-box-footer">More Info <i class="icon-circle-arrow-right"></i></a>
                            </div>
                        </div>  -->    

        </div>
    </div>
</div>
