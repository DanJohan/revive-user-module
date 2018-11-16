<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Car extends MY_Controller {

		public function __construct(){
			parent::__construct();
		if (!$this->session->userdata['is_user_login'] == TRUE)
			{
			   redirect('user/login'); //redirect to login page
			}
			$this->load->model('CarBrandModel');
			$this->load->model('CarModelsModel');
			$this->load->model('CarModel');
			$this->load->model('CarBodyModel');
		}

		public function index() {
			redirect('car/add_car');
		}
		public function add_car(){ // layout display
			$data = array();
			$data['all_carbrand'] =  $this->CarBrandModel->get_all();
			$data['all_carmodel'] =  $this->CarModelsModel->getModelsWithBrand();
			$data['car_bodies'] = $this->CarBodyModel->get_all();
			$this->render('car/add_car',$data);
		}

		public function insert_car(){
		if(! $this->session->has_userdata('is_user_login')){
            $this->session->set_flashdata('error_msg','Please login to continue');
			redirect('user/login/');
		}
			$file_name = '';
				if(isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
					$path= CRM_BASE_PATH.'uploads/app/';
					$config['new_name']=true;
					$upload= $this->do_upload('image',$path,$config);
					//dd($upload);
					if(isset($upload['upload_data'])){
						$file_name = $upload['upload_data']['file_name'];

					}
				}
				$data = array(
					'user_id' => $this->session->userdata('user_id'),
					'brand_id' => $this->input->post('brand_id'),
					'model_id' => $this->input->post('model_id'),
					'registration_no' => $this->input->post('reg_no'),
					//'body' => $this->input->post('car_body'),
					'image' => $file_name,
					'created_at' => date('Y-m-d H:i:s')

				);
				//dd($data);
				$result = $this->CarModel->insert($data);

			    if($result){
					$this->session->set_flashdata('success_msg', 'Car is Added Successfully!');
					redirect(base_url('car/show_car'));
					//print_r($data);die;
				}
				
				else{
					$this->session->set_flashdata('error_msg', 'Some problem occur!');
					redirect(base_url('car/add_car'));
					
				}
			}

			public function my_car(){
				$data = array();
				$this->render('car/my_car',$data);
			}

			public function show_car(){ 

				if(! $this->session->has_userdata('is_user_login')){
					redirect('user/login/');
				}
				$data = array();
				$user_id= $this->session->userdata('user_id');
				$data['car_detail']= $this->CarModel->getByUserId($user_id);
				//dd($data);
				$this->render('car/my_car',$data);
	
			}

			public function del_car($id){
				$result = $this->CarModel->delete(array('id'=>$id));
				if($result){
				$this->session->set_flashdata('success_msg', 'Car is deleted Successfully!');
				redirect('car/show_car');
			}else{
					$this->session->set_flashdata('error_msg', 'Some problem occur!');
					redirect('car/show_car');
			}
		}
	}
?>	