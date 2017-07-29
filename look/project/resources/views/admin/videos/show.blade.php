{{-- */use App\Settings;/* --}}
@extends('admin.layout')
@section('title')
	 Testimonial
@endsection
@section('heading')
	Testimonial
@endsection
@section('content')
   
       
          
          	    <!-- BEGIN CONTENT -->
    <div class="portlet box ">
						
						<div class="portlet-body">
        
           
            <div class="row">
                <div class="col-md-12">
								<!-- BEGIN PORTLET -->
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase">{{$toot->employee_name}} Client</span>
						</div>
										
					</div>
					<div class="portlet-body">
										
							<div class="col-md-6">
								<div class="general-item-list">

									<div class="item">
										<div class="item-head">
											<div class="item-details">
												<i class="icon-user"></i> Name									</div>
										</div>
										<div class="item-body">
										{{$toot->employee_name}}
										</div>
									</div>
									<div class="item">
										<div class="item-head">
											<div class="item-details">
												<i class="icon-call-end"></i> Description
											</div>
										</div>
										<div class="item-body">
											{{$toot->description}}
										</div>
									</div>
								</div>
							</div>						
							<div class="col-md-6">
								<div class="general-item-list">
									<div class="item">
										<div class="item-head">
											<div class="item-details">
												<i class="icon-envelope-open"></i> 
												Designation			
											</div>
															
										</div>
										<div class="item-body">
											{{$toot->employee_designation}}
										</div>
									</div>
									<div class="item">
										<div class="item-head">
											<div class="item-details">
												<i class="fa fa-building-o"></i> 
												Location				
											</div>
															
										</div>
										<div class="item-body">
											<?php $loc = Settings::where('id', $toot->loc_id)->pluck('value'); ?>
											{{$loc}}
										</div>
									</div>
								</div>
							</div>
							
							
							
							
							
							
							<div class="col-md-6">
								<div class="general-item-list">
							
							<div class="item">
										<div class="item-head">
											<div class="item-details">
												<i class="fa fa-building-o"></i> 
												Image				
											</div>
															
										</div>
										<div class="item-body">
											@if ($toot->image)
						<img src="{{ asset('uploads/' . $toot->image) }}" style="height:100px;" style="width:100px;" />
						
						@endif
												</div>
											</div>
										</div>
									</div>
							
						
										
					</div>
				</div>
								<!-- END PORTLET -->
			</div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
        </div>
          
          
          
@endsection	
