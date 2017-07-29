@extends('admin.layout')
@section('title')
	 Notes		
@endsection
@section('css')
<link href="{{ asset('/css/editor.css') }}" type="text/css" rel="stylesheet"/>
@endsection
@section('heading')
	Edit Note
@endsection
@section('content')
<div class="row">
	<div class="col-md-8">
		@include('errors.user_error')
		@include('flash::message')
    {!! Form::model($notes,['method' => 'PATCH','id'=>'add_template','url' => 'admin/notes/'.Crypt::encrypt($notes->id) ]) !!}
    
    @include('admin.notes.form',['submitButtonText' => 'Update Note'])
    
    {!! Form::close() !!}
    
</div>
</div>
@endsection
@section('js')
<!----  Editor JS  ---->
<script src="{{ asset('/js/editor.js') }}"></script>
<script src="{{ asset('assets/dist/js/editor.js') }}" type="text/javascript"></script>
@endsection