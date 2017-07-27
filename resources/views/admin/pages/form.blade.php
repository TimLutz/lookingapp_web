<div class="portlet box">
<div class="portlet-body form">

<div class="form-group">
    {!! Form::label('title', 'Title: ') !!} <span class="star">*</span>
    {!! Form::text('title',null,['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Name: ') !!} <span class="star">*</span>
    {!! Form::text('name',null,['class' => 'form-control']) !!}
</div>
    
	{!! Form::label('content', 'Content: ') !!} <span class="star">*</span>
	{!! Form::textarea('content',null,['id' => 'txtEditor','class' => 'form-control']) !!}


<div class="form-group">
    {!! Form::label('meta_title', 'Meta Title: ') !!} <span class="star">*</span>
    {!! Form::text('meta_title',null,['class' => 'form-control']) !!}
</div>

<!--
<div class="form-group">
	<label>Alias <span class="star">*</span></label><br>
	<span>{{ url('pages') }}</span>
	{!! Form::text('alias',null,['id' => '','class' => 'form-control']) !!}
	<p>	<span id="link" ></span>
		<span id="url_message"></span> </p>
</div>
-->

<div class="form-group">
    {!! Form::label('meta_description', 'Meta Description: ') !!} <span class="star">*</span>
    {!! Form::textarea('meta_description',null,['class' => 'form-control','rows' => 2, 'cols' => 40]) !!}
</div>

<div class="form-group">
    {!! Form::label('meta_tags', 'Meta Tags: ') !!} <span class="star">*</span>
    {!! Form::text('meta_tags',null,['class' => 'form-control']) !!}
</div>

@include('partials.status', ['status' => $page->status])

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn blue']) !!}
    <a href="{{ url(getenv('adminurl').'/pages') }}" class="btn green btn-primary">Back</a>
</div>
</div>
</div>
