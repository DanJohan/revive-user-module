<section id="signup">
	<div class="container">
		<div class="row"> 
      <div class="col-xs-12">
      <div class="col-md-6 col-xs-12 reg-wrapper">
        <div class="row">
            <div class="col-xs-12">
                <form class="register-form" id="user_form_valid" method="post" action="<?php echo base_url();?>user/insert_user">
                    <div class="col-xs-12">   
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control login-input" id="name" name="name">
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control login-input" id="email" name="email">
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="form-group">
                        <label>Phone Number</label>
                        <input type="password" class="form-control login-input" id="phone" name="phone">
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control login-input" id="password" name="password">
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <p> By clicking Sign Up, I agree to the Terms of Service and Privacy Policy</p>
                      <input type="submit" name="submit" class="sign-in" value="Signup">
                    </div>
                </form>
            </div>
      </div>

      </div>
			<div class="col-md-6">
			<!-- <img class="img-fluid Login-img" src="<?php echo base_url();?>public/revive-car/assets/img/login.png"> 
 -->
			</div>
    </div>
  </div>
			
		</div>

	</div>

</section>
<?php $this->widget->beginBlock('scripts');?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
  $("#user_form_valid").validate({
      errorClass: "error",
      rules: {
        'name':{
          required:true
        },
        'email':{
          required:true
        },
        'phone': {
          required: true,
        },
        'password': {
          required: true,
          
        }
      }
  });
</script>
<?php $this->widget->endBlock();?>
