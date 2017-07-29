@extends('layout')
@section('title')
About Us
@endsection
@section('content')
		<main id="main" role="main">
			<section class="main-post">
				<div class="container">
					<div class="image-holder"><img src="images/img20.jpg" alt="iamge description"></div>
					<div class="text-holder">
						<h1>{{ $title }}</h1>
						<p>{{ $description }}</p>
					</div>
				</div>
			</section>
			<section class="block-about">
				<div class="container">
					<h2>{{ $name }}</h2>
					<div class="row">
						<div class="col-12 frame" data-animation="left">
						<p>{!! $content !!}</p>
						</div>
						<!--div class="col-6 frame" data-animation="left">
							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
						</div>
						<div class="col-6 frame" data-animation="right">
							<p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus.</p>
						</div-->
					</div>
				</div>
			</section>
			<section class="block-staff">
				<div class="container">
					<h2>Our Staff</h2>
					<div class="staff-carousel">
						<div class="mask">
							<div class="slideset">
								
								@foreach($staffs as $staff)
								<div class="slide">
									<div class="image-holder">
										<img src="{{ url('uploads/'.$staff->image) }}"  alt="image description">
									</div>
									<div class="caption-holder">
										<h3>{{ $staff->name }}</h3>
										<span class="designation">{{ $staff->designation }}</span>
										<ul class="social-networks">
											@if($staff->twitter != '')
											<li><a href="{{ $staff->twitter }}" target="_blank"><i class="icon-twitter"></i></a></li>
											@else
											
											@endif
											@if($staff->facebook != '')
											<li class="facebook"><a href="{{ $staff->facebook }}"target="_blank"><i class="icon-social-facebook" ></i></a></li>
											@else
											
											@endif
										</ul>
									</div>
								</div>
								@endforeach
								
								
							</div>
						</div>
						<a class="btn-prev" href="#"><i class="icon-chevron-small-left"></i></a>
						<a class="btn-next" href="#"><i class="icon-chevron-small-right"></i></a>
					</div>
				</div>
			</section>
		</main>
		@endsection
@section('js')
<script> 
	$(document).ready(function(){
		setTimeout(function(){
			$('.slide').removeClass('active');
		},2000);
		$('.btn-next,.btn-prev').click(function(){$('.slide').removeClass('active');})
	});
</script>
@endsection
