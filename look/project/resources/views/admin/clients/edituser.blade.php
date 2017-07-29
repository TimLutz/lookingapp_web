@extends('admin.layout')
@section('title')
	Edit User
@endsection
@section('heading')
	Edit User
@endsection
@section('content')
<div class="tab-pane" id="tab_1">
	<div class="portlet box blue">
			<div class="portlet-title">
				 @if($type == '1')
    <?php $typeuser = 'Realtor'; ?>  
    @endif
    @if($type == '2')
  <?php $typeuser = 'House Owner'; ?>  
    @endif
    @if($type == '4')
  <?php $typeuser = 'Both'; ?>  
    @endif
										<div class="caption">
											<i class="fa fa-gift"></i>Update {{$typeuser}}
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
				@include('flash::message')
    {!! Form::model($user,['method' => 'POST','url' => '/'.getenv('adminurl').'/users/updateuser/'.Crypt::encrypt($user->id),'files' => 'true','id'=>'editusers']) !!}
   
    @include('admin.clients.userform',['submitButtonText' => 'Update '.$typeuser])
    {!! Form::hidden('action','edit') !!}
    <?php $idedit = Crypt::encrypt($user->id); ?>
    
     {!! Form::hidden('idedit',$idedit) !!}
    {!! Form::close() !!}
    	</div>	
		</div>
	</div>
	
	
@endsection	

@section('js')
<script src="{{ asset('js/jquery.maskedinput.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
     	$("#phone").mask("999-999-9999");
    </script>
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
		url: path+'nimdaalf/users/update-user/'+id,
		data: formData,
		beforeSend : function() {
			addLoader();
		},
		
		success  : function(data) {
			if(data.success == true){
				//alert('success');
				showSuccessMessage('Data Updated Successfully.');
				$('#editusers')[0].reset();
				if(data.clienttype == 'realtor'){
						window.location = path+'nimdaalf/users';
				}
				else if(data.clienttype == 'houseowner'){
					window.location = path+'nimdaalf/users/index-house';
				}
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
