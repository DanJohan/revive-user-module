<nav class="navbar navbar-expand-lg bg-white navbar-light fixed-top navbarbg-margin"data-bg-color="#fff">
  <div class="container"> <a class="navbar-brand" href="<?php echo base_url();?>"> <img class="img-fluid logo" src="<?php echo base_url();?>assets/img/logo.png" alt=""> </a> 
    <!--end navbar-brand-->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
    <!--end navbar-toggler-->
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ml-auto"> <a class="nav-item nav-link ts-scroll active" href="<?php echo base_url()."site/index"?>">Home <span class="sr-only">(current)</span></a> 
          <a class="nav-item nav-link ts-scroll" href="<?php echo base_url();?>#about-us"">About us</a> 
          <!-- <a class="nav-item nav-link ts-scroll" href="#services">Services</a> -->
          
         <li class="nav-item dropdown"> <a class="nav-item nav-link ts-scroll nav-link dropdown-toggle" href="#" id="services" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Services</a>
            <div class="dropdown-menu dp-clr" aria-labelledby="dropdown01"> 
            <a class="dropdown-item drp-clr" href="<?php echo base_url();?>service/select_service/1">Dent Repair Jobs</a>
             <a class="dropdown-item drp-clr" href="<?php echo base_url();?>service/select_service/2">Paint Repair Jobs</a>
              <a class="dropdown-item drp-clr" href="<?php echo base_url();?>service/select_service/3">Full Body Car Paint</a> 
              <a class="dropdown-item drp-clr" href="<?php echo base_url();?>service/select_service/4"> Exterior Customisations</a>
               <a class="dropdown-item drp-clr" href="<?php echo base_url();?>service/select_service/5">Interior Customisations</a>
              </div>
          </li>
          <a class="nav-item nav-link ts-scroll" href="<?php echo base_url();?>#gallery">Gallery</a>
          <a class="nav-item nav-link ts-scroll" href="<?php echo base_url();?>#FAQs">FAQs</a>
          <a class="nav-item nav-link ts-scroll" href="javascript:void(0);">Contact us</a>
          <?php if(($this->router->fetch_class() != 'service' && $this->router->fetch_method() != 'add_more_service') || ($this->router->fetch_class() == 'service' && $this->router->fetch_method() == 'find_service')){ ?>
             <?php
            $cart_count =$GLOBALS['cart_count'];
          ?> 
          <a href="<?php echo base_url(); ?>cart/checkout" id="cart-count" class="nav-item nav-link ts-scroll btn btn-primary btn-sm text-white ml-3 px-3 ts-width__auto down-btn">Cart<?php echo ($cart_count) ? '('.$cart_count.')':''; ?></a>
           <?php //$this->load->view('common/car_modal'); ?>
          <a class="nav-item nav-link ts-scroll btn btn-primary btn-sm text-white ml-3 px-3 ts-width__auto down-btn" href="<?php echo base_url();?>cart/checkout">Checkout</a>
        <?php }?>
          <?php 
           
           if($this->router->fetch_class() == 'service' && $this->router->fetch_method() == 'add_more_service'){//$cart_count =$GLOBALS['cart_count']; 
            ?>
            <a href="<?php echo base_url(); ?>cart/modify_order/<?php echo $this->input->get('hash'); ?>" id="cart-count" class="nav-item nav-link ts-scroll btn btn-primary btn-sm text-white ml-3 px-3 ts-width__auto down-btn">View Order<?php echo (count($order_items)) ? '('.count($order_items).')':''  ?></a>
        <?php }?>
          <?php if($this->session->has_userdata('is_user_login')) { ?>
            <li class="nav-item dropdown"> 
              <a class="nav-item nav-link ts-scroll nav-link dropdown-toggle" href="#" id="services" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hi <?php echo ($this->session->has_userdata('name'))? ucfirst($this->session->userdata('name')) : '';?></a>
            <div class="dropdown-menu dp-clr" aria-labelledby="dropdown01"> 
               <a class="dropdown-item drp-clr drplogout" href="<?php echo base_url();?>user/profile">My Profile</a>
               <a class="dropdown-item drp-clr drplogout" href="<?php echo base_url();?>car/show_car">My Cars</a>
               <a class="dropdown-item drp-clr drplogout" href="<?php echo base_url();?>cart/my_order">My Orders</a>
               
                <!-- <a class="dropdown-item drp-clr drplogout" href="#">My Cars</a> -->
                <a class="dropdown-item drp-clr drplogout" href="<?php echo base_url();?>user/logout">Logout</a>
            </div>
          </li> 
          <?php } else {?>
            <a class="nav-item nav-link ts-scroll" href="<?php echo base_url();?>user/login">Login<i class="fa fa-user"></i></a>
          <?php } ?>
        </div>
      <!--end navbar-nav--> 
    </div>
    <!--end collapse--> 
  </div>
  
</nav>