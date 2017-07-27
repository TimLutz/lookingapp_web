<?php 
$code = '';
 ?>
<?php if(Auth::user()): ?>
    <?php $code = Auth::user()->email_verification_code; ?>
<?php endif; ?>


<!-- footer section  -->
<footer class="footer-main">
	<div class="container">
    	<div class="row">
        	<div class="col-md-3 col-sm-4">
            		<div class="footer-logo">
               	    <img src="<?php echo e(url('public/employer/images/logo.png')); ?>" alt=""/>
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
                	<!-- <li><a href="#">Contact us</a></li> -->
                  <li><a href="#" data-toggle="modal" data-target="#contact">Contact us</a></li>
                    <li><a href="<?php echo e(url('terms-condtion')); ?>" target="_blank">Terms &amp; Condition</a></li>
                    <li><a href="<?php echo e(url('privacy-policy')); ?>" target="_blank">Privacy Policy</a></li>
                </ul>
                </div>
                <div class="footer-copyright">
                Copyright reserved by <span>MadWall</span>
                </div>
            </div>
        </div>
    </div>


<!--forgot popup-->



<div class="modal fade signup forgot" id="waitlistuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal-body">
       <div class="form_signup">
       <div class="row">
       <div class="col-md-12">
       <div class="form_grp">
       <p><b>You have been not approved by admin yet.</b></p>
       </div>
       </div>
       </div>
       
       </div>
       
      </div>
      <div class="modal-footer signup_ftr ">
        <button type="button" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade signup forgot" id="verifyAccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal-body">
       <div class="form_signup">
       <div class="row">
       <div class="col-md-12">
       <div class="form_grp">
       <p><b>Please verify your Email first in order to Post A Job</b></p>
       </div>
       </div>
       </div>
       
       </div>
       
      </div>
      <div class="modal-footer signup_ftr ">
        <button type="button" id="verifyaccount">Verify Now</button>
        <br><br>
  <button type="button" class="cancel_btn close" data-dismiss="modal">Maybe later</button>
      </div>
    </div>
  </div>
</div>

</footer>
<!-- footer section end -->
<script src="<?php echo e(asset('public/employer/js/jquery-1.11.3.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/owl.carousel.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/bootstrap.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/jquery.main.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/wow.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/jquery.malihu.PageScroll2id.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/path.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/bootbox.min.js')); ?>" type="text/javascript"></script>  
<script src="<?php echo e(asset('public/employer/js/loader.js')); ?>" type="text/javascript"></script> 
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
    setTimeout(function() {
        $('.flashMessage').fadeOut('slow');
    }, 3000);
    setTimeout(function() {
        $('.alert-danger').fadeOut('slow');
    }, 3000);
</script>
<script type="text/javascript">
</script>    
<?php echo $__env->yieldContent('js'); ?>
<script src="<?php echo e(asset('public/admin/js/moment-timezone.js')); ?>"></script>
<script type="text/javascript">
$(document).on('click','.waitlistuser',function(){
    $('#waitlistuser').modal('show');
});
$(document).on('click','.verifyemail',function(){

    $('#verifyAccount').modal('show');
    
});


$(document).on('click','#verifyaccount',function(){
    Loader();
    var code = "<?php echo e($code); ?>"
    //window.location=path+'employer/logout/'+;
    $.ajax({
    url: path+'employer/verfiylink',
    type: 'post',
    dataType: 'json',
    data: '_token='+$('meta[name="csrf-token"]').attr('content'),
    beforeSend:function(){
    Loader();
    },
    success: function(data) {
    //console.log('sudccess');
    window.location.href=data.url;
    },
    error: function(error) { 
    },
    complete: function() { //RemoveLoader() 
    }
    });
})

var timezone = moment.tz.guess();
//alert(timezone);
document.cookie = "timezone="+timezone; 
$('#timezone').val(moment.tz.guess()); 

$(document).on('click','#logout',function(){
   

    bootbox.confirm({
                        message: 'Are you sure you want to logout?',
                        buttons: {
                            'cancel': {
                                label: 'No',
                            },
                            'confirm': {
                                label: 'Yes',
                            }
                        },
                        callback: function(result) {
                            if (result) {
                                Loader();
                                 window.location=path+'employer/logout';
                            }
                        }
                    });
});

function notification()
{

  $.ajax({
    url: path+'employer/all-notification',
    type: 'post',
    dataType: 'json',
    data: '_token='+$('meta[name="csrf-token"]').attr('content'),
    beforeSend:function(){
  //  Loader();
    },
    success: function(data) {
        $('.bell_div').html(data.content);
    },
    error: function(error) { 
    },
    complete: function() { //RemoveLoader() 
    }
    });
}


/*setInterval(function(){
  notification();
},1000);*/


/*$(this).on('click','.visit_nofity',function(){
  alert($(this).val());
});*/

$(document).on('click','.visit_nofity',function(){
  $.ajax({
    url: path+'employer/update-notification',
    type: 'post',
    dataType: 'json',
    data: '_token='+$('meta[name="csrf-token"]').attr('content')+'&notify='+$('.notify-'+$(this).attr('data-value')).val(),
    beforeSend:function(){
  //  Loader();
    },
    success: function(data) {
        
        window.location.reload();
    },
    error: function(error) { 
    },
    complete: function() { //RemoveLoader() 
    }
    });
});
</script>
<script  src="<?php echo e(asset('public/employer/js/timezone.js')); ?>" type="text/javascript"></script>
<script  src="<?php echo e(asset('public/employer/js/cookies.js')); ?>" type="text/javascript"></script>
<script type='text/javascript'>
var tz = jstz.determine(); // Determines the time zone of the browser client
var test =  tz.name(); 

setCookie("client_timezone",test,365);

</script>

<?php
if(Session::has('timezone')){
    Session::put('timezone',$_COOKIE['timezone']);
}

?>

</body>

</html>
