@extends('layout')
@section('title')
FAQ's
@endsection
@section('content') 
<main id="main" role="main">
			<section class="block-faqs">
				<span class="question">?</span>
				<div class="container">
					<div class="row">
						<div class="col-3 info-box">
							<h1>faq</h1>
							<p>Have more questions?<br>Ask us now.</p>
							<a href="{{ url('product/request-query') }}" class="btn">contact us</a>
						</div>
						<div class="col-9 accordion-area">
							<ul class="accordion">
								@foreach($faqsdetail as $k=>$faqsdetail)
								<li class="<?php if($k==0){ ?>active <?php } else {}?>">
									<a href="#" class="opener">{{ $faqsdetail->question }}</a>
									<div class="slide">
										<div class="frame">
											<p>{!! $faqsdetail->answer !!}</p>
											<p></p>
										</div>
									</div>
								</li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
			</section>
			<section class="testimonial-area add">
				<div class="container">
					<div class="row">
						<div class="gallery-frame col-6">
							<header class="head">
								<h2>Testimonials</h2>
							</header>
							<div class="testimonial" data-animation="left">
								<div class="mask">
									<div class="slideset">
										@foreach($testimonials as $testimonial)
										<div class="slide">
											<blockquote>
												<cite>{{ $testimonial->employee_name }}</cite>
												<q>{{ substr($testimonial['description'], 0, 150).'...' }}</q>
												<i class="icon">&rdquo;</i>
											</blockquote>
											<a href="{{ url('testimonials') }}" class="btn-more">more testimonials</a>
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
				</div>
				<div class="image-compass" data-animation="right">
					<img src="images/img25.png" alt="image description">
				</div>
			</section>
		</main>
@endsection
