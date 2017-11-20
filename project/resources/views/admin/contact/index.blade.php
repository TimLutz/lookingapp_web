<?php header( 'Content-Type: text/html; charset=utf-8' ); ?>
@section('css')
<?php $link =  "project/vendor/emojione/sprites/emojione-sprite-".config('emojione.spriteSize').".min.css"; ?>
<!-- <link rel="stylesheet" href="{{ asset($link) }}"/> -->
@endsection
@extends('admin.layout')
@section('title')
	Users Management
@endsection
@section('content')
<h3 class="page-title">
Queries
</h3><br>
<!-- BEGIN PAGE CONTENT-->
@include('flash::message')
<div class="row">
	<div class="col-md-12">
		
		<!-- Begin: life time stats -->
		<div class="portlet">
			<div class="portlet-body">
				<div class="table-container">
					
					<input type="hidden" name="action" value="contact/list-all-contact"/>
					
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
							 Name
						</th>
						<th width="15%">
							 Email
						</th>
						<th width="15%">
							Message
						</th>
						<th width="15%">
							Phone
						</th>
						
						<th width="10%">
							Action
						</th>

					</tr>
					<tr role="row" class="filter">
<!--
						<td></td>
-->
						<td>
								
						</td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="name" id="approved_planname" autocomplete="off">	
						</td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="email" id="approved_planname" autocomplete="off">
						</td>
						<td>
							
						</td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="phone"  autocomplete="off">
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

@include('models.viewquery')

@include('models.profiletext')
			<!-- END PAGE CONTENT-->
@endsection
@section('js')
<script>
jQuery(document).ready(function() {
	TableAjax.init();
	TableAjax.update();
    
});
</script>
<script src="{{ asset('js/contactus.js') }}"></script>
@endsection


