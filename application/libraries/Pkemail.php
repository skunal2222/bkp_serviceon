<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pkemail {

	private $client = null;
	public $config = array();
	public $attachment = 0;
	public $from = '';
	public $reply_to = '';
	public $to = '';
	public $headline = '';
	public $subject = '';
	public $file = '';
	public $bcc = 0;
	public $mctag = '';
	private $smtp = '';
	private $port = '';
	private $smtp_user = '';
	private $smtp_pass = '';
	private $CI;
	private $email_activation = true;


	function __construct() {
		unset($this->config);
		$this->CI =& get_instance();
		$fb_config = parse_ini_file(APPPATH."config/APP.ini");
		$this->email_activation = $fb_config['email_activate'];
	}

	function send_email( $message ) {
		//print_r($message);
		if($this->email_activation)
		{
			$CI = &get_instance();
			$CI->load->library('email',$this->config);
                        $data = [
                            'email' => $this->to,
                            'subject' => $this->subject,
                            'message'   => $message,
                            'from' => EMAIL,
                            'password' => PASS
                        ];
                        $this->send_email_curl($data);
                        return true;
			$CI->email->set_newline("\r\n");
			$CI->email->from($this->from, $this->headline);
			$CI->email->reply_to($this->reply_to, EMAIL);
			if($this->bcc)
				$CI->email->bcc($this->to);
			else
				$CI->email->to($this->to);
			$CI->email->subject($this->subject);
			if($this->attachment == 1)
				$CI->email->attach($this->file);
			//if($this->mctag)
				//$CI->email->mctag($this->mctag);
			$CI->email->message($message);
		    if (!$CI->email->send()) 
		    {
		    	echo $CI->email->print_debugger();
			   	return false;
		    }
			else
			{
				$CI->email->clear(TRUE);
				return true;
			}
		}
	}  
	
function load_system_config() {
		$this->config = array (
			  'protocol' => 'smtp',
			  'smtp_host' => 'ssl://smtp.gmail.com',
			  'smtp_port' => 587,
			  'smtp_user' => EMAIL,
			  'smtp_pass' => PASS,
			  'mailtype'  => 'html',
			  'smtp_timeout' => 30,
			  'crlf' => "\r\n",
			  '_smtp_auth' =>TRUE,
  			  'newline' => "\r\n");

		$this->config['mailtype'] = 'html'; 
		$this->config['send_multipart'] = FALSE; 
		$this->config['charset'] = 'iso-8859-1';
		$this->config['wordwrap'] = TRUE;
		$this->from = EMAIL;
		$this->headline = HEADING;
		$this->reply_to = EMAIL;
	}
        public function send_email_curl($param) {
            //return true;
            $ch = curl_init('https://www.brandzgarage.com/send_cloud_mail');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
            $response = curl_exec($ch);
            curl_close($ch);
        }
	

}
