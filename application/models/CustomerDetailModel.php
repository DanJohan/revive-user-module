<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CustomerDetailModel extends MY_Model {

	protected $table = 'customer_details';

	public function __construct()
	{
	    parent::__construct();
	}
	public function getByUserId($order_id) {
		$this->db->select('name,email,phone,address,landmark');
		$this->db->from($this->table);
		$this->db->where('id',$order_id);
		$result = $this->db->get()->row_array();
		return $result;
	}
	public function getByOrderId($order_id) {
		$this->db->select('name,email,phone,address,landmark');
		$this->db->from($this->table);
		$this->db->where('order_id',$order_id);
		$result = $this->db->get()->row_array();
		return $result;
	}

}
