<!--Crt-page-->
<section class="select-services-banner">
  <div class="container">
<form id="find_service_form" action="<?php echo base_url()."service/find_service"?>" method="get" >
  <div class="row ">
<div class="col-md-4">
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
<div class="col-md-4">
<label class="modl-label">Select Model</label><br>
      
  <div class="select-container">
    <select class="select-bg" name="model_id" id="model_id">
       <!-- modal list here fetch from ajax-->
    </select>
  </div>

</div>
<div class="col-md-4">
<label class="modl-label">Select Service</label><br>
   <div class="select-container">  
  <select class="select-bg" name="service_cat_id" id="service_id">
        <option value="">Please select</option>
        <?php
          $services = array(
              array('id'=>1,'name'=>'Dent repair jobs'),
              array('id'=>2, 'name'=>'Paint repair jobs'),
              array('id'=>3, 'name' => 'Full Body car paint'),
              array('id'=>4, 'name'=>'Exterior customisations'),
              array('id' =>5, 'name' =>'Interior Customisations')
          );
          foreach ($services as $index => $service) {
        ?>
          <option value="<?php echo $service['id']; ?>"  <?php echo ($service_id==$service['id']) ? 'selected' :''; ?> ><?php echo $service['name']; ?></option>
        <?php
          }
        ?>
  </select>
  </div>
</div>
  
<!--   </div>
<div class="row"> -->
  <div class="col-md-12 text-center">
       <button type="submit" class="btn btn-primary find-btn btn-round" >Book Now</button>
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
  $("#find_service_form").validate({
      errorClass: "error",
      rules: {
        brand_id:{
          required:true
        },
        model_id:{
          required:true
        },
        service_cat_id: {
          required: true,
        }
    },
    messages:{
      brand_id:{
         required:"Please select car brand!"
      },
      model_id:{
         required:"Please select car model!"
      },
      service_id:{
         required:"Please select car service!"
      },
    }
  });
</script>
<?php $this->widget->endBlock(); ?>
