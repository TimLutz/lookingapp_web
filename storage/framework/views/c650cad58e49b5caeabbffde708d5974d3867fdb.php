<?php  $total_records=$total_page=$display_record=0; ?>
<?php if(count($jobData)): ?>

			<?php  $total_records=$jobCount; ?>
			<?php  $j=($jobData->currentPage() - 1) * $jobData->perPage() + 1; ?>
			<?php  $k=($jobData->currentPage()) * $jobData->perPage(); ?>
			<?php  $display_record=$j.'-'.$k;  ?>
			<?php  $total_page=$jobData->lastPage(); 


			 ?>
<?php endif; ?>				
			
<div class="number_list">Showing <?php echo e($display_record); ?>  of <?php echo e(count($total_records) ? $total_records : '0'); ?> jobs
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
<th class="text-center">Hires</th>
<th class="text-center">Hourly Rate</th>
<th class="text-center">Number of Days</th>
<th class="text-center">Amount</th>
</tr>
<?php if(count($jobData)): ?>
			
			<?php  $i= ($jobData->currentPage() - 1) * $jobData->perPage() + 1; 

			
			 ?>
			<?php $__currentLoopData = $jobData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php  $jobId = Crypt::encrypt($value->_id);  ?>
				<tr>
				<td data-list-label="Sr. no" class="greycolor text-center"><?php echo e($i); ?>

				</td>
				<td data-list-label="Job Name" class="text-left"><a href="history-detail/<?php echo e($jobId); ?>" class="textleft"><?php echo e(ucfirst($value->title)); ?> </a>
					<?php //echo '<br>for '.humanTiming(strtotime($value->created_at)).' ago'; 
					?>
				</td>
				<td data-list-label="Hires" class="text-center">
					<?php if($value->total_hired): ?>
						<?php echo e($value->total_hired); ?>

					<?php else: ?>
						<?php echo e('0'); ?>	
					<?php endif; ?>	
				 	Hires
				</td>
				<td data-list-label="Hourly Rate" class="text-center ">
					$<?php echo e($value->salary_per_hour); ?>	
				</td>
				<td data-list-label="Number of Days" class="text-center">
					<?php echo e(count($value->shifts)); ?>		
				</td>
				<td data-list-label="Amount" class="text-center">
						

						<?php 
						$dates = current($value->shifts);
						$start= Carbon\Carbon::parse($dates['start_date']);
						$end= Carbon\Carbon::parse($dates['end_date']);
						$totalDuration = $end->diff($start)->format('%H.%I');
					    $price = (count($value->shifts) * $value->total_hired * $value->salary_per_hour * $totalDuration); 
					    $commision = (($price * $value->category[0]['commision'])/100);
						  ?>
						 $<?php echo e(number_format($price + $commision,2)); ?>

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



