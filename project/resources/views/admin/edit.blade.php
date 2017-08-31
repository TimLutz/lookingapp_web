{{-- */use repositories\CommonRepositoryInterface;/* --}}
{{-- */use repositories\CommonRepository;/* --}}

<?php $common = new CommonRepository(); ?>
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
			
			<?php   $urledit = getenv('adminurl').'/dashboard/edit-profile';?>
			{!! Form::model($user = new App\User,['url'=> $urledit,'files'=>'true','id'=>'form_sample_1']) !!}   
			<div class="portlet-body form">
				
				@include('errors.user_error')
		  
<!--
		  <div class="form-group">
			{!! Form::label('Firstname', 'First Name: ') !!} <span class="star">*</span>
			{!! Form::text('first_name',Auth::user()->first_name,['class' => 'form-control']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::label('Lastname', 'Last Name: ') !!} <span class="star">*</span>
			{!! Form::text('last_name',Auth::user()->last_name,['class' => 'form-control']) !!}
		</div>
-->
 <div class="form-group">
			{!! Form::label('Name', 'Name: ') !!} <span class="star">*</span>
			{!! Form::text('name',Auth::user()->screen_name,['class' => 'form-control']) !!}
		</div>
		  
          <div class="form-group">
			{!! Form::label('email', 'Email: ') !!}
			<span>{{ Auth::user()->email }}</span>
		</div>
		
		{!! Form::label('profile_picture', 'Profile Picture: ') !!}
		<div class="pull-left image col-xs-12">
		 <?php
					$photo=Auth::user()->profile_pic;
						if($photo==null)
						{
							$url_img = asset('uploads/no_image.jpg');
							$img_path = $common->setPhoto($url_img,'200','200');  ?>
							<img src="{{ $img_path }}" class="img-circle" alt="User Image"/>
					<?php }
						else {
					$url_img = asset('uploads/'.$photo);
					$img_path = $common->setPhoto($url_img,'200','200');  ?>
					<div>
					<img src="{{ $img_path }}" class="img-circle" alt="User Image"/>
					</div>
				<?php	}	?>
		</div>
		
				<input class="form-group" type="file" name="pic" id="pic"/>
			
			<div class="form-group">
				{!! Form::submit('Update Profile', ['class' => 'btn btn-primary']) !!}
				<a class="btn default" href="{{ url(getenv('adminurl')) }}">Cancel</a>
			</div>
					
		  </div>
        {!! Form::close() !!}   
			</div>
	</div>
</div>
@endsection

