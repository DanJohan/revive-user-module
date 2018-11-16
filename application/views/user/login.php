<section id="login">
	<div class="container">
		<div class="row">
        <div class="col-md-4 col-xs-12">
          <form class="login-form" method="post" id="login_form_valid" action="<?php echo base_url(); ?>user/login">
            <div id="ajax-msg"></div>
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
                <span id="country_code" style="display: none;">+91</span>
                <input type="text" class="form-control login-input" name="username" id="email" autocomplete="off">
              </div>
              <div class="form-group" id="pwd_input_box">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control login-input" name="password" id="pwd">
              </div>
              <div class="form-group" id="otp_input_box" style="display: none;">
                <label for="pwd">Enter OTP:</label>
                <input type="text" class="form-control login-input" name="otp" id="otp">
              </div>
              <p class="login-box-text">Not registered yet? <a href="<?php echo base_url(); ?>user/signup">Sign Up</a></p>
             
              <p class="login-box-text"><a href="<?php echo base_url(); ?>user/forgot_password">Forgot Password?</a></p>
              <!-- <p><div id="otplogin"></div></p> -->
              <button type="button" name="otpsubmit" class="btn btn__otp" id="otpbtn" style="display: none;">Login via OTP</button>
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
  $(document).on('keyup','#email',function(e){
  var phone = $(this).val();


  if (e.keyCode >= 65 && e.keyCode <= 90){
        $('#otpbtn').hide();
      }
    
    if(phone.match(/^\d+$/)&&phone.length>2) {
      $('#country_code').show();
  
  }
    if(phone.match(/^\d+$/)&&phone.length<3) {
      $('#country_code').hide();
     
  }
  if(!phone.match(/^\d+$/)) {
      $('#country_code').hide();
  }
  if(phone.match(/^\d+$/)&&phone.length<10) {
    $('#otpbtn').hide();
    
  }else{
    $('#otpbtn').show();
    
  }
    
});

$(document).on('keydown','#email',function(e){
  var phone = $(this).val();
  //console.log(phone.length);
  //console.log(e.keyCode);

    if(phone.match(/^\d+$/)&&(phone.length==10)) {

        if((e.keyCode == 8) || (e.keyCode ==37) || (e.keyCode == 39) || (e.keyCode ==46) ) {
          return true;
        }else{
          return false;
        }
    }
    
});
  $(document).on('click','#otpbtn',function(){
    $('#login_form_valid').attr('action',config.baseUrl+'user/verifyLoginOtp');
       var phone = $('#email').val();
       $('#pwd_input_box').hide();
       
        $.ajax({
          url:config.baseUrl+"user/otplogin",
          method:"POST",
          data:{'phone':phone},
          success:function(response){
            $('ajax-msg').html('');
            if(response.status){
                $('#ajax-msg').html('<div class="alert alert-success">'+response.message+'</div>');
                $('#otpbtn').hide();
                $('#otp_input_box').show();
            }else{
              $('#ajax-msg').html('<div class="alert alert-danger">'+response.message+'</div>');
            }
            
          }
        });
     });

  </script>
 
<?php $this->widget->endBlock();?>
