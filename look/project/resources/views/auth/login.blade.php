<!DOCTYPE>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Gohusky</title>
		<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}"  type="image/x-icon">
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
	</head>
	<body>
	<div>
	</div>
<section>
	<div class="container">
		<div class="row">
			@include('errors.user_error')
			@include('flash::message')
			{!! Form::open(['url'=>'auth/login','class'=>'form-control']) !!}
				<div class="group_control">
					<label>Email</label>
					<input type="email" name="email" placeholder="Enter Email" value="{{ Cookie::has('email') ? Cookie::get('email') : old('email') }}">
				</div>
				<div class="group_control">
					<label>Password</label>
               
                <input type="password" placeholder="Password" name="password" value="{{ Cookie::has('password') ? Cookie::get('password') :  '' }}">
				</div>
				<div>
            	<label>
					<input <?php if(Cookie::has('email') && Cookie::has('password')) echo "checked"; ?> type="checkbox" name="remember"> Keep Me Logged In
					</label>
                
            </div>
				<div class="group_control">
					{!! Form::submit('Login') !!}
					<a href="{{ url('password/email') }}">Forgot Password</a>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</section>	
</body>
</html>
