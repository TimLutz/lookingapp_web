@extends('admin.layout')
@section('css')
<link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('title')
	Tasks	
@endsection
@section('content')
<h3 class="page-title">
Tasks
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
			<a href="{{ url(getenv('adminurl').'/tasks/') }}">Manage Tasks</a>
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
								
								<input type="hidden" name="action" value="tasks/list-tasks"/>
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
									<th width="10%">
										 Task Name
									</th>
									<th width="10%">
										 Requested By
									</th>
									<th width="10%">
										Requested Date & Time
									</th>
									

									<th width="10%">
										Client Type  &nbsp &nbsp &nbsp &nbsp &nbsp 
									</th>
									<th width="10%">
										Property Attribute 
									</th>

									<th width="10%">
										Technician Assigned 
									</th>
									<th width="10%">
										 Priority &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
									</th>
									<th width="10%">
										 Status &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
									</th>

									<th class="a" width="15%">
										 Actions &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
									</th>

								</tr>
								<tr role="row" class="filter">
<!--
									<td></td>
-->
									<td>
											
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" name="task_name" id="task_name" autocomplete="off">	
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" name="requestedby" id="requestedby" autocomplete="off">
									</td>
									<td>
										<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd" id="plan_start_date">
											<input type="text" class="form-control form-filter input-sm" readonly name="requested_at_from" placeholder="From">
											<span class="input-group-btn">
											<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
										<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd" id="plan_end_date">
											<input type="text" class="form-control form-filter input-sm" readonly name="requested_at_to" placeholder="To">
											<span class="input-group-btn">
											<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
<!--
										<input type="text" class="form-control form-filter input-sm" name="email" id="email" autocomplete="off">
-->
									</td>
									
									<td>
						{!! Form::select('typeuser', array(''=>'--select--','1' => 'Realtor', '2' => 'Houseowner'),null,['class' => 'form-control form-filter input-sm', 'id' => 'typeuser']) !!}

										</td>
										<td>
					
									

										
										</td>
									<td>

									<input type="text" class="form-control form-filter input-sm" name="technicianassigned" id="technicianassigned" autocomplete="off">

										
										</td>
									<td>
										
	{!! Form::select('priority', array(''=>'--select--','1' => 'High', '2' => 'Medium','3'=>'Low'),null,['class' => 'form-control form-filter input-sm']) !!}
									</td>
									<td>
										{!! Form::select('status', array(''=>'--select--','1' => 'Pending', '2' => 'Declined','3'=>'Accepted','4'=>'Completed'),null,['class' => 'form-control form-filter input-sm']) !!}
									
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
<script type="text/javascript" src="{{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script>
jQuery(document).ready(function() {
	
	/******************* closing view pop up on clicking esc key {start}****************/
			$(document).keyup(function(e) {
			if (e.keyCode === 27) {
		$('#changetechnician')[0].reset();
		$('#changestatus')[0].reset();
		$(".form-group").removeClass("has-error");
			$(".help-block").hide();
			$('.close').click()

			}  // esc
			});
		/******************* closing view pop up on clicking esc key {end}****************/
	
	
		$('.start_date').datepicker( {
    format: "yyyy-mm",
    startView: "months", 
    minViewMode: "months",
      onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            
        }
        
        
});

 $('.start_date').datepicker()
      .on('changeDate', function(ev){
		   $('.datepicker').hide();
	  });
	
	
	$(document).on("click",".dismisspopup", function(){
		$('#changetechnician')[0].reset();
		$('#changestatus')[0].reset();
		$(".form-group").removeClass("has-error");
			$(".help-block").hide();
	});
	
	
	
	
	
	
    $(document).on("click", ".changestatus", function () {
	 $('#myModal').modal({

                backdrop: 'static',

                keyboard: false,

            });
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
	 $('#myModaltechnician').modal({

                backdrop: 'static',

                keyboard: false,

            });
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
                   $('#assigneddate').val(result.assigned_date);
                   if(result.task.start_datetime == '0000-00-00 00:00:00')
                   {}
                   else{
					   $('#start_datetime').val(result.task.start_datetime);
					   }
                    if(result.task.end_datetime == '0000-00-00 00:00:00'){
						
					}
					else{
						$('#end_datetime').val(result.task.end_datetime);
					}
                     $('#priority').val(result.task.priority);
                     $('#note_detail').val(result.task.note_detail);
                   
							 $("#appenddata").html(result.message);
							 
							 
                       
                   $('#myModaltechnician').modal('show');
               
            }
        });
        /***********user ajax view ends here*******/
	
	
	});
	
	
	$(document).on("click", "#updatestatus", function () {
		addLoader();
	 $('.statuschangebutton').prop('disabled', true);
	 /***********user ajax view *******/
        var url_for_user_view = adminname+'/updatestatus';

        var formdata = $('#changestatus').serialize();
      //  alert(formdata);
        $.ajax({
            
			 url: path+url_for_user_view,
            type: "POST",
            data: formdata,
            dataType: "JSON",
            success: function (result) {
				removeLoader();
				$('.statuschangebutton').prop('disabled', false);
				
                if (result.status == 'taskcompleted')
                    showErrorMessage('Cannot change status of a completed task');
                else if (result.status == 'error')
                    bootbox.alert('some problem occur try again.....');
                else
                {                   
                   $('#myModal').modal('hide');
                      showSuccessMessage('status updated');
								TableAjax.refresh();
                }
                $('#changestatus')[0].reset();
            },
            
        });
        /***********user ajax view ends here*******/
	
	
	});
	
	
		$(document).on("click", "#updatetechnician", function () {
			addLoader();
		$('.technicianchangebutton').prop('disabled', true);
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
				removeLoader();
				$('.technicianchangebutton').prop('disabled', false);
                if (result.status == 'inactiveuser')
                    showErrorMessage('Cannot assign technician to inactive user');
                else if (result.status == 'taskcompleted')
                    showErrorMessage('Cannot assign technician to a completed task');
                else if (result.status == 'error')
                    bootbox.alert('some problem occur try again.....');
                else
                {                   
                   $('#myModaltechnician').modal('hide');
                     showSuccessMessage('Technician updated');
								TableAjax.refresh();
                }
                $('#changetechnician')[0].reset();
            },
            error: function(xhr, ajaxOptions, thrownError) {
				
				removeLoader();
				
				$('.technicianchangebutton').prop('disabled', false);
			console.log(xhr);
			$(".form-group").removeClass("has-error");
			$(".help-block").hide();
			$.each(xhr.responseJSON, function(i, obj)
			
				{
					$('input[name="'+i+'"]').closest('.form-group').addClass('has-error');
					$('input[name="'+i+'"]').closest('.form-group').find('label.help-block').slideDown(400).html(obj);
					$('select[name="'+i+'"]').closest('.form-group').addClass('has-error');
					$('select[name="'+i+'"]').closest('.form-group').find('label.help-block').slideDown(400).html(obj);
				
				});
					
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
	
	
	////////////////////    code for datepickers end    ////////////////////////////////////
	
	
	/////////////////////    code for timepicker start    ////////////////////////////////
	var crntdate = new Date();
	//alert(crntdate);
			$('#start_datetime').datetimepicker({
				startDate: crntdate,
				
			});
			$('#end_datetime').datetimepicker({
				startDate: crntdate,
			});
			
			 $('#start_datetime').datetimepicker()
      .on('changeDate', function(ev){
		 
		 var de =  $("#start_datetime").data("datetimepicker").getDate();
		   var end = new Date(de);
		 
		   //end.setHours(23,59,59,999);
            end.setHours(23);
            end.setMinutes(59); 
			end.setSeconds(59);
			 
          $('#end_datetime').datetimepicker('setEndDate', end); 
          $('#end_datetime').datetimepicker('setStartDate', de); //set max end date is 7 day earlier then end date
		  
		 
		   
		  
	  });
			$('#end_datetime').datetimepicker()
      .on('changeDate', function(ev){
		  
		   var ds =  $("#end_datetime").data("datetimepicker").getDate();
		  
		     var start = new Date(ds);
		    
		      start.setHours(0);
            start.setMinutes(0); 
			start.setSeconds(0);
		      $('#start_datetime').datetimepicker('setEndDate', ds); //set max end date is 7 day earlier then end date


           $('#start_datetime').datetimepicker('setStartDate', start); //set max end date is 7 day earlier then end date
		  
		   });
			
             
   ////////////////////    code for timepicker end    ////////////////////////////////////
 
	TableAjax.init();
	TableAjax.update();
});
</script>
<script src="{{ asset('js/task.js') }}"></script>
@endsection


