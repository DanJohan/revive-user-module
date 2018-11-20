<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class JobcardModel extends MY_Model {

	protected $table = 'job_cards';

	public function __construct()
	{
	    parent::__construct();
	}

	public function getUserAllJobCard($user_id){
		$this->db->select('jc.id as job_card_id,c.registration_no,c.color,cb.brand_name,cm.model_name'
		);
		$this->db->from($this->table.' AS jc');
		//$this->db->join('repair_orders AS ro','jc.id=ro.job_card_id','left');
		$this->db->join('cars AS c', 'jc.car_id = c.id');
		$this->db->join('car_brands AS cb', 'c.brand_id=cb.id');
		$this->db->join('car_models AS cm', 'c.model_id=cm.id');
		$this->db->where('jc.user_id',$user_id);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array();
	}

}