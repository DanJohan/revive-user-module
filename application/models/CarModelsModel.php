<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CarModelsModel extends MY_Model {

	protected $table = 'car_models';

	public function __construct()
	{
	    parent::__construct();
	}

	public function getModelsWithBrand(){
		$this->db->select('cm.*,cb.brand_name');
		$this->db->from($this->table.' AS cm');
		$this->db->join('car_brands AS cb','cm.brand_id=cb.id');
		$query = $this->db->get();
		$result = $query->result_array();
		return (!empty($result))? $result :false;
	}


	public function getModelsByBrandId($brand_id) {
		$this->db->select('id, model_name');
		$this->db->from($this->table);
		$this->db->where('brand_id',$brand_id);
		$query = $this->db->get();
		$result = $query->result_array();
		return (!empty($result))? $result :false;
	}

	public function getImageByModelName($model_id) {
		$this->db->select('image');
		$this->db->from($this->table);
		$this->db->where('id',$model_id);
		$query = $this->db->get();
		$result = $query->result_array();
		return (!empty($result))? $result :false;
	}

	public function getCarByModelId($model_id) {
		$this->db->select('m.id,m.model_name, b.brand_name');
		$this->db->from($this->table.' AS m');
		$this->db->join('car_brands AS b','m.brand_id = b.id');
		$this->db->where('m.id',$model_id);
		$query = $this->db->get();
		$result = $query->row_array(); 
		return (!empty($result))? $result :false;
	}

		
}
?>