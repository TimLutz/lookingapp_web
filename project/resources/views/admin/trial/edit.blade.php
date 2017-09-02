@extends('admin.layout')
@section('title')
	Edit Trail
@endsection
@section('heading')
	Edit Trail Page
@endsection
@section('content')
<div class="row">
	<div class="col-md-8">
@include('errors.user_error')
@include('flash::message')
 {!! Form::model($trials,['id' => 'add_template','method' => 'post','url' => getenv('adminurl').'/trials/update/'.Crypt::encrypt($trials->id) ]) !!}
    {!! Form::hidden('action','edit') !!}
    {!! Form::hidden('trailid',$trials->id) !!}
    @include('admin.trial.form',['submitButtonText' => 'Update Trail'])
    {!! Form::close() !!}
</div>
</div>
@endsection	
