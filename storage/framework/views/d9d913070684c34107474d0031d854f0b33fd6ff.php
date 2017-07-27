<div class="modal fade signup forgot" id="contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Contact us</h4>
      </div>
  
  <?php echo Form::open(['id'=>'usercontactus','url'=>'employer/contact-us']); ?>    
      <div class="modal-body">
      <div id="contactmsg">
      </div>
       <div class="form_signup">
       <div class="row">
       <div class="col-md-12">
       <div class="form_grp">
       <?php echo Form::text('name',null,['placeholder'=>'Name']); ?>

       <span class="error_msgg" style="display:none;"></span>
       </div>
       </div>
       <div class="col-md-12">
       <div class="form_grp">
       
       <?php echo Form::text('email',null,['placeholder'=>'E-mail']); ?>

       <span class="error_msgg" style="display:none;"></span>
       </div>
       </div>
       
       <div class="col-md-12">
       <div class="form_grp">
      <!-- <textarea></textarea> -->
      <?php echo Form::textarea('content',null,['rows'=>2,'placeholder'=>'Message']); ?>

      <span class="error_msgg" style="display:none;"></span>
       </div>
       </div>
       </div>
       
       </div>
       
      </div>
      <div class="modal-footer signup_ftr ">
        <!-- <button type="submit">Submit</button> -->
        <?php echo Form::button('Submit',['class'=>'contact-us']); ?>

      </div>
  <?php echo Form::close(); ?>    
    </div>
  </div>
</div>