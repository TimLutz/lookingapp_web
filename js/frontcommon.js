
      $(function(){
        $("#pickup").geocomplete({
           details: ".pickLocation",
           types: ["geocode", "establishment"],
        });

        $("#dropof").geocomplete()
        .bind("geocode:result", function (event, result) {                      
            $(".droplat").val(result.geometry.location.lat());
            $(".droplng").val(result.geometry.location.lng());

            //console.log(result);
        });


        /*$("#find").click(function(){
            $('.droplat').attr('name', 'drop_lat')
          $("#pickup").trigger("geocode");
        });*/
      });


    
      $(function(){
        $("#pick_location").geocomplete({
           details: ".pickLocation",
           types: ["geocode", "establishment"],
        });

        $("#drop_location").geocomplete()
        .bind("geocode:result", function (event, result) {                      
            //$(".droplat").val(result.geometry.location.lat());
            //$(".droplng").val(result.geometry.location.lng());

            //console.log(result);
        });


        /*$("#find").click(function(){
            $('.droplat').attr('name', 'drop_lat')
          $("#pickup").trigger("geocode");
        });*/
      });

      
    
      $(function(){
        $('#pick_location').change(function(){
            var droploc = $('#drop_location').val();
            var pickloc = $('#pick_location').val();
            var id = $('input[name=mode_type]:checked').val();
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
              type:'post',
              url:path+'additionalcharge',
              data : 'pickup='+pickloc+'&drop='+droploc+'&_token='+token+'&id='+id,
             // data : {'origin':pickloc,'destination':droploc},
              
              success: function(json){
              console.log(json);
             if(json.success == true)
              {
                $('#addtional_charge').val(json.amount);
                  $('#pickupdistance').val(json.pickup);
                $('#dropofdistance').val(json.dropof);
              }
              if(json.success == false)
              {
                window.reload();
              }
            },
            error : function(xhr, ajaxOptions, thrownError) {    
                  if(xhr.success == false)
                  {
                    window.reload();
                  }
                    }
            });
        });
      });
    
      $(function(){
        $('#drop_location').change(function(){
            var droploc = $('#drop_location').val();
            var pickloc = $('#pick_location').val();
            var id = $('input[name=mode_type]:checked').val();
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
              type:'post',
              url:path+'additionalcharge',
              data : 'pickup='+pickloc+'&drop='+droploc+'&_token='+token+'&id='+id,
             // data : {'origin':pickloc,'destination':droploc},
              
              success: function(json){
              console.log(json);
              if(json.success == true)
              {
                $('#addtional_charge').val(json.amount);
                $('#pickupdistance').val(json.pickup);
                $('#dropofdistance').val(json.dropof);
              }
              if(json.success == false)
              {
                window.reload();
              }
            },
            error : function(xhr, ajaxOptions, thrownError) {      
                    if(xhr.success == false)
                    {
                      window.reload();
                    }
                  }
            });
        });

        $('.changemode').click(function(){
          var modetype = $('input[name=mode_type]:checked').val();

          var droploc = $('#drop_location').val();
            var pickloc = $('#pick_location').val();
          var token = $('meta[name="csrf-token"]').attr('content');

          $.ajax({
              type:'post',
              url:path+'additionalcharge',
              data : 'pickup='+pickloc+'&drop='+droploc+'&_token='+token+'&modetype='+modetype,
             // data : {'origin':pickloc,'destination':droploc},
              
              success: function(json){
              console.log(json);
              if(json.success == true)
              {
                $('#pickupdistance').val(json.pickup);
                $('#dropofdistance').val(json.dropof);
              }
              if(json.success == false)
              {
                window.reload();
              }
            },
            error : function(xhr, ajaxOptions, thrownError) {      
                    if(xhr.success == false)
                    {
                      window.reload();
                    }
                  }
            });
        });
      });

      $('.quoteme').click(function(){
          
          var formData = {
                  pickup : $('#pickup').val(),
                  dropof : $('#dropof').val(),
                  
                  mode_typee : $('input[name=mode_typee]:checked').val(),
                  type : $(this).attr("id")
                 };
           //$('.quoteme').removeAttr('disabled');       
        //  alert(name);     
          formData._token = $('meta[name="csrf-token"]').attr('content'); 
          /*if(pickup != '' && dropof != '' && modetype != '')
          {

          }
          else
          {
            //alert('Please fill required field');
            new PNotify({
                   type: 'error',
                   title: 'Error',
                   text: 'Sorry, please field this field!!'
                   });
          }*/
          $.ajax({
                  type:'post',
                  url:path+'requestquote',
                  data : formData,
                  
                  success: function(data){
                  console.log(data);
                  if(data.success == true)
                  {
                    //setTimeout(function(){ window.location.reload(); }, 300);
                    if(data.message != '')
                    {
                      window.location = data.message;
                    }
                    else
                    {
                      window.location.reload();
                    }
                  }
                  if(data.success == false)
                  {

                    new PNotify({
                   type: 'error',
                   title: 'Error',
                   text: data.message
                   });  
                  }

                  //$('#distance').val(json);
                },
                error : function(data) {   
                       var errors = jQuery.parseJSON(data.responseText);
                 console.log(errors);
                 var error = 'Errors:';

                 $.each(errors, function(i, obj)
                 {
                    error = error+'<br>'+obj;
                 });
                PNotify.removeAll();
                new PNotify({
                    type: 'error',
                    title: 'Error',
                    text: error
                  });
                var pic = '';
                var drop = '';
                var modetype = '';
                if(errors.pickup != '' && errors.pickup != undefined)
                {
                  pic = errors.pickup;
                }

                if(errors.dropof != '' && errors.dropof != undefined)
                {
                  drop = errors.dropof;
                }
                if(errors.mode_typee != '' && errors.mode_typee != undefined)
                {
                  modetype = errors.mode_typee;
                }

                $('#pic').html(pic); 
                $('#drop').html(drop);
                $('#modetype').html(modetype);
                
                

                         }
                }); 
        });

$(document).ready(function(){
  
  $('ul.tabs li').click(function(){
    var tab_id = $(this).attr('data-tab');

    $('ul.tabs li').removeClass('current');
    $('.tab-content').removeClass('current');

    

    $(this).addClass('current');
    $("#"+tab_id).addClass('current');
    /*$("#"+tab_id).css('position':'inherit');*/
  });

});