@extends('admin.layout')
@section('title')
	Create Template		
@endsection
@section('css')
<link href="{{ asset('/css/editor.css') }}" type="text/css" rel="stylesheet"/>
@endsection
@section('heading')
	Create Template	
@endsection
@section('content')
<div class="row">	
    
	<div class="col-md-9">
	@include('errors.user_error')
	@include('flash::message')
	<div class="portlet box">
    <div class="portlet-body">
    {!! Form::model($template = new App\EmailTemplate,['id' => 'add_template','url' => 'admin/template']) !!}				
    @include('admin.template.form')
	
			<div class="form-group">
			<a href="{{ url('admin/template') }}" class="btn btn-danger">Back</a>
				{!! Form::submit('Add Template', ['class' => 'btn btn-primary']) !!}
			</div>
			
</div></div></div>
	<div class="col-md-3">
	<div class="box box-primary">
		<div class="box-body">
				<div class="input_fields_wrap">
					{!! Form::button('Add More Attributes', ['id' => 'add_field_button','class' => 'btn btn-primary form-control']) !!}
					<div><br>
				<!--	{!! Form::text('variable[]',null,['class' => 'field']) !!} -->
					</div>
				</div>
			
			
	
</div>
		</div>
	</div>	
{!! Form::close() !!}	
</div>  	
@endsection
@section('js')
<script type="text/javascript">
	$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $("#add_field_button"); //Add button ID
    
    var x = 1; //initial text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" class="field" name="variable[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
	</script>
<!----  Editor JS  ---->
<script src="{{ asset('/js/editor.js') }}"></script>
<script src="{{ asset('assets/dist/js/editor.js') }}" type="text/javascript"></script>
@endsection
