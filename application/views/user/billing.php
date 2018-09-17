<?php  
//payumoney integration start
// Merchant key here as provided by Payu
$MERCHANT_KEY = "rjQUPktU";

// Merchant Salt as provided by Payu
$SALT = "e5iIg1jwi8";

// End point - change to https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://test.payu.in";

$action = '';

$posted = array();

//Generate random transaction id
$txnid = random_string('numeric', 5);

if(!empty($_POST)) {
    
    $posted['amount'] = $_POST['amount'];
    $posted['phone'] = $_POST['phone'];
    $posted['firstname'] = $_POST['firstname'];
    $posted['email'] = $_POST['email'];
    $posted['key'] = $MERCHANT_KEY;
    $posted['txnid'] = $txnid;
    $posted['productinfo'] = 'This is a Test Product';
    $posted['email'] = $_POST['email'];
    $posted['firstname'] = $_POST['firstname'];
    $posted['phone'] = $_POST['phone'];
    $posted['surl'] = base_url("user/success");
    $posted['furl'] = base_url("user/error");
    $posted['curl'] = base_url("user/cancel");
    $posted['service_provider'] = 'payu_paisa';

}

$hash = '';

// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";

if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
        empty($posted['key'])
        || empty($posted['txnid'])
        || empty($posted['amount'])
        || empty($posted['firstname'])
        || empty($posted['email'])
        || empty($posted['phone']) 
        || empty($posted['productinfo'])
        || empty($posted['surl'])
        || empty($posted['furl'])
        || empty($posted['service_provider'])
    ) {
    echo "Fail";
    redirect('#');
    }
  else{
    
    $hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';
    foreach($hashVarsSeq as $hash_var){
        $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
        $hash_string .= '|';
    }

    $hash_string .= $SALT;
    $hash = strtolower(hash('sha512', $hash_string));
    $posted['hash'] = $hash;
    $action = $PAYU_BASE_URL . '/_payment';
  }
}
elseif(!empty($posted['hash'])){
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}

?>
<script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
     if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
 </script>
 <!-- payumoney integration end script -->
<section class="inovice-top">
  <div class="container">
    <div class="text-center">
      <h2 >Revive auto car care </h2>
      <p>9/11 Near Atul Kataria Chowk Kila No. 9, Opp Huda Nursery, Sector 17A, Gurgaon, Haryana-122001 GSTIN: 06AFVPJ6337B1ZD Email:customercare@reviveauto.in </p>
    </div>
    <?php
        if($this->session->flashdata('msg_error')){
          echo "<div class='alert alert-danger' role='alert'>".$this->session->flashdata('msg_error')."<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        }
        elseif($this->session->flashdata('msg_success')){
          echo "<div class='alert alert-success' role='alert'>".$this->session->flashdata('msg_success')."<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        }
      ?>
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
        <?php $discount = $invoice['discount'];?>
        <td style="font-weight:600;"><?php echo $discount;?></td>
        
      </tr>
      <tr>
        <td><b>Grand Total</b></td>
        <?php $gtotal= $labour_sum + $parts_sum;
              $grand_total = (($gtotal * $discount) / 100);
              $grandtotal = $gtotal - $grand_total;
         ?>
        <td style="font-weight:600;"> <?php echo $grandtotal; ?></td>
        
      </tr>
    
    </table>
   <div><p><span style="font-weight:600;">Notes:</span> <?php echo $invoice['notes']; ?></p></div>
  <div class="container">
            <div class="contact-form">
                <p class="notice error"><?= $this->session->flashdata('error_msg') ?></p><br/>
                <p class="notice error"><?= $this->session->flashdata('success_msg') ?></p><br/>
  <!-- paypal details -->
      <form method="post" class="form-horizontal" role="form" action="<?php echo base_url();?>paypal/create_payment_with_paypal">
       
              <input title="item_name" name="item_name" type="hidden" value="<?php echo $invoice['invoice_number'];?>">
              <input title="item_number" name="item_number" type="hidden" value="<?php echo $invoice['vehicle_reg_no'];?>">
              <input title="item_description" name="item_description" type="hidden" value="<?php echo $invoice['client_address'];?>">
              <input title="item_tax" name="item_tax" type="hidden" value="<?php echo $gst_total; ?>">
              <input title="item_price" name="item_price" type="hidden" value="<?php echo $grandtotal; ?>">
              <input title="details_tax" name="details_tax" type="hidden" value="<?php echo $gst_total; ?>">
              <input title="details_subtotal" name="details_subtotal" type="hidden" value="<?php echo $grandtotal; ?>">
              <div class="col-sm-2">
              <button  type="submit" style="display:contents;width:100%"><img src="<?php echo base_url();?>public/userlogin/img/paypal.png"></button>
              </div>
             
      </form>
<!-- payumoney details -->
      <form method="post" class="form-horizontal" action="<?php echo $action; ?>" name="payuForm">

        <input type="hidden" name="key" value="<?php echo (!isset($posted['key'])) ? '' : $posted['key'] ?>" />
        <input type="hidden" id="hash" name="hash" value="<?php echo (!isset($posted['hash'])) ? '' : $posted['hash'] ?>"/>
        <input type="hidden" name="txnid" value="<?php echo (!isset($posted['txnid'])) ? '' : $posted['txnid'] ?>" />

        <input type="hidden" name="productinfo" id="productinfo" value="<?php echo (!isset($posted['productinfo'])) ? '' : $posted['productinfo'] ?>">
        <input type="hidden" name="surl" value="<?php echo (!isset($posted['surl'])) ? '' : $posted['surl'] ?>" size="64" />
        <input type="hidden" name="curl" value="<?php echo (!isset($posted['curl'])) ? '' : $posted['curl'] ?>" size="64" />
        <input type="hidden" id="furl" name="furl" value="<?php echo (!isset($posted['furl'])) ? '' : $posted['furl'] ?>" size="64" />
        <input type="hidden" name="service_provider" value="<?php echo (!isset($posted['service_provider'])) ? '' : $posted['service_provider'] ?>" size="64" />
        <input type="hidden" class="form-control" name="firstname" id="firstname" value="<?php echo $invoice['client_name'];?>">
        <input type="hidden" name="email" id="email" class="form-control" value="<?php echo $invoice['client_email'];?>">
        <input type="hidden" name="phone" class="form-control" id="inputPassword3" value="<?php echo $invoice['client_phone'];?>">
        <input type="hidden" name="amount" class="form-control" id="inputPassword3"  value="<?php echo $grandtotal; ?>">
           <div class="col-sm-2">
              <button  type="submit" style="display:contents;width:100%"><img src="<?php echo base_url();?>public/userlogin/img/payu.png"></button>
            </div>
        </form>

        <!-- paytm form start -->
        <form method="post" action="<?php echo base_url();?>paytm/paytmpost">
          <input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo  "ORDS" . rand(10000,99999999)?>">
          <input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="CUST001">
          <input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
          <input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
          <input type="hidden" title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="<?php echo $grandtotal; ?>">
          <div class="col-sm-2">
         
            <button  type="submit" onclick="" style="display:contents;width:100%"><img src="<?php echo base_url();?>public/userlogin/img/paytm.png"></button>
             </div>
        </form>

            </div>
        </div><!-- /.container -->
  </div>
 </section>
<br></br><br></br><br></br>
