@extends('admin.layout')
@section('title')
 	Timeslots	
@endsection
@section('heading')
	Timeslots	
	<a href="{{url(getenv('adminurl').'/timeslot/create')}}" class="btn btn-primary btn-sm pull-right">Create Timeslot</a>
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
								<table id="date_formats" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="sample_6_info">
								
							<thead>
							<tr role="row">
							<th>S No.</th>
							<th>
									 From
								</th>
								<th>
									 To
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
							<?php $i = 1;?>
							@foreach( $dates as $date )
					<tr>
						<td><?php echo $i; ?></td>
						<td>{{ $date['from'] }}</td>
						<td>{{ $date['to'] }}</td>
						
						<td id ="appendstatus">
						@if($date->status == 1)
						<a  id="change-common-status" data-table="timeslots" data-id="{{$date->id}}" data-status="{{$date->status}}" data-action="timeslots"><i class="fa fa-circle text-success active"></i><a>
						@else
						<a  id="change-common-status" data-table="timeslots" data-id="{{$date->id}}'" data-status="{{$date->status}}" data-action="timeslots"><i class="fa fa-circle text-danger inactive"></i><a>
						@endif
						
						</td>
						<td>
						{!! Form::open(['url' => 'admin/dataformat/'.Crypt::encrypt($date['id']),'method' => 'delete' ]) !!}
						 <a href="timeslot/edit/{{Crypt::encrypt($date['id'])}}"  title="Edit"><span class="icon-pencil btn btn-circle btn-icon-only btn-default" style="color:orange" aria-hidden="true"></span></a>
						 
						 <a id="deletetimeslot" class="btn btn-circle btn-icon-only btn-default" deletelink="timeslot/delete/{{Crypt::encrypt($date['id'])}}">
							<span class="icon-trash" aria-hidden="true" title="Delete" style="color:brown"></span></a>
						 
						
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
	$('#date_formats').dataTable({
	"aoColumns": [
			  null,
			  null,
			  null, 
			   null, 
			  
			  { "bSortable": false }
			  ]          	
		
	});
	
	
	//code for deleting timeslots
	$(document).on("click", "#deletetimeslot", function () {
		
		//alert('sdjfldsl');
        var deleteLink = path+'/'+adminname+'/'+$(this).attr('deleteLink');
       
        bootbox.confirm("Are you sure you want to delete?", function (result) {
            if (result) {
                window.location = deleteLink;
            }
        });
    });
    
    
    
    // code for changing status
     $(document).on('click','#change-common-status', function(){
		var $this = $(this);
		var table = $this.data('table');
		var token = $('meta[name=csrf-token]').attr("content");
		var id = $this.data('id');
		var status = $this.data('status');
		var action = $this.data('action');
		 bootbox.confirm('Are you sure you want to change this to '+(status == true ? "Inactive" : "Active")+' ?', function (result) {
            if (result) {
				
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
								if(status == 0){
									
								$this.parent().html('<a  id="change-common-status" data-table="timeslots" data-id="'+id+'" data-status="1" data-action="timeslots"><i class="fa fa-circle text-success active"></i><a>');
								
								}else{
									
								$this.parent().html('<a  id="change-common-status" data-table="timeslots" data-id="'+id+'" data-status="0" data-action="timeslots"><i class="fa fa-circle text-danger inactive"></i><a>');
								}
									
							} else if (json.exception_message) {
								showErrorMessage('Something went wrong!!');
								TableAjax.refresh();
							}
						},
						error : function(xhr, ajaxOptions, thrownError) {
							showErrorMessage('Something went wrong!!');
						}
					});
            }
        });
	});
});
</script>
@endsection
