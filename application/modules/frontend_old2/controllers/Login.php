<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Login extends MX_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$this->load->helper ( 'form' );
		$this->load->library ( 'session' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
	}

	 public function login() {
		 $login = array ();
		 $login ['username'] = $this->input->post ( 'username' );
		 $login ['password'] = $this->input->post ( 'password' );
		
		 $this->load->library ( 'zyk/UserLoginLib' );
		
		 $user = $this->userloginlib->login($login);
	//	 print_r($user); exit;
		 if ($user['status'] == '1' ) {
			 $this->session->set_userdata ( 'olouserid', $user[0]['id'] );
			 $this->session->set_userdata ( 'olousername', $user[0]['name'] );
			 $this->session->set_userdata ( 'olouseremail', $user[0]['email'] );
			 $this->session->set_userdata ( 'olousermobile', $user[0]['mobile'] );
			 if(!empty($user[0]['coupon_code'])){
			 	$this->session->set_userdata('olousercode',$user[0]['coupon_code']);
			 }
			
			 $data['status'] = 1;
			 $data['msg'] = "Logged In Successfully";
		 } 
		 elseif ($user['status'] == '2'){
		 	$data['status'] = 2;
		 	$data['otp'] = $user[0]['otp'];
		 	$data['id'] = $user[0]['id'];
		 }
		 else {
			 $data['status'] = 0;
			 $data['msg'] = "User name or password wrong";
		 }  
		 echo json_encode ( $data );
	 }

	 function logout() {
		$this->session->unset_userdata ( 'olouserid' );
		$this->session->unset_userdata ( 'olousername' );
		$this->session->unset_userdata ( 'olouseremail' );
		$this->session->unset_userdata ( 'olousermobile' );
		$this->session->set_userdata ( 'olouserpassword');
		session_destroy();
		redirect ( base_url () );
	}

	public function resendOtp()
	{
		$login = array ();
		//$login ['email'] = $this->input->post ( 'email' );
		$login ['username'] = $this->input->post ( 'username' );

		$this->load->library ( 'zyk/UserLoginLib' );
		$result = array();
		$exist = $this->userloginlib->userLoginExist ( $login );
		if ($exist['status'] == 1)
		{
			$exist ['otp'] = mt_rand(100000,999999);
			$result ['status'] = 1;
			$result ['id'] = $exist['id'];
			$result ['email'] = $exist['email'];
			$result ['mobile'] = $exist['mobile'];
			$result ['fname'] = $exist['name'];
			$result ['lname'] = $exist['lname'];
			$result ['otp'] = $exist['otp'];
			$result ['username'] = $login ['username'] ;
			//$this->userloginlib->sendOTPEmail($result);
			$this->userloginlib->sendOTPSMS($result);
		}
		else
		{
			 $result['status'] = 0;
			 $result['msg'] = "The email ID/ mobile number entered is not registered. Kindly use a registered ID or sign up to continue.";
		}
		echo json_encode ( $result );
	}
	public function otpSend() {
		$this->load->library ( 'zyk/UserLoginLib' );
		$reg = array ();
		$reg ['fname'] = $this->input->post ( 'fname' );
		$reg ['lname'] = $this->input->post ( 'lname' );
		$reg ['email'] = $this->input->post ( 'email' );
		$reg ['mobile'] = $this->input->post ( 'mobile' );
		$user = $this->userloginlib->otpSend( $reg );
		echo json_encode ($user);
	}

	public function UserRegistration() {
	
		$this->load->library ( 'zyk/UserLoginLib' );
		$data = array ();
		$reg = array ();
		$reg ['name'] = $this->input->post ('fname');
		$reg ['lname'] = $this->input->post ('lname' );
		$reg ['password'] = $this->input->post('password');
		$reg ['original'] = $this->input->post('password');
		$reg ['email'] = $this->input->post ( 'email' );
		$reg ['mobile'] = $this->input->post ('mobile');
		$reg ['otp'] = $this->session->userdata('otp');
		$reg ['source'] = 1;
		$reg ['status'] = 1; 
				
		if(!empty($this->input->post('referal_code'))){
			$reg ['coupon_code'] = $this->input->post('referal_code');
			$referral = $this->userloginlib->validateReferralCode($reg ['coupon_code']);
			
			if(count($referral) > 0){
				$reg ['coupon_code'] = $reg ['coupon_code'];
			}else{
				$da['status'] = 0;
				$da['refstatus'] = 0;
				$da['msg'] = 'invalid refferal code';
				echo json_encode($da);
				return true;
			}
		}else{
			$reg ['coupon_code'] = '';
		}
				
	/*	echo "<pre>";
		print_r($reg);
		exit();*/

		$register = $this->userloginlib->userRegistration ( $reg );
		$data['my_ref_code'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($register['id'], 10, 36)) ;
		$data['id'] = $register['id'];
		$this->userloginlib->updateUserRegistration($data);
	  
		if ($register ['status'] == 1) {
                    // mloyal api
                    $registerdata = array(
                        'mobile' => $register['mobile'],
                      //  'name' => $register['name'] .' ' .$register['lname'], 
                        'name' => $register['name'],
                        'email' => $register['email']
                    );
                    $this->load->library('MloyalLib', 'mloyallib');
                    $this->mloyallib->insert_customer_registration_action($registerdata);

                    //end mloyal
			 $sms = $this->userloginlib->sendSignUpSMS($reg); 
			 $email = $this->userloginlib->sendSignUpEmail($reg);
			 
			 $this->session->set_userdata ( 'olouserid',     $register ['id'] );
			 $this->session->set_userdata ( 'olousername',   $register ['name'] );
			 $this->session->set_userdata ( 'olouseremail',  $register ['email'] );
			 $this->session->set_userdata ( 'olousermobile', $register ['mobile'] );
			 $this->session->set_userdata ( 'active', 1 );
		
			$response['status'] = 1;
			$response['email'] =$this->input->post ( 'email' );
		} else {
			$this->session->set_userdata ( 'active', 0 );
			$response['status'] = 0;
		}
		echo json_encode ( $response );
	}
 

	public function sendLoginotp() {
		$login = array ();
		//$login ['email'] = $this->input->post ( 'email' );
		$login ['username'] = $this->input->post ( 'username' );

		$this->load->library ( 'zyk/UserLoginLib' );
		$result = array();
		$exist = $this->userloginlib->userLoginExist ( $login );
		if ($exist['status'] == 1)
		{
			$exist ['otp'] = mt_rand(100000,999999);
			$result ['status'] = 1;
			$result ['id'] = $exist['id'];
			$result ['email'] = $exist['email'];
			$result ['mobile'] = $exist['mobile'];
			$result ['fname'] = $exist['name'];
			$result ['lname'] = $exist['lname'];
			$result ['otp'] = $exist['otp'];
			$result ['username'] = $login ['username'] ;
		//	$this->userloginlib->sendOTPEmail($result);
			$this->userloginlib->sendOTPSMS($result);
		}
		else
		{
			 $result['status'] = 0;
			 $result['msg'] = "The email ID/ mobile number entered is not registered. Kindly use a registered ID or sign up to continue.";
		}
		echo json_encode ( $result );
	}

	public function loginwithOTP(){
		$otp = array();
		$otp['otp'] = $this->input->post('otp');
		$otp['id'] = $this->input->post('id');
	//	print_r($this->input->post());
		$this->load->library ( 'zyk/UserLoginLib' );
		$user = $this->userloginlib->loginwithOTP ( $otp );
		if($user[0]['status'] == 1){
			$this->session->set_userdata ( 'olouserid', $user[0]['id'] );
			$this->session->set_userdata ( 'olousername', $user[0]['name'] );
			//$this->session->set_userdata ( 'olouserlname', $user[0]['lname'] );
			$this->session->set_userdata ( 'olouseremail', $user[0]['email'] );
			$this->session->set_userdata ( 'olousermobile', $user[0]['mobile'] );
			$data['status'] = 1;
		}else{
			$data['status'] = 0;
		}
		echo json_encode($data);
	}


	public function updateProfile() {

		 $data = $this->input->post();
		$da = array ();
		$reg = array ();
		$userId = $this->session->userdata('olouserid') ;   
		$reg['id'] = $userId ; 
		$reg['name'] = $this->input->post('fname');
		$reg['lname'] = $this->input->post('lname');
		$reg['email'] = $this->input->post('email');
		$reg['mobile'] = $this->input->post('mobile'); 
		$reg['password'] = md5($this->input->post('cpassword')); 
		$reg['original'] = $this->input->post('cpassword');
		//$reg['model'] = $this->input->post('modelname'); 
		//$reg['vehicle_no'] = $this->input->post('modelno');  
		 
		$this->load->library ( 'zyk/UserLoginLib' );
		$register = $this->userloginlib->userUpdate ( $reg );
		if ($register['status'] == 1) {
			$this->session->set_userdata ( 'olousername', $reg ['name'] );
			$this->session->set_userdata ( 'olouserlname', $reg ['lname'] ); 
			$this->session->set_userdata ( 'olouseremail', $reg ['email'] );
			$this->session->set_userdata ( 'olousermobile', $reg ['mobile'] ); 
			$response['status'] = 1;
			$response['msg'] = "Profile updated";
		} else { 
			$response['status'] = 0; 
			$response['msg'] = "Error occured";
		}
		echo json_encode ( $response );
	
	}

	public function forgetPassword() {
		$this->load->library ( 'zyk/UserLoginLib' );
		$email = $this->input->post ( 'email' ); 
		$data = $this->userloginlib->forgetPassword ($email);
		$result = array();
		$exist = array();
		//if($data[0]['status'] == 1) {

		if (count ( $data ) > 0) {
			
			$exist ['id'] = $data[0]['id'];
			$exist ['otp'] = mt_rand(100000,999999);
			$this->userloginlib->updateUserProfile ($exist );
			$userdata = $this->userloginlib->getProfile ($data[0]['id']);
			$userdata[0]['reset_code']=$userdata[0]['otp'];

			$result['status'] = 1;
			$result['msg'] = 'success';
			unset($data[0]['password']);
		//	print_r($userdata[0]); exit;
			$result['msg'] = 'Instructions to reset your password has been sent on your email id.';
			$this->userloginlib->forgetPasswordEmail ($userdata[0] );
		//	$this->userloginlib->forgetPasswordSMS($userdata[0]);
			$result['data'] = $data[0];
			
		} else {
			$result['status'] = 0;
			$result['msg'] = 'The email id submitted has not been registered. Kindly submit a registered email Id.';
		}
		echo json_encode($result);
	}
	public function resetPassword($id,$resetcode) {

		$this->template->set ( 'userid', $id);
		$this->template->set ( 'resetcode', $resetcode);
		$this->template->set ( 'page', 'home' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'Bikedoctor' )
		//->meta ( 'doctors' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('index');
	
	}
	public function updatePassword() {

		$this->load->library ( 'zyk/UserLoginLib' );
		$data = array();
		$data['id'] = $this->input->post ( 'userid' );
		$data['reset_code'] = $this->input->post ( 'resetcode' );
		$data['password'] = md5($this->input->post ( 'password' ));
		$data['original'] = $this->input->post ( 'password' );
		//echo "<pre>";  print_r($data); exit(); 
		$result = $this->userloginlib->updateUserPassword ($data);
		$response = array();
		$response['status'] = 1;
		$response['msg'] = 'Password Reset succesfully please login with new password <a href="#" data-dismiss="modal" class="spl-radius" data-toggle="modal" data-target="#myLoginModal"  >click here to Login</a>'; 
		echo json_encode($response);
	}
}
