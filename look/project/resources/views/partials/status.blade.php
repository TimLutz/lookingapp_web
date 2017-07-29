<div class="col-md-6">
<div class="form-group">
    {!! Form::label('status', 'Status: ') !!} <span class="star">*</span>
    {!! Form::label('yes', 'Active') !!}
    {!! Form::radio('status',1,$status,['id' => 'yes','class' => '']) !!}
    {!! Form::label('no', 'Inactive') !!}
    {!! Form::radio('status',0,$status,['id' => 'no','class' => '']) !!}
</div>
</div>
