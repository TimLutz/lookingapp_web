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
	{!! Form::label('address', 'Address: ',['class' => 'control-label']) !!} <span class="star">*</span>
	
	{!! Form::textarea('address',null,['class' => 'form-control short_textarea']) !!}
	
	<label class="help-block"></label>
</div>
</div>
		   
		   
<div class="col-md-6">
<div class="form-group">
	{!! Form::label('photo', 'Image: ',['class' => 'control-label']) !!} <span class="star">*</span>
	{!! Form::file('photo',null,['class' => 'form-control']) !!}
	@if(isset($user->photo))
	<span><?php $imagename = substr($user->photo, strrpos($user->photo, '/') + 1);?>{{$imagename}}</span>
	@endif
	<label class="help-block"></label>
</div>
</div>
</div>
	   
	   
	     

<div class="row">
<div class="col-md-6">
<div class="form-group">
	{!! Form::label('phone', 'Phone: ',['class' => 'control-label']) !!} <span class="star">*</span>
	
	{!! Form::text('phone',null,['class' => 'form-control']) !!}
	
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

<div class="row">
<div class="col-md-6">
<div class="form-group">
	{!! Form::label('domain', 'Domain: ',['class' => 'control-label']) !!} <span class="star">*</span>
	
	{!! Form::text('domain',null,['class' => 'form-control']) !!}
	
	<label class="help-block"></label>
</div>
</div>
</div>







		  
   </div>
	
	<div class="box-footer"> 
		<div class="col-sm-12">
	{!! Form::button($submitButtonText, ['id'=>'adduserbutton','class' => 'btn btn-primary']) !!}   	
	@if(isset($user))
	<a href="{{ url(getenv('adminurl').'/users/index-technician') }}" class="btn green btn-primary">Back</a>
	@endif
		<br> <br>
		</div>
		<div class="clearfix"></div>
	</div><!-- /.col -->

