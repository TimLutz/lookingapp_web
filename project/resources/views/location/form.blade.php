<div class="form-group @if ($errors->has('contact_name')) has-error @endif">
	{!! Form::label('contact person','Contact Person') !!}
	{!! Form::text('contact_name',null,['class'=>'form-control','placeholder'=>'Enter contact detail']) !!}
	@if ($errors->has('contact_name')) <p class="help-block">{{ $errors->first('contact_name') }}</p> @endif
</div>
<div class="form-group">
	<div class="col-md-12">
		
		{!! Form::label('location detail','Location Detail') !!}
	</div>
	<div class="col-md-6 @if ($errors->has('street_no')) has-error @endif">
		{!! Form::text('street_no',null,['class'=>'form-control','placeholder'=>'Enter street no']) !!}	
		@if ($errors->has('street_no')) <p class="help-block">{{ $errors->first('street_no') }}</p> @endif
	</div>
	<div class="col-md-6 @if ($errors->has('street_name')) has-error @endif">
		{!! Form::text('street_name',null,['class'=>'form-control','placeholder'=>'Enter street name','id'=>'street_name']) !!}
		@if ($errors->has('street_name')) <p class="help-block">{{ $errors->first('street_name') }}</p> @endif
	</div>
</div>
<div class="from-group @if ($errors->has('email')) has-error @endif">
	{!! Form::label('email','Email') !!}
	{!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Enter Email']) !!}
	@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
</div>
<div class="from-group @if ($errors->has('mobile')) has-error @endif">
	{!! Form::label('mobile number','Mobile Number') !!}
	{!! Form::text('mobile',null,['class'=>'form-control','placeholder'=>'Enter mobile']) !!}
	@if ($errors->has('mobile')) <p class="help-block">{{ $errors->first('mobile') }}</p> @endif
</div>
<div class="form-group @if ($errors->has('note')) has-error @endif">
	{!! Form::label('notes','Notes') !!}
	{!! Form::textarea('note',null,['class'=>'form-control','placeholder'=>'Enter location']) !!}
	@if ($errors->has('note')) <p class="help-block">{{ $errors->first('note') }}</p> @endif
</div>
<div class="form-group">
	<input type="checkbox" name="pick_loc" id="pick_loc" <?php if(isset($locations->pick_loc) && ($locations->pick_loc == '1')){ echo 'checked=checked'; } ?>> Set as default pickup location
</div>
<div class="form-group">
	<input type="checkbox" name="drop_loc" id="drop_loc" <?php if(isset($locations->drop_loc) && ($locations->drop_loc == '1')){ echo 'checked=checked'; } ?>> Set as default dropof location
</div>

@section('js')
	<script>
      $(function(){
        $("#street_name").geocomplete({
           details: ".pickLocation",
           types: ["geocode", "establishment"],
        });
      });

      
    </script>
@endsection

