
<div class="form-group">
    {!! Form::label('name', 'Name: ') !!} <span class="star">*</span>
    {!! Form::text('name',null,['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('subject', 'Subject: ') !!} <span class="star">*</span>
    {!! Form::text('subject',null,['class' => 'form-control']) !!}
</div>
    
{!! Form::label('content', 'Content: ') !!} <span class="star">*</span>
{!! Form::textarea('content',null,['id' => 'txtEditor','class' => 'form-control']) !!}

<div class="form-group">
    {!! Form::hidden('testing',null,['id' => 'hide_template','class' => 'form-control']) !!}
</div>
