<!--Crt-page-->
<section class="select-services-banner">
  <div class="container">
<form action="<?php echo base_url()."service/find_service"?>" method="get" >
  <div class="row ">
<div class="col-sm-4">
	<label class="modl-label">Select Brand</label><br> 
       
	<select class="select-bg" id="brand">
	  <option value="">Please Select Brand Name</option>
	      <?php foreach($all_carbrand as $row):?>

	         <option value="<?php echo $row['id']; ?>"><?php echo $row['brand_name']; ?></option>

	      <?php endforeach; ?> 
	</select>
</div>

<div class="col-sm-4">
<label class="modl-label">Select Model</label><br>
      
  <select class="select-bg" name="model_id" id="model_id">
  	 <!-- modal list here fetch from ajax-->
  </select>

</div>

<div class="col-sm-4">
<label class="modl-label">Select Service</label><br>
      
  <select class="select-bg" name="service_id" id="model_id">
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
  
<!--   </div>
<div class="row"> -->
  <div class="col-sm-12 text-center">
       <button style="width:25%;" type="submit" class="btn btn-default find-btn">Book Now</button>
 </div>
</div>
</form>

</section>
<?php $this->widget->beginBlock('scripts'); ?>
<script type="text/javascript">
   $(document).ready(function(){
     
     $(document).on('change','#brand',function(){
       var brand_id = $(this).val();
       //alert(brand_id);
       $('#model_id').html('<option value="">Please Select Model Name</option>')
        $.ajax({
          url:config.baseUrl+"car/getCarModels",
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
</script>
<?php $this->widget->endBlock(); ?>
