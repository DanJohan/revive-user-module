<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('basket');
	}

	public function add(){
		//$this->basket->clear();
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
			return true;
		}
		var_dump($a);
		$allItems = $this->basket->getItems();
		echo $this->basket->getTotalQuantity();
		dd($allItems);
	}

	public function remove(){

	}	

}

?>