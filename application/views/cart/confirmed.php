<!--===========CONFIRMED===========-->

<section class="confirm_1 select-services-banner">
  <div class="container">
     <div class="row">
	    <div class="col-md-12 col-sm-12 col-xs-12">
		  <div class="confirm">
		      <span class="che__ck"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
			  <ul class="customer">
			       <li><b class="booking">Success! Your booking is confirmed.</b></li>
				   <li>Our customer representative will call you shortly.</li>
				   <li><b style="font-size:16px;color:#8c8b8b;font-weight:800;">Order ID: <?php echo $order['order_no']; ?></b></li>
				   <li>05:49PM 09 Oct 2018</li>
			</ul>
			<br>
			<a href="<?php echo base_url();?>cart/order_detail/<?php echo $order['id'];?>"><button type="button" class="view_order_btn">View Order</button></a>
		 </div>
		</div>
	 </div>
	
  </div>
</section>

<!--=========CONFIRMED=END=======-->