{{-- */use repositories\CommonRepository;/* --}}
@extends('admin.layout')
@section('title')
	 Query Details	
@endsection
@section('heading')
	 Query Details
@endsection
@section('content')
    <section class="content">
<div class="row">
				<div class="col-md-9">
<div class="box">
               <div class="portlet-body flip-scroll">
					@include('errors.user_error')
					<div class="box-header" style="font-weight:bold">
					
					{!! Form::button('Reply User', ['class' => 'btn blue pull-right','style'=>'float:right;', 'data-target'=>"#editModal", 'data-toggle'=>'modal']) !!}
                </div>
            <div class="portlet box ">
						
						<div class="portlet-body">
        
           
            <div class="row">
                <div class="col-md-12">
								<!-- BEGIN PORTLET -->
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase">{{$contactData->name}} Detail</span>
						</div>
										
					</div>
					<div class="portlet-body">
										
							<div class="col-md-6">
								<div class="general-item-list">
									
									<div class="item">
										<div class="item-head">
											<div class="item-details">
											Product</div>
										</div>
										<div class="item-body">
										{{$contactData->products->name}}
										</div>
									</div>

									<div class="item">
										<div class="item-head">
											<div class="item-details">
											Name</div>
										</div>
										<div class="item-body">
										{{$contactData->name}}
										</div>
									</div>
									<div class="item">
										<div class="item-head">
											<div class="item-details">
												</i> Email
											</div>
										</div>
										<div class="item-body">
											{{$contactData->email}}
										</div>
									</div>
									<div class="item">
										<div class="item-head">
											<div class="item-details">
											Address</div>
										</div>
										<div class="item-body">
										{{$contactData->address}}
										</div>
									</div>
									<div class="item">
										<div class="item-head">
											<div class="item-details">
											City</div>
										</div>
										<div class="item-body">
										{{$contactData->city}}
										</div>
									</div>
									<div class="item">
										<div class="item-head">
											<div class="item-details">
											State</div>
										</div>
										<div class="item-body">
										{{$contactData->state}}
										</div>
									</div>
									<div class="item">
										<div class="item-head">
											<div class="item-details">
												</i> Zip
											</div>
										</div>
										<div class="item-body">
											{{$contactData->zip}}
										</div>
									</div>
									<div class="item">
										<div class="item-head">
											<div class="item-details">
												</i> Contact Number
											</div>
										</div>
										<div class="item-body">
											{{$contactData->number}}
										</div>
									</div>
									<div class="item">
										<div class="item-head">
											<div class="item-details">
												</i> Comment
											</div>
										</div>
										<div class="item-body">
											{{$contactData->comment}}
										</div>
									</div>
									
									<div class="item">
										<div class="item-head">
											<div class="item-details">
												</i> Message
											</div>
										</div>
										<div class="item-body">
											{{$contactData->message}}
										</div>
									</div>
								</div>
							</div>
						</div>				
					</div>
				</div>
			</div>
     </div>
 <!-- END PAGE CONTENT-->
</div>
</div>
      
        <?php $contactData_id=Crypt::encrypt($contactData->id);?>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="editModalLabel">
	
	<div class="modal-dialog" role="document" id="main">
		<div class="modal-content">
			<div class="modal-header ">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Reply Query</h4>
			</div>
			{!! Form::model($contactData,['method' => 'PATCH','url' => 'admin/contact/'.$contactData_id,'id'=>'ReplyForm']) !!}
			<div class="modal-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="userid" value="{{ $contactData_id }}">
				<div class="form-group has-feedback ">
				<label name="email">Email:</label>
					<input type="text" name="email" readonly="readonly" id="user_email" class="form-control"  value="{{ $contactData->email }}"/>
					<li for="email" class="email_error" style="list-style:none; color:red"></li>
				</div>
				<div class="form-group has-feedback element">
			 <label name="email">Message:</label>
					<textarea name="message" rows="5" id="message"  class="form-control" ></textarea>
					<span class="form_error" style="color:red"></span>
               </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="button" id="send_message"  value="Submit" class="btn btn-primary"  ></button>
			<!--<input type="button" id="registerquery" value="Submit" >--->
			</div>
			<input type="hidden" name="reply" value="1">
			{!! Form::close() !!}
		</div>
	</div>
</div>
</div>
</div>
</div>
</div>
</section>
@endsection
@section('css')
<style>
.error{
	display: block;
	}
</style>
@endsection
@section('js')
<script type="text/javascript">
	
$(document).on('click','#send_message',function(e){
	addLoaders('.modal-content ');
e.preventDefault();
//runLoader('#main');
var formData = $("#ReplyForm").serialize();
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
 $.ajax({
			url : 'http://capitolsheds.debutinfotech.com/admin/contact/update',
			   type:'post',
			   data : formData,
			   dataType : 'json',
			   success : function(data){
				   removeLoaders('.modal-content');
				  // stopLoader("#main");
				   if(data.success == 'true'){
						$('#editModal').modal('hide');	
						$('#ReplyForm')[0].reset();	
						$('.close').click();	
						showSuccessMessage("your message has been send successfully");
					}
				},
			    error : function(data){
					removeLoaders('.modal-content');
					// stopLoader("#main"); 
					if(data.responseJSON){
						var err_response = data.responseJSON;
						
                        $(".error").hide();
						$.each(err_response, function(i, obj)
						{
						$('textarea[name='+i+']').parent('.element').find('span.form_error').slideDown(400).html(obj);
						});	
					  }
			        } 
			});
	   });
</script>
@endsection
