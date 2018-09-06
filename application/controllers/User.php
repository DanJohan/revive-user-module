<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('ServiceEnquiryModel');
		$this->load->model('UserExternalLoginModel');
		
	}

	public function index(){
		redirect('user/login');
	}

	public function login(){
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
							'id' => $user['id'],
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
							'id' => $user['id'],
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
							'id' => $user['id'],
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
		$data['view'] = 'user/dashboard';
		$this->load->view('user/layout',$data);

	}
	public function enquiry_by_user() {
	
		$data['enquiries'] = $this->ServiceEnquiryModel->getEnquiryByUser($this->session->userdata('id'));
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
  }
?>