
<script type="text/javascript">
    $(function() {
           $("#change_pass").validate({
            rules: {
                //old_password: "required",
                new_password: {
                    required: true,
                    minlength: 5
                },
                confirm_password: {
                    equalTo: "#new_password"
                }
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            submitHandler: function(form) {
                
                var rootpath = "<?php echo ROOT_URL; ?>tests/ajax_reset_password";
                var member_id = $('#member_id').val();
                var confirm_password = $('#confirm_password').val();
                var old_password= $('#old_password').val();
                
                $.ajax({
                url: rootpath,
                type: 'POST',
                data: { member_id: member_id, confirm_password: confirm_password},
                success: function(data)
                {
                   // alert(data); return false;
                    if (data == 3) {
                        //alert('you entered a wrong password. Please try again');
                        $('#old_password').val('');
                        $('#old_pass_err').text('Old password doesnt match');
                        return false;
                    }

                    if (data == 1)
                    {
                        $(".success").fadeIn("slow");
                       
                        $('.success').delay(2000).fadeOut(200);
                        $('#old_password').val('');
                        $('#new_password').val('');
                        $('#confirm_password').val('');
                        $('#old_pass_err').text('');
                    }
                    

                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                }
            });

            }

        });
        
      });
</script>
<div id="tabs-4">
    <div class="page_title">Forgot Password</div><br>
    <span style="color: green; display: none;" id="success" class="success">New password successfully updated!</span>
            <form action="" id="change_pass" method="post" name="change_pass" class="multiform form-horizontal" onsubmit="return false;" >
                <br>
              <div class="signup_basebox">
<!--           <div class="form-group">
                <label for="old_password" class="col-sm-5 control-label">Old Password:</label>
                <div class="col-sm-4">
                    <input type="password" name="old_password" id="old_password" class="form-control"/>
                    <span style="color:#FF0000;" id="old_pass_err" class="old_pass_error"></span>
                </div>
            </div>-->
                
                <div class="form-group">
                <label for="new_password" class="col-sm-5 control-label">New Password:</label>
                <div class="col-sm-4">
                    <input type="password" name="new_password" id="new_password" class="form-control" />
                </div>
            </div>
            
                <div class="form-group">
                <label for="confirm_password" class="col-sm-5 control-label">Confirm Password:</label>
                <div class="col-sm-4">
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" />
                </div>
            </div>
                
              </div>
              <input type="hidden" name="is_change_pass"  id="is_change_pass"  value="new_pass"/>
              <input type="hidden" name="member_id"  id="member_id"  value="<?php echo $member_id;?>"/>
              <div class="signup_basebox">
                
                <div class="form-group">
                <div class="col-sm-offset-5 col-sm-4">
                  <?php echo $this->Form->submit('Save', array('class' => 'searchbtn btn', 'type' => 'submit', 'div' => false)); ?>
                </div>
              </div>
                            
              </div>
            </form>
            <?php //echo $this->Form->end();   ?>
        </div>