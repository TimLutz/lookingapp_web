<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="{{asset('public/employer/css/style.css')}}" type="text/css" rel="stylesheet" />
<link href="{{asset('public/employer/css/bootstrap.css')}}" type="text/css" rel="stylesheet"/>
<script src="{{asset('public/employer/js/bootstrap.js')}}" type="text/javascript"></script>
</head>

<body>
<div class="main">
<div class="top_bar">
<h1><img class="img-responsive" src="{{ asset('public/logos/logo-mail.png') }}" width="120" /></h1>
</div>
<div class="clear"></div>
<div class="container">
<div class="field_box_center">
@if($status==1)
<div class="success_pswrd">Email verified successfully.</div>
@elseif($status==2)
<div class="did_not_pswrd">Something went wrong.</div>
@else
<div class="did_not_pswrd">Your link has been expired.</div>
@endif
	
</div>
</div>
</div>
</body>
</html>
