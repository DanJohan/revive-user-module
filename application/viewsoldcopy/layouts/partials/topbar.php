<div class="top-bar">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="top-text">
            <i class="icon fa fa-phone" style="transform: rotate(90deg);"></i>+91-9899645800
            <i class="icon fa fa-envelope"></i>
            contact@reviveauto.in
        </div>
      </div>
      <div class="col-md-6">
        <div class="top-icon">
          <a href="#"><i class="fab fa-facebook-f fb-color"></i></a>
          <a href="#"><i class="fab fa-twitter twtr-color"></i></a>
          <a href="#"><i class="fab fa-google-plus-g plus-color"></i></a>
        </div>
      </div>
      <div class="col-md-2">
        <a href="#"><p class="btn btn-modal" data-toggle="modal" data-target="#myModal"><?php echo ($this->session->has_userdata('location')) ? ucfirst($this->session->userdata('location')) : 'Select Your City'; ?>
        <i class="fa fa-angle-down" aria-hidden="true"></i></p></a>
				 <?php $this->load->view('common/location_modal'); ?>
      </div>
    </div>
   </div>
 </div>
</div>
