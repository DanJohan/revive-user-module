<header id="ts-hero" class="ts-full-screen">
 <!--*****************NAVIGATION **************************-->
     <nav class="navbar navbar-expand-lg navbar-light  fixed-top ts-separate-bg-element" data-bg-color="#fff">
        <div class="container">
            <a class="navbar-brand" href="#page-top">
            <img class="img-fluid logo" src="<?php echo base_url();?>assets/img/logo.png" alt="">
            </a>
        <!--end navbar-brand-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <!--end navbar-toggler-->
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link active ts-scroll" href="<?php echo base_url()."site/index"?>">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link ts-scroll" href="<?php echo base_url();?>#about-us">About us</a>
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
                    <a class="nav-item nav-link ts-scroll" href="<?php echo base_url();?>#faqs">FAQs</a>
                    <a class="nav-item nav-link ts-scroll" href="<?php echo base_url();?>#contact">Contact us</a>
                    <a class="nav-item nav-link ts-scroll btn btn-primary btn-sm text-white ml-3 px-3 ts-width__auto down-btn" href="#download">Download</a> 
         <?php if($this->session->has_userdata('name')) { ?>
            <li class="nav-item dropdown"> 
              <a class="nav-item nav-link ts-scroll nav-link dropdown-toggle" href="#" id="services" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hi <?php echo ($this->session->has_userdata('name'))? ucfirst($this->session->userdata('name')) : '';?></a>
            <div class="dropdown-menu dp-clr" aria-labelledby="dropdown01"> 
                <a class="dropdown-item drp-clr drplogout" href="<?php echo base_url();?>cart/my_order">My Orders</a>
                <a class="dropdown-item drp-clr drplogout" href="<?php echo base_url();?>car/show_car">My Cars</a>
               <!--  <a class="dropdown-item drp-clr drplogout" href="#">My Cars</a> -->
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
        <!--end container-->
    </nav>
    <!--end navbar-->
<!--*************** HERO CONTENT ************************-->
<div class="container align-self-center">
    <div class="row align-items-center">
        <div class="col-sm-7">
            <h3 class="ts-font-color__black ts-opacity__50">Revive your ride</h3>
            <h1>The Ultimate Body Shop Experience!</h1>
            <a href="<?php echo base_url();?>service/select_service" class="btn btn-primary btn-lg ts-scroll" data-bg-color="#47143d">Book Now</a>
            <a href="<?php echo base_url();?>user/login" class="btn btn-primary btn-lg ts-scroll" data-bg-color="#47143d">Service Status</a>
        </div>
<!--end col-sm-7 col-md-7-->
        <div class="col-sm-5 d-none d-sm-block slider-top">
            <div class="owl-carousel text-center" data-owl-nav="1" data-owl-loop="1">
                <img src="<?php echo base_url();?>assets/img/img-phone-1st-screen.png" class="d-inline-block mw-100 p-md-5 p-lg-0 ts-width__auto" alt="">
                <img src="<?php echo base_url();?>assets/img/tutorial1.png" class="d-inline-block mw-100 p-md-5 p-lg-0 ts-width__auto" alt="">
                <img src="<?php echo base_url();?>assets/img/tutorial2.png" class="d-inline-block mw-100 p-md-5 p-lg-0 ts-width__auto" alt="">
                <img src="<?php echo base_url();?>assets/img/tutorial3.png" class="d-inline-block mw-100 p-md-5 p-lg-0 ts-width__auto" alt="">
                <img src="<?php echo base_url();?>assets/img/tutorial4.png" class="d-inline-block mw-100 p-md-5 p-lg-0 ts-width__auto" alt="">
                <img src="<?php echo base_url();?>assets/img/tutorial5.png" class="d-inline-block mw-100 p-md-5 p-lg-0 ts-width__auto" alt="">
                <img src="<?php echo base_url();?>assets/img/img-phone-2nd-screen.png" class="d-inline-block mw-100 p-md-5 p-lg-0 ts-width__auto" alt="">
            </div>
        </div>
<!--end col-sm-5 col-md-5 col-xl-5-->
    </div>
    <!--end row-->
</div>
<!--end container-->
<div id="ts-dynamic-waves" class="ts-background">
    <svg class="ts-svg ts-z-index__1 ts-flip-x" width="100%" height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg">
    <defs></defs>
        <path class="ts-dynamic-wave" id="wave-1" d="" data-wave-color="#fff" data-wave-height=".3" data-wave-bones="4" data-wave-speed="0.5"/>
    </svg>
    <svg class="ts-svg ts-z-index__1" width="100%" height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg">
    <defs></defs>
        <path class="ts-dynamic-wave" id="wave-2" d="" data-wave-color="#fff" data-wave-height=".3" data-wave-bones="6" data-wave-speed="0.3"/>
    </svg>
    <div class="ts-background-image ts-parallax-element" data-bg-image="<?php echo base_url();?>assets/img/bg-blurred-run.jpg">
    </div>
</div>
</header>
<!--end #hero-->