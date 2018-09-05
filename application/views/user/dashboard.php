<section class="view">
 <div class="container">
    <div class="content">
      <div class="box">
        <div class="box-header text-center">
          <h1 class="box-title">Welcome <?php echo $this->session->userdata('name'); ?></h1>
        </div>
        <!-- /.box-header -->
        <div class="box-body ">
          <div class="row">
            <div class="col-lg-6 col-xs-6"> 
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>Billing</h3>
                </div>
                <div class="icon"> <img height="80" width="80" src="<?php echo base_url();?>public/userlogin/img/billing.png"> </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
            </div>
            <!-- ./col -->
            
            <div class="col-lg-6 col-xs-6"> 
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>Service status</h3>
                </div>
                <div class="icon"> <img height="80" width="80" src="<?php echo base_url();?>public/userlogin/img/status.png"> </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 </div>
</section>    
