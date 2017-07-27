<?php  $job_detail = getDates($job_post->jobshifts);

/*$start= (string)$job_post->start_date;
$utcdatetime = new \MongoDB\BSON\UTCDateTime($start); 
$datetime  = $utcdatetime->toDateTime();
$start_date = $datetime->format('Y-m-d H:i:s');
$end= (string)$job_post->end_date;
$utcdatetime1 = new \MongoDB\BSON\UTCDateTime($end); 
$datetime1  = $utcdatetime1->toDateTime();
$end_date = $datetime1->format('Y-m-d H:i:s');*/
$start_date = date('Y-m-d H:i:s',strtotime($job_post->start_date));
$end_date = date('Y-m-d H:i:s',strtotime($job_post->end_date));

function getDates($dates)
{
    $data = '';
    foreach($dates AS $k => $row)
    {
    	/*$time= (string)$row['start_date'];
		$utcdatetime2 = new \MongoDB\BSON\UTCDateTime($time); 
		$datetime2  = $utcdatetime2->toDateTime();
		$dates1 = $datetime2->format('Y-m-d H:i:s');*/
        $data[] = date('Y-m-d',strtotime($row['start_date'])); 
    }
    return $data;
}

$jobId = Crypt::encrypt($job_post->_id);
$shiftsData = [];
foreach($job_post->jobshifts AS $k => $row){
  $shiftsData[] = ['start_date'=>date('h:i A',strtotime($row['start_date'])),'end_date'=>date('h:i A',strtotime($row['end_date']))];
}
 ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('public/employer/css/datepicker.css')); ?>">
<link  href="<?php echo e(asset('public/employer/css/main.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
Edit Job
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="white_inner_sec wow fadeInUp">
<?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="job_detail_sec">
<div class="col-lg-8 col-md-8 col-sm-9 col-xs-12">
<div class="job_detail_left_sec">
<h2><?php echo e(ucwords($job_post->title)); ?></h2>
<span class="job_time"><?php echo e(date('jS F ',strtotime($start_date))); ?> • <?php echo e(date('jS F Y',strtotime($end_date))); ?></span>
<p style="word-wrap:break-word;"><?php echo e($job_post->description); ?>.</p>
<div class="job_time_loc">
<div class="hours_working">$<?php echo e($job_post->salary_per_hour); ?>/hr</div>
<div class="location_sec width_100"><span><i class="fa fa-map-marker" aria-hidden="true"></i>
</span><div class="text_job"><b><?php echo e($job_post->address); ?></b></div></div>
<div class="clearfix"></div>
<div class="location_sec"><span><i class="fa fa-clock-o" aria-hidden="true"></i>
</span><div class="text_job"><b><?php 
$shift = current($shiftsData)
 ?>
<?php echo e($shift['start_date']); ?> - <?php echo e($shift['end_date']); ?></b></div></div>
<div class="location_sec"><div class="text_job">Number of persons: - <b><?php echo e($job_post->number_of_worker_required); ?></b></div></div>
<div class="clearfix"></div>
<div class="location_sec"><div class="text_job">Category - <b><?php echo e(ucwords($job_post->category[0]['name'])); ?></b></div></div>
<div class="location_sec"><div class="text_job">Sub-Category - <b><?php echo e(ucwords($job_post->subcategory[0]['name'])); ?></b></div></div>
<div class="location_sec width_100"><div class="text_job">Skill - </div>
	<div class="tag_align_right">
		<?php $__currentLoopData = $job_post->skill; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="jobtag"><?php echo e($value['name']); ?></div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>		
</div>
<div class="clearfix"></div>

</div>
</div>
</div>
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
<div class="worked_hr_and_amnt">
<?php 
$dates = current($shiftsData);
$start= Carbon\Carbon::parse($dates['start_date']);
$end= Carbon\Carbon::parse($dates['end_date']);
$totalDuration = $end->diff($start)->format('%H.%I');
$totalHours = ($totalDuration * count($job_post->shiftsData) * $job_post->total_hired);
 ?>
<span>Total Hours Worked: <b>$<?php echo e($totalHours); ?>/hr</b></span>
<span>Amount:<b>
	
<?php 

$price = (count($job_post->shiftsData) * $job_post->total_hired * $job_post->salary_per_hour * $totalDuration); 
$commision = (($price * $job_post->category[0]['commision'])/100);
  ?>
 $<?php echo e(number_format($price + $commision,2)); ?>

</b></span>
</div>
</div>
</div>
<div class="job_detail_sec">
<div class="hired_workers_profile">
<h6>Hired Workers</h6>
<div class="row">
<?php if(count($users)): ?>
	<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php  
		//print_r($user);
	 ?>
		<div class="col-md-4 col-xs-12">
		<div class="hire_profile_employe_sec">
		<div class="img_employe"><img src="<?php echo e($user['image']); ?>"/></div>
		<span><?php echo e($user['email']); ?></span>
		<div class="rate_empl">
    <p class="text-notification"><strong>
        <?php if( ( $user->rating > 1 ) && ( $user->rating < 1.5 ) ): ?>
            <i class="fa fa-star"></i>
        <?php elseif( ( $user->rating > 1.5 ) && ( $user->rating <= 2 || $user->rating < 2.5 ) ): ?>
            <i class="fa fa-star"></i><i class="fa fa-star"></i>  
        <?php elseif( $user->rating == 1.5 ): ?>
            <i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>  
        <?php elseif( ( $user->rating > 2.5 )&& ( $user->rating <= 3 || $user->rating < 3.5 ) ): ?>
            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>  
        <?php elseif( $user->rating == 2.5 ): ?>
            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>  
        <?php elseif( ( $user->rating > 3.5 ) && ( $user->rating <= 4 || $user->rating < 4.5 ) ): ?>
            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>  
        <?php elseif( $user->rating ): ?>
            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>  
        <?php elseif( $user->rating == 4.5 ): ?>
            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>  
        <?php else: ?>
            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>  
        <?php endif; ?>
    </strong> </p>
		</div>
		</div>
		</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
</div>
</div>
</div>

<div class="buttons">
<button data-toggle="modal" data-target="#Rehiring">Rate Workers</button>
<!-- <button>Repost This Job</button> -->
<a href="<?php echo e(url('employer/post_job/'.$jobId)); ?>">Repost This Job</a>
</div>
</div>


<?php echo Form::close(); ?>

</div>

<div class="modal fade signup forgot rate_worker" id="Rehiring" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Rate workers</h4>
      </div>
      <div class="modal-body">
       <div class="rehiring_div">
       <ul>
<?php  
$display = 'disabled=true';
 ?>       
<?php echo Form::open(['id'=>'ratinguser','url'=>'employer/job-rating']); ?>

	<?php if(count($ratingUser)): ?>
       <?php $__currentLoopData = $ratingUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $rateUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php  $userId = Crypt::encrypt($rateUser['_id']);  ?>
          <?php  
$display = '';
 ?>  
     <li>  
       <input type="hidden" name="u_ids[]" value="<?php echo e($userId); ?>">
       
     <div class="col-sm-6 col-xs-12">
     <div class="rehir_pic">
     		<img src="<?php echo e($rateUser['image']); ?>" />
     	</div><p><?php echo e($rateUser['first_name']); ?> <?php echo e($rateUser['last_name']); ?></p></div>
      <div class="col-sm-6 col-xs-12"><div class="name_rating"><div class="rating_rehire pull-right">
      <div class="stars stars-example-fontawesome starratecont intervewirateFeild">
                <select id="example-fontawesome" name="rating[]" class="ratingstar ratingstar-<?php echo e($k); ?>" data-value="<?php echo e($k); ?>">
                  <option value="">0</option>	
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select> 

      </div>

</div>

</div></div>
    </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
    
    <div class="col-sm-12 col-xs-12">
     
     <div><p>No candidates hired for this job</p><br><br><br></div>

     </div>
    	
    
    <?php endif; ?>
       </ul>
       </div>
      </div>
      <div class="modal-footer signup_ftr ">
        <button type="button" id="addRating" <?php echo e($display); ?>>Submit</button>
 
      </div>
       <?php echo Form::close(); ?> 
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('public/employer/js/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/employer/js/bootstrap-datepicker.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/jquery.barrating.js')); ?>" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
	
	$('#datepicker').datepicker({
		maxViewMode: 0,
   
});
$('.ratingstar').barrating({
            theme: 'fontawesome-stars',
            showSelectedRating: false
    });
});


$(document).on('click','#addRating',function(){
      Loader();
    $.ajax({
            url: $('form#ratinguser').attr('action'),
            type: 'post',
            dataType: 'json',
            data: $('form#ratinguser').serialize(),
            beforeSend:function(){
                Loader();
            },
            success: function(data) {
            	RemoveLoader();
              
              
              window.location.reload();
            },
            error: function(error) { 
              RemoveLoader();
              $('span.error_msg').hide();
              $('span.error_msgg').hide();
              /*var result_errors = error.responseJSON;
              if(result_errors)
              {
                 $.each(result_errors, function(i,obj)
                 {
                    $('input[name='+i+']').parent('.form_grp').find('span.error_msgg').slideDown(400).html(obj);

                    if(i == 'token_mismatch')
                        window.location.reload();
                 }) 
              }*/

            },
            complete: function() { //alert('b nn'); 
            }
          });
    

});

		
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('employer.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>