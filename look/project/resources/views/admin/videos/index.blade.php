{{-- */use repositories\CommonRepositoryInterface;/* --}}
{{-- */use repositories\CommonRepository;/* --}}
<?php  $common = new CommonRepository(); ?>
@extends('admin.layout')
@section('title')
	 Videos	
@endsection
@section('heading')
	Videos
	<a href="{{url('admin/videos/create')}}" class="btn btn-primary btn-sm pull-right">Create Video</a>
@endsection
@section('content')
<div class="row">
	<!-- left column -->
	<div class="col-md-12">
		        @include('models.user_delete')	
				@include('models.status')
				@include('flash::message')
					<div id="results" class="portlet box">
					<input type="hidden" name="action" value="videos"/>
						<div class="portlet-body">
							<div id="sample_video_wrapper" class="dataTables_wrapper no-footer">
								<div class="row">
							      </div>
				<table id="sample_video"  class="table table-striped table-bordered table-hover dataTable no-footer sample_video">
					<thead><span class="star multi_delete text-red"></span>
						<tr>
						<th class="table-checkbox">
						<input type="checkbox" class="group-checkable" data-set="#sample_video .checkboxes"/>
							</th>
						    <th>S.No</th>														
							<th>Order Number</th>
							<th>Title</th>	
							<th>Sub-title</th>						
							<th>URL</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					
					<?php $key = ($videos->currentPage() - 1) * $videos->perPage() + 1; ?>
					@foreach( $videos as $index => $video )
					<?php $video_id = $common->encryptID($video->id); ?>
					<tr>
						<td>{!! Form::checkbox('users[]', $video_id,null,['class'=>'records_id checkboxes']); !!}</td>
						
						<td>{{ $key }}</td>						<td>{{ $video->sort_num }}</td>
						<td>{{ $video->title }}</td>
						<td>{{ $video->subtitle }}</td>
						<td>{{ substr($video->url_name,0,40) }}</td>
						<td>
						  {!! Form::open(['method' => 'post' ]) !!}
						      {!! $video->setStatus($video_id, $video->status) !!}
						  {!! Form::close() !!}
						</td>
						<td>
						{!! Form::open(['id' => 'deletePageForm','url' => 'admin/videos/'.$video->id,'method' => 'post' ]) !!}
							<a href="videos/{{$video_id}}/edit" title="Edit"><span style="color:orange" title="Edit" class="icon-pencil btn btn-circle btn-icon-only btn-default" aria-hidden="true"></span></a>
							
							<a href="javascript:void(0);" class="deleteuserRecord btn btn-circle btn-icon-only btn-default" data-id="{{$video_id}}" data-confirm-message="Are you sure you want to delete this Video?" style="color:red" title="Delete"><span class="icon-trash" aria-hidden="true"></span></a>
								{!! Form::hidden('table','videos',['class' => 'form-control']) !!}
                        {!! Form::close() !!}
						</td>
					</tr>
					<?php  $key++;  ?>
					@endforeach
					</tbody>
				</table>
					</div>
					{!! Form::button('Delete Multiple Record',['class'=>"btn btn-primary marginBotTopbtn",'onclick'=>"deleteMultipleRecords('videos','videos')"]); !!}
					</div>
				</div>
				</div>
			</div>
			
@endsection
@section('js')
<script src="{{ asset('js/videotable-managed.js') }}"></script>
<script>
jQuery(document).ready(function() {  
	TableManaged.init();  
	$(document).ajaxComplete(function(){
		 $('#sample_video').dataTable().fnDestroy();
		 TableManaged.init(); 
});
});
</script>

@stop
