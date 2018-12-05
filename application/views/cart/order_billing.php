<!--=======Order-list===========-->
  <section>
     <div class="container">
     	<div id="steps" class="hidden-xs hidden-sm order-progressbar">
          <ul class="progressbar">

            <li class="done" style="width: 25%;">
              <a id="carBrand"><?php echo $orderdetails['brand_name'];?></a>
              <span>&gt;</span><a id="carModel" onclick="setFlag(2);"><?php echo $orderdetails['model_name'];?></a>
              </li>
              <li class="done" style="width: 25%;">Select Service</li>
              <li  class="done" style="width: 25%;">Enter Pick-Up Details</li>
              <li class="done" style="width: 25%;">Confirm Order</li>
            </ul>
          </div>
	   <div class=" row">
	      <div class="col-md-12 col-sm-12 col-xs-12">
		     <span class="order__list1">Order Details</span>
		  </div>
	   </div>
	 </div>
  </section>

  <section>
    <div class="container">
	   <div class="row">
<table class="o_rser_list">
  <tr>
    <th>Customer Details</th>
    <th>Vehicle Details</th>
    <th>Order Details</th>
  </tr>
   
   <tr>
    </tr class="bor__none">
     <td><b class="bill_title">Name </b><span class="bill__no"><?php echo $orderdetails['customer_name'];?></b></td>
      <td><b class="bill_title">Car Brand & Model</b><span class="bill__no"><?php echo $orderdetails['brand_name'];?>&nbsp;<?php echo $orderdetails['model_name'];?></td>
      <td><b class="bill_title">OrderNo </b><span class="bill__no"><?php echo $orderdetails['order_no'];?></td>
	</tr>
	</tr class="bor__none">
     <td><b class="bill_title">Bill To</b><span class="bill__no"><?php echo $orderdetails['address'];?></span></td>
      <td><b class="bill_title">Reg No </b><span class="bill__no"><?php echo $orderdetails['registration_no'];?></td>
      <td><b class="bill_title">Booking Date </b><span class="bill__no"><?php echo date('d-m-Y H:i:s',strtotime($orderdetails['created_at']));?></td>
	  
  </tr>
  
  <tr>
   <td><b class="bill_title">Email Address </b><span class="bill__no"><?php echo $orderdetails['customer_email'];?></span></td>
    <td><b class="bill_title">Service  </b><span class="bill__no"><?php echo $orderdetails['name'];?></span></td>
     <td><b class="bill_title">Pickup Date</b><span class="bill__no"><?php echo date('d-m-Y',strtotime($orderdetails['pick_up_date']));?></span></td>
   	
   
  </tr>
    
	<tr>
   <td><b class="bill_title">Phone </b><span class="bill__no"><?php echo $orderdetails['customer_phone'];?></span></td>

    <td>
    <b class="bill_title">Loaner Vehicle</b>&nbsp;&nbsp;
    <span class="bill__no">
    	<?php $olv = $orderdetails['loaner_vehicle'];
    			if($olv == '1'){
    				echo "500/- Per Day";
    			}else{
    				echo "0";
    			}
    	?>
  	</span>
    </td>
    <td>
    	<b class="bill_title">Pickup Time </b><span class="bill__no"><?php echo $orderdetails['pick_up_time'];?></span></td>
   
  </tr>

</table>
</div>
	</div>
  </section>
<section class="paid__list">
    <div class="container">
	  <div class="row">
	      <div class="col-md-12 col-sm-12 col-xs-12 space_012">
		      <table>
				  <tr>
					<th class="sr_no">Sr No</th>
					<th class="item_s">Services</th>
					<th class="text-right">Price</th>
				  </tr>
				  <?php if(!empty($orderdetails['order_items'])){
				  $count =1;
				 foreach($orderdetails['order_items'] as $order_item){	 ?>
					  <tr>
					 	<td><?php echo $count;?></td>
						<td><?php echo $order_item['sname'];?></td>
						<td class="custom_list">
							<?php echo $order_item['price'];?></td>
					  </tr>
				<?php 
					$count++; }}else{?>
					 <tr>
			            <td>No Items Added In Table</td>
			          </tr>
			        <?php }?>
				   
				   <tr>
					<th class="sr_no">TOTAL</th>
					<th class="item_s"></th>
					<th class="text-right"><?php echo $orderdetails['sub_total'];?></th>
				  </tr>
				  <tr>
					<th class="sr_no">Loaner Vehicle</th>
					<th class="item_s"></th>
					<th class="text-right"><?php $olv = $orderdetails['loaner_vehicle'];
		    			if($olv == '1'){
		    				echo "500/- Per Day";
		    			}else{
		    				echo "0";
		    			}
		    			?>
	    			</th>
				  </tr>
               </table>
		  </div>
		   <?php if($orderdetails['paid'] == 1){?>
				<span class="order__time"><a href="#">Order Confirmed</a></span>
			<?php }else {?>	
		  <div class="col-md-6 col-sm-6 col-xs-12">
		    <div class="order_btn">
		    	
		    	  <?php $order_status = $orderdetails['status'];
							if($order_status != 3){	?>

		    	<a class="btn-round" href="<?php echo base_url();?>cart/modify_order/<?php echo $orderdetails['hash'];?>">Modify Order</a>
		    <?php }else{}?>
		    </div>

		  </div>
		
		   <div class="col-md-6 col-sm-6 col-xs-12">
		    <div class="order_btn "><a class="btn-round" href="<?php echo base_url();?>cart/selectpaymentmethod/<?php echo $orderdetails['hash']; ?>">Proceed</a></div>
		  </div>
		<?php } ?>
	  </div>
	</div>
 </section>