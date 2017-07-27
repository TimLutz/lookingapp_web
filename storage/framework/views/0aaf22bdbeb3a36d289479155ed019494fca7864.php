
<?php  
$notify = Helper::getAllNotification();
$active = isset($active)?$active:'';
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="<?php echo csrf_token(); ?>" />
<title>MadWall | <?php echo $__env->yieldContent('title'); ?></title>
<link href="<?php echo e(asset('public/employer/css/animate.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('public/employer/css/bootstrap.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('public/employer/css/font-awesome.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('public/employer/css/owl.carousel.css')); ?>" rel="stylesheet">
<link rel="shortcut icon" href="<?php echo e(url('public/logos/favicon.ico')); ?>"/>
<?php echo $__env->yieldContent('css'); ?>
</head>

<body>
<div class="loader-section">

<div class="cssload-container">
	<div class="cssload-whirlpool"></div>
</div>
</div>

<div class="wrapper">

<div class="main">
<!-- Header section -->
<header class="header-main wow fadeIn dashboradbanner ">
<div class="container">
<div class="row">
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
<div class="logo"><a href="<?php echo e(url('')); ?>"><img src="<?php echo e(url('public/employer/images/logo_dash.png')); ?>" alt=""></a></div>
<a href="#" class="drop-opener pull-right">
									<span></span>
									<span></span>
									<em class="border"></em>
                                   
								</a>
</div>
<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
<div class="notification_div">
<div class="bell_div dropdown">
<a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell-o" aria-hidden="true"></i></a>
<?php if($notify['not_count']): ?>
<span>
	<?php echo e($notify['not_count']); ?>

</span>
<?php endif; ?>
<?php if(count($notify['notification'])): ?>

<ul class="dropdown-menu" aria-labelledby="dLabel">

<?php $__currentLoopData = $notify['notification']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $notife): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

	<?php  $notifyId = Crypt::encrypt($notife->_id);  ?>
   <li class="visit_nofity" data-value="<?php echo e($k); ?>"><?php echo e($notife->title); ?>

   <?php echo Form::hidden('notity',$notife->_id,['class'=>"notify-$k"]); ?>

<div class="time_noti">1.30pm</div>
</li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  </ul>
<?php endif; ?>
</div>


</div>
<?php 
$url = '';
	if(Auth::user()){
		$url = Auth::user()->image;
	}
	else
		$url = '#'	;
 ?>
<div class="profile_pic_name"><div class="company_name">Welcome <b><?php if(Auth::user()): ?>  <?php echo e(Auth::user()->company_name); ?> <?php endif; ?></b></div>
<div class="name_of_profile"><img src="<?php echo e($url); ?>" /></div>
<div class="drop_profile dropdown"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-angle-down" aria-hidden="true"></i>
</a>
<ul class="dropdown-menu profile_sec_menu" aria-labelledby="dLabel">



   <!-- <li>
		<a href="<?php echo e(url('employer/view-profile')); ?>">
		<i class="icon-user"></i> Edit My Profile </a>
	</li>

	<li>
		<a href="<?php echo e(url( 'employer/view-change-password' )); ?>">
		<i class="icon-lock"></i> Change Password </a>
	</li> -->
<li><a href="javascript:void(0);" id="logout">Logout</a></li>


  </ul>
</div>
</div>
</div>
</div>
</div>
<div class="container">
<div class="inner_banner_sec">
<div class="row">
<h1>Posted <b>Jobs</b></h1>
<div class="col-lg-12 col-md-12 colo-sm-12">
 
<div class="menu_bar">
<div class="navSection">
            <div class="nav-holder" id="menu-drop">
<ul>
<!-- <li><a href="<?php echo e(url('')); ?>">Home</a></li> -->
<li class="<?php echo e(($active == 'dashboard')?'active':''); ?>"><a href="<?php echo e(url('employer/dashboard')); ?>">Posted Jobs</a></li>
<li class="<?php echo e(($active == 'history')?'active':''); ?>"><a href="<?php echo e(url('employer/jobhistory')); ?>"> Jobs History</a></li>
<li class="<?php echo e(($active == 'company-profile')?'active':''); ?>"><a href="<?php echo e(url( 'employer/company-profile' )); ?>"> Company Profile</a></li>
<li class="<?php echo e(($active == 'about')?'active':''); ?>"><a href="<?php echo e(url( 'employer/about' )); ?>"> About MadWall</a></li>
</ul>
</div>
</div>

</div>
</div>
</div>
<?php  
	$url = 'javascript:void(0)';
	$class = '';
 ?>
<?php if(Auth::user()): ?>
<?php if(Auth::user()->approved==1 && empty(Auth::user()->email_verification_code)): ?>
	<?php  $url = url('employer/post_job');  ?>
<?php elseif(Auth::user()->approved==3): ?>
	<?php  $class = 'blockuser';  ?>
<?php elseif(Auth::user()->approved==1 && !empty(Auth::user()->email_verification_code)): ?>
	<?php  $class = 'verifyemail';  ?>
<?php else: ?>
	<?php  $class = 'waitlistuser';  ?>
<?php endif; ?>
<?php endif; ?>
<a href="<?php echo e($url); ?>" class="post_a_job <?php echo e($class); ?>"><span>+</span><div class="text_post_btn">Post a Job</div></a>
</div>
</div>
</header>