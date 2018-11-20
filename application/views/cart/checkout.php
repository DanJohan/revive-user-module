<section class="cart_custom">
  <div class="container">
    <div class="row margin-bottom">
     <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="box">
         <h1 class="cart">CART
          <p class="p-cap-off"><?php echo $car_detail['brand_name'];?>-><?php echo $car_detail['model_name'];?>
           -><?php echo $service_detail['name'];?></p>
          </h1> 

         
      <?php foreach ($allItems as $index=> $items) {
       foreach ($items as $item) {
      ?> 
      <div class="row order-item"><!--scend-penal-->
           <div class="col-md-6 col-sm-6 col-xs-12">
          <a href="javascript:void(0)" class="remove-item" data-service-id="<?php echo $item['id']; ?>" data-price="<?php echo $item['attributes']['price']; ?>" data-service-name="<?php echo $item['attributes']['service']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>&nbsp;

          <span class="bumper"><?php echo $item['attributes']['service']; ?></span>
         </div>
         
         <div class="col-md-6 col-sm-6 col-xs-12">
            <span class="price">Rs. <?php echo $item['attributes']['price']; ?></span>
         </div>
       </div>
     
     <?php  } } ?>
     <span class="entr"></span>
      
     <div class="col-md-12 boder"></div>
      <div class=" col-xs-12">
        <span class="bumper">SUBTOTAL</span>
     </div>
     
      <div class=" col-xs-12">
        <span class="price"><?php echo 'Rs. '. number_format($this->basket->getAttributeTotal('price'), 2, '.', ','); ?></span>
     </div>
     <div class="col-xs-12 topbd">
        <span class="bumper">DISCOUNT APPLIED</span>
     </div>
      
    <div class="col-xs-12 topbd">
        <span class="price">0%</span>
      </div>
     
       <div class=" col-xs-12">
        <span class="bumper">TOTAL</span>
       </div>
     
      <div class="col-xs-12">
         <span class="price"><?php echo 'Rs. '.number_format($this->basket->getAttributeTotal('price'), 2, '.', ','); ?></span>
     </div>
     </div><!--scend-penal-End-->
      </div> 
    </div>
    
    
    <div class="row btn-w ">
        <div class="col-md-6 col-sm-6 col-xs-12"></div>
        <div class="col-md-3 col-sm-3 col-xs-12">
         
  <p class="additem"><a href="<?php echo base_url();?>service/find_service?model_id=<?php echo $this->session->userdata('model_id');?>&car_id=<?php echo $this->session->userdata('car_id');?>&service_cat_id=<?php echo $this->session->userdata('service_cat_id');?>">Add More Items</a></p>
      </div>
    
      <div class="col-md-3 col-sm-3 col-xs-12">
            
             
         <p class="proceed"><a href="<?php echo base_url()."cart/userinfo"?>"><i class="fas fa-long-arrow-alt-right proced-icon"></i>Proceed To Checkout</a></p>
      </div>
    </div>
  </div>
</div>
</section>
<?php $this->widget->beginBlock('scripts'); ?>
<script type="text/javascript">
   $(document).on('click','.remove-item',function(){
          console.log("here");
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
                  location.reload('true');
                  // cartBtn.text("Add To Cart");
                 //  cartBtn.removeClass('cart-remove-item');
                 //  cartBtn.addClass('cart-item');
                }
              }
            });
          }
        });
// end of ready function
</script>
<?php $this->widget->endBlock();?>