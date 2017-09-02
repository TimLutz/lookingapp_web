@extends('admin.layout')
@section('title')
	Trial Management
@endsection
@section('content')
<h3 class="page-title">
Trial Management
</h3><br>
<!-- BEGIN PAGE CONTENT-->
@include('flash::message')
<div class="row">
	<div class="col-md-12">
		
		<!-- Begin: life time stats -->
		<div class="portlet">
			<div class="portlet-body">
				<div class="table-container">
					
					<input type="hidden" name="action" value="trials/list-all-trials"/>
					
					<table class="table table-striped table-bordered table-hover" id="datatable_ajax_for_realtor">
					<thead>
					<tr role="row" class="heading">
						<th width="5%">
							 S.No.
						</th>
						<th width="15%">
							 Days
						</th>
						<th width="10%">
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
		<!-- End: life time stats -->
	</div>
</div>
			<!-- END PAGE CONTENT-->
@endsection
@section('js')
<script>
jQuery(document).ready(function() {
	TableAjax.init();
	TableAjax.update();
});
</script>
<script src="{{ asset('js/trials.js') }}"></script>
@endsection


