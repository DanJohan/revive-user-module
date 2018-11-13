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
		$this->load->model('ServiceCategoryModel');
		$this->load->library('sequence');
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
		
		//dd($data);
		// Get all items in the cart
		$data = array();
		$model_id= $this->session->userdata('model_id');
		$data['car_detail']= $this->CarModelsModel->getCarByModelId($model_id);
		$service_id = $this->session->userdata('service_cat_id');
		$data['service_detail']= $this->ServiceCategoryModel->getCategoryName($service_id);
		//dd($data['service_detail']);
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
		$data['car_detail']= $this->CarModelsModel->getCarByModelId($model_id);

		if($this->session->has_userdata('car_id')){
			$car_id = $this->session->userdata('car_id');
			$data['car_reg_no'] = $this->CarModel->getRegNoByCarID($car_id);
		}else{
			$data['car_reg_no']['registration_no'] = '';
		}

		//dd($data);
		$this->render('cart/userinfo',$data);

	
	} 
	
	public function store_order(){
		//dd($_SESSION);
		if(count($_POST) > 0 ) { 

			if($this->session->has_userdata('car_id')){
				$car_id = $this->session->userdata('car_id');
			}else{
				$car_data = array(
	            	'user_id'=>$this->session->userdata('user_id'),
	            	'brand_id'=>$this->input->post('brand_id'),
	            	'model_id'=>$this->input->post('model_id'),
	            	'registration_no'=>$this->input->post('reg_no'),
	            	'created_at' => date('Y-m-d H:i:s')
          		);
        	$car_id = $this->CarModel->insert($car_data);
         	}


            $location = $this->session->userdata('location');
            if($location == "delhi"){
              $service_center = '1';
            }
            else if($location == "noida"){
              $service_center = '2';
            }
           else if($location == "gurugram"){
              $service_center = '3';
            }

            if($this->session->has_userdata('service_cat_id')) {
              $service_cat_id = $this->session->userdata('service_cat_id');
            }
			$this->sequence->createSequence('order');
			$sequence = $this->sequence->getNextSequence();
			$user_id =$this->session->userdata('user_id');
			$hash =md5(uniqid($user_id,true));
			$order_data = array(
				'order_no' =>$sequence['sequence'],
				'hash'=> $hash,
				'pick_up_date' => date('Y-m-d',strtotime($this->input->post('pick_up_date'))),
				'pick_up_time' => $this->input->post('pick_up_time'),
				'service_type' => $service_cat_id,
				'loaner_vehicle' => $this->input->post('loaner_vehicle'),
				'service_center' => $service_center,
				'sub_total' => $this->input->post('subtotal'),
				'net_pay_amount' => $this->input->post('taxtotal'),
				'channel' => '1',
				'paid' => '0',
				'user_id' =>$user_id,
				'car_id' => $car_id,
				'created_at' =>date('Y-m-d H:i:s')
			);
			//dd($order_data);
			$order_id = $this->OrderModel->insert($order_data);
			if($order_id) {
				$this->sequence->updateSequence();
				$customer_data = array(
					'order_id' => $order_id,
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'phone' => $this->input->post('phone'),
					'address' => $this->input->post('address'),
					'landmark' => $this->input->post('landmark')
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
					//$this->session->set_userdata($order_item_data);
					if(!empty($order_item_data)){
						$this->OrderItemModel->insert_batch($order_item_data);
					}
				}
			     $this->basket->clear();
			     $this->session->unset_userdata('car_id');
			     $this->session->unset_userdata('model_id');
			     $this->session->unset_userdata('service_cat_id');
			  /* $this->session->unset_userdata('location');*/
				redirect('cart/order_billing/'.$hash);

			}
			
		}
		redirect('cart/checkout');
		
	}// end of store method

	public function selectPaymentMethod($hash=null){
		//dd($_SESSION);
		if(!$hash){
			redirect('/');
		}
		$data = array();
		$criteria['field'] = 'id,hash,net_pay_amount';
		$criteria['conditions'] = array('hash'=>$hash);
		$criteria['returnType'] ='single';
		$data['order'] = $this->OrderModel->search($criteria);
		if(!$data){
			redirect('cart/checkout');
		}
		$this->render('cart/selectpaymentmethod',$data);
	}


	public function cashOnDelievery($hash=null){
		if(!$hash){
			redirect('/');
		}
	    $this->OrderModel->update(array('payment_type_id'=>1),array('hash'=>$hash));
		redirect('cart/confirmed/'.$hash);
	}

	public function paytm(){
		$data = array();
		$this->order_store('3');
	}
	public function confirmed($hash=null){
		if(!$hash){
			redirect('cart/checkout');
		}
		$criteria['field'] = 'id';
		$criteria['conditions'] = array('hash'=>$hash);
		$criteria['returnType'] = 'single';

		$order = $this->OrderModel->search($criteria);

		if(!$order){
			redirect('/');
		}

		$data = array();
		$data['order'] = $this->OrderModel->getById($order['id']);
		//dd($data);
		$this->render('cart/confirmed',$data);

	}


	public function my_order(){
		$data = array();
		$user_id = $this->session->userdata('user_id');
		$data['my_order'] = $this->OrderModel->getByUserId($user_id);
		$this->render('cart/my_order',$data);
	}
	public function order_billing($hash =null){
		if(!$hash){
			redirect('/');
		}
		
		$criteria['field'] = 'id';
		$criteria['conditions'] = array('hash'=>$hash);
		$criteria['returnType'] = 'single';

		$order = $this->OrderModel->search($criteria);

		if(!$order){
			redirect('/');
		}

		$data = array();
		$user_id = $this->session->userdata('user_id');
		$order_details = $this->OrderModel->getDetailByOrderId($order['id']);
		//echo $this->db->last_query();
		//dd($order_details);
		$order_item_keys= array('item_id','sname','price');
		$order_items = array_unique(array_column_multi($order_details,$order_item_keys),SORT_REGULAR);
		$order_details = $order_details[0];
		foreach($order_item_keys as $key) {
		   unset($order_details[$key]);
		}
		$order_details['order_items'] = $order_items;
		$data['orderdetails'] =$order_details;
		//dd($data);
		$this->render('cart/order_billing',$data);
	}
	public function modify_order($hash=null){
		if(!$hash){
			redirect('/');
		}
		
		$criteria['field'] = 'id';
		$criteria['conditions'] = array('hash'=>$hash);
		$criteria['returnType'] = 'single';

		$order = $this->OrderModel->search($criteria);

		if(!$order){
			redirect('/');
		}

		$data = array();
		$user_id = $this->session->userdata('user_id');
		$order_details = $this->OrderModel->getDetailByOrderId($order['id']);
		//dd($order_details);
		$order_item_keys= array('item_id','sname','price');
		$order_items = array_unique(array_column_multi($order_details,$order_item_keys),SORT_REGULAR);
		$order_details = $order_details[0];
		foreach($order_item_keys as $key) {
		   unset($order_details[$key]);
		}
		$order_details['order_items'] = $order_items;
		$data['orderdetails'] =$order_details;
		//dd($data);
		$this->render('cart/modify_order',$data);
	}

	public function cancel_order($order_id){
		$this->OrderModel->delete(array('id'=>$order_id));
		redirect('cart/my_order');
	}
	public function remove_order_item($id=null,$order_id=null,$hash=null){
		if(!$id || !$order_id || !$hash){
			redirect('cart/my_order');
		}
		$data =array();
		$is_delete = $this->OrderItemModel->delete(array('id'=>$id,'order_id' =>$order_id));
		$total_items = $this->OrderItemModel->getItemPriceByOrderId($order_id);
		$final_total = array_sum(array_column($total_items, 'price'));
		$this->OrderModel->update(array('sub_total'=>$final_total,'net_pay_amount'=>$final_total),array('id'=>$order_id));
			if($is_delete){
			$this->session->set_flashdata('success_msg','Your item is successfully deleted'); 
            }else{
                $this->session->set_flashdata('error_msg','Some error occur, Try again');
            }

		redirect('cart/modify_order/'.$hash);
	}

}
?>
