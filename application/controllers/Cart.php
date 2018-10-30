<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('OrderModel');
		$this->load->model('OrderItemModel');
		$this->load->model('CustomerDetailModel');
		$this->load->model('CarModelsModel');
		$this->load->model('CarModel');
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
            $this->session->set_flashdata('error_msg','Please login to continue');
			redirect('user/login/');
		}

		if($this->basket->isEmpty()){
			redirect('service/select_service');
		}
		$data = array();
		$model_id= $this->session->userdata('model_id');
		//$data['car_image'] = $this->CarModelsModel->getImageByModelName($model_id);
		$data['car_detail']= $this->CarModelsModel->getCarByModelId($model_id);
		//dd($data);
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
						$this->session->set_userdata($order_item_data);
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



	public function selectPaymentMethod(){
		$data = array();
		$this->session->set_userdata('post_data',$this->input->post());
		//dd($this->session);
		$this->render('cart/selectpaymentmethod',$data);
	}


	public function cashOnDelievery(){
		$data = array();
		$this->order_store('1');
	}

	public function paytm(){
		$data = array();
		$this->order_store('3');
	}
	public function confirmed($id){
		if(!$id){
			redirect('cart/checkout');
		}

		$data['order'] = $this->OrderModel->getById($id);
		$this->render('cart/confirmed',$data);

	}

	public function my_order(){
		$data = array();
		$user_id = $this->session->userdata('user_id');
		$data['my_order'] = $this->OrderModel->getByUserId($user_id);
		$this->render('cart/my_order',$data);
	}
	public function order_detail($id){
		$data = array();
		$user_id = $this->session->userdata('user_id');
		$order_details = $this->OrderModel->getDetailByOrderId($id);

		$order_item_keys= array('item_id','name','price');
		$order_items = array_unique(array_column_multi($order_details,$order_item_keys),SORT_REGULAR);
		$order_details = $order_details[0];
		foreach($order_item_keys as $key) {
		   unset($order_details[$key]);
		}

		$order_details['order_items'] = $order_items;
		//dd($order_details);
		$data['orderdetails'] =$order_details;
		//dd($data);
		$this->render('cart/order_detail',$data);
	}

}
?>
