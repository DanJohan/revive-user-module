<!--========TOP-NAV=========-->
<style type="text/css">

button.navbar-toggler {
    display: none;
}
</style>
<section>
      <nav class="navbar navbar-expand-lg navbar-light bg-info">
	    <div class="custom_nav">
		<a class="navbar-brand1" href="<?php echo base_url();?>user/dashboard"><img src="<?php echo base_url();?>public/userlogin/img/logo.png" alt="Logo"></a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span>&#9776;</span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-color nav-link" href="<?php echo base_url();?>user/dashboard">Dashboard</a>
          </li>
         
		  <li class="nav-item">
            <a class="nav-color nav-link" href="<?php echo base_url();?>user/enquiry_by_user">Enquiry</a>
          </li>

          <li class="nav-item">
            <a class="nav-color nav-link" href="<?php echo base_url();?>user/billing">Billing Statements</a>
          </li>
          <li class="nav-item">
            <a class="nav-color nav-link" href="<?php echo base_url();?>user/jobcard">Service Status</a>
          </li>
        </ul>
      </div>
	  </div>
    </nav>
</section>
<!--========TOP-NAV-/=========-->