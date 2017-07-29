@extends('layout')
@section('title')
Testimonials
@endsection
@section('content') 
<?php use App\Testimonials;?>
<main id="main" role="main">
			<section class="block-storage add">
				<div class="container">
					<div class="row">
						<div class="col-3 left-col">
							<h1>Testi–monials</h1>
							<p>Vivamus elementum semper <br> nisi. Aenean vulputate <br>eleifend tellus. </p>
						</div>
						<div class="col-9 right-col">
							<div class="image-holder">
								<img src="http://img.youtube.com/vi/Hqs7ECHR3MU/hqdefault.jpg" alt="image description">
								<a class="lightbox btn-play fancybox.iframe" href="https://www.youtube.com/embed/Hqs7ECHR3MU"></a>
							</div>
							<div class="caption-holder">
								<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="block-tabs">
				<ul class="tabset add">
					@foreach($loc as $loc_heading)
					<li>
						<a href="#loc_{{ $loc_heading->id }}" class="active">
							<span class="description">{{ $loc_heading->key}}</span>
						</a>
					</li>
					@endforeach
				</ul>
				<div class="tab-content add">
					<strong class="quote">”</strong>
					@foreach($loc as $loc_sec)
					<div id="loc_{{ $loc_sec->id }}" class="tab-area active">
						<div class="container">
							<div class="testimonial gallery-frame">
								<div class="mask">
									<div class="slideset">
								<?php $test_loc = Testimonials::where('loc_id',$loc_sec->id)->where('status',1)->OrderBy('sort_num','asc')->get();?>
								@foreach($test_loc->chunk(3) as $chunk)
								<div class="slide">
									@foreach($chunk as $tst_loc)
									
					<blockquote>
					<cite>{{ $tst_loc ->employee_name }}</cite>
					<q>“{{ $tst_loc ->description }}”.</q>
					<i class="icon">&rdquo;</i>
					</blockquote>
					
				                  	@endforeach
							
								</div>
								@endforeach
									</div>
								</div>
								<div class="pagination">
									<!-- pagination generated here -->
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</section>
		</main>
@endsection
