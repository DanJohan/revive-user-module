   <section class="User-detail">
        <div class="container">
    <div class="row">
    <div class="cn_diver">
    
      <div class="col-sm-12 col-md-12 col-xs-12">
      <table id="example" class="table table-striped table-bordered" style="width:100%">
        
        <thead>
            <tr>
                <th>Enquiry ID</th>
                <th>Enquiry</th>
                <th>Updated Time</th>
                <th>View</th>
               
            </tr>
        </thead>
        <tbody>

            <?php 
            if(!empty($enquiries)){
            foreach ($enquiries as $key => $enq) {
            ?>
           
            <tr>
                <td><?php echo $enq['enquiry_id']; ?></td>
                <td><?php echo $enq['enquiry']; ?></td>
                <td><?php echo $enq['updated_at']; ?></td>
                <td><a class="btn btn-success" data-toggle="tooltip" href="<?= base_url('user/show_enquiry/'.$enq['enquiry_id']); ?>" data-original-title="View"><i class="fa fa-eye"></i></a></td>
            </tr>

            <?php } }?>
           
        </tbody>

       
    </table>
                </div>
            </div>
        </div>
    </div>
</section> 