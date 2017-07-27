<?php $__env->startSection('title'); ?>
    Dashboard
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'header' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make( 'sidebar' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Modal title</h4>
                        </div>
                        <div class="modal-body">
                             Widget settings form goes here
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn blue">Save changes</button>
                            <button type="button" class="btn default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
          
            <!-- BEGIN PAGE HEADER-->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="<?php echo e(url( 'admin/dashboard' )); ?>">Dashboard</a>
                    </li>
                </ul>
                
            </div>
            <h3 class="page-title">
            Dashboard
            </h3>
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS -->
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat red-intense">
                        <div class="visual">
                            <i class="fa fa-comments"></i>
                        </div>
                        <div class="details">
                           
                            <div class="number">
                                <a style=" font-size: 22px" class="number" href="<?php echo e(url( 'admin/list-waitingemployee' )); ?>">
                                    Waitlist Employees - <?php echo e($waitlist); ?>

                                </a>    
                            </div>
                        </div>
                        <a class="more" href="<?php echo e(url('admin/list-waitingemployee')); ?>">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                        </a> 
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat blue-madison">
                        <div class="visual">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <div class="details">
                             <div class="number">
                            <a style=" font-size: 21px" class="number" href="<?php echo e(url( 'admin/list-approvedemployee' )); ?>">
                                    Approved Employees - <?php echo e($approved); ?>

                            </a> 
                        </div>
                        </div>
                        <a class="more" href="<?php echo e(url('admin/list-approvedemployee')); ?>">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat red-intense">
                        <div class="visual">
                            <i class="fa fa-comments"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <a style=" font-size: 21px" class="number" href="<?php echo e(url( 'admin/list-employerwaitlist' )); ?>">
                                    Waitlist Employer - <?php echo e($waitingEmployer); ?>

                                </a>
                            </div>
                        </div>
                        <a class="more" href="<?php echo e(url('admin/list-employerwaitlist')); ?>">
                           View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat blue-madison">
                        <div class="visual">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <div class="details">
                             <div class="number">
                            <a style=" font-size: 21px" class="number" href="<?php echo e(url( 'admin/list-approvedemployer' )); ?>">
                                    Approved Employer - <?php echo e($approvedEmployer); ?>

                            </a> 
                        </div>
                        </div>
                        <a class="more" href="<?php echo e(url('admin/list-approvedemployer')); ?>">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat green-haze">
                        <div class="visual">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                 549
                            </div>
                            <div class="desc">
                                 New Orders
                            </div>
                        </div>
                        <a class="more" href="javascript:;">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat purple-plum">
                        <div class="visual">
                            <i class="fa fa-globe"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                 +89%
                            </div>
                            <div class="desc">
                                 Brand Popularity
                            </div>
                        </div>
                        <a class="more" href="javascript:;">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div> -->
            </div>
            <!-- END DASHBOARD STATS -->
            <div class="clearfix">
            </div>
        
        </div>
    </div>
</div>
<!-- END CONTAINER -->
<?php echo $__env->make( 'footer' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;