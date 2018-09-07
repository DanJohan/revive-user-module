<section class="inovice-top">
  <div class="container">
    <div class="text-center">
      <h2 >Revive auto car care </h2>
      <p>9/11 Near Atul Kataria Chowk Kila No. 9, Opp Huda Nursery, Sector 17A, Gurgaon, Haryana-122001 GSTIN: 06AFVPJ6337B1ZD Email:customercare@reviveauto.in </p>
    </div>
    <table class="table  table-bordered ">
      <tr class="border-bottom">
        <th class="border-right">Customer Details</th>
        <th class="border-right">Vehicle Details</th>
        <th class="border-right">Invoice Details</th>
      </tr>
           
      <tr>
        <td><b>Client name :</b> <?php echo $invoice['client_name'];?> </td>
        <td><b>Registration
          No :</b> <?php echo $invoice['vehicle_reg_no'];?></td>
        <td><b>Invoice No :</b> <?php echo $invoice['invoice_number'];?></td>
      </tr>
      <tr>
        <td><b>Client phone : </b><?php echo $invoice['client_phone'];?> </td>
        <td><b>Brand :</b> <?php echo $invoice['vehicle_brand_name'];?></td>
        <td><b>Invoice Date :</b> <?php echo $invoice['date_created'];?></td>
      </tr>
      <tr>
        <td><b>Client email :</b> <?php echo $invoice['client_email'];?> </td>
        <td><b>Model :</b> <?php echo $invoice['vehicle_model_name'];?></td>
        <td><b>Invoice Due
          Date :</b> <?php echo $invoice['due_date'];?></td>
      </tr>
      <tr>
        <td><b>Client address :</b> <?php echo $invoice['client_address'];?></td>
        <td><b>VIN :</b> <?php echo $invoice['vehicle_vin_no'];?></td>
        <td><b>SA Name :</b> <?php echo $invoice['sa_name'];?></td>
      </tr>
      <tr>
        <td></td>
        <td><b>KMS :</b> <?php echo $invoice['vehicle_kms'];?></td>
        <td></td>
      </tr>
    </table>
  </div>
</section>
<section class="inovice-top">
  <div class="container">
    <div class="text-center">
      <h2>Labor Details</h2>
    </div>
    <table class="table  table-bordered ">
      <tr class="border-bottom">
        <th class="border-right"> SR </th>
        <th class="border-right">Labor</th>
        <th class="border-right"> Hour </th>
        <th class="border-right">Rate/Day </th>
        <th class="border-right">Cost</th>
        <th class="border-right">GST (%)</th>
        <th class="border-right"> Total Gst Amount </th>
        <th class="border-right"> Total Amount </th>
      </tr>
            <?php 
             $labour_sum = 0;
             $labour_gstsum = 0;
             $gst = 0;
            if(!empty($invoice['labour'])){
            foreach ($invoice['labour'] as $key => $inv) {
              $labour_sum += $inv['invoice_labour_total'];
              $labour_gstsum += $inv['invoice_labour_gst_amount'];
              $gst += $inv['invoice_labour_gst'];
            ?>
      <tr>
        <td><?php echo $inv['invoice_labour_id'];?></td>
        <td><?php echo $inv['invoice_labour_item'];?></td>
        <td><?php echo $inv['invoice_labour_hour'];?></td>
        <td><?php echo $inv['invoice_labour_rate'];?> </td>
        <td><?php echo $inv['invoice_labour_cost'];?> </td>
        <td><?php echo $inv['invoice_labour_gst'];?> </td>
        <td><?php echo $inv['invoice_labour_gst_amount'];?> </td>
        <td style="font-weight:600;"><?php echo $inv['invoice_labour_total'];?></td>

      </tr>
      <?php } } ?>
    </table>
  </div>
</section>

<section class="inovice-top">
  <div class="container">
    <div class="text-center">
      <h2>Parts Details</h2>
    </div>
    <table class="table  table-bordered ">
      <tr class="border-bottom">
        <th class="border-right"> SR </th>
        <th class="border-right">Parts </th>
        <th class="border-right"> Quantity </th>
        <th class="border-right">Cost</th>
        <th class="border-right">GST (%)</th>
        <th class="border-right"> Total GST Amount </th>
        <th class="border-right"> Total Amount </th>
      </tr>

       <?php 
            $parts_sum = 0;
            $parts_gstsum = 0;
            $gst = 0;
            if(!empty($invoice['parts'])){
            foreach ($invoice['parts'] as $key => $inv) {
              $parts_sum += $inv['invoice_parts_total'];
              $parts_gstsum += $inv['invoice_parts_gst_amount'];
              $gst += $inv['invoice_parts_gst'];
            ?>
      <tr>
        <td><?php echo $inv['invoice_parts_id'];?></td>
        <td><?php echo $inv['invoice_parts_item'];?></td>
        <td><?php echo $inv['invoice_parts_quantity'];?></td>
        <td><?php echo $inv['invoice_parts_cost'];?> </td>
        <td><?php echo $inv['invoice_parts_gst'];?> </td>
        <td><?php echo $inv['invoice_parts_gst_amount'];?> </td>
        <td style="font-weight:600;"><?php echo $inv['invoice_parts_total'];?></td>
        </tr>
      <?php } } ?>

    </table>
  </div>
</section>
<section class="inovice-top">
  <div class="container">
    <div class="text-center">
      <h2 >Summary</h2>
    </div>
    <table class="table  table-bordered ">
      
      <tr>
        <td><b>Total labour</b> </td>
        <td style="font-weight:600;"> <?php echo $labour_sum; ?></td>
       
      </tr>
      <tr>
        <td><b>Total Parts</b> </td>
        <td style="font-weight:600;"> <?php echo $parts_sum; ?></td>
        
      </tr>
      <tr>
        <td><b>GST</b></td>
        <?php $gst_total= $parts_gstsum + $labour_gstsum;?>
        <td style="font-weight:600;"> <?php echo $gst_total; ?></td>
        
      </tr>
      <tr>
        <td><b>Discount in %</b></td>
        <td style="font-weight:600;">  <?php echo $gst; ?></td>
        
      </tr>
      <tr>
        <td><b>Grand Total</b></td>
        <?php $grand_total = $labour_sum + $parts_sum;
         ?>
        <td style="font-weight:600;"> <?php echo $grand_total; ?></td>
        
      </tr>
      
    </table>
   <div><p><span style="font-weight:600;">Notes:</span> <?php echo $invoice['notes']; ?></p></div>

  </div>
 </section>
<br></br><br></br><br></br>