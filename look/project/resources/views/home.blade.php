@extends('layout')
@section('title')
{{$home_content['home_page_title']}} 
@endsection
@section('content')
{{-- */use repositories\CommonRepository;/* --}}
{{-- */use repositories\CommonRepositoryInterface;/* --}}
{{-- */use App\models\Image;/* --}}
{{-- */use App\models\Graphic;/* --}}
{{-- */use App\models\Product;/* --}}
<?php $common = new CommonRepository(); ?>
		<section class="visual-block">
			<div class="carousel">
				<div class="mask">
					<div class="slideset">
						@foreach($sliders as $slider)
						
						<div class="slide">
							<div class="bg-image"><span data-srcset="{{ url('uploads/'.$slider->image) }}"></span></div>
							<div class="container">
								<div class="frame">
									<h1>{{ $slider->name }}</h1>
									<p>{{ substr($slider['description'], 0, 105) }}</p>
									<ul class="btns-holder">
										<li><a href="{{ $slider['url'] }}"  target="_blank" class="lightbox btn">{{ $slider->button_text }}</a></li>
										<!--li><a class="lightbox btn-play fancybox.iframe" href="http://www.youtube.com/embed/9bZkp7q19f0?autoplay=1">See our video</a></li-->
									</ul>
								</div>
							</div>
						</div>
						@endforeach
						
					</div>
				</div>
				<div class="paginations">
					<ul>
						@foreach($sliders as $key=>$slider)
						<li>
							<a href="#">
								<span class="image-holder">
									<?php
									$photo= $slider->thumbnail;
									$url_img = asset('uploads/'.$photo);
								  ?>
									<img src="{{ $url_img }}" alt="image description" height="141" width="225" >
								</span>
								<span class="description">
									{{ $slider->name }}
								</span>
								<span class="active-description">
									<strong class="title">{{ $slider->name }}</strong>
									<span class="text-center">{{ substr($slider['description'], 0, 45) }}</span>
								</span>
							</a>
						</li>
						@endforeach
						
					</ul>
				</div>
				<a class="btn-prev" href="#"><i class="icon-chevron-small-left"></i></a>
				<a class="btn-next" href="#"><i class="icon-chevron-small-right"></i></a>
			</div>
		</section>
		<main id="main" role="main">
			<section class="block-product">
				<div class="container">
					<h2>Our Featured Products</h2>
					<div class="row post-area slow-animation">
						@foreach($grids as $key=>$grid)
						<article class="post col-3" data-animation="left">
							@if($key==0)
							<div class="frame active">
								@else
								<div class="frame">
								@endif
								@if($grid->type_value == 3)
								<div class="image-holder fullsize-image"><a href="{{ $grid->url }}"><img src="{{ CommonRepository::setPhoto(url('uploads/'.$grid->image),'225','141') }}" alt="image description" height="141" width="225"></a></div>
								<div class="text-holder">
									<?php
										$url = '';
										if($grid['urltype'] == 0)
										{
											$url = url('/'.$grid->url);
										}
										else
										{
											$url = $grid->url;
										}
									?>
									<strong class="title"><a href="<?php echo $url; ?>">{{ $grid->name }}</a></strong>
									<p>{{ substr($grid['description'], 0, 17) }}<?php if($grid['description']){ $countgrid = strlen($grid['description']);} if($countgrid>17){?>....<?php } ?></p>
								</div>
								@else
								<?php $prod = Product::where('id',$grid->product_id)->pluck('alias');?>
								<?php $image = Image::where('type',0)->where('type_id',$grid->product_id)->pluck('image_name'); ?>
								<?php $gridlength = strlen(strip_tags($grid->description));?>
								<div class="image-holder fullsize-image"><a href="{{ url($prod)}}"><img src="{{ CommonRepository::setPhoto(url('uploads/'.$image),'225','141') }}" alt="{{$grid->name}}" height="141" width="225"></a></div>
								<div class="text-holder">
									<strong class="title"><a href="{{ url($prod)}}">{{ $grid->name }}</a></strong>
									<p>@if($gridlength>17){{ substr(strip_tags($grid->description),0,17).'...' }}@else {{ substr(strip_tags($grid->description),0,17) }} @endif</p>
								</div>
								@endif
							</div>
						</article>
						@endforeach
						
					</div>
				</div>
			</section>
			<section class="testimonial-area">
				<div class="container">
					<div class="row">
						<div class="gallery-frame col-6" data-animation="left">
							<header class="head">
								<h2>Testimonials</h2>
							</header>
							<div class="testimonial">
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
						<div class="design-block pull-right col-6" data-animation="right">
							<h2>Shed Designer</h2>
							<p>{{$home_content['shed_designer']}} </p>
							<div class="image-holder"><img src="images/img14.jpg" alt="image description" height="100" width="463"/></div>
							<a href="{{url('shedsizer')}}" class="btn-more">more information</a>
						</div>
					</div>
				</div>
			</section>
			<section class="block-consultant slow-animation">
				<div class="container">
					<div class="col-left" data-animation="left">	
						<div class="bg-image"><span data-srcset="images/img15.jpg"></span></div>
						<h2>Request a Free Site Consultation</h2>
						<p>Would you like to have a storage shed, but don't know how you will get it in to your site?  Request a Free Site Consultation, some conditions apply.</p>
						<a href="{{ url('product/request-query') }}" class="btn-more">Get started now</a>
					</div>
					<div class="col-right" data-animation="right">
						<div class="info-area">
							<h2>Financing</h2>
							<p>{{$home_content['financing']}}</p>
							<a href="{{ url('financing') }}" class="btn-more">more information</a>
						</div>
						<div class="footer">
							<h3>Special! No Down Payment!</h3>
							<p>Up to 12 Month No Interest!</p>
						</div>
					</div>
				</div>
			</section>
			<section class="work-info">
				<div class="container">
					<div class="row">
						<div class="col-6 pull-left col-left" data-animation="left">
							<h2>We move sheds &amp; buy used sheds </h2>
							<p>{{$home_content['move_buy_sheds']}} </p>
							<a href="{{ url('we-move') }}" class="btn-more">more information</a>
						</div>
						<div class="col-5 pull-right col-right" data-animation="right">
							<i class="icon"><img src="images/icon1.png" alt="image description" height="48" width="48"></i>
							<h2>Informational Videos</h2>
							<p>{{$home_content['informational_videos']}}</p>
							<a href="{{ url('videos') }}" class="btn-more">more videos</a>
						</div>
					</div>
				</div>
			</section>
			<section class="block-location">
				<div class="container">
					<header class="head">
						<h2>Contact Us</h2>
						<a href="{{ url('product/request-query') }}" class="more">(See more)</a>
					</header>
					<div class="row">
						<?php $i = 0; ?>
						@foreach($locs as $key=>$loc)
						<article class="col-3 location-info" data-animation="left">
							<div class="frame">
								<div class="image-holder"><!--img src="images/img16.jpg" alt="image description"--><div id="map_canvas{{ $key }}" style="width: 100%; height: 141px;"></div>
							</div>
								<div class="text-holder"> 
									<strong class="title"><a href="{{ url('locations/'.Crypt::encrypt($i)) }}">{{ $loc->loc_name }}</a></strong>
								</div>
								<a href="{{ url('locations/'.Crypt::encrypt($i)) }}" class="more">Details</a>
							</div>
						</article>
						<?php $i += 1; ?>
						@endforeach 
					</div>
				</div>
			</section>
		</main>
		<?php 
		$countgraphic = 0;
		date_default_timezone_set('Asia/Kolkata');
	 	$currenttime =  date("Y-m-d H:i:sa"); 
		$graphic = Graphic::where('start_time','<=', $currenttime)->where('endtime','>=',$currenttime)->first();
		if($graphic){
			$countgraphic = count($graphic);
		}
		
		?>
			
			@if($graphic)
			<?php 
				$grap = \Crypt::encrypt($graphic->id);
				?>
				
				
			
			<div class="popup-holder">
		<div id="popup1" class="lightbox mygraphicpopup">
			<div class="block-payments add">
				<div class="image-holder"><a href="{{ url('graphic/'.$grap) }}"><img src="{{ url('uploads/'.$graphic->image_name) }}" alt="image description"></a></div>
				 <!--div class="description">
					<p>{{ $graphic->description }}</p>
					<!--p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.</p>
					<a href="#" class="btn-more">more details</a>
					<a href="#" class="close">close</a-->
				</div--> 
			</div>
		</div>
	</div>
			@endif

@endsection
@section('js')
<script 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmtlkZbTZIWYy6LZShXGaARICyXpJgfTw&amp;libraries=places">
    </script>
<!--
<script src="{{ asset('js/jquery.geocomplete.min.js') }}" type="text/javascript"></script> 
-->
     <script>
		   var delay = 100;
		 var infowindow = new google.maps.InfoWindow();
  var latlng = new google.maps.LatLng(-34.397, 150.644);
  var mapOptions = {
    zoom: 3,
    center: latlng,
	//scrollwheel: false,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  
  var bounds = new google.maps.LatLngBounds();
  
  var geocoder;
	var map;
	function initialize() {
	geocoder = new google.maps.Geocoder();
	 }

		 
function codeAddress(address,mapId) {
	
	geocoder.geocode( { 'address': address}, function(results,status) {
		if (status == google.maps.GeocoderStatus.OK) 
		{
			var myOptions = {
				zoom: 10,
				center: results[0].geometry.location,
				 scaleControl: false,
					draggable: false,
					scrollwheel: false,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}
			var map = new google.maps.Map(document.getElementById("map_canvas"+mapId), myOptions);
	
		//~ map = mapObj
			add_marer(results,map);
		}  
		else 
		{
		}
	});
}
	

	
	function add_marer(results,map) 
	{
		//console.log(results[0].geometry.location);
		var marker = new google.maps.Marker({
			map: map,
			title:results[0].formatted_address,
			position: results[0].geometry.location
		});
		var infowindow = new google.maps.InfoWindow({
			content: results[0].formatted_address
		});
		google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(map,marker);
		});
	}


	
	
	initialize();
	var addresses = <?php echo $addresses;?>;
	$.each(addresses, function(i, item) {
		
		var j = i+1;
		codeAddress(addresses[i],i);
	});
	
	
	
	
	
	
	var countgraphic = <?php echo $countgraphic; ?>;
	
	if(countgraphic > 0){
	
		  $.fancybox("#popup1");
	}
	
	
	
	

 </script>
 
 
 
 
 
 
 
@endsection
