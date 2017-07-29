   <div class="form-group has-feedback">
   {!! Form::label('name', 'Name: ') !!} <span class="star">*</span>
	<input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" >
  </div>
  <div class="form-group has-feedback">
   {!! Form::label('phone', 'Phone: ') !!} <span class="star">*</span>
	<input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" >
  </div>
  
  <div class="form-group has-feedback">
  {!! Form::label('email', 'Email: ') !!} <span class="star">*</span>
	<input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" >
  </div>
  
  <div class="form-group has-feedback">
  {!! Form::label('password', 'Password: ') !!} <span class="star">*</span>
	<input type="password" name="password" id="password" class="form-control" />
  </div>
  
  
  <div class="form-group has-feedback">
  {!! Form::label('password_confirmation', 'Re-type Password: ') !!} <span class="star">*</span>
	<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" />
  </div>
		  
   
	
	<div class="box-footer"> 
	{!! Form::submit($submitButtonText, ['id'=>'submit','class' => 'btn btn-primary']) !!}   	
		<br> <br>
	</div><!-- /.col -->
</form>   
