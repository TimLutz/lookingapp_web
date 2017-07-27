<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>MADWALL | 404 Page not found</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo e(asset('publib/admin/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo e(asset('publib/admin/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css" />
    
    <!-- Theme style -->

  </head>
  <body class="skin-blue">
  <center>
        <!-- Main content -->
        <section class="content" style="padding-top:100px">

          <div class="error-page">
            <h2 class="headline text-red">404</h2>
            <div class="error-content" style="padding-top:80px">
              <h3><i class="fa fa-warning text-red"></i> Oops! Page not found.</h3>
              <p>
                We could not find the page you were looking for.
                Meanwhile, you may return to <a href="<?php echo e(url('admin/dashboard')); ?>">dashboard</a> or try using the search form.
              </p>
              
            </div><!-- /.error-content -->
          </div><!-- /.error-page -->
        </section><!-- /.content -->
      </center>
	  </body>
