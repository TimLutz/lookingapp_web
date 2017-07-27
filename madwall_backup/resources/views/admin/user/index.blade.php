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

