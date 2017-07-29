							
{{-- */use App\models\Image;/* --}}

{{-- */use repositories\CommonRepository;/* --}}
					@if(isset($subcats))
						@foreach($subcats as $subcat)
						<?php //$pro = Product::where('id',$product->id)->pluck('alias');?>
						<article class="post col-4" >
							<div class="frame">
								<?php
									$url = '';
									$target = '';
									if($subcat->url_type == 0)
									{
										$url = url('products/'.$categoryData.'/'.$subcat->alias); 
										$target = '_self';
									}
									else
									{
										$url = $subcat->redirect_url;
										$target = '_blank';
									}
								?>
								<div class="image-holder fullsize-image"><a href="{{ $url }}"><img src="{{ CommonRepository::setPhoto(url('uploads/'.$subcat->image),'225','141') }}" alt="{{ $subcat->name }}" target={{$target}}></a></div>
								<div class="text-holder">
									<?php $pronamelength = strlen($subcat->name);?>
									
									<strong class="title"><a href="{{ $url }}" target={{$target}}>@if($pronamelength>20){{ substr($subcat->name,0,20 ).'...' }}@else{{ substr($subcat->name,0,20 ) }}@endif</a></strong>
								</div>
							</div>
						</article>
						
						@endforeach
						@endif