<?php $this->widget->beginBlock('stylesheet'); ?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/start/jquery-ui.css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
.ui-datepicker {
    width: 14.7em;
    padding: .2em 0.2em 0;
    display: none;
}
p.p-txt {
    font-size: 12px;
}
</style>
<?php $this->widget->endBlock(); ?>
<div class="checkout-top">
  <div class="container">
<form id="regForm" action="<?php echo base_url()."cart/store_order"?>" method="post"> 
<section class="checkout tab sec1">
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12 full_box">
        <h2 class="user_d">User Details</h2>
        <input placeholder="Name" type="text" name="name" class="validation">
          <input placeholder="Phone" type="text" name="phone" class="validation">
      <input placeholder="Email" type="email" name="email" class="validation"> 
    </div>
    <div class="col-md-3 col-sm-3 col-xs-12 full_box_23">
      <div id="datepicker"></div>
      <input type="hidden" id="datepicker2" value="<?php echo date('m/d/Y');?>" name="pick_up_date" placeholder="Selected Date" readonly>
        <select class="time_sloat2 validation" name="pick_up_time" id="pick_up_time">
                <option value="">Select Time</option>  
              <option value="10-11AM">10-11AM</option>
              <option value="11-12PM">11-12PM</option>
              <option value="12-01PM">12-01PM</option>
              <option value="01-02PM">01-02PM</option>
              <option value="02-03PM">02-03PM</option>
              <option value="03-04PM">03-04PM</option>
              <option value="04-05PM">04-05PM</option>
        </select>
          <select class="time_sloat2 validation" name="service" id="service">
              <option value="">Select Service</option>
              <option value="1">Denting</option>
              <option value="2">Painting</option>
              <option value="3">Both</option>
              <option value="4">Other</option>
        </select>
   
    </div>
    <div class="col-md-5 col-sm-5 col-xs-12 full_box1 last">
        <div class="promocode"><input placeholder="Have a promocode?" type="text" name="promocode" id="promocode"></div>
      <span class="ap_ly"><a href="#">Apply</a></span>
        <div class="your_order">
                  <div class="row checkout-margin">
            <div class="col-sm-8">
             <span class="subt">Subtotal</span>
          </div>
          <div class="col-sm-4">
                   <span class="subt1">Rs. <?php echo number_format($this->basket->getAttributeTotal('price'), 2, '.', ','); ?></span>
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
              <span class="order_p20">
            Rs. <?php echo number_format($this->basket->getAttributeTotal('price'), 2, '.', ','); ?></span>
            <p class="p-txt">Inclusive of taxes</p>
          </div>
          </div>
      </div>
    </div>    
    </div>
</div>
</section>
<section class="checkout tab sec2">
    <div class="container">
        <div class="row">
          <?php foreach($car_image as $image):?>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <img class="micra" src="http://crm.reviveauto.in/uploads/admin/<?php echo $image['image'];?>" class="img-responsive">
            </div>
             <?php endforeach; ?>
          <div class="col-md-3 col-sm-3 col-xs-12 full_box">
              <h2 class="user_d">Car Details</h2>
            
            <input placeholder="Car Brand" type="text" name="car_brand" value="<?php echo $car_detail['brand_name'];?>" readonly>
            <input placeholder="Car Brand" type="hidden" name="model_id" value="<?php echo $car_detail['id'];?>" readonly>
            
            <input placeholder="Car Model" type="text" name="car_model"value="<?php echo $car_detail['model_name'];?>" readonly>
             
           
            <input type="text" name="reg_no" placeholder="Registration Number" class="validation">
      </div>
            <div class="col-md-5 col-sm-5 col-xs-12 full_box1 last">
        <div class="promocode"><input placeholder="Have a promocode?" type="text" name="promocode" id="promocode"></div>
      <span class="ap_ly"><a href="#">Apply</a></span>
        <div class="your_order">
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
      </div>
    </div>  



            <div class="col-md-6 col-sm-6 col-xs-12 full_box__1">
              <span class="orde__r">Pickup Address</span>
              <div>
                    <input placeholder="Address" type="text" name="address" id="pickup_address" class="validation">
              </div>
              <div>
                  <input placeholder="Landmark" type="text" name="landmark" id="landmark">
              </div>
           </div>
        </div>
    </div>
</section>
    <div class="row">
      <div class="col-sm-4"></div>
       <div class="col-sm-4">
      <div class="steps">   <!-- Circles which indicates the steps of the form: -->
          <span class="step"></span>
          <span class="step"></span>
      </div>
    </div>
        <div class="col-sm-4">
           <button type="button" id="nextBtn" onclick="nextPrev(1)" class="btn btn-default find-btn next_C ">Next</button>
           <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-default find-btn next_C nextmargin">Previous</button>
        </div>

  </div>


</form>
</div>
</div>

<?php $this->widget->beginBlock('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  
<!-- datepicker script start -->
  <script>
  $(function() {
  $('#datepicker').datepicker({
    onSelect: function(dateText) {
        $('#datepicker2').datepicker("setDate", $(this).datepicker("getDate"));
    }
  });
});
$(function() {
  $("#datepicker2").datepicker();
});
  </script>
  <!-- datepicker script end -->
  <script type="text/javascript">
 // (function(){
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
      // This function will display the specified tab of the form ...
      var x = document.getElementsByClassName("tab");
      console.log(x);
      x[n].style.display = "block";
      // ... and fix the Previous/Next buttons:
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "inline";
      }
      if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
      } else {
        document.getElementById("nextBtn").innerHTML = "Next";
      }
      // ... and run a function that displays the correct step indicator:
     //fixStepIndicator(n)
    }

    /*function nextPrev(n) {
      // This function will figure out which tab to display
      var x = document.getElementsByClassName("tab");
      // Exit the function if any field in the current tab is invalid:
    //  if (n == 1 ) return false;
      // Hide the current tab:
      x[currentTab].style.display = "none";
      // Increase or decrease the current tab by 1:
      currentTab = currentTab + n;
      // if you have reached the end of the form... :
      if (currentTab >= x.length) {
        //...the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
      }
      // Otherwise, display the correct tab:
      showTab(currentTab);
    }*/

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}
function validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      x = document.getElementsByClassName("tab");
      y = x[currentTab].getElementsByClassName("validation");
     // y = x[currentTab].getElementById("pick_up_time");
      //console.log(y);
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
          // add an "invalid" class to the field:
          y[i].className += " invalid";
          // and set the current valid status to false:
          valid = false;
        }
      }
      // If the valid status is true, mark the step as finished and valid:
      if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
      }
      return valid; // return the valid status
    }
/*
    function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}*/

</script>
<?php $this->widget->endBlock();?>