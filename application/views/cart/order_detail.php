<!--=======Order-list===========-->
<section class="top__list">
  <div class="container">
     <div class="row">
     	 	<?php// foreach($order_details as $orderdetails):?>
	   <div class="col-sm-12 col-md-12 col-xs-12">
	   	   <div class="order__list">
			 <span class="order__id">Order ID : <?php echo $orderdetails['order_no'];?></span>
			 <span class="booking__date">Booking Date : <?php echo $orderdetails['created_at'];?></span>
		   </div>
		   <span class="car__D">Car Details</span>
	   </div>
	   
	   <div class="col-sm-12 col-md-12 col-xs-12">
		   <div class="order__list">
			 <span class="order__id">Brand : <?php echo $orderdetails['brand_name'];?></span>
			 <span class="booking__date">Model : <?php echo $orderdetails['model_name'];?></span>
		   </div>
		   <span class="car__D">Appointment Details</span>
	   </div>
	   
	   <div class="col-sm-12 col-md-12 col-xs-12">
		   <div class="order__list">
			 <span class="order__id">Date : <?php echo $orderdetails['pick_up_date'];?></span>
			 <span class="booking__date">Time : <?php echo $orderdetails['pick_up_time'];?></span>
		   </div>
	   </div> 
	  <?php //endforeach;?> 
	 </div>
    <div class="row">
	 	<span class="car__D">Services Details</span>
		   <div class="col-sm-12 col-md-12 col-xs-12">
		   	<?php foreach($order['order_items'] as $order_item):?>
			   <div class="order__list2">
					 <span class="order__id"><?php echo $order_item['name'];?></span>
					 <span class="booking__date"><?php echo $order_item['price'];?></span>
			   </div>
			   <?php endforeach; ?>
		   </div>
		    <span class="order__time"><a href="#">Cancel Order</a></span>
	</div>
  </div>
</section>
<!--=======Order-list-/===========-->