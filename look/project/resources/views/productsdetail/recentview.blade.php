{{-- */use repositories\CommonRepository;/* --}}
{{-- */use App\models\Product;/* --}}
{{-- */use App\models\Image;/* --}}
<section class="block-product add">
				<div class="container">
					<header class="head">
						<h2>Recently Viewed</h2>
					</header>
					<div class="row">
						<div class="carousel-items">
							<div class="mask">
								<div class="post-area">
									<?php   
									
									 //$products = CommonRepository::getrecentlyviewed();
					                 $result = array_unique($products);
					                 
									 ?>
									 	
									@if(isset($result))
									<?php //$recent_prods = Product::wherein('id',$products)->get(); ?>
									@foreach($result as $k=>$recent_prod)
								
									<?php 
									//echo $recent_prod;
									$pro2 = Product::where('id',$recent_prod)->first();?>
									<?php $image2 = Image::where('type',0)->where('type_id',$recent_prod)->pluck('image_name'); ?>
									<article class="post">
										<div class="frame <?php if($k==0){ ?>active <?php } else {}?>">
											<div class="image-holder fullsize-image"><a href="{{url($pro2->alias)}}"><img src="{{ CommonRepository::setPhoto(url('uploads/'.$image2),'225','141') }}" alt="image description"></a></div>
											<div class="text-holder">
												<strong class="title"><a href="{{url($pro2->alias)}}">{{ $pro2->name }}</a></strong>
												<?php $prodeslength = strlen(strip_tags($pro2->description));?>
												<p>@if($prodeslength>15){{ substr(strip_tags($pro2->description),0,15).'...' }}@else {{ substr(strip_tags($pro2->description),0,15) }} @endif</p>
											</div>
										</div>
									</article>
									@endforeach
									@endif
								</div>
							</div>
							@if($prodcount>4)
							<div class="pagination"></div>
							<a href="#" class="btn-prev"><i class="icon-chevron-small-left"></i></a>
							<a href="#" class="btn-next"><i class="icon-chevron-small-right"></i></a>
							@endif
						</div>
					</div>
				</div>
			</section>
