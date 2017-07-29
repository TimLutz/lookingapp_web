@extends('admin.layout')
@section('title')
	Add {{$typeuser}}
@endsection
@section('heading')
	Add User
@endsection
@section('content')
<div class="tab-pane" id="tab_1">
								<div class="portlet box blue">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-gift"></i>Add User
										</div>
<!--
										<div class="tools">
											<a href="javascript:;" class="collapse">
											</a>
											<a href="#portlet-config" data-toggle="modal" class="config">
											</a>
											<a href="javascript:;" class="reload">
											</a>
											<a href="javascript:;" class="remove">
											</a>
										</div>
-->
									</div>
<div class="portlet-body form">
				@include('errors.user_error')
				
	{!! Form::open(array('method' => 'POST','url' => '/'.getenv('adminurl').'/users/create-user','files' => 'true','id'=>'addusers')) !!}
		@include('admin.clients.userform',['submitButtonText' => 'Add User'])
		
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
		url: path+'nimdaalf/users/create-user',
		data: formData,
		beforeSend : function() {
			addLoader();
		},
		
		success  : function(data) {
			if(data.success == true){
				//alert('success');
				showSuccessMessage('Data Added Successfully.');
				$('#addusers')[0].reset();
				if(data.clienttype == 'realtor'){
						window.location = path+'nimdaalf/users';
				}
				else if(data.clienttype == 'houseowner'){
					window.location = path+'nimdaalf/users/index-house';
				}
				
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
					if(i=='type'){
						$('.type').addClass('has-error');
						$('.type').find('label.help-block').slideDown(400).html(obj);
					}
					
				});
					
			}
		
	});
	
	});
});

</script>
<script src="{{ asset('js/jquery.maskedinput.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
     	$("#phone").mask("999-999-9999");
    </script>
@endsection	
