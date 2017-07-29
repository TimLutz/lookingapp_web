@extends('layout')
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
							<div class="image-holder"><img src="{{ url('uploads/'.$category->image) }}" alt="image description"></div>
							
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
						
				</section>
				
				<aside id="sidebar">
					<div class="filter-holder" data-animation="left">
							<!--h2>Search by Name</h2>
							<div class="field-holder">
								<input type="search" id="name" name="name">
							</div-->
							<input type="button" value="Reset Filters" id="resetfilters" >
						</div>
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
							<h2>Filter by Size</h2>
							<input type="range" name="lengthnot" id="lengthnot" value="">
							<input type="hidden" name="length" id="length" value="">
							<span class="lable-holder"><label for="chk7">Length</label></span>
							<input type="range" name="breadthnot" id="breadthnot" value="">
							<input type="hidden" name="breadth" id="breadth" value="">
							<span class="lable-holder"><label for="chk7">Breadth</label></span>
							<input type="range" name="heightnot" id="heightnot" value="">
							<input type="hidden" name="height" id="height" value="">
							<span class="lable-holder"><label for="chk7">Height</label></span>
							<!--ul class="checks-list">
								<li>
									<input type="checkbox" id="chk7">
									<span class="lable-holder"><label for="chk7">12 * 16</label></span>
								</li>
								<li>
									<input type="checkbox" id="chk8">
									<span class="lable-holder"><label for="chk8">8 * 12</label></span>
								</li>
								<li>
									<input type="checkbox" id="chk9">
									<span class="lable-holder"><label for="chk9">10 * 12</label></span>
								</li>
								<li>
									<input type="checkbox" id="chk10">
									<span class="lable-holder"><label for="chk10">10 * 14</label></span>
								</li>
								<li>
									<input type="checkbox" id="chk11">
									<span class="lable-holder"><label for="chk11">12 * 20</label></span>
								</li>
							</ul-->
							
						</div>
					<div class="filter-holder" data-animation="left">
					<input type="button" value="Update My Results" id="submitalldata">

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
    //$(".list-selector li").click(function(){
	
				var cat_id_al = "<?php echo $cat_id_al; ?>";
				alert(cat_id_al);
				var sub_id_al = "<?php echo $sat_id_al; ?>";
		
		
		
				$('#name').typeahead({

				ajax:{
				url : path+'products/searchname',
				loadingClass:'loading',
				method :'post',

				preDispatch: function (query) {
				var CSRF_TOKEN = "{{ csrf_token() }}";
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
				//onSelect: displayResult
				});
			
			
			
			
$("#lengthnot").ionRangeSlider({
    
    min: 0,
    max: "{{ $lengthmax }}",
    from: 0,
    onChange: function(data){
	
	$('#length').val(data.from);
	add_check();
	
	}
	
  });

$("#breadthnot").ionRangeSlider({
    min: 0,
    max: "{{ $breadthmax }}",
    from: 0,
     onChange: function(data){
	
	$('#breadth').val(data.from);
	add_check();
	
	}
});
$("#heightnot").ionRangeSlider({
    min: 0,
    max: "{{ $heightmax }}",
    from: 0,
     onChange: function(data){
	
	$('#height').val(data.from);
	add_check();
	
	}
});

		
		
		
		
	
		
		
		
		
		
				$(document).on('click','.list-selector li',function(){
			
				$(".list-selector li").removeClass("active");
				$(this).addClass('active');
				
				$("#category").val($(this).attr("cat_id"));


				 add_check();
				subcatdynamic($(this).attr("cat_id"));




				});

		
	
		
				function subcatdynamic(cat_id, token)
				{
				addLoader();
				var token = "{{ csrf_token() }}";
				$.ajax({
				url : path+'products/subcatdynamic',
				data : 'cat='+cat_id+'&_token='+token,
				dataType : 'html',
				method :'post',

				complete : function() {
				removeLoader();
				},
				success : function(data) {

				$('#resultsubcata').html(data);
				},
				error : function(xhr, ajaxOptions, thrownError) {
				console.log(xhr);
				new PNotify({
				type: 'error',
				title: xhr.statusText,
				text: 'Something went wrong!!!'
				});
				}
				});


				}

		
		
			function load_cataloge(){

			addLoader();
			var token = "{{ csrf_token() }}";
			var formdata = $("#checkboxsubcat").serialize();
			$.ajax({
			url : path+'products/index',
			//data : formData,
			data : formdata+'&_token='+token,
			dataType : 'json',
			method :'get',

			complete : function() {
			removeLoader();
			},
			success : function(data) {
				loading = false;
			$("#total_show").html("Results "+data.total);
		
			$("#total_page").val(data.total_page);
			if(data.current_page > 1) {
			$('#products').append(data.content);
			} else if(data.current_page == "1") {
			$('#products').html(data.content);
				$("#page").val(2);
			}
			

			var add = data.current_page + 1;
			$("#page").val(add);
		
			},
			error : function(xhr, ajaxOptions, thrownError) {
			console.log(xhr);
			new PNotify({
			type: 'error',
			title: xhr.statusText,
			text: 'Something went wrong!!!'
			});
			}
			});




			}

		function reset_filter() {
			
			$("#name").val("");
			$("#page").val(1);
			$("#lengthnot").data("ionRangeSlider").reset();
			$("#breadthnot").data("ionRangeSlider").reset();
			$("#heightnot").data("ionRangeSlider").reset();
			loading = false;

			// Fire public method
			$( ".list-selector li" ).first().click();
		}
		
		
		function add_check() {
			
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
reset_filter();
				var loading  = false; //to prevents multipal ajax loads


				$(window).scroll(function() { //detect page scroll
				if($(window).scrollTop() + $(window).height() == $(document).height())  //user scrolled to bottom of the page?
				{	
				var total_groups = $("#total_page").val(); //total record group(s)
				var currrent_page  = $("#page").val();


				if(currrent_page <= total_groups && loading == false) //there's more data to load
				{

				loading = true;
				load_cataloge();

				} else {
				loading = false;


				}
				//	console.log(track_load+' '+total_groups);
				}
				});

				});

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    
});
</script>
@endsection
