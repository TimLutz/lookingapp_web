@include('header')
	<section>
		<div class="containter">
			<div class="row">
				<div class="col-md-6">
				 <div class="flash-message">
					  @include('flash::message')
				  </div>
				@include('errors.user_error')
					<div class="form">
						{!! Form::open(['url'=>'user/changepassword','method'=>'post','class='=>'form-control']) !!}
							<div class="form-group">
								{!! Form::label('old password','Old Password') !!}
								{!! Form::password('old_password') !!}
							</div>						
							<div class="form-group">
								{!! Form::label('new password','New Password') !!}
								{!! Form::password('password') !!}
							</div>
							<div class="form-group">
								{!! Form::label('confirm pssword','Confirm Password') !!}
								{!! Form::password('password_confirmation') !!}
							</div>
							<div class="form-group">
								{!! Form::submit('Change Password') !!}
								<a href="{{ url('user/dashboard') }}">Home</a>
								
							</div>
						{!! Form::close() !!}

					</div>
				</div>
			</div>
		</div>	
	</section>
	
@include('footer')