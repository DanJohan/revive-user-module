<!DOCTYPE html>
<html lang="en">
	<head>
		  <title><?=isset($title)?$title:'Revive Auto Car' ?></title>
		   <?php $this->load->view('user/include/header.php'); ?>
		
	<script type="text/javascript">
		var config={
			'baseUrl':"<?php echo base_url(); ?>",
		}
	</script>	
	</head>
	<body id="dash">
		<?php $this->load->view('user/include/topbar.php'); ?>
		<?php $this->load->view('user/include/navbar.php'); ?>
		
				<!--main content start-->
						<!-- page start-->
						<?php $this->load->view($view);?>
						<!-- page end-->
					<!--main content end-->
				<!--footer start-->
				<?php $this->load->view('user/include/footer.php'); ?>

	</body>
	<script type="text/javascript">
	  $(".flash-msg").fadeTo(2000, 500).slideUp(500, function(){
	    $(".flash-msg").slideUp(500);
	});
	</script>
</html>