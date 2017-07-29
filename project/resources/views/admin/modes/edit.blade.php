@extends('admin.layout')
@section('title')
	 Modes		
@endsection
@section('css')
<link href="{{ asset('/css/editor.css') }}" type="text/css" rel="stylesheet"/>
@endsection
@section('heading')
	Edit Mode Delivery
@endsection
@section('content')
<div class="row">
	<div class="col-md-8">
		@include('errors.user_error')
		@include('flash::message')
    {!! Form::model($modes,['method' => 'PATCH','id'=>'add_template','url' => 'admin/modes/'.Crypt::encrypt($modes->id) ]) !!}
    
    @include('admin.modes.form',['submitButtonText' => 'Update Mode'])
    
    {!! Form::close() !!}
    
</div>
</div>
@endsection
@section('js')
<!----  Editor JS  ---->
<script src="{{ asset('/js/editor.js') }}"></script>
<script src="{{ asset('assets/dist/js/editor.js') }}" type="text/javascript"></script>
@endsection