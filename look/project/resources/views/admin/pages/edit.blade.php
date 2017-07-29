@extends('admin.layout')
@section('title')
	Edit Page		
@endsection
@section('css')
<link href="{{ asset('/css/editor.css') }}" type="text/css" rel="stylesheet"/>
@endsection
@section('heading')
	Edit {{ $page->name }} Page
@endsection
@section('content')
<div class="row">
	<div class="col-md-8">
@include('errors.user_error')
@include('flash::message')
 {!! Form::model($page,['id' => 'add_template','method' => 'PATCH','url' => getenv('adminurl').'/pages/'.Crypt::encrypt($page->id) ]) !!}
    {!! Form::hidden('action','edit') !!}
    {!! Form::hidden('pageid',$page->id) !!}
    @include('admin.pages.form',['submitButtonText' => 'Update Page'])
    {!! Form::close() !!}
</div>
</div>
@endsection	
@section('js')
<!-- Alias JS -->
<script src="{{ asset('/js/alias.js') }}"></script>
<!----  Editor JS  ---->
<script src="{{ asset('/js/editor.js') }}"></script>
<script src="{{ asset('assets/dist/js/editor.js') }}" type="text/javascript"></script>
@endsection
