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
			<form class="form-horizontal" role="form" method="POST" action="{{ url('password/reset') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="token" value="{{ $token }}">

						<div class="form-group has-feedback">
							
							<div class="col-md-12">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
							</div>
						</div>

						<div class="form-group has-feedback">
							
							<div class="col-md-12">
								<input type="password" class="form-control" name="password" placeholder="Enter New Password">
							</div>
						</div>

						<div class="form-group has-feedback">
							
							<div class="col-md-12">
								<input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
							</div>
						</div>

						<div class="form-group has-feedback">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Reset Password
								</button>
							</div>
						</div>
					</form>
		</div>

	</div>
</section>	
</body>
</html>
