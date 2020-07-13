<?php
include_once('PayUMoney.php');
include_once('PayTM.php');
include_once('PayU.php');

/**
 * Online Payment Library
 * For advance and balance freight payment
 * 
 * @author pradeepsingh
 * @since 2015-11-22
 */
class OnlinePayment{
	
	public function __construct(){
		$this->CI =& get_instance();
		$fb_config = parse_ini_file(APPPATH."config/APP.ini");
	}
	
	/**
	 * Initiate Payment
	 * 
	 * @param array $details 
	 */
	public function startPayment($details){
		$url = "";
		$this->addOnlinePayment($details);
		if ($details['gateway'] == "payumoney") {
			$payumoney = new PayUMoney();
			$url = $payumoney->payNow($details);
		} else if($details['gateway'] == "paytm") {
			$paytm = new PayTM();
			$url = $paytm->payNow($details);
		} else if($details['gateway'] == "payu") {
			$payu = new PayU();
			$url = $payu->payNow($details);
		}
		return $url;
	}
	
	/**
	 * Store payment gateway response
	 * 
	 * @param array $details
	 * @return int $status
	 */
	public function storePaymentResponse($details){
		$status = $details['status'];
		if ($details['gateway'] == "payumoney") {
			$payumoney = new PayUMoney();
			$status = $payumoney->checkPaymentStatus($details);
		} else if($details['gateway'] == "paytm") {
			$paytm = new PayTM();
			$status = $paytm->checkPaymentStatus($details);
		} else if($details['gateway'] == "payu") {
			$payu = new PayU();
			$status = $payu->checkPaymentStatus($details);
		}
		
		return $status;
	}
	
	public function verifyPayment($params,$hash) {
		$paytm = new PayTM();
		$is_valid = $paytm->verifychecksum_e($params,$hash);
		return $is_valid;
	}
	
	public function verifyPayUPayment($params) {
		$is_valid = false;
		if($params['gateway'] == 'payumoney') {
			$payumoney = new PayUMoney();
			$is_valid = $payumoney->checkValidPayment($params);
		} else {
			$payu = new PayU();
			$is_valid = $payu->checkValidPayment($params);
		}
		return $is_valid;
	}
	
	public function getChecksumFromArray($params) {
		$paytm = new PayTM();
		$checksum = $paytm->generatePayTmChecksum($params);
		return $checksum;
	}
	
	public function veryfyChecksumForPaytm($params,$ehash) {
		$paytm = new PayTM();
		$isvalid = $paytm->verifychecksum_e($params,$ehash);
		return $isvalid;
	}
	
	public function getPayUhashes($params) {
		$payu = new PayU();
		$result = $payu->getHashes($params);
		return $result;
	}
	
	public function getPayUMoneyhashes($params) {
		$payumoney = new PayUMoney();
		$result = $payumoney->getHashes($params);
		return $result;
	}
	
	/**
	 * Add record in payment table
	 * 
	 * @param array $details
	 */
	public function addOnlinePayment($details){
		if ($details['gateway'] == "payumoney") {
			$payumoney = new PayUMoney();
			$details['merchant_id'] = $payumoney->merchant_id;
			$details['submerchant_id'] = $payumoney->submerchant_id;
		} else if($details['gateway'] == "paytm") {
			$paytm = new PayTM();
			$details['merchant_id'] = $paytm->merchant_id;
			$details['submerchant_id'] = $paytm->submerchant_id;
		} else if($details['gateway'] == "payu") {
			$payu = new PayU();
			$details['merchant_id'] = $paytm->merchant_id;
			$details['submerchant_id'] = $paytm->submerchant_id;
		}
		$detail = array();
		$detail['merchant_id'] = $details['merchant_id'];
		$detail['submerchant_id'] = '';
		$this->CI->load->model ( 'payments/Payment_model', 'orderpayment' );
		$detail['orderid'] = $details['orderid'];
		$detail['ordercode'] = $details['ordercode'];
		$detail['amount'] = $details['amount'];
		$detail['status'] = 0;
		$detail['gateway'] = $details['gateway'];
		error_log(json_encode($details),0);
		$clients = $this->CI->orderpayment->addPayment($detail);
	}
	
	/**
	 * Update record in payment table for successful payments
	 * 
	 * @param array $details
	 */
	public function updateSuccessfulPayment($details){
		$this->CI->load->model ( 'payments/Payment_model', 'orderpayment' );
		$status = 1;
		$detail['ordercode'] = $details['ordercode'];
		$detail['status'] = $status;
		$detail['transaction_id'] = $details['transaction_id'];
		$detail['transaction_code'] = $details['transaction_code'];
		$detail['transaction_amount'] = $details['transaction_amount'];
		$detail['gateway'] = $details['gateway'];
		$detail['created_date'] = date('Y-m-d H:i:s');
		$this->CI->orderpayment->updatePayment($detail);
	}
	
	/**
	 * Update record in payment table for failed payments
	 * 
	 * @param array $details
	 */
	public function updateFailedPayment($details){
		$this->CI->load->model ( 'payments/Payment_model', 'orderpayment' );
		$detail['ordercode'] = $details['ordercode'];
		$detail['status'] = 2;
		$detail['transaction_id'] = $details['transaction_id'];
		$detail['transaction_code'] = $details['transaction_code'];
		$detail['transaction_amount'] = $details['transaction_amount'];
		$detail['gateway'] = $details['gateway'];
		$detail['created_date'] = date('Y-m-d H:i:s');
		$this->CI->orderpayment->updatePayment($detail);
	}
	
	public function updateOnlinePayment($details){
		$detail = array();
		$this->CI->load->model ( 'payments/Payment_model', 'orderpayment' );
		$detail['ordercode'] = $details['ordercode'];
		$detail['pay_url'] = $details['pay_url'];
		$clients = $this->CI->orderpayment->updatePayment($detail);
	}
	
	public function getPaymentDetails($ordercode) {
		$this->CI->load->model ( 'payments/Payment_model', 'orderpayment' );
		$result = $this->CI->orderpayment->getPaymentDetails($ordercode);
		return $result;
	}
	
}
