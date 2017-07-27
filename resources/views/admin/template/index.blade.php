@extends('admin.layout')
@section('title')
 	Templates		
@endsection
@section('heading')
	Email Templates
	<!--<a href="{{url('admin/template/create')}}" class="btn btn-primary btn-sm pull-right">Create Template</a>---->
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
								<table id="sample_templt" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="sample_6_info">
								
							<thead>
							<tr role="row">
							<th>S No.</th>
							<th>
									 Name
								</th>
								<th>
									 Subject
								</th>
								<!--<th>
									 Content
								</th>--->
								<th>
									  Action
								</th>
								</tr>
							</thead>
							<tbody>
							<?php $i = 1;?>
							@foreach( $templates as $template )
					<tr>
						<td><?php echo $i; ?></td>
						<td>{{ $template['name'] }}</td>
						<td>{{ $template['subject'] }}</td>
						<!--<td>{{ substr($template['content'],0,100).'...' }}</td>--->
						<!--<td>{{ substr(strip_tags($template['content']),0,100) }}</td>--->
						<td>
						{!! Form::open(['url' => 'admin/template/'.Crypt::encrypt($template['id']),'method' => 'delete' ]) !!}
						 <a href="template/{{Crypt::encrypt($template['id'])}}/edit"  title="Edit"><span class="icon-pencil btn btn-circle btn-icon-only btn-default" style="color:orange" aria-hidden="true"></span></a>
						 
						<!-- <a href="javascript:void(0);" class="deleteRecord" data-confirm-message="Are you sure you want to delete this template?" style="color:red" title="Delete"><span class="fa fa-times" aria-hidden="true"></span></a> -->
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
	$('#sample_templt').dataTable({
	"aoColumns": [
			  null,
			  null,
			  null, 
			  
			  { "bSortable": false }
			  ]          	
		
	});
});
</script>
@endsection
