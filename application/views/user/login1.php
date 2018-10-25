<section id="login">
  <div class="container">
    <div class="row">
      
        <div class="col-md-6 col-sm-6 login-wrapper">
          <div class="login-form">
           
         <?php 
          if(isset($msg) && !empty($msg)) {
            ?>
            <div class="alert alert-danger">
              <?php echo $msg; ?>
            </div>
            <?php
          }
          ?>
          <form class="user-login-form" method="post" id="login_form_valid" action="<?php echo base_url(); ?>user/login">
           
              <div class="col-sm-12 facebook-login-button">
                <div class="col-sm-12 col-sm-10 col-md-11 col-lg-10" style="padding: 0 0">
                <a class="loginBtn" href="<?php echo filter_var($fbLoginUrl, FILTER_SANITIZE_URL); ?>"><i class="fab fa-facebook-square"></i>Login with Facebook</a>
                </div>
              </div>
                <div class="col-sm-12 google-login-button">
                  <div class="col-sm-12 col-sm-10 col-md-11 col-lg-10" style="padding: 0 0">
                  <a class="loginBtn" href="<?php echo filter_var($GLoginUrl, FILTER_SANITIZE_URL); ?>"><i class="fab fa-google"></i>Login with Google</a>
                  </div>
                </div>
              <div class="col-sm-12">
              <div class="form-group">
                <label for="email">Email/Phone Number</label>
                <input type="email" class="form-control login-input" name="username" id="email">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control login-input" name="password" id="pwd">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox"> Remember me
                </label>
              </div>
            </div>
            <div class="col-sm-12">
              <p class="login-box-text">Not registered yet? <a href="<?php echo base_url(); ?>user/signup">Sign Up</a></p>
              <p class="login-box-text"><a href="#">Forgot Password?</a></p>
              <input type="submit" name="submit" class="sign-in" value="Sign-in">
            </div>

          </form>
        
        </div>

      </div>

      <div class="col-md-6 col-sm-6">
  
      </div>
    
    </div>

  </div>

</section>
<?php $this->widget->beginBlock('scripts');?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
if (window.location.hash =='#_=_')window.location.hash = '';
</script>
<script type="text/javascript">
  $("#login_form_valid").validate({
      errorClass: "error",
      rules: {
       'email':{
          required:true
        },
       'pwd': {
          required: true,
        }
      }
  });
</script>
<?php $this->widget->endBlock();?>
