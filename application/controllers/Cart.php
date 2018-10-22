<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('basket');
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
		$this->load->view('home/checkout');
	}
}

?>