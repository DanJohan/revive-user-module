<!DOCTYPE html>
<html lang="en">
	<head>
		  <title><?=isset($title)?$title:'Revive Auto Car' ?></title>
		   <?php $this->load->view('user/include/header.php'); ?>
		
		
	</head>
	<body id="dash">
		<?php $this->load->view('user/include/topbar.php'); ?>
		<?php $this->load->view('user/include/navbar.php'); ?>
		
				<!--main content start-->
				<section class="view">
  					<div class="container">
						<!-- page start-->
						<?php $this->load->view($view);?>
						<!-- page end-->
					</div>
				</section>
				<!--main content end-->
				<!--footer start-->
				<?php $this->load->view('user/include/footer.php'); ?>

	</body>
</html>