<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{{ config('app.website_name') }} | Reset Password</title>
<link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet" />
<link href="{{ asset('css/bootstrap.css') }}" type="text/css" rel="stylesheet"/>
<link href="{{ asset('css/font-awesome.min.css') }}" type="text/css" rel="stylesheet"/>
<link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
</head>

<body>
<div class="main">
<div class="top_bar">
<h1><img class="img-responsive" src="{{ url('images/logo/logo.png') }}"/></h1>
</div>
<div class="clear"></div>
<div class="container">
<div class="field_box_center">

{!! Form::open(['url'=>url('app-password-reset'),'autocomplete'=>'off','class'=>'login-form']) !!}
{!! Form::hidden('token',$token) !!}
	<div class="field_box_centerIn su">
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
    <div class="pswrd_field">
   
    <span class="icons"><i class="fa fa-envelope" aria-hidden="true"></i>
</span>

{!! form::text('email',Cookie::has('email') ? Cookie::get('email') : old('email'),['placeholder'=>'Email']) !!}
    </div>
    <div class="pswrd_field">
<span class="icons lock"><i class="fa fa-lock" aria-hidden="true"></i>
</span>
    
    
    {!! form::password('password',['placeholder'=>'Password'],Cookie::has('password') ? Cookie::get('password') :  '') !!}
    </div>
    <div class="pswrd_field">
<span class="icons lock"><i class="fa fa-lock" aria-hidden="true"></i>
</span>
    {!! form::password('password_confirmation',['placeholder'=>'Confirm Password'],Cookie::has('password') ? Cookie::get('password') :  '') !!}
    </div>
     <div class="pswrd_field">
    <!-- <input type="submit" value="RESET PASSWORD"/> -->
    {!! form::submit('Reset Password') !!}
    </div>
{!! Form::close() !!}

    </div>
</div>
</div>
</div>
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
</body>
</html>
