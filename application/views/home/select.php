<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="ThemeStarz">
<!--   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600"> -->
<link rel="stylesheet" href="<?php echo base_url();?>public/revive-car/assets/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>public/revive-car/assets/font-awesome/css/fontawesome-all.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/revive-car/assets/css/style1.css">
<!--<link rel="stylesheet" href="assets/css/owl.carousel.min.css">-->
<style>
#ts-hero {
  height: 120px !important;
}
.banner_2 {
    clear: both;
    height: 64vh;
    background-image: url(../../assets/img/servicesimg.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    z-index: -1;
    background-position: center top;
}
</style>
<script type="text/javascript">
 
  var config = {
    'baseUrl':"<?php echo base_url(); ?>"
  }

</script>
</head>
<body>
<header id="ts-hero" class="ts-full-screen">
  <nav class="navbar navbar-expand-lg navbar-light fixed-top ts-separate-bg-element" data-bg-color="#fff">
    <div class="container"> <a class="navbar-brand" href="<?php echo base_url();?>home/index"> <img class="logo" src="<?php echo base_url();?>public/revive-car/assets/img/logo.png" alt=""> </a> 
      <!--end navbar-brand-->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <!--end navbar-toggler-->
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto"> <a class="nav-item nav-link ts-scroll active" href="<?php echo base_url();?>home/index">Home <span class="sr-only">(current)</span></a> <a class="nav-item nav-link ts-scroll" href="<?php echo base_url();?>home/index#about-us">About us</a> <a class="nav-item nav-link ts-scroll" href="<?php echo base_url();?>home/index#services">Services</a> <a class="nav-item nav-link ts-scroll" href="<?php echo base_url();?>home/index#gallery">Gallery</a> <a class="nav-item nav-link ts-scroll" href="<?php echo base_url();?>home/index#contact">Contact us</a> <a class="nav-item nav-link ts-scroll btn btn-primary btn-sm text-white ml-3 px-3 ts-width__auto" href="#download">Download</a> <a class="nav-item nav-link ts-scroll" href="#login">Login <i class="fa fa-user"></i></a> </div>
        <!--end navbar-nav--> 
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

<!--Crt-page-->
<section class="banner_2">
  <div class="container">
  <div class="row text-center">
  <div class="col-sm-6">
<form action="<?php echo base_url()."car/find_service"?>" method="get" >       
<select class="select-bg" id="brand">
  <option value="">Please select </option>
      <?php foreach($all_carbrand as $row):?>
         <option value="<?= $row['id']; ?>"><?= $row['brand_name']; ?></option>
      <?php endforeach; ?> 
</select></div>

<div class="col-sm-6">
       
  <select class="select-bg" name="model_id" id="model_id"></select>

</div>
  
  </div>
    <div class="row text-center">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <a href="find_service"><button type="submit" class="btn btn-default find-btn">Find Services</button></a>
    
  </div>
</form>
  <div class="col-sm-4"></div>
  </div>
</section>
<footer class="f-bg">
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <h1 class="text-center">DOWNLOAD THE <span class="f-span">APPLICATION</span>
          <div class="f-img-wrapper"> <img class="img-fluid f-google" src="<?php echo base_url();?>public/revive-car/assets/img/google.png"> <img class="img-fluid f-ios" src="<?php echo base_url();?>public/revive-car/assets/img/ios.png"></div>
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
<script src="<?php echo base_url();?>public/revive-car/assets/js/jquery-3.3.1.min.js"></script> 
<script type="text/javascript">
   $(document).ready(function(){
     
     $(document).on('change','#brand',function(){
       var brand_id = $(this).val();
       //alert(brand_id);
       $('#model_id').html('<option value="">Please select</option>')
        $.ajax({
          url:config.baseUrl+"car/getCarModels",
          method:"POST",
          data:{'brand_id':brand_id},
          success:function(response){
             if(response.status){
                $('#model_id').html(response.template);
             }
          }
        });

     });

  });// end of ready function
</script>
</body>
</html>
