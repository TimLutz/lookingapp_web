@include('header')
<section>
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div>
						@include('errors.user_error')
						@include('flash::message')
					</div>
					
    
					{!! Form::model($users,['url'=>'user/editprofile', 'method'=>'post','class'=>'form-control']) !!}
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
							
							{!! Form::label('address','Address') !!}
							{!! Form::text('address',null,['placeholder'=>'Enter Address','class'=>'form-control']) !!}
						</div>
						
						<div class="form-group">
							
							{!! Form::submit('Edit profile') !!}
							<a href="{{ url('user/dashboard') }}">Home</a>
						</div>
						
						
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</section>
@include('footer')