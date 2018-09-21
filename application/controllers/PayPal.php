<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//
//require_once(APPPATH . 'libraries/paypal-php-sdk/paypal/rest-api-sdk-php/sample/bootstrap.php'); // require paypal files

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;

class PayPal extends MY_Controller
{
    public $_api_context;

    function  __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('is_user_login')){
            redirect('user/login');
        }
        $this->load->model('PaymentModel', 'payment');
        $this->load->model('InvoiceModel');
        // paypal credentials
        $this->config->load('payment');
        $this->load->model('TransactionModel');

        $this->_api_context = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $this->config->item('client_id'), $this->config->item('secret')
            )
        );
        $this->_api_context->setConfig($this->config->item('settings'));
    }

    function index(){
        die();
        $this->load->view('user/buy_form');
    }


    public function createPayment()
    {

        // setup PayPal api context
        if($this->input->post('total_amount')){

            
            $payer = new Payer();
            $payer->setPaymentMethod("paypal");

            $amount = new Amount();
            $amount->setCurrency('INR');
            $amount->setTotal($this->input->post('total_amount'));

            $transaction = new Transaction();
            $transaction->setAmount($amount);
            $transaction->setDescription("Payment of invoice ".$this->input->post('invoice_number'));
            //$transaction->setInvoiceNumber($this->input->post('invoice_number'));
            $transaction->setInvoiceNumber(uniqid());

            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl(base_url()."payPal/paymentSuccess")
                ->setCancelUrl(base_url()."payPal/paymentCancel");

            $payment = new Payment();
            $payment->setIntent("sale");
            $payment->setPayer($payer);
            $payment->setRedirectUrls($redirectUrls);
            $payment->setTransactions(array($transaction));

            try {
                $payment->create($this->_api_context);

            } catch (Exception $ex) {
                die($ex->getData());
            }

            $approvalUrl = $payment->getApprovalLink();
           // echo $approvalUrl;die;
            if(!empty($approvalUrl)){
                $id = $payment->getId();
                $token = $payment->getToken();
                $insert_data = array(
                    'transaction_id'=>$id,
                    'invoice_id'=>$this->input->post('invoice_id'),
                    'token'=>$token,
                    'amount'=> $this->input->post('total_amount'),
                    'created_at' => date('Y-m-d H:i:s')
                );
                $insert_id = $this->TransactionModel->insert($insert_data);
                if($insert_id) {
                    header('location:'.$approvalUrl);
                    exit;
                }else{
                    $this->session->set_flashdata('error_msg','Unknown error occurred');
                    redirect('user/billing');
                    exit;
                }
            }

        }

        $this->session->set_flashdata('error_msg','Unknown error occurred');
        redirect('user/billing');
        exit;

    }

    public function paymentSuccess() {

            $paymentId = $this->input->get('paymentId');
            $payment = Payment::get($paymentId, $this->_api_context);
          //  dd($payment);
            $execution = new PaymentExecution();
            $execution->setPayerId($this->input->get('PayerID'));
            $transactionData = $this->TransactionModel->get(array('transaction_id'=>$paymentId));


            $transaction = new Transaction();
            $amount = new Amount();

            $amount = new Amount();
            $amount->setCurrency('INR');
            $amount->setTotal($transactionData['amount']);

            $transaction->setAmount($amount);
            $execution->addTransaction($transaction);

            try{
                $result = $payment->execute($execution, $this->_api_context);
                try {
                    $payment_result = Payment::get($paymentId, $this->_api_context);
                    if($payment_result->getState()=="approved"){
                        $insert_data = array(
                            'merchant_transaction_id'=> $paymentId ,
                            'client_transaction_id' => $paymentId ,
                            'payment_type_id'=>1,
                            'channel'=>1,
                            'status'=>1,
                            'invoice_id'=>$transactionData['invoice_id'],
                            'amount'=>$transactionData['amount'],
                            'created_at'=>date('Y-m-d H:i:s')
                        );
                        $insert_id = $this->payment->insert($insert_data);
                        if($insert_id) {
                            $this->InvoiceModel->update(array('paid'=>1,'payment_id'=>$insert_id),array('id'=>$transactionData['invoice_id']));
                        }
                        $this->session->set_flashdata('success_msg','Payment received successfully');
                        redirect('user/billing');
                        exit;
                    }
                } catch (Exception $ex) {
                    $this->session->set_flashdata('error_msg','Something went wrong');
                    redirect('user/billing');
                    exit;
                    die($ex->getMessage());
                }
            }catch (Exception $ex) {
                $this->session->set_flashdata('error_msg','Something went wrong');
                redirect('user/billing');
                exit;
                die($ex->getMessage());
            }

    }

    public function paymentCancel(){
        $this->session->set_flashdata('error_msg','Something went wrong');
        redirect('user/billing');
        exit;
    }

 
}
?>