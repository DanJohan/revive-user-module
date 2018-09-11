   <section class="User-detail">
        <div class="container">
    <div class="row">
    <div class="cn_diver">
    
      <div class="col-sm-12 col-md-12 col-xs-12">
        
      <table id="example" class="table table-striped table-bordered" style="width:100%">
        
        <thead>
            <tr>
                <th>Registration No.</th>
                <th>Jobcard ID</th>
                <th>Color</th>
                <th>Brand Name</th>
                <th>Model Name</th>
                <th>View</th>
               
            </tr>
        </thead>
        <tbody>

            <?php 
            if(!empty($jobcard)){
            foreach ($jobcard as $index => $job) {
            ?>
           
            <tr>
                <td><?php echo $job['registration_no']; ?></td>
                <td><?php echo $job['job_card_id']; ?></td>
                <td><?php echo $job['color']; ?></td>
                <td><?php echo $job['brand_name']; ?></td>
                <td><?php echo $job['model_name']; ?></td>
                <td><a class="btn btn-success" data-toggle="tooltip" href="<?= base_url('user/completejobs/'.$job['job_card_id']); ?>" data-original-title="View"><i class="fa fa-eye"></i></a></td>
            </tr>

            <?php } }?>
           
        </tbody>

       
    </table>
                </div>
            </div>
        </div>
    </div>
</section> 