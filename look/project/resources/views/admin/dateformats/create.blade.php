@extends('admin.layout')
@section('css')

<link href="{{ asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('css/timepicker/timepicker.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('title')
	Add Date Format
@endsection
@section('heading')
	Add Date Format
@endsection
@section('content')

	@include('errors.user_error')
					@include('flash::message')
<div class="tab-pane" id="tab_1">
								<div class="portlet box blue">
									<div class="portlet-title">
<!--
										<div class="caption">
											<i class="fa fa-gift"></i>Add Date format
										</div>
-->
			</div>
<div class="portlet-body form">
				@include('errors.user_error')
				
	{!! Form::open(array('method' => 'POST','url' => '/'.getenv('adminurl').'/timeslot/create-date','files' => 'true','id'=>'addusers')) !!}
		@include('admin.dateformats.form',['submitButtonText' => 'Add'])
	{!! Form::hidden('action','add') !!}
		
    {!! Form::close() !!}
			</div>	
		</div>
	</div>

@endsection	
@section('js')

<script type="text/javascript" src="{{ asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
 <script type="text/javascript" src="{{ asset('js/timepicker/timepicker.js') }}"></script>
<script>
jQuery(document).ready(function() {     
	$('#adduserbutton').click(function(){
	 var formData = new FormData($('#addusers')[0]);
	
	$.ajax({
		dataType: 'json',
		method:'post',
		processData: false,
		contentType: false,
		url: path+'nimdaalf/timeslot/store',
		data: formData,
		beforeSend : function() {
			addLoader();
		},
		
		success  : function(data) {
			if(data.success == true){
				//alert('success');
				showSuccessMessage('Data Added Successfully.');
				$('#addusers')[0].reset();
				window.location = path+'nimdaalf/timeslot';
				
				
			}	
			else
			{		
				showErrorMessage('Data not Added.');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			removeLoader();
			
				$("#addusers .form-group").removeClass("has-error");
			$(".help-block").hide();
			$.each(xhr.responseJSON, function(i, obj)
				{
					$('input[name="'+i+'"]').closest('.form-group').addClass('has-error');
					$('input[name="'+i+'"]').closest('.form-group').find('label.help-block').slideDown(400).html(obj);
					$('textarea[name="'+i+'"]').closest('.form-group').addClass('has-error');
					$('textarea[name="'+i+'"]').closest('.form-group').find('label.help-block').slideDown(400).html(obj);
					$('file[name="'+i+'"]').closest('.form-group').addClass('has-error');
					$('file[name="'+i+'"]').closest('.form-group').find('label.help-block').slideDown(400).html(obj);
					
					
				});
					
			}
		
	});
	
	});
	
	
	/////////////////////    code for timepicker start    ////////////////////////////////
		   
		   $("#from_time").timepicker({
		'scrollDefault': 'now',
		'timeFormat': 'H:i',
		
	});
	
	
	$('#from_time').timepicker({
		'scrollDefault': 'now',
		'timeFormat': 'H:i',
		'step':15
	})
      .on('change', function(ev){
		
		 var tn =  $("#from_time").val();
	
	   //$('#to_time').timepicker('minTime', tn);  
	    $("#to_time").timepicker('option',{'minTime':tn});
	    $("#to_time").timepicker('option',{'maxTime':'00:00'});
		
		  });
	
	 $("#to_time").timepicker({
		'scrollDefault': 'now',
		'timeFormat': 'H:i',
		'step':15
	})
	.on('change', function(ev){
		
		 var tt =  $("#to_time").val();
	
	  
	    $("#from_time").timepicker('option',{'maxTime':tt});
	     $("#from_time").timepicker('option',{'minTime':'00:00'});
		
		  });
   ////////////////////    code for timepicker end    ////////////////////////////////////
});
</script>
@endsection	
