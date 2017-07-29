@include('header')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-4">
					@include('sidebar')
				</div>
				<div class="col-md-8">
					@include('flash::message')
					<div class="title">
						<h3>Order History</h3>
						<div id="sample_6_wrapper" class="dataTables_wrapper no-footer">
								<div class="row">
							
								</div>
								<table id="sample_templt" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="sample_6_info">
								
							<thead>
							<tr role="row">
							<th>Date</th>
							<th>
									 Item Description
								</th>
								<th>
									 Status
								</th><th>
									 Amount
								</th>
								
								
								
								
								</tr>
							</thead>
							<tbody>
							<?php $i = 1;?>
							@foreach($transactions as $transaction)
					<tr>
						<td>
						{{ date('Y-m-d',strtotime($transaction->created_at)) }}
						</td>
						<td>
						<?php
							if($transaction->bookings)
							{
								echo $transaction->bookings->item_description;
							}
						?>
						</td>
						<td>
							<?php
								if($transaction->bookings)
								{
									$orderstatus = $transaction->bookings->order_status;
									switch ($orderstatus) {
										case '0':
											echo 'Wait for pickup';
											break;
										case '1':
											echo 'Inprocess';
											break;
										case '2':
											echo 'Delivery';
											break;
										case '3':
										case '5':
											echo 'Order cancelled';
											break;		
										case '4':
										case '6':
											echo 'Refund';		
											break;
										default:
											echo 'No order status';
											break;
									}
								}
							 ?>
						</td>
						<td>
							{{ $transaction->amount }}
						</td>
					
					</tr>
					<?php  $i++;  ?>
					@endforeach
							</tbody>
							</table>
								</div>
					</div>

				</div>
			</div>
		</div>
	</div>	
@include('footer')