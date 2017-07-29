@extends('layout')
@section('title')
3 D Shed
@endsection
@section('content')
			<main id="main" role="main">
			<section class="block-storage">
				<div class="container">
					<div class="row">
						<div class="col-3 left-col">
							<h1>Color Picker</h1>
							<p>Vivamus elementum semper <br> nisi. Aenean vulputate <br>eleifend tellus. </p>
						</div>
						<div class="col-9 right-col">
							<div class="image-holder colorchngdiv">


<img class="basecpic" id="base" src="colors/woodgable-base.png" width="700" height="484" alt="" title="" border="0" />
<img id="siding" name="sidingimg" src="colors/woodgable-siding-base.png" width="700" height="484" alt="" title="" border="0" />
<img id="trim" name="trimimg" src="colors/woodgable-trim-base.png" width="700" height="484" alt="" title="" border="0" />
<img id="shingles" name="shingleimg" src="colors/woodgable-shingles-base.png" width="700" height="484" alt="" title="" border="0" />
<img class="windows" src="colors/woodgable-windows.png" width="700" height="484" alt="" title="" border="0" />
<img class="runners" src="colors/woodgable-runners.png" width="700" height="484" alt="" title="" border="0" />

</div>
							<div class="caption-holder">
								<p>Select the colors you wish to see, colors are for representation only and are not accurate, colors display differently on different monitors, please refer to actual paint samples when making your final color choices, runners will be painted the same color as the siding.</p>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="block-tabs">
				<ul class="tabset">
					<li>
						<a href="#tab1" class="active">
							<span class="option">Shingle Color</span>
						</a>
					</li>
					<li>
						<a href="#tab2">
							<span class="option">Base Color</span>
						</a>
					</li>
					<li>
						<a href="#tab3">
							<span class="option">Trim Color</span>
						</a>
					</li>
				</ul>
				<div class="tab-content">
					<div id="tab1" class="tab-area active">
						<div class="container">
							<ul class="color-picker Shinglecolor">
								<li colorsrc="colors/woodgable-shingles-grey.png" class="active">
									<span class="color shin_color5"></span>
									<span class="name">Grey</span>
								</li>
									<li colorsrc="colors/woodgable-shingles-black.png">
									<span class="color shin_color1"></span>
									<span class="name">Black</span>
								</li>
								<li colorsrc="colors/woodgable-shingles-brown.png">
									<span class="color shin_color2"></span>
									<span class="name">Brown</span>
								</li>
								<li colorsrc="colors/woodgable-shingles-charcoal.png">
									<span class="color shin_color3"></span>
									<span class="name">Charcoal</span>
								</li>
								<li colorsrc="colors/woodgable-shingles-green.png">
									<span class="color shin_color4"></span>
									<span class="name">Green</span>
								</li>
								
								<li colorsrc="colors/woodgable-shingles-tan.png">
									<span class="color shin_color6"></span>
									<span class="name">Tan</span>
								</li>
								<li colorsrc="colors/woodgable-shingles-driftwood.png">
									<span class="color shin_color7"></span>
									<span class="name">Driftwood</span>
								</li>
								
							</ul>
							<!--div class="caption-info">
								<p>GAF Shingle Color (Click on color to select)<br>Charcoal Hickory Pewter Gray Hunter Green Fox Hollow Grey Shakewood Weathered Wood</p>
							</div-->
						</div>
					</div>
					<div id="tab2" class="tab-area">
						<div class="container">
							<ul class="color-picker basecolor">
								<li colorsrc="colors/woodgable-siding-white.png" class="active">
									<span class="color colorbase1"></span>
									<span class="name">White</span>
								</li>
								<li colorsrc="colors/woodgable-siding-navajo.png">
									<span class="color colorbase2"></span>
									<span class="name">Navajo</span>
								</li>
								<li colorsrc="colors/woodgable-siding-almond.png">
									<span class="color colorbase3"></span>
									<span class="name">Almond</span>
								</li>
								<li colorsrc="colors/woodgable-siding-cream.png">
									<span class="color colorbase4"></span>
									<span class="name">Cream</span>
								</li>
								<li colorsrc="colors/woodgable-siding-beige.png">
									<span class="color colorbase5"></span>
									<span class="name">Beige</span>
								</li>
								<li colorsrc="colors/woodgable-siding-buckskin.png">
									<span class="color colorbase6"></span>
									<span class="name">Buckskin</span>
								</li>
								<li colorsrc="colors/woodgable-siding-chestnut.png">
									<span class="color colorbase7" ></span>
									<span class="name">Chestnut</span>
								</li>
								<li colorsrc="colors/woodgable-siding-brown.png">
									<span class="color colorbase8" ></span>
									<span class="name">Brown</span>
								</li>
								<li colorsrc="colors/woodgable-siding-ltgrey.png">
									<span class="color colorbase9"></span>
									<span class="name">Lt Grey</span>
								</li>
								<li colorsrc="colors/woodgable-siding-clay.png">
									<span class="color colorbase10"></span>
									<span class="name">Clay</span>
								</li>
								<li colorsrc="colors/woodgable-siding-medgrey.png">
									<span class="color colorbase11"></span>
									<span class="name">Medgrey</span>
								</li>
								<li colorsrc="colors/woodgable-siding-colgrey.png">
									<span class="color colorbase12" ></span>
									<span class="name">Colgrey</span>
								</li>
								<li colorsrc="colors/woodgable-siding-avocado.png">
									<span class="color colorbase13" ></span>
									<span class="name">Avocado</span>
								</li>
								<li colorsrc="colors/woodgable-siding-hgreen.png">
									<span class="color colorbase14"></span>
									<span class="name">Hgreen</span>
								</li>
								<li colorsrc="colors/woodgable-siding-cblue.png">
									<span class="color colorbase15" ></span>
									<span class="name">Cblue</span>
								</li>
								<li colorsrc="colors/woodgable-siding-red.png">
									<span class="color colorbase16" ></span>
									<span class="name">Red</span>
								</li>
							</ul>
							<!--div class="caption-info">
								<p>GAF Shingle Color (Click on color to select)<br>Charcoal Hickory Pewter Gray Hunter Green Fox Hollow Grey Shakewood Weathered Wood</p>
							</div-->
						</div>
					</div>
					<div id="tab3" class="tab-area">
						<div class="container">
							<ul class="color-picker trimcolor">
									<li colorsrc="colors/woodgable-trim-ltgrey.png" class="active">
									<span class="color colorbase9"></span>
									<span class="name">Ltgrey</span>
								</li>
								<li colorsrc="colors/woodgable-trim-white.png">
									<span class="color colorbase1"></span>
									<span class="name">White</span>
								</li>
								<li colorsrc="colors/woodgable-trim-navajo.png">
									<span class="color colorbase2"></span>
									<span class="name">navajo</span>
								</li>
								<li colorsrc="colors/woodgable-trim-almond.png">
									<span class="color colorbase3"></span>
									<span class="name">Almond</span>
								</li>
								<li colorsrc="colors/woodgable-trim-cream.png">
									<span class="color colorbase4"></span>
									<span class="name">Cream</span>
								</li>
								<li colorsrc="colors/woodgable-trim-beige.png">
									<span class="color colorbase5"></span>
									<span class="name">Beige</span>
								</li>
								<li colorsrc="colors/woodgable-trim-buckskin.png">
									<span class="color colorbase6"></span>
									<span class="name">Buckskin</span>
								</li>
								<li colorsrc="colors/woodgable-trim-chestnut.png">
									<span class="color colorbase7"></span>
									<span class="name">Chestnut</span>
								</li>
								<li colorsrc="colors/woodgable-trim-brown.png">
									<span class="color colorbase8"></span>
									<span class="name">Brown</span>
								</li>
							
								<li colorsrc="colors/woodgable-trim-clay.png">
									<span class="color colorbase10"></span>
									<span class="name">Clay</span>
								</li>
								
									<li colorsrc="colors/woodgable-trim-medgrey.png">
									<span class="color colorbase11"></span>
									<span class="name">Medgrey</span>
								</li>
								<li colorsrc="colors/woodgable-trim-colgrey.png">
									<span class="color colorbase12"></span>
									<span class="name">Colgrey</span>
								</li>
								<li colorsrc="colors/woodgable-trim-avocado.png">
									<span class="color colorbase13"></span>
									<span class="name">Avocado</span>
								</li>
								<li colorsrc="colors/woodgable-trim-hgreen.png">
									<span class="color colorbase14"></span>
									<span class="name">Hgreen</span>
								</li>
								<li colorsrc="colors/woodgable-trim-blue.png">
									<span class="color colorbase15"></span>
									<span class="name">Cblue</span>
								</li>
								<li colorsrc="colors/woodgable-trim-red.png">
									<span class="color colorbase16"></span>
									<span class="name">Red</span>
								</li>
							</ul>
							<!--div class="caption-info">
								<p>GAF Shingle Color (Click on color to select)<br>Charcoal Hickory Pewter Gray Hunter Green Fox Hollow Grey Shakewood Weathered Wood</p>
							</div-->
						</div>
					</div>
				</div>
			</section>
		</main>
	@endsection
@section('js')
<script>
$(document).ready(function(){


	function changeshingle(image){
	$('#shingles').attr('src',image);
	//window.scrollTo(0, 0);
	 $('html, body').animate({scrollTop:0}, 'slow');
	}

	function changebase(image){
	$('#siding').attr('src',image);
	 $('html, body').animate({scrollTop:0}, 'slow');
	
	}

	function changetrim(image){
	$('#trim').attr('src',image);
	 $('html, body').animate({scrollTop:0}, 'slow');
	
	}
	
		$(document).on('click','.basecolor li',function(){
			$('.basecolor li').removeClass('active');
			changebase($(this).attr("colorsrc"));
			$(this).closest('li').addClass('active');
		});
		$(document).on('click','.Shinglecolor li',function(){
			$('.Shinglecolor li').removeClass('active');
			changeshingle($(this).attr("colorsrc"));
			$(this).closest('li').addClass('active');
		});
		$(document).on('click','.trimcolor li',function(){
			$('.trimcolor li').removeClass('active');
			changetrim($(this).attr("colorsrc"));
			$(this).closest('li').addClass('active');
		});

});
</script>
@endsection
