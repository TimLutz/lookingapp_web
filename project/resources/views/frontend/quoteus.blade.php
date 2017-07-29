{{-- */use repositories\CommonRepositoryInterface;/* --}}
{{-- */use repositories\CommonRepository;/* --}}

<?php 
    //$data = CommonRepository::getNotifications(); 
    $common = new CommonRepository();
    $modes =$common->getmodetype();
 //   $services =$common->getmodetype();
//    echo $data['mode_type'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Gohusky</title>


        <meta name="csrf-token" content="{!! csrf_token() !!}" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css"/>


        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
               /* vertical-align: middle;*/

            }

            .content {
                text-align: center;
                display: inline-block;
            }

            
            .signup{
                position: relative;
              

            }
            .signup a{
                color:#100 !important;
                text-decoration: none;
            }

        </style>
    </head>
    <body>
<div class="container"> 
   <div class="clearfix"></div>
                <div> 
        <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                         
                  
                    {!! Form::open(['url'=>'quoteus','method'=>'post']) !!}
                            <input type="hidden" name="distance" value="<?php if(Session::get('distance') != ''){ echo Session::get('distance'); } ?>" id="distance">
                            <input type="hidden" name="service" value="<?php if(Session::get('service') != ''){ echo Session::get('service'); } ?>" id="service">
                            <input type="hidden" name="amount" value="<?php if(Session::get('amount') != ''){ echo Session::get('amount'); } ?>" id="amount">
                            <input type="hidden" name="quotation_id" value="<?php if(Session::get('quote_id') != ''){ echo Session::get('quote_id'); } ?>" id="quotation_id">
                            <div class="form-group">
                                <div class="col-md-2 ">
                                    <label>
                                        Pick Up
                                    </label>
                                </div>
                                <div class="col-md-4 pickLocation form-group @if ($errors->has('pick_location')) has-error @endif">
                                    <!-- <input type="text" name="pick_location" id="pick_location" class="form-control" value="<?php if(Session::get('pickup') != ''){ echo Session::get('pickup'); } ?>"> -->
                                    <?php 
                                     echo Form::text('pick_location',Session::get('pickup') != '' ? Session::get('pickup') : null,['class'=>'flow-control','id'=>'pick_location']);
                                     ?>
                                    <input name="lat" type="hidden" value="">
                                    <input name="lng" type="hidden" value="">
                                </div>
                                @if ($errors->has('pick_location')) <p class="help-block">{{ $errors->first('pick_location') }}</p> @endif
                                <div class="col-md-2">
                                    <label>
                                        Drop off
                                    </label>

                                </div>
                                <div class="col-md-4 dropLocation form-group @if ($errors->has('drop_location')) has-error @endif">
                                    <!-- <input type="text" name="drop_location" id="drop_location" class="form-control" value="<?php if(Session::get('dropof') != ''){ echo Session::get('dropof'); } ?>"> -->
                                    <?php
                                    echo Form::text('drop_location',Session::get('dropof') != '' ? Session::get('dropof') : null,['class'=>'flow-control','id'=>'drop_location']);
                                    ?>
                                    <input name="drop_lat" type="hidden" class="droplat">
                                    <input name="drop_lng" type="hidden" class="droplng">
                                </div>
                                @if ($errors->has('drop_location')) <p class="help-block">{{ $errors->first('drop_location') }}</p> @endif
                            </div>
                            <div class="form-group @if ($errors->has('email')) has-error @endif">
                            <div class="col-md-6">
                                
                                 <!--    <input type="email" name="email" placeholder="Enter email" class="form-control" value="<?php if(Session::get('email') != ''){ echo Session::get('email'); } ?>"> -->
                                    <?php
                                    echo Form::text('email',Session::get('email') != '' ? Session::get('email') : null,['class'=>'flow-control','id'=>'email']);
                                    ?>
                                </div>
                                @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                            </div>
                            <div class="form-group @if ($errors->has('mobile')) has-error @endif">
                            <div class="col-md-6">
                                
                                <!--     <input type="text" name="mobile" placeholder="Enter mobile number" class="form-control" value="<?php if(Session::get('mobile') != ''){ echo Session::get('mobile'); } ?>"> -->
                                    <?php
                                    echo Form::text('mobile',Session::get('mobile') != '' ? Session::get('mobile') : null,['class'=>'flow-control','id'=>'mobile']);
                                    ?>
                                </div>
                                @if ($errors->has('mobile')) <p class="help-block">{{ $errors->first('mobile') }}</p> @endif
                            </div> 

                            <div class="form-group @if ($errors->has('service_id')) has-error @endif">
                            <div class="col-md-6">
                                    <h4>Delivery Speed</h4>
                                    <?php
                               //   print_r($services);
                                    foreach($services AS $service)
                                    {
                                        ?>
                                        <div class="col-md-4">
                                           <!--  <input type="radio" name="service_id" id="service_id" value="<?php echo $service['id']; ?>" <?php if((Session::get('service') != '') && (Session::get('service') == $service['id'])){  echo 'checked=checked'; } ?> class="changeservice" onclick="changeservice('<?php echo $service['id']; ?>');"> -->
                                             <?php
                                        /*echo Form::radio('service_id',$service['title'],Session::get('service') != '' && Session::get('service') == $service['title'] ? true:false,['class'=>'form-control','id'=>'service_id']);*/
                                        if(Session::get('service') == $service['title'])
                                        {
                                          echo  Form::radio('service_id',$service['title'],Session::get('service') != '' && Session::get('service') == $service['title'] ? true:false,['class'=>'form-control','id'=>'service_id']);
                                        }
                                        ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php
                                                if(Session::get('service') == $service['title'])
                                                { 
                                                    echo $service['title']; 
                                                }    
                                                    ?>
                                        </div>
                                        <div class="clearfix"></div>
                                        @if ($errors->has('service_id')) <p class="help-block">{{ $errors->first('service_id') }}</p> @endif
                                        <?php
                                        
                                    }   
                                    ?>                                         
                                </div>
                                <div class="col-md-6 form-group @if ($errors->has('mode_type')) has-error @endif">
                                    <h4>Size of Package you are sending</h4>
                                <?php
                                  foreach($modes AS $mode)
                                  {
                                 /*   if($mode['status'] == '0')*/
                                    /*{
                                        ?>
                                            <div class="col-md-4">
                                            <!-- <input type="radio" name="mode_type" id="mode_type" value="<?php echo $mode['id']; ?>" class="form-control" <?php if((Session::get('mode_type') != '') && Session::get('mode_type')==$mode['id']){ echo 'checked=checked'; } ?> > -->
                                             <?php
                                        echo Form::radio('mode_type',$mode['id'],Session::get('mode_type') != '' && Session::get('mode_type') == $mode['id'] ? true:false,['class'=>'form-control','id'=>'mode_type','disabled'=>'disabled']);
                                        ?>
                                            </div>
                                        
                                        <?php
                                    }
                                    else*/
                                    /*{*/
                                    ?>

                                    <div class="col-md-4">
                                       <!--  <input type="radio" name="mode_type" id="mode_type" value="<?php echo $mode['id']; ?>" class="form-control" <?php if((Session::get('mode_type') != '') && Session::get('mode_type')==$mode['id']){ echo 'checked=checked'; } ?> > -->
                                        <?php
                                        if(Session::get('mode_type') == $mode['id'])
                                        {
                                            echo Form::radio('mode_type',$mode['id'],Session::get('mode_type') != '' && Session::get('mode_type') == $mode['id'] ? true:false,['class'=>'form-control','id'=>'mode_type']);
                                        }
                                        ?>
                                    </div>
                                    <?php
                               /*     }*/
                                    ?>
                                    <div class="col-md-8">
                                        <?php 
                                        if(Session::get('mode_type') != '' && Session::get('mode_type') == $mode['id'])
                                        {
                                            echo $mode['title'].'('.$mode['description'].')'; 
                                        }
                                        ?>
                                    </div>

                                    <div class="clearfix"></div>
                                    @if ($errors->has('mode_type')) <p class="help-block">{{ $errors->first('mode_type') }}</p> @endif
                                    <?php
                                  }
                                  ?>
                                </div> 
                            </div>
                                <div class="form-group @if ($errors->has('package_description')) has-error @endif">
                            <div class="col-md-12">
                                   <!--  
                                    <textarea name="package_description" id="package_description" placeholder="About the packet"></textarea> -->
                                    {!! Form::textarea('package_description',null,['class'=>'form-control','placeholder'=>'About the packet','id'=>'package_description']) !!}
                                </div>
                                @if ($errors->has('package_description')) <p class="help-block">{{ $errors->first('package_description') }}</p> @endif
                            </div>
                                <div class="form-group @if ($errors->has('delivery_date')) has-error @endif">
                            <div class="col-md-12">
                                    <div class="col-md-4">
                                        Delivery Date
                                    </div>
                                    <div class="col-md-8">
                                   <!--      <input type="text" name="delivery_date" id="delivery_date">  -->
                                        {!! Form::text('delivery_date',null,['class'=>'form-control','placeholder'=>'2016-05-21','id'=>'delivery_date']) !!}
                                    </div>
                                    @if ($errors->has('delivery_date')) <p class="help-block">{{ $errors->first('delivery_date') }}</p> @endif
                                </div>
                            </div>
                                <div class="form-group @if ($errors->has('quotation_price')) has-error @endif">
                            <div class="col-md-12">
                                    <div class="col-md-4">
                                        Your Quotation Price
                                    </div>
                                    <div class="col-md-8">
                                       <!--  <input type="text" name="quotation_price" id="quotation_price"> -->
                                        {!! Form::text('quotation_price',null,['class'=>'form-control','placeholder'=>'Enter your price','id'=>'quotation_price']) !!}    
                                    </div>
                                    @if ($errors->has('quotation_price')) <p class="help-block">{{ $errors->first('quotation_price') }}</p> @endif
                                </div>
                            </div>
                                <div class="form-group @if ($errors->has('competingname')) has-error @endif">
                            <div class="col-md-12">
                                    <div class="col-md-4">
                                        Competing Service Name
                                    </div>
                                    <div class="col-md-8">
                                        <!-- <input type="text" name="competingname" id="competingname">     -->
                                    {!! Form::text('competingname',null,['class'=>'form-control','placeholder'=>'Enter competiting name','id'=>'competingname']) !!} 
                                    </div>
                                    
                                </div>
                                @if ($errors->has('competingname')) <p class="help-block">{{ $errors->first('competingname') }}</p> @endif
                            </div>
                                <div class="form-group @if ($errors->has('message')) has-error @endif">
                            <div class="col-md-12">
                                    <div class="col-md-4">
                                        Message
                                    </div>
                                    <div class="col-md-8">
                                      <!--   <textarea name="message" id="message" placeholder="Enter Message"></textarea> -->
                                        {!! Form::textarea('message',null,['class'=>'form-control','placeholder'=>'Enter message','id'=>'message']) !!} 
                                    </div>
                                    @if ($errors->has('message')) <p class="help-block">{{ $errors->first('message') }}</p> @endif
                                </div>
                            </div>    
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                   
                                    <input type="submit"  value="Quote Us" class="btn btn-primary">
                                </div>
                                
                            </div>    
                    {!! Form::close() !!}
                        </div>
                    </div>
                    </div>

@include('footer1')