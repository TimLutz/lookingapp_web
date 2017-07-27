@extends('layout')
@section('title')
Error
@stop
@section('content')
<div class="container">
		<br><br><br><br><br><br><br><br>
			<h4><b><span style="color:red">ERROR:</span> {{ $exception_message_front }}</b></h4>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	</div>
@stop
