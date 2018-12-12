  <section class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <div class="social-address">
                            <a class="top-icon" href="#"><span><i class="fa fa-phone" style="transform: rotate(90deg);"></i>+91-9899645800</span></a>
                            <a class="top-icon" href="#"><span><i class="fa fa-envelope"></i>contact@reviveauto.in</span></a> 
                       </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 top-bar-list">
                        
                            <div class="social-icons">
                            <ul>
                               <li>
                                <a href="https://www.facebook.com/ReviveAuto.in/"><i class="fab fa-facebook-f fb-color"></i></a></li>
                                <li><a href="https://twitter.com/ReviveAuto_in"><i class="fab fa-twitter twtr-color"></i></a></li>
                                <li><a href="https://www.instagram.com/reviveauto.in/"><i class="fab fa-instagram plus-color"></i></a></li>
                            </ul>
                            <ul class="models_list">
                                <a href="#"><p class="btn btn-modal" data-toggle="modal" data-target="#myModal"><?php echo ($this->session->has_userdata('location')) ? ucfirst($this->session->userdata('location')) : 'Select Your City'; ?>
                                <i class="fa fa-angle-down" aria-hidden="true"></i></p></a>

                               <!-- <a href="#"><p class="btn btn-info modal-btn" data-toggle="modal" data-target="#myModal"><?php //echo ($this->session->//has_userdata('location')) ? ucfirst($this->session->userdata('location')) : 'Select Your City'; ?></p></a> -->

                                <!-- The Modal -->
                            <?php $this->load->view('common/location_modal');?>
                        </ul>
                                    
                            </div>
                           
                                
                            
                            
                         
                        </div>
                    </div>
                </div>
        </section>