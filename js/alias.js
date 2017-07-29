$('#url').blur(function()
   {
	   addLoader();
       var formData = {
           url2: $('input[name=alias]').val().trim(),
       }

       formData._token = $('meta[name="csrf-token"]').attr('content');
       $.ajax({
           type: 'POST',
           url: path + 'admin/dashboard/url',
           data: formData,
           datatype: 'html',
           success: function(data) {
               console.log(data);
			   removeLoader();
               if (data.success == true)
               {
                   $('#link').html('<img src="' + path + '/images/caution.png">');
                   $('#url_message').html('Not Available');
                   $("#button").addClass("disabled");
               }
               else if (data.success == false)
               {
                   $('#link').html('<img src="' + path + '/images/tick.png">');
                   $('#url_message').html('Available');
                   $("#button").removeClass("disabled");
               }
           },
           error: function(data) {
               // Error...
               var errors = data.responseJSON;
               // console.log(errors);
           }

       })
   });