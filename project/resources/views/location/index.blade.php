@include('header')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-4">
					@include('sidebar')
				</div>
				<div class="col-md-8">
					@include('flash::message')
					<div class="title">
						<h3><a href="{{ url('/user/addlocation') }}" class="btn btn-primary pull-right">New Location</a></h3>
						<div id="sample_6_wrapper" class="dataTables_wrapper no-footer">
								<div class="row">
							
								</div>
								<table id="sample_templt" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="sample_6_info">
								
							<thead>
							<tr role="row">
							<th>S No.</th>
							<th>
									 Company/Person Name
								</th>
								<th>
									 Address
								</th><th>
									 Defualt Location
								</th>
								
								<th>
									  Email
								</th>
								<th>
									 Mobile
								</th>
								<th>
									Action
								</th>
								</tr>
							</thead>
							<tbody>
							<?php $i = 1;?>
							@foreach( $locations as $location)
							<?php
								$locId = Crypt::encrypt($location->id);
							?>
					<tr>
						<td><?php echo $i; ?></td>
						<td>{{ $location->contact_name }}</td>
						<td>{{ $location->street_no }} {{ $location->street_name }}</td>
						<td>
						<?php
							if($location->pick_loc == 1 && $location->drop_loc == 0)
							{
								echo "Pickup is Defualt Location";
							}
							else if($location->pick_loc == 0 && $location->drop_loc == 1)
							{
								echo "Dropof is default location";
							}
							else if($location->pick_loc == 1 && $location->drop_loc == 1)
							{
								echo "Pickup and Dropof are Default Location";
							}
							else
							{
								echo "No default location";
							}
						?>	
						</td>
						<td>
							{{ $location->email }}
						</td>
						<td>
							{{ $location->mobile }}
						</td>
						<td>
						{!! Form::open(['url' => 'location/'.$locId,'method' => 'delete' ]) !!}
						<a href="editlocation/{{$locId}}" class="btn btn-circle btn-icon-only btn-default"><span style="color:orange" title="Edit" class="icon-pencil" aria-hidden="true"></span></a>
						 
						
						{!! Form::close() !!}
						</td>
					</tr>
					<?php  $i++;  ?>
					@endforeach
							</tbody>
							</table>
								</div>
					</div>

				</div>
			</div>
		</div>
	</div>	
	@section('js')
	<script src="{{ asset('js/common-user.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/common.js') }}" type="text/javascript"></script>
	@endsection
@include('footer')		