<?php


/**
 * Easy pay payment gateway integration
 * 
 * @author pradeepsingh
 * @since 2015-11-22
 */
class PayU{
	
	public $url;
	public $merchant_id;
	public $submerchant_id;
	public $payment_amount;
	public $name;
	public $email_id;
	public $mobile;
	public $orderid;
	public $ordercode;
	public $response_url;
	public $paymode;
	public $referer_id;
	public $salt;
	public $provider;
	
	public function __construct(){
		$this->url = "https://secure.payu.in";
		$this->merchant_id = 'xxxxxx';
		$this->submerchant_id = 0;
		$this->salt = 'xxxxxxx';
		$this->response_url = base_url().'order/payment/response';
		$this->paymode = 9;
		$this->provider = 'payu';
	}
	
	/**
	 * Initialize payment terms for easy pay
	 * 
	 * @param array $details
	 */
	public function initiatePayment(array $details){
		$this->name = $details['name'];
		$this->payment_amount = $details['amount'];
		$this->email_id = $details['email'];
		$this->mobile = $details['mobile'];
		$this->orderid = $details['orderid'];
		$this->ordercode = $details['ordercode'];
		$this->response_url = $this->response_url;
		$this->referer_id = $details['referer_id'];
	}
	
	/**
	 * Eazypay payment processing
	 * 
	 * @param array $details
	 */
	public function payNow(array $details){
		$this->initiatePayment($details);
		$post = array('key'=>$this->merchant_id,
				'txnid'=>$details['ordercode'],
				'amount'=>$details['amount'],
				'productinfo'=>'FoodOrder',
				'firstname'=>preg_replace('/[^a-zA-Z0-9-_@\.\s]/', "", $details['name']),
				'email'=>trim(preg_replace('/\s\s+/', ' ',$details['email'])),
				'phone'=>$details['mobile'],
				'surl'=>$this->response_url,
				'furl'=>$this->response_url,
				'curl'=>$this->response_url,
				'user_credentials'=>$this->merchant_id.':'.$details['email'],
				'service_provider'=>$this->provider
		);
		$post['hash'] = $this->generateHash($post);
		$payment_url = $this->url.'/_payment';
		$resp = array();
		$resp['data'] = $post;
		$resp['payment_url'] = $this->url.'/_payment';
		return $resp;
	}
	
	/**
	 * Check EasyPay payment status
	 * 
	 * @param array $details
	 * @return number
	 */
	public function checkPaymentStatus(array $details){
		if($details['transaction_code'] == "success"){
			return 1;
		}else{
			return 0;
		}
	}
	
	/**
	 * Curl get method
	 * 
	 * @param string $curl
	 * @return string
	 */
	function httpGet(string $curl)
	{
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$curl);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		$output=curl_exec($ch);
		curl_close($ch);
		return $output;
	}
	
	/**
	 * Curl post method
	 * 
	 * @param string $curl
	 * @param array $params
	 * @return string
	 */
	function httpPost($curl,array $params)
	{
		$postData = '';
		//create name value pairs seperated by &
		foreach($params as $k => $v)
		{
			$postData .= $k . '='.$v.'&';
		}
		$postData = rtrim($postData, '&');
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$curl);
		curl_setopt($ch,CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,0);
		curl_setopt($ch,CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_POST, count($postData));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		$output=curl_exec($ch);
		curl_close($ch);
		echo $output;
	
	}
	
	function generateHash($posted) {
		$hash = '';
		$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
		$hashVarsSeq = explode('|', $hashSequence);
		$hash_string = '';
		foreach($hashVarsSeq as $hash_var) {
			$hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
			$hash_string .= '|';
		}
		$hash_string .= $this->salt;
		$hash = strtolower(hash('sha512', $hash_string));
		return $hash;
	}
	
	function checkValidPayment($params) {
		If (isset($params["additionalCharges"])) {
			$additionalCharges = $params["additionalCharges"];
			$retHashSeq = $additionalCharges.'|'.$this->salt.'|'.$params['status'].'|||||||||||'.$params['email'].'|'.$params['firstname'].'|'.$params['productinfo'].'|'.$params['amount'].'|'.$params['txnid'].'|'.$this->merchant_id;
		} else {
			$retHashSeq = $this->salt.'|'.$params['status'].'|||||||||||'.$params['email'].'|'.$params['firstname'].'|'.$params['productinfo'].'|'.$params['amount'].'|'.$params['txnid'].'|'.$this->merchant_id;
		}
		$hash = hash("sha512", $retHashSeq);
		//error_log("Gen hash: ".$hash,0);
		$posted_hash = $params['hash'];
		//error_log("Posted Hash: ".$posted_hash,0);
		if ($hash != $posted_hash) {
			return false;
		} else {
			return true;
		}
	}
	
	function getHashes($params)
	{
		$txnid = $params['txnid'];
		$amount = $params['amount'];
		$productinfo = $params['productinfo'];
		$firstname = $params['firstname'];
		$email = $params['email'];
		$user_credentials = $params['user_credentials'];
		$udf1 = $params['udf1'];
		$udf2 = $params['udf2'];
		$udf3 = $params['udf3'];
		$udf4 = $params['udf4'];
		$udf5 = $params['udf5'];
		$offerKey = $params['offerKey'];
		$cardBin = $params['cardBin'];
		
		// $firstname, $email can be "", i.e empty string if needed. Same should be sent to PayU server (in request params) also.
		$key = $this->merchant_id;//'gtKFFx';
		$salt = $this->salt;//'eCwWELxi';
	
		$payhash_str = $key . '|' . $this->checkNull($txnid) . '|' .$this->checkNull($amount)  . '|' .$this->checkNull($productinfo)  . '|' . $this->checkNull($firstname) . '|' . $this->checkNull($email) . '|' . $this->checkNull($udf1) . '|' . $this->checkNull($udf2) . '|' . $this->checkNull($udf3) . '|' . $this->checkNull($udf4) . '|' . $this->checkNull($udf5) . '||||||' . $salt;
		$paymentHash = strtolower(hash('sha512', $payhash_str));
		$arr['payment_hash'] = $paymentHash;
	
		$cmnNameMerchantCodes = 'get_merchant_ibibo_codes';
		$merchantCodesHash_str = $key . '|' . $cmnNameMerchantCodes . '|default|' . $salt ;
		$merchantCodesHash = strtolower(hash('sha512', $merchantCodesHash_str));
		$arr['get_merchant_ibibo_codes_hash'] = $merchantCodesHash;
	
		$cmnMobileSdk = 'vas_for_mobile_sdk';
		$mobileSdk_str = $key . '|' . $cmnMobileSdk . '|default|' . $salt;
		$mobileSdk = strtolower(hash('sha512', $mobileSdk_str));
		$arr['vas_for_mobile_sdk_hash'] = $mobileSdk;
	
		$cmnPaymentRelatedDetailsForMobileSdk1 = 'payment_related_details_for_mobile_sdk';
		$detailsForMobileSdk_str1 = $key  . '|' . $cmnPaymentRelatedDetailsForMobileSdk1 . '|default|' . $salt ;
		$detailsForMobileSdk1 = strtolower(hash('sha512', $detailsForMobileSdk_str1));
		$arr['payment_related_details_for_mobile_sdk_hash'] = $detailsForMobileSdk1;
	
		//used for verifying payment(optional)
		$cmnVerifyPayment = 'verify_payment';
		$verifyPayment_str = $key . '|' . $cmnVerifyPayment . '|'.$txnid .'|' . $salt;
		$verifyPayment = strtolower(hash('sha512', $verifyPayment_str));
		$arr['verify_payment_hash'] = $verifyPayment;
	
		if($user_credentials != NULL && $user_credentials != '')
		{
			$cmnNameDeleteCard = 'delete_user_card';
			$deleteHash_str = $key  . '|' . $cmnNameDeleteCard . '|' . $user_credentials . '|' . $salt ;
			$deleteHash = strtolower(hash('sha512', $deleteHash_str));
			$arr['delete_user_card_hash'] = $deleteHash;
	
			$cmnNameGetUserCard = 'get_user_cards';
			$getUserCardHash_str = $key  . '|' . $cmnNameGetUserCard . '|' . $user_credentials . '|' . $salt ;
			$getUserCardHash = strtolower(hash('sha512', $getUserCardHash_str));
			$arr['get_user_cards_hash'] = $getUserCardHash;
	
			$cmnNameEditUserCard = 'edit_user_card';
			$editUserCardHash_str = $key  . '|' . $cmnNameEditUserCard . '|' . $user_credentials . '|' . $salt ;
			$editUserCardHash = strtolower(hash('sha512', $editUserCardHash_str));
			$arr['edit_user_card_hash'] = $editUserCardHash;
	
			$cmnNameSaveUserCard = 'save_user_card';
			$saveUserCardHash_str = $key  . '|' . $cmnNameSaveUserCard . '|' . $user_credentials . '|' . $salt ;
			$saveUserCardHash = strtolower(hash('sha512', $saveUserCardHash_str));
			$arr['save_user_card_hash'] = $saveUserCardHash;
	
			$cmnPaymentRelatedDetailsForMobileSdk = 'payment_related_details_for_mobile_sdk';
			$detailsForMobileSdk_str = $key  . '|' . $cmnPaymentRelatedDetailsForMobileSdk . '|' . $user_credentials . '|' . $salt ;
			$detailsForMobileSdk = strtolower(hash('sha512', $detailsForMobileSdk_str));
			$arr['payment_related_details_for_mobile_sdk_hash'] = $detailsForMobileSdk;
		}
	
	
		if ($offerKey!=NULL && !empty($offerKey)) {
			$cmnCheckOfferStatus = 'check_offer_status';
			$checkOfferStatus_str = $key  . '|' . $cmnCheckOfferStatus . '|' . $offerKey . '|' . $salt ;
			$checkOfferStatus = strtolower(hash('sha512', $checkOfferStatus_str));
			$arr['check_offer_status_hash']=$checkOfferStatus;
		}
	
	
		if ($cardBin!=NULL && !empty($cardBin)) {
			$cmnCheckIsDomestic = 'check_isDomestic';
			$checkIsDomestic_str = $key  . '|' . $cmnCheckIsDomestic . '|' . $cardBin . '|' . $salt ;
			$checkIsDomestic = strtolower(hash('sha512', $checkIsDomestic_str));
			$arr['check_isDomestic_hash']=$checkIsDomestic;
		}
		return array('result'=>$arr);
	}
	
	function checkNull($value) {
		if ($value == null) {
			return '';
		} else {
			return $value;
		}
	}
	
}
