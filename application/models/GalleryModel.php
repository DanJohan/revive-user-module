<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class GalleryModel extends MY_Model {

	protected $table = 'gallery_images';
 
	public function __construct()
	{
	    parent::__construct();
	}

	public function getGallery() {
		$this->db->select('id,title,image');
		$this->db->from($this->table);
		$this->db->limit(6);
		$query = $this->db->get();
		$result = $query->result_array();
		return (!empty($result))? $result :false;
	}

}
