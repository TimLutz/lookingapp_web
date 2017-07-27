<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>MadWall</title>
<link href="<?php echo e(asset( 'public/webpages/css/animate.css' )); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(asset( 'public/webpages/css/bootstrap.css' )); ?>" rel="stylesheet" type="text/css"/>

<link href="<?php echo e(asset( 'public/webpages/css/font-awesome.min.css' )); ?>" rel="stylesheet" type="text/css"/>

<link href="<?php echo e(asset( 'public/webpages/css/owl.carousel.css' )); ?>" rel="stylesheet" type="text/css"/>

<link href="<?php echo e(asset( 'public/webpages/css/main.css' )); ?>" rel="stylesheet" type="text/css"/>



<script src="<?php echo e(asset( 'public/webpages/js/jquery-1.11.3.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset( 'public/webpages/js/owl.carousel.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset( 'public/webpages/js/bootstrap.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset( 'public/webpages/js/jquery.main.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset( 'public/webpages/js/wow.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset( 'public/webpages/js/jquery.malihu.PageScroll2id.js')); ?>" type="text/javascript"></script>


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
    <header class="header-main reset_password wow fadeIn ">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-3 colo-sm-3">
            <div class="logo"><a href="<?php echo e(url('/')); ?>">
            <?php echo e(Html::image('public/webpages/images/logo_dash.png', 'alt' )); ?>

            </a></div>
          </div>
          
          <div class="col-lg-9 col-md-9 colo-sm-9"> <a href="#" class="drop-opener pull-right"> <span></span> <span></span> <em class="border"></em> </a>
            <div class="menu_bar">
              <div class="navSection">
                <div class="nav-holder" id="menu-drop">
                  <ul>
                    <li><a href="#how-jobseeker">How to apply</a></li>
                    <li><a href="#how-hire">How to hire</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#contact">Contact us</a></li>
                    <li class="navbtn"><a href="#" data-toggle="modal" data-target="#myModal" >Sign up</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="inner_banner_sec">
          <div class="row">

            <h1><b><?php if(count($cmspage) > 0): ?>
              <?php echo e(ucwords( $cmspage[0]['name'] )); ?>

            <?php endif; ?></b></h1>
          </div>
        </div>
      </div>
    </header>
	<div class="main_sub_sec">
    <div class="container">
      <div class="white_inner_sec wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
            <div class="row">
              <div class="col-md-12">
              	<p>
                  
                  <?php if(count($cmspage) > 0): ?>
                    <?php echo e($cmspage[0]['content']); ?>

                  <?php endif; ?>


                  
              	</p>
              	
              </div>
            </div>
          </div>
          </div>
    </div>
  </div>
	<!-- END CONTENT -->
  <!-- footer section  -->
  <footer class="footer-main">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-4">
          <div class="footer-logo">
            <?php echo e(Html::image('public/webpages/images/logo.png', 'alt' )); ?>

             </div>
        </div>
        <div class="col-md-9 col-sm-8">
          <div class="footer-support-social">
            <ul>
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div>
          <div class="footer-nav">
            <ul>
                <?php if(count($cmspage) > 0): ?>
                    <li><a href="<?php echo e(url('/about-us')); ?>">About us</a></li>
                <?php endif; ?>
                <?php if(count($cmspage) > 0): ?>
                    <li><a href="<?php echo e(url('/terms-condtion')); ?>">Term &amp; condition</a></li>
                <?php endif; ?>
                <?php if(count($cmspage) > 0): ?>
                    <li><a href="<?php echo e(url('/privacy-policy')); ?>">Privacy Policy</a></li>
                <?php endif; ?>
            </ul>
          </div>
          <div class="footer-copyright"> Copyright reserved by <span>MadWall</span> </div>
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
            <div class="form_signup">
              <div class="row">
                <div class="col-md-6">
                  <div class="form_grp">
                    <input type="text" placeholder="Company Name">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form_grp">
                    <input type="text" placeholder="Email">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form_grp">
                    <input type="text" placeholder="Phone no">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form_grp">
                    <input type="text" placeholder="Email">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form_grp">
                    <input type="text" placeholder="Phone no">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form_grp">
                    <input type="password" placeholder="Password">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form_grp">
                    <input type="password" placeholder="Confirm Password">
                  </div>
                </div>
              </div>
            </div>
            <div class="form_signup">
              <div class="row">
                <div class="col-md-6">
                  <div class="form_grp">
                    <select class="customselect"  data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
                      <option>Type of Industry</option>
                      <option>Type of Industry</option>
                      <option>Type of Industry</option>
                      <option>Type of Industry</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form_grp">
                    <select class="customselect"  data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
                      <option>No. of Workers.</option>
                      <option>No. of Workers.</option>
                      <option>No. of Workers.</option>
                      <option>No. of Workers.</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form_grp">
                    <input type="text" placeholder="Contact Name">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form_grp">
                    <input type="text" placeholder="Contact No.">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form_grp">
                    <input type="text" placeholder="Location">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form_grp">
                    <input type="checkbox" id="signup_check" class="customCheckbox">
                    <label for="signup_check">I agree to the <a href="#">term & conditions</a> and <a href="#">privacy policy</a></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer signup_ftr">
            <button type="submit">Submit</button>
          </div>
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
          <div class="modal-body">
            <div class="form_signup">
              <div class="row">
                <div class="col-md-12">
                  <div class="form_grp">
                    <input type="text" placeholder="E-mail">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer signup_ftr ">
            <button type="submit">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- footer section end --> 
</div>
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
</body>
</html>
