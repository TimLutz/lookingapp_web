@extends('admin.layout')
@section('title')
	Add Property
@endsection
@section('heading')
	Add Property
@endsection
@section('content')
<div class="tab-pane" id="tab_1">
								<div class="portlet box blue">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-gift"></i>Add Property
										</div>
<!--
										<div class="tools">
											<a href="javascript:;" class="collapse">
											</a>
											<a href="#portlet-config" data-toggle="modal" class="config">
											</a>
											<a href="javascript:;" class="reload">
											</a>
											<a href="javascript:;" class="remove">
											</a>
										</div>
-->
									</div>
<div class="portlet-body form">
				@include('errors.user_error')
				
	{!! Form::open(array('method' => 'POST','url' => '/'.getenv('adminurl').'/property/create','files' => 'true','id'=>'addusers')) !!}
		@include('admin.properties.form',['submitButtonText' => 'Add Property'])
		 {!! Form::hidden('action','add') !!}
	{!! Form::close() !!}
			</div>	
		</div>
	</div>

@endsection	
@section('js')
<script>
jQuery(document).ready(function() {     
	$('#adduserbutton').click(function(){
	 var formData = new FormData($('#addusers')[0]);
	
	$.ajax({
		dataType: 'json',
		method:'post',
		processData: false,
		contentType: false,
		url: path+'nimdaalf/properties/create',
		data: formData,
		beforeSend : function() {
			addLoader();
		},
		
		success  : function(data) {
			if(data.success == true){
				//alert('success');
				showSuccessMessage('Data Added Successfully.');
				$('#addusers')[0].reset();
				
						window.location = path+'nimdaalf/properties';
			
				
			}	
			else
			{		
				showErrorMessage('Data not Added.');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			removeLoader();
			
				$("#addusers .form-group").removeClass("has-error");
			$(".help-block").hide();
			$.each(xhr.responseJSON, function(i, obj)
				{
					$('input[name="'+i+'"]').closest('.form-group').addClass('has-error');
					$('input[name="'+i+'"]').closest('.form-group').find('label.help-block').slideDown(400).html(obj);
					$('textarea[name="'+i+'"]').closest('.form-group').addClass('has-error');
					$('textarea[name="'+i+'"]').closest('.form-group').find('label.help-block').slideDown(400).html(obj);
					$('file[name="'+i+'"]').closest('.form-group').addClass('has-error');
					$('file[name="'+i+'"]').closest('.form-group').find('label.help-block').slideDown(400).html(obj);
						if (i.indexOf("option") >= 0)  {
						
					
					var result = i.split('.');
				//	alert("input[name="+result[0]+"["+result[1]+"]]");
					
			$("input[name='"+result[0]+"["+result[1]+"]']").closest('.appended_div1').addClass('has-error');
			$("input[name='"+result[0]+"["+result[1]+"]']").closest('.appended_div1').find('label.help-block').slideDown(400).html(obj);

			$("input[name='"+result[0]+"["+result[1]+"]']").closest('.appended_div').addClass('has-error');
			$("input[name='"+result[0]+"["+result[1]+"]']").closest('.appended_div').find('label.help-block').slideDown(400).html(obj);
						}
				});
					
			}
		
	});
	
	});
});
</script>
<script>
        jQuery(document).ready(function() {       
			
			
			
			 var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
   // var add_button2      = $(".add_field_button2"); //Add button ID

var y = 1;
var x = 1; //initlal text box count
    $(".add_field_button2").click(function(e){ //on add input button click
		
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
             y++;
            $(wrapper).append('<div class="appended_div"><br><div class="row"><div class="col-sm-10"><input type="text" name="option['+y+']" class="form-control"></div><div class="col-sm-2 text-right"><span class="input-group-btn appended_span remove_field"><button class="btn blue" type="button"><i class="fa fa-times"></i></button></span></div></div><label class="help-block" id="option'+y+'_error"></label></div>'); //add input box
            
        }
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').parent('div').parent('div').remove(); x--;
    })
    	
			
        }); 

    	    
    </script>
    
     <script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
          $('#longitude').val('');
             $('#latitude').val('');
               $('#city').val('');
                $('#country').val('');
                  $('#state').val('');
        
        var place = autocomplete.getPlace();
       console.log(place);
        
        
        
        
        
        
         var longitude =  place.geometry.location.lng();
			$('#longitude').val(longitude);
        
        var latitude = place.geometry.location.lat();
			$('#latitude').val(latitude);
        
        
         for (var i=0; i < place.address_components.length; i++) {
          for (var j=0; j < place.address_components[i].types.length; j++) {
           
           // for city
               if (place.address_components[i].types[j] == "administrative_area_level_2") {
              country = place.address_components[i];
               $('#city').val(country.long_name);
             
            }
            //for state
             if (place.address_components[i].types[j] == "administrative_area_level_1") {
              country = place.address_components[i];
               $('#state').val(country.long_name);
             
            }
            // for country
             if (place.address_components[i].types[j] == "country") {
              country = place.address_components[i];
               $('#country').val(country.long_name);
              }
                 if (place.address_components[i].types[j] == "postal_code") {
              country = place.address_components[i];
               $('#postal_code').val(country.long_name);
              }
              
          }
        }
        

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvFbCN5CohZmKKuxx-8CwAz7PdglrN9iA&libraries=places&callback=initAutocomplete"
    
        async defer></script>
        

    
    
    
@endsection	
