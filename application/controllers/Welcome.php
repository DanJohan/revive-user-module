<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		return;
		$this->load->view('home');
		
	}

	public function update_service(){
		for($i=1 ;$i<=15;$i++){
			for($j=1; $j<=103; $j++){
				$insert_data = array(
					'service_id'=>$i,
					'model_id' => $j,
					'price' => mt_rand(1000,5000),
					'created_at' =>date("Y-m-d H:i:s")
				);
				$insert_id = $this->db->insert('services',$insert_data);
				echo $insert_id." inserted </br>";
			}
		}
	}

	/*public function test(){
		$this->load->model('UserModel');
		$this->db->select('id,name,email,created_at');
		$this->db->from('users');
		$query = $this->db->get();
		dd($this->UserModel,false);
		$results = $query->result('UserModel');
		dd($results);
		foreach ($results as $key => $result) {
			echo $result->getHumanDate(),"</br>";
		}
		dd($result);
	}*/
}
