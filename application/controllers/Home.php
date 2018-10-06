<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct(){
		parent::__construct();
		
	}
	public function index(){
		$data['view'] = 'web/index';
		$this->load->view('web/layout',$data);

	}

	public function select(){
		//$data['view'] = 'web/select';
		$this->load->view('web/select');

	}
	
}
?>