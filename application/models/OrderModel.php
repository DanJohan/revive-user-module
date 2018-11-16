<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class OrderModel extends MY_Model {

	protected $table = 'placed_orders';

	public function __construct()
	{
	    parent::__construct();
	}

	public function getById($order_id) {
		$this->db->select('id,order_no,car_id,hash,sub_total,pick_up_date,pick_up_time,discount_amount,net_pay_amount,created_at');
		$this->db->from($this->table);
		$this->db->where('id',$order_id);
		$result = $this->db->get()->row_array();
		return $result;
	}


	public function getByUserId($user_id) {
		$this->db->select('o.id,o.hash,o.status, o.order_no,o.pick_up_date,o.pick_up_time,o.created_at,cb.brand_name,cm.model_name');
		$this->db->from($this->table." AS o");
		$this->db->join('cars AS c','o.car_id = c.id');
		$this->db->join('car_models AS cm','c.model_id = cm.id');
		$this->db->join('car_brands AS cb','c.brand_id = cb.id');
		$this->db->where('o.user_id',$user_id);
		$this->db->where('o.status!=',2);
		$this->db->order_by('o.id','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return (!empty($result))? $result :false;
	}
	public function getDetailByOrderId($id) {

		$this->db->select('o.id,o.hash,o.paid,o.payment_type_id,o.order_no,o.pick_up_date,o.pick_up_time,o.created_at,o.loaner_vehicle,o.sub_total,cb.brand_name,cm.model_name,oi.id AS item_id,oi.name AS sname,oi.price,sc.id AS service_id,sc.name,cd.name AS customer_name,cd.email AS customer_email,cd.phone AS customer_phone,cd.address,cd.landmark,c.registration_no,c.brand_id,c.model_id,pt.name AS payment_name');
		$this->db->from($this->table." AS o");
		$this->db->join('cars AS c','o.car_id = c.id','left');
		$this->db->join('car_models AS cm','c.model_id = cm.id','left');
		$this->db->join('car_brands AS cb','c.brand_id = cb.id','left');
		$this->db->join('services_category AS sc','o.service_type = sc.id','left');
		$this->db->join('order_items AS oi','o.id = oi.order_id','left','left');
		$this->db->join('customer_details AS cd','o.id = cd.order_id','left');
		$this->db->join('payment_types AS pt','o.payment_type_id = pt.id','left');
		$this->db->where('o.id',$id);
		$query = $this->db->get();
		$result = $query->result_array();
		return (!empty($result))? $result :false;
	}

}
