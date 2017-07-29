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
				
				<aside id="sidebar">
					
					<div class="filter-holder" data-animation="left">
							<h2>Search by Name</h2>
							<div class="field-holder">
								<input type="search" id="name" name="name" autocomplete="off">
							</div>
							
						</div>
					
						<div class="filter-holder" data-animation="left">
							<h2>Filter by Type</h2>
							<ul class="checks-list">
								<div id="resultsubcata"><!-- replace div subcategory starts-->
								
								</div><!-- replace div subcategory ends-->
							</ul>
						</div>
					
						<div class="filter-holder" data-animation="left">
							<h2>Filter by Style</h2>
							<ul class="checks-list">
								<div>
								@if($styles)
									@foreach($styles as $style_id=>$style)
										<li>
											<input type="checkbox" class="nojcf" id="style-chk{{ $style_id }}" name="style[]" value="{{ $style_id }}">
											<span class="lable-holder"><label for="style-chk{{ $style_id }}">{{ $style }}</label></span>
										</li>
									@endforeach
								@endif
								</div>
							</ul>
						</div>
						<div class="filter-holder" data-animation="left">
							<h2>Filter by Size</h2>
							<span class="lable-holder"><label for="chk7">Width</label></span>
							<input type="range" name="breadthnot" id="breadthnot" value="">
							<input type="hidden" name="breadth" id="breadth" value="">
							
							<span class="lable-holder"><label for="chk7">Length</label></span>
							<input type="range" name="lengthnot" id="lengthnot" value="">
							<input type="hidden" name="length" id="length" value="">
<!--
							<span class="lable-holder"><label for="chk7">Height</label></span>
							<input type="range" name="heightnot" id="heightnot" value="">
							<input type="hidden" name="height" id="height" value="">
-->
							
							
						</div>
					<div class="filter-holder" data-animation="left">
					<input type="button" value="Update My Results" id="submitalldata">

					</div>
					<div class="filter-holder" data-animation="left">
							
							<input type="button" value="Reset Filters" id="resetfilters" >
						</div>
					
				</aside>
			</div>
		</main>
</form>

@endsection
@section('js')
<script src="{{ asset('/js/frontend/bootstrap-typeahead.js') }}"></script>
<script src="{{ asset('/js/frontend/ion.rangeSlider.min.js') }}"></script>
<script>
$(document).ready(function(){
		var loading  = false; //to prevents multipal ajax loads
	$("#lengthnot").ionRangeSlider({
		min: 0,
		max: "{{ $lengthmax }}",
		from: 0,
		step: 2,
		onChange: function(data){
			$('#length').val(data.from);
			add_check();
		},
		grid:true,
		grid_num:10
	});

	$("#breadthnot").ionRangeSlider({
		min: 0,
		max: "{{ $breadthmax }}",
		from: 0,
		step: 2,
		onChange: function(data){
			$('#breadth').val(data.from);
			add_check();
		},
		grid:true,
		grid_num:10
	});
	//~ $("#heightnot").ionRangeSlider({
		//~ min: 0,
		//~ max: "{{ $heightmax }}",
		//~ from: 0,
		//~ onChange: function(data){
			//~ $('#height').val(data.from);
			//~ add_check();
		//~ },
		//~ grid:true,
		//~ grid_num:10
	//~ });

	var cat_id_al = "<?php echo $cat_id_al; ?>";
	var sub_id_al = "<?php echo $sub_id_al; ?>";
	$(document).on('click','.list-selector li',function(){
		$(".list-selector li").removeClass("active");
		$(this).addClass('active');
		$("#category").val($(this).attr("cat_id"));
		subcatdynamic($(this).attr("cat_id"),sub_id_al);
	});
	
	function subcatdynamic(cat_id,sub_id)
	{
		if(cat_id == '')
			cat_id = null;
		if(sub_id == '')
			sub_id = null;
		addLoader('.main-container');
		var token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			url : path+'products/subcatdynamic',
			data : 'cat='+cat_id+'&_token='+token,
			dataType : 'json',
			method :'post',
			complete : function() {
				removeLoader('.main-container');
			},
			success : function(data) {
				removeLoader('.main-container');
				$('#resultsubcata').html(data.view);
				if(data.category)
				{
					rangeSlider("#lengthnot", data.category.min_length, data.category.max_length, '0');
					rangeSlider("#breadthnot", data.category.min_width, data.category.max_width, '0');
				}
				$( "input[value='"+sub_id+"']" ).prop("checked", true);
				add_check();
			},
			error : function(xhr, ajaxOptions, thrownError) {
				new PNotify({
					type: 'error',
					title: xhr.statusText,
					text: 'Something went wrong!!!'
					});
			}
		});
	}
			
	function load_cataloge()
	{
		addLoader('.main-container');
		var token = $('meta[name="csrf-token"]').attr('content');
		var formdata = $("#checkboxsubcat").serialize();
		$.ajax({
			url : path+'products/index',
			data : formdata+'&_token='+token,
			dataType : 'json',
			method :'get',
			complete : function() {
				removeLoader('.main-container');
			},
			success : function(data) {
				loading = false;
				$("#total_show").html("Results "+data.total);
				$("#total_page").val(data.total_page);
				if(data.current_page > 1)
				{
					$('#products').append(data.content);
				}
				else if(data.current_page == "1")
				{
					$('#products').html(data.content);
					$("#page").val(2);
				}
				var add = data.current_page + 1;
				$("#page").val(add);
			},
			error : function(xhr, ajaxOptions, thrownError) {
				new PNotify({
					type: 'error',
					title: xhr.statusText,
					text: 'Something went wrong!!!'
				});
			}
		});
	}

	function rangeSlider(obj, start, end, value)
	{
		var slider = $(obj).data("ionRangeSlider");
		slider.update({
			min: parseInt(start),
			max: parseInt(end),
			from: parseInt(value)
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
	}
	function add_check() 
	{
		$("#page").val(1);
		$("#total_page").val("");
		loading = false;
		load_cataloge();
	}
	$(document).on('click','#resetfilters',function(){
		reset_filter();
	});
	$(document).on('click','.checks-list li',function(){
		add_check();
	});
	$(document).on('click','#submitalldata',function(){
		add_check();
	});
	$(document).on('change','#length',function(){
		add_check();
	});
	$(document).on('change','#breadth',function(){
		add_check();
	});
	$(document).on('change','#height',function(){
		add_check();
	});
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
	$('#name').typeahead({
		ajax:{
			url : path+'products/searchname',
			loadingClass:'loading',
			method :'post',
			preDispatch: function (query) {
				var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
				return {
					search: query,
					_token:CSRF_TOKEN,
				}
			},
			method :'post',
			displayField: "name"
		},
		items:40,
		scrollBar:true,
		onSelect: function(){
			add_check();
		},
	});
});
</script>
@endsection
