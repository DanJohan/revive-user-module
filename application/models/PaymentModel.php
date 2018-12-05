<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class PaymentModel extends MY_Model {

	protected $table='payments';

	public function __construct() {
		parent::__construct();
	}

}