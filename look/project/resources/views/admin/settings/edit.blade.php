@extends('admin.layout')
@section('title')
	 Edit Settings		
@endsection
@section('css')
<link href="{{ asset('/css/editor.css') }}" type="text/css" rel="stylesheet"/>
@endsection
@section('heading')
	Edit Settings
@endsection
@section('content')
<div class="row">
	<div class="col-md-8">
		@include('errors.user_error')
		@include('flash::message')
    {!! Form::model($settings,['method' => 'PATCH','id'=>'add_template','url' => 'admin/settings/'.Crypt::encrypt($settings->id) ]) !!}
    
    @include('admin.settings.form',['submitButtonText' => 'Update Setting'])
    
    {!! Form::close() !!}
    
</div>
</div>
@endsection
@section('js')
<!----  Editor JS  ---->
<script src="{{ asset('/js/editor.js') }}"></script>
<script src="{{ asset('assets/dist/js/editor.js') }}" type="text/javascript"></script>
@endsection
