<?php  $serverdate = date('Y-m-d'); 
$lat = '';
$lng = '';
$startTime = '';
$endTime = '';
$id = '';
if(count($jobs)){
	$lat = $jobs->location['lat'];
	$lng = $jobs->location['lng'];
	$startTime = date('H:i',strtotime($jobs->start_date));
	$endTime = date('H:i',strtotime($jobs->end_date));
	$id = \Crypt::encrypt($jobs->_id);
}


 ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('public/employer/css/datepicker.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('public/employer/css/developer.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('public/employer/css/timepicker.css')); ?>">
<link  href="<?php echo e(asset('public/admin/css/chosen.css')); ?>" rel="stylesheet">
<link  href="<?php echo e(asset('public/employer/css/main.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
Create Job
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="white_inner_sec wow fadeInUp">
<?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo Form::model($jobs,['url'=>'employer/savejob','id'=>'addjob']); ?>

<?php echo Form::hidden('page','add'); ?>

<?php echo Form::hidden('timezone',null,['id'=>'timezone']); ?>

<?php echo Form::hidden('jobid',$id,['id'=>'timezone']); ?>

<div class="row">
<div class="col-md-4">
<div class="field_forms"><div class="label_form"><label>Job Name</label></div><div class="form_inputs"><?php echo Form::text('title',null,['Placeholder'=>'Job Name','id'=>'title']); ?><!-- <input type="text"> -->
	<span class="error_msgg" style="display:none;"></span>
</div></div>
</div>
<div class="col-md-4 col-sm-6">
<div class="field_forms"><div class="label_form"><label>Job Category</label></div>
<div class="form_inputs job_category">
<?php echo Form::select('job_category',[''=>'Please select category']+$category,null,['data-jcf'=>'{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}','class'=>'customselect subcategory']); ?>

<span class="cat_error" style="display:none;"></span>
	<span class="error_msgg" style="display:none;"></span>
</div></div>
</div>
<div class="col-md-4 col-sm-6">
<div class="field_forms"><div class="label_form"><label>Sub-Category</label></div>
<div class="form_inputs job_subcategory">
<?php echo Form::select('job_subcategory',[''=>'Please select Sub-Category']+$subcategory,null,['class'=>'customselect ','id'=>'subcategory','data-jcf'=>'{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}']); ?>

<span class="subcat_error" style="display:none;"></span>
	<span class="error_msgg" style="display:none;"></span>
</div></div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="field_forms"><div class="label_form"><label>Job Skills</label></div><div class="form_inputs skills">
	<?php echo Form::select('skills[]',[]+$skills,null,['class'=>'chosen-select skills','multiple'=>'multiple','id'=>'multiselect','data-placeholder'=>'Select some Skills']); ?>

	<span class="error_msgg" style="display:none;"></span>
	<span class="skill_error" style="display:none;"></span>
</div></div>
</div>
<div class="col-md-8">
<div class="field_forms"><div class="label_form"><label>Job Description</label></div>
<div class="form_inputs description">
<?php echo Form::textarea('description',null,['id'=>'description','id'=>'description','rows'=>5]); ?>

<span class="error_msgg" style="display:none;"></span>

</div></div>
</div>
</div>
<div class="date_time_div_post_job">
<div class="row">
<div class="col-md-6 col-xs-12 col-sm-6">
<div class="row">
<div class="col-md-6"><div class="field_forms"><div class="label_form"><label>Start Time</label></div><div class="form_inputs"><?php echo Form::text('start_date',$startTime,['id'=>'start_date','onkeydown'=>'return false']); ?>

	<span class="error_msgg" style="display:none;"></span>
</div></div></div>
<div class="col-md-6"><div class="field_forms"><div class="label_form"><label>End Time</label></div><div class="form_inputs"><?php echo Form::text('end_date',$endTime,['id'=>'end_date','onkeydown'=>'return false']); ?>

	<span class="error_msgg" style="display:none;"></span>
</div></div></div>
</div>
<div class="row">
<div class="col-md-6"><div class="field_forms"><div class="label_form"><label>Salary Per Hour</label></div><div class="form_inputs salary_div_dol">
		<div class="dolar_sign">$</div>
		<?php echo Form::text('salary_per_hour',null,['id'=>'phone_number']); ?>

	<span class="error_msgg" style="display:none;"></span>
</div></div></div>
<div class="col-md-6"><div class="field_forms"><div class="label_form"><label>Persons Required</label></div><div class="form_inputs"><?php echo Form::text('number_of_worker_required',null,['placeholder'=>'Worker Required','id'=>'number_of_worker_required']); ?>

	<span class="error_msgg" style="display:none;"></span>
</div></div></div>
</div>
<div class="row">
<div class="col-md-12"><div class="field_forms"><div class="label_form"><label>Job Address</label></div><div class="form_inputs pickLocation"><?php echo Form::text('address',null,['id'=>'location']); ?>

	<?php echo Form::hidden('lat',$lat,['id'=>'lat']); ?>

	<?php echo Form::hidden('lng',$lng,['id'=>'lng']); ?>

	<?php echo Form::hidden('key',null,['id'=>'key']); ?>

	<span class="error_msgg" style="display:none;"></span>
</div></div></div>
</div>
</div>
<div class="col-md-5 col-sm-6 col-xs-12 pull-right"><div class="calender_div"><div class="formfieldset" id="datepicker">
	
</div>
<span class="error_msgg" style="display:none;"></span>
<span for="person_required" class="error_msg errormsge" style="display:none"></span>
</div></div>
</div>
</div>
<div class="date_time_div_post_job">
	<div class="buttons">
		<button type="button" id="automatichiring" data-status="1">Automatic Hiring</button>
		<button type="button" id="manulhiring" data-status="0">Manual Hiring</button>
		<button type="button" id="rehirejob" data-status="2" data-value="<?php echo e(Crypt::encrypt(1)); ?>">Rehire Employees</button>
	</div>
</div>

<input type="hidden" name="dates" id="dates">
<input type="hidden" name="job_published_type" id="job_published_type">
<?php echo $__env->make('models.rehire',$users, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php echo Form::close(); ?>

</div>
<div class="modal fade signup forgot" id="automatic_hiring" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
       <p>Are you sure you want to post this  job <br> as <b>automatic hiring ?</b></p>
       </div>
       </div>
       </div>
       
       </div>
       
      </div>
      <div class="modal-footer signup_ftr ">
        <button type="button" id="hiring">Hire</button>
  <button type="button" class="cancel_btn close" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade signup forgot manul_hiring" id="manul_hiring" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
       <p>Are you sure you want to post this  job <br> as <b>manual hiring ?</b></p>
       </div>
       </div>
       </div>
       
       </div>
       
      </div>
      <div class="modal-footer signup_ftr ">
        <button type="button" id="mhiring">Hire</button>
  <button type="button" class="cancel_btn close" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>


<?php echo $__env->make('models.gurntte', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('models.hoursmodel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('models.rehireanothermethod', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('models.rehireuserselect', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('public/employer/js/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/employer/js/bootstrap-datepicker.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/timepicker.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/admin/js/chosen.js')); ?>" type="text/javascript"></script> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBc0Ucux0_UPErLjpzmwKqvnaD7yot5J08&amp;libraries=places">
    </script>
<script src="<?php echo e(asset('public/employer/js/jquery.geocomplete.js')); ?>" type="text/javascript"></script>  
  
<script src="<?php echo e(asset('public/employer/js/jquery.validate.min.js')); ?>" type="text/javascript"></script>    
  
<script type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/jquery.maskedinput.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/employer/js/common.js')); ?>" type="text/javascript"></script>

    <script type="text/javascript">
    
     $("#phone_number").mask("99.9");
     
     </script>
<script>
$(document).ready(function(e) {

$('.default').removeAttr( 'style' );
	$('#dates').val('');
	$('#job_published_type').val('');
	var date = new Date();
	var ser_date = "<?php echo e(date('Y-m-d',strtotime($current_date))); ?>";
	var s_date = new Date(ser_date);
	var currentMonth = date.getMonth();
	var currentDate = date.getDate();
	var currentYear = date.getFullYear();
	$('#datepicker').datepicker({
	    startDate: s_date, 
	    multidate:true,
	    changeMonth:true,
	    changeYear:true,
		endDate: new Date(currentYear, currentMonth+3, currentDate)
    }).on('changeDate', function(e){
		date_val = Array();
		
    	for(var i = 0;i<e.dates.length;i++)
    	{
    		/*alert(e.dates[i]);
    		f_date = moment(e.dates[i]).format('YYYY-MM-DD');
    		var douration = moment.duration(moment(f_date+' '+$('input[name="start_date"]').val(),'YYYY-MM-DD HH:mm').diff(moment()));
alert(douration);*/
			e.dates.sort(function(a,b)
			{
			    a = new Date(a);
			    
			    b = new Date(b);
			    return a-b;
			});
    		date_val.push(myDateFormatter(e.dates[i]));
    	}
    	if(date_val.length<=30){
      		$('span.errormsge').hide();
    	}
      	$('#dates').val(date_val);
		if(date_val.length>30){

			$('.errormsge').show();
			$('.errormsge').html('Maximum job length can be 30 days only');
		}	
    });
      	
function myDateFormatter (dateObject) {
        var d = new Date(dateObject);
        var day = d.getDate();
        var month = d.getMonth()+1;
        var year = d.getFullYear();
        if (day < 10) {
            day = "0" + day;
        }
        if (month < 10) {
            month = "0" + month;
        }
        var date = day + "-" + month + "-" + year;
        return date;
 }

  
$("#location").geocomplete({
          details: ".pickLocation",
          types: ["geocode", "establishment"],
        }).bind("geocode:result", function(event, result){
            var coor = result.geometry.location.lat();
            $('#key').val(1);
            $('.pickLocation').find('span.error_msgg').hide();  
          }).bind("blur", function(event, results){
            setTimeout(function(){
              if($('#key').val() == '')
              {
              	if($('#location').val())
              	{
	                $('.pickLocation').find('span.error_msgg').slideDown(400).html('Please specify a valid location.');
	                $('#lat').val('');
	                $('#lng').val('');
              	}
              	else
              	{
              		$('.pickLocation').find('span.error_msgg').hide();
              	}
              }
              $('#key').val('');
            },1000);
            
          });
      

var Time = new Date();
var minutesTime = 30;
var hourTime = Time.getHours();
if(Time.getMinutes() > 30)
{
	hourTime = hourTime+1;
	minutesTime = '00';
}
pickuptime =(("0" + (hourTime)).slice(-2))+':'+minutesTime;
$('#start_date').val(pickuptime);
$('#end_date').val(pickuptime);
var pick = "<?php echo e($startTime); ?>";
var drop = "<?php echo e($startTime); ?>";
if(pick != '' && drop != '')
{
	$('#start_date').val("<?php echo e($startTime); ?>");
	$('#end_date').val("<?php echo e($endTime); ?>");	
}

/*$('#start_date').timepicker({'scrollDefault': 'now','timeFormat': 'H:i','minTime': pickuptime,'maxTime':'24:00'});
$('#end_date').timepicker({'scrollDefault': 'now','timeFormat': 'H:i','minTime': pickuptime,'maxTime':'24:00'});*/
$('#start_date').timepicker({'scrollDefault': 'now','timeFormat': 'H:i'});
$('#end_date').timepicker({'scrollDefault': 'now','timeFormat': 'H:i'});

	});

$(document).on('change','#start_date',function(){
	var pair = [ ['00:00',$('#start_date').val()]]
	$('#end_date').val(($('#start_date').val()));
	//$('#end_date').timepicker({'minTime': $('#end_date').val(),'timeFormat': 'H:i','maxTime':'24:00'});
	//$('#end_date').timepicker('option',{'disableTimeRanges': pair,'timepicker':'H:i'});

	
});


$(".chosen-select").chosen();
$(document).ready(function(){
  $('#multiselect_chosen').removeAttr('style');
});



	jQuery("form#addjob").validate({
	    rules: {
	      "title":{
	         required:true 
	      },
	      "description":{
	        required:true 
	      },
	      "start_date":{
	      	required:true
	      },
	      "end_date":{
	      	required:true
	      },
	      'salary_per_hour':{
	      	required:true
	      },
	      "number_of_worker_required":{
	      	required:true
	      },
	      "address":{
	      	required:true
	      }
	    },
	    messages: {
	        "title":{
	          required:"Please specify Job Name."
	        },
	        "description":{
	          required:"Please specify Job Description."
	        },
	        "start_date":{
	          required:"Please specify start time of the job."
	        },
	        "end_date":{
	          required:"Please specify end time of the job."
	        },
	        "salary_per_hour":{
	          required:"Please specify Salary per hour of the job in dollars."
	        },
	        "number_of_worker_required":{
	          required:"Please specify number of persons required for the job."
	        },
	        "address":{
	          required:"Please specify job location for the job."
	        }
	    },
	    errorElement:'span',
	    errorClass:'error_msg errormsges',
	    submitHandler: function(form) {		
	    	$('span.error_msgg').hide();
		    	if($('#job_published_type').val()==1)	
		    		$('#automatic_hiring').modal('show');
		    	else if($('#job_published_type').val()==0)
		    		$('.manul_hiring').modal('show');
		    	else if($('#job_published_type').val()==2)
					$('#rehire_fr_job').modal('show');		    		
	    }
	});

	


$(document).on('click','#selectedUser, #hiring, #mhiring',function(){
	$('#automatic_hiring').modal('hide');
	$('.manul_hiring').modal('hide');	  

	var d1 = $('#dates').val();
	var post =0;
	var cur_date = d1.split(',')
	var CurrentDate = moment().format('DD-MM-YYYY');
	var f_date = moment(cur_date[0],'DD-MM-YYYY').format('YYYY-MM-DD');
	var douration = moment.duration(moment(f_date+' '+$('input[name="start_date"]').val(),'YYYY-MM-DD HH:mm').diff(moment()));

	var formatdata = $('form#addjob').serialize();
	var value = ''; 
	$('#rehirevalue').val('');
	if(CurrentDate==cur_date[0])
	{
		$('.rehire_fr_job').modal('hide');
		if(douration.hours()>=0 &&douration.hours()<=3){
	       $('#dur_days').val(douration.days());
	       $('#dur_hours').val(douration.hours());
	       $('#dur_cur_date').val(CurrentDate);
	       $('#dur_current_date').val(cur_date[0]);
	       $('.gurrntte').modal('show');

		}
		else
			postRequest(douration.days(),douration.hours(),CurrentDate,cur_date[0]);
	}
	else
		postRequest(douration.days(),douration.hours(),CurrentDate,cur_date[0]);
	
});

$(document).on('click','#confirm_dur_message',function(){
	 alert($('#dur_days').val());
	postRequest($('#dur_days').val(),$('#dur_hours').val(),$('#dur_cur_date').val(),$('#dur_current_date').val());
});

function postRequest(day,hours,curdate,cur_date)
{
	if($('#job_published_type').val()==2){
		if(day==0 && hours<=12){
			if(curdate==cur_date)
			{	
				if(hours<0){
					$('#rehire_fr_job').modal('hide');
					$('.hoursmodel').modal('show');
				}
				else{
					$('#rehirevalue').val($('#rehire_fr_job').attr('data-value'));
					checkUser();
				}
			}
			else{
				$('#rehirevalue').val($('#rehire_fr_job').attr('data-value'));
				checkUser();
			}
		}
		else
			postJob();

	}
	else{
		if(curdate==cur_date)
		{	
			if(hours<0){
				$('.hoursmodel').modal('show');
			}
			else
				postJob();
		}
		else
			postJob();

	}
	
}

function checkUser()
{
	var count = $("[type='checkbox']:checked").length;
	var requireuser = $('#number_of_worker_required').val();
	if(count<requireuser){
		if($("[type='checkbox']:checked").length==0){
			$('.rehireuserselect').modal('show');
		}
		else
		{
			$('.rehireanothermethod').modal('show');
			$('#rehireModal').modal('hide');
		}
	}
	else if(count>requireuser){
		$('#rehireModal').modal('hide');
		$('.rehireanothermethod').modal('show');
	}
	else
		postJob();	
}
function postJob(){
	var formatdata = $('form#addjob').serialize();
	if($('#job_published_type').val()==2)
						formatdata += $('input[name="offer"]:checked').serialize();
	$.ajax({
        url: $('form#addjob').attr('action'),
        type: 'post',
        dataType: 'json',
        data: formatdata,
        beforeSend:function(){
            Loader();
        },
        success: function(data) {
          console.log('sudccess');
          if(data.status==1)
          {
          	$('#rehireModal').modal('hide');
          	setTimeout(function(){
            	window.location.href=data.url;
          	},3000);

          }
          if(data.status==0)
          {
          	RemoveLoader() 
            window.location.reload();
          }
        },
        error: function(error) { 
          $('span.error_msg').hide();
          $('span.error_msgg').hide();
          $('.cat_error').hide();
          $('.subcat_error').hide();
          $('.skill_error').hide();
          RemoveLoader() 
          var result_errors = error.responseJSON;
          $('#rehireModal').modal('hide');
          if(result_errors)
          {

             $.each(result_errors, function(i,obj)
             {
                $('input[name='+i+']').parent('.form_inputs').find('span.error_msgg').slideDown(400).html(obj);
                if(i=='dates')
                	$('.calender_div').find('span.error_msgg').slideDown(400).html(obj);

                if(i=='job_category')
                	$('.job_category').find('span.error_msgg').slideDown(400).html(obj);

                if(i=='job_subcategory')
                	$('.job_subcategory').find('span.error_msgg').slideDown(400).html(obj);

                if(i=='skills')
                	$('.skills').find('span.error_msgg').slideDown(400).html(obj);

                if(i=='description')
                	$('.description').find('span.error_msgg').slideDown(400).html(obj);
             }) 
          }

        },
        complete: function() { //RemoveLoader() 
        }
      });
}



</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('employer.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>