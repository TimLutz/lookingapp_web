{{-- */use repositories\CommonRepositoryInterface;/* --}}
{{-- */use repositories\CommonRepository;/* --}}

<?php 
    //$data = CommonRepository::getNotifications(); 
    $common = new CommonRepository();
    $modes =$common->getmodetype();
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
                    {!! Form::open(['url'=>'quoteme','method'=>'post']) !!}
                            <input type="hidden" name="pickupdistance" value="<?php if(Session::get('pickupdistance') != ''){ echo Session::get('pickupdistance'); } ?>" id="pickupdistance">
                            <input type="hidden" name="dropofdistance" value="<?php if(Session::get('dropofdistance') != ''){ echo Session::get('dropofdistance'); } ?>" id="dropofdistance">
                            
                            <div class="form-group">
                                <div class="col-md-2">
                                    <label>
                                        Pick Up
                                    </label>
                                </div>
                                <div class="col-md-4 pickLocation form-group @if ($errors->has('pick_location')) has-error @endif">
                                    
                                    <?php 
                                     echo Form::text('pick_location',Session::get('pickup') != '' ? Session::get('pickup') : null,['class'=>'flow-control','id'=>'pick_location']);
                                     ?>

                                    <input name="lat" type="hidden" value="">
                                    <input name="lng" type="hidden" value="">
                                    @if ($errors->has('pick_location')) <p class="help-block">{{ $errors->first('pick_location') }}</p> @endif
                                </div>
                                <div class="col-md-2">
                                    <label>
                                        Drop off
                                    </label>

                                </div>
                                <div class="col-md-4 dropLocation form-group @if ($errors->has('drop_location')) has-error @endif">
                                    <?php
                                    echo Form::text('drop_location',Session::get('dropof') != '' ? Session::get('dropof') : null,['class'=>'flow-control','id'=>'drop_location']);
                                    ?>
                                    <input name="drop_lat" type="hidden" class="droplat">
                                    <input name="drop_lng" type="hidden" class="droplng">
                                    @if ($errors->has('drop_location')) <p class="help-block">{{ $errors->first('drop_location') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('mode_type')) has-error @endif">
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
                                            
                                            <?php
                                                 echo Form::radio('mode_type',$mode['id'],Session::get('mode_type') != '' && Session::get('mode_type') == $mode['id'] ? true:false,['class'=>'form-control','id'=>'mode_type','disabled'=>'disabled']);
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    else
                                    {
                                    ?>

                                    <div class="col-md-4">
                                        <?php
                                        echo Form::radio('mode_type',$mode['id'],Session::get('mode_type') != '' && Session::get('mode_type') == $mode['id'] ? true:false,['class'=>'form-control changemode','id'=>'mode_type']);
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
                                @if ($errors->has('mode_type')) <p class="help-block">{{ $errors->first('mode_type') }}</p> @endif
                            </div>
                            <div class="form-group @if ($errors->has('email')) has-error @endif">
                                <div class="col-md-2">
                                   <label>Email</label>
                                </div>
                                <div class="col-md-10">
                                    
                                    {!! Form::email('email',null,['class'=>'form-control','id'=>'email','placeholder'=>'Enter email']) !!}
                                    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('mobile')) has-error @endif">
                                <div class="col-md-2">
                                   <label>Phone</label>
                                </div>
                                <div class="col-md-10">
                                
                                    {!! Form::text('mobile',null,['class'=>'form-control','id'=>'mobile','placeholder'=>'Enter Mobile']) !!}
                                    @if ($errors->has('mobile')) <p class="help-block">{{ $errors->first('mobile') }}</p> @endif
                                </div>
                            </div> 
                            <div class="form-group">
                                <div class="col-md-6">
                                    <input type="submit" name="quote" value="Quote me" class="btn btn-primary">
                                </div>
                               
                            </div>    
                    {!! Form::close() !!}
                        </div>
                    </div>
                    </div>
@section('js')                    
<script type="text/javascript" src="{{ asset('js/frontcommon.js') }}"></script>
@endsection
@include('footer1')