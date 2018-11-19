<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('BlogModel');
		$this->load->model('GalleryModel');
		$this->load->model('TestimonialModel');
		
	}
	public function index(){
		$data= array();
        $data['blogs'] = $this->BlogModel->getBlogs(); 
        $data['gallery_images'] = $this->GalleryModel->getGallery();
        $data['testimonials'] = $this->TestimonialModel->get_all();
      	$this->render('site/index',$data,'layouts/home');

	}
	public function gallery(){
		$data= array();
		$data['all_gallery'] = $this->GalleryModel->get_all();
		$this->render('site/gallery',$data);

	}

	public function blog(){
		$data= array();
		$data['allblog'] = $this->BlogModel->get_all();
		$this->render('site/blog',$data);

	}

	public function contact(){
		$this->load->library('mailer');
		$from_email = $this->input->post('email');
	    $name = $this->input->post('name'); 
	    $to_email = "contact@reviveauto.in";
	    $message = $this->input->post('message'); 
		$this->mailer->setFrom(MAIL_USERNAME);
		$this->mailer->addAddress($to_email);
		$this->mailer->subject('Revive Auto Enquiry');
		$this->mailer->body($this->load->view('email/contact_us',array('message'=>$message),true));
		$this->mailer->isHTML();
		$mail=$this->mailer->send();

		if($mail){
         $this->session->set_flashdata("success_msg","Email sent successfully."); 
        }else{ 
         $this->session->set_flashdata("error_msg","Error in sending Email."); 
        }
        redirect(base_url('site/index'));
	}
	
}
?>