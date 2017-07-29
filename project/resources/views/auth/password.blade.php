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
			{!! Form::open(['url'=>'password/email','class'=>'form-control']) !!}
				<div class="group_control">
					<label>Email</label>
					<input type="email" name="email" placeholder="User Email" value="">
				</div>
				<div class="group_control">
					{!! Form::submit('Forgot Password') !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</section>	
</body>
</html>
