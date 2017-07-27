<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>MadWall | Home</title>
<link href="<?php echo e(asset('public/employer/css/animate.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('public/employer/css/bootstrap.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('public/employer/css/font-awesome.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('public/employer/css/owl.carousel.css')); ?>" rel="stylesheet">
<link  href="<?php echo e(asset('public/employer/css/developer.css')); ?>" rel="stylesheet">
<link  href="<?php echo e(asset('public/admin/css/chosen.css')); ?>" rel="stylesheet">
<link  href="<?php echo e(asset('public/employer/css/intlTelInput.css')); ?>" rel="stylesheet">
<!-- <link  href="<?php echo e(asset('public/employer/css/demo.css')); ?>" rel="stylesheet"> -->
<link  href="<?php echo e(asset('public/employer/css/main.css')); ?>" rel="stylesheet">
<script src="<?php echo e(asset('public/employer/js/jquery-1.11.3.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/bootstrap.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/owl.carousel.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/jquery.main.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/wow.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/jquery.malihu.PageScroll2id.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/intlTelInput.js')); ?>" type="text/javascript"></script>
<link rel="shortcut icon" href="<?php echo e(url('public/logos/favicon.ico')); ?>"/>
</head>

<body>
<div class="loader-section">

<div class="cssload-container">
	<div class="cssload-whirlpool"></div>
</div>
</div>

<div class="wrapper">

<div class="main">
<!-- Header section -->
<header class="header-main wow fadeIn " id="top_page_banner">
<div class="container">
<div class="row">
<div class="col-lg-3 col-md-3 colo-sm-3">
<div class="logo"><a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('public/employer/images/logo.png')); ?>" alt=""></a></div>
</div>
<div class="col-lg-9 col-md-9 colo-sm-9">
 <a href="javascript:void(0)" class="drop-opener pull-right">
									<span></span>
									<span></span>
									<em class="border"></em>
                                   
								</a>
<div class="menu_bar">
<div class="navSection">
            <div class="nav-holder" id="menu-drop">
<ul>
<li><a href="#how-jobseeker">How to apply</a></li>
<li><a href="#how-hire">How to hire</a></li>
<li><a href="#" data-toggle="modal" data-target="#contact">Contact us</a></li>
<?php if(Auth::user()): ?>
  
  <li class="navbtn">
  <ul>
    <li>
      <a href="<?php echo e(url('employer/dashboard')); ?>">Dashboard</a></li>  
    </li>
  </ul>
  <li class="navbtn"><a href="<?php echo e(url('employer/logout')); ?>">Logout</a></li>  
<?php else: ?>
  <li class="navbtn"><a href="#" data-toggle="modal" data-target="#myModal">Sign up</a></li>
<?php endif; ?>

</ul>
</div>
</div>

</div>
</div>
</div>
</div>
</header>
<header class="header-main header-scroll wow fadeIn ">
<div class="container">
<div class="row">
<div class="col-lg-3 col-md-3 colo-sm-3">
<div class="logo"><a href="#top_page_banner"><img src="<?php echo e(asset('public/employer/images/logo.png')); ?>" alt=""></a></div>
</div>
<div class="col-lg-9 col-md-9 colo-sm-9">
 <a href="#" class="drop-opener pull-right">
									<span></span>
									<span></span>
									<em class="border"></em>
                                   
								</a>
<div class="menu_bar">
<div class="navSection">
            <div class="nav-holder" id="menu-drop">
<ul>
<li><a href="#how-jobseeker">How to apply</a></li>
<li><a href="#how-hire">How to hire</a></li>
<li><a href="#" data-toggle="modal" data-target="#contact">Contact us</a></li>
<!-- <li class="navbtn"><a href="#" data-toggle="modal" data-target="#myModal" >Sign up</a></li> -->
<?php if(Auth::user()): ?>
  
  <li class="navbtn">
  <ul>
    <li>
      <a href="<?php echo e(url('employer/dashboard')); ?>">Dashboard</a></li>  
    </li>
  </ul>
  <li class="navbtn"><a href="<?php echo e(url('employer/logout')); ?>">Logout</a></li>  
<?php else: ?>
  <li class="navbtn"><a href="#" data-toggle="modal" data-target="#myModal">Sign up</a></li>
<?php endif; ?>
</ul>
</div>
</div>

</div>
</div>
</div>
</div>
</header>
<!-- Hero section -->
<div class="hero-section" >
<?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="container">
<div class="hero-section-text wow fadeInLeft">Neque Porro Quisquam<br>
<span>Wecst Qui Dolorem</span> Lipsum Quia Dolor</div>

<div class="hero-box-block-main wow slideInRight">
<div class="hero-box-block">
	<div class="hero-box-block-top">
    <div class="hero-box-block-text">Are You Looking<br>
For <span>a Job</span> ?</div>
		<a href="#" class="store-play-link"><i class="fa fa-android"></i>Available on the
<span>Play Store</span></a>
    </div>
<?php if(!Auth::user()): ?>  
	<div class="hero-box-block-bot">
    	<div class="hero-box-block-title">Log in </div>
        <?php echo e(Form::open(array('url' => 'employer/login','method'=>'POST','class'=>'employer_login_form','data-ajax'=>false))); ?>

        <div class="hero-box-block-form">
        	<div class="fieldset-form">
            <div class="fieldset-field field-icon">
            	
                <?php echo Form::text('email', Cookie::has('email') ? Cookie::get('email') : old('email'),['maxlength'=>'100','placeholder'=>'Email']); ?>

                <span class="field-icon-set">
                	<i class="fa fa-envelope"></i>
                </span>
                <span class="error_msgg" style="display:none;"></span>
                <div class="<?php if($errors->has('email')): ?> has-error <?php endif; ?>">   
                  <?php if($errors->has('email')): ?> <p class="text-danger"><?php echo e($errors->first('email')); ?></p> <?php endif; ?>
                </div>
            </div>
            <div class="fieldset-field field-icon">
            	
                <!-- <?php echo Form::password('password',['maxlength'=>'100','placeholder'=>'Password'],Cookie::has('password') ? Cookie::get('email') : ''); ?> -->
                <input type="password" name="password" maxlength=100 value="<?php echo Cookie::has('password') ? Cookie::get('password') : ''; ?>" placeholder="Password">
                
                <span class="field-icon-set">
                	<i class="fa fa-lock"></i>
                </span>
                <span class="error_msgg" style="display:none;"></span>
                <div class="<?php if($errors->has('password')): ?> has-error <?php endif; ?>">   
                  <?php if($errors->has('password')): ?> <p class="text-danger"><?php echo e($errors->first('password')); ?></p> <?php endif; ?>
                </div>
            </div>
            <div class="fieldset-field fieldlinklogin">
              <!-- <a data-toggle="modal" data-target="#">Forgot password?</a> -->
              <label class="fake-check" for="remember">
                    <!-- <input type="checkbox" checked="" id="agree"> -->
                    <input id="remember" name="remember" type="checkbox" class="customCheckbox" <?php if(Cookie::has('email') && Cookie::has('password')) echo "checked"; ?>>
                    <span><i class="icon-check-small"></i></span>
                <label for="remember">Remember Me</label>
                  </label>
              <a data-toggle="modal" data-target="#forgot" class="pull-right">Forgot password?</a>
              
            </div>
            <div class="fieldset-field">
              
                
                <?php echo Form::button('Login',array('class'=>'login-btn-home','type'=>'submit')); ?>

                
            </div>
            
            <div class="loginregiteruserlink">New User then <a href="#" data-toggle="modal" data-target="#myModal">Sign up</a> here

            </div>
            	
            </div>
        </div>
        <?php echo Form::close(); ?>

    </div>
<?php endif; ?>    
</div> 
</div>
</div>
<div class="hero-section-img">
    
</div>



</div>
<!-- Hero section  end-->
<div class="clearfix"></div>
<!-- second section -->
	<div class="container"  id="how-jobseeker">
    	<div class="row">
        	<div class="col-md-6">
            	<div class="mobile-slide-screen-main">
           	    <img src="<?php echo e(asset('public/employer/images/mob-slide1.png')); ?>"  alt="" class="mobile-slide-screen-1 wow fadeIn">
                <img src="<?php echo e(asset('public/employer/images/mob-slide2.png')); ?>"  alt="" class="mobile-slide-screen-2 wow fadeIn" data-wow-delay="0.8s" data-wow-duration="1s">
                <img src="<?php echo e(asset('public/employer/images/mob-slide3.png')); ?>"  alt="" class="mobile-slide-screen-3 wow fadeIn" data-wow-delay="1.5s" data-wow-duration="1s">
                </div>
            </div>
            <div class="col-md-6">
            	<div class="jobseeker-step-main">
                		<ul>
                        	<li class=" wow fadeInRight">
                            	<div class="jobseeker-step-count">1</div>
                            	<div class="jobseeker-step-title">Download &amp; <span>Register for free</span></div>
							<div class="jobseeker-step-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris a velit vehicula lorem ornare dignissim. Mauris vehicula ac magna ut dignissim. Aliquam in nunc nunc. </div>
                            </li>
                            <li class=" wow fadeInRight">
                            <div class="jobseeker-step-count">2</div>
                            	<div class="jobseeker-step-title">Search Job &amp; <span>Select Job</span></div>
							<div class="jobseeker-step-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris a velit vehicula lorem ornare dignissim. Mauris vehicula ac magna ut dignissim. Aliquam in nunc nunc. </div>
                            </li>
                            <li class=" wow fadeInRight">
                            <div class="jobseeker-step-count">3</div>
                            	<div class="jobseeker-step-title">Apply Job &amp; <span>Get Hired</span></div>
							<div class="jobseeker-step-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris a velit vehicula lorem ornare dignissim. Mauris vehicula ac magna ut dignissim. Aliquam in nunc nunc. </div>
                            </li>
                            
                        </ul>
                </div>
            </div>
        </div>
    </div>
<!-- second section  end-->
<div class="clearfix"></div>
<!-- third section -->
<div class="hire-step-section" id="how-hire">
	<div class="container">
    	<div class="row">
        <div class="section-title wow slideInUp">
        How It Work As <span>Employer</span>
        </div>
        <div class="clearfix"></div>
        <div class="row">
        	<div class="col-sm-4 wow fadeInUp">
           	  <div class="hire-step-inner">
                	<div class="hire-step-title">Register As Employer</div>
                    <div class="hire-step-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et tincidunt metus. Curabitur egestas risus sed arcu congue.</div>
                </div>
            </div>
            
            <div class="col-sm-4 wow fadeInUp">
            	<div class="hire-step-inner">
                	<div class="hire-step-title">Post a Job</div>
                    <div class="hire-step-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et tincidunt metus. Curabitur egestas risus sed arcu congue.</div>
                </div>
            </div>
            
            <div class="col-sm-4 wow fadeInUp">
            	<div class="hire-step-inner">
                	<div class="hire-step-title">Hire Workers</div>
                    <div class="hire-step-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et tincidunt metus. Curabitur egestas risus sed arcu congue.</div>
                </div>
            </div>
        </div>
        
        </div>
        <div class="clearfix"></div>
        
        <div class="hire-sction-slide wow slideInUp">
       	  <img src="<?php echo e(asset('public/employer/images/web-slide.png')); ?>"  alt=""/> </div>
        </div>
    
</div>
<div class="clearfix"></div>
<!-- fourth section -->
<div class="container">
<div class="clients-logo-section">
<div class="section-title wow slideInUp">
        Who Trust  on  <span>MadWall</span>
 </div>
 <div class="clearfix"></div>
 
 <div class="clients-logo-list-main wow fadeIn">
 		<div class="client-logo-list owl-carousel">
        	<div class="clients-logo-inner">
            	<img src="<?php echo e(asset('public/employer/images/client-logo3.jpg')); ?>" alt="">
            </div>
            <div class="clients-logo-inner">    
                <img src="<?php echo e(asset('public/employer/images/client-logo1.jpg')); ?>" alt="">
             </div>
             <div class="clients-logo-inner">   
                <img src="<?php echo e(asset('public/employer/images/client-logo5.jpg')); ?>" alt="">
            </div>
            <div class="clients-logo-inner">	    
                <img src="<?php echo e(asset('public/employer/images/client-logo4.jpg')); ?>" alt="">
            </div>
            <div class="clients-logo-inner">
                <img src="<?php echo e(asset('public/employer/images/client-logo2.jpg')); ?>" alt="">
            </div>
        </div>
 </div>
 
 </div>
</div>
<!-- fourth section end -->
</div>
<div class="clearfix"></div>


<!-- footer section  -->
<footer class="footer-main">
	<div class="container">
    	<div class="row">
        	<div class="col-md-3 col-sm-4">
            		<div class="footer-logo">
               	    <img src="<?php echo e(asset('public/employer/images/logo.png')); ?>" alt=""/>
                    </div>
            </div>
            <div class="col-md-9 col-sm-8">
            	<div class="footer-support-social">
                	<ul>
                    	<li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
                <div class="footer-nav">
                <ul>
                	<!-- <li><a href="#">Contact us</a></li> -->
                  <li><a href="#" data-toggle="modal" data-target="#contact">Contact us</a></li>
                    <li><a href="<?php echo e(url('/about-us')); ?>">About us</a></li>
                    <li><a href="<?php echo e(url('/terms-condtion')); ?>">Terms &amp; Conditions</a></li>
                    <li><a href="<?php echo e(url('/privacy-policy')); ?>">Privacy Policy</a></li>
                </ul>
                </div>
                <div class="footer-copyright">
                Copyright reserved by <span>MadWall</span>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade signup" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Sign up</h4>
      </div>
      <div class="modal-body">
      <div id="msg"></div>
      <?php echo Form::open(['url'=>'auth/employe/register','id'=>'register']);; ?>

       <div class="form_signup">
       <div class="row">
       <div class="col-md-6">
       <div class="form_grp">
       <?php echo Form::text('company_name',null,['placeholder' => 'Company Name']); ?>

       <span class="error_msgg" style="display:none;"></span>
       <div class="<?php if($errors->has('company_name')): ?> has-error <?php endif; ?>">   
          <?php if($errors->has('company_name')): ?> <p class="text-danger"><?php echo e($errors->first('company_name')); ?></p> <?php endif; ?>
        </div>
       </div>
       </div>
       </div>
      <!-- <div class="row">
       <div class="col-md-6">
       <div class="form_grp">
       <?php echo Form::text('first_name',null,['placeholder' => 'First Name']); ?>

       <span class="error_msgg" style="display:none;"></span>
       </div>
       </div>
       <div class="col-md-6">
       <div class="form_grp">
       <?php echo Form::text('last_name',null,['placeholder' => 'Last Name']); ?>

       <span class="error_msgg" style="display:none;"></span>
       </div>
       </div>
       </div>-->
       <div class="row">
       <div class="col-md-6">
       <div class="form_grp">
       <?php echo Form::text('email',null,['placeholder' => 'Email']); ?>

       <span class="error_msgg" style="display:none;"></span>
       <div class="<?php if($errors->has('email')): ?> has-error <?php endif; ?>">   
          <?php if($errors->has('email')): ?> <p class="text-danger"><?php echo e($errors->first('email')); ?></p> <?php endif; ?>
        </div>
       </div>
       </div>
       <div class="col-md-6 phonenumber">
         <div class="country_codes">
           <div class="form_grp number_add">
             <?php echo Form::text('country_code',null,['placeholder' => 'Country Code','id'=>'phone','onkeydown'=>'return false']); ?>

             <!-- <span class="error_msgg" style="display:none;"></span> -->
            </div> 

           <div class="form_grp number_cus">
             <?php echo Form::text('phone',null,['placeholder' => 'Company Phone Number','id'=>'phone_number']); ?>


            </div>
            </div>
            <span class="error_msgg" style="display:none;"></span>
            <div class="<?php if($errors->has('phone')): ?> has-error <?php endif; ?>">   
              <?php if($errors->has('phone')): ?> <p class="text-danger"><?php echo e($errors->first('phone')); ?></p> <?php endif; ?>
            </div>
       </div>
       </div>
       
       <div class="row">
       <div class="col-md-6">
       <div class="form_grp">
       <?php echo Form::password('password',['placeholder' => 'Password']); ?>

       <span class="error_msgg" style="display:none;"></span>
       <div class="<?php if($errors->has('password')): ?> has-error <?php endif; ?>">   
          <?php if($errors->has('password')): ?> <p class="text-danger"><?php echo e($errors->first('password')); ?></p> <?php endif; ?>
        </div>
       </div>
       </div>
       <div class="col-md-6">
       <div class="form_grp">
       <?php echo Form::password('password_confirmation',['placeholder' => 'Confirm Password']); ?>

       <span class="error_msgg" style="display:none;"></span>
       <div class="<?php if($errors->has('password_confirmation')): ?> has-error <?php endif; ?>">   
          <?php if($errors->has('password_confirmation')): ?> <p class="text-danger"><?php echo e($errors->first('password_confirmation')); ?></p> <?php endif; ?>
        </div>
       </div>
       </div>
       </div>
       </div>
       <div class="form_signup">
       <div class="row">
       <div class="col-md-6  industry">
       <div class="form_grp industrytype">

       <?php echo Form::select('industry_type[]',$industry,null,['class'=>'chosen-select','multiple'=>'multiple','id'=>'multiselect','style'=>'width:350px;','data-placeholder'=>"Type of Industry"]); ?>

       <span class="error_msgg" style="display:none;"></span>
       <div class="<?php if($errors->has('industry_type')): ?> has-error <?php endif; ?>">   
        <?php if($errors->has('industry_type')): ?> <p class="text-danger"><?php echo e($errors->first('industry_type')); ?></p> <?php endif; ?>
      </div>
       </div>
       <!-- <span class="cat_error" style="display:none;"></span> -->
       </div>
       <div class="col-md-6">
       <div class="form_grp">
      <?php echo Form::text('number_worker',null,['id'=>'number_worker','placeholder'=>'Number of workers']); ?>

       <span class="error_msgg" style="display:none;"></span>
       <div class="<?php if($errors->has('number_worker')): ?> has-error <?php endif; ?>">   
          <?php if($errors->has('number_worker')): ?> <p class="text-danger"><?php echo e($errors->first('number_worker')); ?></p> <?php endif; ?>
        </div>
       </div>
       </div>
       </div>
       <div class="row">
       <!-- <div class="col-md-6">
       <div class="form_grp">
       <?php echo Form::text('contact_name',null,['id'=>'contact_name','placeholder'=>'Contact name']); ?>

       <span class="error_msgg" style="display:none;"></span>
       </div>
       </div> -->
       <div class="col-md-6">
       <div class="form_grp">
       <?php echo Form::text('first_name',null,['placeholder' => 'Contact First Name']); ?>

       <span class="error_msgg" style="display:none;"></span>
       <div class="<?php if($errors->has('first_name')): ?> has-error <?php endif; ?>">   
          <?php if($errors->has('first_name')): ?> <p class="text-danger"><?php echo e($errors->first('first_name')); ?></p> <?php endif; ?>
        </div>
       </div>
       </div>
       <div class="col-md-6">
       <div class="form_grp">
       <?php echo Form::text('last_name',null,['placeholder' => 'Contact Last Name']); ?>

       <span class="error_msgg" style="display:none;"></span>
       <div class="<?php if($errors->has('last_name')): ?> has-error <?php endif; ?>">   
          <?php if($errors->has('last_name')): ?> <p class="text-danger"><?php echo e($errors->first('last_name')); ?></p> <?php endif; ?>
        </div>
       </div>
       </div>
       
       </div>
       <div class="row">
       <div class="col-md-6 companycontact">
          <div class="country_codes">
           <div class="form_grp number_add">
             <?php echo Form::text('company_code',null,['placeholder' => 'Contry code','id'=>'company_code','onkeydown'=>'return false']); ?>

             <!-- <span class="error_msgg" style="display:none;"></span> -->
            </div>
        
 
           <div class="form_grp number_cus">
             <?php echo Form::text('company_contact',null,['placeholder' => 'Contact number','id'=>'contact_number']); ?>

          
         </div>
         </div>
          <span class="error_msgg" style="display:none;"></span>
          <div class="<?php if($errors->has('company_contact')): ?> has-error <?php endif; ?>">   
            <?php if($errors->has('company_contact')): ?> <p class="text-danger"><?php echo e($errors->first('company_contact')); ?></p> <?php endif; ?>
          </div>
       </div>
       <div class="col-md-6">
       <div class="form_grp pickLocation">
       <?php echo Form::text('company_address',null,['id'=>'location','placeholder'=>'Location']); ?>

       <?php echo Form::hidden('lat',null,['id'=>'lat']); ?>

       <?php echo Form::hidden('lng',null,['id'=>'lng']); ?>

       <?php echo Form::hidden('key',null,['id'=>'key']); ?>

       <?php echo Form::hidden('register_key',Session::has('session_key')?Session::get('session_key'):0,['id'=>'key']); ?>

       <span class="error_msgg" style="display:none;"></span>
       <div class="<?php if($errors->has('company_address')): ?> has-error <?php endif; ?>">   
          <?php if($errors->has('company_address')): ?> <p class="text-danger"><?php echo e($errors->first('company_address')); ?></p> <?php endif; ?>
        </div>
       </div>
       </div>
       
       </div>
       <div class="row">
       <div class="col-md-6">
          <div class="form_grp description">
          <?php echo Form::textarea('company_description',null,['placeholder'=>'Enter Description']); ?>

          <span class="error_msgg" style="display:none;"></span>
          <div class="<?php if($errors->has('email')): ?> has-error <?php endif; ?>">   
              <?php if($errors->has('company_description')): ?> <p class="text-danger"><?php echo e($errors->first('company_description')); ?></p> <?php endif; ?>
            </div>
          </div>
       </div>
        <div class="col-md-6 form-field">
           <div class="form_grp">
              <div class="img_browse_btn">
                  Company logo
                  <?php echo Form::file('user_image',array('id'=>'user_image','placeholder'=>'Logo')); ?>

                  <?php echo Form::hidden('image',null,array('id'=>'image')); ?>

              </div>
              
              <span class="error_msgg" style="display:none;"></span>
              <div class="<?php if($errors->has('image')): ?> has-error <?php endif; ?>">   
                <?php if($errors->has('image')): ?> <p class="text-danger"><?php echo e($errors->first('image')); ?></p> <?php endif; ?>
              </div>
           </div>
       </div>
       </div>
       <div class="row">
       <div class="col-md-12">
       <div class="form_grp agree">
       <?php echo Form::checkbox('agree',true,false,['class'=>'customCheckbox','id'=>'signup_check']); ?> <label for="signup_check">I agree to the <a href="<?php echo e(url('terms-condtion')); ?>" target="_blank">Terms & Conditions</a> and <a href="<?php echo e(url('privacy-policy')); ?>" target="_blank">Privacy Policy</a></label>
       <span class="error_msgg" style="display:none;"></span>
       <div class="<?php if($errors->has('agree')): ?> has-error <?php endif; ?>">   
          <?php if($errors->has('agree')): ?> <p class="text-danger"><?php echo e($errors->first('agree')); ?></p> <?php endif; ?>
        </div>
       </div>
       </div>
       
       </div>
       </div>
      
      </div>
      <div class="modal-footer signup_ftr">
        <button type="button" id="registrationEmployer">Submit</button>
      </div>
       
      <?php echo Form::close();; ?> 
    </div>
  </div>
</div>

<!--forgot popup-->
<div class="modal fade signup forgot" id="forgot" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Forgot Password</h4>
      </div>
    <?php echo Form::open(['id'=>'forgotpassword','url'=>'employer/forgotpassword']); ?>  
      <div class="modal-body">
       <div class="form_signup">
       <div class="row">
       <div class="col-md-12">
       <div class="form_grp">
       <!-- <input type="text" placeholder="E-mail"> -->
       <?php echo Form::text('email',null,['placeholder'=>'E-mail']); ?>

       <span class="error_msgg" style="display:none;"></span>
       </div>
       </div>
       </div>
       
       </div>
       
      </div>
      <div class="modal-footer signup_ftr ">
        <button type="submit">Submit</button>
    <?php echo Form::close(); ?>

      </div>
    
    </div>
  </div>
</div>

<?php echo $__env->make('models.contactus', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</footer>
<!-- footer section end -->
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBc0Ucux0_UPErLjpzmwKqvnaD7yot5J08&amp;libraries=places">
    </script>

<script src="<?php echo e(asset('public/employer/js/jquery.geocomplete.js')); ?>" type="text/javascript"></script>    
<script src="<?php echo e(asset('public/employer/js/jquery.validate.min.js')); ?>" type="text/javascript"></script>    
<script src="<?php echo e(asset('public/admin/js/chosen.js')); ?>" type="text/javascript"></script>    
<script src="<?php echo e(asset('public/employer/js/loader.js')); ?>" type="text/javascript"></script>    
<script src="<?php echo e(asset('public/employer/js/bootbox.min.js')); ?>" type="text/javascript"></script>    
<script src="<?php echo e(asset('public/employer/js/jquery.maskedinput.js')); ?>" type="text/javascript"></script>    
<script src="<?php echo e(asset('public/employer/js/contactus.js')); ?>" type="text/javascript"></script>    
<script src="https://www.gstatic.com/firebasejs/4.1.1/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.1.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.1.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.1.1/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.1.1/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.1.1/firebase-storage.js"></script>

<script>
    var config = {
        apiKey: "AIzaSyAzQDQ4EldRySSHdDixmUhL9trZzec4ZfI",
        authDomain: "madwalll-a5b4f.firebaseapp.com",
        databaseURL: "https://madwalll-a5b4f.firebaseio.com",
        projectId: "madwalll-a5b4f",
        storageBucket: "madwalll-a5b4f.appspot.com",
        messagingSenderId: "277872430975"
    };
    var defaultApp = firebase.initializeApp(config);

</script>
<script type="text/javascript">
  
  $(function(){
        $("#location").geocomplete({
          details: ".pickLocation",
          types: ["geocode", "establishment"],
        }).bind("geocode:result", function(event, result){
            var coor = result.geometry.location.lat();
            $('#key').val(1);
            //$('#pickup-location').val(coor); 
            $('.pickLocation').find('span.error_msgg').hide();  
          }).bind("blur", function(event, results){
            setTimeout(function(){
              if($('#key').val() == '')
              {
                $('.pickLocation').find('span.error_msgg').slideDown(400).html('Please specify a valid location.');
                $('#lat').val('');
                $('#lng').val('');
              }
              $('#key').val('');
            },1000);
            
          }) 
        ;
      });
</script>
<script type="text/javascript">

   wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100,
        callback:     function(box) {
          console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
      }
    );
    wow.init();

    
</script>

<script type="text/javascript">
jQuery("form.employer_login_form").validate({
    rules: {
      "email":{
         required:true 
      },
      "password":{
         required:true 
      },
    },
    messages: {
        "email":{
          required:"Please enter your registered Email."
        },
        "password":{
          required:"Please enter your Password."
        },
    },
    errorElement:'span',
    errorClass:'error_msg errormsges',
    submitHandler: function(form) {
      Loader();
      $('form.employer_login_form').submit();
    /*$.ajax({
            url: $('form.employer_login_form').attr('action'),
            type: 'post',
            dataType: 'json',
            data: $('form.employer_login_form').serialize(),
            beforeSend:function(){
                Loader();
            },
            success: function(data) {
              if(data.status==1)
              {
                window.location.href=data.message;
              }
            },
            error: function(error) { 
              RemoveLoader();
              $('span.error_msg').hide();
              $('span.error_msgg').hide();
              var result_errors = error.responseJSON;
              if(result_errors)
              {
                 $.each(result_errors, function(i,obj)
                 {
                    $('input[name='+i+']').parent('.field-icon').find('span.error_msgg').slideDown(400).html(obj);
                 }) 
              }

            },
            complete: function() { //RemoveLoader() 
              }
          });*/
    }
});
$(document).on('click','#registrationEmployer',function(){
    if($('select[name="industry_type[]"]').val()==null)
    {
      
     /* $('.cat_error').slideDown(400).html('Please specify the job category of the job.');
    $('.cat_error').show();*/
      $('.industrytype').find('span.error_msgg').slideDown(400).html("Please select at least one value in type of industry field.");
      $('.industrytype').find('span.error_msgg').show();
    }
    else
    {
      $('.industrytype').find('span.error_msgg').hide();
    }
    if($('#location').val())
    {
      if($('#lat').val() == '' || $('#lng').val() == '')
        $('.pickLocation').find('span.error_msgg').slideDown(400).html('Please specify a valid location.'); 
    }

    
    if($('#phone_number').val() == '' && $('#contact_number').val() == '')
    {
      $('.phonenumber').find('span.error_msgg').slideDown(400).html('Please enter at least one Contact Number.');
       $('.companycontact').find('span.error_msgg').slideDown(400).html('Please enter contact number.'); 
    }
    else
    {
     $('.phonenumber').find('span.error_msgg').hide();
       $('.companycontact').find('span.error_msgg').hide();  
    }

    $('#register').submit();
});
  jQuery("#register").validate({
    
        // Specify the validation rules
        rules: {
            "company_name": {
              required:true,
            },
            "first_name": {
              required:true,
            },
            "last_name": {
              required:true,
            },
            "email": {
              required:true,
            },/*
            "phone": {
              required:true,
            },*/
            "country_code": {
              required:true,
            },
            "company_code": {
              required:true,
            },
            "password": {
              required:true,
            },
            "password_confirmation": {
              required:true,
            },/*
            "industry_type": {
              required:true,
            },*/
            "company_address": {
              required:true,
            },/*
            "company_contact": {
              required:true,
            },*/
            "number_worker": {
              required:true,
            },
            "user_image": {
              required:true,
            },
            "company_description":{
              required:true,
            },
            "agree":{
              required:true,
            }

    },
        
        // Specify the validation error messages
        messages: {
           "company_name": {
                required: "Please enter Company Name",
            },
            "first_name": {
                required: "Please enter Contact First Name",
            },
            "last_name": {
                required: "Please enter Contact Last Name ",
            },
            "email": {
                required: "Please enter your email ",
            },/*
            "phone": {
                required: "Please enter at least one Contact Number ",
            },*/
            "password": {
                required: "Please enter password ",
            },
            "password_confirmation": {
                required: "Please enter confirm password ",
            },/*
            "industry_type": {
                required: "Please enter Industry field",
            },*/
            "company_address": {
                required: "Please enter location ",
            },/*
            "company_contact": {
                required: "Please enter contact number ",
            },*/
            "number_worker": {
                required: "Please select at least one value in number of workers’ field. ",
            },
            "user_image":{
              required: "Please select images.",
            },
            "company_description":{
              required:"Please enter company description",
            },
            "country_code":{
              required:"Please enter country code",
            },
            "company_code":{
              required:"Please enter country code",
            },
            "agree":{
              required:"Please agree to the T&C and Privacy Policy.",
            }
        },
        errorElement:'span',
        errorClass:'error_msg',
        errorPlacement: function(error, element) {
           // alert(element.attr("name"));
            $(element).parent('.form_grp').find('span.error_msgg').slideDown(400).html(error);
            if(element.attr("name") == "user_image"){
              $(element).closest('.form_grp').parent('.form-field').find('span.error_msgg').slideDown(400).html(error);
            }

            /*if(element.attr("name") == "phone"){
                $(element).closest('.country_codes').parent('.phonenumber').find('span.error_msgg').slideDown(400).html(error);
            }

            if(element.attr("name") == "company_contact"){
                $(element).closest('.country_codes').parent('.companycontact').find('span.error_msgg').slideDown(400).html(error);
            }*/

            if(element.attr("name") == "agree"){
                $(element).closest('span').parent('.agree').find('span.error_msgg').slideDown(400).html(error);
            }

            
        },

        submitHandler: function(form,e) {

          /*$('form#register').submit();*/
          var form_data = new FormData($('form#register')[0]);

          $.ajax({
            url: $('form#register').attr('action'),
            type: 'post',
            dataType: 'json',
            data: form_data,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend:function(){
                Loader();
                $('#registration').prop( "disabled", true );
            },
            success: function(data) {
              if(data.status==1)
              {
                //$('#msg').html('<div class="alert alert-success"><strong><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+data.message+'</strong>.</div>');
                //setTimeout(function(){
                  $('#myModal').hide();
                  $('form#register')[0].reset();
                  window.location.reload();
                //},1000);

              }
              if(data.status==0)
              {
                $('#registration').prop( "disabled", false );
                $('#msg').html('<div class="alert alert-danger"><strong><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+data.errors+'</strong>.</div>');
              }
            },
            error: function(error) { 

              $('span.error_msg').hide();
              $('span.error_msgg').hide();
              $('#registration').prop( "disabled", false );
              var result_errors = error.responseJSON;
              if(result_errors)
              {
                 $.each(result_errors, function(i,obj)
                 {
                    $('input[name='+i+']').parent('.form_grp').find('span.error_msgg').slideDown(400).html(obj);
                    if(i == 'industry_type')
                      $('.industrytype').find('span.error_msgg').slideDown(400).html(obj);

                    if(i == 'agree')
                      $('.agree').find('span.error_msgg').slideDown(400).html(obj);  

                    if(i=='company_description')
                      $('.description').find('span.error_msgg').slideDown(400).html(obj);

                      if(i == "phone")
                         $('.phonenumber').find('span.error_msgg').slideDown(400).html(obj);
                      

                      if(i == "company_contact")
                        $('.companycontact').find('span.error_msgg').slideDown(400).html(obj);
                          
                      if(i == 'token_mismatch')
                        window.location.reload();

                 }) 
              }

            },


            complete: function() { RemoveLoader() }
          }); 
        }
    });

/*$(document).on('click','#user_image',function(){
//  Loader();

     var cv_url = $(this)[0].files;

            if(cv_url[0]) {
               
                var type=cv_url[0].type; //gettinfile type
                var blob_image=new Blob(cv_url, { "type" : type }); //getting a blob object of file
                
                $('label.sub_error').html('');

                var timestamp=Date.now();

                var storageRef = firebase.storage().ref('certificate/'+timestamp+'_'+cv_url[0].name); //creating firebase image reference
            
                var metadata = {
                    contentType: cv_url[0].type,
                }; //createing metadata fro file

                storageRef.put(blob_image).then(function(snapshot) { //if stored successfully
                    $('#image').val(snapshot.downloadURL);
                    alert('vmnbm');
                //    RemoveLoader();
                   // alert( snapshot.downloadURL );
                }).catch(function(error) { //if error occured
                    console.log('firebase error occured:'+error);
                   // RemoveLoader();
                });
            } 

});*/

$(document).on('change','#user_image',function(e){

        var fileExtension = ['pdf','png','jpg'];
        var file = $(this)[0].files;
        var type = file[0].type;
       
        // Check File Size
        if( file[0].size >5242880 ) {
            bootbox.alert("Please upload a valid certificate within a max range of 5 MB");
        //   alert("Please upload a valid certificate within a max range of 5 MB");
            return false;
        }

        // Check File Type
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            bootbox.alert("Only "+fileExtension.join(', ')+ " format is allowed ");
          //alert("Only "+fileExtension.join(', ')+ " format is allowed ");
            return false;
        }
        Loader();
        $(this).closest('.certificate').find('.certificate_name').val(file[0].name);
        firebase_multiple_upload( file, type, $(this) );
    });
    function firebase_multiple_upload( file,type ,reference ){

        var timestamp=Date.now();
        var storageRef = firebase.storage().ref('certificate/'+timestamp+'_'+file[0].name); //creating firebase image reference
        var metadata = {
            contentType: type,
        };
        
        var blob_image=new Blob(file, { "type" : type });
        storageRef.put(blob_image).then(function(snapshot) {
           // reference.closest('.certificate').find('.firebase_url').val(snapshot.downloadURL);
           $('#image').val(snapshot.downloadURL);
            //certificate.push(snapshot.downloadURL);
            //certificate['url'] = snapshot.downloadURL;
            removeLoader()
        }).catch(function(error) {
            console.log('firebase error occured:'+error);
            RemoveLoader();
        });
    }


    jQuery("form#forgotpassword").validate({
    rules: {
      "email":{
         required:true 
      }
    },
    messages: {
        "email":{
          required:"Please enter your registered Email."
        }
    },
    errorElement:'span',
    errorClass:'error_msg errormsges',
    submitHandler: function(form) {
      
      Loader();
    $.ajax({
            url: $('form#forgotpassword').attr('action'),
            type: 'post',
            dataType: 'json',
            data: $('form#forgotpassword').serialize(),
            beforeSend:function(){
                Loader();
            },
            success: function(data) {
              $('form#forgotpassword')[0].reset();
              $('#forgot').modal('hide');
              window.location.reload();
            },
            error: function(error) { 
              RemoveLoader();
              $('span.error_msg').hide();
              $('span.error_msgg').hide();
              var result_errors = error.responseJSON;
              if(result_errors)
              {
                 $.each(result_errors, function(i,obj)
                 {
                    $('input[name='+i+']').parent('.form_grp').find('span.error_msgg').slideDown(400).html(obj);

                    if(i == 'token_mismatch')
                        window.location.reload();
                 }) 
              }

            },
            complete: function() { //alert('b nn'); 
            }
          });
    }
});
</script>
<script type="text/javascript">
   $(".chosen-select").chosen({
        placeholder_text_single: "option",
        no_results_text: "Oops, nothing found!"
      });
   $(document).ready(function(){
      $('#multiselect_chosen').removeAttr('style');
   });

   $("#phone").intlTelInput({
      // allowDropdown: false,
       autoHideDialCode: false,
     // autoPlaceholder: "off",
      // dropdownContainer: "body",
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // initialCountry: "auto",
       nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
      // separateDialCode: true,
      utilsScript: "public/employer/js/utils.js"
    });

    $("#company_code").intlTelInput({
       autoHideDialCode: false,
       nationalMode: false,
      utilsScript: "public/employer/js/utils.js"
    });


    $("#contact_number").mask("(999)-999-9999");
    $("#phone_number").mask("(999)-999-9999");
$('.default').removeAttr( 'style' );
  //  $('#location').keypress(function(e) {
     // alert(e.which);
  /*if (e.which == 8) {
      $('#lat').val('');
      $('#lng').val('');
  }*/
//});
   
</script>
</body>
</html>
