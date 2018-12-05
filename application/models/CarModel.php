<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CarModel extends MY_Model {

	protected $table = 'cars';

	public function __construct()
	{
	    parent::__construct();
	}

	public function getByUserId($user_id) {
		$this->db->select('c.id,c.user_id,c.model_id,c.brand_id,c.registration_no,c.body,c.image,cm.model_name,cb.brand_name');
		$this->db->from($this->table." AS c");
		$this->db->join('car_models AS cm','c.model_id = cm.id');
		$this->db->join('car_brands AS cb','c.brand_id = cb.id');
		$this->db->where('c.user_id',$user_id);
		$query = $this->db->get();
		$result = $query->result_array();
		return (!empty($result))? $result :false;
	}
	public function getRegNoByCarID($car_id) {
		$this->db->select('registration_no');
		$this->db->from($this->table);
		$this->db->where('id',$car_id);
		$query = $this->db->get();
		$result = $query->row_array();
		return (!empty($result))? $result :false;
	}
	

}
?>	

