@extends('admin.layout')	
@section('title')
Users
@endsection
@section('heading')
	Users
	<a href="{{url('admin/dashboard/add-new-user')}}" class="btn blue btn-sm pull-right">Create User</a>
@endsection
@section('content')
		<div class="portlet box">
						
						<div class="portlet-body">
						@include('flash::message')
							<div id="sample_6_wrapper" class="dataTables_wrapper no-footer">
								<div class="row">
							
								</div>
								
									<table id="sample_users" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="sample_6_info">
							<thead>
							<tr role="row"><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 176px;" aria-label="
									 Rendering engine
								" data-column-index="0">
									 Name
								</th><th>
									 Email
								</th>
								<th>
									 Created On
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
							@if(count($users))
													
								@foreach($users AS $user)
								<?php
									$userId = Crypt::encrypt($user->id);
								?>
									<tr>
										<td>{{ ucfirst($user->name) }}</td>
										<td>{{ $user->email }}</td>
										
										<td>{{ date('d-m-Y',strtotime($user->created_at)) }}</td>
										<td>
											{!! Form::open(['method' => 'post' ]) !!}
											{!! $user->setStatus($userId, $user->status) !!}
										  	{!! Form::close() !!}
											</td>	
											<td>
											{!! Form::open(['id' => 'deletePageForm','url' => 'admin/users/'.$userId,'method' => 'post' ]) !!}
												<a class="btn btn-circle btn-icon-only btn-default" name="view" id="view" title="View Detail" href="view/
												<?php echo $userId; ?>
												<?php //echo  base64_encode(); ?>" 
												>
												<span class="icon-eye" style="color:blue;"></span>
												</a>
												 <a href="edituser/<?php echo Crypt::encrypt($user->id) ?>" class="btn btn-circle btn-icon-only btn-default"><span style="color:orange" title="Edit" class="icon-pencil" aria-hidden="true"></span></a>
												<a href="javascript:void(0);" class="deleteuserRecord btn btn-circle btn-icon-only btn-default" data-id="<?php echo $userId; ?>" data-confirm-message="Are you sure you want to delete this user?" style="color:red" title="Delete"><span class="icon-trash" aria-hidden="true"></span></a>
												{!! Form::hidden('table','users',['class' => 'form-control']) !!}
											{!! Form::close() !!}
										</td>
									</tr>
									@endforeach
							</tr>
							
							@endif
							</tbody>
							</table>
								</div>
							
						</div>
					</div>
					
@endsection
@section('js')
<script>
jQuery(document).ready(function() {    
	$('#sample_users').dataTable({
	"aoColumns": [
			
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

