<div class="portlet box">
    <div class="portlet-body">
        <div class="form-group">
            {!! Form::label('title', 'Title: ') !!} <span class="star">*</span>
            {!! Form::text('title',null,['class' => 'form-control']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('description', 'Description: ') !!} <span class="star">*</span>
			{!! Form::textarea('description',null,['id' => 'description','class' => 'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
            <a href="{{ url('admin/notes') }}" class="btn default">Back</a>
        </div>
    </div>
</div>
