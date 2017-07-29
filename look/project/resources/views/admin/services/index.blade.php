@extends('admin.layout')
@section('title')
	 Services		
@endsection
@section('heading')
	Manage Services
	<a href="{{url('admin/services/create')}}" class="btn blue btn-sm pull-right">Create Service</a>
@endsection
@section('content')

<div class="row">
				<div class="col-md-12">
					@include('flash::message')
					<div class="portlet box">
						
						<div class="portlet-body">
							<div class="dataTables_wrapper no-footer">
								<div class="row">
							
								</div>
								
									<table class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="sample_6_info">
							<thead>
							<tr role="row">
							<th>S No.</th>
							<th>
									  Service Name
								</th>
								<th>
									 Price/KM
								</th><th>
									 ETA
								</th>
								<th>
									  Status
								</th>
								<th>
									  Action
								</th>
								</tr>
							</thead>
							<tbody>
							<?php $i = 1;?>
							@foreach($services AS $service)
									<tr>
										<td><?php echo $i; ?></td>
										<td>
											{{ $service->name }}	
										</td>
										<td>
											${{ $service->price }}	
										</td>
										<td>
											{{ $service->eta }} <?php echo 'hours'; ?>	
										</td>
										<td>
											{!! Form::open(['method' => 'post' ]) !!}
											{!! $service->setStatus(Crypt::encrypt($service->id), $service->status) !!}
										  	{!! Form::close() !!}
										</td>
																			
										<td>
											{!! Form::open(['id' => 'deletePageForm','url' => 'admin/services/'.Crypt::encrypt($service->id),'method' => 'post' ]) !!}
				                            <a href="services/<?php echo Crypt::encrypt($service->id) ?>/edit" class="btn btn-circle btn-icon-only btn-default"><span style="color:orange" title="Edit" class="icon-pencil" aria-hidden="true"></span></a>
				                           <!-- <a href="javascript:void(0);" class="deleteuserRecord btn btn-circle btn-icon-only btn-default" data-id="{{$service->id}}" data-confirm-message="Are you sure you want to delete this service?" style="color:red" title="Delete"><span class="icon-trash" aria-hidden="true"></span></a>-->
												
											{!! Form::hidden('table','services',['class' => 'form-control']) !!}
				                       		
				                        {!! Form::close() !!}
										</td>
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