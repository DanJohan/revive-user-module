<!--=======Order-list===========-->
<section class="top__list">
  <div class="container">
  	<?php if (!empty($my_order)){ ?>
		    <?php foreach($my_order as $order){?>
     <div class="row">
		<div class="top-box">
			<div class="row order">
				<div class="col-md-6">
					<input type ="hidden" value="<?php echo $order['id'];?>">
					<span class="order-id">Order ID : <?php echo $order['order_no'];?></span>
				</div>
				<div class="col-md-6">
					<span class="order-id">Booking Date : <?php echo date('d-m-Y H:i:s',strtotime($order['created_at']));?></span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<ul class="top-appontment">
						<li><?php echo $order['brand_name']." ".$order['model_name'];?></li>
						<li>Appointment Details:</li>
						<li>Date:<?php echo date('d-m-Y',strtotime($order['pick_up_date']));?></li>
						<li>Time:<?php echo $order['pick_up_time'];?></li>
					</ul>
				</div>
				<div class="col-md-6">
					<div class="open__Details2">
						<p>Status</p><a href="#">Pending</a>
						<a href="<?php echo base_url();?>cart/order_billing/<?php echo $order['hash'];?>">Open Details</a>
						<a href="<?php echo base_url()?>cart/cancel_order/<?php echo $order['id'];?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php }}else {?><h2 class="record">NO  RECORD FOUND</h2>
			<div class="col-md-12 col-sm-12 col-xs-12 text-center">
           <a href="<?php echo base_url(); ?>"><button type="button" class="btn book__now">GO BACK</button></a>
          </div>
	  <?php }?>	
  </div>
</section>

<!--=======Order-list-/===========-->