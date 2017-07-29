{{-- */use repositories\CommonRepositoryInterface;/* --}}
{{-- */use repositories\CommonRepository;/* --}}
{{-- */use App\Settings;/* --}}
@extends('layout')
@section('title')
	 Request A Quote	
@endsection
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection
@section('content') 
<main id="main" role="main" class="loader_front" >
			<section class="block-storage add5">
				<div class="container">
					<div class="row">
						<div class="col-4 left-col">
							<article class="article-holder">
								<h1>request a quote</h1>
								
								<?php $num = Settings::where('type','number')->where('key','number')->pluck('value'); 
								$address_loc = Settings::where('type','text_quote')->where('key','text_quote')->pluck('value');?>
								<a class="tel" href="tel:8888289743"><i class="icon icon-phone"></i>{{ $num }}</a>
								<p>{!! $address_loc !!}</p>
							</article>
						</div>
						<div class="col-7 right-col">
			{!! Form::open(['method' => 'POST','url' => 'productsdetail/registerquery','id'=>'registerForm','class' =>'form-request']) !!}
								<input type="hidden" id="product_id" name="product_id" value="{{ $id }}">
								<div class="row-holder">
									<div class="lable-holder">
										<label for="name">Name:</label><span class="star" style="color:red">*</span>
									</div>
									<div class="field-holder">
										{!! Form::text('name',old('name'),['class' => 'form-control', 'id' => 'name_s','name'=>'name_s','placeholder'=>'Enter your name']) !!}
										<span class="form_error" style="color:red"></span>
									</div>
								</div>
								<div class="row-holder">
									<div class="lable-holder">
										<label for="address">Email:</label><span class="star" style="color:red">*</span>
									</div>
									<div class="field-holder">
										<input type="text" id="email" name="email" placeholder="Enter your Email">
										<span class="form_error" style="color:red"></span>
									</div>
								</div>
								<div class="row-holder">
									<div class="lable-holder" id="locationField">
										<label for="address">Address:</label><span class="star" style="color:red">*</span>
									</div>
									<div class="field-holder">
										<input type="text" name="address" id="checkGoogleAddress" placeholder="Enter your Address">
										<span class="form_error" style="color:red"></span>
									</div>
								</div>
								<div class="row-holder">
									<div class="lable-holder">
										<label for="city">City:</label><span class="star" style="color:red">*</span>
									</div>
									<div class="field-holder">
		{!! Form::text('city',old('city'),['class' => 'form-control','id' => 'locality','name'=>'locality','placeholder'=>'Enter your city']) !!}  
                                  <span class="form_error" style="color:red"></span>
									</div>
								</div>
								<div class="row-holder">
									<div class="lable-holder">
										<label for="state">State:</label><span class="star" style="color:red">*</span>
									</div>
									<div class="field-holder">
		{!! Form::text('state',old('state'),['class' => 'form-control', 'id' => 'administrative_area_level_1','name'=>'administrative_area_level_1','placeholder'=>'Enter your state']) !!}
										<span class="form_error" style="color:red"></span>
									</div>
								</div>
								<div class="row-holder">
									<div class="lable-holder">
										<label for="state">Country:</label><span class="star" style="color:red">*</span>
									</div>
									<div class="field-holder">
										<input type="text" id="country" name="country" placeholder="Enter your country">
										<span class="form_error" style="color:red"></span>
									</div>
								</div>
								<div class="row-holder">
									<div class="lable-holder">
										<label for="zip">Zip:</label><span class="star" style="color:red">*</span>
									</div>
									<div class="field-holder">
							{!! Form::text('zip',old('zip'),['class' => 'form-control', 'id' => 'postal_code','name'=>'postal_code','placeholder'=>'Enter your zip code']) !!}
										<span class="form_error" style="color:red"></span>
									</div>
								</div>
								<div class="row-holder">
									<div class="lable-holder">
										<label for="phone">Phone Number:</label><span class="star" style="color:red">*</span>
									</div>
									<div class="field-holder">
										<input type="tel" id="phone" name="number" placeholder="Enter your Phone Number">
										<span class="form_error" style="color:red"></span>
									</div>
								</div>
								<div class="row-holder">
									<div class="lable-holder">
										<label for="select">Area of Interest:</label><span class="star" style="color:red">*</span>
									</div>
									<div class="field-holder">
                                    {!! Form::select('interested_in',[''=>'--Select--']+$interest,null,['id'=>'txt1']) !!}
									<span class="form_error" style="color:red"></span>
									</div>
								</div>
								<div class="row-holder">
									<div class="lable-holder">
										<label for="comment">Additional Comments:</label><span class="star" style="color:red">*</span>
									</div>
									<div class="field-holder">
										<textarea id="comment" name="comment" placeholder="Enter your Comment"></textarea>
										<span class="form_error" style="color:red"></span>
									</div>
								</div>
								<div class="row-holder">
									<div class="lable-holder">
										<label for="comment">verify the code:</label><span class="star" style="color:red">*</span>
									</div>
									<div class="field-holder captch_holder" >
										

										<div class="width_50_cap">{!! $captcha !!}</div>
											<span class="cap_img"><!--img src="http://capitolsheds.debutinfotech.com/images/repeat.png"--></span>
                                       {!! Form::text('captcha',null,['class' => 'form-control','id'=>'captcha']) !!}
                                       
										<span class="form_error" style="color:red"></span>
									</div>
								</div>
							<div class="row-holder">
									<div class="lable-holder">
									</div>
									<div class="field-holder">
										<input type="submit" id="registerquery" value="submit">
									</div>
								</div>
						{!! Form::close() !!}  
						</div>
					</div>
				</div>
			</section>
		</main>
	@endsection
@section('js')
<script src="{{ asset('js/jquery.maskedinput.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBT-OgfWDJmKlsic-GY02JW0ZnSGHiJuJA&libraries=places"></script>
<script src="{{ asset('js/jquery.geocomplete.js') }}" type="text/javascript"></script>
<script type="text/javascript">
 $("#phone").mask("(999) 999-9999");
 </script>

<script type="text/javascript">
	
	
	

	
$(document).on('click','#registerquery',function(e){
addLoader('.loader_front ');
e.preventDefault();
	var formData = $("#registerForm").serialize();
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
			url : path+'product/request-quote',
			   type:'post',
			   data : formData,
			   dataType : 'json',
			   success : function(data){
				  removeLoader('.loader_front');
				    if(data.success == 'true'){
						$('#registerForm')[0].reset();
						showSuccessMessage("Request sent successfully.");
						$('span.form_error').hide();
					}
				},
			error : function(data){
                    $('.captch_holder img').click();
					removeLoader('.loader_front');
					if(data.responseJSON){
					var err_response = data.responseJSON;

					if(err_response.exception_message_front) {
					showErrorMessage(err_response.exception_message_front);
                     }
                    $('span.form_error').hide();
					$.each(err_response, function(i, obj)
					{
					$('textarea[name='+i+']').parent('.field-holder').find('span.form_error').slideDown(400).html(obj);
					$('input[name='+i+']').parent('.field-holder').find('span.form_error').slideDown(400).html(obj);
					$('select[name='+i+']').parent('.field-holder').find('span.form_error').slideDown(400).html(obj);	
					});	
			}
			} 
			});
	   });
	  $(document).ready(function(){
			checkGoogleAddress
			$("#checkGoogleAddress").geocomplete({
          details: "#registerForm",
          types: ["geocode"],
        });
      });
</script>
@endsection

