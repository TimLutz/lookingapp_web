@extends('admin.layout')
@section('title')
	Clients Feedback	
@endsection
@section('css2')
<link href="{{ asset('css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/ratingtheme/krajee-svg/theme.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<h3 class="page-title">
Clients Feedback	
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
			<a href="{{ url(getenv('adminurl').'/tasks/index-feedback') }}">Clients Feedback</a>
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
								
								<input type="hidden" name="action" value="tasks/list-feedback"/>
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
										 Client
									</th>
									<th width="15%">
										 Client Type
									</th>
									<th width="15%">
										Rating
									</th>
									

									<th width="10%">
										Comments
									</th>

									<th width="10%">
										Task Completed Date
									</th>
									

									<th class="a" width="13%">
										 Actions
									</th>

								</tr>
								<tr role="row" class="filter">
									<td></td>
									<td>
											
									</td>
									<td>
{!! Form::select('client_type', array(''=>'--select--','1' => 'Realtor', '2' => 'Houseowner'),null,['class' => 'form-control form-filter input-sm']) !!}
									</td>
									<td>
{!! Form::select('rating', array(''=>'--select--','1' => '1', '2' => '2','3' => '3', '4' => '4','5' => '5'),null,['class' => 'form-control form-filter input-sm']) !!}
									</td>
									
									<td>
										
<!--
										<input type="text" class="form-control form-filter input-sm" name="address" id="address" autocomplete="off">
-->

										</td>
									<td>
										<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd" id="plan_start_date">
											<input type="text" class="form-control form-filter input-sm" readonly name="techassign_at_from" placeholder="From">
											<span class="input-group-btn">
											<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
										<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd" id="plan_end_date">
											<input type="text" class="form-control form-filter input-sm" readonly name="techassign_at_to" placeholder="To">
											<span class="input-group-btn">
											<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
										
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
			@include('admin.tasks.popup')
			@include('admin.tasks.popupTechnician')
        <!--Pop-Up Ends here-->
			
@endsection
@section('js')
<script src="{{ asset('js/star-rating.js') }}" type="text/javascript"></script>

<script src="{{ asset('js/feedback.js') }}"></script>
<script>
jQuery(document).ready(function() {
	

/////////////////////    code for datepickers start    ////////////////////////////////
			
		
		
			function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year,month,day].join('-');
}
$('#plan_start_date').datepicker()
      .on('changeDate', function(ev){
		  
		
				var selected_date = new Date(ev.dates);
			

		var date = formatDate(selected_date);

		//alert(date);
	
       $('#plan_end_date').datepicker('setStartDate',date);
       $('.datepicker').hide();
       $('.filter-submit').click();  
        });
        
        
        
        
        $('#plan_end_date').datepicker()
      .on('changeDate', function(ev){
		  
		  var selected_date = new Date(ev.dates);


		var date = formatDate(selected_date);
		 // alert('end');
       $('#plan_start_date').datepicker('setEndDate', date);
       $('.datepicker').hide();
       $('.filter-submit').click();  
        });
	////////////////////    code for datepickers end    ////////////////////////////////////
 
	TableAjax.init();
	TableAjax.update();
});
</script>

@endsection

