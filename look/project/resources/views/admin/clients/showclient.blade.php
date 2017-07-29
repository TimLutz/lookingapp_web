

@extends('admin.layout')
@section('title')
	 View {{$client}} Detail
@endsection
@section('heading')
	 View {{$client}} Detail
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
			@if($client == 'Realtor')
			<a href="{{ url(getenv('adminurl').'/users') }}">Realtors</a>
			@else
			<a href="{{ url(getenv('adminurl').'/users/index-house') }}">Houseowners</a>
			@endif
		</li>
	</ul>
	
</div>
          
          	    <!-- BEGIN CONTENT -->
          	  <div class="tab-pane" id="tab_3">
   <div class="portlet box blue">
	   <div class="portlet-title">
		<div class="caption">
		<i class="fa fa-gift"></i>{{$client}}'s Info
		</div>
		</div>
						
						<div class="portlet-body form">
        
           
											<!-- BEGIN FORM-->
											<form class="form-horizontal" role="form">
												<div class="form-body">
													
												
												
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Name:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		{{ $detail->name }}
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Email:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		{{ $detail->email }}
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
													
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Phone:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		{{ $detail->phone }}
											 
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Address:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		{{ $detail->address }}
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
													
													@if(isset($detail->photo) && ($detail->photo)!='')
														<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Image:</label>
																<div class="col-md-9">
																	<p class="form-control-static">
																		<img src="{{ url($detail->photo) }}" alt="100%x180" style="height: 100px; width: 150px; display: block;">
																	</p>
																</div>
															</div>
														</div>
														<!--/span-->
													
														<!--/span-->
													</div>
													@endif
													
													
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
