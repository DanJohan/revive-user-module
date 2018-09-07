<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class RepairOrderModel extends MY_Model {

		protected $table = 'repair_orders';

		public function __construct()
		{
		    parent::__construct();
		}

	   public function getRepairOrderByJobId($job_card_id,$user_id=null){
		$this->db->select('ro.id AS repair_order_id,ro.parts_name,ro.customer_request,ro.sa_remarks,ro.qty,ro.labour_price,ro.parts_price,ro.total_price,ro.status,ro.start_date,ro.end_date,ro.delay_reason'
		);
		$this->db->from($this->table.' AS ro');
		$this->db->join('job_cards AS jc','ro.job_card_id=jc.id');
		$this->db->where('ro.job_card_id',$job_card_id);
		if($user_id){
			$this->db->where('jc.user_id',$user_id);
		}
		$query = $this->db->get();
		//$this->db->last_query();
		return $query->result_array();
	}
	
}