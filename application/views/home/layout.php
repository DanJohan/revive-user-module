<!doctype html>
<html lang="en">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="author" content="ThemeStarz">
		<html lang="en">
		  <title><?php isset($title)?$title:'Revive Auto Car' ?></title>
		   <?php $this->load->view('home/include/header.php'); ?>
		
	<script type="text/javascript">
		var config={
			'baseUrl':"<?php echo base_url(); ?>",
		}
	</script>	
	</head>
	<body>
		<?php $this->load->view('home/include/topbar.php'); ?>
		<header id="ts-hero" class="ts-full-screen">
		<?php $this->load->view('home/include/navbar.php'); ?>
		
				<!--main content start-->
						<!-- page start-->
						<?php $this->load->view($view);?>
						<!-- page end-->
					<!--main content end-->
				<!--footer start-->
	<?php $this->load->view('home/include/footer.php'); ?>
	<?php $this->load->view('home/include/footer_js.php'); ?>
</body>
</html>
