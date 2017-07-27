@extends('admin.layout')
@section('title')
Error
@stop
@section('content')
                		
	<div class="container">
		<br><br>
			<h4><b><span style="color:red">ERROR:</span> {{ $exception_message }}</b></h4>
		<br><br>
	</div>
		

@stop