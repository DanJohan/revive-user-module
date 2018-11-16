<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct(){ 
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('UserExternalLoginModel');
		$this->load->helper(array('string'));
		$this->load->library('session');
		$this->load->library('TextMessage');
		
	}
	public function index() {
		redirect('/');
		}
	public function login(){
		$this->load->library('fblogin');
		$this->load->library('gmailLogin');
		$data = array();
		if($this->session->has_userdata('is_user_login') && $this->session->userdata('is_user_login')){
			redirect('cart/userinfo');
		}
		
		if($this->input->post('submit')){
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
							'phone' => $user['phone'],
						 	'is_user_login' => TRUE
						);
						// /dd($user_data);
							$this->session->set_userdata($user_data);
							redirect(base_url('cart/userinfo'), 'refresh');
						}else{
							$data['msg'] = 'Your password doesn\'t match!';
						}
				}else{
					$data['msg'] = 'Sorry, this account is not registered with us!';
										
				}
			}else {
							
					redirect('user/verifyLoginOtp',$data);
					
			}

		}
		$data['fbLoginUrl'] = $this->fblogin->getLoginUrl();
		$data['GLoginUrl'] = $this->gmaillogin->getLoginUrl();
		$this->render('user/login', $data);

	}// end of login method

	public function gmailcallback() {
		$this->load->library('gmailLogin');
		if($this->gmaillogin->checkRedirectCode()){
			$guser=$this->gmaillogin->getUserData();

			$user = array(
				'id'=>$guser->getId(),
				'name'=>$guser->getName(),
				'email'=>($guser->getEmail()) ? $guser->getEmail() : '',
			);
			$this->socialLogin($user,'G');
		}else{
			// flash message and redirect
	}
}
	public function otplogin(){
		if($this->input->post('phone')){
			$phone = '+91'.$this->input->post('phone');
			$result = $this->UserModel->checkPhoneExists($phone);
			if($result){
				$otp = generate_otp();
				$data = array(
					'phone'=>$phone,
					'body' =>$otp." otp to login into your Revive auto care acccount."
				);
				$message = $this->textmessage->send($data);
				if(is_object($message) && $message->sid){
					$update_data = array(
						'otp'=>$otp,
					);
					$updated_otp = $this->UserModel->update($update_data,array('phone'=>$phone));
					$response = array('status'=>true,'message'=>'Please enter OTP sent to your number!');
				}else{
					$response = array('status'=>false,'message'=>'Somthing went wrong!Please try again');
					//$data['msg'] = 'Sorry,this phone number is not registerd with us!';
					
				}
			}else{
				$response = array('status'=>false,'message'=>'Sorry this number is not registered with us!');
			}
			
		}else{
			$response = array('status'=>false,'message'=>'Please enter your number!');
		}
		$this->renderJson($response);
	}	

	public function verifyLoginOtp(){
		//dd($_POST);
		//$data =array();
		$this->form_validation->set_rules('username', 'Phone', 'trim|required');
		$this->form_validation->set_rules('otp', 'OTP', 'trim|required');
		if ($this->form_validation->run() == true){
			$criteria ['field'] = "id,name,email,phone,created_at";
			$criteria['conditions'] = array('phone'=>'+91'.$this->input->post('username'),'otp'=>$this->input->post('otp'));
			$criteria['returnType'] ='single';
			$user = $this->UserModel->search($criteria);
			//echo $this->db->last_query();
			//dd($user);
			if($user){

				$this->UserModel->update(array('otp'=>null),array('id'=>$user['id']));
				$user_data = array(
					'user_id' => $user['id'],
					'name' => $user['name'],
				 	'is_user_login' => TRUE
				);
				$this->session->set_userdata($user_data);
				//die;
				redirect(base_url('cart/userinfo'), 'refresh');
			}else{
				$this->session->set_flashdata("error_msg","Sorry your otp doesn\'t match");
			}
		}else{
			$this->session->set_flashdata("error_msg",validation_errors());
		}
		//die;
		redirect('user/login');
	}
	public function fbcallback() {
		$this->load->library('fblogin');
		if($this->fblogin->hasAccessToken()){
			$fbUser = $this->fblogin->getUser();
			//dd($fbUser);
			$user= array(
				'id'=>$fbUser['id'],
				'name'=>$fbUser['name'],
				'email'=>($fbUser['email']) ? $fbUser['email'] : '',
			);
			$this->socialLogin($user,'F');
			 
		}else{
			// flash message and redirect
	}
}

	private  function socialLogin($social_user=array(),$login_type){

		if($social_user) {

			if($login_type == "G"){
				$social_id = $social_user['id'];
				$auth_provider ="1";
				$criteria['conditions'] = array('external_user_id'=>$social_id,'external_authentication_provider'=>$auth_provider);
			}else if($login_type == 'F'){
				$social_id =  $social_user['id'];
				$auth_provider = "2";
				$criteria['conditions'] = array('external_user_id'=>$social_id,'external_authentication_provider'=>$auth_provider);
			}

			$criteria['field'] = 'id,user_id';
			$criteria['returnType'] = 'single';
			$user_external = $this->UserExternalLoginModel->search($criteria);
			unset($criteria);
			
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
					 	'is_user_login' => TRUE
				);
				
				$this->session->set_userdata($user);

				redirect(base_url('cart/userinfo'), 'refresh');
			}else{
				$email = $social_user['email'];
				$is_exists_email = $this->UserModel->checkEmailExists($email);
				if(!empty($is_exists_email)){
					$user_id = $is_exists_email['id'];
					$insert_data= array(
		 			 	'user_id' =>$user_id,
		 			 	'name'=>$social_user['name'],
		 			 	'email'=>$social_user['email'],
		 			 	'external_authentication_provider'=>$auth_provider,
		 			 	'external_user_id'=>$social_id,
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
						 	'is_user_login' => TRUE
					);
				
					$this->session->set_userdata($user);

					redirect(base_url('cart/userinfo'), 'refresh');
				}else{

					$register_data =array(
						'name' => $social_user['name'],
						'email'=>$social_user['email'],
						'created_at'=>date("Y-m-d H:i:s")
					);

					$insert_id = $this->UserModel->insert($register_data);

					if($insert_id) {
						$insert_data= array(
			 			 	'user_id' =>$insert_id,
			 			 	'name'=> $social_user['id'],
			 			 	'email'=>$social_user['email'],
			 			 	'external_authentication_provider'=>$auth_provider,
			 			 	'external_user_id'=>$social_id,
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
	} 

	public function signup(){ 
		$data = array();
		$this->render('user/signup',$data);

	}

    public function insert_user(){  //insert user
    	//dd($_POST);
			$this->session->set_flashdata('post_data',$this->input->post());
			if($this->input->post('submit')){  //inserting 
					
					$phone= '+91'.$this->input->post('phone');
					$phone = $phone;
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

						$insert_id= $this->UserModel->insert($data);
						if($insert_id){
							$criteria['field'] = 'id,phone,name,email,profile_image,created_at';
							$criteria['conditions'] = array('id'=>$insert_id);
							$criteria['returnType'] = 'single';
							$user = $this->UserModel->search($criteria);
							if($user){
								$user_data = array(
									'user_id' => $user['id'],
									'name' => $user['name'],
									'phone' => $user['phone'],
									'email' => $user['email'],
									'pic'  => $user['profile_image'],
								 	'is_user_login' => TRUE
								);
								$this->session->set_userdata($user_data);
								//redirect(base_url('cart/userinfo'));
								redirect(base_url('user/profile'));
							}
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
						$this->session->set_flashdata('error_msg',$errors);
						redirect(base_url('user/signup'));
					}

				}
			}	

    public function profile(){
    	$data =array();
		if($this->session->has_userdata('user_id')){
			$user_id = $this->session->userdata('user_id');
			}
			$data['user_data'] = $this->UserModel->get(array('id'=>$user_id));
			//dd($data);
			$this->render('user/profile',$data);
		}	
	public function edit_profile(){
    	$data =array();
		if($this->session->has_userdata('user_id')){
			$user_id = $this->session->userdata('user_id');
			}
			$data['user_data'] = $this->UserModel->get(array('id'=>$user_id));
			//dd($data);
			$this->render('user/edit_profile',$data);
		}
	

	public function update_profile($id=null){
		if(count($_POST) > 0 ) { 
				$id = $this->input->post('id');
				$update_data = array(
					'name'  =>   $this->input->post('name'),
					'email' =>   $this->input->post('email'),
					'phone' =>   $this->input->post('phone')
				);
			
			$result = $this->UserModel->update($update_data,array('id'=>$id));
				if($result){
				$this->session->set_flashdata('success_msg','Your profile is successfully updated'); 
            }else{
                $this->session->set_flashdata('error_msg','Some error occur, Try again');
            }
            redirect('user/profile');
		}
	}

	public function logout(){
			//$location = $this->session->userdata('location');
			//dd($this->session);
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('name');
			$this->session->unset_userdata('is_user_login');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('pic');
			//$this->session->sess_destroy();

			//$this->session->set_userdata('location',$location);
			redirect(base_url('user/login'),'refresh');
	}

    public function forgot_password() {
        $data= array();
        if($this->input->post('submit')){
            $this->load->library('mailer');
            $email = $this->input->post('email');
            $user = $this->UserModel->get(array('email'=>$email));
            if(!empty($user)) {
                $password_hash= md5(uniqid(mt_rand(1000,9999),true));
                $link = base_url()."user/change_password/".$user['email']."/".$password_hash;

                $this->mailer->setFrom(MAIL_USERNAME);
                $this->mailer->addAddress($user['email']);
                $this->mailer->subject('Change password');
                $this->mailer->body($this->load->view('user/change_password_email',array('user'=>$user,'link'=>$link),true));
                $this->mailer->isHTML();
                $mail=$this->mailer->send();
                $update_data = array(
                    'password_reset_hash'=>$password_hash
                );

                $this->UserModel->update($update_data,array('id'=>$user['id']));
                $this->session->set_flashdata('success_msg','Please check your email to reset password!'); 
            }else{
                $this->session->set_flashdata('error_msg','This email is not registered with us!');
            }

        }
        $this->render('user/forgot_password',$data);
    }

    public function change_password($email,$hash){
        if(!$email || !$hash){
            return ;
        }
        $data=array('email'=>$email,'hash'=>$hash);
        $this->render('user/change_password',$data);
    }

    public function change_password_post(){
        if($this->input->post('email')){
            $email= $this->input->post('email');
            $hash = $this->input->post('hash');
            $pwd = $this->input->post('pwd');

            $criteria['field'] = 'id,name,email';

            $criteria['conditions']=array('email'=>$email,'password_reset_hash'=>$hash);
            $criteria['returnType'] = 'single';
            $user = $this->UserModel->search($criteria);

            if($user){
                $user_id = $user['id'];
                $options = [
                    'cost' => 12,
                ];

                $update_data= array(
                    'password'=>password_hash($pwd,PASSWORD_BCRYPT,$options)
                );
                $this->UserModel->update($update_data,array('id'=>$user_id));
                $response = array('status'=>true,'message'=>'Password changed successfully!');
            }else{
                $response= array('status'=>false,'message'=>'User not found!');
            }
            
            $this->renderJson($response);
        }
    }
}
?>
