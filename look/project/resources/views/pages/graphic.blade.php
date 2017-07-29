{{-- */use App\models\Image;/* --}}
@extends('layout')
@section('title')
Graphic Detail
@endsection
@section('content')
<section class="visual-block add">
			<div class="carousel">
				<div class="mask">
					<div class="slideset">
						<?php $images = Image::where('type',1)->where('type_id',$graphic['id'])->get(); ?>
						@foreach($images as $image)
						<div class="slide">
							<div class="bg-image"><span data-srcset="{{ url('uploads/'.$image->image_name) }}"></span></div>
							<div class="container">
								<div class="frame">
									<h1></h1>
									<p></p>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<a class="btn-prev" href="#"><i class="icon-chevron-small-left"></i></a>
				<a class="btn-next" href="#"><i class="icon-chevron-small-right"></i></a>
			</div>
		</section>
		<main id="main" role="main">
			<section id="content" class="content-area">
				<div class="container">
					
						{!! $graphic->description !!}
					
					
				</div>
			</section>
		</main>
		@endsection
