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
				    	{!! Form::model($locations,['method' => 'post','id'=>'add_template','url' => 'user/editlocation/'.Crypt::encrypt($locations->id) ]) !!}
				    
				    		@include('location.form')
				    		{!! Form::submit('Update Location') !!}
				    	{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</section>
	@include('footer')	


