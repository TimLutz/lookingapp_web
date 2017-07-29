{{-- */use repositories\CommonRepositoryInterface;/* --}}
{{-- */use repositories\CommonRepository;/* --}}

<?php 
    //$data = CommonRepository::getNotifications(); 
    $common = new CommonRepository();
    $modes =$common->getmodetype();
    
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
            

    <div class="row">
                    <div class="col-md-12">
                       <div class="signup">
                           <a href="{{ url('auth/register') }}" class="text"> REGISTER </a>
                         
                            <a href="{{ url('auth/login') }}" class="text"> LOGIN </a>
                       </div> 
                    </div>
                </div>
  
   <div class="clearfix"></div>
                <div> 
        <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                    
                    {!! Form::open(['url'=>'requestquote','method'=>'post']) !!}

                            <div class="form-group">
                                <div class="col-md-2">
                                    <label>
                                        Pick Up
                                    </label>

                                </div>
                                <div class="col-md-4 pickLocation form-group @if ($errors->has('pickup')) has-error @endif">
                                   
                                    {!! Form::text('pickup',null,['id'=>'pickup','class'=>'form-control']) !!}
                                    <input name="lat" type="hidden" value="">
                                    <input name="lng" type="hidden" value="">
                                    @if ($errors->has('pickup')) <p class="help-block">{{ $errors->first('pickup') }}</p> @endif
                                </div>
                                <div class="col-md-2">
                                    <label>
                                        Drop off
                                    </label>

                                </div>
                                <div class="col-md-4 dropLocation form-group @if ($errors->has('dropof')) has-error @endif">
                                   
                                    {!! Form::text('dropof',null,['id'=>'dropof','class'=>'form-control']) !!}
                                    <input name="drop_lat" type="hidden" class="droplat">
                                    <input name="drop_lng" type="hidden" class="droplng">

                                    @if ($errors->has('dropof')) <p class="help-block">{{ $errors->first('dropof') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('mode_typee')) has-error @endif">
                                <div class="col-md-2">
                                    <label>
                                        Mode Type
                                    </label>

                                </div>
                                <div class="col-md-10">
                                <?php
                                  foreach($modes AS $mode)
                                  {
                                    if($mode['status'] == '0')
                                    {
                                        ?>
                                            <div class="col-md-4">
                                           <!--  <input type="radio" name="mode_type" id="mode_typee" value="<?php echo $mode['id']; ?>" class="form-control" disabled> -->
                                            
                                             <?php
                                        echo Form::radio('mode_typee',$mode['id'],false,['class'=>'form-control','id'=>'mode_typee','disabled'=>'disabled']);
                                        ?>
                                        </div>
                                        <?php
                                    }
                                    else
                                    {
                                    ?>

                                    <div class="col-md-4">
                                     <!--    <input type="radio" name="mode_typee" id="mode_typee" value="<?php echo $mode['id']; ?>" class="form-control"> -->
                                     <?php
                                        echo Form::radio('mode_typee',$mode['id'],false,['class'=>'form-control','id'=>'mode_typee']);
                                        ?>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="col-md-8">
                                        <?php echo $mode['title'].'('.$mode['description'].')'; ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    
                                    <?php
                                    
                                  }
                                  ?>
                                </div>
                                @if ($errors->has('mode_typee')) <p class="help-block">{{ $errors->first('mode_typee') }}</p> @endif
                               
                                
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                   
                                    <input type="submit" name="quote" value="Quote me" class="btn btn-primary">
                                </div>
                                <div class="col-md-6">
                                    
                                    <input type="submit" name="booking" value="Booking" class="btn btn-primary">
                                </div>
                            </div>    
                    {!! Form::close() !!}
                        </div>
                    </div>
                    </div>

@include('footer1')