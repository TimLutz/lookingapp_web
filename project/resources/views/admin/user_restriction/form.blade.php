<div class="portlet box">
<div class="portlet-body form">

<div class="form-group">
    {!! Form::label('limit', 'Limit: ') !!} <span class="star">*</span>
    {!! Form::text('limit',null,['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn blue']) !!}
    <a href="{{ url(getenv('adminurl').'/userrestriction') }}" class="btn green btn-primary">Back</a>
</div>
</div>
</div>
