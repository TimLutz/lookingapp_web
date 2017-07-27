<?php  

//date_default_timezone_set($_COOKIE['client_timezone']);
$job_detail = getDates($job_post->jobshifts);

/*$start= (string)$job_post->start_date;
$utcdatetime = new \MongoDB\BSON\UTCDateTime($start); 
$datetime  = $utcdatetime->toDateTime();
$start_date = $datetime->format('Y-m-d H:i:s');
$end= (string)$job_post->end_date;
$utcdatetime1 = new \MongoDB\BSON\UTCDateTime($end); 
$datetime1  = $utcdatetime1->toDateTime();
$end_date = $datetime1->format('Y-m-d H:i:s');*/
$start_date = date('Y-m-d H:i:s',strtotime($job_post->start_date));
$end_date = date('Y-m-d',strtotime($job_post->end_date));
$shiftsData = [];
function getDates($dates)
{
    $data = '';
    foreach($dates AS $k => $row)
    {
    	/*$time= (string)$row['start_date'];
		$utcdatetime2 = new \MongoDB\BSON\UTCDateTime($time); 
		$datetime2  = $utcdatetime2->toDateTime();
		$dates1 = $datetime2->format('Y-m-d H:i:s');*/
        $data[] = date('Y-m-d H:i:s',strtotime($row['start_date'])); 
    }
    return $data;
}


$jobId = Crypt::encrypt($job_post->_id);
foreach($job_post->jobshifts AS $k => $row){
	$shiftsData[] = ['start_date'=>date('h:i A',strtotime($row['start_date'])),'end_date'=>date('h:i A',strtotime($row['end_date']))];
}

 ?>

<?php 
//print_r($shiftsData); die;
 ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('public/employer/css/datepicker.css')); ?>">
<link  href="<?php echo e(asset('public/employer/css/main.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
Job Detail
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
</span><!-- <div class="text_job"> --><b><?php echo e($job_post->address); ?></b><!-- </div> --></div>
<div class="clearfix"></div>
<div class="location_sec"><span><i class="fa fa-clock-o" aria-hidden="true"></i>
</span><div class="text_job"><b>
<?php 
$shift = current($shiftsData)
 ?>
<?php echo e($shift['start_date']); ?> - <?php echo e($shift['end_date']); ?>


</b></div></div>
<div class="location_sec"><div class="text_job"><!-- Number of  persons -->No of persons required: - <b><?php echo e($job_post->number_of_worker_required); ?></b></div></div>
<div class="clearfix"></div>
<div class="location_sec"><div class="text_job">Category - <b><?php echo e(ucwords($job_post->category[0]['name'])); ?></b></div></div>
<div class="location_sec"><div class="text_job">Sub-Category - <b><?php echo e(ucwords($job_post->subcategory[0]['name'])); ?></b></div></div>


<div class="location_sec width_100"><div class="text_job">Skills - </div>
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
<div class="calender_div"><div class="formfieldset" id="datepicker"></div></div>
</div>
</div>

<div class="job_detail_table">

<div class="row">
<?php echo Form::open(['url'=>'employer/jobdetail/jobapplylisting','id'=>'filter_form']); ?>

<?php echo Form::hidden('jobvalue',$jobId); ?>

<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
<div class="number_list">
		<div class="msg"></div>

<!--<?php echo Form::select('records',[''=>'Dispaly Records',10=>10,15=>15,20=>20,30=>30,40=>40,null,['class'=>' customselect selectrecords','data-jcf'=>'{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}']]); ?>-->
</div>
</div>
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
<div class="jobdetailsearch"><div class="search_input"><!-- <input placeholder="Search by Job name" type="text"> --><?php echo Form::text('job_name',null,['placeholder'=>'Search by Candidate name','id'=>'job_name']); ?><span><i class="fa fa-search search" aria-hidden="true"></i>
</span></div>
	
</div>

<div class="pull-right">
	<?php echo Form::select('records',[10=>10,15=>15,20=>20,30=>30,40=>40],null,['class'=>'customselect selectrecords','data-jcf'=>'{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}']); ?>

</div>


</div>

	

<?php echo Form::close(); ?>

</div>

<div class="table_job_detail jobdata">
</div>
</div>

<div class="buttons">

<?php if(($job_post->total_hired>0) || ($current_date>=$start_date)): ?>
<a href="javascript:void(0);" class="jobedit">No edit job</a>
<?php else: ?>
	<a href="<?php echo e(url('employer/editjob/'.$jobId)); ?>" class="jobedit">Edit job</a>
<?php endif; ?>

<!--<button type="button" data-job="<?php echo e($jobId); ?>" class="jobedit">Edit job</button>-->
<button type="button" class="delete jobdelete" data-job="<?php echo e($jobId); ?>">Delete job</button>

</div>
</div>

<div class="modal fade signup forgot" id="deletejob" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
       <p>Are you sure you want to delete this job ?</p>
       </div>
       </div>
       </div>
       
       </div>
       
      </div>
      <div class="modal-footer signup_ftr ">
        <button type="button" id="deletejobs">Delete</button>
        <br>
        <br>
  <button type="button" class="cancel_btn close" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
 
<?php 	
$datepicker_date = implode(',', $job_detail); 

 ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('public/employer/js/moment.min.js')); ?>"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo e(asset('public/employer/js/bootstrap-datepicker.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/path.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/loader.js')); ?>" type="text/javascript"></script> 
<script src="<?php echo e(asset('public/employer/js/bootbox.min.js')); ?>" type="text/javascript"></script>   
<script>
/*$(document).ready(function(e) {
	
	$('#datepicker').datepicker({
		maxViewMode: 0,
   
});
		});*/
		
var rateArray = "<?php echo $datepicker_date ?>";

 var d = rateArray.split(',');
 
 var manualDates = [];
 for(i = 0; i<d.length; i++)
 {
 	manualDates.push(new Date(d[i]));
 }

$(document).ready(function () {
    $("#datepicker").datepicker(
      	'setDate',manualDates,
      	);
	var url = $('#filter_form').attr('action');
    listjobApply(url);
});



$(document).on('click', '.pagination a', function (e) 
	 {
		e.preventDefault();
		
		var url=$(this).attr('href');
		listjobApply(url);
	 });

$(document).on('click','.jobdelete',function(){
	$('#deletejob').modal('show');
});

$(document).on('click','#deletejobs',function(){
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		url:path+'employer/deletejob',
		type:'post',
		data:'value='+$('.jobdelete').data('job')+'&_token='+CSRF_TOKEN,
		dataType:'json',
		beforeSend:function(){
			Loader();
		},
		success:function(data){
			if(data.status)
				window.location.href=data.url;
		},
		error:function(errors){
			console.log(errors);
		},
		complete:function(){
			RemoveLoader();
		}
	});
});

function listjobApply(url)
{
	var record =  '';
		if($('.selectrecords').val()!='' && $('.selectrecords').val() != undefined)
		{
			record = $('.selectrecords').val();
		}
		var filter_data = $('#filter_form').serialize();
		Loader();
		$.ajax({
					type : 'post',
					url : url,
					data : filter_data,
					dataType : 'html',
					beforesend:function(){
						Loader();
					},
					success : function(data){
						RemoveLoader();
						$('.jobdata').empty().html(data);
						$('.msg').html($('#message').val());
					},
					error : function(data,ajaxOptions, thrownError){
						RemoveLoader();

						var errors = jQuery.parseJSON(data.responseText);
						if(errors.success==false){
							new PNotify({
								type: 'error',
								title: Error,
								text: 'Something went wrong!!!'
							});
						}
						
					}
				});
}

$(document).on('click','.accept, .declined',function(){
var type = $(this).attr('data-type');
var apply= $(this).attr('data-apply_value');
	bootbox.confirm($(this).data('confirm-message'),function(result){ 
    	if(result)
    	{
		    $.ajax({
	            url: path+"employer/acceptreject",
	            type: 'post',
	            dataType: 'json',
	            data: '_token='+$('meta[name="csrf-token"]').attr('content')+'&apply_value='+apply+"&status="+type,
	            beforeSend:function(){
	                Loader();
	            },
	            success: function(data) {
	                window.location.reload();
	              	RemoveLoader() ;
	            },
	            error: function(error) { 
	            	RemoveLoader() ;
	            },
	            complete: function() { //RemoveLoader() 
	            }
          });
		}
	});
});

</script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
  <script type="text/javascript">
$(document).ready(function(){
	var token = $('meta[name="csrf-token"]').attr('content');
	Loader();
	var jobId = "<?php echo e(Crypt::encrypt($job_post->_id)); ?>";
	$.ajax({
		type     : 'POST',
		url		:	path+'employer/jobs-users',
		data		:	{'_token':token,'jobId':jobId},
		datatype : 'json',
		success : function(data) 
		{
			RemoveLoader();
			 $("#job_name").autocomplete({
				source: data.location
			});
		},
		error: function(data) {
			RemoveLoader();
		}
	});	

});
$(document).on('click','.search',function(){
	listjobApply($('#filter_form').attr('action'));
});

$(document).on('change','.selectrecords',function(){
		var url = $('#filter_form').attr('action');
		listjobApply(url);
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('employer.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>