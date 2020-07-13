<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Fbsms {

	var $CI;
	private $sms_activation = true;
	function __construct() {
		$this->CI =& get_instance();
		$tk_config = parse_ini_file(APPPATH."config/APP.ini");
		$this->sms_activation = $tk_config['sms_activate'];
	}

	public function sendSms(  $smsMap ) {
		if($this->sms_activation)
		{
			$this->sendMSms($smsMap);
		}
	}
	
	public function sendMSms( $smsMap ) {
		
	}

}
