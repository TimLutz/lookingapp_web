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
				<div class="col-md-6">
					<div>
						@include('errors.user_error')
						@include('flash::message')
					</div>
					{!! Form::open(['url'=>'auth/register', 'method'=>'post','class'=>'form-control']) !!}
						<div class="form-group">
							{!! Form::label('firstname','Firstname') !!}
							{!! Form::text('first_name',null,['placeholder'=>'Enter First name','class'=>'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('lastname','Lastname') !!}
							{!! Form::text('last_name',null,['placeholder'=>'Enter Last name','class'=>'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('companydetail','Company Detail') !!}
							{!! Form::text('company_name',null,['placeholder'=>'Enter company detail','class'=>'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('contactnumber','Contact Number') !!}
							{!! Form::text('phone_number',null,['placeholder'=>'Enter mobile number','class'=>'form-control']) !!}
						</div>
						<div class="form-group">
							
							{!! Form::label('email','Email') !!}
							{!! Form::text('email',null,['placeholder'=>'Enter Email','class'=>'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('password','Password') !!}
							{!! Form::password('password',['placeholder'=>'Enter Password','class'=>'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('confirm','Confirm Password') !!}
							{!! Form::password('password_confirmation',['placeholder'=>'Enter confirm password','class'=>'form-control']) !!}
						</div>
						<div class="form-group">
							
							{!! Form::submit('Register') !!}
						</div>
						
						
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</section>
		
		
</body>
</html>
