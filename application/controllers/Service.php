<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends MY_Controller {

		public function __construct(){
			parent::__construct();
			if (!$this->session->userdata['is_user_login'] == TRUE)
			{
			   redirect('user/login'); //redirect to login page
			}
			$this->load->model('CarBrandModel');
			$this->load->model('CarModelsModel');
			$this->load->model('ServiceModel');
			$this->load->model('OrderModel');
			$this->load->model('OrderItemModel');
		}
		public function index() {
			redirect('car/show_car');
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
			//$data['all_carimage'] = $this->CarModelsModel->getImageByModelName($model_id);
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

		public function add_more_service($hash=null){ //display add_more_service page 
			$hash = $this->input->get('hash');
			$model_id = $this->input->get('model_id');
			$service_cat_id = $this->input->get('service_cat_id');

			if(!$hash || !$model_id || !$service_cat_id){
				redirect('cart/modify_order/'.$hash);
			}

			$criteria['field'] = 'id';
			$criteria['conditions'] = array('hash'=>$hash);
			$criteria['returnType'] = 'single';

			$order = $this->OrderModel->search($criteria);

			if(!$order){
				redirect('/');
			}
			$data['order_id'] = $order['id'];
			$data['service_cat_id'] = $service_cat_id;
			$data['model_id'] = $model_id;
			$data['car_detail']= $this->CarModelsModel->getCarByModelId($model_id);
			//$data['all_carimage'] = $this->CarModelsModel->getImageByModelName($model_id);
			$data['all_carservices'] = $this->ServiceModel->getServicesByModel($model_id,$service_cat_id);

			$data['order_items'] = $this->OrderItemModel->get_all(array('order_id'=>$order['id']));
			if($data['order_items']) {
				$data['service_ids'] = array_column($data['order_items'],'service_id');
			}else{
				$data['service_ids'] = array();
				$data['order_items'] =array();
			}
			//dd($data);
			$this->render('service/add_more_service',$data);
		
		}
	}


	?>
