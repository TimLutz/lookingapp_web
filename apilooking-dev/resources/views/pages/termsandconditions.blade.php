@extends('pages.cmslayout') 
@section('content')
	<?php echo htmlspecialchars_decode($content->content); ?>
@endsection