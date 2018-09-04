    <section class="User-detail">
        <div class="container">
        <div class="user-content">

        <div class="box-header text-center">
                  <h1 class="box-title">User details</h1>
                </div>
                <div class="text-center">
                              <img class="user-img" height="150" width="150" src="img/user.png">
                          </div>
                <table class="table table-bordered">
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
                          <td><b>Model Name</b></td>
                          <td><?php echo $enq['model_name']; ?></td>
                      </tr>
                      <?php } }?>
                  </tbody></table>
        </div>

        </div>

   </section>
    <!-- <div class="row">
    <div class="cn_diver">
    
      <div class="col-sm-12 col-md-12 col-xs-12">
      <table id="example" class="table table-striped table-bordered" style="width:100%">
        
        <thead>
            <tr>
                <th>User ID</th>
                <th>Car ID</th>
                <th>Model Name</th>
                <th>Brand Name</th>
                <th>Enquiry</th>
                <th>Service Type</th>
                <th>Registration No.</th>
                <th>Address</th>
                <th>Updated Time</th>
            </tr>
        </thead>
        <tbody>

            <?php 
            if(!empty($enquiries)){
            foreach ($enquiries as $key => $enq) {
            ?>
           
            <tr>
                <td><?php echo $enq['user_id']; ?></td>
                <td><?php echo $enq['car_id']; ?></td>
                <td><?php echo $enq['model_name']; ?></td>
                <td><?php echo $enq['brand_name']; ?></td>
                <td><?php echo $enq['enquiry']; ?></td>
                <td><?php echo $enq['service_type']; ?></td>
                <td><?php echo $enq['registration_no']; ?></td>
                <td><?php echo $enq['address']; ?></td>
                <td><?php echo $enq['updated_at']; ?></td>
                 </tr>

            <?php } }?>
           
        </tbody>

       
    </table>
       </div>
     </div>
    </div> -->