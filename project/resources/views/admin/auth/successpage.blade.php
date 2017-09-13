<!doctype html>
<html>
<head>
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet"> 
<title>{{ config('app.website_name') }}</title>

<style type="text/css">
	body{ padding:0; margin:0; font-family: 'Lato', sans-serif; font-size:20px; background:#000000; 
	box-sizing: border-box;
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;}
	 *{	box-sizing: border-box;
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;}
	
	.top-section{ width:100%; float:left; padding:50px 10px 10px;}
	.top-section h3{ width:100%; float:left; font-size: 35px; letter-spacing:3px; color: rgb(255, 255, 255); font-weight: bold;
  line-height: 50px; text-align: center; margin:10px 0 10px;}
  .top-section h5{ width:100%; float:left; font-size: 18px; letter-spacing:2px; margin:0 0 15px; color: rgb(255, 255, 255); font-weight: 400;
  line-height: 35px; text-align: center; }
  
  .bot-section{ width:100%; float:left; padding:35px 15px 0; text-align:center }
  .bot-section a{ width:280px; max-width:100%; border-radius:5px; background:#ee3a2f; color:#ffffff; font-size:18px; line-height:22px; text-align:center; padding:10px 10px; display:inline-block; text-transform:uppercase;  font-weight:bold; text-decoration:none;}

</style>

</head>


<body>

<div class="top-section">
	<h3>{{$heading}}</h3>
    <h5>{{$message}}</h5>
</div>
<?php
	if(isset($signIn))
	{
	?>
		<!-- <div class="bot-section">
			<a href="javascript:void(0)">Back to Sign in</a>
		</div> -->
	<?php
	}
?>

</body>
</html>
