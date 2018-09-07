   <section class="User-detail">
        <div class="container">
    <div class="row">
    <div class="cn_diver">
    
      <div class="col-sm-12 col-md-12 col-xs-12">
      <table id="example" class="table table-striped table-bordered" style="width:100%">
        
        <thead>
            <tr>
                <th>Invoice Number</th>
                <th>Name</th>
                <th>Email</th>
                <th>Registration No.</th>
                <th>View</th>
               
            </tr>
        </thead>
        <tbody>

            <?php 
            if(!empty($invoices)){
            foreach ($invoices as $index => $invoice) {
            ?>
           
            <tr>
                <td><?php echo $invoice['invoice_number']; ?></td>
                <td><?php echo $invoice['client_name']; ?></td>
                <td><?php echo $invoice['client_email']; ?></td>
                <td><?php echo $invoice['vehicle_reg_no']; ?></td>
                <td><a class="btn btn-success" data-toggle="tooltip" href="<?= base_url('user/invoice_view/'.$invoice['id']); ?>" data-original-title="View"><i class="fa fa-eye"></i></a></td>
            </tr>

            <?php } }?>
           
        </tbody>

       
    </table>
                </div>
            </div>
        </div>
    </div>
</section> 