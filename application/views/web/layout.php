<!doctype html>
<html lang="en">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="author" content="ThemeStarz">
		<html lang="en">
		  <title><?=isset($title)?$title:'Revive Auto Car' ?></title>
		   <?php $this->load->view('web/include/header.php'); ?>
		
	<script type="text/javascript">
		var config={
			'baseUrl':"<?php echo base_url(); ?>",
		}
	</script>	
	</head>
	<body>
		<?php $this->load->view('web/include/topbar.php'); ?>
		<header id="ts-hero" class="ts-full-screen">
		<?php $this->load->view('web/include/navbar.php'); ?>
		
				<!--main content start-->
						<!-- page start-->
						<?php $this->load->view($view);?>
						<!-- page end-->
					<!--main content end-->
				<!--footer start-->
	<?php $this->load->view('web/include/footer.php'); ?>
</body>
</html>
