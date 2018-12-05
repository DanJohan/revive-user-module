<!--=======Order-list===========-->
	   <div class="row">
		<table class="o_rser_list">
			  <tr><td><b class="bill_title">Order No  </b><span class="bill__no"> <?php echo $order['order_no']; ?></td></tr>
			  <tr></tr><td><b class="bill_title">Order Date  </b><span class="bill__no"> <?php echo $order['pick_up_date']; ?></td></tr>
			  <tr><td><b class="bill_title">Order Total  </b><span class="bill__no"> <?php echo $order['net_pay_amount']; ?></span></td></tr>
			  <tr></tr><td><b class="bill_title">Customer Name  </b> <?php echo $customerdetail['name']; ?></td></tr>
			  <tr><td><b class="bill_title">Customer Email  </b><?php echo $customerdetail['email']; ?></td></tr>
			  <tr><td><b class="bill_title">Customer Address  </b> <?php echo $customerdetail['address']; ?>&nbsp;<?php echo $customerdetail['landmark']; ?></td></tr>
			  <tr><td><b class="bill_title">Phone No.  </b> <?php echo $customerdetail['phone']; ?></td></tr>
		      <tr><td><b class="bill_title">Payment Mode  </b><?php echo $orderdetails['payment_name'];?></td></tr>
		 </table>
        </div>
        <div class="row">
	      <div class="col-md-12 col-sm-12 col-xs-12 space_012">
		      <table class="o_rser_list_2">
				  <tr>
					<th>Sr No</th>
					<th class="item_s">Packages </th>
					<th class="custom_list">Price </th>
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
					 <li><span class="sub_it_list">Order Total </span><span><?php echo $order['net_pay_amount']; ?></span></li>
					 <li><span class="sub_it_list">Loaner Vehicle </span><span><?php $olv = $orderdetails['loaner_vehicle'];
		    			if($olv == '1'){
		    				echo "500/- Per Day";
		    			}else{
		    				echo "0";
		    			}
		    			?></span>
	    			</li>
				  </ul>
			   </div>
		   </div>
	 </div>
