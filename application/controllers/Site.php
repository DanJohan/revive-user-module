<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends MY_Controller {

	public function __construct(){
		parent::__construct();
		
	}
	public function index(){
		$data= array();
		//dd($this->session);
		$this->render('site/index',$data,'layouts/home');

	}
	
}
?>