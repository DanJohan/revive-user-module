<section id="login">
    <div class="container">
        <div class="row">
        <div class="col-md-4 col-xs-12">
          <form class="login-form" method="post" id="login_form_valid" action="<?php echo base_url(); ?>user/forgot_password">
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
                <label for="email">Email</label>
                <input type="email" class="form-control login-input" name="email" id="email" placeholder="Enter your email">
              </div>
              <p class="login-box-text">Or signin? <a href="<?php echo base_url(); ?>user/login">Sign in</a></p>
              <input type="submit" name="submit" class="sign-in" value="Send my password">
          </form>

      </div>
            <div class="col-md-8 col-xs-12">
        
            </div>
        
        </div>

    </div>

</section>
<?php $this->widget->beginBlock('scripts');?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
  $("#login_form_valid").validate({
      errorClass: "error",
      rules: {
       'email':{
          required:true,
          email:true,
        }
      }
  });
</script>
<?php $this->widget->endBlock();?>

