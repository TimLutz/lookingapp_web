@include('header')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-4">
					@include('sidebar')
				</div>
				<div class="col-md-8">
					@include('flash::message')
					@include('models.commentupdate')
					<div class="title">
						<h3>Order History</h3>
						<div id="sample_6_wrapper" class="dataTables_wrapper no-footer">
								<div class="row">
							
								</div>
								<table id="sample_templt" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="sample_6_info">
								
							<thead>
							<tr role="row">
							<th>Order no</th>
							<th>
									 Service
								</th>
								<th>
									 Pick Up
								</th><th>
									 Drop Off
								</th>
								
								<th>
									  ETA
								</th>
								<th>
									 Order status
								</th>
								
								</tr>
							</thead>
							<tbody>
							<?php $i = 1;?>
							@foreach( $bookings as $booking)
					<tr>
						<td>{{ $booking->id }}</td>
						<td>
							{{ $booking->service_id }}
						</td>
						<td>
							{{ $booking->pic_companyname }}
						</td>
						<td>
							{{ $booking->del_companyname }}
						</td>
						<td>
							<?php
								if($booking->service)
								{
									echo $booking->service->eta;
								}
							?>
						</td>
						<td>
							<?php
								$orderstatus = $booking->order_status;
								$endTime = strtotime("+10 minutes", strtotime($booking->created_at));

					          $date = date('Y-m-d H:i:s', $endTime); 
					          $now = date('Y-m-d H:i:s');
								          $enddate = date('i',strtotime($date));
								          $startdate = date('i',strtotime($now));
					          			  $startsec = date('s',strtotime($now));	
										  $endsec = date('s',strtotime($date));		
										  $sec = abs($startsec + $endsec);



	  
								switch ($orderstatus) {
									case '0':
							          	if($now < $date)
							          	{
								         $total = abs($startdate - $enddate);
							            	?>
							         <div id="timing"></div>
							      
				@section('js')			            	
				            <script class="source" type="text/javascript">
							
							</script>

				            <script>
			           			var sec = 60 - <?php echo $startsec ?>;
			           			var endsec = <?php echo $endsec ?>;
								var i=0;
								var hms='00:'+<?php echo $total-1 ?>+':'+sec;
								var a = hms.split(':');
								var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+parseInt(a[2])+parseInt(endsec));
								var timer = setInterval(function() {
								
								     $('#timing').text("Order canelled by user with in time " +Math.floor(((seconds - i) / 60)) + " Minutes " + ((seconds - i) % 60 ) +" Seconds");
								     i++;
								    if(seconds == i) {
								    	window.location.reload();
								    }
								}, 1000);
								</script>
				@endsection            
							            	{!! Form::open(['url'=>'user/history','method'=>'post','id'=>'add_template']) !!}
							            	<select class="form-control" name="order_status" id="order_status" onchange="cancelledorder(this.value)">
							            		<option value="">Please select</option>
							            		<option value="<?php echo Crypt::encrypt($booking->id) ?>,3">Cancelled Order</option>
							            	</select>
							            	{!! Form::close() !!}
							            	<?php
							          	}
							          	else
							          	{ 
							          		echo 'Waiting for Pickup';
							          	}
										
										break;
									case '1':
										echo 'Inprocess';	
										break;	
									case '2':
									echo 'Delivered';	
										break;
									case '3':
									case '5':
									echo 'Cancelled';	
										break;		
									case '4':
									case '6':
									echo 'Refund';	
										break;	
									default:
										# code...
										echo 'No order status';
										break;
								}
							?>
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