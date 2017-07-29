@extends('admin.layout')	
@section('title')
User Detail
@endsection
@section('heading')
	Users Details
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
											<span class="caption-subject font-blue-madison bold uppercase">Personal Information</span>
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
										{{ $users->name }} 
										</div>
									</div>
									<div class="item">
										<div class="item-head">
											<div class="item-details">
												@if($users->status == 1)<i class="glyphicon glyphicon-ok-sign"></i>@else<i class="glyphicon glyphicon-remove-sign"> </i> @endif Status
											</div>
										</div>
										<div class="item-body">
											@if($users->status == 1)Active @else InActive @endif
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
												Email			
											</div>
															
										</div>
										<div class="item-body">
											{{ $users->email }}
										</div>
									</div>
								
								</div>
							</div>
							<div class="col-md-6">
								<div class="general-item-list">
									<div class="item">
										<div class="item-head">
											<div class="item-details">
												<i class="glyphicon glyphicon-phone"></i> 
												Phone			
											</div>
															
										</div>
										<div class="item-body">
											{{ $users->phone }}
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
    
    <!-- END CONTENT -->


						
					
				

@endsection

