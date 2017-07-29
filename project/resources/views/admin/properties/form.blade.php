   <div class="form-body">
	   <div class="row">
	
<div class="col-md-6">
<div class="form-group">
	{!! Form::label('user_id', 'Houseowner: ',['class' => '']) !!} <span class="star">*</span>
	
		{!! Form::select('fdsfsd', $users, $user_id,['class' => 'form-control','disabled' => 'disabled']) !!}
		{!! Form::hidden('user_id',$user_id,['class' => 'form-control']) !!}
		<label class="help-block"></label>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
	

	{!! Form::label('property_name', 'Property Name: ',['class' => 'control-label']) !!} <span class="star">*</span>
	
	{!! Form::text('property_name',null,['class' => 'form-control']) !!}
	

	<label class="help-block"></label>
</div>
</div>




</div>
	   
<div class="row">
<div class="col-md-6">
<div class="form-group">
	{!! Form::label('property_address', 'Address: ',['class' => 'control-label']) !!} <span class="star">*</span>
	<div id="locationField">
	{!! Form::text('property_address',null,['class' => 'form-control','id' => 'autocomplete', 'onFocus' => 'geolocate()' ]) !!}
	 </div>
	<label class="help-block"></label>
</div>
</div>
		   


{!! Form::hidden('latitude',null,['class' => 'form-control','id'=>'latitude']) !!}
{!! Form::hidden('longitude',null,['class' => 'form-control','id'=>'longitude']) !!}
{!! Form::hidden('city',null,['class' => 'form-control','id'=>'city']) !!}
{!! Form::hidden('state',null,['class' => 'form-control','id'=>'state']) !!}
{!! Form::hidden('country',null,['class' => 'form-control','id'=>'country']) !!}
{!! Form::hidden('zipcode',null,['class' => 'form-control','id'=>'postal_code']) !!}




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
	   


<div class="row dropdowngeneral">
   
    
    <div class="col-md-6">
		 
<!--
	 <a class="btn green add_field_button2" href="javascript:;"> 
		 Add More
<i class="fa fa-plus"></i>
</a>
-->

<div class="form-group addmoreoption">
	
	{!! Form::label('option', 'Rooms: ',['class' => '']) !!} <span class="star">*</span>
	 
	
	 
	 
	<div class=" input_fields_wrap">
		<div class="appended_div1">
			<div class="row">
	<div class="col-sm-10">{!! Form::text('option[1]',null,['class' => 'form-control','id'=>'optiononestatic']) !!}</div>
	<div class="col-sm-2 text-right">
	<span class="input-group-btn appended_span add_field_button2"><button class="btn green" type="button"><i class="fa fa-plus"></i></button></span>
	</div>
	</div>
	<label class="help-block" id="option1_error"></label>
	</div>
	</div>
	
</div>
</div>
</div>



		  
   </div>
	
	<div class="box-footer">
		
		<div class="col-sm-12">
	{!! Form::button($submitButtonText, ['id'=>'adduserbutton','class' => 'btn btn-primary']) !!}   <br> <br>	
	
	</div>
		<div class="clearfix"></div>
	</div><!-- /.col -->

