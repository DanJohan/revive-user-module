<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Payu extends MY_Controller
{
 	public function  __construct()
	{
	     parent::__construct();
	     $this->config->load('payment');
	     $this->load->model('PaymentModel', 'payment');
        	$this->load->model('InvoiceModel');
        	$this->load->model('TransactionModel');

	}

	public function save_transaction(){
		if($this->input->post('invoice_id') && $this->input->post('txn_id')){
			$insert_data = array(
				'transaction_id'=>$this->input->post('txn_id'),
				'invoice_id'=>$this->input->post('invoice_id'),
				'created_at'=>date('Y-m-d H:i:s')
			);
			$insert_id = $this->TransactionModel->insert($insert_data);
			if($insert_id){
				$this->renderJson(array('status'=>false,'message'=>'Record inserted successfully'));
			}
		}
		$this->renderJson(array('status'=>false,'message'=>'Something went wrong'));
	}

	public function paymentSuccess(){

		$status=$this->input->post('status');
		$firstname=$this->input->post('firstname');
		$amount=$this->input->post('amount');
		$txnid=$this->input->post('txnid');
		$posted_hash=$this->input->post('hash');
		$key=$this->input->post('key');
		$productinfo=$this->input->post('productinfo');
		$email=$this->input->post('email');
		$salt=$this->config->item('payu_salt');
		$payu_money_id = $this->input->post('payuMoneyId');

		if ($this->input->post('additionalCharges')) {
       		$additionalCharges=$this->input->post('additionalCharges');
        		$retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
          }else {	  

        		$retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
	    $hash = hash("sha512", $retHashSeq);
		 
       	if ($hash != $posted_hash) {
       		$this->session->set_flashdata('error_msg','Invalid Transaction. Please try again');
               redirect('user/billing');
               exit;
		}else{ 	   
			$transaction = $this->TransactionModel->get(array('transaction_id'=>$txnid));
			if(!empty($transaction)){
				$insert_data = array(
					'merchant_transaction_id'=>$payu_money_id,
					'client_transaction_id'=>$txnid,
					'payment_type_id'=>2,
					'channel'=>1,
					'invoice_id'=>$transaction['invoice_id'],
					'amount'=>$amount,
					'status'=>1,
					'created_at'=>date('Y-m-d H:i:s')
				);
			    $insert_id = $this->payment->insert($insert_data);
			    $this->InvoiceModel->update(array('paid'=>1, 'payment_id'=>$insert_id),array('id'=>$transaction['invoice_id']));
			    $this->session->set_flashdata('success_msg','Payment received successfully');
	              redirect('user/billing');
	              exit;
			}
           
		}         
	}

	public function paymentFailure(){
		$payu_money_id = $this->input->post('payuMoneyId');
		$amount = $this->input->post('amount');
		$txnid = $this->input->post('txnid');
		$transaction = $this->TransactionModel->get(array('transaction_id'=>$txnid));
		if(!empty($transaction)){
				$insert_data = array(
					'merchant_transaction_id'=>$payu_money_id,
					'client_transaction_id'=>$txnid,
					'payment_type_id'=>2,
					'channel'=>1,
					'invoice_id'=>$transaction['invoice_id'],
					'amount'=>$amount,
					'status'=>2,//failed
					'created_at'=>date('Y-m-d H:i:s')
				);
	    		$this->payment->insert($insert_data);
	    
		}
		$this->session->set_flashdata('error_msg','you have cancelled the payment');
         	redirect('user/billing');
         	exit;
	}

	public function paymentCancel(){
		$payu_money_id = $this->input->post('payuMoneyId');
		$amount = $this->input->post('amount');
		$txnid = $this->input->post('txnid');
		$transaction = $this->TransactionModel->get(array('transaction_id'=>$txnid));
		if(!empty($transaction)){
				$insert_data = array(
					'merchant_transaction_id'=>$payu_money_id,
					'client_transaction_id'=>$txnid,
					'payment_type_id'=>2,
					'channel'=>1,
					'invoice_id'=>$transaction['invoice_id'],
					'amount'=>$amount,
					'status'=>3,//cancel
					'created_at'=>date('Y-m-d H:i:s')
				);
	    		$this->payment->insert($insert_data);
	    
		}
		$this->session->set_flashdata('error_msg','Something went wrong!');
         	redirect('user/billing');
         	exit;
	}
}