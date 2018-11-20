<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class PaypalModel extends MY_Model {

	protected $table='payments';

	public function __construct() {
		parent::__construct();
	}

}