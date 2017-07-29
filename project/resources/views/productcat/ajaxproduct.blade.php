{{-- */use App\models\Image;/* --}}
{{-- */use App\models\Product;/* --}}
{{-- */use repositories\CommonRepository;/* --}}
					@if(isset($products))
						@foreach($products as $product)
						<?php $pro = Product::where('id',$product->id)->pluck('alias');?>
						<article class="post col-4" >
							<div class="frame">
								<?php $image = Image::where('type',0)->where('type_id',$product->id)->pluck('image_name'); ?>
								<div class="image-holder fullsize-image"><a href="{{url($pro)}}"><img src="{{ CommonRepository::setPhoto(url('uploads/'.$image),'225','141') }}" alt="{{ $product->name }}"></a></div>
								<div class="text-holder">
									<?php $pronamelength = strlen($product->name);?>
									<?php $prodeslength = strlen(strip_tags($product->description));?>
									<strong class="title"><a href="{{url($pro)}}">@if($pronamelength>20){{ substr($product->name,0,20 ).'...' }}@else{{ substr($product->name,0,20 ) }}@endif</a></strong>
									<p>
										@if(!empty($prodeslength))
											@if($prodeslength>20)
												{{ substr(strip_tags($product->description),0,20).'...' }}
											@else 
												{{ substr(strip_tags($product->description),0,20) }}
											@endif
										@else
											&nbsp;
										@endif
									</p>
								</div>
							</div>
						</article>
						
						@endforeach
						@endif
						
	
		
							
						
	
		
