@extends('admin.layout')
@section('title')
	Technician Tasks	
@endsection
@section('content')
<h3 class="page-title">
Technician Tasks	
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
			<a href="{{ url(getenv('adminurl').'/tasks/index-techtask') }}">Manage Technician Tasks</a>
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
								
								<input type="hidden" name="action" value="tasks/list-tech-tasks"/>
								<div class="table-actions-wrapper">
									<span>
									</span>
<!--
									<select class="table-group-action-input form-control input-inline input-small input-sm">
										<option value="">Select...</option>
										<option value="delete">Delete Multiple Plans</option>
									</select>
									
									<button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Action</button>
-->
										
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
										 Technician
									</th>
									<th width="10%">
										 Tech Assigned Date
									</th>
									<th width="10%">
										Task Scheduled Date
									</th>
									

									<th width="10%">
										Task Requested By
									</th>

									<th width="10%">
										Client Type
									</th>
									<th width="10%">
										Property Attribute 
									</th>
									<th width="10%">
										 Priority &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
									</th>
									<th width="10%">
										 Status &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
									</th>

									<th class="a" width="15%">
										 Actions &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
									</th>

								</tr>
								<tr role="row" class="filter">
									<td></td>
									<td>
										<input type="text" class="form-control form-filter input-sm" name="technicianassigned" id="technicianassigned" autocomplete="off">	
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
									<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd" id="plan_start_date_two">
											<input type="text" class="form-control form-filter input-sm" readonly name="scheduled_at_from" placeholder="From">
											<span class="input-group-btn">
											<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
										<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd" id="plan_end_date_two">
											<input type="text" class="form-control form-filter input-sm" readonly name="scheduled_at_to" placeholder="To">
											<span class="input-group-btn">
											<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
									</td>
									
									<td>
							<input type="text" class="form-control form-filter input-sm" name="requestedby" id="requestedby" autocomplete="off">

										</td>
									<td>
									{!! Form::select('typeuser', array(''=>'--select--','1' => 'Realtor', '2' => 'Houseowner'),null,['class' => 'form-control form-filter input-sm', 'id' => 'typeuser']) !!}
										
										</td>
										<td>
	
										
										</td>
									<td>
										
										{!! Form::select('priority', array(''=>'--select--','1' => 'High', '2' => 'Medium','3'=>'Low'),null,['class' => 'form-control form-filter input-sm']) !!}
										
										
										
									</td>
									<td>
									{!! Form::select('status', array(''=>'--select--','1' => 'Pending', '2' => 'Declined','3'=>'Accepted','4'=>'Completed'),null,['class' => 'form-control form-filter input-sm']) !!}</td>
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
<script>
jQuery(document).ready(function() {
	
    $(document).on("click", ".changestatus", function () {
	
	 /***********user ajax view *******/
        var url_for_user_view = adminname+'/status';

        

        var taskid = $(this).attr("data-id");
       
        var token ="{{csrf_token()}}";
        $.ajax({
            url: path+url_for_user_view,
          
            type: "POST",
            data: {id: taskid,_token:token},
            dataType: "JSON",
            success: function (result) {
                if (result == 'unauthorised')
                    window.location = "/login";
                else if (result.status == 'error')
                    bootbox.alert('some problem occur try again.....');
                else
                {                   
                   
								
							$('#status option[value="'+result.task.status+'"]').attr("selected", "selected");
							 var s = result.task.id;
							
							 var k = s; 
                     $('#taskperforming').val(k);
                       
                   $('#myModal').modal('show');
                }
            }
        });
        /***********user ajax view ends here*******/
	
	
	});
	
	
	
	 $(document).on("click", ".assigntechnician", function () {
	
	 /***********user ajax view *******/
        var url_for_user_view = adminname+'/technician-assigned';

        

        var taskid = $(this).attr("data-id");
       
        var token ="{{csrf_token()}}";
        $.ajax({
            url: path+url_for_user_view,
          
            type: "POST",
            data: {id: taskid,_token:token},
            dataType: "JSON",
            success: function (result) {                
                   console.log(result);
					
							
							
                     $('#technicianperforming').val(taskid);
                   
							 $("#appenddata").html(result.message);
							 
							 
                       
                   $('#myModaltechnician').modal('show');
               
            }
        });
        /***********user ajax view ends here*******/
	
	
	});
	
	
	$(document).on("click", "#updatestatus", function () {
		
	
	 /***********user ajax view *******/
        var url_for_user_view = adminname+'/updatestatus';

        var formdata = $('#changestatus').serialize();
      //  alert(formdata);selected_date
        $.ajax({
            
			 url: path+url_for_user_view,
            type: "POST",
            data: formdata,
            dataType: "JSON",
            success: function (result) {
                if (result == 'unauthorised')
                    window.location = "/login";
                else if (result.status == 'error')
                    bootbox.alert('some problem occur try again.....');
                else
                {                   
                   $('#myModal').modal('hide');
                      showSuccessMessage('status updated');
								TableAjax.refresh();
                }
            }
        });
        /***********user ajax view ends here*******/
	
	
	});
	
	
		$(document).on("click", "#updatetechnician", function () {
		
	 /***********user ajax view *******/
        var url_for_user_view = adminname+'/technicianupdate';

        var formdata = $('#changetechnician').serialize();
        
       // alert(formdata);
        $.ajax({
            
			 url: path+url_for_user_view,
            type: "POST",
            data: formdata,
            dataType: "JSON",
            success: function (result) {
                if (result == 'unauthorised')
                    window.location = "/login";
                else if (result.status == 'error')
                    bootbox.alert('some problem occur try again.....');
                else
                {                   
                   $('#myModaltechnician').modal('hide');
                     showSuccessMessage('Technician updated');
								TableAjax.refresh();
                }
            }
        });
        /***********user ajax view ends here*******/
	
	
	});
	
	
	
	
	
	
	
	$(document).on('click','#change-common-status', function(){
		var $this = $(this);
		var table = $this.data('table');
		var token = $('meta[name=csrf-token]').attr("content");
		var id = $this.data('id');
		var status = $this.data('status');
		var action = $this.data('action');
		    $.confirm({
				title: 'Confirm!',
				content: 'Are you sure you want to change this to '+(status == true ? "Inactive" : "Active")+' ?',
				confirmButtonClass: 'btn-success',
				cancelButtonClass: 'btn-danger',
				confirmButton: 'Yes',
				cancelButton: 'No',
				theme: 'black',
				confirm: function(){
					
					$.ajax({
						url: path+'common/change-status',
						data : $this.closest('form').serialize()+'&id='+id+'&table='+table+'&status='+status+'&action='+action+'&_token='+token,
						dataType: 'json',
						type: 'post',
						beforeSend: function(){
							$this.html('<i class="fa fa-spin fa-spinner"></i>');
						},
						complete: function(){
							
						},
						success: function(json){
							console.log(json);
							if (json.success) {
								showSuccessMessage('Status changed');
								TableAjax.refresh();
							} else if (json.exception_message) {
								showErrorMessage('Something went wrong!!');
								TableAjax.refresh();
							}
						},
						error : function(xhr, ajaxOptions, thrownError) {
							showErrorMessage('Something went wrong!!');
						}
					});
				},
				cancel: function(){
				//$.alert('Canceled!')
				}
    });
	});
	
	$(document).on("click", "#deletetask", function () {
		
		
        var deleteLink = $(this).attr('deleteLink');
        bootbox.confirm("Are you sure you want to delete?", function (result) {
            if (result) {
                window.location = deleteLink;
            }
        });
    });
	
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
	
	
	
	
	
	
	 $('#plan_start_date_two').datepicker()
      .on('changeDate', function(ev){
		  
		
				var selected_date = new Date(ev.dates);
			

		var date = formatDate(selected_date);

		//alert(date);
	
       $('#plan_end_date_two').datepicker('setStartDate',date);
       $('.datepicker').hide();
       $('.filter-submit').click();  
        });
        
        
        
        
        $('#plan_end_date_two').datepicker()
      .on('changeDate', function(ev){
		  
		  var selected_date = new Date(ev.dates);


		var date = formatDate(selected_date);
		 // alert('end');
       $('#plan_start_date_two').datepicker('setEndDate', date);
       $('.datepicker').hide();
       $('.filter-submit').click();  
        });
	////////////////////    code for datepickers end    ////////////////////////////////////
	
 
	TableAjax.init();
	TableAjax.update();
});
</script>
<script src="{{ asset('js/techtask.js') }}"></script>
@endsection


