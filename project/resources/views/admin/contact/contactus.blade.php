@extends('admin.layout')
@section('title')
	 Customer-Requests
@endsection
@section('heading')
	Customer Requests
@endsection
@section('content')
<div class="row">
				<div class="col-md-12">
					<div class="portlet box">
					<div class="portlet-body">
							@include('flash::message')
							<div id="sample_6_wrapper" class="dataTables_wrapper no-footer">
								<div class="row">
							</div>
						<table id="sample_contact" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="sample_6_info">
							<thead>
							<tr role="row">
								<th>
									S No.
									</th>
								   <th>
									  Name
								   </th>
								   <th>
									 Email
								   </th>
									<th>
									Status
									</th>
									<th>
									 Action
									</th></tr>
								</thead>
							<tbody>
								<?php $i = 1;?>
							@foreach($contact AS $val)
							<?php
								$contactId=Crypt::encrypt($val->id);
							?>
									<tr role="row">
										<td><?php echo $i; ?></td>
										<td>{{ $val->name }}</td>
										<td>{{ $val->email }}</td>
										<td>{{ $val->message == NULL ? 'Unanswered' : 'Replied' }}</td>
										<td>
										{!! Form::open(['method' => 'post' ]) !!}
										{!! Form::close() !!}
										{!! Form::open(['id' => 'deletePageForm','url'  => 'admin/contact/'.$contactId,'method' => 'post' ]) !!}
										<a href="contact/{{ $contactId }}" class="btn btn-circle btn-icon-only btn-default" name="view" id="view" title="View Detail"><span class="icon-eye" style="color:blue;"></span>
												</a>
										<a href="javascript:void(0);" class="deleteuserRecord btn btn-circle btn-icon-only btn-default" data-id="<?php echo 
										$contactId; ?>" data-confirm-message="Are you sure you want to delete this query?" style="color:red" title="Delete"><span class="icon-trash" aria-hidden="true"></span></a>
										{!! Form::hidden('table','contacts',['class' => 'form-control']) !!}
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
	$('#sample_contact').dataTable({
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
