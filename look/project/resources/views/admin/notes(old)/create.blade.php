@extends('admin.layout')
@section('title') 
    Create Note
@stop
@section('css')
<link href="{{ asset('/css/editor.css') }}" type="text/css" rel="stylesheet"/>
@endsection
@section('heading')
	Create Note
@endsection
@section('content')
<div class="row">
	<div class="col-md-8">
		@include('errors.user_error')
		@include('flash::message')
		{!! Form::model($note = new App\Note,['url' => 'admin/notes','files' => true,'id'=>'add_template' ]) !!}
		
		@include('admin.notes.form',['submitButtonText' => 'Submit'])
		
		{!! Form::close() !!}
	</div>
</div>
@endsection	
@section('js')
<!----  Editor JS  ---->
<script src="{{ asset('/js/editor.js') }}"></script>
<script src="{{ asset('assets/dist/js/editor.js') }}" type="text/javascript"></script> 
@endsection