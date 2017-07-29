@extends('admin.layout')
@section('title')
 	Transaction
@endsection
@section('heading')
	Transactions
@endsection
@section('content')

<div class="row">
				<div class="col-md-12">
					@include('flash::message')
					<div class="portlet box">
						
						<div class="portlet-body">
							<div id="sample_6_wrapper" class="dataTables_wrapper no-footer">
								<div class="row">
							
								</div>
								
									<table id="sample_trans" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="sample_6_info">
							<thead>
							<tr role="row">
							<th>S No.</th>
							<th>Order Number</th>
							<th>
									 Transaction Id
								</th>
							<th>
									User Name
								</th>
								<th>
									 Service Name
								</th>
								
								<th>
									  Date
								</th>
								</tr>
							</thead>
							<tbody>
							<?php $i = 1;?>
							@foreach($transactions as $transaction)
					<tr>
						<td>{{ $i }}</td>
						
						<td>
						<?php
							if($transaction->bookings)
							{
								?>
								<a class="oid" name="view" id="view" title="View Detail" href="{{ url('admin').'/order/orderdetail/' }}<?php echo  Crypt::encrypt($transaction->bookings->id); ?>">{{ $transaction->bookings->id }} </a>
									
								<?php
							}
						?>
						</td>
						<td> 
						{{ $transaction->id  }} 
						</td>
						<td> 
							<?php
								if($transaction->userss)
								{ ?>
									{{ $transaction->userss->first_name }} {{ $transaction->userss->last_name }}	
									<?php
								}
							?>
							
							
						 </td>
						<td> 
							
								<?php

								if(isset($transaction->service_id) && $transaction->service_id != '')
								{
									?>
								{{ $transaction->service_id }}
									<?php
								}
?>
							
						 </td>
						
						<td>
						{{ date('d-m-Y',strtotime($transaction->created_at)) }}
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


@endsection
@section('js')
<script>
jQuery(document).ready(function() {    
	$('#sample_trans').dataTable({
	"aoColumns": [
			  null,
			  null,
			  null, 
			  null,
			  null,
			  null
			  ]        	
		
	});
});
</script>
@endsection
