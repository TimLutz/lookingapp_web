@include('header')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<div class="container">
	<div class="row">

		<div class="col-md-12">
			<div class="col-md-4">
				@include('sidebar')
			</div>
			<div id="msg">
			</div>
			<div class="col-md-8">
			@include('flash::message')
			{!! Form::open(['url'=>'user/booking','method'=>'post']) !!}
			<input type="hidden" name="quotation_id" id="quodation_id" value="<?php if(Session::get('quote_id') != ''){ echo Session::get('quote_id'); } ?>">
			<input type="hidden" name="pickdistance" id="pickdistance" value="<?php if(Session::get('pickupdistance') != ''){ echo Session::get('pickupdistance'); } ?>">
			<input type="hidden" name="dropdistance" id="dropdistance" value="<?php if(Session::get('dropofdistance') != ''){ echo Session::get('dropofdistance'); } ?>">
			<input type="hidden" name="amount" id="amount" value="<?php if(Session::get('amount') != ''){ echo Session::get('amount'); } ?>">
			
				<div class="row">
					<div class="col-md-6">
						<h1>Pick up</h1>
						<div class="form-group @if ($errors->has('pic_companyname')) has-error @endif">
							<!--<input type="text" placeholder="Name/Company" name="pic_companyname" id="pic_companyname" class="form-control">-->
							<select onchange="pickuplocation(this.value)" name="pic_companyname" id="pic_companyname" class="form-control piccompanyname">
								<option value="">Select Pickup Location</option>
								<?php
								$picaddress = array();
									foreach($location AS $loc)
									{
										?>
										<!-- <option value="<?php echo Crypt::encrypt($loc['street_name']); ?>" <?php if((isset($picku['contact_name']) && $picku['contact_name'] == $loc['contact_name'])){ echo 'selected'; } ?>><?php echo $loc['contact_name']; ?></option> -->
										<option value="<?php echo $loc['street_name']; ?>" <?php if((isset($picku['contact_name']) && $picku['contact_name'] == $loc['contact_name'])){ echo 'selected'; } ?>><?php echo $loc['contact_name']; ?></option>
										<!-- <option value="<?php echo Crypt::encrypt($loc['id']).','.$loc['street_name']; ?>" <?php if(isset($picku['contact_name']) && $picku['contact_name'] == $loc['contact_name']){ echo 'selected'; } ?>><?php echo $loc['contact_name']; ?></option>  -->
										<?php

									}
									/*if(Session::get('pickup') && Session::get('pickup') != '')
									{
										?>
										<option value="<?php echo Crypt::encrypt(Session::get('pickup')); ?>" <?php if(Session::get('pickup') != ''){ echo 'selected'; } ?>><?php echo Session::get('pickup');  ?></option>
										<?php
									}*/
								?>
							</select>
							@if ($errors->has('pic_companyname')) <p class="help-block">{{ $errors->first('pic_companyname') }}</p> @endif
						</div>
						<div class="form-group @if ($errors->has('pic_email')) has-error @endif">
							<!-- <input type="email" placeholder="Email" name="pic_email" id="pic_email" class="form-control" value="<?php if(isset($picku['email']) && $picku['email'] != ''){  echo $picku['email']; } ?>"> -->
							<?php

							echo Form::email('pic_email',(Session::get('email') && Session::get('email') != '') ? Session::get('email') : ((isset($picku['email']) && $picku['email'] != '') ? $picku['email'] : ''),['class'=>'form-control','id'=>'pic_email'])
							?>
							@if ($errors->has('pic_email')) <p class="help-block">{{ $errors->first('pic_email') }}</p> @endif
						</div>
						<div class="form-group @if ($errors->has('pic_mobile')) has-error @endif">
							<!-- <input type="text" placeholder="Mobile" name="pic_mobile"id="pic_mobile" class="form-control" value="<?php if(isset($picku['mobile']) && $picku['mobile'] != ''){  echo $picku['mobile']; } ?>"> -->
							<?php

							echo Form::text('pic_mobile',(Session::get('mobile') && Session::get('mobile')) ? Session::get('mobile') :(isset($picku['mobile']) && $picku['mobile'] != '' ? $picku['mobile'] : ''),['class'=>'form-control','id'=>'pic_mobile'])
							?>
							@if ($errors->has('pic_mobile')) <p class="help-block">{{ $errors->first('pic_mobile') }}</p> @endif
						</div>
						<div class="form-group @if ($errors->has('pic_streetname')) has-error @endif">
							<!-- <input type="text" placeholder="Street no" name="pic_streetno" id="pic_streetno" class="form-control" value="<?php if(isset($picku['street_no']) && $picku['street_no'] != ''){  echo $picku['street_no']; } ?>"> -->
							<?php

							echo Form::text('pic_streetno', (Session::get('pickup') && Session::get('pickup') != '') ? '':(isset($picku['street_no']) && $picku['street_no'] != '' ? $picku['street_no']:''),['class'=>'form-control','id'=>'pic_streetno'])
							?>
							@if ($errors->has('pic_streetno')) <p class="help-block">{{ $errors->first('pic_streetno') }}</p> @endif
						</div>
						<div class="form-group @if ($errors->has('pic_streetname')) has-error @endif pickLocation1">
							<!-- <input type="text" placeholder="Street Name" name="pic_streetname" id="pic_streetname" class="form-control" value="<?php if(isset($picku['street_name']) && $picku['street_name'] != ''){  echo $picku['street_name']; } ?>"> -->
							<?php

							echo Form::text('pic_streetname',(Session::get('pickup') && Session::get('pickup') != '') ? Session::get('pickup'):(isset($picku['street_name']) && $picku['street_name'] != '' ? $picku['street_name']:''),['class'=>'form-control','id'=>'pic_streetname'])
							?>
							@if ($errors->has('pic_streetname')) <p class="help-block">{{ $errors->first('pic_streetname') }}</p> @endif
						</div>
						<div class="form-group @if ($errors->has('pic_landmark')) has-error @endif">
							<!-- <input type="text" placeholder="Landmark" name="pic_landmark" id="pic_landmark" class="form-control"> -->
							<?php

							echo Form::text('pic_landmark',null,['class'=>'form-control','id'=>'pic_landmark'])
							?>
							@if ($errors->has('pic_landmark')) <p class="help-block">{{ $errors->first('pic_landmark') }}</p> @endif
						</div>
					</div>
					<div class="col-md-6">
						<h1>Drop of</h1>
						<div class="form-group @if ($errors->has('del_companyname')) has-error @endif">
							<!--<input type="text" placeholder="Name/Company" name="del_companyname" id="del_companyname" class="form-control">-->
							<select onchange="dropoflocation(this.value)" name="del_companyname" id="del_companyname" class="form-control dropcompanyname">
								<option value="">Select Dropof Location</option>
								<?php
									foreach($location AS $loc)
									{
										?>
										 <!-- <option value="<?php echo Crypt::encrypt($loc['street_name']); ?>" <?php if(isset($dropo['contact_name']) && $dropo['contact_name'] == $loc['contact_name']){ echo 'selected'; } ?>><?php echo $loc['contact_name']; ?></option>  -->
										 <option value="<?php echo $loc['street_name']; ?>" <?php if(isset($dropo['contact_name']) && $dropo['contact_name'] == $loc['contact_name']){ echo 'selected'; } ?>><?php echo $loc['contact_name']; ?></option> 
										<!-- <option value="<?php echo Crypt::encrypt($loc['id']).','.$loc['street_name']; ?>" <?php if(isset($dropo['contact_name']) && $dropo['contact_name'] == $loc['contact_name']){ echo 'selected'; } ?>><?php echo $loc['contact_name']; ?></option>  -->
										<?php
									}
									/*if(Session::get('dropof') && Session::get('dropof') != '')
										{
											?>
											<option value="<?php echo Crypt::encrypt(Session::get('dropof')); ?>" <?php if(Session::get('dropof') != ''){ echo 'selected'; } ?>><?php echo Session::get('dropof');  ?></option>
											<!-- <option value="<?php echo Session::get('droptof'); ?>" <?php if(Session::get('dropof') != ''){ echo 'selected'; } ?>><?php echo Session::get('dropof');  ?></option> -->
											<?php
										}*/
								?>
							</select>
							@if ($errors->has('del_companyname')) <p class="help-block">{{ $errors->first('del_companyname') }}</p> @endif
						</div>
						<div class="form-group @if ($errors->has('del_email')) has-error @endif">
							<!-- <input type="email" placeholder="Email" name="del_email" id="del_email" class="form-control" value="<?php if(isset($dropo['email']) && $dropo['email'] != ''){  echo $dropo['email']; } ?>"> -->
							<?php

							echo Form::email('del_email',(Session::get('dropof') && Session::get('dropof') != '') ? '':(isset($dropo['email']) && $dropo['email'] != '' ? $dropo['email']:''),['class'=>'form-control','id'=>'del_email'])
							?>
							@if ($errors->has('del_email')) <p class="help-block">{{ $errors->first('del_email') }}</p> @endif
						</div>
						<div class="form-group @if ($errors->has('del_mobile')) has-error @endif">
							<!-- <input type="text" placeholder="Mobile" name="del_mobile"id="del_mobile" class="form-control" value="<?php if(isset($dropo['mobile']) && $dropo['mobile'] != ''){  echo $dropo['mobile']; } ?>"> -->
							<?php

							echo Form::text('del_mobile',(Session::get('dropof') && Session::get('dropof') != '') ? '':(isset($dropo['mobile']) && $dropo['mobile'] != '' ? $dropo['mobile']:''),['class'=>'form-control','id'=>'del_mobile'])
							?>
							@if ($errors->has('del_mobile')) <p class="help-block">{{ $errors->first('del_mobile') }}</p> @endif
						</div>
						<div class="form-group @if ($errors->has('del_streetno')) has-error @endif">
							<!-- <input type="text" placeholder="Street no" name="del_streetno" id="del_streetno" class="form-control" value="<?php if(isset($dropo['street_no']) && $dropo['street_no'] != ''){  echo $dropo['street_no']; } ?>"> -->
							<?php

							echo Form::text('del_streetno',(Session::get('dropof') && Session::get('dropof') != '') ? '':(isset($dropo['street_no']) && $dropo['street_no'] != '' ? $dropo['street_no']:''),['class'=>'form-control','id'=>'del_streetno'])
							?>
							@if ($errors->has('del_streetno')) <p class="help-block">{{ $errors->first('del_streetno') }}</p> @endif
						</div>
						<div class="form-group @if ($errors->has('del_streetname')) has-error @endif dropLocation1">
							<!-- <input type="text" placeholder="Street Name" name="del_streetname" id="del_streetname" class="form-control" value="<?php if(isset($dropo['street_name']) && $dropo['street_name'] != ''){  echo $dropo['street_name']; } ?>"> -->
							<?php

							echo Form::text('del_streetname',(Session::get('dropof') && Session::get('dropof') != '') ? Session::get('dropof'):(isset($dropo['street_name']) && $dropo['street_name'] != '' ? $dropo['street_name']:''),['class'=>'form-control','id'=>'del_streetname'])
							?>
							@if ($errors->has('del_streetname')) <p class="help-block">{{ $errors->first('del_streetname') }}</p> @endif
						</div>
						<div class="form-group @if ($errors->has('del_landmark')) has-error @endif">
							<!-- <input type="text" placeholder="Landmark" name="del_landmark" id="del_landmark" class="form-control"> -->
							<?php

							echo Form::text('del_landmark',null,['class'=>'form-control','id'=>'del_landmark'])
							?>
							@if ($errors->has('del_landmark')) <p class="help-block">{{ $errors->first('del_landmark') }}</p> @endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group @if ($errors->has('service_id')) has-error @endif">
						<h4>Delivery Speed</h4>
						<?php
						$eta = '';
							foreach($services AS $service)
							{
								?>
								<div class="col-md-4">
									<!-- <input type="radio" name="service_id" id="service_id" value="<?php echo $service['id']; ?>" <?php if((Session::get('service') != '') && (Session::get('service') == $service['id'])){  echo 'checked=checked'; } ?> class="changeservice" onclick="changeservice('<?php echo $service['id']; ?>');"> -->
									<?php
                                        echo Form::radio('service_id',$service['title'],Session::get('service') != '' && Session::get('service') == $service['title'] ? true:false,['id'=>'service_id','onclick'=>"changeservice('".$service['title']."')"]);
                                    ?>
								</div>
								<div class="col-md-8">
									<?php echo $service['title']; ?>
								</div>
								
								<?php
								if(Session::has('service') == $service['title'])
								{
									$eta = $service['eta'];
								}
							}

						?>
					<div class="clearfix"></div>
					@if ($errors->has('service_id')) <p class="help-block">{{ $errors->first('service_id') }}</p> @endif
					</div>
					<div class="col-md-6 form-group @if ($errors->has('mode_type')) has-error @endif modeTypes">
						<h4>Size of package you are sending</h4>
						<?php
							foreach($modes AS $mode)
							{
								if($mode['status'] == 0)
								{
									 ?>
									 <?php
                                        echo Form::radio('mode_type',$mode['id'],Session::get('mode_type') != '' && Session::get('mode_type') == $mode['id'] ? true:false,['class'=>'form-control','id'=>'mode_type','disabled'=>'disabled']);
                                        ?>
									 <?php
								}
								?>
								<div class="col-md-4">
									<!-- <input type="radio" name="mode_type" id="mode_type" value="<?php echo $mode['id']; ?>" <?php if((Session::get('mode_type') != '') && (Session::get('mode_type') == $mode['id'])){  echo 'checked=checked'; } ?>> -->
									<?php
                                        echo Form::radio('mode_type',$mode['id'],Session::get('mode_type') != '' && Session::get('mode_type') == $mode['id'] ? true:false,['id'=>'mode_type']);
                                    ?>
								</div>
								<div class="col-md-8">
									<?php echo $mode['title']; ?>
								</div>
								<?php
							}

						?>
					</div>
					@if ($errors->has('mode_type')) <p class="help-block">{{ $errors->first('mode_type') }}</p> @endif
					<div class="clearfix"></div>
				</div>
				<div class="row">
					<div class="col-md-12 form-group @if ($errors->has('item_description')) has-error @endif">
						<!-- <textarea name="item_description" placeholder="Brief Description of the product" class="form-control"></textarea> -->
					<?php

						echo Form::textarea('item_description',null,['class'=>'form-control','id'=>'item_description'])
					?>
					</div>
					@if ($errors->has('item_description')) <p class="help-block">{{ $errors->first('item_description') }}</p> @endif
				</div>
				<div class="row">
				<h1>When you need it</h1>
					<div class="col-md-6">
						<div class="form-group @if ($errors->has('delivery_date')) has-error @endif">
							<label>Delivery Date</label>
						</div>
						<div class="form-group input-append date" data-date-format="yyyy-mm-dd">
							<!-- <input type="text" name="delivery_date" id="delivery_date" placeholder="2016-04-14" class="form-control"> -->
							<?php

							echo Form::text('delivery_date',null,['class'=>'form-control datepicker','id'=>'delivery_date','placeholder'=> date('Y-m-d')])
							?>
							
							@if ($errors->has('delivery_date')) <p class="help-block">{{ $errors->first('delivery_date') }}</p> @endif
						</div>
						<div class="form-group @if ($errors->has('delivery_time')) has-error @endif">
							<label>Approx delivery time</label>
						</div>
							<!-- <input type="text" name="delivery_time" id="delivery_time" placeholder="04:15:59" class="form-control"> -->
						<div class="form-group">
							<?php

								echo Form::text('delivery_time',null,['class'=>'form-control','id'=>'delivery_time','placeholder'=>date('H:i')])
							?>
							@if ($errors->has('delivery_time')) <p class="help-block">{{ $errors->first('delivery_time') }}</p> @endif
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Time Avaible to picked up</label>
						</div>
						<div class="form-group @if ($errors->has('pickup_time')) has-error @endif">
							<!-- <input type="text" name="pickup_time" id="pickup_time" class="form-control"> -->
							<?php

							echo Form::text('pickup_time',null,['class'=>'form-control','id'=>'pickup_time','placeholder'=>date('H:i')])
							?>
							@if ($errors->has('pickup_time')) <p class="help-block">{{ $errors->first('pickup_time') }}</p> @endif
						</div>
						<div class="form-group ">
							<label>Approx delivery time</label>
						</div>
						<div class="form-group">
							<input type="text" value="<?php echo $eta; ?>" class="form-control" id="availabletime">
						
						</div>
					</div>
					<div class="col-md-12 form-group">
						<input type="checkbox" name="atl" id="atl" class="pull-right">
						
						<span class="pull-right">ATL</span>
						
					</div>
				</div>
				<div class="row">
					<div class="form-holder">
                                        <h2>Payment</h2>
                                        <span id="cardERR" style="color:red; float:left; width:100%; text-align:left" class="help-block"></span>
                                        <div class="field-row">
                                                <div class="col medium">
                                                        {!! Form::text('card_number',null,['class' => 'form-control', 'id' => 'card_number', 'placeholder' => 'Card Number', 'data-stripe' => 'number']) !!} 
                                                      
                                                </div>
                                                
                                        </div>
                                        <div class="field-row alt">
                                            <div class="col">
                                                {!! Form::text('cvv',null,['class' => 'form-control', 'id' => 'cvv', 'placeholder' => '3-digit Code', 'maxlength' => '4', 'data-stripe' => 'cvc']) !!} 
                                            </div>
                                         
                                        </div>
                                        <div class="field-row">
                                            <div class="col">
                                                <div class="col">
                                                    <select class="default" name="ex_month" id="ex_month" data-stripe="exp-month">
                                                        <option value="01">01- Jan</option>
                                                        <option value="02">02- Feb</option>
                                                        <option value="03">03- March</option>
                                                        <option value="04">04- April</option>
                                                        <option value="05">05- May</option>
                                                        <option value="06">06- june</option>
                                                        <option value="07">07- July</option>
                                                        <option value="08">08- August</option>
                                                        <option value="09">09- September</option>
                                                        <option value="10">10- October</option>
                                                        <option value="11">11- November</option>
                                                        <option value="12">12- December</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <select class="default" name="ex_year" id="ex_year" data-stripe="exp-year">
                                                            <?php $date = date('Y'); $max_date = $date+10;  ?>

                                                            @for ($i = $date; $i <= $max_date; $i++)
                                                              <option value="{{ $i }}">{{ $i }}</option>

                                                            @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="ex_date" id="ex_date">
                                        <input type="hidden" name="stripeToken" id="stripe_token" value="" />
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                      <!--   <div class="agreement">
                                                <input type="checkbox" id="billing-info2" name="save_card_detail"
												<?php if(isset($card_detail) && count($card_detail)) { ?> checked="checked" <?php } ?>>
                                                <span class="label"><label for="billing-info2">Save my payment information</label></span>
                                        </div> -->
                                     
                                                    
                                               
                                        </ul>
                                       
                                </div>
				</div>
				<div class="row">
					<div class="form-group">
						{!! Form::submit('Booking') !!}
					</div>
				</div>
				{!! Form::close() !!}

			</div>					
		</div>
	</div>
</div>
@section('js')
<script type="text/javascript" src="{{ asset('js/timepicker.js') }}"></script>
<script>
      $(function(){
        $("#pic_streetname").geocomplete({
           details: ".pickLocation1",
           types: ["geocode", "establishment"],
        });

        $("#del_streetname").geocomplete()
        .bind("geocode:result", function (event, result) {                      
        });
      });

      
    </script>
<script type="text/javascript">
$('.piccompanyname').change(function(){
	var drop = $('#del_companyname').val();
	var pic = $('#pic_companyname').val();
//	var service = $('#service_id').val();
	var service = $('input[name=service_id]:checked').val();
	var modetype = $('input[name=mode_type]:checked').val();
	
	var token = $('meta[name="csrf-token"]').attr('content');
	if(pic != '' &&  drop != '')
	{
		
		var format = 'picloc='+pic+"&droploc="+drop+'&_token='+token;
		if(service != undefined)
		{
			format = format + '&service='+service;
		}
		
		if(modetype != undefined)
		{
			format = format + '&modetype='+modetype;
		}
		
		var result = confirm('Are want change the pick up location!');
		if(result)
		{
			 $.ajax({
                type:'post',
                url:path+'user/ajaxtotaldistance',
                data : format,
                
                
                success: function(json){
                console.log(json);
                if(json.success == true)
                {
                   if(json.pickdistance == 'Distance can not be calculated for this route.')
	                {
	                  alert('Please enter valid address!');
	                }
	                else
	                {
                  		$('#pickdistance').val(json.pickdistance);
	                }
	                if(json.dropdistance == 'Distance can not be calculated for this route.')
	                {
	                  alert('Please enter valid address!');
	                }
	                else
	                {
                  		$('#dropdistance').val(json.dropdistance);
	                }	
                  $('#amount').val(json.amount);
                }
                
                //$('#distance').val(json);
              },
              error : function(xhr, ajaxOptions, thrownError) {      
              			if(xhr.success == false)
              			{
              				alert('something wrong!');
              			}	
                    }
              });
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}

});

$('.dropcompanyname').change(function(){
	var drop = $('#del_companyname').val();
	var pic = $('#pic_companyname').val();
	var token = $('meta[name="csrf-token"]').attr('content');
	var service = $('input[name=service_id]:checked').val();
	var modetype = $('input[name=mode_type]:checked').val();
	//alert(service);
	if(pic != '' &&  drop != '')
	{
		var format = 'picloc='+pic+"&droploc="+drop+'&_token='+token;
		if(service != undefined)
		{
			format = format + '&service='+service;
		}
		
		if(modetype != undefined)
		{
			format = format + '&modetype='+modetype;
		}
		
//		alert(format);

		var result = confirm('Are want change the pick up location!');
		if(result)
		{
			 $.ajax({
                type:'post',
                url:path+'user/ajaxtotaldistance',
                data : format,
                
                
                success: function(json){
                console.log(json);
                if(json.success == true)
                {
                  if(json.pickdistance == 'Distance can not be calculated for this route.')
	                {
	                  alert('Please enter valid address!');
	                }
	                else
	                {
                  		$('#pickdistance').val(json.pickdistance);
	                }
	                if(json.dropdistance == 'Distance can not be calculated for this route.')
	                {
	                  alert('Please enter valid address!');
	                }
	                else
	                {
                  		$('#dropdistance').val(json.dropdistance);
	                }	
               
                  $('#amount').val(json.amount);
                }
                
                //$('#distance').val(json);
              },
              error : function(xhr, ajaxOptions, thrownError) {      
              			if(xhr.success == false)
              			{
              				alert('something wrong!');
              			}	
                    }
              });
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}

});
</script>
<script>
function pickuplocation(object)
{
  var str = object;
  //var res = str.split(",");
//  var id = res[0];
  var token = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
              type:'post',
              url:path+'user/changepicklocation',
              data : 'object='+str+'&_token='+token,
              
              
              success: function(json){
              console.log(json);
              if(json.success == true)
              {
                $("#pic_email").val(json.location[0].email);  
                $("#pic_mobile").val(json.location[0].mobile);  
                $("#pic_streetno").val(json.location[0].street_no);  
                $("#pic_streetname").val(json.location[0].street_name);  
                
              }
              if(json.success == false)
              {
                $("#pic_email").val('<?php if(Session::get('pickup') != ''){ echo Session::get('email'); } else { echo ''; } ?>');  
                $("#pic_mobile").val('<?php if(Session::get('pickup') != ''){ echo Session::get('mobile'); }else { echo ''; } ?>');  
                $("#pic_streetno").val('');  
                $("#pic_streetname").val(''); 
              }

              //$('#distance').val(json);
            },
            error : function(xhr, ajaxOptions, thrownError) {            }
            });

  
}

function dropoflocation(object)
{
  var str = object;
 // var res = str.split(",");
 // var id = res[0];
  var token = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
              type:'post',
              url:path+'user/changepicklocation',
              data : 'object='+str+'&_token='+token,
              
              
              success: function(json){
              console.log(json);
              if(json.success == true)
              {
                $("#del_email").val(json.location[0].email);  
                $("#del_mobile").val(json.location[0].mobile);  
                $("#del_streetno").val(json.location[0].street_no);  
                $("#del_streetname").val(json.location[0].street_name); 
                
              }
               if(json.success == false)
              {
                $("#del_email").val('');  
                $("#del_email").val('');  
                $("#del_email").val('');  
                $("#del_email").val('');   
              }

              //$('#distance').val(json);
            },
            error : function(xhr, ajaxOptions, thrownError) {    
                      
                        alert("gfdh");
                      
                    }
            });

  
}

</script>
<script type="text/javascript">
	$(document).ready(function(){
		$( ".datepicker" ).datepicker({ minDate: 0,dateFormat:"yy-mm-dd"});
		$("#pickup_time").timepicker();
		$("#delivery_time").timepicker({ 'scrollDefault': 'now' });
	<?php
		if(Session::has('pickup') == '' && Session::has('dropof') == '')
		{
			?>
		var drop = $('#del_streetname').val();
		var pic = $('#pic_streetname').val();
		
		var token = $('meta[name="csrf-token"]').attr('content');
		if(pic != '' &&  drop != '')
		{
			var format = 'picloc='+pic+'&droploc='+drop+'&_token='+token;
			
		 $.ajax({
            type:'post',
            url:path+'user/totaldistance',
            data : format,
            
            
            success: function(json){
            if(json.success == true)
            {
                if(json.pickdistance == 'Distance can not be calculated for this route.')
                {
                  alert('Please enter valid address!');
                }
                else
                {
              		$('#pickdistance').val(json.pickdistance);
                }
                if(json.dropdistance == 'Distance can not be calculated for this route.')
                {
                  alert('Please enter valid address!');
                }
                else
                {
              		$('#dropdistance').val(json.dropdistance);
                }	
              $('#amount').val(json.amount);
		      $('#availabletime').val(json.available_time);
            }
            
            //$('#distance').val(json);
          },
          error : function(xhr, ajaxOptions, thrownError) {      
          			if(xhr.success == false)
          			{
          				alert('something wrong!');
          			}	
                }
          });
		}
		else
		{
			return false;
		}
	<?php
	}
		
	?>	
	});
</script>

<script type="text/javascript">
	$('.pickLocation1').change(function(){
		var pickloc = $('#pic_streetname').val();
		var droploc = $('#del_streetname').val();
		alert(droploc);
		var token = $('meta[name="csrf-token"]').attr('content');
		var service = $('input[name=service_id]:checked').val();
		var modetype = $('input[name=mode_type]:checked').val();
		if(pickloc != '' && droploc != '')
		{
			var format = 'picloc='+pickloc+'&droploc='+droploc+'&_token='+token;
			if(service != undefined)
			{
				format = format + '&service='+service;
			}
				
			if(modetype != undefined)
			{
				format = format + '&modetype='+modetype;
			}
			
			$.ajax({
              type:'post',
              url:path+'user/ajaxtotaldistance',
              data : format,
             // data : {'origin':pickloc,'destination':droploc},
             
              success: function(json){
              console.log(json);
              if(json.success == true)
              {
              	  if(json.pickdistance == 'Distance can not be calculated for this route.')
	                {
	                  alert('Please enter valid address!');
	                }
	                else
	                {
                  		$('#pickdistance').val(json.pickdistance);
	                }
	                if(json.dropdistance == 'Distance can not be calculated for this route.')
	                {
	                  alert('Please enter valid address!');
	                }
	                else
	                {
                  		$('#dropdistance').val(json.dropdistance);
	                }	
		          
		          $('#amount').val(json.amount);
		          $('#availabletime').val(json.available_time);
              }

            },
            error : function(xhr, ajaxOptions, thrownError) {            }
            });
		}
		else
		{
			return false;
		}
	});
	$('.dropLocation1').change(function(){
		var pickloc = $('#pic_streetname').val();
		var droploc = $('#del_streetname').val();
		alert(droploc);
		var token = $('meta[name="csrf-token"]').attr('content');
		var service = $('input[name=service_id]:checked').val();
		var modetype = $('input[name=mode_type]:checked').val();
		if(pickloc != '' && droploc != '')
		{
			var format = 'picloc='+pickloc+'&droploc='+droploc+'&_token='+token;
			if(service != undefined)
			{
				format = format + '&service='+service;
			}
			
			if(modetype != undefined)
			{
				format = format + '&modetype='+modetype;
			}
			
			$.ajax({
              type:'post',
              url:path+'user/ajaxtotaldistance',
              data : format,
             // data : {'origin':pickloc,'destination':droploc},
             
              success: function(json){
              console.log(json);
              if(json.success == true)
              {
              	  if(json.pickdistance == 'Distance can not be calculated for this route.')
	                {
	                  alert('Please enter valid address!');
	                }
	                else
	                {
                  		$('#pickdistance').val(json.pickdistance);
	                }
	                if(json.dropdistance == 'Distance can not be calculated for this route.')
	                {
	                  alert('Please enter valid address!');
	                }
	                else
	                {
                  		$('#dropdistance').val(json.dropdistance);
	                }
		          $('#amount').val(json.amount);
		          $('#availabletime').val(json.available_time);
              }
            },
            error : function(xhr, ajaxOptions, thrownError) {            }
            });
		}
		else
		{
			return false;
		}
	});

	$('.modeTypes').change(function(){
		var pickloc = $('#pic_streetname').val();
		var droploc = $('#del_streetname').val();
		alert(droploc);
		var token = $('meta[name="csrf-token"]').attr('content');
		var service = $('input[name=service_id]:checked').val();
		var modetype = $('input[name=mode_type]:checked').val();
		if(modetype != '')
		{
			var format = 'modetype=' + modetype +'&_token='+token;
			if(pickloc != '' && droploc != '')
			{
				format = format + '&picloc='+pickloc+'&droploc='+droploc;
			}
			if(service != undefined)
			{
				format = format + '&service='+service;
			}
			else
			{
				service = '';
				format = format + '&service='+service;	
			}
			$.ajax({
              type:'post',
              url:path+'user/ajaxtotaldistance',
              data : format,
             // data : {'origin':pickloc,'destination':droploc},
             
              success: function(json){
              console.log(json);
              if(json.success == true)
              {
          		if(json.pickdistance == 'Distance can not be calculated for this route.')
                {
                  alert('Please enter valid address!');
                }
                else
                {
              		$('#pickdistance').val(json.pickdistance);
                }
                if(json.dropdistance == 'Distance can not be calculated for this route.')
                {
                  alert('Please enter valid address!');
                }
                else
                {
              		$('#dropdistance').val(json.dropdistance);
                }
		        $('#amount').val(json.amount);
		        $('#availabletime').val(json.available_time);
              }
            },
            error : function(xhr, ajaxOptions, thrownError) {            }
            });
		}
		else
		{
			return false;
		}
	});
</script>

@endsection
@include('footer')

