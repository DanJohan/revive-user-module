<section class="inovice-top">
  <div class="container">
    <div class="text-center">
      <h2 >Revive auto car care </h2>
      <p>9/11 Near Atul Kataria Chowk Kila No. 9, Opp Huda Nursery, Sector 17A, Gurgaon, Haryana-122001 GSTIN: 06AFVPJ6337B1ZD Email:customercare@reviveauto.in </p>
    </div>
    <?php
        $this->load->view('common/flashmessage');
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
        <th class="border-right"> Total Amount </th>
      </tr>
            <?php 
            if(!empty($invoice['labour'])){
            foreach ($invoice['labour'] as $key => $inv) {
            ?>
      <tr>
        <td><?php echo $inv['invoice_labour_id'];?></td>
        <td><?php echo $inv['invoice_labour_item'];?></td>
        <td><?php echo $inv['invoice_labour_hour'];?></td>
        <td><?php echo $inv['invoice_labour_rate'];?> </td>
        <td><?php echo $inv['invoice_labour_cost'];?> </td>
        <td><?php echo $inv['invoice_labour_gst'];?> </td>
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
        <th class="border-right"> Total Amount </th>
      </tr>

       <?php 
            if(!empty($invoice['parts'])){
            foreach ($invoice['parts'] as $key => $inv) {
            ?>
      <tr>
        <td><?php echo $inv['invoice_parts_id'];?></td>
        <td><?php echo $inv['invoice_parts_item'];?></td>
        <td><?php echo $inv['invoice_parts_quantity'];?></td>
        <td><?php echo $inv['invoice_parts_cost'];?> </td>
        <td><?php echo $inv['invoice_parts_gst'];?> </td>
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
        <td style="font-weight:600;"> <?php echo $invoice['labour_total']; ?></td>
       
      </tr>
      <tr>
        <td><b>Total Parts</b> </td>
        <td style="font-weight:600;"> <?php echo $invoice['parts_total']; ?></td>
        
      </tr>
      <tr>
        <td><b>GST</b></td>
        <td style="font-weight:600;"> <?php echo $invoice['gst_total']; ?></td>
        
      </tr>
      <tr>
        <td><b>Discount in %</b></td>
        <td style="font-weight:600;"><?php echo $invoice['discount'];?></td>
        
      </tr>
      <tr>
        <td><b>Grand Total</b></td>
        <td style="font-weight:600;"> <?php echo $invoice['total_amount_after_discount']; ?></td>
        
      </tr>
    
    </table>
   <div><p><span style="font-weight:600;">Notes:</span> <?php echo $invoice['notes']; ?></p></div>
  <div class="container">
            <div class="contact-form">
                <p class="notice error"><?= $this->session->flashdata('error_msg') ?></p><br/>
                <p class="notice error"><?= $this->session->flashdata('success_msg') ?></p><br/>
  <!-- paypal details -->
      <form method="post" class="form-horizontal" role="form" action="<?php echo base_url();?>payPal/createPayment">
              <input name="invoice_id" type="hidden" value="<?php echo $invoice['id'];?>">
              <input name="invoice_number" type="hidden" value="<?php echo $invoice['invoice_number'];?>">
              <input name="total_amount" type="hidden" value="<?php echo $invoice['total_amount_after_discount']; ?>">
              <div class="col-sm-2">
              <button  type="submit" style="display:contents;width:100%"><img src="<?php echo base_url();?>public/userlogin/img/paypal.png"></button>
              </div> 
      </form>
<!-- payumoney details -->
      <form method="post" id="payu-form" class="form-horizontal" data-id="<?php echo $invoice['id'];?>" action="<?php echo $payu['action']; ?>" name="payuForm">
        <input type="hidden" name="key" value="<?php echo (!isset($payu['key'])) ? '' : $payu['key'] ?>" />
        <input type="hidden" id="hash" name="hash" value="<?php echo (!isset($payu['hash'])) ? '' : $payu['hash'] ?>"/>
        <input type="hidden" name="txnid" value="<?php echo (!isset($payu['txnid'])) ? '' : $payu['txnid'] ?>" />

        <input type="hidden" name="productinfo" id="productinfo" value="<?php echo (!isset($payu['product_info'])) ? '' : $payu['product_info'] ?>">
        <input type="hidden" name="surl" value="<?php echo (!isset($payu['surl'])) ? '' : $payu['surl'] ?>" size="64" />
         <input type="hidden" name="curl" value="<?php echo (!isset($payu['curl'])) ? '' : $payu['curl'] ?>" size="64" /> 
        <input type="hidden" id="furl" name="furl" value="<?php echo (!isset($payu['furl'])) ? '' : $payu['furl'] ?>" size="64" />
        <input type="hidden" name="service_provider" value="<?php echo (!isset($payu['service_provider'])) ? '' : $payu['service_provider'] ?>" size="64" />
        <input type="hidden" class="form-control" name="firstname" id="firstname" value="<?php echo $invoice['client_name'];?>">
        <input type="hidden" name="email" id="email" class="form-control" value="<?php echo $invoice['client_email'];?>">
        <input type="hidden" name="phone" class="form-control" id="inputPassword3" value="<?php echo $invoice['client_phone'];?>">
       <!--  <input type="hidden" name="amount" class="form-control" id="inputPassword3"  value="<?php echo $invoice['total_amount_after_discount']; ?>"> -->
        <input type="hidden" name="amount" class="form-control" id="inputPassword3"  value="1.00">
           <div class="col-sm-2">
              <button  type="submit" style="display:contents;width:100%"><img src="<?php echo base_url();?>public/userlogin/img/payu.png"></button>
            </div>
        </form>

        <!-- paytm form start -->
        <form method="post" action="<?php echo base_url();?>paytm/paytmpost">
           <input type="hidden" tabindex="1" maxlength="20" size="20" name="invoice_id" autocomplete="off" value="<?php echo $invoice['id']; ?>">
          <input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo  "ORDS" . mt_rand(10000000,99999999)?>">
          <input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="CUST<?php echo $invoice['user_id'].mt_rand(1000,9999)?>" >
          <input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
          <input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
          <input type="hidden" title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="<?php echo $invoice['total_amount_after_discount']; ?>">
          <input type="hidden" title="EMAIL" tabindex="10" type="text" name="EMAIL" value="<?php echo $invoice['client_email']; ?>">
          <input type="hidden" title="MOBILE_NO" tabindex="10" type="text" name="MOBILE_NO" value="<?php echo $invoice['client_phone']; ?>">
          <div class="col-sm-2">
         
            <button  type="submit" onclick="" style="display:contents;width:100%"><img src="<?php echo base_url();?>public/userlogin/img/paytm.png"></button>
             </div>
        </form>

            </div>
        </div><!-- /.container -->
  </div>
 </section>
<br></br><br></br><br></br>
<script type="text/javascript">
  $(document).on('submit','#payu-form',function(){
    var invoice_id = $(this).data('id');
    var txn_id = $(this).find('input[name="txnid"]').val();
    if(invoice_id && txn_id) {
      $.ajax({
          'url':config.baseUrl+'payu/save_transaction',
          'method':'POST',
          'async':false,
          'data':{'invoice_id':invoice_id,'txn_id':txn_id},
          success:function(response){
             if(!response.status){
                return false;
             }
          }
      });
    }else{
      return false;
    }
    //
  });
</script>
