

{{-- */use App\User;/* --}}
{{-- */use App\Property;/* --}}
{{-- */use App\PropertyAttribute;/* --}}
@extends('admin.layout')
@section('title')
	 View Technician Task Detail
@endsection
@section('heading')
	 View Technician Task Detail
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
			<a href="{{ url(getenv('adminurl').'/tasks/index-techtask') }}">Technician Tasks</a>
		</li>
	</ul>
	
</div>
          
          	    <!-- BEGIN CONTENT -->
          	  <div class="tab-pane" id="tab_3">
   <div class="portlet box blue">
	   <div class="portlet-title">
		<div class="caption">
		<i class="fa fa-gift"></i>Technician Task's Detail
		</div>
		</div>
						
						<div class="portlet-body form">
        
           
											<!-- BEGIN FORM-->
											<form class="form-horizontal" role="form">
												<div class="form-body">
													
												
												
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-5">Requested By:</label>
																<div class="col-md-7">
																	<p class="form-control-static">
																		<?php $requester = User::where('id',$detail->client_id)->first(); ?>
																		{{ $requester->name }}
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-5">User Type:</label>
																<div class="col-md-7">
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
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-5">Note Details:</label>
																<div class="col-md-7">
																	<p class="form-control-static">
																		{{ $detail->note_detail }}
											 
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-5">Priority:</label>
																<div class="col-md-7">
																	<p class="form-control-static">
																			<?php 
																			switch($detail->priority){
																			case 1:
																			$priority = 'High';
																			break;
																			case 2:
																			$priority = 'Medium';
																			break;
																			case 3:
																			$priority = 'Low';
																			break;
																			default:
																			$priority = 'Low';
																			}
																			?>
																		{{ $priority }}
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
													
													
														<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-5">Files Attached:</label>
																<div class="col-md-7">
																	<p class="form-control-static">
																		
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
													
													<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-5">Task Requested Date:</label>
																<div class="col-md-7">
																	<p class="form-control-static">
																		{{ $detail->assigned_date }}
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
														
														<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-5">Technician Assigned:</label>
																<div class="col-md-7">
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
														
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-5">Property Address:</label>
																<div class="col-md-7">
																	<p class="form-control-static">
																		<?php $prop = Property::where('id',$detail->property_id)->first();
																		$attribute = PropertyAttribute::where('id',$detail->attribute_id)->first();?>
																		{{ $prop->property_address }}
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
													
													
													
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-5">Property Name :</label>
																<div class="col-md-7">
																	<p class="form-control-static">
																		{{ $prop->property_name }}
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-5">Attribute Name :</label>
																<div class="col-md-7">
																	<p class="form-control-static">
																		@if(isset($attribute) && !empty($attribute))
																		{{ $attribute->attribute_name }}
																		@endif
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
