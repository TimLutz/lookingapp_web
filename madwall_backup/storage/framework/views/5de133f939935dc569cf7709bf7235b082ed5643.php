<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('APP_NAME', 'MADWALL | Login')); ?></title>

    <!-- Styles -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(asset( 'public/admin/css/font-awesome.min.css' )); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(asset( 'public/admin/css/simple-line-icons.min.css' )); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(asset( 'public/admin/css/bootstrap.min.css' )); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(asset( 'public/admin/css/uniform.default.css' )); ?>" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo e(asset( 'public/admin/css/login.css' )); ?>" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo e(asset( 'public/admin/css/components.css' )); ?>" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(asset('public/css/app.css')); ?>" rel="stylesheet">
<link rel="shortcut icon" href="<?php echo e(asset ('public/logos/favicon.ico')); ?> "/>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
    </script>
</head>
<body class="login">
    <div id="app">
 <!--        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
 -->
                    <!-- Collapsed Hamburger -->
                    <!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button> -->
                    <!-- Copy code here -->
                    
                    <!-- <a class="navbar-brand" href="<?php echo e(url('/')); ?>"> -->
                       <!-- <?php echo e(config('app.name', 'Laravel')); ?> -->
                   <!--  </a>
                </div> -->
<!--End copy code -->
                    <!-- Branding Image -->
                
            <!-- </div>
        </nav>
 -->
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <!-- Scripts -->

    <script src="<?php echo e(asset('public/js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('public/admin/js/jquery.uniform.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('public/admin/js/metronic.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('public/admin/js/jquery.cokie.min.js')); ?>" type="text/javascript"></script>

    <script>
    jQuery(document).ready(function() {
        Layout.init();
    });
</script>
</body>
</html>
