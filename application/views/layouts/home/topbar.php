<div class="ts-page-wrapper" id="page-top">
        <!--*********************************************************************************************************-->
        <!--************ HERO ***************************************************************************************-->
        <!--*********************************************************************************************************-->
        <section class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="social-address">
                            <a class="top-icon" href="#"><span><i class="fa fa-phone" style="transform: rotate(90deg);"></i>+91-9899645800</span></a>
                            <a class="top-icon" href="#"><span><i class="fa fa-envelope"></i>contact@reviveauto.in</span></a> 
                       </div>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="row float-right">
                            <div class="col-md-6">
                            <div class="social-icons">
                            <ul>
                                <li>
                                <a href="#"><i class="fab fa-facebook-f fb-color"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter twtr-color"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus-g plus-color"></i></a></li>
                            </ul>
                                    
                            </div>
                            </div>
                            <div class="col-md-6">    
                            <div class="models_list">
                                <a href="#"><p class="btn btn-modal" data-toggle="modal" data-target="#myModal"><?php echo ($this->session->has_userdata('location')) ? ucfirst($this->session->userdata('location')) : 'Select Your City'; ?>
                                <i class="fa fa-angle-down" aria-hidden="true"></i></p></a>

                               <!-- <a href="#"><p class="btn btn-info modal-btn" data-toggle="modal" data-target="#myModal"><?php //echo ($this->session->//has_userdata('location')) ? ucfirst($this->session->userdata('location')) : 'Select Your City'; ?></p></a> -->

                                <!-- The Modal -->
                            <?php $this->load->view('common/location_modal');?>
                        </div>
                            </div>
                           </div> 
                        </div>
                    </div>
                </div>
        </section>
    </div>