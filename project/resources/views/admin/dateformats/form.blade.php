   <div class="form-body">
	   <div class="row">
	
<div class="col-md-6">
<div class="form-group">
	{!! Form::label('from', 'From: ',['class' => 'control-label']) !!} <span class="star">*</span>
	
	
		
		<div class="input-group">
		
		{!! Form::text('from',null,['class' => 'form-control timepicker timepicker-24','id'=>'from_time']) !!}
		<span class="input-group-btn">
		<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
		</span>
		</div>
													
	
	<label class="help-block"></label>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
	{!! Form::label('to', 'To: ',['class' => 'control-label']) !!} <span class="star">*</span>

		<div class="input-group" >
		
		{!! Form::text('to',null,['class' => 'form-control timepicker timepicker-24','id'=>'to_time']) !!}
		<span class="input-group-btn">
		<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
		</span>
		</div>
	
	<label class="help-block"></label>
</div>
</div>




</div>
	   
<div class="row">
<div class="col-md-6">
<div class="form-group">
	{!! Form::label('status', 'Status: ',['class' => 'control-label']) !!} <span class="star">*</span>
		@if(isset($timeslot))
		@if($timeslot->status == 0)
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

		  
   </div>
	
	<div class="box-footer"> 
		<div class="col-sm-12">
	{!! Form::button($submitButtonText, ['id'=>'adduserbutton','class' => 'btn btn-primary']) !!}   	
	@if(isset($timeslot))
	<a href="{{ url(getenv('adminurl').'/timeslot') }}" class="btn green btn-primary">Back</a>
	@endif
		<br> <br>
		</div>
		<div class="clearfix"></div>
	</div><!-- /.col -->

