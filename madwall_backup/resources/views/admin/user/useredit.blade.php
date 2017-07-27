   <div class="form-group has-feedback">
   {!! Form::label('name', 'Name: ') !!} <span class="star">*</span>
   {!! Form::text('name',null,['class' => 'form-control','size' => '5x2']) !!}
	
  </div>
  <div class="form-group has-feedback">
   {!! Form::label('phone', 'Phone: ') !!} <span class="star">*</span>
	 {!! Form::text('phone',null,['class' => 'form-control','size' => '5x2']) !!}
  </div>
  
  
  <div class="form-group has-feedback">
  {!! Form::label('email', 'Email: ') !!} <span class="star">*</span>
  {!! Form::text('email',null,['class' => 'form-control','size' => '5x2','readonly']) !!}
	
  </div>
  
 
@include('partials.status', ['status' => $user->status])
 
		  
   
	
	<div class="box-footer"> 
	{!! Form::submit($submitButtonText, ['id'=>'submit','class' => 'btn btn-primary']) !!}   	
		<br> <br>
	</div><!-- /.col -->
</form>   
