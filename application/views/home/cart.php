<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="ThemeStarz">
<!--   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600"> -->
<link rel="stylesheet" href="<?php echo base_url();?>public/revive-car/assets/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>public/revive-car/assets/font-awesome/css/fontawesome-all.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/revive-car/assets/css/style.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/revive-car/assets/css/owl.carousel.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<script type="text/javascript">
 
  var config = {
    'baseUrl':"<?php echo base_url(); ?>"
  }

</script>
</head>
<body data-spy="scroll" data-target=".navbar" class="has-loading-screen" data-bg-parallax="scroll" data-bg-parallax-speed="3">
<header id="" class="ts-full-screen">
  <nav class="navbar navbar-expand-lg navbar-light fixed-top ts-separate-bg-element" data-bg-color="#fff">
    <div class="container"> <a class="navbar-brand" href="#page-top"> <img class="logo" src="<?php echo base_url();?>public/revive-car/assets/img/logo.png" alt=""> </a> 
      <!--end navbar-brand-->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <!--end navbar-toggler-->
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto"> <a class="nav-item nav-link ts-scroll active" href="index.html">Home <span class="sr-only">(current)</span></a> <a class="nav-item nav-link ts-scroll" href="#about-us">About us</a> <a class="nav-item nav-link ts-scroll" href="#services">Services</a> <a class="nav-item nav-link ts-scroll" href="#gallery">Gallery</a> <a class="nav-item nav-link ts-scroll" href="#contact">Contact us</a> <a class="nav-item nav-link ts-scroll btn btn-primary btn-sm text-white ml-3 px-3 ts-width__auto" href="#download">Download</a> <a class="nav-item nav-link ts-scroll" href="#login">Login <i class="fa fa-user"></i></a> </div>
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
		    <div class="row bn">
			 
			<div class="col-md-3 col-sm-3 col-xs-12">
			  <div class="petrol"><a href="#">DAEWOO>CIELO>PETROL</a></div>
			</div>
			
			<div class="col-md-3 col-sm-3 col-xs-12">
			  <div class="petrol">Select Service</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
			  <div class="petrol">Enter Pick-Up Details</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
			  <div class="petrol">Confirm Order</div>
			</div>
			
			  <div class="col-md-12 col-sm-12 col-xs-12">
			   <div class="car"><img src="<?php echo base_url();?>public/revive-car/assets/img/car.png"></div>
			  </div>
			</div>
		  </div>
		</section>
		<!--PRODUCT-LIST-->

		<section class="product_w">
		   <div class="container">
		      <div class="row">
		      	<?php foreach($all_carservices as $carservice):?>
			     <div class="col-sm-3 col-md-3 col-xs-12">
				   <div class="box_1">
					   <h1 class="font-b1"><?php echo $carservice['name']; ?></h1>
						   <span class="price1"><?php echo $carservice['price']; ?></span>
						   <div class="car-img"><a href="#"><img src="<?php echo base_url();?>public/revive-car/assets/img/<?php echo $carservice['image'];?>"></a></div>
					   <span class="btn_car"><a href="javascript:void(0)" class="cart-item" data-service-id="<?php echo $carservice['id']; ?>" data-price="<?php echo $carservice['price']; ?>" data-service-name="<?php echo $carservice['name']; ?>">Add To Cart</a></span>
				   </div>
				 </div>
				 <?php endforeach; ?>
				 </div>
			  </div>
		   </div>
		</section>
		<!--PRODUCT-LIST-End-->	
<!--CART-PAGE-END-->
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
          <h4>NOIDA
</h4>
          <div class="decor-1"></div>
          <p>MOBILE: +91-9999999999
          <p>
          <p>FAX: +1-123-4561232</p>
          <p>EMAIL: contact@reviveauto.in</p>
        </div>
      </div>
      <div  class="col-sm-4">
        <div class="f-inner">
          <h4>GURGAON
</h4>
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
<script src="<?php echo base_url();?>public/revive-car/assets/js/imagesloaded.pkgd.min.js"></script> 
<script src="<?php echo base_url();?>public/revive-car/assets/js/isInViewport.jquery.js"></script> 
<script src="<?php echo base_url();?>public/revive-car/assets/js/jquery.particleground.min.js"></script> 
<script src="<?php echo base_url();?>public/revive-car/assets/js/owl.carousel.min.js"></script> 
<script src="<?php echo base_url();?>public/revive-car/assets/js/scrolla.jquery.min.js"></script> 
<script src="<?php echo base_url();?>public/revive-car/assets/js/jquery.validate.min.js"></script> 
<script src="<?php echo base_url();?>public/revive-car/assets/js/jquery-validate.bootstrap-tooltip.min.js"></script> 
<script src="//cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/TweenMax.min.js"></script> 
<script src="<?php echo base_url();?>public/revive-car/assets/js/jquery.wavify.js"></script> 
<script src="<?php echo base_url();?>public/revive-car/assets/js/TweenMax.min.js"></script> 
<script src="<?php echo base_url();?>public/revive-car/assets/js/custom.js"></script>
<script>
if ($('#back-to-top').length) {
    var scrollTrigger = 100, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#back-to-top').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
            }
        };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
}

</script>

<script>
        if( document.getElementsByClassName("ts-full-screen").length ) {
            document.getElementsByClassName("ts-full-screen")[0].style.height = window.innerHeight + "px";
        }


        $(document).on('click','.cart-item',function(){
        	var cartBtn = $(this);
        	var serviceId= cartBtn.data('service-id');
        	var price= cartBtn.data('price');
        	var serviceName= cartBtn.data('service-name');
        	//console.log(serviceName,serviceId,price);
        	if(serviceId && price && serviceName){
        		$.ajax({
        			url:config.baseUrl+'cart/add',
        			method:"POST",
        			data:{'service_id':serviceId,'price':price,'service_name':serviceName},
        			success:function(response){
        				console.log(response);
        			}
        		});
        	}
        });

    </script> 
</body>
</html>
