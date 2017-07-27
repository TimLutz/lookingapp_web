@extends('admin.layout')
@section('title')
	Edit User
@endsection
@section('heading')
	Edit User
@endsection
@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-body">
				@include('errors.user_error')
				@include('flash::message')
    {!! Form::model($user,['method' => 'PATCH','url' => 'admin/dashboard/updateuser/'.Crypt::encrypt($user->id)]) !!}
    
    @include('admin.user.useredit',['submitButtonText' => 'Update Category'])
    {!! Form::hidden('action','edit') !!}
    {!! Form::close() !!}
    
	
			</div>	
		</div>
	</div>
</div>
@endsection	
