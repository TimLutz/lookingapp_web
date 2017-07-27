@extends('admin.layout')
@section('css')
<link href="{{ asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('css/timepicker/timepicker.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('title')
	Edit Timeslot
@endsection
@section('heading')
	Edit Timeslot
@endsection
@section('content')
<div class="tab-pane" id="tab_1">
	<div class="portlet box blue">
			<div class="portlet-title">
				
<!--
										<div class="caption">
											<i class="fa fa-gift"></i>Update Timeslot
										</div>
-->

									</div>
									<div class="portlet-body form">
				@include('errors.user_error')
				@include('flash::message')
    {!! Form::model($timeslot,['method' => 'POST','url' => '/'.getenv('adminurl').'/timeslot/update/'.Crypt::encrypt($timeslot->id),'files' => 'true','id'=>'edittimeslot']) !!}
    <?php $id = Crypt::encrypt($timeslot->id); 
    $from = $timeslot->from;
     $to = $timeslot->to;
    ?>
   
    @include('admin.dateformats.form',['submitButtonText' => 'Update'])
    {!! Form::hidden('action','edit') !!}
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
	 var formData = new FormData($('#edittimeslot')[0]);
	var id = "<?php echo $id; ?>";
	$.ajax({
		dataType: 'json',
		method:'post',
		processData: false,
		contentType: false,
		url: path+'nimdaalf/timeslot/update/'+id,
		data: formData,
		beforeSend : function() {
			addLoader();
		},
		
		success  : function(data) {
			if(data.success == true){
				
				window.location = path+'nimdaalf/timeslot';
			
			}	
			else
			{		
				showErrorMessage('Data not Updated.');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			removeLoader();
			
				$("#edittimeslot .form-group").removeClass("has-error");
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
		   
		   
		   //~ var strtime = "<?php echo $from; ?>";
		    //~ var entime = "<?php echo $to; ?>";
		    //~ console.log(strtime);
		    //~ $("#to_time").timepicker('option',{'minTime':strtime});
	       //~ $("#to_time").timepicker('option',{'maxTime':'00:00'});
		    //~ $("#from_time").timepicker('option',{'maxTime':entime});
	     //~ $("#from_time").timepicker('option',{'minTime':'00:00'});
		   
		   
		   
		   
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
