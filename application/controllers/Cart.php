<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('OrderModel');
		$this->load->model('UserModel');
		$this->load->model('OrderItemModel');
		$this->load->model('CustomerDetailModel');
		$this->load->model('CarModelsModel');
		$this->load->model('CarModel');
		$this->load->model('ServiceCategoryModel');
		$this->load->library('sequence');
		$this->load->library('mailer');
		//$this->load->library('googlegeocoder');
	}
	public function index() {
		if (!$this->session->userdata['is_user_login'] == TRUE)
			{
			   redirect('user/login'); //redirect to login page
			}
			   redirect('car/show_car');
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
		$model_id= $this->session->userdata('model_id');
		$data['car_detail']= $this->CarModelsModel->getCarByModelId($model_id);
		$service_id = $this->session->userdata('service_cat_id');
		$data['service_detail']= $this->ServiceCategoryModel->getCategoryName($service_id);
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
		$model_id = $this->session->userdata('model_id');
		$user_id = $this->session->userdata('user_id');
		$data['user_detail']= $this->UserModel->get(array('id'=>$user_id));
		$data['car_detail']= $this->CarModelsModel->getCarByModelId($model_id);
		$data['pre_orders']= $this->CustomerDetailModel->get(array('email'=>$data['user_detail']['email'],'location_type' =>'1'));
		//dd($data['pre_orders']);
		if($this->session->has_userdata('car_id')){
			$car_id = $this->session->userdata('car_id');
			$data['car_reg_no'] = $this->CarModel->getRegNoByCarID($car_id);
		}else{
			$data['car_reg_no']['registration_no'] = '';
		}

		$this->render('cart/userinfo',$data);
	}

	public function loc_address(){
		$email = $this->input->post('email');
		$locid = $this->input->post('locid');
		$pre_order= $this->CustomerDetailModel->get(array('email'=>$email,'location_type'=> $locid));
		if($pre_order){
			
			$response = array('status'=>true,'message'=>'Location find successfully!','data'=>$pre_order);
			//return true;
		}else{
			$response = array('status'=>false,'message'=>'No Address saved before!');
		}

		$this->renderJson($response);
	}	

	
	public function store_order(){
		
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
            else if($location == "gaziabad"){
              $service_center = '4';
            }
            else{
            	$service_center = '0';
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
			
			$order_id = $this->OrderModel->insert($order_data);
			if($order_id) {
				$this->sequence->updateSequence();
				$location_type = $this->input->post('location_type');
				if($location_type == ''){
					$location_type = '1';
				}else{
					$location_type = $this->input->post('location_type');
				}
                /*
				$addressData = implode(', ', array($this->input->post('address')));
				$data_arr = geocode($addressData);
				print_r($data_arr);die;
				*/

			/*$address = $this->input->post('address');  // Address

			// Get JSON results from this request
			$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
			$geo = json_decode($geo, true); // Convert the JSON to an array

			if (isset($geo['status']) && ($geo['status'] == 'OK')) {
			 echo $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
			 echo $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude 
			}*/
  				$customer_data = array(
					'order_id' => $order_id,
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'phone' => $this->input->post('phone'),
					'address' => $this->input->post('address'),
					'landmark' => $this->input->post('landmark'),
					'location_type' => $location_type,
					/*'latitude' => '0.00000',
					'longitude' => '0.00000'*/
					
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

                $pusher = new Pusher\Pusher(PUSHER_KEY,PUSHER_SECRET,PUSHER_APP_ID,array('cluster' => PUSHER_CLUSTER,'useTLS' => true));
                 $data['message'] = 'You have new order received!';
                 $pusher->trigger('order', 'receive-order', $data);

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
	    $this->OrderModel->update(array('payment_type_id'=>1,'paid'=>1),array('hash'=>$hash));
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
		$data['customerdetail'] = $this->CustomerDetailModel->getByOrderId($order['id']);
		$order_details = $this->OrderModel->getDetailByOrderId($order['id']);
		$order_item_keys= array('item_id','sname','price');
		$order_items = array_unique(array_column_multi($order_details,$order_item_keys),SORT_REGULAR);
		$order_details = $order_details[0];
		foreach($order_item_keys as $key) {
		   unset($order_details[$key]);
		}
		$order_details['order_items'] = $order_items;
	    $data['orderdetails'] =$order_details;
	   //dd($data);
	       		$from_email = $data['orderdetails']['customer_email'];
        	    $name = $data['orderdetails']['customer_name']; 
        	    $to_email = "contact@reviveauto.in";
        	    $message = "Booking Order Details"; 
        		$this->mailer->setFrom(MAIL_USERNAME);
        		$this->mailer->addAddress($to_email);
        		$this->mailer->subject('Revive Auto Booking Order Details');
        	    //$this->mailer->body('Testing Email');
        		$this->mailer->body($this->load->view('cart/email_order',$data,true));
        		$this->mailer->isHTML();
        		$mail=$this->mailer->send();
        		$this->render('cart/confirmed',$data);

	}
	public function my_order(){
		$data = array();
		$user_id = $this->session->userdata('user_id');
		$data['my_order'] = $this->OrderModel->getByUserId($user_id);
		//dd($data);
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
		//echo $this->db->last_query();die;
		//dd($order_details);
		$order_item_keys= array('item_id','sname','price');
		$order_items = array_filter_by_value(array_unique(array_column_multi($order_details,$order_item_keys),SORT_REGULAR),'item_id','');
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
		$order_items = array_filter_by_value(array_unique(array_column_multi($order_details,$order_item_keys),SORT_REGULAR),'item_id','');
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
		$this->OrderModel->update(array('status'=>2),array('id'=>$order_id));
		//echo $this->db->last_query();die;
		redirect('cart/my_order');
	}
	
	public function remove_order_item($id=null,$hash=null){
		if(!$id || !$hash){
			redirect('cart/my_order');
		}
		$data =array();
		$criteria['field'] = 'id';
		$criteria['conditions'] = array('hash'=>$hash);
		$criteria['returnType'] = 'single';
		$order = $this->OrderModel->search($criteria);

		if(empty($order)) {
			redirect('cart/modify_order/'.$hash);
		}

		$is_delete = $this->OrderItemModel->delete(array('id'=>$id,'order_id' =>$order['id']));
		//echo $this->db->last_query();die;
		if($is_delete){
			$total_items = $this->OrderModel->update(array('id'=>$order['id']));

			$total_items = $this->OrderItemModel->getItemPriceByOrderId($order['id']);
			$final_total = array_sum(array_column($total_items, 'price'));
			$this->OrderModel->update(array('sub_total'=>$final_total,'net_pay_amount'=>$final_total),array('id'=>$order['id']));

			$this->session->set_flashdata('success_msg','Your item is successfully deleted'); 
        }else{
                $this->session->set_flashdata('error_msg','Some error occur, Try again');
        }

		redirect('cart/modify_order/'.$hash);
	}

	public function add_order(){

		if($this->input->post('service_id')){
			$order_id =$this->input->post('order_id');
			$insert_data = array(
				'service_id' => $this->input->post('service_id'),
				'price' => $this->input->post('price'),
				'name' => $this->input->post('service_name'),
				'order_id' => $order_id,
			);
			$insert_id = $this->OrderItemModel->insert($insert_data);

			$criteria['field'] = 'discount_amount';
			$criteria['conditions'] = array('id'=>$order_id);
			$criteria['returnType'] = 'single';

			$discount = $this->OrderModel->search($criteria);

			$total_items = $this->OrderItemModel->get_all(array('order_id'=>$order_id));
			
			$sub_total = array_sum(array_column($total_items, 'price'));
			$net_pay_amount = $sub_total-$discount['discount_amount'];
			$is_update = $this->OrderModel->update(array('sub_total'=>$sub_total,'net_pay_amount'=>$net_pay_amount),array('id'=>$order_id));
			
			$response = array('status'=>true,'message'=>'inserted successfully','total_items'=>count($total_items));
		}else{
			$response = array('status'=>false,'message'=>'parameter required!');
		}

		$this->renderJson($response);

	}

	public function remove_order(){
		if($this->input->post('service_id')){
			$order_id =$this->input->post('order_id');
			$remove_data = array(
				'service_id' => $this->input->post('service_id'),
				'price' => $this->input->post('price'),
				'name' => $this->input->post('service_name'),
				'order_id' => $order_id,
			);
			$remove_id = $this->OrderItemModel->delete($remove_data);

			$criteria['field'] = 'discount_amount';
			$criteria['conditions'] = array('id'=>$order_id);
			$criteria['returnType'] = 'single';

			$discount = $this->OrderModel->search($criteria);

			$total_items = $this->OrderItemModel->get_all(array('order_id'=>$order_id));
			if(!$total_items) {
				$total_items = array();
			}
			$sub_total = array_sum(array_column($total_items, 'price'));
			$net_pay_amount = $sub_total-$discount['discount_amount'];
			$is_update = $this->OrderModel->update(array('sub_total'=>$sub_total,'net_pay_amount'=>$net_pay_amount),array('id'=>$order_id));
			
			$response = array('status'=>true,'message'=>'deleted successfully','total_items'=>count($total_items));
		}else{
			$response = array('status'=>false,'message'=>'parameter required!');
		}

		$this->renderJson($response);
		//redirect('cart/modify_order/'.$hash);
	}

	public function remove_lv($hash=null){
		
		$this->OrderModel->update(array('loaner_vehicle'=>0),array('hash'=>$hash));
		echo $this->db->last_query();
		
	}
	public function update_order($hash=null){
		$data=array();
		if(count($_POST) > 0 ) { 
			$order_id =$this->input->post('order_id');

				$update_user_data = array(
	            	'name'=>$this->input->post('name'),
	            	'email'=>$this->input->post('email'),
	            	'phone'=>$this->input->post('phone'),
	            	'address' => $this->input->post('address'),
					'landmark' => $this->input->post('landmark')
	            
          		);
          		//dd($update_user_data);
		     	$update_id = $this->CustomerDetailModel->update($update_user_data, array('order_id'=>$order_id));
		    
		      	$update_order_data = array(
			      	'pick_up_date' => date('Y-m-d',strtotime($this->input->post('pick_up_date'))),
					'pick_up_time' => $this->input->post('pick_up_time'),
				//'created_at' =>date('Y-m-d H:i:s')
				);
				$this->OrderModel->update($update_order_data, array('id'=>$order_id));
			
				$criteria['field'] = 'hash,car_id';
				$criteria['conditions'] = array('id'=>$order_id);
				$criteria['returnType'] ='single';
				$order_details = $this->OrderModel->search($criteria);
					//dd($data);		
				if(!$order_details){
					redirect('cart/my_order');
				}
				//$car_details = $this->OrderModel->getById($order_id);
				$car_data = array(
	            	'registration_no'=>$this->input->post('reg_no'),
	            	//'created_at' => date('Y-m-d H:i:s')
          		);
        		$this->CarModel->update($car_data, array('id'=>$order_details['car_id']));
        			
        		
        		redirect('cart/selectpaymentmethod/'.$order_details['hash']);
        		
        }
        redirect('/');
      		
	}// end of store method

}
?>
