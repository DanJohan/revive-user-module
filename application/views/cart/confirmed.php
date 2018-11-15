<!--=======Order-list===========-->

<section class="wrap_full">
  	<div class="container inner-full ">
	   <div class="row">
	      <div class="col-md-12 col-sm-12 col-xs-12">
		     <span class="order__list12">Thanks for placing your order</span>
			 <span class="l__order"><img src="<?php echo base_url();?>assets/img/logo.png"></span>
			  <span class="order__list13">Your Order is Under Process</span>
			 <p align="center">Our customer care executive will call you for further assistance and confirmation.</p>
			  
		  </div>
	   </div>
	   <div class="row">
		<table class="o_rser_list">
		  <tr>
			<th>SUMMARY</th>
			<th>BILLING ADDRESS</th>
			<th>CUSTOMER DETAIL</th>
		  </tr>

		   
			<tr>
			  </tr class="bor__none">
			  <td><b class="bill_title">Order</b><span class="bill__no"><?php echo $order['order_no']; ?></td>
			  <td><b class="bill_title"><?php echo $customerdetail['name']; ?></b><span class="bill__no"></td>
			  <td><b class="bill_title"></b><?php echo $customerdetail['email']; ?><span class="bill__no"></td></td>
			
			</tr>
			
		  </tr class="bor__none">
				<td><b class="bill_title">Order Date</b><span class="bill__no"><?php echo $order['pick_up_date']; ?></td>
			  <td><b class="bill_title"><?php echo $customerdetail['address']; ?>&nbsp;<?php echo $customerdetail['landmark']; ?></b><span class="bill__no"></td>
			  <td><b class="bill_title"></b>&nbsp;<span class="bill__no"></td></td>
		  </tr>

		  <tr>
		   <td><b class="bill_title">Order Total </b><span class="bill__no"><?php echo $order['net_pay_amount']; ?></span></td>
			<td><b class="bill_title"><?php echo $customerdetail['phone']; ?></b><span class="bill__no"></td>
			<td><b class="bill_title"></b>&nbsp;&nbsp;<span class="bill__no"></td></td>

		  </tr> 
		   <tr class="pay_ment">
		   <td><b class="bill_title">Payment Mode</b><span class="bill__no"></span></td>
			<td><b class="bill_title"><?php echo $orderdetails['payment_name'];?></b><span class="bill__no"></td>
				<td></td>


		  </tr>
		  
		 </table>
        </div>
       


        <div class="row">
	      <div class="col-md-12 col-sm-12 col-xs-12 space_012">
		      <table class="o_rser_list_2">
				  <tr>
					<th>Sr No</th>
					<th class="item_s">Packages</th>
					<th class="custom_list">Price</th>
				  </tr>
				  <?php 
				  		$count =1;
				 		foreach($orderdetails['order_items'] as $order_item){	 ?>
				  <tr>
					<td ><?php echo $count;?></td>
					<td><?php echo $order_item['sname'];?></td>
					<td class="custom_list"><?php echo $order_item['price'];?></td>
				  </tr>
				 <?php 
						$count++; } ?>
               </table>
		  </div>
        </div>
        <div class="row order-bor">
		   <div class="col-sm-12 col-md-12 col-xs-12">
				 <div class="item_list">
				  <ul class="sub__items">
					 <li><span class="sub_it_list">Order Total</span><span><?php echo $order['net_pay_amount']; ?></span></li>
				  </ul>
			   </div>
		   </div>
	 </div>
	 <div class="row">
	    <div class="col-md-12 col-sm-12 col-xs-12">
		    <span class="callus">Call us: +91-9899645800</span>
		</div>
	 </div>

	 </div>
</section>