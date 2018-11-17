<?php $this->widget->beginBlock('stylesheet'); ?>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>

</style>
<?php $this->widget->endBlock(); ?>
<div class="checkout-top">
<div class="container">
  <!-- processing bar -->

<form id="regForm" action="<?php echo base_url()."cart/update_order/"?>" method="post"> 
<section class="checkout">
<div class="container">
    <div class="row">
	
        <div class="col-md-4 col-sm-4 col-xs-12 full_box">
            <h2 class="user_d">User Details</h2>
            <input type="hidden" name="order_id" value="<?php echo $orderdetails['id'];?>">
            <input placeholder="Name" type="text" name="name" value="<?php echo $orderdetails['customer_name'];?>" class="validation" required="">
            <input placeholder="Phone" type="text" name="phone" value="<?php echo $orderdetails['customer_phone'];?>" class="validation" required="">
            <input placeholder="Email" type="email" name="email" value="<?php echo $orderdetails['customer_email'];?>" class="validation" required=""> 
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12 full_box">
              <h2 class="user_d">Car Details</h2>
      
            <input placeholder="Car Brand" type="text" name="car_brand" value="<?php echo $orderdetails['brand_name'];?>" readonly>
            
            <input id="nissan" type="hidden" name="model_id" value="<?php echo $orderdetails['id'];?>" >
            <input  type="hidden" name="brand_id" value="<?php echo $orderdetails['brand_id'];?>" >
            
            <input placeholder="Car Model" type="text" name="car_model"value="<?php echo $orderdetails['model_name'];?>" readonly>
            
            <input type="text" name="reg_no" id="upcase" placeholder="Registration Number" value="<?php echo $orderdetails['registration_no'];?>" class="validation">
        
        </div>  

         <div class="col-md-3 col-sm-3 col-xs-12 full_box">
           <div id="datepicker"></div>
            <input type="hidden" id="datepicker2" value="<?php echo $orderdetails['pick_up_date'];?>" name="pick_up_date" readonly required>
            <select class="time_sloat2 validation form-control" name="pick_up_time" id="pick_up_time" required="">
                <?php
                $pick_up_time_values = array(
                  '10:00-10:30 hrs',
                  '10:30-11:00 hrs',
                  '11:00-11:30 hrs',
                  '11:30-12:00 hrs',
                  '12:00-12:30 hrs',
                  '12:30-01:00 hrs',
                  '01:00-01:30 hrs',
                  '01:30-02:00 hrs',
                  '02:00-02:30 hrs',
                  '02:30-03:00 hrs',
                  '03:00-03:30 hrs',
                  '03:30-04:00 hrs',
                  '04:00-04:30 hrs',
                  '04:30-05:00 hrs'
                );

                foreach ($pick_up_time_values as  $pick_time_value) {
                ?>
                  <option value="<?php echo $pick_time_value; ?>" <?php echo ($pick_time_value==$orderdetails['pick_up_time'])?'selected':''; ?> ><?php echo $pick_time_value; ?></option>
                <?php
                }
                ?>
            </select>
        </div>
      </div>
   </div>

  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 full_box__1">
      <span class="orde__r">Pickup Address</span>
      <div>
            <input placeholder="Address" type="text" name="address" value="<?php echo $orderdetails['address'];?>" id="pickup_address" class="validation" required="">
      </div>
      <div>
          <input placeholder="Landmark" type="text" name="landmark" id="landmark" value="<?php echo $orderdetails['landmark'];?>">
      </div>
      <div class="userinfo-icons"> 
         <ul class="info-icons" id="myid">
         
            <li id="1"><i class="fa fa-home active" aria-hidden="true"></i><span>Home</span></li>
            <li id="2"><i class="fa fa-building" aria-hidden="true"></i><span>Office</span></li>
            <li id="3"><i class="fas fa-map-marker-alt"></i><span>Others</span></li>
         </ul>  
       
       <input type="hidden" name="location_type" id="results" value="<?php echo $orderdetails['location']; ?>">
      </div>
  </div>
 </div>
</div>
<div class="container">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12 full_box_23 modify-wrapper">
    <!--tables comes here-->
      <table class="modify-margin">
        <tr>
          <th class="item_s">Services</th>
          <th class="text-right">Price</th>
          <th>Delete</th>
        </tr>
         <?php
         if(!empty($orderdetails['order_items'])){
          foreach($orderdetails['order_items'] as $order_item){   ?>
          <tr>
            <td><?php echo $order_item['sname'];?></td>
            <td class="custom_list"><?php echo $order_item['price'];?></td>
            <td><a href="<?php echo base_url()?>cart/remove_order_item/<?php echo $order_item['item_id']."/".$orderdetails['id']."/".$orderdetails['hash'];?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
          </tr>
        <?php }}else{?>
          <tr>
            <td colspan="3" class="delete-msg ">No Items Added In Table</td>
          </tr>
        <?php }?>
            <tr>
          <th class="item_s">Total</th>
           <th  class="text-right"><?php echo $orderdetails['sub_total'];?></th>
          <th></th>
        </tr>
          <!-- <tr>
            <th class="sr_no">TOTAL</th>
          
            <th colspan="3" class="text-right"><?php //echo $orderdetails['sub_total'];?></th>
            
          </tr> -->
      </table>
      <div class="float-right">
       <a href="<?php echo base_url();?>service/add_more_service/?hash=<?php echo $orderdetails['hash']."&service_cat_id=".$orderdetails['service_id']."&model_id=".$orderdetails['model_id'];?>">
        <button type="button" class="btn-dotted">Add More Items</button></a>
        <button type="submit" class="btn-round2 proc-btn">Proceed</button></a>
      </div>
    </div> 
  </div><!--row--end-->
</div>
</section>
</form>
</div>
</div>

<?php $this->widget->beginBlock('scripts'); ?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
  
<!-- datepicker script start -->
  <script>
  $(function() {
  $('#datepicker').datepicker({
    defaultDate: new Date('<?php echo implode(',',explode('-',$orderdetails['pick_up_date'])); ?>'),
    onSelect: function(dateText) {
        $('#datepicker2').datepicker("setDate", $(this).datepicker("getDate"));
    },
    minDate:0
  });
});
$(function() {
  $("#datepicker2").datepicker();
});
  </script>
  <!-- datepicker script end -->
  <script type="text/javascript">
/*uppercase registration number input box*/
 $('#upcase').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
</script>
<script>
  $(document).ready(function(){
  $('.info-icons li i').click(function(){
    $('li i').removeClass("active");
    $(this).addClass("active");
    $("#myid li").click(function() {
    var locid = $(this).attr("id"); // get id of clicked li
     $("#results").val(locid);
});
});
});</script>

<?php $this->widget->endBlock();?>
