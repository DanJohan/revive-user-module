   <section class="User-detail">
        <div class="container">
    <div class="row">
    <div class="cn_diver">
    
      <div class="col-sm-12 col-md-12 col-xs-12">
      <table id="example" class="table table-striped table-bordered" style="width:100%">
        
        <thead>
            <tr>
                <th>Repair Order ID</th>
                <th>Customer Request</th>
                <th>Quantity</th>
                <th>Remarks</th>
                <th>Parts Name</th>
                <th>Status</th>
                <th>Delay Reason</th>
               
            </tr>
        </thead>
        <tbody>

            <?php 
            if(!empty($repair_orders)){
            foreach ($repair_orders as $index => $order) {
            ?>
           

            <tr>
                <td><?php echo $order['repair_order_id']; ?></td>
                <td><?php echo $order['customer_request']; ?></td>
                <td><?php echo $order['qty']; ?></td>
                <td><?php echo $order['sa_remarks']; ?></td>
                <td><?php echo $order['parts_name']; ?></td>
                <td><?php 
                        if($order['status']==0){
                          echo "<span class='label label-danger'>Pending</span>";
                        }elseif($order['status']==1){
                          echo "<span class='label label-warning'>Processing</span>";
                        }elseif($order['status']==2){
                          echo "<span class='label label-success'>completed</span>";
                        }
                      ?>
                </td>
                <td><?php echo $order['delay_reason']; ?></td>
            </tr>
            <?php } } ?>
        </tbody>

       
    </table>
                </div>
            </div>
        </div>
    </div>
</section> 