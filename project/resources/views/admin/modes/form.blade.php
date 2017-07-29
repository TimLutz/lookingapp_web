<div class="portlet box">
    <div class="portlet-body">
        <div class="form-group">
            {!! Form::label('title', 'Title: ') !!} <span class="star">*</span>
            {!! Form::text('title',null,['class' => 'form-control','placeholder'=>'Enter your title']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description', 'Description: ') !!} <span class="star">*</span>
            {!! Form::textarea('description',null,['class' => 'form-control','placeholder'=>'Enter mode description']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status','Status') !!}
            {!! Form::select('status',array(''=>'Please select status','1'=>'Active','0'=>'Deactive'),null,['class'=>'form-control','id'=>'form_control_1']) !!}
        </div>
		
    
        
    
        <div class="form-group">
            {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
            <a href="{{ url('admin/modes') }}" class="btn default">Back</a>
        </div>
    </div>
</div>