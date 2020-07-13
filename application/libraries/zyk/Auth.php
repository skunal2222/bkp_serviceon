<?php
class Auth {
	
	public function __construct(){
		$this->CI =& get_instance();
	}
	
	public function login($udata) {
		$map = array();
		$this->CI->load->helper ( array (
				'form',
				'url'
		) );
		$this->CI->load->library ( 'form_validation' );
		$errorMsg = array ();
		$err_num = 0;
		$errors = array ();
		$_POST = $udata;
		$this->CI->form_validation->set_rules ( 'username', 'User Name', 'trim|required' );
		$this->CI->form_validation->set_rules ( 'password', 'Password', 'trim|required' );
		if ($this->CI->form_validation->run () == FALSE) {
			$error = strip_tags ( form_error ( 'username' ) );
			if (! empty ( $error )) {
				array_push ( $errors, $error );
			}
			$error = strip_tags ( form_error ( 'password' ) );
			if (! empty ( $error )) {
				array_push ( $errors, $error );
			}
			$errorMsg [$err_num] ["errors"] = $errors;
		}
		if(count($errorMsg) <= 0) {
			$this->CI->load->model ( 'users/user_model', 'user' );
			$userdetail = $this->CI->user->getUserByUserName ( $udata['username'] );
			if(count($userdetail) > 0) {
				if($userdetail[0]['password'] == md5($udata['password'])) {
					$userinfo = array();
					$userinfo['id'] = $userdetail[0]['id'];
					$userinfo['first_name'] = $userdetail[0]['first_name'];
					$userinfo['last_name'] = $userdetail[0]['last_name'];
					$userinfo['email'] = $userdetail[0]['email'];
					$userinfo['mobile'] = $userdetail[0]['mobile'];
					$userinfo['user_role'] = $userdetail[0]['user_role'];
					$userinfo['busi_id'] = $userdetail[0]['busi_id'];
					$userinfo['busi_name'] = $userdetail[0]['busi_name'];
					$userinfo['avatar'] = $userdetail[0]['avatar'];
					$userinfo['cust_type'] = $userdetail[0]['cust_type'];
					$userinfo['membership_type'] = $userdetail[0]['membership_type'];
					$userinfo['membership_status'] = $userdetail[0]['membership_status'];
					$userinfo['cce_verify'] = $userdetail[0]['cce_verify'];
					$userinfo['status'] = $userdetail[0]['status'];
					$userinfo['terms_accepted'] = $userdetail[0]['terms_accepted'];
					$userinfo['cce_verify'] = $userdetail[0]['cce_verify'];
					$userinfo['otp_verify'] = $userdetail[0]['otp_verify'];
					$userinfo['is_manager'] = $userdetail[0]['is_manager'];
					$permissions = $this->CI->user->getUserPermissions ( $userdetail[0]['user_role'] );
					$userinfo['permissions'] = $permissions;
					$map ['status'] = 1;
					$map ['msg'] = "Logged In successfully.";
					$map['result'] = $userinfo;
				} else {
					array_push ( $errors, 'Invalid password.' );
					$errorMsg [$err_num] ["errors"] = $errors;
					$map ['status'] = 0;
					$map ['msg'] = "Username or password is wrong.";
					$map ['errormsg'] = $errorMsg;
				}
			} else {
				array_push ( $errors, 'Invalid user name.' );
				$errorMsg [$err_num] ["errors"] = $errors;
				$map ['status'] = 0;
				$map ['msg'] = "Username or password is wrong.";
				$map ['errormsg'] = $errorMsg;
			}
		} else {
			$map ['status'] = 0;
			$map ['msg'] = "Failed to login.";
			$map ['errormsg'] = $errorMsg;
		}
		return $map;
	}
	
	/**
	 * Code For logout Functionality
	 */
	public function logout() {
		
	}
	
	public function editPassword($data)
	{
		$this->CI->load->model ( 'users/user_model', 'user' );
		return $userdetail = $this->CI->user->editPassword($data);
	}
	
	public function  checkPassword($data)
	{
		$response = array();
		$this->CI->load->model ( 'users/user_model', 'user' );
		$result =  $userdetail = $this->CI->user->checkPassword($data);
		if(count($result) > 0)
		{
			$response['status'] = 1;
			$response['msg'] = "Record Found";
		}
		else
		{
			
			$response['status'] = 0;
			$response['msg'] = "Old Password Not correct";
		}
		return $response;
	}
	/**
	 * Code For Create Captcha Image
	 * @return unknown
	 */
	public function createCaptcha()
	{
		$chars = "0123456789";
        $word = '';
        for ($a = 0; $a <= 5; $a++) {
            $b = rand(0, strlen($chars) - 1);
            $word .= $chars[$b];
        }
        $this->word = $word;
  	    $this->CI->load->helper('captcha');
		$vals = array(
	        'word'      => $this->word,
		    'img_path'  => './assets/captcha/',
			'img_url'   => base_url().'assets/captcha/',
	        'font_path'     =>'./system/fonts/texb.ttf',//'./path/to/fonts/texb.ttf',
	        'img_width'     => '150',
	        'img_height'    => 30,
	        'expiration'    => 7200,
	        'word_length'   => 8,
	        'font_size'     => 16,
			 'colors'        => array(
	                'background' => array(255, 255, 255),
	                'border' => array(150, 255, 255),
	                'text' => array(255, 0, 0),
	                'grid' => array(255, 255, 50)
	        )
		);
		$cap = create_captcha($vals);
		$this->CI->session->set_userdata('captchaWord',$cap);
		return $cap;
	}
}
