<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Car extends MY_Controller {

		public function __construct(){
			parent::__construct();
			
			$this->load->model('CarBrandModel');
			$this->load->model('CarModelsModel');
			$this->load->model('ServiceModel');
		}

		public function select_service(){ //display carservice page 

			$data=array();
			$data['all_carbrand'] =  $this->CarBrandModel->get_all();
			$data['all_carmodel'] =  $this->CarModelsModel->getModelsWithBrand();
			$this->load->view('home/select', $data);
			
		}

		public function find_service(){ //display findservice page 

			$data=array();
			$model_id = $this->input->get('model_id');
			$data['all_carservices'] = $this->ServiceModel->getServicesByModel($model_id);
			//dd($data);
			$this->load->view('home/cart',$data);
			
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
