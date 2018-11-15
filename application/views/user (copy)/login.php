<section id="login">
	<div class="container">
		<div class="row">
        <div class="col-md-4 col-xs-12">
          <form class="login-form" method="post" id="login_form_valid" action="<?php echo base_url(); ?>user/login">
         <?php 
          if(isset($msg) && !empty($msg)) {
            ?>
            <div class="alert alert-danger">
              <?php echo $msg; ?>
            </div>
            <?php
          }
          ?>
            <div class="social icon">
              <div class="facebook-login-button">
                <a class="loginBtn" href="<?php echo filter_var($fbLoginUrl, FILTER_SANITIZE_URL); ?>"><i class="fab fa-facebook-square"></i>Login with Facebook</a>
                </div>
                <div class="google-login-button">
                <a class="loginBtn" href="<?php echo filter_var($GLoginUrl, FILTER_SANITIZE_URL); ?>"><i class="fab fa-google"></i>Login with Google</a>
                </div>
              </div>
              <div class="form-group">
                <label for="email">Email/Phone Number</label>
                <input type="text" class="form-control login-input" name="username" id="email" onkeypress="return isNumberKey(event)" autocomplete="off">
              </div>
              <div class="form-group" id="pwd">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control login-input" name="password" id="pwd">
              </div>
              <div class="form-group" id="otp">
                <label for="pwd">Enter OTP:</label>
                <input type="text" class="form-control login-input" name="otp" id="otp">
              </div>
             <!--  <div class="form-group form-check">
               <label class="form-check-label">
                 <input class="form-check-input" type="checkbox"> Remember me
               </label>
             </div> -->
              <p class="login-box-text">Not registered yet? <a href="<?php echo base_url(); ?>user/signup">Sign Up</a></p>
             
              <p class="login-box-text"><a href="<?php echo base_url(); ?>user/forgot_password">Forgot Password?</a></p>
              <p><div id="otplogin"></div></p>
              <input type="submit" name="submit" class="sign-in" value="Sign-in">
          </form>

      </div>
			<div class="col-md-8 col-xs-12">
		
			</div>
		
		</div>

	</div>

</section>
<?php $this->widget->beginBlock('scripts');?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
if (window.location.hash =='#_=_')window.location.hash = '';
</script>
<script type="text/javascript">
 $("#login_form_valid").validate({
     errorClass: "error",
     rules: {
      'username':{
         required:true
       },
      'password': {
         required: true,
         minlength:6,
         maxlength:20
       }
 
     }
 });
</script>
 
  <script type="text/javascript">
    $(document).ready(function() {
     $('#otp').hide();
    });
     /*check enter text is phone or email*/
  function isNumberKey(evt){
        var txtVal = $('#email').val();
        var myLength = txtVal.length;
        var charCode = (evt.which) ? evt.which : event.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57))
          return true;
            if(myLength ==3){
                $('#email').val("+91");
                $('#otplogin').append('<button type="button" name="otpsubmit" class="btn" id="otpbtn">Login via OTP</button>');
              }
          }
  $(document).on('click','#otpbtn',function(){
       $('#pwd').hide();
       $('#otp').show();
       var phone = $('#email').val();
       //alert(phone);
        $.ajax({
          url:config.baseUrl+"user/otplogin",
          method:"POST",
          data:{'phone':phone},
          success:function(response){
            console.log();
             /*if(response.status){
                $('.alert').html(response.template);
             }*/
          }
        });
     });

  </script>
 
<?php $this->widget->endBlock();?>
