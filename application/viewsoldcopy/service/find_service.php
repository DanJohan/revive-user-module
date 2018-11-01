<!--Crt-page-->
<section class="find-service-bg">
      <div class="container">
        <div class="row">
       <?php foreach($all_carimage as $carimage):?>
        <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="car"><img src="<?php echo CRM_BASE_URL; ?>uploads/admin/<?php echo $carimage['image'];?>"></div>
        </div>
        <?php endforeach; ?>
      </div>
      </div>
    </section>
    <!--PRODUCT-LIST-->
    <section class="product_w">
       <div class="container">
          <?php 
          if($service_cat_id == 1 || $service_cat_id==2){
            $this->load->view('service/partials/dent_and_paint_service');
          }elseif ($service_cat_id==3) {
            $this->load->view('service/partials/full_body');
          }else if($service_cat_id == 4 || $service_cat_id == 5) {
              $this->load->view('service/partials/exterior_interior');
          }
          ?>
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
