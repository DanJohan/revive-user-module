<!--Crt-page-->
<section class="select-services-banner">
  <div class="container">
<form id="add_car_form" action="<?php echo base_url()."car/insert_car"?>" method="post" enctype="multipart/form-data">
  <div class="row ">
<div class="col-md-3">
  <label class="modl-label">Select Brand</label><br> 
  <div class="select-container">    
    <select class="select-bg" id="brand" name="brand_id">
      <option value="">Please Select Brand Name</option>
          <?php foreach($all_carbrand as $row):?>

             <option value="<?php echo $row['id']; ?>"><?php echo $row['brand_name']; ?></option>

          <?php endforeach; ?> 
    </select>
  </div>
</div>
<div class="col-md-3">
<label class="modl-label">Select Model</label><br>
      
  <div class="select-container">
    <select class="select-bg" name="model_id" id="model_id">
       <!-- modal list here fetch from ajax-->
    </select>
  </div>
</div>
<div class="col-md-3">
<label class="modl-label">Select Car Type</label><br>
   <div class="select-container">  
     <select name="car_body" id="car_body" class="form-control" required>
        <option value="">Please select</option>
        <?php
          foreach ($car_bodies as $index => $car_body) {
        ?>
          <option value="<?php echo $car_body['id']; ?>"><?php echo $car_body['name']; ?></option>
        <?php
          }
        ?>
     </select>
  </div>
</div>
<div class="col-md-3">
<label class="modl-label">Registration Number</label><br>
   <div class="select-container">  
    <input type="text" class="form-control login-input" name="reg_no" id="reg_no">
  </div>
</div>
 <div class="col-md-3">
<label class="modl-label">Upload Car Image</label><br>
   <div class="select-container">  
    <input type="file" class="" name="image" id="image">
  </div>
</div> 

 
<!--   </div>
<div class="row"> -->
  <div class="col-md-12 text-center">
       <button style="width:25%;" type="submit" name="submit" class="btn btn-default find-btn">Add Car</button>
 </div>
</div>
</form>

</section>
<?php $this->widget->beginBlock('scripts'); ?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
     
     $(document).on('change','#brand',function(){
       var brand_id = $(this).val();
       //alert(brand_id);
       $('#model_id').html('<option value="">Please Select Model Name</option>')
        $.ajax({
          url:config.baseUrl+"service/getCarModels",
          method:"POST",
          data:{'brand_id':brand_id},
          success:function(response){
             if(response.status){
                $('#model_id').html(response.template);
             }
          }
        });

     });

  });// end of ready function
  $("#add_car_form").validate({
      errorClass: "error",
      rules: {
        brand_id:{
          required:true
        },
        model_id:{
          required:true
        },
        car_body:{
          required:true
        },
        reg_no: {
          required: true
        },
        image: {
          required: true
        }
    },
    messages:{
      image: {
        required:"Please select Image!"
      },
      brand_id:{
         required:"Please select car brand!"
      },
      model_id:{
         required:"Please select car model!"
      },
      car_body:{
         required:"Please select car body!"
      },
    }
  });

  /*uppercase registration number input box*/
 $('#reg_no').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
</script>
<?php $this->widget->endBlock(); ?>
