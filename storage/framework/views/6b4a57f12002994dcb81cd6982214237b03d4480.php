<div class="modal fade signup forgot" id="rehire_fr_job" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Rehire for Job</h4>
      </div>
      <div class="modal-body">
      <div class="rehiring_div">
          <?php if(count($users)): ?>
            <ul>      
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li>
                  <div class="rehir_pic"><img src="<?php echo e($value->image); ?>" /></div>
                  <div class="name_rating"> <p><?php echo e($value->first_name); ?> <?php echo e($value->last_name); ?></p><div class="rating_rehire">
                          <?php if( ( $value->rating > 1 ) && ( $value->rating < 1.5 ) ): ?>
                              <i class="fa fa-star"></i>
                          <?php elseif( ( $value->rating > 1.5 ) && ( $value->rating <= 2 || $value->rating < 2.5 ) ): ?>
                              <i class="fa fa-star"></i><i class="fa fa-star"></i>  
                          <?php elseif( $value->rating == 1.5 ): ?>
                              <i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>  
                          <?php elseif( ( $value->rating > 2.5 )&& ( $value->rating <= 3 || $value->rating < 3.5 ) ): ?>
                              <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>  
                          <?php elseif( $value->rating == 2.5 ): ?>
                              <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>  
                          <?php elseif( ( $value->rating > 3.5 ) && ( $value->rating <= 4 || $value->rating < 4.5 ) ): ?>
                              <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>  
                          <?php elseif( $value->rating >= 4 && $value->rating < 4.5): ?>
                              <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>  
                          <?php elseif( $value->rating == 4.5 ): ?>
                              <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>  
                          <?php else: ?>
                              <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>  
                          <?php endif; ?>
                      </div>
                      <div class="check_box_rating">
                          <?php  $disabled = '';  ?>
                          <?php if($value->approved!=1): ?>
                            <?php  $disabled = 'disabled';  ?>
                          <?php endif; ?>
                          <?php echo Form::checkbox('offer[]',$value->_id,null,['id'=>'rate_check',$disabled]); ?>

                            <label for="rate_check"><i class="fa fa-check" aria-hidden="true"></i>
                          </label>
                      </div>
                  </div>
              </li>
             
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php echo Form::hidden('rehirevalue',null,['id'=>'rehirevalue']); ?>

          <?php else: ?>
            <p class="nodatafound">You have not any previous hiring. Please select any other method</p>
          <?php endif; ?> 
       
       
       </div>
       
      </div>
      <div class="modal-footer signup_ftr ">
      <?php if(count($users)): ?>
        <button type="button" id="selectedUser">reHire</button>
      <?php endif; ?> 
      </div>
    </div>
  </div>
</div>