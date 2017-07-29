{{-- */use App\models\Product;/* --}}
{{-- */use App\models\SubCategory;/* --}}
{{-- */use App\models\Category;/* --}}
{{-- */use App\Settings;/* --}}
<!DOCTYPE html>
<html class="loader" lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title')- {{ config('app.website_name') }}</title>
	
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="icon" type="image/png"  href="{{ asset('images/favicon.png') }}"/>
	<link href="{{ asset('css/frontend/main.css') }}" rel="stylesheet" type="text/css" media="all" >
	<link href="{{ asset('css/frontend/main.css.map') }}" rel="stylesheet" type="text/css" media="all" >
	<link href="{{ asset('css/frontend/slider.css') }}" rel="stylesheet" type="text/css" media="all" >
	<link href="{{ asset('css/frontend/pnotify.all.min.css') }}" type="text/css" rel="stylesheet"> 
	<link href="{{ asset('css/frontend/waitMe.min.css') }}" rel="stylesheet" type="text/css" media="all" >
	<link href="{{ asset('css/frontend/custom.css') }}" rel="stylesheet" type="text/css" media="all" >
	
	@yield('css')
		
</head>

@if(isset($sliders))
<body class="box-area graphic">
@else
<body>
@endif

	<div id="loader-wrapper">
		<div class="loader-section section-left"></div>
		<div class="loader-section section-right"></div>
		<div id="loader"></div>
	</div>
	
	@if(isset($colorpick))
	<div id="wrapper" class="inner color">
	@elseif(isset($wemove))
	<div id="wrapper" class="inner add">
	@elseif(isset($sliders))
	<div id="wrapper" class="inner">
		@else
		<div id="wrapper">
		@endif
		<header id="header">
			<strong class="logo"><a href="{{url('/')}}"><img src="{{ url('images/logo/capitol_logo.png') }}"  alt="CAPITOL SHEDS.com" height="67" width="199"></a></strong>
			<nav id="nav">
				<a href="#" class="nav-opener"></a>
				<div class="nav-drop">
					<ul class="main-list">
						<li><a href="{{url('locations')}}">Locations </a></li>
						<li>
							<a href="{{ url('products') }}">Products</a>
							<div class="drop">
								<ul class="menu-list">
									<?php $categories = Category::where('status',1)->get();?>
										@if($categories)
										@foreach($categories as $k=>$category)
									<li>
									
										<a href="{{url('products/'.$category['alias'])}}">{{ $category->name }}</a>
										<div class="sub-drop">
											<ul class="sub-list">
												<?php $subcategories = SubCategory::where('category_id',$category->id)->where('status',1)->get();?>
												@foreach($subcategories as $k=>$subcategory)
												@if($subcategory->url_type == 1)
												<li><a href="{{ $subcategory->redirect_url }}" target="_blank">{{ $subcategory->name }}</a></li>
												@else
												<li><a href="{{ url('products/'.$category['alias'].'/'.$subcategory['alias']) }}">{{ $subcategory->name }}</a></li>
												@endif
												@endforeach
											</ul>
											
										</div>
									</li>
									
									@endforeach
									@endif
								</ul>
							</div>
						</li>
						<li><a href="{{ url('faqs') }}">FAQ</a></li>
						<li><a href="{{url('aboutus')}}">About Us</a></li>
						<li><a href="http://www.capitolsheds.com/newsandviews/" target="_blank">Blog</a></li>
						<li class="right">
							<a href="{{ url('product/request-query')}}">Request a Quote</a>
						
							</li>
					</ul>
				</div>
				<?php $num = Settings::where('type','number')->where('key','number')->pluck('value'); ?>
				<a href="tel:8888289743" class="tel">{{ $num }}</a>
			</nav>
			<div class="network-area">
				<a id="addthis" class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;username=capitolsheds"><img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a>
				<!--span class="lable">Share website on:</span-->
				<!--ul class="social-networks">
					<li><a href="http://www.twitter.com/capitolsheds" target = "_blank"><i class="icon-twitter"></i></a></li>
					<li class="facebook"><a href="http://www.facebook.com/capitolsheds" target = "_blank"><i class="icon-social-facebook"></i></a></li>
					<li class="googleplus"><a href="//plus.google.com/105391738898560181533?prsrc=3" target = "_blank"><i class="icon-google"></i></a></li>
				</ul-->
			</div>
		</header>
	
