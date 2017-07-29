

{{-- */use App\User;/* --}}
{{-- */use App\Property;/* --}}
{{-- */use App\PropertyAttribute;/* --}}
{{-- */use Carbon\Carbon;/* --}}

@extends('admin.layout')
@section('title')
	 View Task Detail
@endsection
@section('heading')
	 View Task Detail
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
			<a href="{{ url(getenv('adminurl').'/tasks') }}">Tasks</a>
		</li>
	</ul>
	
</div>
          
          	    <!-- BEGIN CONTENT -->
          	  <div class="tab-pane" id="tab_3">
   <div class="portlet box blue">
	   <div class="portlet-title">
		<div class="caption">
		<i class="fa fa-gift"></i>Task's Detail
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
																<label class="control-label col-md-5">Email:</label>
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
																		{{ $requester->email }}
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
																<label class="control-label col-md-5">Client Type:</label>
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
																			$priority = NA;
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
																		<?php $countdocs = count($documents); ?>
																		@foreach($documents as $key=>$document)
																		<?php $number = $key+1;?>
																		
																		<a href="{{ $document->filename }}" download>File {{$number}}</a>@if($number < $countdocs),@endif


																		@endforeach
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
													
													<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-5">Requested Date & Time:</label>
																<div class="col-md-7">
																	<p class="form-control-static">
																		<?php 
																		$start = Carbon::parse($detail->start_datetime);
																		$end = Carbon::parse($detail->end_datetime);
																		
																			//####
																			if($start->format('Y-m-d') == '-0001-11-30'){
																			$startdate = 'NA';
																			}
																			else{
																			$startdate = $start->format('Y-m-d');
																			}
																			//###
																			if($start->format('H:i:s') == '00:00:00'){
																			$starttime = 'NA';
																			}
																			else{
																			$starttime = $start->format('H:i:s');
																			}
																			
																			//###
																			if($end->format('H:i:s') == '00:00:00'){
																			$endtime = 'NA';
																			}
																			else{
																			$endtime = $start->format('H:i:s');
																			}
																		?>
																		{{$startdate}}({{$starttime}}-{{$endtime}})
<!--
																		@if($detail->assigned_date == '0000-00-00')
																		NA
																		@else
																		{{ $detail->assigned_date }}
																		@endif
-->
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
																		@if(isset($prop->property_address) && !empty($prop->property_address))
																		{{ $prop->property_address }}
																		@else
																		@endif
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
														<!--/span-->
														
														
														
														
														<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-5">Property Name :</label>
																<div class="col-md-7">
																	<p class="form-control-static">
																		@if(isset($prop->property_name) && !empty($prop->property_name))
																		{{ $prop->property_name }}
																		@else
																		@endif
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
