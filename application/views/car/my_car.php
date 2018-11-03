<section>
      <div class="container custom__car">
        <div class="row">
             <?php if(!empty($car_detail)){
                foreach($car_detail as $cardetail){?>
            <div class="col-sm-5 col-md-5 col-xs-12 defaul_t">
              <div class="img__sec">
               <div class="circle"><img src="<?php echo CRM_BASE_URL.'uploads/app/'.$cardetail['image'];?>"></div>
               <span class="default"><a href="#">Set Default</a></span>
               </div>
               
               <div class="tata__r">
              <span class="car">Car : <?php echo $cardetail['brand_name'];?>&nbsp;<?php echo $cardetail['model_name'];?></span>
              <span class="reg">Reg No : <?php echo $cardetail['registration_no'];?></span>
              <span class="default_2">
               <button class="btn btn-book__now" id="book_now" data-model-id="<?php echo $cardetail['model_id']?>" data-car-id="<?php echo $cardetail['id']?>">Book Now</button>
               </div>
          </div>
       <?php } } else{
                        echo "NO CAR ADDED";
       }?>
          <div class="col-md-12 col-sm-12 col-xs-12 text-center">
           <a href="<?php echo base_url(); ?>car/add_car"><button type="button" class="btn book__now">ADD CAR</button></a>
          </div>
                  
        </div>

      </div>
  </section>
  <?php $this->load->view('common/modal'); ?>
<?php $this->widget->beginBlock('scripts'); ?>
    <script type="text/javascript">
     $(document).on('click','#book_now',function(){
            var model_id = $(this).data('model-id');
            var car_id = $(this).data('car-id');
            var html = '<form action="'+config.baseUrl+'service/find_service" method="GET">'+
                        '<input type="hidden" name="model_id" value="'+model_id+'">'+
                        '<input type="hidden" name="car_id" value="'+car_id+'">'+
                        '<div class="form-group">'+
                            '<select name="service_cat_id" class="form-control">'+
                                '<option value="">Please select</option>'+
                                '<option value="1">Dent repair jobs</option>'+
                                '<option value="2">Paint repair jobs</option>'+
                                '<option value="3">Full Body car paint</option>'+
                                '<option value="4">Exterior customisations</option>'+
                                '<option value="5">Interior Customisations</option>'+
                            '</select>'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<button type="submit">Submit</button>'
                        '</div>'+
                   '</form>';

            $('.basicModal-content').html(html);
            $('#basicModal').modal();
        });
    </script>

<?php $this->widget->endBlock(); ?>