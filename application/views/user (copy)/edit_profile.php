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
			  <input type="text" class="form-control" name="phone" value="<?php echo $user_data['phone']; ?>" placeholder="Phone" required=""/>  
              <!-- <button id ="pr_filebtn"class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">Edit</button> -->
			  <button id ="pr_filebtn"class="btn btn-lg  btn-block"  name="submit" value="Login" type="Submit">Save</button><br> 
			  <a href="<?php echo base_url();?>car/show_car"><button class="btn btn-lg  btn-block" type="button">Cancel</button> </a>
		</form>			
	</div>
   </div>
   </section>