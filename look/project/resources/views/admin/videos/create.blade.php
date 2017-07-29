@extends('admin.layout')
@section('title')
	Videos		
@endsection
@section('heading')
	Create Video
@endsection
@section('content')
<div class="row">
 
<div class="col-md-6">
{!! Form::model($videos = new App\models\Video,['url' => 'admin/videos','files' => true ]) !!}
    @include('admin.videos.form',['submitButtonText' => 'Add Video'])
    {!! Form::hidden('action','add') !!}
    {!! Form::close() !!}
</div>
</div>
@endsection	
