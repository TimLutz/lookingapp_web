@extends('admin.layout')
@section('title')
	Edit Technician
@endsection
@section('heading')
	Edit Technician
@endsection
@section('content')
<div class="tab-pane" id="tab_1">
	<div class="portlet box blue">
			<div class="portlet-title">
				
										<div class="caption">
											<i class="fa fa-gift"></i>Update Technician
										</div>

									</div>
									<div class="portlet-body form">
				@include('errors.user_error')
				@include('flash::message')
    {!! Form::model($user,['method' => 'POST','url' => '/'.getenv('adminurl').'/users/update-technician/'.Crypt::encrypt($user->id),'files' => 'true','id'=>'editusers']) !!}
   
    @include('admin.technicians.userform',['submitButtonText' => 'Update Technician'])
    {!! Form::hidden('action','edit') !!}
     <?php $idedit = Crypt::encrypt($user->id); ?>
     {!! Form::hidden('idedit',$idedit) !!}
    {!! Form::close() !!}
    	</div>	
		</div>
	</div>
	
	
@endsection	

@section('js')
<script>
jQuery(document).ready(function() {     
	$('#adduserbutton').click(function(){
	 var formData = new FormData($('#editusers')[0]);
	var id = "<?php echo $id; ?>";
	$.ajax({
		dataType: 'json',
		method:'post',
		processData: false,
		contentType: false,
		url: path+'nimdaalf/users/update-technician/'+id,
		data: formData,
		beforeSend : function() {
			addLoader();
		},
		
		success  : function(data) {
			if(data.success == true){
				//alert('success');
				showSuccessMessage('Data Updated Successfully.');
				$('#editusers')[0].reset();
				
				window.location = path+'nimdaalf/users/index-technician';
			
			}	
			else
			{		
				showErrorMessage('Data not Updated.');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			removeLoader();
			
				$("#editusers .form-group").removeClass("has-error");
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
