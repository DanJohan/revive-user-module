<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends MY_Controller {

		public function __construct(){
			parent::__construct();
			//Load email library 
            $this->load->library('email'); 
   
			
		}

		public function send_mail() { 
         $from_email = $this->input->post('email');
         $name = $this->input->post('name'); 
         $to_email = "contact@reviveauto.in";
         $message = $this->input->post('message'); 
   
         
         $this->email->from($from_email, 'Revive Auto Enquiry By ' .$name); 
         $this->email->to($to_email);
         $this->email->message($message); 
   
         //Send mail 
         if($this->email->send()) 
         $this->session->set_flashdata("email_sent","Email sent successfully."); 
         else 
         $this->session->set_flashdata("email_sent","Error in sending Email."); 
         redirect(base_url('site/index')); 
      } 
	}
?>