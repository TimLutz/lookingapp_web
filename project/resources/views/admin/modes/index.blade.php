@extends('admin.layout')
@section('title')
	 Modes
@endsection
@section('heading')
	Manage Modes
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
								
									<table id="sample_modes" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="sample_6_info">
							<thead>
							<tr role="row">
								<th>
								  S No.
								</th>
								<th>
								  Mode Name	  		 
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
							@foreach($modes AS $mode)
							<?php
								$modeId = Crypt::encrypt($mode->id);
							?>
									<tr role="row">
										<td><?php echo $i; ?></td>
										<td class="sorting_1">
											{{ $mode->title }}	
										</td>
										<td>
											{!! Form::open(['method' => 'post' ]) !!}
											{!! $mode->setStatus($modeId, $mode->status) !!}
										  	{!! Form::close() !!}
										</td>										
										<td>
											{!! Form::open(['id' => 'deletePageForm','url' => 'admin/modes/'.$modeId,'method' => 'post' ]) !!}
				                            <a href="modes/{{$modeId}}/edit" class="btn btn-circle btn-icon-only btn-default"><span style="color:orange" title="Edit" class="icon-pencil" aria-hidden="true"></span></a>
				                            <!--<a href="javascript:void(0);" class="deleteuserRecord btn btn-circle btn-icon-only btn-default" data-id="{{$modeId}" data-confirm-message="Are you sure you want to delete this Mode?" style="color:red" title="Delete"><span class="fa fa-times" aria-hidden="true"></span></a>-->
												{!! Form::hidden('table','modes',['class' => 'form-control']) !!}
				                       		
				                        {!! Form::close() !!}
										</td>
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
	$('#sample_modes').dataTable({
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
