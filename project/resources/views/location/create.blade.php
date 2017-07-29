@include('header')
<section>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-4">
						@include('sidebar')
					</div>
					<div class="col-md-8">
						
						@include('flash::message')
						{!! Form::open(['url'=>'user/addlocation']) !!}
							@include('location/form')
							{!! Form::submit('Add Location') !!}
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</section>
	@include('footer')				