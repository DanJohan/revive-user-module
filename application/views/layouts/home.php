<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="ThemeStarz">
	<title>Revive auto care</title>
	<?php $this->load->view('layouts/home/head'); ?>
	<?php $this->widget->beginBlock('stylesheet',true); ?>
 	<?php $this->widget->endBlock(); ?>
 	<script type="text/javascript">
 	  var config = {
	    'baseUrl':"<?php echo base_url(); ?>"
	  }
    </script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5b7e40d4f31d0f771d840f05/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</head>

<body>
<?php $this->load->view('common/flashmessage.php'); ?>
<?php $this->load->view('layouts/home/topbar.php'); ?>
<?php $this->load->view('layouts/home/navbar.php'); ?>

<?php echo $view; ?>

<?php $this->load->view('layouts/home/footer.php'); ?>
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
<script type="text/javascript">
    $(".flash-msg").fadeTo(2000, 500).slideUp(500, function(){
        $(".flash-msg").slideUp(500);
    });


    $(window).scroll(function() {    
    var scroll = $(window).scrollTop();

     //>=, not <=
    if (scroll>10) {
        //clearHeader, not clearheader - caps H
        $("nav").addClass("darkHeader");
    }else{
    	$("nav").removeClass("darkHeader");
    }
});


    
</script>
<?php if(!$this->session->has_userdata('location')) { ?>
<script type="text/javascript">
$("#myModal").modal({
  'backdrop':"static"
});
</script>
<?php } ?>
<?php $this->widget->beginBlock('scripts',true); ?>
<?php $this->widget->endBlock(); ?>
</body>
</html>
