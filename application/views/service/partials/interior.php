<div class="row">
 <?php if (!empty($all_carservices)){ ?>
  <?php foreach($all_carservices as $carservice) {?>
 <div class="col-sm-3 col-md-3 col-xs-12">
 <div class="box_1">
   <h1 class="font-b1"><?php echo $carservice['name']; ?></h1>
     <span class="price1"><?php echo $carservice['price']; ?></span>
     <div class="car-img"><a href="#"><img src="<?php echo base_url();?>assets/img/<?php echo $carservice['image'];?>"></a></div>
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
</div>