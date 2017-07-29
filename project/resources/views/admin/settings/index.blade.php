{{-- */use App\Settings;/* --}}

@extends('admin.layout')
@section('title')
	 Settings
@endsection
@section('heading')
	Settings
	<!--a href="{{url('admin/setting/create')}}" class="btn blue btn-sm pull-right">Create</a-->
@endsection
@section('content')

<div class="row">
				<div class="col-md-12">
					@include('flash::message')
					<div class="portlet box">
						
						<div class="portlet-body">
							<div class="dataTables_wrapper no-footer">
								<div class="row">
							
								</div>
								
									<table id="settings" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="sample_6_info">
							<thead>
							<tr role="row">
							<th>S No.</th>
							<th>
									  Type
								</th>
								<th>
									 value
								</th>
								
								<th>
									  Action
								</th>
								</tr>
							</thead>
							<tbody>
							<?php $i = 1;?>
							@foreach($settings AS $setting)
									<tr>
										<td><?php echo $i; ?></td>
										<td>
											{{ $setting->type }}	
										</td>
										<td>
											
											{{ $setting->value }}	
										</td>
										
																			
										<?php $prod_id = Crypt::encrypt($setting->id);?>
										<td>
											{!! Form::open(['id' => 'deletePageForm','url' => 'admin/setting/'.Crypt::encrypt($setting->id),'method' => 'post' ]) !!}
											<!--a href="setting/{{$prod_id}}" class="btn btn-circle btn-icon-only btn-default" name="view" id="view" title="View Detail"><span class="icon-eye" style="color:blue;"></span></a-->
				                            <a href="setting/<?php echo Crypt::encrypt($setting->id) ?>/edit" class="btn btn-circle btn-icon-only btn-default"><span style="color:orange" title="Edit" class="icon-pencil" aria-hidden="true"></span></a>
				                           <!--a href="javascript:void(0);" class="deleteuserRecord btn btn-circle btn-icon-only btn-default" data-id="{{$prod_id}}" data-confirm-message="Are you sure you want to delete this setting?" style="color:red" title="Delete"><span class="icon-trash" aria-hidden="true"></span></a-->
												
											{!! Form::hidden('table','settings',['class' => 'form-control']) !!}
				                       		
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
	$('#settings').dataTable({
	"aoColumns": [
			  null,
			  null,
			  null, 
			  null
			  
			  ]
		
	});
});
</script>
@stop
