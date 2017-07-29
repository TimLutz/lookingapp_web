<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>{{ config('app.website_name') }} | 404 Page not found</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Theme style -->
    <link href="{{ asset('assets/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />

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
                Meanwhile, you may return to <a href="{{ url('/') }}">dashboard</a> or try using the search form.
              </p>
              
            </div><!-- /.error-content -->
          </div><!-- /.error-page -->
        </section><!-- /.content -->
      </center>
	  </body>
