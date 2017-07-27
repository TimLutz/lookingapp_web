@extends('admin.layout')	
@section('title')
Order Detail
@endsection
@section('heading')
	View Order Details
@endsection
@section('content')
<div class="portlet box">
			<div class="portlet-body">
	 <div class="row">
                <div class="col-md-12">
								<!-- BEGIN PORTLET -->
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase">Customer Info</span>
						</div>
										
					</div>
					<div class="portlet-body">
										
							<div class="col-md-6">
								<div class="general-item-list">

									<div class="item">
										<div class="item-head">
											<div class="item-details">
												<i class="icon-user"></i> Username									</div>
										</div>
										<div class="item-body">
										<?php
									if($order->user)
									{
										?>
										{{ $order->user->first_name }} {{ $order->user->last_name }}
										<?php
									}
									?>
										</div>
									</div>
									<div class="item">
										<div class="item-head">
											<div class="item-details">
												<i class="icon-call-end"></i> Mobile
											</div>
										</div>
										<div class="item-body">
											<?php
										if($order->user)
										{
											?>
											{{ $order->user->phone_number }}
											
											<?php
										}
									?>
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
											 <?php
						if($order->user)
						{
							?>
								{{ $order->user->email }}
							<?php
						}
						?>
										</div>
									</div>
									<div class="item">
										<div class="item-head">
											<div class="item-details">
												<i class="fa fa-building-o"></i> 
												Company Name				
											</div>
															
										</div>
										<div class="item-body">
										 <?php
											if($order->user)
											{
												?>
													{{ $order->user->company_name }}
												<?php
											}
											?>
											
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
            
            <div class="clearfix"></div>
            <br/><br/>
	<div class="profile-content">


            

		<div class="row">
			<div class="col-md-6">
								<!-- BEGIN PORTLET -->
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase">Order Detail</span>
						</div>
										
					</div>
					<div class="portlet-body">
										
						<div class="general-item-list">
							<div class="item">
								<div class="item-head">
									<div class="item-details">
										<i class="fa fa-list"></i> Order No
									</div>
								</div>
								<div class="item-body">

									{{ $order->id }}
								</div>
							</div>
							<div class="item">
								<div class="item-head">
									<div class="item-details">
										<i class="icon-user"></i> Booked By
									</div>
								</div>
								<div class="item-body">
									<?php
									if($order->user)
									{
										?>
										{{ $order->user->first_name }} {{ $order->user->last_name }}
										<?php
									}
									?>
								</div>
							</div>
							<div class="item">
								<div class="item-head">
									<div class="item-details">
										<i class="icon-call-end"></i> Contact No
									</div>		
								</div>
								<div class="item-body">
									<?php
										if($order->user)
										{
											?>
											{{ $order->user->phone_number }}
											
											<?php
										}
									?>
								</div>
							</div>
							<div class="item">
								<div class="item-head">
									<div class="item-details">
										<i class="fa fa-cog"></i> Service
															
									</div>
														
								</div>
								<div class="item-body">
									
										
												{{ $order->service_id }}
										
								</div>
							</div>
							<div class="item">
								<div class="item-head">
									<div class="item-details">
										<i class="fa fa-clock-o"></i> Time Avalible to pick
															
									</div>
														
								</div>
								<div class="item-body">
								
									
											{{ $order->pickup_time }}
									
								</div>
							</div>
							
						</div>
										
					</div>
				</div>
								<!-- END PORTLET -->
			</div>
							
							<div class="col-md-6">
								<!-- BEGIN PORTLET -->
								<div class="portlet light">
									<div class="portlet-title">
										<div class="caption caption-md">
											<i class="icon-bar-chart theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase"></span>
										</div>
										
									</div>
									<div class="portlet-body">
										
											<div class="general-item-list">
												<div class="item">
													<div class="item-head">
														<div class="item-details">
															<i class="fa fa-calendar"></i> Order Date
														</div>
													</div>
													<div class="item-body">
														{{ date('d-m-Y',strtotime($order->created_at)) }}
													</div>
												</div>
												<div class="item">
													<div class="item-head">
														<div class="item-details">
															<i class="fa fa-cog"></i>Order Status
															
														</div>
														
													</div>
													<div class="item-body">
													<?php
													if($order->order_status == '0')
													{
														echo 'Waiting for Pickup';
													}
													else if($order->order_status == '1')
													{
														echo 'Inprocess';
													}
													else if($order->order_status == '2')
													{
														echo 'Delivered';
													}
													else if($order->order_status == '3')
													{
														echo 'Cancelled by user';
													}
													else if($order->order_status == '4')
													{
														echo 'Refund Process by User';
													}
													else if($order->order_status == '5')
													{
														echo 'Cancelled by Admin';
													}
													else if($order->order_status == '6')
													{
														echo 'Refund Process by Admin';
													}
												?>
													</div>
												</div>
												<?php
													if($order->order_status == '3' || $order->order_status == '5')
													{
														?>
														<div class="item">
															<div class="item-head">
																<div class="item-details">
																	<i class="fa fa-sitemap"></i> Comment
																	
																</div>
																
															</div>
															<div class="item-body">
																<?php
															echo	$order->comment;
																?>
															</div>
														</div>		
<?php
													}
												?>
												<div class="item">
													<div class="item-head">
														<div class="item-details">
															<i class="fa fa-sitemap"></i> Email
															
														</div>
														
													</div>
													<div class="item-body">
														 <?php
						if($order->user)
						{
							?>
								{{ $order->user->email }}
							<?php
						}
						?>
													</div>
												</div>
												<div class="item">
													<div class="item-head">
														<div class="item-details">
															<i class="fa fa-truck"></i> Mode of delivery
															
														</div>
														
													</div>
													<div class="item-body">
														
														<?php
															if($order->modes)
															{
																echo $order->modes->title;
															}
														?>
													</div>
												</div>
												<div class="item">
													<div class="item-head">
														<div class="item-details">
															<i class="fa fa-calendar-o"></i> ETA
															
														</div>
														
													</div>
													<div class="item-body">
														 <?php
														if($order->service)
														{
															?>
																
														{{ $order->service->eta }}
															<?php
														}
														?>
													</div>
												</div>
												<div class="item">
													<div class="item-head">
														<div class="item-details">
															<i class="icon-picture"></i> ATL
															
														</div>
														
													</div>
													<div class="item-body">
														 <?php
														if($order->atl)
														{
															echo "Yes";	
														}
														else
														{
															echo "No";
														}
														?>
													</div>
												</div>
											
											</div>
									</div>
								</div>
								<!-- END PORTLET -->
							</div>
							
						</div>
					</div>
				<div class="clearfix"></div>
				<br>

				<div class="portlet-content">
				<div class="row">
					<div class="col-md-6">
								<!-- BEGIN PORTLET -->
								<div class="portlet light">
									<div class="portlet-title">
										<div class="caption caption-md">
											<i class="icon-bar-chart theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase">Pick up</span>
										</div>
										
									</div>
									<div class="portlet-body">
										
											<div class="general-item-list">
												<div class="item">
													<div class="item-head">
														<div class="item-details">
															<i class="icon-user"></i> Name
														</div>
													</div>
													<div class="item-body">
														 {{ $order->pic_companyname }}
													</div>
												</div>
												<div class="item">
													<div class="item-head">
														<div class="item-details">
															<i class="fa fa-map-marker"></i> Address
														</div>
													</div>
													<div class="item-body">
														{{ $order->pic_streetno }} {{ $order->pic_streetname }}
													</div>
												</div>
												<div class="item">
													<div class="item-head">
														<div class="item-details">
															<i class="icon-call-end"></i>Contact No.
															
														</div>
														
													</div>
													<div class="item-body">
														 {{ $order->pic_mobile }}
													</div>
												</div>
												<div class="item">
													<div class="item-head">
														<div class="item-details">
															<i class="icon-envelope-open"></i> Email Id
															
														</div>
														
													</div>
													<div class="item-body">
														{{ $order->pic_email }}
													</div>
												</div>
												
											
												
											</div>
										
									</div>
								</div>
								<!-- END PORTLET -->
							</div>

			

				<div class="col-md-6">
								<!-- BEGIN PORTLET -->
								<div class="portlet light">
									<div class="portlet-title">
										<div class="caption caption-md">
											<i class="icon-bar-chart theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase">Drop off</span>
										</div>
										
									</div>
									<div class="portlet-body">
										
											<div class="general-item-list">
												<div class="item">
													<div class="item-head">
														<div class="item-details">
															<i class="icon-user"></i> Name
														</div>
													</div>
													<div class="item-body">
														 {{ $order->del_companyname }}
													</div>
												</div>
												<div class="item">
													<div class="item-head">
														<div class="item-details">
															<i class="fa fa-map-marker"></i> Address
														</div>
													</div>
													<div class="item-body">
														{{ $order->del_streetno }} {{ $order->del_streetname }}
													</div>
												</div>
												<div class="item">
													<div class="item-head">
														<div class="item-details">
															<i class="icon-call-end"></i>Contact No.
															
														</div>
														
													</div>
													<div class="item-body">
														 {{ $order->del_mobile }}
													</div>
												</div>
												<div class="item">
													<div class="item-head">
														<div class="item-details">
															<i class="icon-envelope-open"></i> Email Id
															
														</div>
														
													</div>
													<div class="item-body">
														{{ $order->del_email }}
													</div>
												</div>
												
											
												
											</div>
										
									</div>
								</div>
								<!-- END PORTLET -->
							</div>
				</div>
				</div>
				<br>
				<br><br>
				<div class="portlet-body">
				<div class="row">
					<div class="col-md-12">
					<div class="portlet light">
						<div class="portlet-title">
						<div class="pull-right">
							<span>
								<a href="{{url('uploads/invoice/lesson2.pdf')}}" target='_blank' class="btn blue">Invoice</a>
											</span>
						</div>

						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase">Payment Detail</span>
											
						</div>
				
						<table class="table table-striped table-hover">
						<thead>
						<tr>
							<th class="text-center"><span>
								 Order No</span>
							</th>
							<th class="text-center"><span>
								 Service Charge</span>
							</th>
							</th>
							<th class="hidden-480 text-center"><span class="pull-right">
								 Quantity</span>
							</th>
							<th class="hidden-480 text-center"><span class="pull-right">
								 Description</span>
							</th>
							<th class="text-center"><span>
								 Toll Price</span>
							</th>
							<th class="text-center"><span>
								Total Amount</span>
							</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$qty = 0;
							$service_charge = 0;
							$total = 0;
							$tax = 0;
							$toll_tax = 0;
							$grand_total = 0;
						?>
						<tr>
							<td class="text-center"><span>
								{{ $order->id }}</span>
							</td>
							<td class="text-center"><span>
								 ${{ $order->amount }}</span>
							</td>
							<td class="hidden-480 text-center"><span>
								 <?php 
								 	echo $qty = 1;
								 ?></span>
							</td>
							<td class="hidden-480 text-center"><span>
								 {{ $order->item_description }}</span>
							</td>
							<td class="text-center"><span>$
								 <?php
								 echo $toll_tax;
								 ?></span>
							</td>
							<td class="text-center"><span>
								 $<?php echo $total =  ($order->amount  * $qty) + $toll_tax;?>
							</span>
							</td>
						</tr>
						<tr>
							<th colspan="5"><span class="pull-right">Sub Total</span></th>
							<th  class="text-center"><span>$<?php echo $total; ?></span></th>
						</tr>
						<tr>
							<th colspan="5"><span class="pull-right">Tax</span></th>
							<th class="text-center"><span>$<?php echo $tax; ?></span></th>
						</tr>
						<tr>
							<th colspan="5"><span class="pull-right">Grand Total:</span></th>
							<th class="text-center"><span>$<?php echo $total + $tax; ?></span></th>
						</tr>
						</tbody>
						</table>
					</div>
				</div>
				</div>
				
			
			</div>
		</div>	
@endsection