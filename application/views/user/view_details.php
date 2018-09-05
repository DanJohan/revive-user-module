    <section class="User-detail">
        <div class="container">
        <div class="user-content">

        <div class="box-header text-center">
                  <h1 class="box-title">User Enquiry Details</h1>
                </div>
                <div class="text-center">
                              <img class="user-img" height="150" width="150" src="<?php echo base_url();?>public/userlogin/img/user.png">
                          </div>
                <table class="table">
                      <tbody>
                         <?php 
            if(!empty($enquiries)){
            foreach ($enquiries as $key => $enq) {
            ?>
           
                        <tr>
                          <td><b>User ID</b></td>
                          <td><?php echo $enq['user_id']; ?></td>
                      </tr>
                       <tr>
                          <td><b>Car ID</b></td>
                          <td><?php echo $enq['car_id']; ?></td>
                      </tr>
                      <tr>
                          <td><b>Car Model Name</b></td>
                          <td><?php echo $enq['model_name']; ?></td>
                      </tr>
                      <tr>
                          <td><b>Enquiry</b></td>
                          <td><?php echo $enq['enquiry']; ?></td>
                      </tr>
                      <tr>
                          <td><b>Service Type</b></td>
                          <td><?php echo $enq['service_type']; ?></td>
                      </tr>
                      <tr>
                          <td><b>Location</b></td>
                          <td><?php echo $enq['location']; ?></td>
                      </tr>
                      <tr>
                          <td><b>Address</b></td>
                          <td><?php echo $enq['address']; ?></td>
                      </tr>
                      <tr>
                          <td><b>Registration Number</b></td>
                          <td><?php echo $enq['registration_no']; ?></td>
                      </tr>
                      
                      <?php } }?>
                  </tbody></table>
                 <a href="<?= base_url('user/enquiry_by_user'); ?>"><button class="btn btn-purple">Go Back</button>
              </div>
          </div>
       </section>
