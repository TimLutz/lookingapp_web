<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('public/employer/css/developer.css')); ?>">
<link  href="<?php echo e(asset('public/employer/css/main.css')); ?>" rel="stylesheet">
<style>
#submit-button {
    background: #079835 none repeat scroll 0 0;
    border: medium none;
    border-radius: 5px;
    color: #fff;
    float: left;
    font-size: 16px;
    font-weight: 500;
    margin-left: 20px;
    padding: 10px 30px;
    text-align: center;
}
</style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('title'); ?>
	Change Password
<?php $__env->stopSection(); ?>

<?php $__env->startSection('heading'); ?>
	Change Password 
<?php $__env->stopSection(); ?>
	
<?php $__env->startSection('content'); ?>
<div class="white_inner_sec wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
    <div class="job_detail_sec">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
         <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="company_profile">
                <div class="company_img"><img src="<?php echo e($user['image']); ?>">
                    <div class="edit_pic"><i class="fa fa-pencil" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <a href="#editform" data-toggle="modal" data-target="#editform">Sign up</a>
        <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12">
         
            <div class="job_detail_left_sec">
                <h2><?php echo e($user['company_name']); ?></h2>
                <span class="job_time"><?php echo e($user['email']); ?></span>
                <p><?php if(isset( $user['company_description'] ) ): ?><?php echo e($user['company_description']); ?><?php endif; ?></p>
                <div class="job_time_loc">
                    <div class="location_sec"><span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                        <div class="text_job"><b><?php echo e($user['location']); ?></b></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="location_sec"><span><i class="fa fa-mobile" aria-hidden="true"></i></span>
                        <div class="text_job"><b><?php echo e($user['company_code']); ?>_<?php echo e($user['company_contact']); ?></b></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="location_sec">
                        <div class="text_job">Number of persons: <b><?php echo e($user['number_worker']); ?></b></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="location_sec">
                        <div class="text_job">Industries - </div>
                        <?php $__currentLoopData = $user['industry']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $industry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="jobtag"><?php echo e($industry['name']); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="flash-message">
           
        </div>
    </div>

    <div class="job_detail_table">
        <!-- <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <div class="number_list">Showing 1 - 6 of 50 jobs</div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="jobdetailsearch">
                    <div class="search_input">
                        <input placeholder="Search by Job name" type="text"><span><i class="fa fa-search" aria-hidden="true"></i></span></div>
                </div>
            </div>
        </div> -->

        <div class="table_job_detail">
            <div class="table_dashboard">
                <div class="company_info_table">
                    <div class="heading_row headingoftb">
                        <div class="width33company_info brdr_btm">Industry</div>
                        <div class="width33company_info brdr_btm">Job Category</div>
                        <div class="width33company_info brdr_btm">Comission</div>
                    </div>
                    <?php $__currentLoopData = $industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $industry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="heading_row company-job-catrgory">
                        <div class="width33company_info company-job-catrgory-name same-height bg_grey same-height-left" style="height: 105px;"><span><?php echo e($industry['industry_name']); ?></span></div>
                        <div class="width66company_info same-height same-height-right" style="height: 105px;">
                            <div class="sub_data">
                                <div class="width50company_info ">
                                    <?php echo e($industry['name']); ?>

                                </div>
                                <div class="width50company_info">
                                    <?php echo e($industry['commision']); ?>%
                                </div>
                            </div>  
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <div class="buttons">
            <button data-toggle="modal" data-target="#forgot">Change Email</button>
            <button data-toggle="modal" data-target="#change_pass">Change Password</button>
        </div>
    </div>
</div>
<<<<<<< HEAD

<!-- ------------------ Change password popup ------------------- -->
=======
>>>>>>> 9ca3897f7554cdcd5823e2c2cbf98c8775253199
<div class="modal fade signup forgot" id="change_pass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Change Password</h4>
            </div>
            
			<?php echo $__env->make('errors.user_error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<<<<<<< HEAD
			
			<!-- -------- display error messages here -------- -->
				<div class="alert" id="password_messages" style="display:none"></div>
			<!-- --------------------------------------------- -->
			
=======
>>>>>>> 9ca3897f7554cdcd5823e2c2cbf98c8775253199
			<?php echo e(Form::model( $user =new App\Model\User, array( 'url' => url('employer/change-password'), 'id'=> 'employer-change-password' ))); ?>

            
            <div class="modal-body">
                <div class="form_signup">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form_grp old_password">
				            	<?php echo e(Form::password( 'old_password', array( 'id' => 'old_password', 'placeholder' => 'Enter Old Password' ) )); ?>

                                <label class="help-block"></label>
                                <span class="error_msgg" style="display:none;"></span>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form_grp password">
				                <?php echo e(Form::password( 'password', array( 'id' =>'password', 'placeholder' => 'Enter New Password' ) )); ?>

                                <span class="error_msgg" style="display:none;"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form_grp password_confirmation">
					        	<?php echo e(Form::password( 'password_confirmation', array( 'id' => 'password_confirmation', 'placeholder' => 'Retype New Password' ) )); ?>

                                <span class="error_msgg" style="display:none;"></span>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
		      	<?php echo e(Form::submit('Submit', [ 'id'=>'submit-button' ])); ?>

            </div>
            <?php echo e(Form::close()); ?>

        </div>
    </div>
</div>
<<<<<<< HEAD

<!-- -------------------- Change email popup ------------------- -->
<div class="modal fade signup forgot" id="forgot" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Change Email</h4>
            </div>
            
			<!-- -------- display error messages here -------- -->
				<div class="alert" id="email_messages" style="display:none"></div>
			<!-- --------------------------------------------- -->
			
			<?php echo e(Form::model( $user =new App\Model\User, array( 'url' => url('employer/change-email'), 'id'=> 'employer-change-email' ))); ?>

            
            <div class="modal-body">
                <div class="form_signup">
                    <div class="row">
                        <div class="col-md-12">
							<!-- ------------- old email ----------- -->
                            <?php echo e(Auth::user()->email); ?>

                        </div>
                        <div class="col-md-12">
                            <div class="form_grp new_email">
								<input type="email" id="new_email" name="new_email" placeholder="Enter New Email">
				                
                                <span class="error_msgg" style="display:none;"></span>
                            </div>
=======
<div class="modal fade signup" id="editform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Sign up</h4>
        </div>
        <div class="modal-body">
        <div id="msg"></div>
            <?php echo e(Form::open(['url'=>'auth/employe/register','id'=>'register'])); ?>

        <div class="form_signup">
            <div class="row">
                <div class="col-md-6">
                <div class="form_grp">
                    <?php echo e(Form::text('company_name',null,['placeholder' => 'Company Name'])); ?>

                </div>
               </div>
            </div>
            <div class="row">
                <div class="col-md-6 phonenumber">
                    <div class="country_codes">
                    <div class="form_grp number_add">
                    <?php echo e(Form::text('country_code',null,['placeholder' => 'Country Code','id'=>'phone','onkeydown'=>'return false'])); ?>

                    </div> 

                    <div class="form_grp number_cus">
                        <?php echo e(Form::text('phone',null,['placeholder' => 'Company Phone Number','id'=>'phone_number'])); ?>

                    </div>
                    </div>
                    <span class="error_msgg" style="display:none;"></span>
                    <div class="<?php if($errors->has('phone')): ?> has-error <?php endif; ?>">   
                        <?php if($errors->has('phone')): ?> <p class="text-danger"><?php echo e($errors->first('phone')); ?></p> <?php endif; ?>
                    </div>
                </div>
            </div>       
        <div class="form_signup">
            <div class="row">
                <div class="col-md-6  industry">
                        <div class="form_grp industrytype">
                        <?php echo e(Form::select('industry_type[]',$industry,null,['class'=>'chosen-select','multiple'=>'multiple','id'=>'multiselect','style'=>'width:350px;','data-placeholder'=>"Type of Industry"])); ?>

                        <span class="error_msgg" style="display:none;"></span>
                        <div class="<?php if($errors->has('industry_type')): ?> has-error <?php endif; ?>">
                            <?php if($errors->has('industry_type')): ?> <p class="text-danger"><?php echo e($errors->first('industry_type')); ?></p> <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form_grp">
                        <?php echo e(Form::text('number_worker',null,['id'=>'number_worker','placeholder'=>'Number of workers'])); ?>

                        <span class="error_msgg" style="display:none;"></span>
                        <div class="<?php if($errors->has('number_worker')): ?> has-error <?php endif; ?>"> 
                            <?php if($errors->has('number_worker')): ?> <p class="text-danger"><?php echo e($errors->first('number_worker')); ?></p> <?php endif; ?>
>>>>>>> 9ca3897f7554cdcd5823e2c2cbf98c8775253199
                        </div>
                    </div>
                </div>
            </div>
<<<<<<< HEAD
            <div class="modal-footer">
		      	<?php echo e(Form::submit('Submit', [ 'id'=>'submit-email-button' ])); ?>

            </div>
            <?php echo e(Form::close()); ?>

        </div>
    </div>
</div>
<!-- --------------- end change email popup here ---------------- -->

=======
            <div class="row">
                <div class="col-md-6">
                    <div class="form_grp">
                        <?php echo e(Form::text('first_name',null,['placeholder' => 'Contact First Name'])); ?>

                        <span class="error_msgg" style="display:none;"></span>
                        <div class="<?php if($errors->has('first_name')): ?> has-error <?php endif; ?>">   
                            <?php if($errors->has('first_name')): ?> <p class="text-danger"><?php echo e($errors->first('first_name')); ?></p> <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form_grp">
                        <?php echo e(Form::text('last_name',null,['placeholder' => 'Contact Last Name'])); ?>

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
                            <?php echo e(Form::text('company_code',null,['placeholder' => 'Contry code','id'=>'company_code','onkeydown'=>'return false'])); ?>

                        </div>
                        <div class="form_grp number_cus">
                            <?php echo e(Form::text('company_contact',null,['placeholder' => 'Contact number','id'=>'contact_number'])); ?>

                        </div>
                    </div>
                    <span class="error_msgg" style="display:none;"></span>
                    <div class="<?php if($errors->has('company_contact')): ?> has-error <?php endif; ?>">   
                        <?php if($errors->has('company_contact')): ?> <p class="text-danger"><?php echo e($errors->first('company_contact')); ?></p> <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form_grp pickLocation">
                        <?php echo e(Form::text('company_address',null,['id'=>'location','placeholder'=>'Location'])); ?>

                        <?php echo e(Form::hidden('lat',null,['id'=>'lat'])); ?>

                        <?php echo e(Form::hidden('lng',null,['id'=>'lng'])); ?>

                        <?php echo e(Form::hidden('key',null,['id'=>'key'])); ?>

                        <?php echo e(Form::hidden('register_key',Session::has('session_key')?Session::get('session_key'):0,['id'=>'key'])); ?>

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
                    <?php echo e(Form::textarea('company_description',null,['placeholder'=>'Enter Description'])); ?>

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
                        <?php echo e(Form::file('user_image',array('id'=>'user_image','placeholder'=>'Logo'))); ?>

                        <?php echo e(Form::hidden('image',null,array('id'=>'image'))); ?>

                        </div>

                        <span class="error_msgg" style="display:none;"></span>
                        <div class="<?php if($errors->has('image')): ?> has-error <?php endif; ?>">   
                        <?php if($errors->has('image')): ?> <p class="text-danger"><?php echo e($errors->first('image')); ?></p> <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
       </div>
      
      </div>
        <div class="modal-footer signup_ftr">
            <button type="button" id="registrationEmployer">Submit</button>
        </div>
       
        <?php echo e(Form::close()); ?> 
    </div>
  </div>
</div>
>>>>>>> 9ca3897f7554cdcd5823e2c2cbf98c8775253199
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('public/admin/js/jquery.form.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/employer/js/additional-methods.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/employer/js/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/admin/js/chosen.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/jquery.maskedinput.js')); ?>" type="text/javascript"></script>    
<script src="<?php echo e(asset('public/employer/js/contactus.js')); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $( "#employer-change-password" ).validate({
        rules: {
            "old_password":{
                required:true, 
            },
            "password":{
                required:true, 
            },
            "password_confirmation":{
                equalTo:"#password", 
            },
<<<<<<< HEAD
=======
            
>>>>>>> 9ca3897f7554cdcd5823e2c2cbf98c8775253199
        },
        messages: {
            "old_password":{
              required:"Please enter old password."
            },
            "password":{
              required:"Please enter new password."
            },
            "password_confirmation":{
              equalTo:"Password did not match."
            },
        },
        errorElement:'span',
        errorClass:'error_msg',
        submitHandler: function(form) {
            $("#employer-change-password").ajaxSubmit({
                method      : 'post',
                beforeSend  : function() {
                    Loader();
<<<<<<< HEAD
                    $('#password_messages').removeClass('alert-danger').hide();
                    $('#password_messages').removeClass('alert-success').hide();
                },
                url : path+'employer/change-password',
                success     : function(data) {
					RemoveLoader();
					if(data.success == true){
						$('#password_messages').addClass('alert-success').html(data.message).fadeIn('slow').delay(3000).fadeOut();
						//redirect to logout page, so we can re-authenticate user with new password.
						setTimeout(function(){ window.location = path+'employer/logout'; }, 3000);
					}else{
						$('#password_messages').addClass('alert-danger').html(data.message).fadeIn('slow').delay(3000).fadeOut();
					}
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    RemoveLoader();
                    $( "#employer-change-password .form-grp" ).removeClass( "has-error" );
                    $( ".help-block" ).hide();
                    $.each( xhr.responseJSON, function( i, obj ) {
=======
                },
                url : path+'employer/change-password',
                success     : function(data) {
                    window.location = path+'employer/company-profile';
                },
                error       : function(xhr, ajaxOptions, thrownError) {
                   // removeLoader();
                    $( "#employer-change-password .form-grp" ).removeClass( "has-error" );
                    $( ".help-block" ).hide();
                    
                    $.each( xhr.responseJSON, function( i, obj ) {
                 
>>>>>>> 9ca3897f7554cdcd5823e2c2cbf98c8775253199
                        $( 'input[name="'+i+'"]' ).closest( '.form-grp').addClass('has-error');
                        $( 'input[name="'+i+'"]' ).closest( '.form-grp').find('label.help-block').slideDown(400).html(obj);
                        $( 'textarea[name="'+i+'"]' ).closest( '.form-grp').addClass('has-error');
                        $( 'textarea[name="'+i+'"]' ).closest( '.form-grp').find('label.help-block').slideDown(400).html(obj);
                        
                        if( i=='old_password' ){
                            $('.old_password').find('span.error_msgg').slideDown(400).html(obj);
                        }

                        if( i=='password' ){
                            $('.password').find('span.error_msgg').slideDown(400).html(obj);
                        }

                        if( i=='password_confirmation' ){
<<<<<<< HEAD
                            $('.password_confirmation').find('span.error_msgg').slideDown(400).html(obj);                           
                        }
                        
                        
                        
                    });
                }
            });
        }
    });
    
    
    /*
    DESC : when  user email is updated
    */
    $( "#employer-change-email" ).validate({
        rules: {
            "new_email":{
                required:true,
            }
        },
        messages: {
            "new_email":{
              required:"Please enter new email.",
            }
        },
        errorElement:'span',
        errorClass:'error_msg',
        submitHandler: function(form) {
            $("#employer-change-email").ajaxSubmit({
                method      : 'post',
                beforeSend  : function() {
                    Loader();
                    $('#email_messages').removeClass('alert-danger').hide();
                    $('#email_messages').removeClass('alert-success').hide();
                },
                url : path+'employer/change-email',
                success     : function(data) {
					RemoveLoader();
					if(data.success == true){
						$('#email_messages').addClass('alert-success').html(data.message).fadeIn('slow').delay(3000).fadeOut();
						//redirect to logout page, so we can re-authenticate user with new password.
						setTimeout(function(){ window.location = path+'employer/logout'; }, 3000);
					}else{
						$('#email_messages').addClass('alert-danger').html(data.message).fadeIn('slow').delay(3000).fadeOut();
					}
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    RemoveLoader();
                    $( "#employer-change-email .form-grp" ).removeClass( "has-error" );
                    $( ".help-block" ).hide();
                    $.each( xhr.responseJSON, function( i, obj ) {
                        $( 'input[name="'+i+'"]' ).closest( '.form-grp').addClass('has-error');
                        $( 'input[name="'+i+'"]' ).closest( '.form-grp').find('label.help-block').slideDown(400).html(obj);
                        $( 'textarea[name="'+i+'"]' ).closest( '.form-grp').addClass('has-error');
                        $( 'textarea[name="'+i+'"]' ).closest( '.form-grp').find('label.help-block').slideDown(400).html(obj);
                        
                        if( i=='new_email' ){
                            $('.new_email').find('span.error_msgg').slideDown(400).html(obj);
=======
                            $('.password_confirmation').find('span.error_msgg').slideDown(400).html(obj);                                
>>>>>>> 9ca3897f7554cdcd5823e2c2cbf98c8775253199
                        }

                    });
                }
            });
        }
    });
<<<<<<< HEAD
    
    
    
    
    
    
    
    
</script>

<?php $__env->stopSection(); ?>

=======
</script>

<?php $__env->stopSection(); ?>
>>>>>>> 9ca3897f7554cdcd5823e2c2cbf98c8775253199
<?php echo $__env->make('employer.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>