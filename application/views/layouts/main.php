<!DOCTYPE html>
<html>
<head>
     <title>Revive auto care</title>
     <?php $this->load->view('layouts/partials/head'); ?>
     <?php $this->widget->beginBlock('stylesheet',true); ?>
     <?php $this->widget->endBlock(); ?>
     <script type="text/javascript">
       var config = {
         'baseUrl':"<?php echo base_url(); ?>"
       }
    </script>
</head>

<body>
<?php $this->load->view('common/flashmessage.php'); ?>
<?php $this->load->view('layouts/partials/topbar.php'); ?>
<?php $this->load->view('layouts/partials/main-navbar.php'); ?>

<?php echo $view; ?>

<?php $this->load->view('layouts/partials/footer.php'); ?>

<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
<script type="text/javascript">
    $(".flash-msg").fadeTo(2000, 500).slideUp(500, function(){
        $(".flash-msg").slideUp(500);
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
