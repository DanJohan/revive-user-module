<!--===========CONFIRMED PAYMENT METHOD===========-->

<section class="confirm_1 select-services-banner">
  <div class="container">
     <div class="row">
	    <div class="col-md-12 col-sm-12 col-xs-12">
		  <div class="confirm">
		      <span class="che__ck"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
<!-- 
			  <ul class="customer">
			       <li><b class="booking">Select Payment Method</b></li>
				   <li><a class="pay_cash" href="#">Pay via Paytm</a></li>
				   <li class="or_i">Or</li>
				   <a href="<?php //echo base_url();?>cart/cashOnDelievery"><li>Pay Cash on Delivery</li></a>
			</ul> -->
			<h6 class="text-center paytem-text">Select Paytm Mode</h6>
				<div class="row paytem-wrapper">
			 <div class="col-md-4">
			 	<a href="#"><img class="img-fluid pay" src="<?php echo base_url();?>assets/img/m-card.png">
			 	    <span class="pay-text">Pay via Credit/Debit card/Net Banking </span>
			    </a>
				</div>
				<div class="col-md-4">
		
			 			<img class="img-fluid pay" src="<?php echo base_url();?>assets/img/paytem.png">
			 			<form method="post" action="<?php echo base_url();?>paytm/paytmpost">
					        <input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo  "ORDS" . mt_rand(10000000,99999999)?>">
				            <input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="CUST<?php echo $this->session->userdata('user_id').mt_rand(1000,9999)?>" >
				            <input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
				            <input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
				            <input type="hidden" title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="<?php echo $this->basket->getAttributeTotal('price'); ?>">
				            <input type="hidden" title="EMAIL" tabindex="10" type="text" name="EMAIL" value="<?php echo $this->session->userdata('email'); ?>">
				            <input type="hidden" title="MOBILE_NO" tabindex="10" type="text" name="MOBILE_NO" value="<?php echo $this->session->userdata('phone'); ?>">
				       
				        <button type="submit" class="pay-text">Pay Via Paytm</button>


				        </form>
				
				</div>
				<div class="col-md-4">
			 		<a href="<?php echo base_url();?>cart/cashOnDelievery"><img class="img-fluid pay" src="<?php echo base_url();?>assets/img/cash.png"><span class="pay-text__cash">Pay Cash on Delivery</span>
					</a>
				</div>
				
			</div>
		  </div>
		</div>
	 </div>
  </div>
</section>

<!--=========CONFIRMED=END=======-->