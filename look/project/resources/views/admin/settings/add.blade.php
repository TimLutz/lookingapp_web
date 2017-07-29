@extends('admin.layout')
@section('title') 
    Settings
@stop
@section('heading')
	Create Setting
@endsection
@section('content')
<div class="row">
	<div class="col-md-8">
		@include('errors.user_error')
		@include('flash::message')
		{!! Form::model($settings = new App\Settings,['url' => 'admin/settings','files' => true,'id'=>'add_template' ]) !!}
		
		@include('admin.settings.form',['submitButtonText' => 'Submit'])
		
		{!! Form::close() !!}
	</div>
</div>
@endsection	
@section('js')
<!----  Editor JS  ---->
<script src="{{ asset('/js/editor.js') }}"></script>
<script src="{{ asset('assets/dist/js/editor.js') }}" type="text/javascript"></script> 
@endsection