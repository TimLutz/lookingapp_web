{{-- */use repositories\CommonRepositoryInterface;/* --}}
{{-- */use repositories\CommonRepository;/* --}}
{{-- */use App\models\Image;/* --}}
{{-- */use App\models\Product;/* --}}

@extends('layout')
@section('title')
	 {{$productsdetail->name}}
@endsection
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<style>
.magnifier{width: 550px !important; height: 400px !important;}
.magnifier img{max-width:none !important;}
</style>
@endsection
@section('content')
<main id="main" role="main" class="add">
			<section class="block-gallery">
				<div class="container">
					<div class="row">
						<div class="col-6" data-animation="left">
							<div class="banner">
								<div class="slider slider-for">
								<?php $images = $productsdetail->images; ?>
									@foreach( $images as $image )
									<div>
										<img class="demo" src="{{ asset('uploads/'.$image->image_name ) }}" alt="{{$image->image_name}}"/>
									</div>
									@endforeach
									
								</div>
								<div class="slider slider-nav">
									
									<?php $images = $productsdetail->images;
									 ?>
									@foreach( $images as $image )
									<div>
										<img src="{{ asset('uploads/'.$image->image_name ) }}" alt="{{$image->image_name}}"/>
									</div>
									@endforeach
								</div>
							</div>
						</div>
						<?php  $my_id = CommonRepository::encryptID($productsdetail->id);?>
						<div class="col-6 description" data-animation="right">
							<strong class="title">{{ $productsdetail->category->type_name }}->{{ $productsdetail->subcategory->name }}</strong>
							<h1>{{ $productsdetail->name }}</h1>
							<p>{!! $productsdetail->description !!}</p>
							<p>@if(!empty($productsdetail->styles->name)) {!! $productsdetail->styles->name !!} Style @endif</p>
							<p></p>
							<div class="foot">
								<p><a href="{{ url('faqs') }}" class="link"><i class="question">?</i>Do you have questions</a></p>
								<ul class="btns-holder">
									@if($productsdetail->color_picker == 1)
									<li><a href="{{ url('colorpicker') }}" class="btn">color picker</a></li>
									@endif
								<li><a href="{{ url('product/request-query/'.$my_id)}}" class="lightbox btn-lightbox">Request a quote</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php    $products = CommonRepository::getrecentlyviewed();
			 $prodcount = count($products); ?>
			@if($prodcount>0)
			@include('productsdetail/recentview')
			@endif
			<span class="border"></span>
			@include('productsdetail/recentprod',$productsdetail)
		</main>
<div class="popup-holder">
		<div id="popup1" class="lightbox result">
			<div class="block-payments">
				{!! Form::open(['method' => 'POST','url' => 'productsdetail/product','id'=>'registerForm','novalidate' => 'novalidate','class' =>'form-calculator result']) !!}
					<header class="head">
						<h2>Request a Quote</h2>
						<p>Lorem ipsum dolor amet, quis consectetuer adipiscing. Nullam quis ante. Etiam sit amet eget. </p>
					</header>
					<input type="hidden" id="name" name="product_id">
					<div class="field-frame">
						<div class="lable-area">
							<label for="name">Name:</label>
						</div>
						<div class="field-holder">
							<input type="text" id="name" name="name">
							<span class="form_error" style="color:red"></span>
						</div>
					</div>
					<div class="field-frame">
						<div class="lable-area">
							<label for="name">Email:</label>
						</div>
						<div class="field-holder">
							<input type="text" id="email" name="email">
							<span class="form_error" style="color:red"></span>
						</div>
					</div>
					<div class="field-frame">
						<div class="lable-area">
							<label for="address">Address:</label>
						</div>
						<div class="field-holder">
							<input type="text" id="address" name="address">
							<span class="form_error" style="color:red"></span>
						</div>
					</div>
					<div class="field-frame">
						<div class="lable-area">
							<label for="city">City:</label>
						</div>
						<div class="field-holder">
							<input type="text" id="city" name="city">
							<span class="form_error" style="color:red"></span>
						</div>
					</div>
					<div class="field-frame">
						<div class="lable-area">
							<label for="state">State:</label>
						</div>
						<div class="field-holder">
							<input type="text" id="state" name="state">
							<span class="form_error" style="color:red"></span>
						</div>
					</div>
					<div class="field-frame">
						<div class="lable-area">
							<label for="zip">Zip:</label>
						</div>
						<div class="field-holder zip">
							<input type="text" id="zip" name="zip">
							<span class="form_error" style="color:red"></span>
						</div>
					</div>
					<div class="field-frame">
						<div class="lable-area">
							<label for="tel">Phone Number:</label>
						</div>
						<div class="field-holder tel">
							<input type="tel" id="tel" name="number">
							<span class="form_error" style="color:red"></span>
						</div>
					</div>
					<div class="field-frame">
						<div class="lable-area">
							<label for="txt1">Area of Interest:</label>
						</div>
						<div class="field-holder edit_sub_field form-group">
							{!! Form::select('interested_in',[''=>'--Select--']+$interest,null,['id'=>'txt1','class' => 'form-control']) !!}
							<span class="form_error" style="color:red"></span>
						</div>
					</div>
					<div class="field-frame">
						<div class="lable-area comment">
							<label for="comment">Additional Comments:</label>
						</div>
						<div class="field-holder">
							<textarea id="comment" name="comment"></textarea>
							<span class="form_error" style="color:red"></span>
						</div>
					</div>
					<div class="field-frame">
						<div class="lable-area">
						</div>
						<div class="field-holder">
							<input type="submit" id="registerquery" value="Submit" >
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection
@section('js')
<script type="text/javascript" src="js/frontend/slick.min.js"></script>
<script src="{{ asset('js/frontend/slick.min.js') }}" type="text/javascript"></script>
		<script type="text/javascript">
		  $('.slider-for').slick({
		   slidesToShow: 1,
		   slidesToScroll: 1,
		   arrows: true,
		   fade: false,
		   centerMode: false,
		   asNavFor: '.slider-nav'
		  });
		  $('.slider-nav').slick({
		   slidesToShow: 6,
		   slidesToScroll: 1,
		   asNavFor: '.slider-for',
		   dots: false,
		   centerMode: false,
		   focusOnSelect: true
		  });
		  $('.autoplay').slick({
		   slidesToShow: 1,
		   slidesToScroll: 1,
		   autoplay: false,
		   centerMode: false,
		   autoplaySpeed: 2000
		  });
</script>
<script src="{{ asset('js/jquery.maskedinput.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$("#tel").mask("(+99) 99999-99999");
</script>
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="{{ asset('js/zoomsl-3.0.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.slick-arrow, .slick-slide').click(function(){
		$('.magnifier,.tracker').remove();
		imageMagnifier();
	});
	imageMagnifier();
});
function imageMagnifier()
{
	$('.slick-current .demo').imagezoomsl({
		zoomrange: [3, 1],
		magnifiereffectanimate: "fadeIn",
		magnifierborder: "none",
		magnifiersize: [100, 100],
		magnifierpos: "right"
	});
}
</script>
@endsection

