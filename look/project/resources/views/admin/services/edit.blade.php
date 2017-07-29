@extends('admin.layout')
@section('title')
	 Services		
@endsection
@section('heading')
	Edit Services
@endsection
@section('content')
<div class="row">
	<div class="col-md-8">
		@include('errors.user_error')
		@include('flash::message')
    {!! Form::model($services,['method' => 'PATCH','url' => 'admin/services/'.Crypt::encrypt($services->id)]) !!}
    
    @include('admin.services.form',['submitButtonText' => 'Update Services'])
    
    {!! Form::close() !!}
    
</div>
</div>
@endsection
@section('js')
<!----  Editor JS  ---->
<script src="{{ asset('/js/editor.js') }}"></script>
<script src="{{ asset('assets/dist/js/editor.js') }}" type="text/javascript"></script>
@endsection