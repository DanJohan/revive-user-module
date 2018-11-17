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
                        <input type="text" class="form-control login-input" id="name" name="name" >
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
                        <label>Phone Number</label><br>
                         <span class="phnno" id="country_code" style="display: none; position: relative;top: 23px;z-index: 9999999999;left: 4px;" ><img src="<?php echo base_url();?>/assets/img/flag.png">&nbsp;+91</span>
                        <input type="text" class="form-control login-input" id="phone" name="phone"> <span id="errmsg" style="color: red;"></span>
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
                    <div class="col-xs-12">
                      <div class="text-center">Or</div>
                      <hr>
                      <div class="text-center"><a href="<?php echo base_url();?>user/login">Sign in</a></div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
  $("#user_form_valid").validate({
      errorClass: "error",
      rules: {
        'name':{
          required:true
        },
        'email':{
          required:true,
          email:true
        },
        'phone': {
          required: true,
         // number:true,
          minlength:10,
          maxlength:13
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
  $(document).ready(function () {
  //called when key is pressed in textbox
  $("#phone").keypress(function (e) {
  if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
  });
});
  $(document).on('keyup','#phone',function(e){   
    var phone = $(this).val();
      
    if(phone.match(/^\d+$/)&&phone.length>2) {
      $('#country_code').show();
      $('#phone').css('margin-top','-15px');
      $('#phone').css('padding-left','73px');
      $('#phone').css('padding-top','7px');
    }
    if(phone.match(/^\d+$/)&&phone.length<=2) {
      $('#country_code').show();
      $('#phone').css('margin-top','0px');
      $('#phone').css('padding-left','73px');
      $('#phone').css('padding-top','7px');
    }

    if(phone.match(/^\d+$/)&&phone.length<3) {
      $('#country_code').hide();
      $('#phone').css('padding-left','10px');
    }
    if(phone.match(/^\d+$/)&&phone.length<3) {
      $('#country_code').hide();
    }
 
});

$(document).on('keydown','#phone',function(e){
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
</script>

<?php $this->widget->endBlock();?>
