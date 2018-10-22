<!--Crt-page-->
<section class="find-service-bg">
      <div class="container">
        <div class="row">
       <?php foreach($all_carimage as $carimage):?>
        <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="car"><img src="http://crm.reviveauto.in/uploads/admin/<?php echo $carimage['image'];?>"></div>
        </div>
        <?php endforeach; ?>
      </div>
      </div>
    </section>
    <!--PRODUCT-LIST-->

    <section class="product_w">
       <div class="container">
          <div class="row">
           <?php if (!empty($all_carservices)){ ?>
            <?php foreach($all_carservices as $carservice) {?>
           <div class="col-sm-3 col-md-3 col-xs-12">
           <div class="box_1">
             <h1 class="font-b1"><?php echo $carservice['name']; ?></h1>
               <span class="price1"><?php echo $carservice['price']; ?></span>
               <div class="car-img"><a href="#"><img src="<?php echo base_url();?>public/revive-car/assets/img/<?php echo $carservice['image'];?>"></a></div>
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
        </div>
       </div>
    </section>
    <!--PRODUCT-LIST-End--> 
  <?php $this->widget->beginBlock('scripts'); ?>
 
      <script>
        $(document).on('click','.cart-item',function(){
          var cartBtn = $(this);
          var serviceId= cartBtn.data('service-id');
          var price= cartBtn.data('price');
          var serviceName= cartBtn.data('service-name');
          //console.log(serviceName,serviceId,price);
          if(serviceId && price && serviceName){
            $.ajax({
              url:config.baseUrl+'cart/add',
              method:"POST",
              data:{'service_id':serviceId,'price':price,'service_name':serviceName},
              success:function(response){
                if(response.status){
                   $('#cart-count').text('Cart('+response.total_items+')');
                   cartBtn.text("Remove");
                   cartBtn.removeClass('cart-item');
                   cartBtn.addClass('cart-remove-item');
                }
              }
            });
          }
        });

        $(document).on('click','.cart-remove-item',function(){
          var cartBtn = $(this);
          var serviceId= cartBtn.data('service-id');
          var price= cartBtn.data('price');
          var serviceName= cartBtn.data('service-name');
          //console.log(serviceName,serviceId,price);
          if(serviceId && price && serviceName){
            $.ajax({
              url:config.baseUrl+'cart/remove',
              method:"POST",
              data:{'service_id':serviceId,'price':price,'service_name':serviceName},
              success:function(response){
                if(response.status){
                   if(response.total_items == 0){
                    $('#cart-count').text('Cart');
                   }else{
                    $('#cart-count').text('Cart('+response.total_items+')');
                  }
                   cartBtn.text("Add To Cart");
                   cartBtn.removeClass('cart-remove-item');
                   cartBtn.addClass('cart-item');
                }
              }
            });
          }
        });

    </script> 
<?php $this->widget->endBlock(); ?>