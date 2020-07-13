<?php


/**
 * PayTm payment gateway integration
 * 
 * @author pradeepsingh
 * @since 2016-05-18
 */
class PayTM{
	
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
	public $salt_key;
	public $provider;	
	public $channelid ;
	public $industryid;
	public $website;
	
	public function __construct(){
		$this->url = "https://secure.paytm.in/oltp-web/processTransaction?orderid=";
		$this->merchant_id = 'xxxxxxxx';
		$this->submerchant_id = 0;
		$this->salt_key = 'xxxxx';
		$this->response_url = base_url().'order/payment/response/paytm';
		$this->channelid = 'xxxx' ;
		$this->industryid = 'xxxxx';
		$this->website = 'xxxxx';
		
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
	 * PayTm payment processing
	 * 
	 * @param array $details
	 */
	public function payNow(array $details){
		$this->initiatePayment($details);
		$post = array(	'MID' => $this->merchant_id, //TK
						'ORDER_ID' => $details['ordercode'],
						'TXN_AMOUNT' => $details['amount'],
						'CUST_ID' => trim(preg_replace('/\s\s+/', ' ',$details['email'])),
						'WEBSITE' => $this->website,
						'EMAIL' => trim(preg_replace('/\s\s+/', ' ',$details['email'])),
						'MOBILE_NO' => $details['mobile'],
						'INDUSTRY_TYPE_ID' => $this->industryid,
						'CHANNEL_ID' => $this->channelid
					);
		$post['CHECKSUMHASH'] = $this->getChecksumFromArray($post,$this->salt_key);
		$payment_url = $this->url.$this->orderid;//.//'/_payment';
		$resp = array();
		$resp['data'] = $post;
		$resp['payment_url'] = $payment_url;
		return $resp;
	}
	
	public function generatePayTmChecksum($arrayList) {
		ksort($arrayList);
		$params['WEBSITE'] = 'xxxxx';
		$params['CHANNEL_ID'] = 'xxxxx';
		$str = $this->getArray2Str($arrayList);
		$salt = $this->generateSalt_e(4);
		$finalString = $str . "|" . $salt;
		$hash = hash("sha256", $finalString);
		$hashString = $hash . $salt;
		$checksum = $this->encrypt_e($hashString, $this->salt_key);
		return $checksum;
	}
	
	/**
	 * Check Paytm payment status
	 * 
	 * @param array $details
	 * @return number
	 */
	public function checkPaymentStatus(array $details){		
		if($details['transaction_code'] == "TXN_SUCCESS"){
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
	
	function getChecksumFromArray($arrayList, $key, $sort=1) {
		if ($sort != 0) {
			ksort($arrayList);
		}
		$str = $this->getArray2Str($arrayList);
		$salt = $this->generateSalt_e(4);
		$finalString = $str . "|" . $salt;
		$hash = hash("sha256", $finalString);
		$hashString = $hash . $salt;
		$checksum = $this->encrypt_e($hashString, $key);
		return $checksum;
	}
	function encrypt_e($input, $ky) {
		$key = $ky;
		$size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
		$input = $this->pkcs5_pad_e($input, $size);
		$td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
		$iv = "@@@@&&&&####$$$$";
		mcrypt_generic_init($td, $key, $iv);
		$data = mcrypt_generic($td, $input);
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		$data = base64_encode($data);
		return $data;
	}
	
	function decrypt_e($crypt, $ky) {
		$crypt = base64_decode($crypt);
		$key = $ky;
		$td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
		$iv = "@@@@&&&&####$$$$";
		mcrypt_generic_init($td, $key, $iv);
		$decrypted_data = mdecrypt_generic($td, $crypt);
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		$decrypted_data = $this->pkcs5_unpad_e($decrypted_data);
		$decrypted_data = rtrim($decrypted_data);
		return $decrypted_data;
	}
	function pkcs5_pad_e($text, $blocksize) {
		$pad = $blocksize - (strlen($text) % $blocksize);
		return $text . str_repeat(chr($pad), $pad);
	}
	function pkcs5_unpad_e($text) {
		$pad = ord($text{strlen($text) - 1});
		if ($pad > strlen($text))
			return false;
		return substr($text, 0, -1 * $pad);
	}
	function generateSalt_e($length) {
		$random = "";
		srand((double) microtime() * 1000000);
		$data = "AbcDE123IJKLMN67QRSTUVWXYZ";
		$data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
		$data .= "0FGH45OP89";
		for ($i = 0; $i < $length; $i++) {
			$random .= substr($data, (rand() % (strlen($data))), 1);
		}
		return $random;
	}
	function checkString_e($value) {
		$myvalue = ltrim($value);
		$myvalue = rtrim($myvalue);
		if ($myvalue == 'null')
			$myvalue = '';
		return $myvalue;
	}
	
	function verifychecksum_e($arrayList, $checksumvalue) {
		$key = $this->salt_key;
		$arrayList = $this->removeCheckSumParam($arrayList);
		ksort($arrayList);
		$str = $this->getArray2Str($arrayList);
		$paytm_hash = $this->decrypt_e($checksumvalue, $key);
		$salt = substr($paytm_hash, -4);
		$finalString = $str . "|" . $salt;
		$website_hash = hash("sha256", $finalString);
		$website_hash .= $salt;
		$validFlag = "FALSE";
		if ($website_hash == $paytm_hash) {
			$validFlag = "TRUE";
		} else {
			$validFlag = "FALSE";
		}
		return $validFlag;
	}
	function getArray2Str($arrayList) {
		$paramStr = "";
		$flag = 1;
		foreach ($arrayList as $key => $value) {
			if ($flag) {
				$paramStr .= $this->checkString_e($value);
				$flag = 0;
			} else {
				$paramStr .= "|" . $this->checkString_e($value);
			}
		}
		return $paramStr;
	}
	function redirect2PG($paramList, $key) {
		$hashString = $this->getchecksumFromArray($paramList);
		$checksum = $this->encrypt_e($hashString, $key);
	}
	function removeCheckSumParam($arrayList) {
		if (isset($arrayList["CHECKSUMHASH"])) {
			unset($arrayList["CHECKSUMHASH"]);
		}
		return $arrayList;
	}
	function getTxnStatus($requestParamList) {
		return callAPI(PAYTM_STATUS_QUERY_URL, $requestParamList);
	}
	function initiateTxnRefund($requestParamList) {
		$CHECKSUM = $this->getChecksumFromArray($requestParamList,PAYTM_MERCHANT_KEY,0);
		$requestParamList["CHECKSUM"] = $CHECKSUM;
		return callAPI(PAYTM_REFUND_URL, $requestParamList);
	}
	function callAPI($apiURL, $requestParamList) {
		$jsonResponse = "";
		$responseParamList = array();
		$JsonData =json_encode($requestParamList);
		$postData = 'JsonData='.urlencode($JsonData);
		$ch = curl_init($apiURL);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                         
		'Content-Type: application/json', 
		'Content-Length: ' . strlen($postData))                                                                       
		);  
		$jsonResponse = curl_exec($ch);   
		$responseParamList = json_decode($jsonResponse,true);
		return $responseParamList;
	}
	
}
