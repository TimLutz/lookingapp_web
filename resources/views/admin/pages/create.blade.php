@extends('admin.layout')
@section('title')
	Create Page		
@endsection
@section('css')
<link href="{{ asset('/css/editor.css') }}" type="text/css" rel="stylesheet"/>
@endsection
@section('heading')
	Create Page
@endsection
@section('content')
<div class="row">
	<div class="col-md-8">
@include('errors.user_error')
{!! Form::model($page = new App\Page,['id' => 'add_template','url' => getenv('adminurl').'/pages','files' => true ]) !!}
 @include('admin.pages.form',['submitButtonText' => 'Add Page'])
 {!! Form::hidden('action','add') !!}
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
