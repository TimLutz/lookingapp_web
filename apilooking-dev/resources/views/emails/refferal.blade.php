@extends('emails.template') 
@section('content')
<?php echo htmlspecialchars_decode($content); ?>
@stop