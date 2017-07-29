

{{-- */use App\User;/* --}}

@extends('admin.layout')
@section('title')
	 Client's Feedback
@endsection
@section('css')
<link href="{{ asset('css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/ratingtheme/krajee-svg/theme.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection
@section('heading')
	 Client's Feedback
@endsection
@section('content')
   
      
       <div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="{{ url(getenv('adminurl')) }}">Dashboard</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="{{ url(getenv('adminurl').'/tasks/index-feedback') }}">Client's Feedback</a>
		</li>
	</ul>
	
</div>
          
          	    <!-- BEGIN CONTENT -->
          	  <div class="tab-pane" id="tab_3">
   <div class="portlet box blue">
	   <div class="portlet-title">
		<div class="caption">
			<?php $requester = User::where('id',$detail->client_id)->first(); ?>
		<i class="fa fa-gift"></i>{{ $requester->name }}'s feedback
		</div>
		</div>
						
						<div class="portlet-body form">
        
           
											<!-- BEGIN FORM-->
											<form class="form-horizontal" role="form">
												<div class="form-body">
													
												
												
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Client Name:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		
																		{{ $requester->name }}
																			<input type="hidden" id="fb_name" name="fb_name" value="{{$requester->name}}"/>
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">User Type:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		<?php
																			if($requester->type == 1){
																				$typeclient = 'Realtor';
																			}
																			if($requester->type == 2){
																				$typeclient = 'Houseowner';
																			}
																			?>
																		{{ $typeclient }}
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
													
													<div class="row">
														
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Start Date:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																			
																		{{ $detail->start_datetime }}
																	</p>
																</div>
															</div>
														</div>
														
														
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">End Date:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		{{ $detail->end_datetime }}
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
													
													
														<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Task Name:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		{{ $detail->task_name }}
											 
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
													
												<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Technician Assigned:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		<?php
																		if(isset($detail->technician_id) && !empty($detail->technician_id)){
						
																				$techname = User::where('id',$detail->technician_id)->pluck('name');
																			}
																			else
																			{
																				$techname = 'Not Assigned';
																			}
																		 ?>
																		{{ $techname }}
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
														
														<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Rating:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		<input type="hidden" class="myrating rating-loading" value="{{ $detail->rating }}" data-readonly="true">
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
													
												<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Clients Comment:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																	{{ $detail->comments }}
																	<div id="fb_div">
															
																<input type="hidden" id="fb_message" name="fb_message" value="{{$detail->comments}}"/>
																<input type="button" value="Push to Fb"  id="pushtofb" />
</div>
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
													
													
													</div>
													</form>
													</div>
				</div>
								<!-- END PORTLET -->
			</div>
            </div>
           
        </div>
        </div>
         </div>
          
          
          
@endsection	
@section('js')

<script src="{{ asset('js/star-rating.js') }}" type="text/javascript"></script>
<script>
$(document).ready(function() {
	

	setTimeout(function(){ $(".myrating").rating({displayOnly:true});});
	
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1156601551097688',
      xfbml      : true,
    cookie     : true,  // enable cookies to allow the server to access 
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
  

	
	$("#pushtofb").click(function(){
		
		
    FB.login(function(response)
    {
        if (response.authResponse)
        {
     new PNotify({
									type: 'success',
									title: 'Success',
									text: ' Logged In',
								});
 
            // Post message to your wall
 
          fb_publish() ;
     
        }
        else
        {
            new PNotify({
									type: 'error',
									title: 'Error',
									text: ' Not Logged In',
								});
        }
    }, { scope : 'publish_stream' });

});
	
	
	
	var content = $("#fb_message").val();
	var fbname = $("#fb_name").val();
	
	
	 function fb_publish() {
     FB.ui(
      {
        method: 'feed',
        name: fbname,
        link: 'www.facebook.com',
        picture: 'http://fbrell.com/f8.jpg',
        caption: 'Client\' Review',
        description: content
    },
       function(response) {
         if (response && response.post_id) {
			  new PNotify({
									type: 'success',
									title: 'Success',
									text: ' Post was published.',
								});
         } else {
			  new PNotify({
									type: 'error',
									title: 'Error',
									text: ' Post was not published.',
								});
         }
       }
     );  
  }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
});
</script>
@endsection
