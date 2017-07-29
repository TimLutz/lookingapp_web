@extends('admin.layout')
@section('title')
	Edit Template		
@endsection
@section('css')
<link href="{{ asset('/css/editor.css') }}" type="text/css" rel="stylesheet"/>
@endsection
@section('heading')
				Edit {{ $template->name }} Template
@endsection
@section('content')

<div class="row">
             
    
    
	<div class="col-md-9">
	@include('errors.user_error')
	@include('flash::message')
	<div class="portlet box">
						
	<div class="portlet-body">
    {!! Form::model($template,['method' => 'PATCH','id' => 'add_template','url' => 'admin/template/'.Crypt::encrypt($template->id) ]) !!}
	
    @include('admin.template.form')
    
	<div class="form-group">

				{!! Form::submit('Update Template', ['class' => 'btn btn-primary']) !!}
				<a href="{{ url('admin/template') }}" class="btn btn-danger">Back</a>
			</div>
	
    {!! Form::close() !!}
</div></div></div>
	<div class="col-md-3">
	<div class="portlet box">
		<div class="portlet-body">
		
			<div class="form-group">
				{!! Form::label('attribute', 'Select Attributes: ') !!}
				{!! Form::select('attribute',$attributes,null,['id'=>'attribute','class' => 'form-control','multiple','last']) !!}
			</div>
			</div>
		</div>
	</div>	
	
</div> 
@endsection
@section('js')
<script type="text/javascript">
		$(document).ready(function() {
			$('select').change(function() {
			var currentVal = $('#textarea').val();
			$('#textarea').append(currentVal + $(this).val()); 
		});
});
</script>
<!----  Editor JS  ---->
<script src="{{ asset('/js/editor.js') }}"></script>
<script src="{{ asset('assets/dist/js/editor.js') }}" type="text/javascript"></script>
@endsection
