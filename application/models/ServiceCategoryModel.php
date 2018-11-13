<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ServiceCategoryModel extends MY_Model {

	protected $table = 'services_category';

	public function __construct()
	{
	    parent::__construct();
	}

	public function getCategoryName($service_id) {
		$this->db->select('name');
		$this->db->from($this->table);
		$this->db->where('id',$service_id);
		$query = $this->db->get();
		$result = $query->row_array();
		return (!empty($result))? $result :false;
	}
}