<!DOCTYPE html>
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>MADWALL |@yield('title')</title>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="icon" type="image/png" id="favicon" href="{{asset('images/favicon.png')}}"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<meta name="csrf-token" content="{!! csrf_token() !!}" />
	
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="{{ asset( 'public/admin/css/font-awesome.min.css' ) }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset( 'public/admin/css/simple-line-icons.min.css' ) }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset( 'public/admin/css/bootstrap.min.css' ) }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset( 'public/admin/css/uniform.default.css' ) }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset( 'public/admin/css/bootstrap-switch.min.css' ) }}" rel="stylesheet" type="text/css"/>	
<!-- END GLOBAL MANDATORY STYLES -->

<!--DASHBOARD-->
<link href="{{ asset( 'public/admin/css/simple-line-icons.css' ) }}" rel="stylesheet" type="text/css"/>
<!--END DASHBOARD-->

<!--DATETIME PICKER-->
<link href="{{ asset( 'public/admin/css/daterangepicker-bs3.css' ) }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset( 'public/admin/css/jqvmap.css' ) }}" rel="stylesheet" type="text/css"/>

<!--END DATETIME PICKER-->
<link href="{{ asset( 'public/admin/css/developer.css' ) }}" rel="stylesheet" type="text/css"/>

<!-- Listing -->
<link href="{{ asset( 'public/admin/css/bootstrap-select.min.css' ) }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset( 'public/admin/css/select2.css' ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset( 'public/admin/css/multi-select.css' ) }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset( 'public/admin/css/dataTables.colReorder.min.css' ) }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset( 'public/admin/css/dataTables.bootstrap.css' ) }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset( 'public/admin/css/waitMe.css' ) }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset( 'public/admin/css/waitMe.min.css' ) }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset( 'public/admin/css/pnotify.all.min.css' ) }}" rel="stylesheet" type="text/css" />
<!-- End Listing -->

<link href="{{ asset( 'public/admin/css/bootstrap-wysihtml5.css' ) }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset( 'public/admin/css/jquery.fancybox.css' ) }}" rel="stylesheet"/>
<link href="{{ asset( 'public/admin/css/blueimp-gallery.min.css' ) }}" rel="stylesheet"/>
<link href="{{ asset( 'public/admin/css/jquery.fileupload.css' ) }}" rel="stylesheet"/>
<link href="{{ asset( 'public/admin/css/jquery.fileupload-ui.css' ) }}" rel="stylesheet"/>
<link href="{{ asset( 'public/admin/css/inbox.css' ) }}" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" href="{{ asset ('public/logos/favicon.ico') }} "/>

<!-- BEGIN THEME STYLES -->
<link href="{{ asset( 'public/admin/css/components.css' ) }}" id="style_components" rel="stylesheet" type="text/css"/>
<link href="{{ asset( 'public/admin/css/plugins.css' ) }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset( 'public/admin/css/layout.css' ) }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset( 'public/admin/css/darkblue.css' ) }}" rel="stylesheet" type="text/css" id="style_color"/>
<link href="{{ asset( 'public/admin/css/custom.css') }}" rel="stylesheet" type="text/css"/>

<!-- END THEME STYLES -->
@yield( 'css' )
</head>

<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid">
<!-- BEGIN HEADER -->
<div id="waitMeLoader">

<div class="page-header -i navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="{{ url('admin/dashboard')}}">
			{{ Html::image('public/logos/admin-logo.png', 'alt', array( 'height' => 48 ) ) }}
			</a>
			<div class="menu-toggler sidebar-toggler hide">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav navbar-right">
	            <!-- Authentication Links -->
	            @if (Auth::guest())
	               
	            @else
	                <li class="dropdown dropdown-user">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
	                        <?php
							$image=Auth::user()->image;
								if( $image==null ) {
									$url_img = asset('uploads/no_image.jpg');
								} else {
									$url_img = asset('uploads/'.$image); ?>
										<img src="{{ $url_img }}" width="40" height="40" class="img-circle" alt="User Image"/>
									<?php
								} ?>
							<span class="username username-hide-on-mobile">
	                        {{ Auth::user()->first_name }}
	                        {{ Auth::user()->last_name }}
	                    	</span>
	                    	<i class="fa fa-angle-down"></i>
	                    </a>

	                    <ul class="dropdown-menu" role="menu">
	                        
	                        <li>
								<a href="{{ url('admin/view-profile') }}">
								<i class="icon-user"></i> Edit My Profile </a>
							</li>
					
							<li>
								<a href="{{ url( 'admin/view-change-password' ) }}">
								<i class="icon-lock"></i> Change Password </a>
							</li>
					

	                        <li><a href="{{ route('logout') }}" id="logout" >
	                                <i class="icon-key"></i>  Logout
	                            </a>

	                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                                {{ csrf_field() }}
	                            </form>
	                        </li>
	                    </ul>
	                </li>
	            @endif
	        </ul>

		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<div class="page-container">