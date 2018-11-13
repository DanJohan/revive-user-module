<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('CarBrandModel');
			$this->load->model('CarModelsModel');
			$this->load->model('ServiceModel');
		}

		public function set_location($location =null){
			if($location){
				$this->session->set_userdata('location',$location);
			}
			redirect($this->agent->referrer());
		}

		public function select_service($service_id=null){
		 //display carservice page 
			if($this->session->has_userdata('is_user_login')){
					redirect('car/show_car/');
				}
			$data=array();
			$data['service_id'] = $service_id;
			$data['all_carbrand'] =  $this->CarBrandModel->get_all();
			$data['all_carmodel'] =  $this->CarModelsModel->getModelsWithBrand();
			
			$this->render('service/select_service',$data);
			
		}
		public function find_service(){ //display findservice page 
			$data=array();
			$model_id = $this->input->get('model_id');
            $service_cat_id = $this->input->get('service_cat_id');
            $car_id = $this->input->get('car_id');
            $data['service_cat_id'] = $service_cat_id;
			if(!$model_id){
				redirect('service/select_service');
			}
			if(!$car_id){
				$this->session->unset_userdata('car_id');
			}else{
				$this->session->set_userdata('car_id',$car_id);
			}
			$data['car_detail']= $this->CarModelsModel->getCarByModelId($model_id);
			//dd($data['car_detail']);
			$this->session->set_userdata('model_id',$model_id);
            $this->session->set_userdata('service_cat_id',$service_cat_id);
          	//dd($_SESSION);
			$data['all_carimage'] = $this->CarModelsModel->getImageByModelName($model_id);
			$data['all_carservices'] = $this->ServiceModel->getServicesByModel($model_id,$service_cat_id);
			$cartItems = $this->basket->getItems();
			$data['cart_items_id'] = array_keys($cartItems);
			
				$this->render('service/find_service',$data);
		
		}
		public function getCarModels(){
			if($this->input->post('brand_id')){
				$brand_id = $this->input->post('brand_id');
				$models = $this->CarModelsModel->getModelsByBrandId($brand_id);

				if(!empty($models)){
					$template = '';
					foreach ($models as $index => $data) {
						$template.='<option value="'.$data['id'].'">'.$data['model_name'].'</option>';
					}
					$this->renderJson(array('status'=>true,'template'=>$template));
				}else{

					$this->renderJson(array('status'=>false,'message'=>'data not found!'));
				}
			}
		}
	}


	?>
