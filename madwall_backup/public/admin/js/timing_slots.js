//This file is added by Harbrinder for applying validations on datetimepicker

//1.For Timing Slot First

$("#first_start_time_slote").on("dp.hide", function (e) {
			var new_date = $('#first_start_time_slote').find("input").val();
			var pre_date= $('#first_start_time_slote_hidden').val();
			if (new_date != pre_date)
			{
			  if(new_date == '')
			  {
				  $('#first_start_time_slote').find("input").val(pre_date);
				  var first_date= pre_date;
				  var first_arr= first_date.split(' ');
				  var first_time_arr= first_arr[1].split(':');
				  var first_total = ((60*first_time_arr[0]) + parseInt(first_time_arr[1]));
				  var first_break= first_total+30;
				  var new_hr= Math.floor(first_break/60);
				  var new_minutes= Math.floor(first_break%60);
				  var end_date_made = first_arr[0]+' '+new_hr+':'+new_minutes+' '+first_arr[2];
				  $('#first_end_time_slote').find("input").val(end_date_made);
				  $('#first_end_time_slote').data("DateTimePicker").disable();
			  }
			  else
			  {
				  $('#first_start_time_slote_hidden').val(new_date);
				  $('#first_end_time_slote').data("DateTimePicker").clear();
				  var first_date= new_date;
				  var first_arr= first_date.split(' ');
				  var first_time_arr= first_arr[1].split(':');
				  var first_total = ((60*first_time_arr[0]) + parseInt(first_time_arr[1]));
				  var first_break= first_total+30;
				  var new_hr= Math.floor(first_break/60);
				  var new_minutes= Math.floor(first_break%60);
				  var end_date_made = first_arr[0]+' '+new_hr+':'+new_minutes+' '+first_arr[2];
				  $('#first_end_time_slote').find("input").val(end_date_made);
				  $('#first_end_time_slote').data("DateTimePicker").disable();

			  }
			}
			else
			{
			  $('#first_start_time_slote').find("input").val(pre_date);
			  var first_date= pre_date;
		      var first_arr= first_date.split(' ');
			  var first_time_arr= first_arr[1].split(':');
			  var first_total = ((60*first_time_arr[0]) + parseInt(first_time_arr[1]));
			  var first_break= first_total+30;
			  var new_hr= Math.floor(first_break/60);
			  var new_minutes= Math.floor(first_break%60);
			  var end_date_made = first_arr[0]+' '+new_hr+':'+new_minutes+' '+first_arr[2];
		      $('#first_end_time_slote').find("input").val(end_date_made);
		      $('#first_end_time_slote').data("DateTimePicker").disable();

			}
			var first_date=$('#first_start_time_slote_hidden').val();
			var first_arr= first_date.split(' ');
			var first_time_arr= first_arr[1].split(':');
			var first_total = ((60*first_time_arr[0]) + parseInt(first_time_arr[1]));
			var second_date= $('#second_start_time_slote_hidden').val();
			var third_date= $('#third_start_time_slote_hidden').val();
			if(second_date!='')
			{
				var second_arr= second_date.split(' ');
				var second_time_arr= second_arr[1].split(':');
				var second_total = ((60*second_time_arr[0]) + parseInt(second_time_arr[1]));
			    if(((first_total<=second_total && (first_total+30)>=second_total) || (first_total>=second_total && first_total<=(second_total+30)) ) && second_arr[0] === first_arr[0] && second_arr[2] === first_arr[2]) 
			    {
					bootbox.alert("You cannot select two similar timeslots");
					$('#first_start_time_slote').data("DateTimePicker").clear();
					$('#first_end_time_slote').data("DateTimePicker").clear();
					$('#first_start_time_slote_hidden').val('');
					$('#first_end_time_slote').data("DateTimePicker").disable();
			    }
			}
			if(third_date!='')
			{
				var third_arr= third_date.split(' ');
				var third_time_arr= third_arr[1].split(':');
				var third_total = ((60*third_time_arr[0]) + parseInt(third_time_arr[1]));
			    if((((first_total<=third_total && (first_total+30)>=third_total) || (first_total>=third_total && first_total<=(third_total+30)))) && third_arr[0] === first_arr[0] && third_arr[2] === first_arr[2])
			    {
					bootbox.alert("You cannot select two similar timeslots");
					$('#first_start_time_slote').data("DateTimePicker").clear();
					$('#first_end_time_slote').data("DateTimePicker").clear();
					$('#first_start_time_slote_hidden').val('');
					$('#first_end_time_slote').data("DateTimePicker").disable();
			    }
			}
	});
	
	//When hide the end timing datetimepicker do follwing
	$("#first_end_time_slote").on("dp.hide", function (e) {
			var new_date = $('#first_end_time_slote').find("input").val();
			var pre_date= $('#first_end_time_slote_hidden').val();
			if (new_date != pre_date)
			{
			  if(new_date == '')
			  {
				$('#first_end_time_slote').find("input").val(pre_date);
			  }
			  else
			  {
				  $('#first_end_time_slote_hidden').val(new_date);
			  }
			}
			else
			{
		      $('#first_end_time_slote').find("input").val(pre_date);
			}
	});
		//code to open datetimepicker second time
		$("#first_end_time_slote").click(function(){
			$('#first_end_time_slote').data("DateTimePicker").clear();
			 $('#first_end_time_slote').datetimepicker("show");
		});
			
	    $("#first_start_time_slote").click(function(){
			$('#first_start_time_slote').data("DateTimePicker").clear();
			$('#first_start_time_slote').datetimepicker("show");
		});
		
		
      	
      	

      //On change of datetimepicker	
      	$(function () {
			$('#first_start_time_slote').datetimepicker({
				useCurrent: false,
                showClose: true,
                minDate : moment(),
            });
        $('#first_end_time_slote').datetimepicker({
                showClose: true,
                disable: true
                 
            });
           
          $("#first_start_time_slote").on("dp.change", function (e) {
				var pre_date = $('#first_start_time_slote').find("input").val();
				//$('#first_end_time_slote').data("DateTimePicker").enable();
				$('#first_end_time_slote').data("DateTimePicker").enabledDates([moment(pre_date)]);
				if($('#first_start_time_slote_hidden').val()== '')
                {
					$('#first_start_time_slote_hidden').val(pre_date);
				}
            });
            $("#first_end_time_slote").on("dp.show", function (e) {
				var pre_date = $('#first_start_time_slote').find("input").val();
                 $('#first_end_time_slote').data("DateTimePicker").minDate(moment(pre_date).add(30,"m"));
            });
        });

//Code for First Time Slot Ends Here


//2.For Timing Slot Second

$("#second_start_time_slote").on("dp.hide", function (e) {
			var new_date = $('#second_start_time_slote').find("input").val();
			var pre_date= $('#second_start_time_slote_hidden').val();
			if (new_date != pre_date)
			{
			  if(new_date == '')
			  {
				  $('#second_start_time_slote').find("input").val(pre_date);
				  var first_date= pre_date;
				  var first_arr= first_date.split(' ');
				  var first_time_arr= first_arr[1].split(':');
				  var first_total = ((60*first_time_arr[0]) + parseInt(first_time_arr[1]));
				  var first_break= first_total+30;
				  var new_hr= Math.floor(first_break/60);
				  var new_minutes= Math.floor(first_break%60);
				  var end_date_made = first_arr[0]+' '+new_hr+':'+new_minutes+' '+first_arr[2];
				  $('#second_end_time_slote').find("input").val(end_date_made);
				  $('#second_end_time_slote').data("DateTimePicker").disable();
				
			  }
			  else
			  {
				  $('#second_start_time_slote_hidden').val(new_date);
				  $('#second_end_time_slote').data("DateTimePicker").clear();
				  var first_date= new_date;
				  var first_arr= first_date.split(' ');
				  var first_time_arr= first_arr[1].split(':');
				  var first_total = ((60*first_time_arr[0]) + parseInt(first_time_arr[1]));
				  var first_break= first_total+30;
				  var new_hr= Math.floor(first_break/60);
				  var new_minutes= Math.floor(first_break%60);
				  var end_date_made = first_arr[0]+' '+new_hr+':'+new_minutes+' '+first_arr[2];
				  $('#second_end_time_slote').find("input").val(end_date_made);
				  $('#second_end_time_slote').data("DateTimePicker").disable();
			  }
			}
			else
			{
		          $('#second_start_time_slote').find("input").val(pre_date);
		          var first_date= pre_date;
				  var first_arr= first_date.split(' ');
				  var first_time_arr= first_arr[1].split(':');
				  var first_total = ((60*first_time_arr[0]) + parseInt(first_time_arr[1]));
				  var first_break= first_total+30;
				  var new_hr= Math.floor(first_break/60);
				  var new_minutes= Math.floor(first_break%60);
				  var end_date_made = first_arr[0]+' '+new_hr+':'+new_minutes+' '+first_arr[2];
				  $('#second_end_time_slote').find("input").val(end_date_made);
				  $('#second_end_time_slote').data("DateTimePicker").disable();
			}
			var second_date=$('#second_start_time_slote_hidden').val();
			var second_arr= second_date.split(' ');
			var second_time_arr= second_arr[1].split(':');
			var second_total = ((60*second_time_arr[0]) + parseInt(second_time_arr[1]));
			var first_date= $('#first_start_time_slote_hidden').val();
			var third_date= $('#third_start_time_slote_hidden').val();
			if(first_date!='')
			{
				var first_arr= first_date.split(' ');
				var first_time_arr= first_arr[1].split(':');
				var first_total = ((60*first_time_arr[0]) + parseInt(first_time_arr[1]));
			    if(((second_total<=first_total && (second_total+30)>=first_total) || (second_total>=first_total && second_total<=(first_total+30))) && second_arr[0] === first_arr[0] && second_arr[2] === first_arr[2])
			    {
					bootbox.alert("You cannot select two similar timeslots");
					$('#second_start_time_slote').data("DateTimePicker").clear();
					$('#second_end_time_slote').data("DateTimePicker").clear();
					$('#second_start_time_slote_hidden').val('');
					$('#second_end_time_slote').data("DateTimePicker").disable();
			    }
			}
			if(third_date!='')
			{
				var third_arr= third_date.split(' ');
				var third_time_arr= third_arr[1].split(':');
				var third_total = ((60*third_time_arr[0]) + parseInt(third_time_arr[1]));
			    if((((second_total<=third_total && (second_total+30)>=third_total) || (second_total>=third_total && second_total<=(third_total+30))) ) && second_arr[0] === third_arr[0] && second_arr[2] === third_arr[2])
			    {
					bootbox.alert("You cannot select two similar timeslots");
					$('#second_start_time_slote').data("DateTimePicker").clear();
					$('#second_end_time_slote').data("DateTimePicker").clear();
					$('#second_start_time_slote_hidden').val('');
					$('#second_end_time_slote').data("DateTimePicker").disable();
			    }
			}
	});
	
	//When hide the end timing datetimepicker do follwing
	$("#second_end_time_slote").on("dp.hide", function (e) {
			var new_date = $('#second_end_time_slote').find("input").val();
			var pre_date= $('#second_end_time_slote_hidden').val();
			if (new_date != pre_date)
			{
			  if(new_date == '')
			  {
				$('#second_end_time_slote').find("input").val(pre_date);
			  }
			  else
			  {
				  $('#second_end_time_slote_hidden').val(new_date);
			  }
			}
			else
			{
		      $('#second_end_time_slote').find("input").val(pre_date);
			}
	});
		//code to open datetimepicker second time
		$("#second_end_time_slote").click(function(){
			$('#second_end_time_slote').data("DateTimePicker").clear();
			 $('#second_end_time_slote').datetimepicker("show");
		});
			
			
	    //when we click to open datetimepicker
      	$("#second_start_time_slote").click(function(){
			$('#second_start_time_slote').data("DateTimePicker").clear();
			 $('#second_start_time_slote').datetimepicker("show");
		});
      	
      	
      	
      //On change of datetimepicker	
      	$(function () {
			$('#second_start_time_slote').datetimepicker({
				useCurrent: false,
                showClose: true,
                minDate : moment(),
            });
        $('#second_end_time_slote').datetimepicker({
                showClose: true,
                disable: true
                 
            });
           
          $("#second_start_time_slote").on("dp.change", function (e) {
				var pre_date = $('#second_start_time_slote').find("input").val();
				$('#second_end_time_slote').data("DateTimePicker").enable();
				$('#second_end_time_slote').data("DateTimePicker").enabledDates([moment(pre_date)]);
				if($('#second_start_time_slote_hidden').val()== '')
                {
					$('#second_start_time_slote_hidden').val(pre_date);
				}
            });
            $("#second_end_time_slote").on("dp.show", function (e) {
				var pre_date = $('#second_start_time_slote').find("input").val();
                 $('#second_end_time_slote').data("DateTimePicker").minDate(moment(pre_date).add(30,"m"));
            });
        });

//Code for Second Time Slot Ends Here

//3.For Timing Slot Third

$("#third_start_time_slote").on("dp.hide", function (e) {
			var new_date = $('#third_start_time_slote').find("input").val();
			var pre_date= $('#third_start_time_slote_hidden').val();
			if (new_date != pre_date)
			{
			  if(new_date == '')
			  {
				  $('#third_start_time_slote').find("input").val(pre_date);
				  var first_date= pre_date;
				  var first_arr= first_date.split(' ');
				  var first_time_arr= first_arr[1].split(':');
				  var first_total = ((60*first_time_arr[0]) + parseInt(first_time_arr[1]));
				  var first_break= first_total+30;
				  var new_hr= Math.floor(first_break/60);
				  var new_minutes= Math.floor(first_break%60);
				  var end_date_made = first_arr[0]+' '+new_hr+':'+new_minutes+' '+first_arr[2];
				  $('#third_end_time_slote').find("input").val(end_date_made);
				  $('#third_end_time_slote').data("DateTimePicker").disable(); 
			  }
			  else
			  {
				  $('#third_start_time_slote_hidden').val(new_date);
				  $('#third_end_time_slote').data("DateTimePicker").clear();
				  var first_date= new_date;
				  var first_arr= first_date.split(' ');
				  var first_time_arr= first_arr[1].split(':');
				  var first_total = ((60*first_time_arr[0]) + parseInt(first_time_arr[1]));
				  var first_break= first_total+30;
				  var new_hr= Math.floor(first_break/60);
				  var new_minutes= Math.floor(first_break%60);
				  var end_date_made = first_arr[0]+' '+new_hr+':'+new_minutes+' '+first_arr[2];
				  $('#third_end_time_slote').find("input").val(end_date_made);
				  $('#third_end_time_slote').data("DateTimePicker").disable(); 
			  }
			}
			else
			{
		          $('#third_start_time_slote').find("input").val(pre_date);
		          var first_date= pre_date;
				  var first_arr= first_date.split(' ');
				  var first_time_arr= first_arr[1].split(':');
				  var first_total = ((60*first_time_arr[0]) + parseInt(first_time_arr[1]));
				  var first_break= first_total+30;
				  var new_hr= Math.floor(first_break/60);
				  var new_minutes= Math.floor(first_break%60);
				  var end_date_made = first_arr[0]+' '+new_hr+':'+new_minutes+' '+first_arr[2];
				  $('#third_end_time_slote').find("input").val(end_date_made);
				  $('#third_end_time_slote').data("DateTimePicker").disable(); 
			}
			var third_date=$('#third_start_time_slote_hidden').val();
			var third_arr= third_date.split(' ');
			var third_time_arr= third_arr[1].split(':');
			var third_total = ((60*third_time_arr[0]) + parseInt(third_time_arr[1]));
			var first_date= $('#first_start_time_slote_hidden').val();
			var second_date= $('#second_start_time_slote_hidden').val();
			if(first_date!='')
			{
				var first_arr= first_date.split(' ');
				var first_time_arr= first_arr[1].split(':');
				var first_total = ((60*first_time_arr[0]) + parseInt(first_time_arr[1]));
			    if((((third_total<=first_total && (third_total+30)>=first_total) || (third_total>=first_total && third_total<=(first_total+30))) ) && third_arr[0] === first_arr[0] && third_arr[2] === first_arr[2])
			    {
					bootbox.alert("You cannot select two similar timeslots");
					$('#third_start_time_slote').data("DateTimePicker").clear();
					$('#third_end_time_slote').data("DateTimePicker").clear();
					$('#third_start_time_slote_hidden').val('');
					$('#third_end_time_slote').data("DateTimePicker").disable();
			    }
			}
			if(second_date!='')
			{
				var second_arr= second_date.split(' ');
				var second_time_arr= second_arr[1].split(':');
				var second_total = ((60*second_time_arr[0]) + parseInt(second_time_arr[1]));
			    if((((third_total<=second_total && (third_total+30)>=second_total) || (third_total>=second_total && third_total<=(second_total+30)))) && second_arr[0] === third_arr[0] && second_arr[2] === third_arr[2])
			    {
					bootbox.alert("You cannot select two similar timeslots");
					$('#third_start_time_slote').data("DateTimePicker").clear();
					$('#third_end_time_slote').data("DateTimePicker").clear();
					$('#third_start_time_slote_hidden').val('');
					$('#third_end_time_slote').data("DateTimePicker").disable();
			    }
			}
	});
			
    //When hide the end timing datetimepicker do follwing
	$("#third_end_time_slote").on("dp.hide", function (e) {
			var new_date = $('#third_end_time_slote').find("input").val();
			var pre_date= $('#third_end_time_slote_hidden').val();
			if (new_date != pre_date)
			{
			  if(new_date == '')
			  {
				$('#third_end_time_slote').find("input").val(pre_date);
			  }
			  else
			  {
				  $('#third_end_time_slote_hidden').val(new_date);
			  }
			}
			else
			{
		      $('#third_end_time_slote').find("input").val(pre_date);
			}
	});
	
	//code to open datetimepicker second time
		$("#third_end_time_slote").click(function(){
			$('#third_end_time_slote').data("DateTimePicker").clear();
			 $('#third_end_time_slote').datetimepicker("show");
		});
		
		$("#third_start_time_slote").click(function(){
			$('#third_start_time_slote').data("DateTimePicker").clear();
			 $('#third_start_time_slote').datetimepicker("show");
		});
      	
      	
      	
      //On change of datetimepicker	
      	$(function () {
			$('#third_start_time_slote').datetimepicker({
				useCurrent: false,
                showClose: true,
                minDate : moment(),
            });
        $('#third_end_time_slote').datetimepicker({
                showClose: true,
                disable: true
                 
            });
           
          $("#third_start_time_slote").on("dp.change", function (e) {
				var pre_date = $('#third_start_time_slote').find("input").val();
				$('#third_end_time_slote').data("DateTimePicker").enable();
				$('#third_end_time_slote').data("DateTimePicker").enabledDates([moment(pre_date)]);
				if($('#third_start_time_slote_hidden').val()== '')
                {
					$('#third_start_time_slote_hidden').val(pre_date);
				}
            });
            $("#third_end_time_slote").on("dp.show", function (e) {
				var pre_date = $('#third_start_time_slote').find("input").val();
                 $('#third_end_time_slote').data("DateTimePicker").minDate(moment(pre_date).add(30,"m"));
            });
        });

//Code for Third Time Slot Ends Here

//make a json of all time-slots

