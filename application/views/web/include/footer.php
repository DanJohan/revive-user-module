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
<div class="copyright"><p align="center">Copyright 2018. Design by Smart Serve Infotech Pvt. Ltd.</p></div>



<script src="<?php echo base_url();?>public/revive-car/assets/js/jquery-3.3.1.min.js"></script> 
<!-- <script src="<?php echo base_url();?>public/revive-car/assets/js/jquery.min.js"></script> -->
<script src="<?php echo base_url();?>public/revive-car/assets/js/bootstrap.min.js"></script>
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
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script> 
<script>
        if( document.getElementsByClassName("ts-full-screen").length ) {
            document.getElementsByClassName("ts-full-screen")[0].style.height = window.innerHeight + "px";
        }
    </script> 
