 <?php $this->widget->beginBlock('stylesheet'); ?>
 <style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style>
  <?php $this->widget->endBlock(); ?>
<!-- Modal -->
 <!-- The Modal -->
<div id="myModal1" class="modal">

  <!-- Modal content -->
  <div class="modal-content mdl-style">
    <span class="close">&times;</span>
    <section class="cart_custom">
  <div class="container">
    <div class="row margin-bottom">
     <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="box">
         <h1 class="cart">CART</h1> 
      <?php foreach ($allItems as $index=> $items) {
       foreach ($items as $item) {
       //  dd($item);
      ?> 
      <div class="row order-item"><!--scend-penal-->
           <div class="col-md-6 col-sm-6 col-xs-12">
          <a href="javascript:void(0)" class="remove-item" data-service-id="<?php echo $item['id']; ?>" data-price="<?php echo $item['attributes']['price']; ?>" data-service-name="<?php echo $item['attributes']['service']; ?>"><i class="fa fa-minus-circle mins" aria-hidden="true"></i></a>&nbsp;

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
           <!-- <p class="additem"><a href="<?php //echo base_url()."service/select_service"?>">Add More Items</a></p> -->
      </div>
    
      <div class="col-md-3 col-sm-3 col-xs-12">
            
             
         <p class="proceed"><a href="<?php echo base_url()."cart/userinfo"?>"><i class="fas fa-long-arrow-alt-right proced-icon"></i>Proceed To Checkout</a></p>
      </div>
    </div>
    
    </div>

</section>
  
  </div>

</div>

<?php $this->widget->beginBlock('scripts'); ?>
<script>
// Get the modal
var modal = document.getElementById('myModal1');

// Get the button that opens the modal
var btn = document.getElementById("cart-count");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

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