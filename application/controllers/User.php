<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct(){ 
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('UserExternalLoginModel');
		$this->load->helper(array('string'));
		$this->load->library('session');
		
	}
	/*public function index(){
		$data = array();
		$this->render('user/login', $data);
		}
		redirect('user/dashboard');
		$this->load->view('user/billing');*/

	public function login(){

		$this->load->library('fblogin');
		$this->load->library('gmailLogin');
		$data = array();
			
		if($this->session->has_userdata('is_user_login')){
			redirect('cart/userinfo');
		}
		
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
							redirect(base_url('cart/userinfo'), 'refresh');
						}else{
							$data['msg'] = 'Your password doesn\'t match!';
						}
				}else{
					$data['msg'] = 'Sorry, this account is not registered with us!';
					//redirect(base_url('user/signup'), 'refresh');
					
				}
			}
				else {
						$data['msg'] = 'Missing Email/Phone Or Password';
					 }

		}
		$data['fbLoginUrl'] = $this->fblogin->getLoginUrl();
		$data['GLoginUrl'] = $this->gmaillogin->getLoginUrl();
		$this->render('user/login', $data);

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
						redirect(base_url('cart/userinfo'), 'refresh');
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
				$user_external = $this->UserExternalLoginModel->get(array('external_user_id'=>$guser->getId(),'external_authentication_provider'=>'1'));

				if(!empty($user_external)){

					$user_id= $user_external['user_id'];
					$criteria['field'] = 'id,name,phone,profile_image,email,created_at';
					$criteria['conditions'] = array('id'=>$user_id);
					$criteria['returnType'] = 'single';
					$user_data = $this->UserModel->search($criteria);
					unset($criteria);

					$user = array(
							'user_id' => $user_data['id'],
							'name' => $user_data['name'],
							'pic'  => $user_data['profile_image'],
						 	'is_user_login' => TRUE
					);
					
					$this->session->set_userdata($user);

					redirect(base_url('cart/userinfo'), 'refresh');
				}else{
					$email = $guser->getEmail();
					$is_exists_email = $this->UserModel->checkEmailExists($email);
					if(!empty($is_exists_email)){
						$user_id = $is_exists_email['id'];
						$insert_data= array(
			 			 	'user_id' =>$user_id,
			 			 	'name'=>$guser->getName(),
			 			 	'email'=>$guser->getEmail(),
			 			 	'external_authentication_provider'=>1,
			 			 	'external_user_id'=>$guser->getId(),
			 			 	'created_at' => date("Y-m-d H:i:s")
		 			 	);

		 			 	$this->UserExternalLoginModel->insert($insert_data);

		 			 	$criteria['field'] = 'id,name,phone,profile_image,email,created_at';
						$criteria['conditions'] = array('id'=>$user_id);
						$criteria['returnType'] = 'single';
						$user_data = $this->UserModel->search($criteria);

						unset($criteria);

						$user = array(
								'user_id' => $user_data['id'],
								'name' => $user_data['name'],
								'pic'  => $user_data['profile_image'],
							 	'is_user_login' => TRUE
						);
					
						$this->session->set_userdata($user);

						redirect(base_url('cart/userinfo'), 'refresh');
					}else{

						$register_data =array(
							'name' => $guser->getName(),
							'email'=>$guser->getEmail(),
							'created_at'=>date("Y-m-d H:i:s")
						);

						$insert_id = $this->UserModel->insert($register_data);

						if($insert_id) {
							$insert_data= array(
				 			 	'user_id' =>$insert_id,
				 			 	'name'=> $guser->getName(),
				 			 	'email'=>$guser->getEmail(),
				 			 	'external_authentication_provider'=>1,
				 			 	'external_user_id'=>$guser->getId(),
				 			 	'created_at' => date("Y-m-d H:i:s")
				 			 );

							//dd($insert_data);
							$this->UserExternalLoginModel->insert($insert_data);
							$criteria['field'] = 'id,name,phone,profile_image,email,created_at';
							$criteria['conditions'] = array('id'=>$insert_id);
							$criteria['returnType'] = 'single';
							$userInfo = $this->UserModel->search($criteria);
							unset($criteria);

							$user = array(
								'user_id' => $userInfo['id'],
								'name' => $userInfo['name'],
								'pic'  => $userInfo['profile_image'],
							 	'is_user_login' => TRUE
							);
						
							$this->session->set_userdata($user);

							redirect(base_url('cart/userinfo'), 'refresh');
							
						}else{
							// flash message and redirect
						}
					}
				}
			}else{
				// flash message and redirect
			}

		}else{
			// flash message and redirect
		}

		
	}

    
    public function signup(){ 
		$data = array();
		$this->render('user/signup',$data);

	}

    public function insert_user(){  //insert user
			$this->session->set_flashdata('post_data',$this->input->post());
			if($this->input->post('submit')){  //inserting 
					
					$phone= $this->input->post('phone');
					$phone = "+91".$phone;
					$email = $this->input->post('email');
				    $userPhoneInfo =	$this->UserModel->checkPhoneExists($phone);
				    $userEmailInfo =	$this->UserModel->checkEmailExists($email);
				    if(!$userPhoneInfo && !$userEmailInfo) {
						
					$data = array(
							'name' => $this->input->post('name'),
							'email' => $this->input->post('email'),
							'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
							'phone' => ($this->input->post('phone')) ? '+91'.$this->input->post('phone') : '',
							'created_at' => date('Y-m-d H:i:s')
						);
						
						$result = $this->UserModel->insert($data);
						
						if($result){
							$this->session->set_flashdata('success_msg', 'User is Added Successfully!');
							redirect(base_url('cart/userinfo'));

						}else{
						$this->session->set_flashdata('error_msg', 'Some problem occur!');
						redirect(base_url('user/signup'));
						
					   }
					} else{
						$errors ='';
						if(!empty($userPhoneInfo)){
							$errors .= "<p>Phone number already exists</p>";
						}
						if(!empty($userEmailInfo)){
							$errors .= "<p>Email already exists</p>";
						}
						$this->session->set_flashdata('validation_error',$errors);
						redirect(base_url('user/signup'));
					}

				}
			}	

	public function logout(){
			$this->session->sess_destroy();
			redirect(base_url('user/login'), 'refresh');
	}
}
?>