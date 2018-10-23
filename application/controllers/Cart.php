<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('sequence');
		$this->load->model('OrderModel');
		$this->load->model('OrderItemModel');
		$this->load->model('CustomerDetailModel');
		$this->load->model('CarModelsModel');
	}

	public function add(){
		$is_added =false;
		if($this->input->post('service_id')){
			$service_id = $this->input->post('service_id');
			$price = $this->input->post('price');
			$name = $this->input->post('service_name');
			$is_added = $this->basket->add($service_id,1,[
			  'price'  => $price,
			  'service'  => $name,
			]);
		}

		if($is_added){
			$total_items = $this->basket->getTotalItem();
			$response = array('status'=>true,'total_items'=>$total_items,'message'=>'Item added successfully!');
			//return true;
		}else{
			$response = array('status'=>false,'message'=>'Something went wrong!');
		}

		$this->renderJson($response);
	}	

	public function remove(){

		$is_remove =false;
		$service_id = $this->input->post('service_id');
		$price = $this->input->post('price');
		$name = $this->input->post('name');
	// Remove item #id with attributes
		$is_remove = $this->basket->remove($service_id);

		if($is_remove){
			$total_items = $this->basket->getTotalItem();
			$response = array('status'=>true,'total_items'=>$total_items,'message'=>'Item removed successfully!');
			//return true;
		}else{
			$response = array('status'=>false,'message'=>'Something went wrong!');
		}

		$this->renderJson($response);
	}	

	public function checkout(){
		if($this->basket->isEmpty()){
			redirect('service/select_service');
		} 
		// Get all items in the cart
		$data = array();
		$data['allItems'] = $this->basket->getItems();
		$this->render('cart/checkout',$data);
		
	}

	public function userinfo(){ 

		if(! $this->session->has_userdata('is_user_login')){
			redirect('user/login/?redirect_to_checkout=true');
		}

		if($this->basket->isEmpty()){
			redirect('service/select_service');
		}
		$data = array();
		$model_id= $this->session->userdata('model_id');
		$data['car_image'] = $this->CarModelsModel->getImageByModelName($model_id);
		$data['car_detail']= $this->CarModelsModel->getCarByModelId($model_id);
		$this->render('cart/userinfo',$data);
	
	} 

	public function store_order(){
		//dd($_POST);
			if(count($_POST) > 0 ) { 
				$this->sequence->createSequence('order');
				$sequence = $this->sequence->getNextSequence();
				$order_data = array(
					'order_no' =>$sequence['sequence'],
					'hash'=> md5(uniqid(true)),
					'pick_up_date' => date('Y-m-d',strtotime($this->input->post('pick_up_date'))),
					'pick_up_time' => $this->input->post('pick_up_time'),
					'service_type' => $this->input->post('service'),
					'service_center' => '1',
					'sub_total' => $this->input->post('subtotal'),
					'net_pay_amount' => $this->input->post('taxtotal'),
					//'model_id' => $this->input->post('model_id'),
					//'registration_no' => $this->input->post('reg_no'),
					//'car_id' => '0',
					'channel' => '1',
					'created_at' =>date('Y-m-d H:i:s')


			);

				$order_id = $this->OrderModel->insert($order_data);
				if($order_id) {

					$this->sequence->updateSequence();
					$customer_data = array(
						'order_id' => $order_id,
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'phone' => $this->input->post('phone'),
						'address' => $this->input->post('address')."\n".$this->input->post('landmark')
					);
				
					$this->CustomerDetailModel->insert($customer_data);

					$order_items = $this->basket->getItems();
					if(!empty($order_items)) {
						foreach ($order_items as $index => $order_item) {
							foreach($order_item as $item) {
								$order_item_data[] = array(
										'order_id'=>$order_id,
										'service_id'=> $item['id'],
										'name' => $item['attributes']['service'],
										'price' =>$item['attributes']['price'],
								);
							}
						}

						if(!empty($order_item_data)){
							$this->OrderItemModel->insert_batch($order_item_data);
						}
					}

					$order_detail = $this->OrderModel->getById($order_id);
					//dd($order_detail);
					$this->basket->clear();
					redirect('cart/confirmed/'.$order_detail['id']);
						
				}
				
			}
			redirect('cart/checkout');
		}// end of store method

	public function confirmed($id){
		if(!$id){
			redirect('cart/checkout');
		}

		$data['order'] = $this->OrderModel->getById($id);
		$this->render('cart/confirmed',$data);

	}

}

?>