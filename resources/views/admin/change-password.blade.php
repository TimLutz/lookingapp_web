@extends('admin.layout')

@section('title')
	Change Password
@endsection

@section('heading')
	Change Password 
@endsection

@section('content')

	<div class="row">
	    <div class="col-md-6">
	        <div class="box box-primary">
	            <div class="flash-message">
	                @include('flash::message')
	            </div>
	            @include('errors.user_error')
	           
	            {{ Form::model( $user =new App\Model\User, array( 'url' => url('admin/change-password') )) }}
	                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
	                <div class="box-body col-md-8">
	                    <div class="form-group">
	                    	{{ Form::label( 'old_password', 'Old Password: *' ) }}
	                    	{{ Form::password( 'old_password', array( 'class' =>'form-control', 'placeholder' => 'Enter  Old Password' ) )}}
	                    <div>

	                    <div class="form-group">
	                    	{{ Form::label( 'password', 'Password *' ) }}
	                        {{ Form::password( 'password', array( 'class' =>'form-control', 'placeholder' => 'Enter New Password' ) )}}
	                    </div>
	                    
	                    <div class="form-group">
	                    	{{ Form::label( 'password_confirmation', 'Confirm Password *' ) }}
	           			 	{{ Form::password( 'password_confirmation', array( 'class' =>'form-control', 'placeholder' => 'Retype New Password' ) )}}
	                   	</div>
	                </div>

	                <div class="box-footer">
	                    
	                   	{{ Form::submit('Submit', ['class' => 'btn blue']) }}
						<a class="btn default" href="{{ url( 'admin/dashboard' ) }}">Cancel</a>
	               	</div>
	           {{ Form::close() }}
	        </div>
	    </div>
	</div>
@endsection