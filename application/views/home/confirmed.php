<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="ThemeStarz">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/revive-car/assets/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/revive-car/assets/font-awesome/css/fontawesome-all.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/revive-car/assets/css/style1.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/revive-car/assets/css/style.css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
<header id="ts-hero" class="ts-full-screen">
  <nav class="navbar navbar-expand-lg navbar-light fixed-top ts-separate-bg-element" data-bg-color="#fff">
    <div class="container"> <a class="navbar-brand" href="<?php echo base_url(); ?>"> <img class="logo" src="<?php echo base_url(); ?>public/revive-car/assets/img/logo.png" alt=""> </a> 
      <!--end navbar-brand-->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <!--end navbar-toggler-->
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="navbar-nav ml-auto">
			<li><a class="nav-item nav-link ts-scroll active" href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a> </li>
			<li><a class="nav-item nav-link ts-scroll" href="<?php echo base_url(); ?>#about-us">About us</a> </li>
			<li><a class="nav-item nav-link ts-scroll" href="#">Services</a>
			  <ul>
			    <li><a href="#">Dent repair jobs</a></li>
				<li><a href="#">Paint repair jobs</a></li>
				<li><a href="#">Full Body car paint</a></li>
				<li><a href="#">Exterior customisations</a></li>
				<li><a href="#">Interior Customisations</a></li>
			  </ul>
			
			</li> 
			<li><a class="nav-item nav-link ts-scroll" href="<?php echo base_url(); ?>#gallery">Gallery</a> </li>
			<li><a class="nav-item nav-link ts-scroll" href="<?php echo base_url(); ?>#contact">Contact us</a></li> 
			<li><a class="nav-item nav-link ts-scroll" href="#login">Login <i class="fa fa-user"></i></a> </li>
		</ul>
      </div>
      <!--end collapse--> 
    </div>
    <!--end container-->
    <div class="ts-background" style="background-color: rgb(255, 255, 255);"></div>
  </nav>
 </header>
 
<!--===========CONFIRMED===========-->

<section class="confirm_1">
  <div class="container">
     <div class="row">
	    <div class="col-md-12 col-sm-12 col-xs-12">
		  <div class="confirm">
		      <span class="che__ck"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
			  <ul class="customer">
			       <li><b class="booking">Success! Your booking is confirmed.</b></li>
				   <li>Our customer representative will call you shortly.</li>
				   <li><b style="font-size:16px;color:#8c8b8b;font-weight:800;">Order ID: <?php echo $order['order_no']; ?></b></li>
				   <li>05:49PM 09 Oct 2018</li>
				   <li><a class="pay_cash" href="#">Pay Cash on Delivery</a></li>
				   <li class="or_i">Or</li>
				   <li>Pay Cash on Delivery</li>
			</ul>
		  </div>
		</div>
	 </div>
  </div>
</section>

<!--=========CONFIRMED=END=======-->



<!--------Footer-------->
<footer class="f-bg">
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <h1 class="text-center">DOWNLOAD THE <span class="f-span">APPLICATION</span>
          <div class="f-img-wrapper"> <img class="img-fluid f-google" src="<?php echo base_url(); ?>public/revive-car/assets/img/google.png"> <img class="img-fluid f-ios" src="<?php echo base_url(); ?>public/revive-car/assets/img/ios.png"></div>
          <h3 class="text-center">SHOWROOM LOCATIONS</h3>
        </h1>
      </div>
    </div>
    <div class="row">
      <div  class="col-sm-4">
        <div class="f-inner">
          <h4>DELHI </h4>
          <div class="decor-1"></div>
          <p>MOBILE: +91-9999999999
          <p>
          <p>FAX: +1-123-4561232</p>
          <p>EMAIL: contact@reviveauto.in</p>
        </div>
      </div>
      <div  class="col-sm-4">
        <div class="f-inner">
          <h4>NOIDA </h4>
          <div class="decor-1"></div>
          <p>MOBILE: +91-9999999999
          <p>
          <p>FAX: +1-123-4561232</p>
          <p>EMAIL: contact@reviveauto.in</p>
        </div>
      </div>
      <div  class="col-sm-4">
        <div class="f-inner">
          <h4>GURGAON </h4>
          <div class="decor-1"></div>
          <p>MOBILE: +91-9999999999
          <p>
          <p>FAX: +1-123-4561232</p>
          <p>EMAIL: contact@reviveauto.in</p>
        </div>
      </div>
    </div>
  </div>
</footer>
<div id="back-to-top" class="footer__wrap-btn"> <a class="footer__btn" href="#">top</a> </div>
</body>
</html>
