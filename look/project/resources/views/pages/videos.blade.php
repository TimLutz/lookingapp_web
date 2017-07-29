{{-- */use App\Settings;/* --}}
@extends('layout')
@section('title')
Videos
@endsection
@section('content') 
<?php use App\models\Video;?>
<main id="main" role="main">
			<section class="block-storage add img">
				<div class="container">
					<div class="row">
						<div class="col-3 left-col">
							<h1>our videos</h1>
							<?php $address_loc = Settings::where('type','text_videos')->where('key','text_videos')->pluck('value');?>
							<p>{!! $address_loc !!} </p>
						</div>
						<div class="col-9 right-col">
							<div class="carousel">
								<div class="mask">
									<div class="slideset">
										@foreach($videosdetail as $videosdetail)
										<?php $image =  explode("embed/",$videosdetail->url_name);
										?>
										<div class="slide">
											<div class="image-holder">
												<img src="http://img.youtube.com/vi/<?php echo $image[1]; ?>/hqdefault.jpg" alt="image description">
												<a class="lightbox btn-play fancybox.iframe" href="{{ $videosdetail->url_name}}"></a>
											</div>
											<div class="caption-holder">
                                            <h6 class="video_page">{{ $videosdetail->title}}</h6>
												<p>{{ $videosdetail->description }}</p>
												<p></p>
											</div>
										</div>
										@endforeach
									</div>
								</div>
								<a href="#" class="btn-prev"><i class="icon-chevron-small-left"></i></a>
								<a href="#" class="btn-next"><i class="icon-chevron-small-right"></i></a>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="block-videos">
				<div class="container">
					<header class="head">
						<h2>Other Suggested Videos</h2>
					</header>
					<div class="row">
						<div class="carousel-items">
							<?php $videosdetaily = Video::where('status',1)->OrderBy('sort_num','asc')->get(); ?>
							<div class="mask">
								<div class="post-area">
									@foreach($videosdetaily as $videosdetail)
									<?php $image =  explode("embed/",$videosdetail->url_name);
										?>
									<article class="post">
										<div class="frame active">
											<div class="image-holder">
												<img src="http://img.youtube.com/vi/<?php echo $image[1]; ?>/hqdefault.jpg" alt="image description">
												<a class="lightbox btn-play fancybox.iframe" href="{{ $videosdetail->url_name}}"><img src="images/btn-play.png" alt="btn-play"></a>
											</div>
											<div class="text-holder">
												<strong class="title"><a href="#">{{ $videosdetail->title}}</a></strong>
												<p>{{ $videosdetail->subtitle}}</p>
											</div>
										</div>
									</article>
									@endforeach
								</div>
							</div>
							<div class="pagination"></div>
						</div>
					</div>
				</div>
			</section>
		</main>
@endsection
