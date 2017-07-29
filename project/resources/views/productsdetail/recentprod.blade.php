{{-- */use repositories\CommonRepository;/* --}}
{{-- */use App\models\Image;/* --}}
{{-- */use App\models\Product;/* --}}
<section class="block-product add">
				<div class="container">
					<header class="head">
						<h2>Related Products</h2>
					</header>
					<div class="row">
						<div class="carousel-items">
							<div class="mask">
								<div class="post-area">
							<?php   $related_prods = CommonRepository::getrelatedprods($productsdetail);
							$relatedprodscount = count($related_prods);?>
							@if(isset($related_prods))
							@foreach($related_prods as $k=>$related_prod)
							<?php $pro =Product::where('id',$related_prod->id)->pluck('alias');?>
							<article class="post">
							<div class="frame <?php if($k==0){ ?>active <?php } else {}?>">
							<?php $image = Image::where('type',0)->where('type_id',$related_prod->id)->pluck('image_name'); ?>
							<div class="image-holder fullsize-image"><a href="{{url($pro)}}"><img src="{{ CommonRepository::setPhoto(url('uploads/'.$image),'225','141') }}" alt="image description"></a></div>
							<div class="text-holder">
							<strong class="title"><a href="{{url($pro)}}">{{ $related_prod->name }}</a></strong>
							
							<?php $prodeslength = strlen(strip_tags($related_prod->description));?>
							
							<p>@if($prodeslength>15){{ substr(strip_tags($related_prod->description),0,15).'...' }}@else {{ substr(strip_tags($related_prod->description),0,15) }} @endif</p>
							</div>
							</div>
							</article>
							@endforeach
							@endif
							</div>
							</div>
							@if($relatedprodscount > 4)
							<div class="pagination"></div>
							<a href="#" class="btn-prev"><i class="icon-chevron-small-left"></i></a>
							<a href="#" class="btn-next"><i class="icon-chevron-small-right"></i></a>
							@endif
						</div>
					</div>
				</div>
			</section>
