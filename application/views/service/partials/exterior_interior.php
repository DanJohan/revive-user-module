<div class="row">
  <div class="col-sm-1"></div>
 <?php if (!empty($all_carservices)){ ?>
  <?php foreach($all_carservices as $carservice) {?>

 <div class="col-sm-5">
 <div class="box_1">
   <h1 class="font-b1"><?php echo $carservice['name']; ?></h1>
     <span class="price1"><?php echo $carservice['price']; ?></span>
     <div class="car-img">
        <p class="text-center text-muted extr_p">Every 10,000 kms or 6 months <br>Includes Basic Service</p><br>
        <p class="text-center text-muted extr_pb">Takes 4 hours</p>
     </div>
     <?php if(in_array($carservice['id'],$cart_items_id)){ ?>
     <span class="btn_car"><a href="javascript:void(0)" class="cart-remove-item" data-service-id="<?php echo $carservice['id']; ?>" data-price="<?php echo $carservice['price']; ?>" data-service-name="<?php echo $carservice['name']; ?>">Remove</a></span>
   <?php } else { ?>
   <span class="btn_car"><a href="javascript:void(0)" class="cart-item" data-service-id="<?php echo $carservice['id']; ?>" data-price="<?php echo $carservice['price']; ?>" data-service-name="<?php echo $carservice['name']; ?>">Add To Cart</a></span>
 <?php } ?>
 </div>
</div>

<?php } 
}else {
echo "NO SERVICES FOUND, PLEASE SELECT SERVICES AND SEARCH AGAIN"; } ?>
<div class="col-sm-1"></div>
</div>