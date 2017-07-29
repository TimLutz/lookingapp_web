{{-- */use App\Property;/* --}}
{{-- */use App\PropertyAttribute;/* --}}
{{-- */use App\User;/* --}}

@extends('admin.layout')
@section('title')
	 View Property Detail
@endsection
@section('heading')
	 View Property Detail
@endsection



@section('content')
   
      
       <div class="page-bar">
		   <?php 	$userId = \Crypt::encrypt($property->id);
		    $userdata = User::where('id',$property->user_id)->first();
			 $usertype =  $userdata->type; ?>
			@if($usertype == 2)
		   <a href="{{url('/'.getenv('adminurl').'/properties/edit/'.$userId)}}" class="btn blue btn-sm pull-right">Edit Property</a>
		   @endif
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="{{ url(getenv('adminurl')) }}">Dashboard</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="{{ url(getenv('adminurl').'/properties') }}">Properties</a>
		</li>
	</ul>
	
</div>
          
          	    <!-- BEGIN CONTENT -->
          	  <div class="tab-pane" id="tab_3">
   <div class="portlet box blue">
	   <div class="portlet-title">
		<div class="caption">
		<i class="fa fa-gift"></i>Property's Info
		</div>
		</div>
						
						<div class="portlet-body form">
        
           
											<!-- BEGIN FORM-->
											<form class="form-horizontal" role="form">
												<div class="form-body">
													
												<?php $username = User::where('id',$property->user_id)->pluck('name');?>
												
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-5">Owner:</label>
																<div class="col-md-7">
																	<p class="form-control-static">
																		{{ $username }}
																	</p>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-5">Property Name:</label>
																<div class="col-md-7">
																	<p class="form-control-static">
																		{{ $property->property_name }}
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
																<label class="control-label col-md-5">Property Address:</label>
																<div class="col-md-7">
																	<p class="form-control-static">
																		{{ $property->property_address }}
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-5">Rooms:</label>
																<div class="col-md-7">
																	<p class="form-control-static">
																		<?php $prop_attrs = $property->property_attributes()->get();
																		?>
																		<?php  $countall = count($prop_attrs); ?>
																		@foreach($prop_attrs as $key=>$attribute)
																		{{$attribute->attribute_name}}@if($key+1 < $countall), @else @endif
																		@endforeach
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
