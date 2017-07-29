   <div class="form-body">
	   <div class="row">
	
<div class="col-md-6">
<div class="form-group">
	{!! Form::label('name', 'Name: ',['class' => 'control-label']) !!} <span class="star">*</span>
	
	{!! Form::text('name',null,['class' => 'form-control']) !!}
	
	<label class="help-block"></label>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
	{!! Form::label('email', 'Email: ',['class' => 'control-label']) !!} <span class="star">*</span>
	
	{!! Form::text('email',null,['class' => 'form-control']) !!}
	
	<label class="help-block"></label>
</div>
</div>




</div>
	   

	   
	   
	     

<div class="row">
<div class="col-md-6">
<div class="form-group">
	{!! Form::label('phone', 'Phone: ',['class' => 'control-label']) !!} <span class="star">*</span>
	
	{!! Form::text('phone',null,['class' => 'form-control','id'=>'phone']) !!}
	
	<label class="help-block"></label>
</div>
</div>


<div class="col-md-6">
<div class="form-group">
	{!! Form::label('status', 'Status: ',['class' => 'control-label']) !!} <span class="star">*</span>
		@if(isset($user))
		@if($user->status == 0)
		{!! Form::select('status', array('1' => 'Active', '0' => 'Inactive'),0,['class' => 'form-control']) !!}
		@else
		{!! Form::select('status', array('1' => 'Active', '0' => 'Inactive'),1,['class' => 'form-control']) !!}
		@endif
		@else
		{!! Form::select('status', array('1' => 'Active', '0' => 'Inactive'),null,['class' => 'form-control']) !!}
		@endif
		<label class="help-block"></label>
</div>
</div>
</div>



@if(isset($user))
@else
<div class="row">
<div class="col-md-6">
<div class="form-group">
	{!! Form::label('password', 'Password: ',['class' => 'control-label']) !!} <span class="star">@if(isset($edit))@else*@endif</span>
	
	<input type="password" name="password" class="form-control" >
	
	
	<label class="help-block"></label>
	
</div>
</div>

<div class="col-md-6">
<div class="form-group">
	{!! Form::label('password_confirmation', 'Confirm Password: ',['class' => 'control-label']) !!} <span class="star">@if(isset($edit))@else*@endif</span>
	
	
	<input type="password" name="password_confirmation" class="form-control">
	<label class="help-block"></label>
	
</div>
</div>

</div>
@endif

<div class="row">
<div class="col-md-6">
<div class="form-group">
	{!! Form::label('address', 'Address: ',['class' => 'control-label']) !!} <span class="star">*</span>
	
	{!! Form::textarea('address',null,['class' => 'form-control short_textarea']) !!}
	
	<label class="help-block"></label>
</div>
</div>
@if(isset($user))
@else
<div class="col-md-6">
<div class="form-group type">
	{!! Form::label('type', 'Type: ',['class' => 'control-label']) !!} <span class="star">*</span>
	
	{!! Form::select('type',[''=>'Select','1'=>'Realtor','2'=>'House Owner','4'=>'Both'],null,['class' => 'form-control']) !!}
	
	<label class="help-block"></label>
</div>
</div>
@endif		   
		   
<!--
<div class="col-md-6">
<div class="form-group">
	{!! Form::label('photo', 'Profile Pic: ',['class' => 'control-label']) !!} <span class="star">*</span>
	{!! Form::file('photo',null,['class' => 'form-control']) !!}
	
	<label class="help-block"></label>
</div>
</div>
-->
</div>

		  
   </div>
	
	<div class="box-footer"> 
		<div class="col-sm-12">
	{!! Form::button($submitButtonText, ['id'=>'adduserbutton','class' => 'btn btn-primary']) !!}  
	
	<a href="{{ url(getenv('adminurl').'/users/') }}" class="btn green btn-primary">Back</a>
	
	
		<br> <br>
		</div>
		<div class="clearfix"></div>
	</div><!-- /.col -->

