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
			
				<!--<div class="flash-message">
					@foreach (['danger', 'warning', 'success', 'info'] as $msg)
					  @if(Session::has('alert-' . $msg))

					  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
					  @endif
					@endforeach
				  </div>-->
				  <div class="flash-message">
					  @include('flash::message')
				  </div>
				@include('errors.user_error')
              <form method="post" action="<?php echo URL::to(getenv('adminurl').'/dashboard/change-password'); ?>">
			  <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                  <div class="box-body">
					<div class="form-group">
                      <label>Old Password:</label> <span class="star">*</span>
                      <input type="password" name="old_password" class="form-control" placeholder="Enter Old Password" value="">
                    </div>
                    <div class="form-group">
                      <label>Password:</label> <span class="star">*</span>
                      <input type="password" name="password" class="form-control" placeholder="Enter New Password">
                    </div>
                    <div class="form-group">
                      <label>Confirm Password:</label> <span class="star">*</span>
                      <input type="password" name="password_confirmation" class="form-control" placeholder="Retype New Password">
                    </div>
                    
                    
                  </div>

                  <div class="box-footer">
                    <button type="submit" class="btn blue">Submit</button>
                    <a class="btn default" href="{{ url(getenv('adminurl')) }}">Cancel</a>
                  </div>
                </form>
		</div>
	</div>
</div>
@endsection	
