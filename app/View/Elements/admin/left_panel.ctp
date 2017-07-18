<?php //pr($this->params);?>
<div class="sidebar-nav">
    <!-- Dashboard -- start -->
    <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'dashboard', 'admin' => TRUE)); ?>" class="nav-header <?php echo (($this->params['controller']==='admins')&& ($this->params['action']=='admin_dashboard') )?'active' :'' ?>"><i class="icon-dashboard"></i>Dashboard <i class="icon-chevron-right" style="float:right;"></i></a>
    <!-- Dashboard -- end -->

   
    
    
    <!-- User Management -- start -->
<!--     <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'index', 'admin' => TRUE)); ?>" class="nav-header"><i class="icon-list"></i>Users Management <i class="icon-chevron-right" style="float:right;"></i></a>
 -->        <a href="#user-menu-devision" class="nav-header collapsed" data-toggle="collapse"><i class="icon-list"></i>Users<i class="icon-chevron-up"></i></a>
    <ul   id="user-menu-devision" class="nav nav-list collapse <?php echo (($this->params['controller']==='users')&& (($this->params['action']=='admin_index') || ($this->params['action']=='admin_banuser')))?'in' :'' ?>">
        <li ><a class="<?php echo (($this->params['controller']==='users')&& ($this->params['action']=='admin_index') )?'active' :'' ?>" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'index', 'admin' => TRUE)); ?>"><i class="icon-pushpin"></i> All Users</a></li>
    <li ><a class="<?php echo (($this->params['controller']==='users')&& ($this->params['action']=='admin_banuser') )?'active' :'' ?>" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'banuser', 'admin' => TRUE)); ?>"><i class="icon-pushpin"></i> Banned Users</a></li>

    </ul>
    <!-- User Management -- end -->
    
	<!-- Album  Management -- start -->
   <!-- <a href="#user-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-list"></i>Albums Management <i class="icon-chevron-up"></i></a>
    <ul   id="user-menu" class="nav nav-list collapse">
        <li ><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'album', 'admin' => TRUE)); ?>"><i class="icon-pushpin"></i> Private Images</a></li>

        <li ><a  href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'archive', 'admin' => TRUE)); ?>"><i class="icon-pushpin"></i> Archive Images</a></li>

	 <li ><a  href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'album_access', 'admin' => TRUE)); ?>"><i class="icon-pushpin"></i> Album Access</a></li>

    </ul>-->
    <!---- end -->
	<!-- Profile  Management -- start -->
    <!--<a href="#user-menu1" class="nav-header collapsed" data-toggle="collapse"><i class="icon-list"></i>Profile Management <i class="icon-chevron-up"></i></a>
    <ul   id="user-menu1" class="nav nav-list collapse">
        <li ><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'viewer', 'admin' => TRUE)); ?>"><i class="icon-pushpin"></i> Profile Viewer</a></li>

        <li ><a  href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'viewed', 'admin' => TRUE)); ?>"><i class="icon-pushpin"></i> Profile Viewed</a></li>
	 <li ><a  href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile_access', 'admin' => TRUE)); ?>"><i class="icon-pushpin"></i> Profile Access</a></li>
<!--<li ><a  href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'looking_date', 'admin' => TRUE)); ?>"><i class="icon-pushpin"></i> Looking Date</a></li>-->
   <!-- </ul>-->
    <!---- end -->
	 <!-- Favourite Management -- start -->
    <!--<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'favourite', 'admin' => TRUE)); ?>" class="nav-header"><i class="icon-list"></i>Favourites Management <i class="icon-chevron-right" style="float:right;"></i></a>-->
    <!-- Favourite Management -- end -->
 <!-- Notes Management -- start -->
   <!-- <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'note', 'admin' => TRUE)); ?>" class="nav-header"><i class="icon-list"></i>Notes Management <i class="icon-chevron-right" style="float:right;"></i></a>-->
    <!-- Note Management -- end -->
<!-- Chat  Management -- start -->
    <!--<a href="#user-menu2" class="nav-header collapsed" data-toggle="collapse"><i class="icon-list"></i>Chat Management <i class="icon-chevron-up"></i></a>
    <ul   id="user-menu2" class="nav nav-list collapse">
        <li ><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'phrases', 'admin' => TRUE)); ?>"><i class="icon-pushpin"></i> Phrases</a></li>
	<li ><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'recent_images', 'admin' => TRUE)); ?>"><i class="icon-pushpin"></i> Recent Images</a></li>

    </ul>-->
    <!---- end -->
	<!-- Subscriptions  Management -- start -->
	<!--<a href="<?php echo $this->Html->url(array('controller' => 'subscriptions', 'action' => 'subscription', 'admin' => TRUE)); ?>" class="nav-header"><i class="icon-list"></i>Subscriptions Management <i class="icon-chevron-right" style="float:right;"></i></a>-->
	<!-- Remove Ad  Management -- start -->
	<!--<a href="<?php echo $this->Html->url(array('controller' => 'removeAds', 'action' => 'removead', 'admin' => TRUE)); ?>" class="nav-header"><i class="icon-list"></i>Remove Ads Management <i class="icon-chevron-right" style="float:right;"></i></a>-->
 <!-- friends list Management -- start -->
   <!-- <a href="<?php echo $this->Html->url(array('controller' => 'friends', 'action' => 'friends_list', 'admin' => TRUE)); ?>" class="nav-header"><i class="icon-list"></i>Friends List Management <i class="icon-chevron-right" style="float:right;"></i></a> -->
    <!-- Services Management -- end -->
    <!-- likes Management -- start -->
   <!-- <a href="<?php echo $this->Html->url(array('controller' => 'likes', 'action' => 'index', 'admin' => TRUE)); ?>" class="nav-header"><i class="icon-list"></i>Likes Management <i class="icon-chevron-right" style="float:right;"></i></a>-->
    <!-- Services Management -- end -->
<!-- likes Management -- start -->
 <!--   <a href="<?php echo $this->Html->url(array('controller' => 'friends', 'action' => 'block_list', 'admin' => TRUE)); ?>" class="nav-header"><i class="icon-list"></i>Block Management <i class="icon-chevron-right" style="float:right;"></i></a>-->
  
   <!-- Reports Management -- start -->
    <!--<a href="<?php echo $this->Html->url(array('controller' => 'reports', 'action' => 'index', 'admin' => TRUE)); ?>" class="nav-header <?php echo (($this->params['controller']==='reports')&& ($this->params['action']=='admin_index') )?'active' :'' ?>"><i class="icon-list"></i>Reported Users <i class="icon-chevron-right" style="float:right;"></i></a> -->
	<a href="#user-menu4" class="nav-header collapsed" data-toggle="collapse"><i class="icon-list"></i>Reported Users <i class="icon-chevron-up"></i></a>
    <ul   id="user-menu4" class="nav nav-list collapse <?php echo (($this->params['controller']==='reports')&& (($this->params['action']=='admin_index')|| ($this->params['action']=='admin_archive')))?'in' :'' ?>">
        <li ><a class="<?php echo (($this->params['controller']==='reports') && ($this->params['action']=='admin_index'))?'active' :'' ?>" href="<?php echo $this->Html->url(array('controller' => 'reports', 'action' => 'index','admin' => TRUE)); ?>"><i class="icon-pushpin"></i> Current Reports</a></li>
	<li ><a class="<?php echo (($this->params['controller']==='reports') && ($this->params['action']=='admin_archive'))?'active' :'' ?>" href="<?php echo $this->Html->url(array('controller' => 'reports', 'action' => 'archive', 'admin' => TRUE)); ?>"><i class="icon-pushpin"></i> Archived Reports</a></li>
    </ul>
	
	<!------------------------------------------Snehadeep---------------------------------------------------->
	<!-- Photos -- start -->
	<a href="<?php echo $this->Html->url(array('controller' => 'photos', 'action' => 'admin_photos', 'admin' => TRUE)); ?>" class="nav-header <?php echo (($this->params['controller']==='photos')&& ($this->params['action']=='admin_photos'))?'active' :'' ?>"><i class="icon-list"></i>Photos<i class="icon-chevron-right" style="float:right;"></i></a>
	
	<!-- Profile text -- start -->
	<a href="<?php echo $this->Html->url(array('controller' => 'profiletext', 'action' => 'admin_profiletext', 'admin' => TRUE)); ?>" class="nav-header <?php echo (($this->params['controller']==='profiletext')&& ($this->params['action']=='admin_profiletext' ))?'active' :'' ?>"><i class="icon-list"></i>Profile text<i class="icon-chevron-right" style="float:right;"></i></a>
	
	<!------------------------------------------------------------------------------------------------------->
	
	<!-- Restrictions Management -- start -->
	<a href="#user-menu3" class="nav-header collapsed" data-toggle="collapse"><i class="icon-list"></i>Restrictions <i class="icon-chevron-up"></i></a>
    <ul   id="user-menu3" class="nav nav-list collapse <?php echo (($this->params['controller']==='UserRestrictions'))?'in' :'' ?>">
        <li ><a class="<?php echo (($this->params['controller']==='UserRestrictions')&& ((($this->params['action']=='admin_restriction_list') && ($this->params['pass'][0]=='free')) || (($this->params['action']=='admin_edit_restriction') && ($this->params['pass'][1]=='free'))))?'active' :'' ?>" href="<?php echo $this->Html->url(array('controller' => 'UserRestrictions', 'action' => 'restriction_list','admin' => TRUE,'free')); ?>"><i class="icon-pushpin"></i> Free Users</a></li>
	<li ><a class="<?php echo (($this->params['controller']==='UserRestrictions')&& ((($this->params['action']=='admin_restriction_list') && ($this->params['pass'][0]=='paid')) || (($this->params['action']=='admin_edit_restriction') && ($this->params['pass'][1]=='paid')) ))?'active' :'' ?>" href="<?php echo $this->Html->url(array('controller' => 'UserRestrictions', 'action' => 'restriction_list', 'admin' => TRUE,'paid')); ?>"><i class="icon-pushpin"></i> Paid Users</a></li>
    </ul>
	<!-- Trial Management -- start -->
    <a href="<?php echo $this->Html->url(array('controller' => 'trials', 'action' => 'trial_list', 'admin' => TRUE)); ?>" class="nav-header <?php echo (($this->params['controller']==='trials')&& ($this->params['action']=='admin_trial_list' || $this->params['action']=='admin_edit_trial'))?'active' :'' ?>"><i class="icon-list"></i>Trials<i class="icon-chevron-right" style="float:right;"></i></a>
	<!-- Reports Management -- start -->
    <a href="<?php echo $this->Html->url(array('controller' => 'banners', 'action' => 'index', 'admin' => TRUE)); ?>" class="nav-header <?php echo (($this->params['controller']==='banners')&& ($this->params['action']=='admin_index' || $this->params['action']=='admin_edit'))?'active' :'' ?>"><i class="icon-list"></i>Banners<i class="icon-chevron-right" style="float:right;"></i></a>
	<!-- Website Admin-- start -->
	<a target=_blank href="http://lookingapp.debutinfotech.com/App/looking/wp-admin/" class="nav-header "><i class="icon-list"></i>Website Admin <i class="icon-chevron-right" style="float:right;"></i></a>
</div>
