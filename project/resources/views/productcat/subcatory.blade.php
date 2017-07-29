@extends('layout')
@section('title')
Products
@endsection
@section('content')
@section('css')
<link href="{{ asset('css/frontend/ion.rangeSlider.skinSimple.css') }}" rel="stylesheet" type="text/css" media="all" >
<link href="{{ asset('css/frontend/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css" media="all" >
<link href="{{ asset('css/frontend/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet" type="text/css" media="all" >
<link href="{{ asset('css/frontend/ion.rangeSlider.skinHTML5.css') }}" rel="stylesheet" type="text/css" media="all" >
<link href="{{ asset('css/frontend/ion.rangeSlider.skinModern.css') }}" rel="stylesheet" type="text/css" media="all" >
<link href="{{ asset('css/frontend/ion.rangeSlider.skinNice.css') }}" rel="stylesheet" type="text/css" media="all" >
<link href="{{ asset('css/frontend/ion.rangeSlider.skinSimple.css') }}" rel="stylesheet" type="text/css" media="all" >
<link href="{{ asset('css/frontend/normalise.css') }}" rel="stylesheet" type="text/css" media="all" >
@endsection
{{-- */use App\models\Image;/* --}}

<form class="form-filter waitMeLoader" id="checkboxsubcat">
	<section class="visual-block">
			<div class="bg-image"><span data-srcset="{{ url('images/img1.jpg') }}"></span></div>
			<div class="container">
				<h1>Select Product Category</h1>
				<ul class="list-selector">
					@if($categories)
					@foreach($categories as $k=>$category)
					<li  cat_id="{{ $category->id }}" class="<?php if($k==0){ ?>active <?php } else {}?>">
					<a href="#" class="frame">
						
							<div class="text-holder"><strong class="title">{{ $category->name }}</strong></div>
							<div class="image-holder"><img src="{{ url('uploads/'.$category->image) }}" alt="{{ $category->name }}"></div>
							
						</a>
					</li>
					@endforeach
					@endif
					
				</ul>
			</div>
			<input type="hidden" id="category" name="category" value=""/>
			<input type="hidden" id="page" name="page" value="1"/>
			<input type="hidden" id="total_page" name="total_page" value=""/>
		</section>
		
		<main id="main" role="main">
			<div class="container main-container">
				
				<section id="content">
							
							<header class="head">
							<a href="#" class="slide-opener"><span>Filter</span></a>
							<div class="result-counter" data-animation="fade" id="total_show"> </div>
							</header>
							
							
							<div class="post-area row" id ="products">
							</div>
							<div id="div-end" style="width:100%; height:20px;"></div>
						
				</section>
			</div>
		</main>
</form>

@endsection
@section('js')
<script src="{{ asset('/js/frontend/bootstrap-typeahead.js') }}"></script>
<script type="text/javascript">
	
   var cat_id_al = "<?php echo $cat_id_al; ?>";
	
	$(document).on('click','.list-selector li',function(){
		$(".list-selector li").removeClass("active");
		$(this).addClass('active');
		$("#category").val($(this).attr("cat_id"));
		//subcatdynamic($(this).attr("cat_id"));
		load_cataloge();
	});

	function load_cataloge()
	{
		addLoader('.main-container');
		var token = $('meta[name="csrf-token"]').attr('content');
		var formdata = $("#checkboxsubcat").serialize();
		$.ajax({
			url : path+'products/subcat',
			data : formdata+'&_token='+token,
			dataType : 'json',
			method :'post',
			complete : function() {
				removeLoader('.main-container');
			},
			success : function(data) {
				loading = false;
				
				$('#products').html(data.content);
				$("#total_show").html("Results "+data.total);
				
			},
			error : function(xhr, ajaxOptions, thrownError) {
				//removeLoader('.main-container');
				//console.log(xhr);
				new PNotify({
					type: 'error',
					title: xhr.statusText,
					text: 'Something went wrong!!!'
				});
			}
		});
	}

	function reset_filter()
	{
		$("#name").val("");
		$("#page").val(1);
		$("#lengthnot").data("ionRangeSlider").reset();
		$("#breadthnot").data("ionRangeSlider").reset();
		loading = false;
		// Fire public method
		$( ".list-selector li" ).first().click();
		//load_cataloge1();
	}
	
	$(document).ready(function() {		
		if(cat_id_al) {
			$( ".list-selector li[cat_id='"+cat_id_al+"']" ).click();
		} else {
			reset_filter();
		}
		$(window).scroll(function() { //detect page scroll
			var currentPos = (parseInt($("#div-end").offset().top)-450);
			if( ( ($(window).scrollTop() >= currentPos) && ($(window).scrollTop() <= (currentPos+100)) ) && loading == false )  //user scrolled to bottom of the page?
			{
				var total_groups = $("#total_page").val(); //total record group(s)
				var currrent_page  = $("#page").val();
				if(parseInt(currrent_page) <= parseInt(total_groups) && loading == false) //there's more data to load
				{
					loading = true;
					load_cataloge();
				} else {
					loading = false;
				}
			}
		});
	});

</script>
@endsection
