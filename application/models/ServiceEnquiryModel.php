<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ServiceEnquiryModel extends MY_Model {

	protected $table = 'service_enquiries';

	public function __construct()
	{
	    parent::__construct();
	}
 
	
	// used in user panel(user enquiries)
	public function getEnquiryByUser($id){
		$this->db->select('u.id AS user_id,e.enquiry,e.service_type,e.address,e.updated_at,c.registration_no,c.id AS car_id,m.model_name,b.brand_name');
		$this->db->from($this->table.' AS e');
		$this->db->join('users AS u', 'e.user_id=u.id');
		$this->db->join('cars AS c', 'c.user_id=u.id');
		$this->db->join('car_models AS m', 'c.model_id=m.id');
		$this->db->join('car_brands AS b', 'c.brand_id=b.id');
		$this->db->where(array('c.user_id'=>$id));
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result_array();
		return (!empty($result))? $result : false;
	}

	public function getEnquiryByUid($id){
		$this->db->select('u.id AS user_id,e.id,e.enquiry,e.service_type,e.address,e.updated_at,c.registration_no,c.id AS car_id,m.model_name,b.brand_name');
		$this->db->from($this->table.' AS e');
		$this->db->join('users AS u', 'e.id=u.id');
		$this->db->join('cars AS c', 'c.user_id=u.id');
		$this->db->join('car_models AS m', 'c.model_id=m.id');
		$this->db->join('car_brands AS b', 'c.brand_id=b.id');
		$this->db->where(array('e.id'=>$id));
		$query = $this->db->get();
		echo $this->db->last_query();die;
		$result = $query->result_array();
		return (!empty($result))? $result : false;
	}

}
