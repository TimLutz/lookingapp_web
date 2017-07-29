@extends('admin.layout')
@section('title')
	 Quote List		
@endsection
@section('heading')
	Quote Me
	
@endsection
@section('content')
<div class="portlet box ">

	<div class="portlet-body">
		<div class="row">
			<div class="col-md-12">
<!-- BEGIN PORTLET -->
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject font-blue-madison bold uppercase">Quote Me
								</span>
						</div>
					</div>
					<div class="portlet-body">
						<div class="col-md-6">
							<div class="general-item-list">
								<div class="item">
									<div class="item-head">
										<div class="item-details">
											<i class="icon-user"></i> 
											Pick Up
										</div>
									</div>
									<div class="item-body">
										{{ $quote->pick_location }}
									</div>
								</div>
								<div class="item">
									<div class="item-head">
										<div class="item-details">
											<i class="icon-call-end"></i> Email
										</div>
									</div>
									<div class="item-body">
										{{ $quote->email }}
									</div>
								</div>
								<div class="item">
									<div class="item-head">
										<div class="item-details">
											<i class="icon-call-end"></i> Mode of Delivery
										</div>
									</div>
									<div class="item-body">
										{{ $quote->mode_type }}
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
											Drop Off			
										</div>
									</div>
									<div class="item-body">
										{{ $quote->drop_location }}
									</div>
								</div>
								<div class="item">
									<div class="item-head">
										<div class="item-details">
											<i class="icon-user"></i> 
												Contact No.				
										</div>
									</div>
									<div class="item-body">
										{{ $quote->mobile }}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
<!-- END PORTLET -->
			</div>
		</div>
	</div>
</div>


<!--
<div class="row">
<div class="col-md-12">
<div class="portlet box">

<div class="portlet-body">
<div class="invoice">
<div class="row">
<div class="col-md-6">
<div class="col-md-4">Pick Up</div>
<div class="col-md-8 align-center form-group">

<label class="form-control">{{ $quote->pick_location }}</label>		

</div>

<div class="col-md-4">Email</div>
<div class="col-md-8 form-group">
<label class="form-control">{{ $quote->email }}</label>
</div>
<div class="col-md-4">Mode of Delivery</div>
<div class="col-md-8 align-center form-group">
<label class="form-control">{{ $quote->mode_type }}</label>
</div>


</div>
<div class="col-md-6">

<div class="col-md-4">Drop Off</div>
<div class="col-md-8 align-center form-group">
<label class="form-control">{{ $quote->drop_location }}</label>
</div>
<div class="col-md-4">Contact No.</div>
<div class="col-md-8 align-center form-group">
<label class="form-control">{{ $quote->mobile }}</label>
</div>





</div>

</div>
<div class="clearfix"></div>
<br>

<br><br>

<br>
<br><br>


</div>
</div>		
</div>		
</div>		
</div>	-->	
@endsection