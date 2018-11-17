 <section class="pri__file_page">
    <div class = "container">
	<div class="wrapper">
	  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
       <form action="<?php echo base_url();?>user/update_profile" method="post" name="Login_Form" class="form-signin"> 
	         <!--   <span class="ed_it12"><img src="assets/img/edit23.png"></span>	 -->
              <span class="user_profile"><img src="<?php echo base_url();?>assets/img/admin_pro3.png"></span>		
              <input type="hidden" class="form-control" name="id" value="<?php echo $user_data['id']; ?>">
		      <input type="text" class="form-control" name="name" value="<?php echo $user_data['name']; ?>" placeholder="Name" required="" autofocus="" />
			  <input type="text" class="form-control" name="email" value="<?php echo $user_data['email']; ?>" placeholder="Email" required="" autofocus="" />
			  <span class="phnno" id="country_code" style="display: none; position: relative;top: 15px;z-index: 9999999999;left: 4px;" ><img src="<?php echo base_url();?>/assets/img/flag.png">&nbsp;+91</span>
			  <input type="text" class="form-control" id= "phone" name="phone" value="<?php echo $user_data['phone']; ?>" placeholder="Phone">  
             <span id="errmsg" style="color: red;"></span>

			  <button id ="pr_filebtn"class="btn btn-lg  btn-block"  name="submit" value="Login" type="Submit">Save</button><br> 
			  <a href="<?php echo base_url();?>car/show_car"><button class="btn btn-lg  btn-block" type="button">Cancel</button> </a>
		</form>			
	</div>
   </div>
   </section>
   <?php $this->widget->beginBlock('scripts');?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
      $('#phone').css('padding-left','73px');
      $('#phone').css('margin-top','-20px');
      $('#phone').css('padding-top','5px');
  }
  if(phone.match(/^\d+$/)&&phone.length<=2) {
      $('#country_code').show();
      $('#phone').css('padding-left','73px');
      $('#phone').css('margin-top','0px');
      $('#phone').css('padding-top','5px');
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
