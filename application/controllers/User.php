<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('ServiceEnquiryModel');
		$this->load->model('UserExternalLoginModel');
		$this->load->model('InvoiceModel');
		$this->load->model('JobcardModel');
		$this->load->model('RepairOrderModel');
		$this->load->helper(array('string'));
		$this->load->library('session');
		
	}
	public function index(){
		if(!$this->session->has_userdata('is_user_login')){
			redirect('user/login');
		}
		redirect('user/dashboard');
		$this->load->view('user/billing');

	}

	public function login(){

		if($this->session->has_userdata('is_user_login')){
			redirect('user/dashboard');
		}
		//dd($_POST);die;
		//echo password_hash("password", PASSWORD_DEFAULT);die;
		$this->load->library('fblogin');
		$this->load->library('gmailLogin');
		$data =array();
		if($this->input->post('submit')){
			//dd($_POST);die;
			$this->form_validation->set_rules('username', 'Email|Phone', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				
				$username = $this->input->post('username');   
				$password = $this->input->post('password');
				
				$user = $this->UserModel->check_user_exits(array('username'=>$username));
				if($user){
					$is_verified = password_verify($password,$user['password']);
					if($is_verified){
						// set session
						$user_data = array(
							'user_id' => $user['id'],
							'name' => $user['name'],
							'pic'  => $user['profile_image'],
						 	'is_user_login' => TRUE
						);
						//print_r($user_data);die;
							$this->session->set_userdata($user_data);
							redirect(base_url('user/dashboard'), 'refresh');
						}else{
							$data['msg'] = 'Your password doesn\'t match!';
						}
				}else{
					$data['msg'] = 'Sorry, this account is not registered with us!';
					
				}
			}
				else {
						$data['msg'] = 'Missing Email/Phone Or Password';
					 }

		}
	
		$data['fbLoginUrl'] = $this->fblogin->getLoginUrl();
		$data['GLoginUrl'] = $this->gmaillogin->getLoginUrl();
		$this->load->view('user/login',$data);
	}// end of login method

	public function fbcallback() {
		$this->load->library('fblogin');
		if($this->fblogin->hasAccessToken()){
			$fbUser = $this->fblogin->getUser();
			//dd($fbUser);
			if($fbUser) {
				$user_external = $this->UserExternalLoginModel->get(array('external_user_id'=>$fbUser['id'],'external_authentication_provider'=>'2'));
				if(!empty($user_external)){
					$criteria['field'] = "id,name,profile_image";
					$criteria['returnType'] = "single";
					$criteria['conditions'] = array('id'=>$user_external['user_id']);
					$user= $this->UserModel->search($criteria);
					if($user){
						$user_data = array(
							'user_id' => $user['id'],
							'name' => $user['name'],
							'pic'  => $user['profile_image'],
						 	'is_user_login' => TRUE
						);
						//print_r($user_data);die;
						$this->session->set_userdata($user_data);
						redirect(base_url('user/dashboard'), 'refresh');
					}
				}
				$this->session->set_flashdata('error_msg','Sorry, this account is not registered with us!');
				redirect('/');
			}else{
				$this->session->set_flashdata('error_msg','Sorry, this account is not registered with us!');
				redirect('/');
			}
		}else{
			$this->session->set_flashdata('error_msg','Somthing went wrong!');
			redirect('/');
		}
		

	}

	public function gmailcallback() {
		$this->load->library('gmailLogin');
		if($this->gmaillogin->checkRedirectCode()){
			$guser=$this->gmaillogin->getUserData();
			if($guser) {
				$user_external = $this->UserExternalLoginModel->get(array('external_user_id'=>$guser->id,'external_authentication_provider'=>'1'));
				if(!empty($user_external)){
					$criteria['field'] = "id,name,profile_image";
					$criteria['returnType'] = "single";
					$criteria['conditions'] = array('id'=>$user_external['user_id']);
					$user= $this->UserModel->search($criteria);
					if($user){
						$user_data = array(
							'user_id' => $user['id'],
							'name' => $user['name'],
							'pic'  => $user['profile_image'],
						 	'is_user_login' => TRUE
						);
						//print_r($user_data);die;
						$this->session->set_userdata($user_data);
						redirect(base_url('user/dashboard'), 'refresh');
					}
				}
				$this->session->set_flashdata('error_msg','Sorry, this account is not registered with us!');
				redirect('/');
			}else{
				$this->session->set_flashdata('error_msg','Sorry, this account is not registered with us!');
				redirect('/');
			}
		}else{
			$this->session->set_flashdata('error_msg','Somthing went wrong!');
			redirect('/');
		}

		
	}


	public function dashboard() {

		if(!$this->session->has_userdata('is_user_login')){
			redirect('user/login');
		}
		$data['view'] = 'user/dashboard';
		$this->load->view('user/layout',$data);

	}
	public function enquiry_by_user() {
		if(!$this->session->has_userdata('is_user_login')){
			redirect('user/login');
		}
		$data['enquiries'] = $this->ServiceEnquiryModel->getEnquiryByUser($this->session->userdata('user_id'));
		//dd($data['enquiries']);
		if(!empty($data['enquiries'])) {
			$data['view'] = 'user/enquiry';
			$this->load->view('user/layout',$data);
			
		}else{
			$data['view'] = 'user/enquiry';
			$this->load->view('user/layout',$data);
			
		}
	}

	public function show_enquiry($enquiry_id) {
		if(!$this->session->has_userdata('is_user_login')){
			redirect('user/login');
		}
		$data['enquiries'] = $this->ServiceEnquiryModel->getEnquiryByUserId($enquiry_id);

		
		if(!empty($data['enquiries'])) {
			$data['view'] = 'user/view_details';
			$this->load->view('user/layout',$data);
			
		}else{
			$data['view'] = 'user/view_details';
			$this->load->view('user/layout',$data);
			
		}
	}
	public function logout(){
			$this->session->sess_destroy();
			redirect(base_url('user/login'), 'refresh');
	}
	public function billing() {
		if(!$this->session->has_userdata('is_user_login')){
			redirect('user/login');
		}
		$data['invoices'] = $this->InvoiceModel->getInvoiceByUserId($this->session->userdata('user_id'));
		//dd($data['invoices']);
		$data['view'] = 'user/invoice_list';
		$this->load->view('user/layout',$data);

	}

	public function invoice_view($id=null){

		if(!$this->session->has_userdata('is_user_login')){
			redirect('user/login');
		}
		if(!$id){
			redirect('user/billing');
		}
		$invoice = $this->InvoiceModel->getInvoiceById($id,$this->session->userdata('user_id'));
		if(empty($invoice)){
			redirect('user/billing');
		}

		$this->config->load('payment');

		$invoice_labour_keys =  array('invoice_labour_id','invoice_labour_item','invoice_labour_hour','invoice_labour_rate','invoice_labour_cost','invoice_labour_gst','invoice_labour_gst_amount','invoice_labour_total');

		$invoice_labour = array_filter_by_value(array_unique(array_column_multi($invoice,$invoice_labour_keys),SORT_REGULAR),'invoice_labour_id','');

		$invoice_parts_keys =  array('invoice_parts_id','invoice_parts_item','invoice_parts_quantity','invoice_parts_cost','invoice_parts_gst','invoice_parts_gst_amount','invoice_parts_total');
		$invoice_parts = array_filter_by_value(array_unique(array_column_multi($invoice,$invoice_parts_keys),SORT_REGULAR),'invoice_parts_id','');

		$invoice = $invoice[0];

		$removeKeys = array_merge($invoice_parts_keys,$invoice_labour_keys);
		foreach($removeKeys as $key) {
		   unset($invoice[$key]);
		}

		$invoice['labour'] = $invoice_labour;
		$invoice['parts'] = $invoice_parts;
		//dd($invoice['parts']);
		$data['invoice'] = $invoice;
		$data['view'] = 'user/billing';
		//dd($data['invoice']);
		
		$payu=array(
			'key'=> $this->config->item('payu_merchant_key'),
			'txnid'=>'sdfsdfsdfsd',//substr(hash('sha256', mt_rand() . microtime()), 0, 20),
			'action'=>$this->config->item('payu_base_url')."/_payment",
			'product_info'=>'Payment for invoice '.$invoice['invoice_number'],
			'service_provider'=>'payu_paisa',
			'surl'=> base_url()."payu/paymentSuccess",
			'furl'=> base_url()."payu/paymentFailure",
			'curl'=> base_url()."payu/paymentCancel",
		);
		//.$invoice['total_amount_after_discount'].
		$hashSequence = $payu['key']."|".$payu['txnid']."|".$invoice['total_amount_after_discount']."|".$payu['product_info']."|".$invoice['client_name']."|".$invoice['client_email']."|||||||||||".$this->config->item('payu_salt');
		//echo $hashSequence;die;
		$payu['hash'] = strtolower(hash('sha512', $hashSequence));
		$data['payu'] = $payu;

		$this->load->view('user/layout',$data);
	}

	//service status
	public function jobcard() {
		if(!$this->session->has_userdata('is_user_login')){
			redirect('user/login');
		}
		$data['jobcard'] = $this->JobcardModel->getUserAllJobCard($this->session->userdata('user_id'));
		$data['view'] = 'user/jobcard';
		$this->load->view('user/layout',$data);

	}
	public function completeJobs($id=null){
		if(!$this->session->has_userdata('is_user_login')){
			redirect('user/login');
		}
		if(!$id){
			redirect('user/jobcard');
		}
		$repair_orders = $this->RepairOrderModel->getRepairOrderByJobId($id,$this->session->userdata('user_id'));
		$data['repair_orders']=$repair_orders;
		$data['view'] = 'user/repair_order';
		$this->load->view('user/layout',$data);
	}




}
?>