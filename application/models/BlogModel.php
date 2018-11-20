<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BlogModel extends MY_Model {

	protected $table = 'blogs';
 
	public function __construct()
	{
	    parent::__construct();
	}

	public function getBlogs() {
		$this->db->select('id,title,slug,image,description');
		$this->db->from($this->table);
		$this->db->limit(3);
		$query = $this->db->get();
		$result = $query->result_array();
		return (!empty($result))? $result :false;
	}

}
