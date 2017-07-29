<div class="portlet box">
    <div class="portlet-body">
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!} <span class="star">*</span>
            {!! Form::text('name',null,['class' => 'form-control']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('price', 'Price: ') !!} <span class="star">*</span>
            {!! Form::text('price',null,['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description: ') !!} <span class="star">*</span>
            {!! Form::textarea('description',null,['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('eta', 'ETA: ') !!} <span class="star">*</span>
            {!! Form::text('eta',null,['class' => 'form-control']) !!}
            <span class="label label-danger">Only enter number in this field</span>
        </div>
        
        <div class="form-group">
            {!! Form::label('status','Status') !!}
            {!! Form::select('status',array(''=>'Please select status','1'=>'Active','0'=>'Deactive'),null,['class'=>'form-control','id'=>'form_control_1']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit($submitButtonText, ['class' => 'btn blue']) !!}
            <a href="{{ url('admin/services') }}" class="btn default">Back</a>
        </div>
    </div>
</div>
