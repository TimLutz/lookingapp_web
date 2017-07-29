@extends('admin.layout')
@section('title')
	 Manage Fuel Charges	
@endsection
@section('heading')
	Manage Fuel Charges
@endsection
@section('content')
	<div class="portlet box">
    <div class="portlet-body col-md-6">
    	@include('errors.user_error')
    	@include('flash::message')
        <div class="form-group">
            
        {!! Form::model($charges,['method' => 'post','id'=>'add_template','url' => 'admin/charges/updatecharges']) !!}
            {!! Form::label('charges', 'Charges: ') !!} <span class="star">*</span>
            <input type="text" name="charges" id="charges" value="<?php if(isset($charges->charges) && $charges->charges != ''){ echo $charges->charges; } else { echo '0'; } ?>" class="form-control">
        </div>
    
        
    
        <div class="form-group">
            {!! Form::submit('Update Charges',['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</div>
@endsection
