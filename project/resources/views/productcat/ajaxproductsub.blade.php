{{-- */use App\models\Image;/* --}}

				<section id="content">
					<header class="head">
						<a href="#" class="slide-opener"><span>Filter</span></a>
						<div class="result-counter animation" data-animation="fade">{{ $count_pro }} Results</div>
					</header>
					<div class="post-area row">
						
						@foreach($products as $product)
						<article class="post col-4 animation" data-animation="left">
							<div class="frame">
								<?php $image = Image::where('type',0)->where('type_id',$product->id)->pluck('image_name'); ?>
								<div class="image-holder"><a href="#"><img src="{{ url('uploads/'.$image) }}" alt="image description"></a></div>
								<div class="text-holder">
									<strong class="title"><a href="#">{{ $product->name }}</a></strong>
									<p>Lorem ipsum dolor</p>
								</div>
							</div>
						</article>
						@endforeach
						
					</div>
					<div class="pagination-area">
						<ul class="btns-holder animation" data-animation="right">
							<li class="btn-next"><a href="#"><i class="icon-chevron-small-left"></i></a></li>
							<li class="btn-prev"><a href="#"><i class="icon-chevron-small-right"></i></a></li>
						</ul>
						<ul class="pagination animation" data-animation="left">
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li class="active"><a href="#">4</a></li>
							<li><a href="#">5</a></li>
						</ul>
					</div>
				</section>
		
