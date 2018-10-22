<?php
print_r($this->session->userdata('cart'));
?>

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
<script type="text/javascript">
 
  var config = {
    'baseUrl':"<?php echo base_url(); ?>"
  }

</script>
</head>
<body>
<header id="ts-hero" class="ts-full-screen">
  <nav class="navbar navbar-expand-lg navbar-light fixed-top ts-separate-bg-element" data-bg-color="#fff">
    <div class="container"> <a class="navbar-brand" href="<?php echo base_url();?>"> <img class="logo" src="<?php echo base_url(); ?>public/revive-car/assets/img/logo.png" alt=""> </a> 
      <!--end navbar-brand-->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <!--end navbar-toggler-->
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="navbar-nav ml-auto">
			<li><a class="nav-item nav-link ts-scroll active" href="<?php echo base_url();?>">Home <span class="sr-only">(current)</span></a> </li>
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
  <a href="#top"></a>
  <div class="container align-self-center">
  </header>
</div>
<form id="confirm-info" action="<?php echo base_url()."cart/confirmed"?>" method="post"> 
<section class="checkout">
   <div class="container">
      <div class="row">
	     <div class="col-md-3 col-sm-3 col-xs-12">
            <img class="micra" src="<?php echo base_url(); ?>public/revive-car/assets/img/Micra.png" class="img-responsive">
		 </div>
		
		<!------datepicker-------->
	     <div class="col-md-3 col-sm-3 col-xs-12 full_box">
		  	<h2 class="user_d">Car Details</h2>
		    <input placeholder="Car Brand" type="text" name="car_brand" id="car_brand" value="CHERVOLET" disabled>
	        <input placeholder="Car Model" type="text" name="car_model" id="car_model" value="AVIO" disabled>
			<input placeholder="Registration Number" type="text" name="reg_no" id="reg_no">
		</div>
      <!-------Datepicker--END--------->   		
		<div class="col-md-5 col-sm-5 col-xs-12 full_box1 last">
		  	<div class="promocode"><input placeholder="Have a promocode?" type="text"></div>
			<span class="ap_ly"><a href="#">Apply</a></span>
			
			<div class="your_order">
			   <span class="orde__r">Your Order</span>
			    <input class="subt2" type="text" name="subtotal" id="subtotal" value="<?php echo 'Rs. '.number_format($this->basket->getAttributeTotal('price'), 2, '.', ','); ?>">
			   <span class="subt3">Discount applied</span>
			   <span class="subt4">0 %</span>
			   <span class="order_p2">
			   <input placeholder="" type="text"></span>
			   <span class="total1">Total</span>
			   <input class="subt2" type="text" name="taxtotal" id="taxtotal" value="<?php echo 'Rs. '.number_format($this->basket->getAttributeTotal('price'), 2, '.', ','); ?>"><br>Inclusive of taxes</span>
			</div>
		</div>
        
        <div class="col-md-6 col-sm-6 col-xs-12 full_box__1">
		<span class="orde__r">Pickup Address</span>
		  	<div class="promocode_2">
			  <input placeholder="Address" type="text" name="pickup_address" id="pickup_address" required>
			</div>
			<div class="promocode_2">
			  <input placeholder="Landmark" type="text" name="landmark" id="landmark" required>
			</div>
			<a href="<?php echo base_url()."cart/confirmed"?>">
      <button type="submit" name="submit" class="btn btn-default confir_m" id="confirmed">Confirm</button> 
    </a>
		</div>
     </div>
   </div>
</section>





<!--------Footer-------->
<footer class="f-bg">
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <h1 class="text-center">DOWNLOAD THE <span class="f-span">APPLICATION</span>
          <div class="f-img-wrapper"> <img class="img-fluid f-google" src="<?php echo base_url(); ?>public/revive-car/assets/img/google.png"> 
          	<img class="img-fluid f-ios" src="<?php echo base_url(); ?>public/revive-car/assets/img/ios.png"></div>
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
