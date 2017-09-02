{{-- */use repositories\CommonRepositoryInterface;/* --}}
{{-- */use repositories\CommonRepository;/* --}}
{{-- */use App\models\Notificationadmin;/* --}}

<?php 
	//$data = CommonRepository::getNotifications(); 
	$common = new CommonRepository();
//	$notifications = Notificationadmin::where('status','=',1)->orderBy('id','desc')->get();
?>

<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.2
Version: 3.7.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>{{ config('app.website_name') }} - @yield('title')</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="icon" type="image/png" id="favicon" href="{{asset('images/favicon.ico')}}"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<meta name="csrf-token" content="{!! csrf_token() !!}" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->


<link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/jqvmap/jqvmap/jqvmap.css') }}" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->
<link href="{{ asset('assets/global/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/global/plugins/select2/select2.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/global/plugins/jquery-multi-select/css/multi-select.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}"/>
<!-- END PAGE STYLES -->
@yield('css2')
<!-- BEGIN THEME STYLES -->
<link href="{{ asset('assets/global/css/components.css') }}" id="style_components" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/css/plugins.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/admin/layout/css/layout.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/admin/layout/css/themes/darkblue.css') }}" rel="stylesheet" type="text/css" id="style_color"/>
<link href="{{ asset('assets/admin/layout/css/custom.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('css/waitMe.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('css/developer.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('css/pnotify.all.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/css/custom.css') }}" id="style_components" rel="stylesheet" type="text/css"/>
<link href="{{ asset('css/waitMe.min.css') }}" id="style_components" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
@yield('css')

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<!--<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid">-->
<body class="page-header-fixed page-quick-sidebar-over-content">
		<div class="commonmessagemain">
    <div class="container">
    <div class="commonmessageIn">
        
    <span class="msgcross"><i class="icon-cross"></i></span>
    </div>
    </div>

</div>
<!-- BEGIN HEADER -->
<div id="waitMeLoader">
<div class="page-header -i navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="{{ url(getenv('adminurl')) }}">
			<!--<img src="#" alt="logo" class="logo-default"/>-->
				<img src="{{ url('images/logo/admin-logo.png') }}" class="logo-default">
			</a>
			<div class="menu-toggler sidebar-toggler hide">
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				 
				<!-- BEGIN NOTIFICATION DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<?php 
				/*
				?>	
				<li class="dropdown dropdown-extended dropdown-notification notificationappend" id="header_notification_bar">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="icon-bell"></i>
					<?php 
					//$count = count($notifications); ?>
					<span class="badge badge-default">
					 </span>
					</a>
					<ul class="dropdown-menu">
						<li class="external">
							
							<h3><span class="bold"> pending</span> notifications</h3>
<!--
							<a href="extra_profile.html">view all</a>
-->
						</li>
						<li>
							<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
								@foreach($notifications as $notification)
								<?php 
								
								
							//	$converttime = $common->converttimezone($notification->created_at);
								
							//	$time = strtotime($converttime);
							//	$delay = $common->humanTiming($time);
								
								?>
								<li>
									<?php //$noteid = Crypt::encrypt($notification['id']) ?>
									@if(in_array($notification['type'], array("task_requested", "task_completed", "task_deleted","task_rescheduled")))
									<a href="{{ url(getenv('adminurl').'/tasks') }}" id="statusnoti" notificationid = "{{ $noteid }}">
									@elseif(in_array($notification['type'], array("note_created", "note_updated")))
									<a href="{{ url(getenv('adminurl').'/notes/index') }}" id="statusnoti" notificationid = "{{ $noteid }}">
									@else
									<a href="javascript:;" id="statusnoti" notificationid = "{{ $noteid }}">
									@endif	
									<span class="time">{{$delay}} ago</span>
									<span class="details">
									<span class="label label-sm label-icon label-warning">
									<i class="fa fa-bell-o"></i>
									</span>
									{{$notification->content}} </span>
									</a>
								</li>
								@endforeach
							</ul>
						</li>
					</ul>
				</li>
						<?php  */ ?>	
				<!-- END NOTIFICATION DROPDOWN -->
				
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<?php
						$photo=Auth::user()->profile_pic;
							if($photo)
							{
								$url_img = asset('uploads/'.$photo);
								$img_path = $common->setPhoto($url_img,'25','25');  ?>
							 	<img src="{{ $img_path }}" class="img-circle" alt="User Image"/> 
					<?php
							}
							else
							{
								$url_img = asset('uploads/no_image.jpg');
						
								$img_path = $common->setPhoto($url_img,'25','25');  ?>
								<img src="{{ $url_img }}" class="img-circle" alt="User Image"/>
						
					<?php	}	
						
						?>
					<span class="username username-hide-on-mobile">
					{{ Auth::user()->screen_name }}</span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li>
							<a href="{{ url(getenv('adminurl').'/dashboard/edit-profile') }}">
							<i class="icon-user"></i> Edit My Profile </a>
						</li>
					
						<li>
							<a href="{{ url(getenv('adminurl').'/dashboard/change-password') }}">
							<i class="icon-lock"></i> Change Password </a>
						</li>
						<li>
							<a href="{{ url(getenv('adminurl').'/auth/logout') }}">
							<i class="icon-key"></i> Log Out </a>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
				<!-- BEGIN QUICK SIDEBAR TOGGLER -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
	{!! Form::hidden('timezonefield',null,['id'=>'timezone']) !!}
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
 

