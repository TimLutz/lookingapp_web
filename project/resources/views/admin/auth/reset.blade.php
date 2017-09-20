<!DOCTYPE html>

<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>{{ config('app.website_name') }} | Reset Password</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="icon" type="image/png" id="favicon" href="{{asset('images/favicon.ico')}}"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<meta name="csrf-token" content="{!! csrf_token() !!}" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="{{ asset('assets/admin/pages/css/login2.css') }}" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="{{ asset('assets/global/css/components.css') }}" id="style_components" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/css/plugins.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/admin/layout/css/layout.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/admin/layout/css/themes/darkblue.css') }}" rel="stylesheet" type="text/css" id="style_color"/>
<link href="{{ asset('assets/admin/layout/css/custom.css') }}" rel="stylesheet" type="text/css"/>

<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<link href="{{ asset('assets/global/css/custom.css') }}" rel="stylesheet" type="text/css"/>
<style type="text/css">
	.login {
		background-color: #3F2E56;
	}
	</style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGO -->
<div class="logo">
	<a href="{{ url(getenv('adminurl')) }}">
	<img src="{{ url('images/logo/logo.png') }}" class="logo-default">
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->


<div class="content">
	<!-- BEGIN LOGIN FORM -->


  @include('flash::message')
	<div class="form-title text-center">
			<span class="form-title">Reset Password</span>
		</div>
	<form class="login-form" action="<?php echo URL::to(getenv('adminurl').'/password/reset') ?>" method="post" autocomplete="off">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	{!! Form::hidden('token',$token) !!}
	
		<!--<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Enter any username and password. </span>
		</div>-->
		@if (count($errors) > 0)
		    <div class="alert alert-danger">
		    <button class="close" data-close="alert"></button>
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Email</label>
			
			<input class="form-control form-control-solid placeholder-no-fix" type="email" placeholder="Enter Email" name="email" value="{{ Cookie::has('email') ? Cookie::get('email') : old('email') }}"/>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			
			<input class="form-control form-control-solid placeholder-no-fix" type="password"  placeholder="Enter New Password" name="password" value="{{ Cookie::has('password') ? Cookie::get('password') :  '' }}"/>
		</div>
		
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Confirm Password</label>
			<input class="form-control form-control-solid placeholder-no-fix" type="password"  placeholder="Confirm Password" name="password_confirmation" value="{{ Cookie::has('password') ? Cookie::get('password') :  '' }}"/>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-primary uppercase">Reset</button>
			<label class="rememberme check">
			
		</div>
	
		
	</form>
	<!-- END LOGIN FORM -->
	
	
</div>
<div class="copyright">
	 © 2015 Looking
</div>
<!-- END LOGIN -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="{{ asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-migrate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery.cokie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('assets/global/scripts/metronic.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/layout/scripts/layout.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/layout/scripts/demo.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/pages/scripts/login.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
//Login.init();
Demo.init();
});
</script>

<script type="text/javascript">
	$(document).ready(function(){
        setTimeout(function() {
            $('.alert-success').fadeOut('slow');
        }, 3000);
    });
	$(document).ready(function(){
        setTimeout(function() {
            $('.alert-danger').fadeOut('slow');
        }, 6000);
    });
	</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>



















