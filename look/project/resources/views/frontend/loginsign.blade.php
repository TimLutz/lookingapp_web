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

                    @include('errors.user_error')
                            <div class="col-md-6">
                                <a href="{{ url('auth/login') }}" class="form-control btn btn-primary">Login</a>
                            </div>
                   
                            <div class="col-md-6">
                                <a href="{{ url('auth/register') }}" class="form-control btn btn-primary">Sign Up</a>
                            </div>
                        </div>
                    </div>
                    </div>

@include('footer1')