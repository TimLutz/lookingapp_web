{{-- */use App\Property;/* --}}
{{-- */use App\PropertyAttribute;/* --}}
{{-- */use App\User;/* --}}
@extends('admin.layout')	
@section('title')
Properties
@endsection
@section('heading')
	Properties
	
@endsection
@section('content')

		<div class="portlet box">
						
						<div class="portlet-body">
						@include('flash::message')
							<div id="sample_6_wrapper" class="dataTables_wrapper no-footer">
								<div class="row">
							
								</div>
								
									<table id="sample_users" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="sample_6_info">
							<thead>
							<tr role="row">
								<th>#</th>
								<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 176px;" aria-label="
									 Rendering engine
								" data-column-index="0">
								
									 Homeuser
								</th>
								<th>
									 Property Name
								</th>
								<th>
									 Property Address
								</th>
								<th>
									 Rooms
								</th>
								
								<th>
									Action
								</th>
								</tr>
							</thead>
							<tbody>
							
							@if(count($properties) > 0)
													<?php $sno = '1';?>
								@foreach($properties as $prop)
								<?php
								
									$userId =\Crypt::encrypt($prop->id);
								?>
									<tr>
										<?php $username = User::where('id',$prop->user_id)->pluck('name');?>
										<td>{{$sno}}</td>
										<td>{{ ucfirst($username) }}</td>
										<td>{{ $prop->property_name }}</td>
										<td>{{ $prop->property_address }}</td>
										<?php $attributes = PropertyAttribute::where('prop_id',$prop->id)->get();
										$countall = count($attributes); ?>
										<td>@foreach($attributes as $key => $attribute){{ $attribute->attribute_name }}@if($key+1 < $countall),@else @endif @endforeach</td>
										
											<td>
											{!! Form::open(['id' => 'deletePageForm','url' => 'admin/users/'.$userId,'method' => 'post' ]) !!}
												<a class="btn btn-circle btn-icon-only btn-default" name="view" id="view" title="View Detail" href="properties/show/<?php echo $userId; ?>" 
												>
												<span class="icon-eye" style="color:blue;"></span>
												</a>
												 <a href="properties/edit/<?php echo Crypt::encrypt($prop->id) ?>" class="btn btn-circle btn-icon-only btn-default"><span style="color:orange" title="Edit" class="icon-pencil" aria-hidden="true"></span></a>
												<a href="javascript:void(0);" class="deleteuserRecord btn btn-circle btn-icon-only btn-default" data-id="<?php echo $userId; ?>" data-confirm-message="Are you sure you want to delete this user?" style="color:red" title="Delete"><span class="icon-trash" aria-hidden="true"></span></a>
												{!! Form::hidden('table','users',['class' => 'form-control']) !!}
											{!! Form::close() !!}
										</td>
									</tr>
									<?php $sno++; ?>
									@endforeach
							</tr>
							
							@endif
							</tbody>
							</table>
								</div>
							
						</div>
					</div>
					
@endsection
@section('js')
<script>
jQuery(document).ready(function() {    
	$('#sample_users').dataTable({
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

