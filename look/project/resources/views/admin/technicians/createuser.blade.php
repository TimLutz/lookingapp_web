@extends('admin.layout')
@section('title')
	Add Technician
@endsection
@section('heading')
	Add Technician
@endsection
@section('content')

	@include('errors.user_error')
					@include('flash::message')
<div class="tab-pane" id="tab_1">
								<div class="portlet box blue">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-gift"></i>Add Technician
										</div>
			</div>
<div class="portlet-body form">
				@include('errors.user_error')
				
	{!! Form::open(array('method' => 'POST','url' => '/'.getenv('adminurl').'/users/create-technician','files' => 'true','id'=>'addusers')) !!}
		@include('admin.technicians.userform',['submitButtonText' => 'Add Technician'])
	
		
    {!! Form::close() !!}
			</div>	
		</div>
	</div>

@endsection	
@section('js')
<script>
jQuery(document).ready(function() {     
	$('#adduserbutton').click(function(){
	 var formData = new FormData($('#addusers')[0]);
	
	$.ajax({
		dataType: 'json',
		method:'post',
		processData: false,
		contentType: false,
		url: path+'nimdaalf/users/create-technician',
		data: formData,
		beforeSend : function() {
			addLoader();
		},
		
		success  : function(data) {
			if(data.success == true){
				//alert('success');
				showSuccessMessage('Data Added Successfully.');
				$('#addusers')[0].reset();
				window.location = path+'nimdaalf/users/index-technician';
				
				
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
});
</script>
@endsection	
