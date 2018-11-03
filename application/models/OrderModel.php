<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class OrderModel extends MY_Model {

	protected $table = 'placed_orders';

	public function __construct()
	{
	    parent::__construct();
	}

	public function getById($order_id) {
		$this->db->select('id,order_no,sub_total,pick_up_date,pick_up_time,discount_amount,net_pay_amount,created_at');
		$this->db->from($this->table);
		$this->db->where('id',$order_id);
		$result = $this->db->get()->row_array();
		return $result;
	}

	public function getByUserId($user_id) {
		$this->db->select('o.id,o.order_no,o.pick_up_date,o.pick_up_time,o.created_at,cb.brand_name,cm.model_name');
		$this->db->from($this->table." AS o");
		$this->db->join('cars AS c','o.car_id = c.id');
		$this->db->join('car_models AS cm','c.model_id = cm.id');
		$this->db->join('car_brands AS cb','c.brand_id = cb.id');
		$this->db->where('o.user_id',$user_id);
		$this->db->order_by('o.id','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return (!empty($result))? $result :false;
	}

	public function getDetailByOrderId($id) {
		$this->db->select('o.id,o.paid,o.payment_type_id,o.order_no,o.pick_up_date,o.pick_up_time,o.created_at,cb.brand_name,cm.model_name,oi.id AS item_id,oi.name,oi.price');
		$this->db->from($this->table." AS o");
		$this->db->join('cars AS c','o.car_id = c.id');
		$this->db->join('car_models AS cm','c.model_id = cm.id');
		$this->db->join('car_brands AS cb','c.brand_id = cb.id');
		$this->db->join('order_items AS oi','o.id = oi.order_id');
		$this->db->where('o.id',$id);
		$query = $this->db->get();
		$result = $query->result_array();
		return (!empty($result))? $result :false;
	}


}
