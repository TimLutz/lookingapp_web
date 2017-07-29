@extends('admin.layout')
@section('title')
	 Quote Us		
@endsection
@section('heading')
	Quote Us
	
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
								
									<table id="sample_quotes" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="sample_6_info">
							<thead>
							<tr role="row">
									<th>
										S No.
									</th>
									<th>
									  Pick Up
									</th>
									<th>
										 Drop Off
									</th><th>
										 Delivery Mode
									</th>
									<th>
										 Service Name
									</th>
									<th>
										 Email id
									</th>
									<th>
										  Action
									</th>
								</tr>
							</thead>
							<tbody>
							<?php $i = 1;?>
							@foreach($quoteus AS $quote)
							<?php
								$quoteusId = Crypt::encrypt($quote->id);
							?>
									<tr>
										<td><?php echo $i; ?></td>
										<td>
											{{ $quote->pick_location }}	
										</td>
										<td>
											{{ $quote->drop_location }}	
										</td>
										<td>
											<?php
												if($quote->mode)
												{
													echo $quote->mode->title;		
												}
											?>	
										</td>
										<td>
											<?php
												if(isset($quote->service_id) && $quote->service_id != '')
												{
													?>
													{{ $quote->service_id }}	
														
													<?php
													
												}
												
											?>
										
										</td>
										<td>
											{{ $quote->email }}	
										</td>
									<!--	<td>
											<?php 
												if($quote->type == '1')
												{
													echo 'Quote Me';
												}
												else if($quote->type == '2')
												{
													echo 'Quote Us';
												}
												else if($quote->type == '3')
												{
													echo 'Booked';
												}	
											?>	
										</td>-->
										
																			
										<td>
											{!! Form::open(['id' => 'deleteQuoteForm','url' => 'admin/quotes/'.$quoteusId,'method' => 'post' ]) !!}
				                            <a name="view" id="view" title="View Detail" href="{{ url('admin').'/quote/quotedetail/' }}<?php echo $quoteusId; ?>" class="btn btn-circle btn-icon-only btn-default"><i class="icon-eye" style="color:blue;"></i></a>
				                            <a href="javascript:void(0);" class="deletequoteRecord btn btn-circle btn-icon-only btn-default" data-id="<?php echo $quoteusId; ?>" data-type="{{$quote->type}}" data-confirm-message="Are you sure you want to delete this Quotes?" style="color:red" title="Delete"><span class="icon-trash" aria-hidden="true"></span></a>
												
				                            
											{!! Form::hidden('table','quotation',['class' => 'form-control']) !!}
				                       		
				                        {!! Form::close() !!}
										</td>
										
									</tr>
									<?php $i+=1; ?>
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
	$('#sample_quotes').dataTable({
	"aoColumns": [
			  null,
			  null,
			  null,
			  null,
			  null,
			  null, 
			  { "bSortable": false }
			  ]          	
		
	});
});
</script>
@endsection
