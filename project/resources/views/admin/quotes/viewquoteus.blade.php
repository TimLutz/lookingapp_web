@extends('admin.layout')
@section('title')
	 Quote Us
@endsection
@section('heading')
	Quote Us
	
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
								<span class="caption-subject font-blue-madison bold uppercase">Quote Us
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
											<i class="icon-call-end"></i>Delivery Speed
										</div>
									</div>
									<div class="item-body">
										<?php
												if(isset($quote->service_id) && $quote->service_id != '')
												{
													?>
													{{ $quote->service_id }}	
														
													<?php
													
												}
												
											?>
									</div>
								</div>
								<div class="item">
									<div class="item-head">
										<div class="item-details">
											<i class="icon-user"></i> 
												Delivery Date				
										</div>
									</div>
									<div class="item-body">
										{{ $quote->delivery_date }}
									</div>
								</div>

								<div class="item">
									<div class="item-head">
										<div class="item-details">
											<i class="icon-user"></i> 
												Competing Service Name			
										</div>
									</div>
									<div class="item-body">
										{{ $quote->competingname }}
									</div>
								</div>
								<div class="item">
									<div class="item-head">
										<div class="item-details">
											<i class="icon-user"></i> 
												About Package			
										</div>
									</div>
									<div class="item-body">
										{{ $quote->package_description }}
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
								<div class="item">
									<div class="item-head">
										<div class="item-details">
											<i class="icon-call-end"></i> Mode of Delivery
										</div>
									</div>
									<div class="item-body">
										<?php
											if($quote->mode)
											{
												echo $quote->mode->title;		
											}
										?>	
									</div>
								</div>
								<div class="item">
									<div class="item-head">
										<div class="item-details">
											<i class="icon-user"></i> 
												Your Quotation Price			
										</div>
									</div>
									<div class="item-body">
										{{ $quote->quotation_price }}
									</div>
								</div>
								<div class="item">
									<div class="item-head">
										<div class="item-details">
											<i class="icon-user"></i> 
												Your Message				
										</div>
									</div>
									<div class="item-body">
										{{ $quote->message }}
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="general-item-list">
								
								
								
								
								
							</div>
						</div>
					</div>
				</div>
<!-- END PORTLET -->
			</div>
		</div>
	</div>
</div>



	<!--<div class="row">
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
						<div class="col-md-4">Delivery Speed</div>
						<div class="col-md-8 align-center form-group">
						<label class="form-control">
						<?php
							if($quote->servicee != FALSE)
							{
								?>
									{{ $quote->servicee->name }}
								<?php
							}
						?>
						</label>
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
						<div class="col-md-4">Mode of Delivery</div>
						<div class="col-md-8 align-center form-group">
						<label class="form-control">{{ $quote->mode_type }}</label>
						</div>
						
						
					
					
					</div>
					

					
				</div>
				<div class="clearfix"></div>
				<br>

				<br><br>
				<div class="row">
					<div class="col-md-2" style="position:relative; left:15px;">About Package</div>
						<div class="col-md-10 align-center form-group">
						<label class="form-control">{{ $quote->package_description }}</label>
						</div>
				</div>
				<div class="clearfix"></div>
				<br>

				<br><br>

				<div class="row">
					<div class="col-md-3" style="position:relative; left:15px;">Delivery Date</div>
						<div class="col-md-9 align-center form-group">
						<label class="form-control">{{ $quote->delivery_date }}</label>
						</div>
					<div class="col-md-3" style="position:relative; left:15px;">Your Quotation Price</div>
						<div class="col-md-9 align-center form-group">
						<label class="form-control">{{ $quote->quotation_price }}</label>
						</div>
					<div class="col-md-3" style="position:relative; left:15px;">Competing Service Name</div>
						<div class="col-md-9 align-center form-group">
						<label class="form-control">{{ $quote->competingname }}</label>
						</div>
					<div class="col-md-3" style="position:relative; left:15px;">Your Message</div>
						<div class="col-md-9 align-center form-group">
						<label class="form-control">{{ $quote->message }}</label>
						</div>		
				</div>
				
				
			</div>
	</div>		
	</div>		
	</div>		
	</div>	-->
@endsection