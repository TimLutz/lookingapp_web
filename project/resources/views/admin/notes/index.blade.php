@extends('admin.layout')
@section('title')
	General Notes	
@endsection
@section('content')
<h3 class="page-title">
General Notes
</h3><br>
<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="{{ url(getenv('adminurl')) }}">Dashboard</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="{{ url(getenv('adminurl').'/notes/') }}">General Notes</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
<!--
	<a href="{{ url('admin/plan/add-new-plan') }}" class="btn btn-sm blue pull-right"> Add Plan </a>
-->
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
@include('flash::message')
			<div class="row">
				<div class="col-md-12">
					
					<!-- Begin: life time stats -->
					<div class="portlet">
						<div class="portlet-body">
							<div class="table-container">
								
								<input type="hidden" name="action" value="notes/list-notes"/>
								<div class="table-actions-wrapper">
									<span>
									</span>

										
								</div>
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
										User Name
									</th>
									<th width="15%">
										User type
									</th>
									<th width="15%">
										Title
									</th>
									<th width="15%">
										Notes
									</th>
									

									<th width="10%">
										 Note Date
									</th>

									

									<th class="a" width="13%">
										 Actions
									</th>

								</tr>
								<tr role="row" class="filter">
<!--
									<td></td>
-->
									<td>
												
									</td>
									<td>
											<input type="text" class="form-control form-filter input-sm" name="clientname" id="technicianassigned" autocomplete="off">
									</td>
									<td>
											{!! Form::select('typeuser', array(''=>'--select--','1' => 'Realtor', '2' => 'Houseowner'),null,['class' => 'form-control form-filter input-sm', 'id' => 'typeuser']) !!}
									</td>
									<td><input type="text" class="form-control form-filter input-sm" name="title" id="title" autocomplete="off"></td>
									<td>
										
									</td>
									
									<td>
<!--
										<input type="text" class="form-control form-filter input-sm" name="address" id="address" autocomplete="off">
-->

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
		<!-- Pop up starts here-->
			
        <!--Pop-Up Ends here-->
			
@endsection
@section('js')
<script>
jQuery(document).ready(function() {

    
   
 
	TableAjax.init();
	TableAjax.update();
});
</script>
<script src="{{ asset('js/notes.js') }}"></script>
@endsection


