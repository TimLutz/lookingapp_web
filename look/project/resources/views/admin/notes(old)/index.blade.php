@extends('admin.layout')
@section('title')
	 Note
@endsection
@section('heading')
	Manage Notes
	<a href="{{url('admin/notes/create')}}" class="btn btn-primary btn-sm pull-right">Add Note</a>
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
								  Title	  		 
								</th>
								<th>
								  Description
								</th>
								<th>
								  Created At
								</th>
								<th>
								  Action
								</th>
							</tr>
							</thead>
							<tbody>

							<?php 
							$i = 1;?>
							@foreach($notes AS $note)
							<?php
								$noteId = Crypt::encrypt($note->id);
							?>
									<tr role="row">
										<td><?php echo $i; ?></td>
										<td>
											{{ $note->title }}	
										</td>
										<td>
											<?php 
											if(strlen($note->description)> 20)
											{
												$mess = substr($note->description, 0,20).'..';
												echo $mess;
												
											}
											else
											{
												echo $note->description;
											}
											?>
										</td>
										<td>
											{{ date('d-m-Y',strtotime($note->created_at)) }}
										</td>										
										<td>
											{!! Form::open(['id' => 'deletePageForm','url' => 'admin/notes/'.$noteId,'method' => 'post' ]) !!}
				                            <a href="notes/{{$noteId}}/edit" class="btn btn-circle btn-icon-only btn-default"><span style="color:orange" title="Edit" class="icon-pencil" aria-hidden="true"></span></a>
				                            <a href="javascript:void(0);" class="deleteuserRecord btn btn-circle btn-icon-only btn-default" data-id="{{ $noteId }}" data-confirm-message="Are you sure you want to delete this Note?" style="color:red" title="Delete"><span class="fa fa-times" aria-hidden="true"></span></a>
												{!! Form::hidden('table','note',['class' => 'form-control']) !!}
				                       		
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
	$('#sample_modes').dataTable({
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
