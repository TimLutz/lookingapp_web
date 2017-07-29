{{-- */use App\Property;/* --}}
{{-- */use App\PropertyAttribute;/* --}}
{{-- */use App\User;/* --}}
{{-- */use Carbon\Carbon;/* --}}

@extends('admin.layout')
@section('title')
	 View General Note Detail
@endsection
@section('heading')
	 View General Note Detail
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
			<a href="{{ url(getenv('adminurl').'/notes') }}">General Notes</a>
		</li>
	</ul>
	
</div>
          
          	    <!-- BEGIN CONTENT -->
          	  <div class="tab-pane" id="tab_3">
   <div class="portlet box blue">
	   <div class="portlet-title">
		<div class="caption">
		<i class="fa fa-gift"></i>General Note's Info
		</div>
		</div>
						
						<div class="portlet-body form">
        
           
											<!-- BEGIN FORM-->
											<form class="form-horizontal" role="form">
												<div class="form-body">
													
												<?php
												$userdata = User::where('id',$notes->user_id)->first();
												$username = $userdata->name;
												$usertype =  $userdata->type;
												if($usertype == 1){
													$typeuser = 'Realtor';
												}
												if($usertype == 2){
													$typeuser = 'Houseowner';
												}
												?>
												
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">User:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		{{ $username }}
																	</p>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">User Type:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		{{ $typeuser }}
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
														
														<!--/span-->
													</div>
													
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Title:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		{{ $notes->title }}
																	</p>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Notes:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		{{ $notes->client_notes }}
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
														
														<!--/span-->
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Note Date:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		<?php $notedate = Carbon::parse($notes->created_at);
																		?>
																		{{$notedate->format('Y-m-d')}}
																	
																	</p>
																</div>
															</div>
														</div>
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
