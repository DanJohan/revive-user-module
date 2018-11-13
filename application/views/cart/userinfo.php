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
<div id="steps" class="hidden-xs hidden-sm">
    <ul class="progressbar">
      <li class="done" style="width: 25%;">
        <a id="carBrand"><?php echo $car_detail['brand_name'];?></a>
        <span>&gt;</span><a id="carModel" onclick="setFlag(2);"><?php echo $car_detail['model_name'];?></a>
        </li>
        <li class="done" style="width: 25%;">Select Service</li>
        <li  class="current" style="width: 25%;">Enter Pick-Up Details</li>
        <li style="width: 25%;">Confirm Order</li>
      </ul>
  </div>
<form id="regForm" action="<?php echo base_url()."cart/store_order"?>" method="post"> 
<section class="checkout">
<div class="container">
    <div class="row">
	
        <div class="col-md-3 col-sm-3 col-xs-12">
              <img class="micra" src="http://crm.reviveauto.in/uploads/admin/<?php echo $car_detail['image'];?>" class="img-responsive">
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 full_box">
            <h2 class="user_d">User Details</h2>
            <input placeholder="Name" type="text" name="name" value="<?php echo $this->session->userdata('name')?>" class="validation" required="">
            <input placeholder="Phone" type="text" name="phone" value="<?php echo $this->session->userdata('phone')?>" class="validation" required="">
            <input placeholder="Email" type="email" name="email" value="<?php echo $this->session->userdata('email')?>" class="validation" required=""> 
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12 full_box">
              <h2 class="user_d">Car Details</h2>
      
            <input placeholder="Car Brand" type="text" name="car_brand" value="<?php echo $car_detail['brand_name'];?>" readonly>
            
            <input id="nissan" type="hidden" name="model_id" value="<?php echo $car_detail['id'];?>" >
            <input  type="hidden" name="brand_id" value="<?php echo $car_detail['brand_id'];?>" >
            
            <input placeholder="Car Model" type="text" name="car_model"value="<?php echo $car_detail['model_name'];?>" readonly>
             </span>
           
            <input type="text" name="reg_no" id="upcase" placeholder="Registration Number" value="<?php echo $car_reg_no['registration_no'];?>" class="validation">
        
  </div>  
        </div>
       
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12 full_box_23">
          <div id="datepicker"></div>
            <input type="hidden" id="datepicker2" value="<?php echo date('m/d/Y');?>" name="pick_up_date" placeholder="Selected Date" readonly required>
            <select class="time_sloat2 validation form-control" name="pick_up_time" id="pick_up_time" required="">
                  <option value="">Select Time</option>  
                  <option value="10:00-10:30 hrs">10:00-10:30 hrs</option>
                  <option value="10:30-11:00 hrs">10:30-11:00 hrs</option>
                  <option value="11:00-11:30 hrs">11:00-11:30 hrs</option>
                  <option value="11:30-12:00 hrs">11:30-12:00 hrs</option>
                  <option value="12:00-12:30 hrs">12:00-12:30 hrs</option>
                  <option value="12:30-01:00 hrs">12:30-01:00 hrs</option>
                  <option value="01:00-01:30 hrs">01:00-01:30 hrs</option>
                  <option value="01:30-02:00 hrs">01:30-02:00 hrs</option>
                  <option value="02:00-02:30 hrs">02:00-02:30 hrs</option>
                  <option value="02:30-03:00 hrs">02:30-03:00 hrs</option>
                  <option value="03:00-03:30 hrs">03:00-03:30 hrs</option>
                  <option value="03:30-04:00 hrs">03:30-04:00 hrs</option>
                  <option value="04:00-04:30 hrs">04:00-04:30 hrs</option>
                  <option value="04:30-05:00 hrs">04:30-05:00 hrs</option>
            </select>
        </div>

           <div class="col-md-3 col-sm-3 col-xs-12 full_box1 last">
                <div class="promocode"><input placeholder="Have a promocode?" type="text" name="promocode" id="promocode"></div>
                <div>
                    <span class="ap_ly"><a href="#">Apply</a></span>
                </div>
            </div>


          <div class="col-md-4 col-sm-4 col-xs-12 full_box1 last">
           <div class="row checkout-margin">
                 <div class="col-sm-8">
                  <span class="subt">Subtotal</span>
                    </div>
                    <div class="col-sm-4">
                       <span class="subt1">Rs. <?php echo number_format($this->basket->getAttributeTotal('price'), 2, '.', ','); ?></span>
                       <input class="subt2" type="hidden" name="subtotal" value="<?php echo $this->basket->getAttributeTotal('price'); ?>">
                    </div>
                    </div>

            <div class="row checkout-margin">
              <div class="col-sm-8">
                  <span class="subt3">Discount applied</span>
                </div>
                <div class="col-sm-4">
                   <span class="subt4">0 %</span>
                </div> 
            </div>
             <p class="border-bottom"></p>
              <div class="row">
                <div class="col-sm-8">
                    <span class="total1">Total</span>
                  </div>
                <div class="col-sm-4">
               <span class="subt1">Rs. <?php echo number_format($this->basket->getAttributeTotal('price'), 2, '.', ','); ?></span>
                       <input class="subt2" type="hidden" name="taxtotal" value="<?php echo $this->basket->getAttributeTotal('price'); ?>">
                <p class="p-txt">Inclusive of taxes</p>
              </div>
              </div>
              <div id="loanerprice"></div>
            </div>        


      </div><!--row--end-->

</div>

  <div class="container">
    <div class="row">
    
    <div class="col-md-7 col-sm-7 col-xs-12 full_box__1">
      <span class="orde__r">Pickup Address</span>
      <div>
            <input placeholder="Address" type="text" name="address" id="pickup_address" class="validation" required="">
      </div>
      <div>
          <input placeholder="Landmark" type="text" name="landmark" id="landmark">
      </div>
       <div class="userinfo-icons">
      <div class="userinfo-icons"> 
         <ul class="info-icons">
            <li><!-- <a href=""> --><i class="fa fa-home active" aria-hidden="true"></i><span>Home</span><!-- </a> --></li>
            <li><!-- <a href=""> --><i class="fa fa-building" aria-hidden="true"></i><span>Office</span><!-- </a> --></li>
            <li><!-- <a href=""> --><i class="fas fa-map-marker-alt"></i><span>Others</span><!-- </a> --></li>
         </ul>  
      </div>
 
</div>

    </div>
    
    <div class="col-md-4 col-sm-4 col-xs-12">
      <button type="submit" name="submit" class="btn btn-default find-btn next_C nextmargin">Book Now</button>
    </div>


 </div>


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
    /*var currentTab = 0;
    showTab(currentTab);

    function showTab(n) {
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "inline";
      }
      if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Book Now";
      } else {
        document.getElementById("nextBtn").innerHTML = "Next";
      }
    }

function nextPrev(n) {
  var x = document.getElementsByClassName("tab");
  if (n == 1 && !validateForm()){ 
    return false;
  }

  x[currentTab].style.display = "none";

  currentTab = currentTab + n;

  if (currentTab >= x.length) {

    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}*/
//function validateForm() {
 /*   var v = $("#regForm").validate({
        debug: true,
        errorClass: "error"
    });
    v.form();
    if($('#regForm').valid()){
        return true;
    }else{
        return false;
    }*/
//}
/*loaner car popup on load*/
bootbox.confirm({
    message: "Do you need a loaner or replacement vehicle? It will cost Rs. 500/- per day.The total charges for replacement car will be mentioned in the final bill.",
    className: "loanerpopup",
    buttons: {
        confirm: {
            label: 'Yes',
            className: 'btn-yes'
        },
        cancel: {
            label: 'No',
            className: 'btn-no'
        } 
    },

  callback: function(result){ 
    if(result === true){
      $('#regForm').prepend('<input type="hidden" name="loaner_vehicle" value="1">');
      $('#loanerprice').append('<span>Loaner Vehicle Price:</span><span class="float-right"> Rs. 500/- per day</span>');
         }else{
    $('#regForm').prepend('<input type="hidden" name="loaner_vehicle" value="0">');
   }

  } 
});

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
});
});</script>
<?php $this->widget->endBlock();?>
