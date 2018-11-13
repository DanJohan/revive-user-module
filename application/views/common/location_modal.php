<!-- The Modal -->
<div class="modal" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content location__select">
			<!-- Modal Header -->
			<h1 class="modal-main-head">Where do you stay? </h1>
			<div class="modal-header header-m-border" onclick="location.assign(config.baseUrl+'service/set_location/delhi')">
				<div class="city-top row">

					<div class="col-sm-6">
						<img class="img-fluid m-img" src="<?php echo base_url();?>assets/img/delhi.png" alt="Gurgaon City Pic">
					</div>
					<div class="col-sm-6">
						<h2 class="selected-city-name">Delhi</h2>
					</div>
				</div>

			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<div class="or-section">
					<div class="or-div">
						<span class="or-text">Or Select your city</span>
					</div>
				</div>
				<div class="top-cities-text"> Cities we provide service
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="location-outer" onclick="location.assign(config.baseUrl+'service/set_location/gurugram')">
							<img class="img-fluid m-img" src="<?php echo base_url();?>assets/img/gurugram.png">
							<h4 class="m-head">Gurugram</h4>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="location-outer" onclick="location.assign(config.baseUrl+'service/set_location/delhi')">
							<img class="img-fluid m-img" src="<?php echo base_url();?>assets/img/delhi.png">
							<h4 class="m-head">Delhi</h4>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="location-outer" onclick="location.assign(config.baseUrl+'service/set_location/noida')">
							<img class="img-fluid m-img" src="<?php echo base_url();?>assets/img/noida.png">
							<h4 class="m-head">Noida</h4> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> 
</div>
