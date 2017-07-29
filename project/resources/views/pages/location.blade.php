{{-- */use App\Settings;/* --}}
@extends('layout')
@section('title')
Locations
@endsection
@section('content')
		<main id="main" role="main">
			<section class="block-contact">
				<div class="container">
					<div class="row">
						<div class="col-3 text-holder">
							<h1>our <br>Locations</h1>
							<article class="article-holder">
								<?php $num = Settings::where('type','number')->where('key','number')->pluck('value'); 
								$address_loc = Settings::where('type','address_location')->where('key','address_location')->pluck('value');?>
								<a href="{{url('')}}" class="tel"><i class="icon icon-phone"></i><span class="number">{{ $num }}</span></a>
								
								<p class="change_address"></p>
								<div class="info">
									<div class="image-holder"><a href="#"><img src="images/img32.jpg" alt="image description" class="image"></a></div>
									<div class="text-holder">
										<strong class="title"><a href="#"><span class="man_name">Den Potapov</span></a></strong>
										<span class="designation">Your manager</span>
									</div>
								</div>
								<a href="{{ url('product/request-query') }}" class="btn">contact us</a>
							</article>
						</div>
						<div class="col-9 map-area">
							<div class="map-holder"><div id="map_canvas" style="width: 100%; height: 621px;"></div></div>
						</div>
					</div> 
				</div>
			</section>
			<section class="block-location">
				<div class="container">
					<header class="head">
						<h2>Locations</h2>
					</header>
					<div class="row">
						@foreach($address_shorts as $q=>$address)
						<?php $k = $q+1; ?>
						<article class="col-3 location-info" data-animation="left">
							<div class="frame">
								<div class="image-holder"><!--img src="images/img16.jpg" alt="image description"--><div id="map_canvas{{$k}}" style="width: 100%; height: 141px;"></div></div>
								<div class="text-holder">
									<strong class="title"><a>{{ $address->loc_name }}</a></strong>
								</div>
								<a class="more" onclick="myClick({{$q}});">Details</a>
							</div>
						</article>
						@endforeach
					</div>
				</div>
			</section>
		</main>
	@endsection
	@section('js')
<script 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmtlkZbTZIWYy6LZShXGaARICyXpJgfTw&amp;libraries=places">
    </script>
<script src="{{ asset('js/jquery.geocomplete.min.js') }}" type="text/javascript"></script> 
     <script type="text/javascript">
	
	
	
	
	
	
///////////////***** code for Big map start from here ******/////////////////	
			var infoWindows = new Array();
			var markerPlus = new Array();
			var markerbutton = new Array();
		$(document).ready(function(){
	
	
	
	
		var addresses = <?php echo $addresses; ?>;
		//alert();
	
		$.each(addresses, function(i, item) {
		//console.log(addresses[i]);

		add_marker(addresses[i],i);
		});

		});
	
	
			var myLatLng = {lat: 38.480923, lng: -77.984919};

			var map = new google.maps.Map(document.getElementById('map_canvas'), {
			zoom: 9,
			center: myLatLng
			});

			geocoder = new google.maps.Geocoder();


	
	
	
	
	
	////////********** Function for adding marker ************///////////
	function add_marker(address,j) 
	{
		
			var icon_image = path+'/images/pin/yellowdot.png';
		geocoder.geocode( { 'address': address}, function(results,status) {
		if (status == google.maps.GeocoderStatus.OK) 
		{
			
			var marker = new google.maps.Marker({
				map: map,
				title:results[0].geometry.location,
				position: results[0].geometry.location,
				icon:icon_image
			});
			
			var infowindow = new google.maps.InfoWindow({
				content: results[0].formatted_address
			});
			infoWindows.push(infowindow);
			markerPlus.push(marker);
			
			markerbutton[j] = marker; 
			//console.log(markerbutton);
			
			
			
			
			/////////********** Code for Closing particular infowindow  ************////////////
			
			google.maps.event.addListener(infowindow, 'closeclick', function() {
		var icon_simple = path+'/images/pin/yellowdot.png';
		marker.setIcon(icon_simple);
		//closeAllInfoWindows();
		infowindow.close();
			});
			
			
	
	/////////********** Code for Infowindow on clicking marker  ************////////////		
			google.maps.event.addListener(marker, 'click', function() {

				closeAllInfoWindows();
				var icon_plus = path+'/images/pin/yellowplus.png';
				marker.setIcon(icon_plus);   
				//alert(infowindow.content);
				//$(".change_address").html(infowindow.content);
				
				findaddress(infowindow.content);
				infowindow.open(map,marker);
			});



		}
	});
	}

	function findaddress(address)
	{
		var formData = {
				locaddres :address
				}
		formData._token = $('meta[name="csrf-token"]').attr('content');
				$.ajax({
				type     : 'POST',
				url      : path+'ajaxaddress',
				data     : formData,
				datatype : 'json',
				success  : function(data) {
			//	console.log(data);
				$('.number').html(data[0].phone_number);			
				$('.man_name').html(data[0].man_name);			
				$('.designation').html(data[0].man_desig);	
				var image_path = path+"uploads/"+data[0].image;
				$('.image').attr('src',image_path);
				$(".change_address").html(data[0].address);
				},
				error: function(data) {
				/*removeLoader();*/
				$('span.err').show();
				var errors = data.responseJSON;
				}
				});
	}
	
	
	
////////////**************  Function for opening particular marker from details button   *******************////////////
function myClick(id){
        google.maps.event.trigger(markerbutton[id], 'click');
        $('html, body').animate({scrollTop:0}, 'slow');
    }


////////////**************  Code For Closing the Infoboxes   *******************////////////
function closeAllInfoWindows() {
  for (var i=0;i<infoWindows.length;i++) {
     infoWindows[i].close();
     }
      for (var i=0;i<markerPlus.length;i++) {
		   var icondot = path+'/images/pin/yellowdot.png';
     markerPlus[i].setIcon(icondot);
     }
}





///////////////***** code for Big map end  here ******/////////////////	








///////////////***** code for four locations start from here ******/////////////////



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
  
	
		 /////////////*********** Function which creates latitude longitude from an address *********///////////////
function codeAddressbelow(address,mapId) {
	
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
	

	////////////******* fucntion for creating marker ***********///////////
	function add_marer(results,map) 
	{
		
		
		
		//console.log(results);
		var marker = new google.maps.Marker({
			map: map,
			title:results[0].geometry.location,
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
		codeAddressbelow(addresses[i],j);
	});





///////////////***** code for four locations end here ******/////////////////
   	setTimeout(function(){
   		var id = <?php echo $id; ?>
   	/*var addresses = <?php echo $addresses;?>;
		if(addresses[0] != '')
		{*/
			myClick(id); 
		/*}*/
   		
   	},1000);

 </script>
 
 
 
 
 
 
 
@endsection
