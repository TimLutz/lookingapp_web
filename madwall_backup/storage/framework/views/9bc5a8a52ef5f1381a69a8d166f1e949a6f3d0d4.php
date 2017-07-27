<?php $__env->startSection('title'); ?>
    Edit Commission
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<style type="text/css">
    
.extra-discount-css{
    margin-top: 20px;    
}
</style>>
@endsession
<?php $__env->startSection('heading'); ?>
    Edit Commission
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="portlet box blue">  
        <div class="caption" style="float:right">
            <a style="background-color:#364150" class="btn btn-primary" href="<?php echo e(url('admin/list-approvedemployer')); ?>"> Back </a>
        </div>
        
        <div class="portlet-body form">
            <?php echo $__env->make('errors.user_error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php if(count($errors) > 0): ?>
            <?php endif; ?>
            <?php echo e(Form::open(array( 'method' => 'POST','url' => '/admin/edit-approved-employer','id'=>'edit-approved-employer'))); ?>

             
                <div class="form-body">
                    <div class="row">
                    <div class="col-md-offset-2 col-md-2">
                        <div class="form-group commission">
                            <?php echo e(Form::label('commission', 'Commission: ',['class' => 'control-label'] )); ?> <span class="star">*</span> 
                            <?php echo e(Form::text( 'commission' , $edit_commission, ['class' => 'form-control', 'maxlength'=> '3', 'id' => 'commission' ] )); ?>

                            <label class="help-block"></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <?php echo e(Form::label('extra_discount', ' ',['class' => 'control-label'] )); ?>

                            
                            <?php if(isset($edit_discount)): ?>
                                <?php echo e(Form::select('extra_discount' ,array('extra' => 'Extra', 'discount' => 'Discount', 'null' => 'Null'),$edit_discount,['class' => 'form-control extra-discount-css abc'])); ?>

                            <?php else: ?>
                                <?php echo e(Form::select('extra_discount', array('extra' => 'Extra', 'discount' => 'Discount', 'null' => 'Null'),0,['class' => 'form-control extra-discount-css', 'id'=>'extra_discount' ])); ?>

                            <?php endif; ?>
                            <label class="help-block"></label>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-4">
                        <?php echo e(Form::button( 'Edit Commission', ['id'=>'give-commission','class' => 'btn btn-primary'])); ?>

                         <?php echo e(Html::link( 'admin/list-approvedemployer', 'Cancel', array( 'class' => 'btn btn-primary' ))); ?>

                        
                    </div>
                    <div class="col-md-offset-2 col-sm-4">
                         <?php if( $approved == 1 ): ?>
                            <?php echo e(Form::button( 'Block User', ['id'=>'give-commission','class' => 'btn btn-danger', "data-target"=>"#myModalHorizontal", "data-toggle"=>"modal"])); ?>

                        <?php endif; ?>
                        <?php if( $approved == 3 ): ?>
                            <?php echo e(Form::button( 'Unblock User', [ 'id'=>'unblock-user','class' => 'btn btn-primary' ])); ?>                                 
                        <?php endif; ?>
                    </div>
                    <br> <br>
                    <div class="clearfix"></div>
                </div>
                <?php echo e(Form::hidden( 'userid' , $id, ['id'=> 'userid' ] )); ?>

            <?php echo e(Form::close()); ?>

        </div>  
    </div>

<div class="modal fade" id="myModalHorizontal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Reason For Block
                </h4>
            </div>
                
            <!-- Modal Body -->
        <div class="modal-body">
            
          <?php echo e(Form::open(array( 'method' => 'POST','url' => '/admin/block-user','id'=>'block-user-form', 'class' => 'form-horizontal', 'role' => 'form'))); ?>

            <div class="form-group reason_for_block_usr">
              <div class="col-sm-12">
              <?php echo e(Form::textarea('reason_for_block_usr',null, ['class' => 'form-control description', 'maxlength'=> '500', 'placeholder'=>'Reason' ])); ?>

              </div>
            <div style="margin-left:15px;">
                <label class="help-block"></label>
            </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-8 col-sm-10">
                    <?php echo e(Form::button( 'Click', [ 'id'=>'block-user-reason','class' => 'btn btn-primary'])); ?>

                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
                <?php echo e(Form::hidden( 'userid' , $id, ['id'=> 'userid' ] )); ?>

          <?php echo e(Form::close()); ?>

        </div>
            
          
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('public/admin/js/jquery.form.js')); ?>" type="text/javascript"></script>
<script>
$(document).ready(function() {     
    $('#give-commission').click(function(){
        $("#edit-approved-employer").ajaxSubmit(
            {
                type: 'post',
                beforeSend  : function() {
                    addLoader();
                },
                url : path+'admin/edit-approved-employer',
                success     : function(data) {
                    window.location = path+'admin/list-approvedemployer';
                },
                error: function(xhr, ajaxOptions, thrownError) {
                removeLoader();
                $("#editcategory .form-group").removeClass("has-error");
                $(".help-block").hide();
                $.each(xhr.responseJSON, function(i, obj) {
                    $('input[name="'+i+'"]').closest('.form-group').addClass('has-error');
                    $('input[name="'+i+'"]').closest('.form-group').find('label.help-block').slideDown(400).html(obj);
                    $('textarea[name="'+i+'"]').closest('.form-group').addClass('has-error');
                    $('textarea[name="'+i+'"]').closest('.form-group').find('label.help-block').slideDown(400).html(obj);
                    
                    if(i=='commission'){
                        $('.commission').addClass('has-error');
                        $('.commission').find('label.help-block').slideDown(400).html(obj);
                    }
                }); 
            } 
        }
        )
    });


    $('#block-user-reason ').click(function(){  
        var token = "<?php echo e(csrf_token()); ?>";
        var id = $('#userid').val();
        $.ajax({
            method      : 'post',
            url : path+'admin/block-employer',
            //data: { id:id, _token: token, skills:skills, category_id: cat_id, file:file1 },
            data: $("#block-user-form").serialize(),
            beforeSend  : function() {
                addLoader();
            },
            success     : function(data) {
                window.location = path+'admin/list-approvedemployer';
            },
            error       : function(xhr, ajaxOptions, thrownError) {
                removeLoader();
                $( "#block-user-form .form-group" ).removeClass( "has-error" );
                $( ".help-block" ).hide();
                var j=0; 
                $.each( xhr.responseJSON, function( i, obj ) {
                    $( 'input[name="'+i+'"]' ).closest( '.form-group').addClass('has-error');
                    $( 'input[name="'+i+'"]' ).closest( '.form-group').find('label.help-block').slideDown(400).html(obj);
                    $( 'textarea[name="'+i+'"]' ).closest( '.form-group').addClass('has-error');
                    $( 'textarea[name="'+i+'"]' ).closest( '.form-group').find('label.help-block').slideDown(400).html(obj);

                    if( i=='reason_for_block_usr' ){
                        $('.reason_for_block_usr').addClass('has-error');
                        $('.reason_for_block_usr' ).find('label.help-block').slideDown(400).html(obj);
                    }
                });
            }  
        });
    });

    $('#unblock-user').click( function(){
        bootbox.confirm({
            message: "Are you sure to unblock this user ?",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if( result ){
                    var token = "<?php echo e(csrf_token()); ?>";
                    var id = $('#userid').val();
                    $.ajax({
                        method      : 'post',
                        url : path+'admin/unblock-employer',
                        data: $("#edit-approved-employer").serialize(),
                        beforeSend  : function() {
                            addLoader();
                        },
                        success     : function(data) {
                            window.location = path+'admin/list-approvedemployer';
                        },
                        error       : function(xhr, ajaxOptions, thrownError) {
                            removeLoader();
                            $( "#block-user-form .form-group" ).removeClass( "has-error" );
                            $( ".help-block" ).hide(); 
                        }  
                    });
                }
            }
        });
    });


    $(document).on('change', '#extra_discount', function() {
        if( $('#extra_discount').val() =='null'){
            $('#commission').val(0);
            $("#commission").attr("disabled", "disabled"); 
        } else{
            $("#commission").removeAttr("disabled"); 
        }
    });
    if( $('#extra_discount').val() =='null'){
        $('#commission').val(0);
        $("#commission").attr("disabled", "disabled"); 
    }
});
</script>

<?php $__env->stopSection(); ?> 

<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>