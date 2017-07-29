{{-- */use repositories\CommonRepository;/* --}}
@extends('admin.layout')
@section('title')
	Videos	
@endsection
@section('heading')
	Edit Video
@endsection
@section('content')
<div class="row">

<div class="col-md-6">
<?php $id = CommonRepository::encryptID($videos->id); ?>
    {!! Form::model($videos,['method' => 'PATCH','url' => 'admin/videos/'.$id,'files' => true ]) !!}
    {!! Form::hidden('action','edit') !!}
    {!! Form::hidden('pageid',$videos->id) !!}
    @include('admin.videos.form',['submitButtonText' => 'Update Video'])
    {!! Form::close() !!}
</div>
</div>
@endsection	
