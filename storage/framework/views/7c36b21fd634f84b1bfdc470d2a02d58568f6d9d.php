<?php  $total_records=$total_page=$display_record=0; ?>
<?php if(count($jobData)): ?>

			<?php  $total_records=$jobCount; ?>
			<?php  $j=($jobData->currentPage() - 1) * $jobData->perPage() + 1; ?>
			<?php  $k=($jobData->currentPage()) * $jobData->perPage(); ?>
			<?php  $display_record=$j.'-'.$k;  ?>
			<?php  $total_page=$jobData->lastPage(); 


			 ?>
<?php endif; ?>				

			
<div class="number_list">Showing <?php echo e($display_record); ?> total of <?php echo e(count($total_records) ? $total_records : '0'); ?> jobs
	<div class="pull-right form_inputs col-md-3">
		<select class="customselect pull-right selectrecords"  data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
			<option value="">select records</option>
			<option value="10" <?php if($records==10){ echo 'selected'; } ?>>10</option>
			<option value="15" <?php if($records==15){ echo 'selected'; } ?>>15</option>
			<option value="20" <?php if($records==20){  echo 'selected'; } ?>>20</option>
			<option value="30" <?php if($records==30){ echo 'selected'; } ?>>30</option>
			<option value="40" <?php if($records==40){ echo 'selected'; } ?>>40</option>
		</select>
	</div>
</div>
	<div class="white_inner_sec ">
	<table width="100%">
	<tr><th class="greycolor text-center">Sr. no</th>
	<th class="text-left">Job Name</th>
	<th class="text-center">Category</th>
	<th class="text-center">Status</th>
	<th class="text-center">Hires</th>
	<th class="text-center">Start date</th>
	</tr>
		<?php if(count($jobData)): ?>
			
			<?php  $i= ($jobData->currentPage() - 1) * $jobData->perPage() + 1; 

			
			 ?>
			<?php $__currentLoopData = $jobData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php  $jobId = Crypt::encrypt($value->_id);  ?>
				<tr>
				<td data-list-label="Sr. no" class="greycolor text-center"><?php echo e($i); ?>

				</td>
				<td data-list-label="Job Name" class="text-left"><a href="jobdetail/<?php echo e($jobId); ?>" class="textleft"><?php echo e(ucfirst($value->title)); ?> </a>
					<?php //echo '<br>for '.humanTiming(strtotime($value->created_at)).' ago'; 
					?>
				</td>
				<td data-list-label="Category" class="text-center"><?php echo e(ucfirst($value['category'][0]['name'])); ?></td>
				<td data-list-label="Status" class="text-center">
					<?php if($value->job_status==1): ?>
						<span  class=" color_orange"><?php echo e('Active'); ?></span>
					<?php elseif($value->job_status==2): ?>
						<?php echo e('Filled'); ?>	
					<?php elseif($value->job_status==3): ?>	
						<?php echo e('Progress'); ?>

					<?php elseif($value->job_status==4): ?>	
						<span  class=" color_green "><?php echo e('Completed'); ?></span>
						<?php if(isset($value->rating) && !empty($value->rating)): ?>
						<div>
							
							<p class="text-notification"><strong>
				                <?php if($value->rating == 1): ?>
				                    <i class="fa fa-star"></i>
				                <?php elseif($value->rating == 2): ?>

				                    <i class="fa fa-star"></i><i class="fa fa-star"></i>  
				                <?php elseif($value->rating == 3): ?>


				                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
				                <?php elseif($value->rating == 4): ?>
				                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>  <i class="fa fa-star"></i>
				                <?php elseif($value->rating == 5): ?>
				                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>  
				                <?php endif; ?>
				            </strong> </p>
						</div>
						<?php else: ?>
							<?php echo Form::open(['url'=>'employer/rating','class'=>'rating']); ?>

							<?php echo Form::select('rating',[''=>'Rating',1=>1,2=>2,3=>3,4=>4,5=>5],null,['id'=>'jobrating','data-jobvalue'=>"$jobId"]); ?>

							<?php echo Form::close(); ?>

						<?php endif; ?>
					<?php endif; ?>	
				</td>
				<td data-list-label="Hires" class="text-center">
					<?php if($value->total_hired): ?>
						<?php echo e($value->total_hired); ?>

					<?php else: ?>
						<?php echo e('0'); ?>	
					<?php endif; ?>	
				 Hires</td>
				<td data-list-label="Start date" class="text-center">

				<?php  
				/*$d= (string)$value->shifts[0]['start_date'];
				$utcdatetime = new \MongoDB\BSON\UTCDateTime($d); 
				$datetime  = $utcdatetime->toDateTime();
				$start = $datetime->format('Y-m-d');*/
				 ?>
				 <?php echo e(date('d F, Y',strtotime($value->shifts[0]['start_date']))); ?> 

				</td>
				</tr>
			<?php $i += 1;?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php else: ?>
			<tr>
				<td class="text-center text-danger" colspan="6">
					<?php echo e($msg); ?>

				</td>
			</tr>	
		<?php endif; ?>	


	</table>
	<div class="pull-right pagination-common" data-ref="dashboard">
			<?php echo $jobData->render(); ?>
		</div> 

<?php
	/*******Need to common*******/

	function humanTiming ($time)
	{
	    $time = time() - $time; // to get the time since that moment
	    $time = ($time<1)? 1 : $time;
	    $tokens = array (
	        31536000 => 'year',
	        2592000 => 'month',
	        604800 => 'week',
	        86400 => 'day',
	        3600 => 'hour',
	        60 => 'minute',
	        1 => 'second'
	    );

	    foreach ($tokens as $unit => $text) {
	        if ($time < $unit) continue;
	        $numberOfUnits = floor($time / $unit);
	        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
	    }
	}
?>

