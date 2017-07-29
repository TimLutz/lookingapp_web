
<div class="portlet box">
    <div class="portlet-body">
 

  
    
   
	<div class="form-group">
		{!! Form::label('type', 'Type: ') !!} <span class="star">*</span>
		{!! Form::text('type',null,['class' => 'form-control','readonly']) !!}
	</div>
    
        
	<div class="form-group">
		{!! Form::label('value', 'Value: ') !!} <span class="star">*</span>
		{!! Form::textarea('value',null,['class' => 'form-control']) !!}
	</div>

	


	

	<div class="form-group">
		{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
		<a href="{{ url('admin/setting') }}" class="btn default">Back</a>
	</div>
	
    </div>
</div>
