<?php  $total_records=$total_page=$display_record=''; ?>
<?php if(count($jobData)): ?>

			<?php  $total_records=$jobCount; ?>
			<?php  $j=($jobData->currentPage() - 1) * $jobData->perPage() + 1; ?>
			<?php  $k=($jobData->currentPage()) * $jobData->perPage(); ?>
			<?php  $display_record=$j.'-'.$k;  ?>
			<?php  $total_page=$jobData->lastPage();  ?>
			
<?php endif; ?>				

			




<div class="table_dashboard">
<table width="100%">
<tr><th class="greycolor text-center">Sr. no</th>
<th class="text-left">Candidate Name</th>
<th class="text-center">Download Resume</th>
<th class="text-center">Rating</th>
<th class="text-center">Action</th>
</tr>


<?php if(count($jobData)): ?>
	<?php  
		
		$total = count($total_records) ? $total_records : '0';
		$message = "Showing $display_record  of  $total  jobs";
		$i= ($jobData->currentPage() - 1) * $jobData->perPage() + 1;
	 ?>
	<input type="hidden" value="<?php echo e($message); ?>" id="message">
	<?php $__currentLoopData = $jobData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php  $applicationId = Crypt::encrypt($value->_id); 
		 ?>
		<tr>
			<td data-list-label="Sr. no" class="greycolor text-center"><?php echo e($i); ?></td>
			<td data-list-label="Candidate Name" class="text-left"><div class="candi_img"><img src="<?php echo e($value->applyjobuser->image); ?>" alt=""/></div> <div class="name_candi"></div></td>
			<td data-list-label="Download CV" class="text-center"><a href="<?php echo e($value->applyjobuser->cv_url); ?>" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
			</td>
			<td data-list-label="Rating" class="text-center color_orange"><!-- <i class="fa fa-star" aria-hidden="true"></i> -->
			
			<p class="text-notification"><strong>
                <?php if( ( $value->applyjobuser->rating > 1 ) && ( $value->applyjobuser->rating < 1.5 ) ): ?>
                    <i class="fa fa-star"></i>
                <?php elseif( ( $value->applyjobuser->rating > 1.5 ) && ( $value->applyjobuser->rating <= 2 || $value->applyjobuser->rating < 2.5 ) ): ?>
                    <i class="fa fa-star"></i><i class="fa fa-star"></i>  
                <?php elseif( $value->applyjobuser->rating == 1.5 ): ?>
                    <i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>  
                <?php elseif( ( $value->applyjobuser->rating > 2.5 )&& ( $value->applyjobuser->rating <= 3 || $value->applyjobuser->rating < 3.5 ) ): ?>
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>  
                <?php elseif( $value->applyjobuser->rating == 2.5 ): ?>
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>  
                <?php elseif( ( $value->applyjobuser->rating > 3.5 ) && ( $value->applyjobuser->rating <= 4 || $value->applyjobuser->rating < 4.5 ) ): ?>
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>  
                <?php elseif( $value->applyjobuser->rating ): ?>
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>  
                <?php elseif( $value->applyjobuser->rating == 4.5 ): ?>
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>  
                <?php else: ?>
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>  
                <?php endif; ?>
            </strong> </p>
			<!--  <i class="fa fa-star" aria-hidden="true"></i>
			 <i class="fa fa-star" aria-hidden="true"></i>
			 <i class="fa fa-star" aria-hidden="true"></i>
			<i class="fa fa-star" aria-hidden="true"></i> -->
			</td>
			<td  data-list-label="Action" class="text-center actions">
			<?php if(($value->job_type==1 && $value->job_status==1) || ($value->job_type==2 && $value->job_status==1)): ?>
				<?php echo e('Hire'); ?>

			<?php elseif($value->job_type==0): ?>
				<?php if($value->job_status==0): ?>
					<a href="javascript:void(0);" data-apply_value="<?php echo e($applicationId); ?>" class="accept" data-type="accepted" data-confirm-message="Are you sure you want to accept the candidate?"><i class="fa fa-thumbs-up color_green" aria-hidden="true"></i></a>
			 		<a href="javascript:void(0);" data-apply_value="<?php echo e($applicationId); ?>" class="declined" data-type="rejected" data-confirm-message="Are you sure you want to decline the candidate?"><i class="fa fa-thumbs-down color_red" aria-hidden="true"></i></a>

				<?php elseif($value->job_status==1): ?>
					<?php echo e('Hire'); ?>

				<?php endif; ?>
			<?php endif; ?>	
			</td>
		</tr>
		<?php  $i += 1;  ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
	<tr>
		<td class="text-center text-danger" colspan="6">
			No candidate has applied yet.
		</td>
	</tr>	
<?php endif; ?>
<?php echo Form::hidden('records',$records,['class'=>'records']); ?>

</table>
<div class="pull-right pagination-common" data-ref="dashboard">
			<?php echo $jobData->render(); ?>
		</div> 
</div>



