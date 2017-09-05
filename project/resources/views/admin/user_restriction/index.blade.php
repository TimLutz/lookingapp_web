@extends('admin.layout')
@section('title')
	Restrictions Management 	
@endsection
@section('content')
<h3 class="page-title">
Restrictions for free users
</h3><br>
<!-- BEGIN PAGE CONTENT-->
@include('flash::message')
<div class="row">
	<div class="col-md-12">
		
		<!-- Begin: life time stats -->
		<div class="portlet">
			<div class="portlet-body">
				<div class="table-container">
					
					<input type="hidden" name="action" value="userrestriction/list-all-restrictions"/>
					<input type="hidden" name="type" value="0" id="user_type"> 	
					<table class="table table-striped table-bordered table-hover" id="datatable_ajax_for_realtor">
					<thead>
					<tr role="row" class="heading">
<!--
						<th width="2%">
							<input type="checkbox" name="selectall" class="group-checkable">
						</th>
-->
						<th width="5%">
							 S.No.
						</th>
						<th width="15%">
							 Section
						</th>
						<th width="15%">
							 Limit
						</th>
						<th width="10%">
							Action(Ban,Unban)
						</th>

					</tr>
					<tr role="row" class="filter">
<!--
						<td></td>
-->
						
						<td>
								
						</td>
						<td>
								
						</td>
						<td>
							
						</td>
								
						
						<td>
						<button style="display:none;" class="btn btn-sm yellow filter-submit margin-bottom"></button>
						<button title="Reset" class="btn btn-sm red filter-cancel">Reset</button>	
						</td>
					


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
<script src="{{ asset('js/user_restriction.js') }}"></script>
@endsection


