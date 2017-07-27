<div class="modal fade signup forgot gurrntte" id="manul_hiring" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
       <p>Please be advised MadWall cannot guarantee that the worker(s) requested for this job will be able to make it to the job site on the specified time. Please update your timesheets accordingly.</p>
       <?php echo Form::hidden('dur_days',null,['id'=>'dur_days']); ?>

       <?php echo Form::hidden('dur_hours',null,['id'=>'dur_hours']); ?>

       <?php echo Form::hidden('dur_cur_date',null,['id'=>'dur_cur_date']); ?>

       <?php echo Form::hidden('dur_current_date',null,['id'=>'dur_current_date']); ?>

       </div>
       </div>
       </div>
       
       </div>
       
      </div>
      <div class="modal-footer signup_ftr ">
        <button type="button" id="confirm_dur_message">Yes</button>
  <button type="button" class="cancel_btn close" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>