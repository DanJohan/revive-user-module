<!--=======Order-list===========-->
<section class="top__list">
  <div class="container">
     <div class="row">
     	<?php if (!empty($my_order)){ ?>
     	 <?php foreach($my_order as $order){?>
	   <div class="col-sm-12 col-md-12 col-xs-12">
		   <div class="order__list3">
		   	<input type ="hidden" value="<?php echo $order['id'];?>">
			 <span class="order__id">Order ID : <?php echo $order['order_no'];?></span>
			 <span class="booking__date">Booking Date : 

			 	<?php echo date('d-m-Y H:i:s',strtotime($order['created_at']));?></span>
		   </div>
		   
		    <div class="order__list4">
			 <span class="maruti_auto"><?php echo $order['brand_name']." ".$order['model_name'];?></span>
			 <span class="pend__ing"><a href="#">Pending</a></span>
		   </div>
		   
		   <div class="order__list5">
			 <ul class="appontment">
			  <li>Appointment</li>
			  <li>Date:<?php echo date('d-m-Y',strtotime($order['pick_up_date']));?></li>
			  <li>Time:<?php echo $order['pick_up_time'];?></li>
			 </ul>
			  <div class="open__Details2"><a href="<?php echo base_url();?>cart/order_detail/<?php echo $order['id'];?>">Open Details</a></div>
		   </div>
	   </div>
	  <?php }
			}else {
	  		 echo "NO ORDER FOUND"; }
	   ?> 
    </div>
  </div>
</section>


<!--=======Order-list-/===========-->