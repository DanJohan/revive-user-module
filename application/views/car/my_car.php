<section class="custom-wrapper">
      <div class="container custom__car">
        <h2 class="text-center">My Cars</h2>
        <div class="row">
             <?php if(!empty($car_detail)){
                foreach($car_detail as $cardetail){?>
            <div class="col-sm-5 col-md-5 col-xs-12 defaul_t">
              <div class="img__sec">
               <div class="circle">
                <?php if(!empty($cardetail['image'])){?>
                <img src="<?php echo CRM_BASE_URL.'uploads/app/'.$cardetail['image'];?>">
              <?php }else{?>
               <img src="<?php echo base_url();?>assets/img/no_car.png">
             <?php }?>
              </div>
               <!-- <span class="default"><a href="#">Set Default</a></span> -->
               </div>
               
               <div class="tata__r">
              <span class="car">Car :<?php echo $cardetail['brand_name'];?>&nbsp;<?php echo $cardetail['model_name'];?></span>
              <span class="reg">Reg No :<?php echo $cardetail['registration_no'];?></span>
              <span class="default_2">
               <button class="btn btn-book__now btn btn-primary  btn-s-cir" id="book_now" data-model-id="<?php echo $cardetail['model_id']?>" data-car-id="<?php echo $cardetail['id']?>">Book Now</button>
               <a href="<?php echo base_url();?>car/del_car/<?php echo $cardetail['id'];?>"><i class="delete fa fa-trash" aria-hidden="true"></i></a>
               </div>
          </div>
       <?php }

             }else {?><h2 class="record">NO CAR ADDED</h2><?php } ?>

          <div class="col-md-12 col-sm-12 col-xs-12 text-center">
           <a href="<?php echo base_url(); ?>car/add_car"><button type="button" class="btn book__now btn btn-primary  btn-lg-cir">ADD CAR</button></a>
          </div>
                  
        </div>

      </div>
  </section>
  <?php $this->load->view('common/modal'); ?>
<?php $this->widget->beginBlock('scripts'); ?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
  
    <script type="text/javascript">
     $(document).on('click','#book_now',function(){
            var model_id = $(this).data('model-id');
            var car_id = $(this).data('car-id');

              var html = '<form id="service_popup" action="'+config.baseUrl+'service/find_service" method="GET" class="car-book-wrapper">'+
                '<input type="hidden" name="model_id" value="'+model_id+'">'+
                '<input type="hidden" name="car_id" value="'+car_id+'">'+
                '<div class="form-group">'+
                '<select name="service_cat_id" class="form-control" id="service">'+
                '<option value="">Please select</option>'+
                '<option value="1">Dent Repair Jobs</option>'+
                '<option value="2">Paint Repair Jobs</option>'+
                '<option value="3">Full Body Car Paint</option>'+
                '<option value="4">Exterior Customisations</option>'+
                '<option value="5">Interior Customisations</option>'+
                '</select>'+
                '</div>'+
                '<div class="form-group">'+
                '<button type="submit" class="car-modal-btn btn btn-primary  btn-s-cir">Submit</button>'
                '</div>'+
                '</form>';

            $('.basicModal-content').html(html);
            $('#basicModal').modal();

                 $("#service_popup").validate({
                  errorClass: "error",
                  rules: {
                    'service_cat_id':{
                      required:true
                    }
                  }
                });
        });


    </script>

<?php $this->widget->endBlock(); ?>