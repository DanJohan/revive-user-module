<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class OrderItemModel extends MY_Model {

	protected $table = 'order_items';

	public function __construct()
	{
	    parent::__construct();
	}

	public function getItemPriceByOrderId($order_id) {
		$this->db->select('id,order_id,name,service_id,price');
		$this->db->from($this->table);
		$this->db->where('order_id',$order_id);
		$result = $this->db->get()->result_array();
		return $result;
	}
}
