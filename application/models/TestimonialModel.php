<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class TestimonialModel extends MY_Model {

	protected $table = 'testimonials';
 
	public function __construct()
	{
	    parent::__construct();
	}

	public function getTestimonial() {
		$this->db->select('author_name,author_designation,author_image,description');
		$this->db->from($this->table);
		//$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->result_array();
		return (!empty($result))? $result :false;
	}

}
