@extends('admin.layout')
@section('title')
	UserRestriction
@endsection
@section('heading')
	Edit Restriction
@endsection
@section('content')
<div class="row">
	<div class="col-md-8">
@include('errors.user_error')
@include('flash::message')
 {!! Form::model($restriction,['id' => 'add_template','method' => 'post','url' => getenv('adminurl').'/userrestriction/update/'.Crypt::encrypt($restriction->id) ]) !!}
    {!! Form::hidden('action','edit') !!}
    {!! Form::hidden('resid',Crypt::encrypt($restriction->id)) !!}
    @include('admin.user_restriction.form',['submitButtonText' => 'Update Restriction'])
    {!! Form::close() !!}
</div>
</div>
@endsection	
