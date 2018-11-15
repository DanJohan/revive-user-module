<section id="login">
    <div class="container">
        <div class="row">
        <div class="col-md-4 col-xs-12">
          <form class="login-form" method="post" id="login_form_valid" >
         <?php 
          if(isset($msg) && !empty($msg)) {
            ?>
            <div class="alert alert-danger">
              <?php echo $msg; ?>
            </div>
            <?php
          }
          ?>
              <div class="form-group">
                <input type="hidden" id="email" name="email" value="<?php echo $email; ?>">
                <input type="hidden" id="hash" name="hash" value="<?php echo $hash; ?>">
                <label for="pwd">Password</label>
                <input type="password" class="form-control login-input" name="pwd" id="pwd" placeholder="Enter password">
                <p id="pwd-error" class="error"></p>
              </div>
              <div class="form-group">
                  <label for="confirm_pwd">Confirm password:</label>
                  <input type="password" class="form-control login-input" id="confirm_pwd" placeholder="Enter confirm password">
                  <p id="confirm-pwd-error" class="error"></p>
              </div>
              <p class="login-box-text">Or signin? <a href="<?php echo base_url(); ?>user/login">Sign in</a></p>
              <input type="submit" name="submit" class="sign-in" value="Change password">
          </form>

      </div>
            <div class="col-md-8 col-xs-12">
        
            </div>
        
        </div>

    </div>

</section>
<?php $this->widget->beginBlock('scripts');?>
<script type="text/javascript">
    $(document).on('submit','#login_form_valid',function(e){
      e.preventDefault();
      var form = $(this);
      var pwd = $('#pwd').val();
      var confirm_pwd = $("#confirm_pwd").val();
      var email = $('#email').val();
      var hash = $("#hash").val();
      var error =false;
      $("#pwd-error").text('');
      $('#confirm_pwd').text('');

      if(pwd.length>20 || pwd.length<6){
        $("#pwd-error").text("Password should be between 6 to 20 characters long");
        error = true;
      }

      if(confirm_pwd.length<=0){
        $("#confirm-pwd-error").text("Confirm password is required");
        error = true;
      }

      if(pwd != confirm_pwd){
        $("#confirm-pwd-error").text("Password doesn\'t match");
        $('#confirm_pwd').val('');
        error = true;
      }
      if(error){
        return false;
      }else{
        $.ajax({
          url:'<?php echo base_url();?>user/change_password_post',
          method:'post',
          data:{'email':email,'hash':hash,'pwd':pwd},
          success:function(response){
            if(response){
              if(response.status){
                form.prepend('<div class="alert alert-success alert-dismissible">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+response.message+'</div>');
                $('#pwd').val('');
                $('#confirm_pwd').val('');
              }else{
                form.prepend('<div class="alert alert-danger alert-dismissible">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+response.message+'</div>');
                $('#pwd').val('');
                $('#confirm_pwd').val('');
              }
            }
          }
        });
      }

    });
  </script>
<?php $this->widget->endBlock();?>

