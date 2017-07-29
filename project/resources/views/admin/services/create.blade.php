@extends('admin.layout')
@section('title') 
    Create Service
@stop
@section('css')
<link href="{{ asset('/css/editor.css') }}" type="text/css" rel="stylesheet"/>
@endsection
@section('heading')
	Create Service
@endsection
@section('content')
<div class="row">
	<div class="col-md-8">
		@include('errors.user_error')
		{!! Form::model($services = new App\Services,['url' => 'admin/services']) !!}
		
		@include('admin.services.form',['submitButtonText' => 'Add Services'])
		
		{!! Form::close() !!}
	</div>
</div>
@endsection	
@section('js')
<!----  Editor JS  ---->

@endsection