@extends('admin.layout')
@section('title')
	Add New User
@endsection
@section('heading')
	Add New User
@endsection
@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-body">
		
				
	{!! Form::model(['method' => 'POST','url' => 'admin/dashboard/add-new-user']) !!}
		@include('admin.user.userform',['submitButtonText' => 'Add User'])
		{!! Form::hidden('action','add') !!}
    {!! Form::close() !!}
			</div>	
		</div>
	</div>
</div>
@endsection	
