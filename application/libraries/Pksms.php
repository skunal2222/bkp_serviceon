<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pksms {

	var $CI;
	private $sms_activation = true;
	function __construct() {
		$this->CI =& get_instance();
		$tk_config = parse_ini_file(APPPATH."config/APP.ini");
		$this->sms_activation = $tk_config['sms_activate'];
	}

	public function sendSms(  $smsMap ) {
	//	print_r($smsMap);
		if($this->sms_activation)
		{
			$this->sendTempSms($smsMap);
		}
	}
	
	public function sendTempSms( $smsMap ) {

		$ch = curl_init();
		$smsUrl = "http://www.alots.in/sms-panel/api/http/index.php";
		$user = "Serviceon";
		$apikey = "AABCC-AC11A";
		$senderID = "ServOn";
		$map = array();

		$map['username'] = $user;
		// $map['password'] = '4I9A0'; // original password serviceon
		$map['apikey'] = $apikey;
		$map['apirequest'] = "Unicode";
		$map['sender'] = $senderID;
		$map['mobile'] = $smsMap['mobile'];
		$map['message'] = $smsMap['message'];
		$map['route'] = "TRANS";
		$map['format'] = "JSON";
		//$map['response'] = "Y";
		$postdata = http_build_query($map);
		$smsUrl = $smsUrl."?".$postdata;
		// echo $smsUrl; die();
		curl_setopt($ch,CURLOPT_URL,  $smsUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$buffer = curl_exec($ch);
		if(empty ($buffer))
		{ return false; }
		else
		{ return true; }
		curl_close($ch);
	}
}