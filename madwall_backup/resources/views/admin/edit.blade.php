<?php Auth::check();
Auth::user(); ?>
@extends('admin.layout')
@section('title')
	Edit Profile
@endsection
@section('heading')
	Edit Profile
@endsection
@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="flash-message">
			@include('flash::message')
		</div>
		<div class="portlet box">
			
			{{ Form::model($user = new App\Model\User,['url'=> url('admin/edit-profile'),'files'=>'true','id'=>'form_sample_1']) }}
				<div class="portlet-body form col-md-6">
					@include('errors.user_error')
			  
		 			<div class="form-group">
						{{ Form::label('Name', 'First Name: ') }} <span class="star">*</span>
						{{ Form::text('first_name',Auth::user()->first_name,['class' => 'form-control','maxlength' => '30']) }}
					</div>

					<div class="form-group">
						{{ Form::label('Name', 'Last Name: ') }} <span class="star">*</span>
						{{ Form::text('last_name',Auth::user()->last_name,['class' => 'form-control','maxlength' => '30']) }}
					</div>
			  
					<div class="form-group">
						{{ Form::label('email', 'Email: ') }}
						<span>{{ Form::text('',Auth::user()->email,['class' => 'form-control','maxlength' => '30', 'readonly'=>'true'] ) }} </span>
					</div>
					{{ Form::label('profile_picture', 'Profile Picture: ') }}
						<div class="pull-left image col-xs-12"><?php
							$image=Auth::user()->image;
								if( $image==null ) {
									$url_img = asset('uploads/no_image.jpg');
								} else {
									$url_img = asset('uploads/'.$image); ?>
									<div>
										<img src="{{ $url_img }}" width="150" height="150" class="img-circle preview" alt="User Image"/>
									</div><?php
								} ?>
						</div>
					<a class="btn btn-primary" id="clear-preview" style="display:none" >Clear</a>
					{{ Form::file( 'pic', $attributes = array( 'class' => 'form-group', 'id' =>'pic' )) }}

					
					
					<div class="form-group">
						{{ Form::submit('Update Profile', ['class' => 'btn btn-primary']) }}
						<a class="btn default" href="{{ url( 'admin/dashboard' ) }}">Cancel</a>
					</div>		
				</div>
        {{ Form::close() }}   
		</div>
	</div>
</div>
@endsection