<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Paytm extends MY_Controller
{
 	function  __construct()
	    {
	        parent::__construct();
	        if(!$this->session->has_userdata('is_user_login')){
			redirect('user/login');
		    }
	        $this->load->model('TransactionModel');
	        $this->load->model('OrderModel');
	        $this->load->model('PaymentModel', 'payment');
	       
	    }

	public function paytmpost()
	{
		 header("Pragma: no-cache");
		 header("Cache-Control: no-cache");
		 header("Expires: 0");

		 // following files need to be included
		 require_once(APPPATH . "/third_party/paytmlib/config_paytm.php");
		 require_once(APPPATH . "/third_party/paytmlib/encdec_paytm.php");

		 $checkSum = "";
		 $paramList = array();
		 $order_id = $_POST['order_id'];
		 $ORDER_ID = $_POST["ORDER_ID"];
		 $CUST_ID = $_POST["CUST_ID"];
		 $INDUSTRY_TYPE_ID = $_POST["INDUSTRY_TYPE_ID"];
		 $CHANNEL_ID = $_POST["CHANNEL_ID"];
		 $TXN_AMOUNT = $_POST["TXN_AMOUNT"];
		 $EMAIL = $_POST['EMAIL'];
		 $MOBILE_NO = str_replace('+', '',$_POST['MOBILE_NO']);
		 $this->TransactionModel->insert(array(
		 	'transaction_id'=>$ORDER_ID,
		 	'order_id'=>$order_id,
		 	'amount' => $TXN_AMOUNT,
		 	'created_at'=>date('Y-m-d H:i:s')
		 ));
		// Create an array having all required parameters for creating checksum.
		 $paramList["MID"] = PAYTM_MERCHANT_MID;
		 $paramList["ORDER_ID"] = $ORDER_ID;
		 $paramList["CUST_ID"] = $CUST_ID;
		 $paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
		 $paramList["CHANNEL_ID"] = $CHANNEL_ID;
		 $paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
		 $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
		 $paramList["EMAIL"] = $EMAIL;
		 $paramList["MSISDN"] = $MOBILE_NO;
		 $paramList["CALLBACK_URL"] = base_url()."paytm/paytmCallback";
		// $paramList["PAYMENT_MODE_ONLY"]="YES";
		 //dd($paramList);
		 /*
		 $paramList["MSISDN"] = $MSISDN; //Mobile number of customer
		 $paramList["EMAIL"] = $EMAIL; //Email ID of customer
		 $paramList["VERIFIED_BY"] = "EMAIL"; //
		 $paramList["IS_USER_VERIFIED"] = "YES"; //

		 */

		//Here checksum string will return by getChecksumFromArray() function.
		 $checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
		 echo "<html>
		<head>
		<title>Merchant Check Out Page</title>
		</head>
		<body>
		    <center><h1>Please do not refresh this page...</h1></center>
		        <form method='post' action='".PAYTM_TXN_URL."' name='f1'>
		<table border='1'>
		 <tbody>";

		 foreach($paramList as $name => $value) {
		 echo '<input type="hidden" name="' . $name .'" value="' . $value .         '">';
		 }

		 echo "<input type='hidden' name='CHECKSUMHASH' value='". $checkSum . "'>
		 </tbody>
		</table>
		<script type='text/javascript'>
	 	document.f1.submit();
		</script>
		</form>
		</body>
		</html>";
	}

	public function paytmCallback(){
		//dd($_POST);
		if(!empty($_POST)){
			$status = $this->input->post('STATUS');
			if($status=="TXN_SUCCESS"){

				$order_id = $this->input->post('ORDERID');
				$amount = $this->input->post('TXNAMOUNT');
				$txn_id = $this->input->post('TXNID');
				$transaction = $this->TransactionModel->get(array('transaction_id'=>$order_id));

				$criteria['field'] = 'hash';
				$criteria['conditions'] =array('id'=>$transaction['order_id']);
				$criteria['returnType'] = 'single';

				$order_result = $this->OrderModel->search($criteria);


				if($transaction) {
					$insert_data = array(
						'transaction_id'=>$txn_id,
						'client_transaction_id'=>$order_id,
						'payment_type_id'=>3,
						'channel'=>1,
						//'invoice_id'=>$transaction['invoice_id'],
						'amount'=>$amount,
						'status'=>1,
						'created_at'=>date("Y-m-d H:i:s")
					);

					$insert_id = $this->payment->insert($insert_data);
					if($insert_id){

						$this->OrderModel->update(array('paid'=>1,'payment_id'=>$insert_id,'payment_type_id'=>3),array('id'=>$transaction['order_id']));
						
						$this->session->set_flashdata('success_msg','Payment received succussfully!');
				         	redirect('cart/confirmed/'.$order_result['hash']);
				         	//exit;
					}
				}else{
						$this->session->set_flashdata('error_msg','Looks like you cancelled the payment. You can try again now or if you faced any issues in completing the payment, please contact us');
							redirect('cart/order_billing/'.$order_result['hash']);
							exit;
			}

			}

		}
		$this->session->set_flashdata('error_msg','Something went wrong!');
		redirect('service/select_service');
		exit;
	}// end of paytm callback method
}// end of class

?>