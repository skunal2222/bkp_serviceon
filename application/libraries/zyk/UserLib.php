<?php
class UserLib {
	
	public function __construct() {
		$this->CI = & get_instance ();
	}

	/************************ code start by kunal**************************/
	public function getAddressByIDs($data=ARRAY())
	{
		$this->CI->load->model ( 'users/User_model', 'user' );
		return $this->CI->user->getAddressByIDs($data);
	}

	public function get_statelist($countryid=NULL)
	{
		$this->CI->load->model ( 'users/User_model', 'user' );
		return $this->CI->user->get_statelist($countryid);
	}

	public function get_citylist($stateid=NULL)
	{
		$this->CI->load->model ( 'users/User_model', 'user' );
		return $this->CI->user->get_citylist($stateid);
	}

	public function submit_address($data)
	{
		$this->CI->load->model ( 'users/User_model', 'user' );
		return $this->CI->user->submit_address($data);
	}

	public function getUser($data) {
		$this->CI->load->model ( 'users/User_model', 'user' );
		return $this->CI->user->getUser ( $data );
	}

	public function getSlotdetails($data=NULL) {
		$this->CI->load->model ( 'users/User_model', 'user' );
		return $this->CI->user->getSlotdetails ( $data );
	}
	/************************ code end by kunal**************************/









	public function sendCallbackEmail() {
		//echo "inside email";
		//print_r($user);
			//	print_r($_POST); exit;
		$headline111="";
		if($_POST['fromtype']=='enquiry')
	   $headline111="enquiry Form";
	    elseif($_POST['fromtype']=='contactus')
	    $headline111="Contact Us";
	    else
	 	$headline111="Parter with US";
	 
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'Enquiry from '. $headline111;
		$this->CI->pkemail->subject = 'Enquiry';
		$this->CI->pkemail->mctag = 'signup-msg';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = 'support@bikedoctor.in';
		$this->CI->template->set( 'data',$_POST );
		//$this->CI->template->set ( 'page', 'otp-message' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/enquiry-message', '', true );

		
		$this->CI->pkemail->send_email ($text_body );
		
	}
	public function sendB2BEmail() {
		//echo "inside email";
		//print_r($user);
			//	print_r($_POST); exit;
		 
	 	$headline ="B2B Enquiry Form";
	 
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'Enquiry from '. $headline;
		$this->CI->pkemail->subject = 'Enquiry';
		$this->CI->pkemail->mctag = 'signup-msg';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = 'support@bikedoctor.in';
		$this->CI->template->set( 'data',$_POST );
		//$this->CI->template->set ( 'page', 'otp-message' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/B2B-enquiry-message', '', true );

		
		$this->CI->pkemail->send_email ($text_body );
		
	}
		
	public function userExist($data) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$exist = $this->CI->userlogin->userExist ( $data );
		if (count ( $exist ) > 0) {
			
			if($exist[0]['status'] == 0)
			{
				$exist['msg']="Your account is not activated.To activate your account please verify your registerded email address .";
				$exist['id']=$exist[0]['id'];
				$exist['status'] = 1;
				return $exist;
			}
			else 
			{
				$exist['msg']="Email already registered with us.";
				$exist['id']=$exist[0]['id'];
				$exist['status'] = 1;
				return $exist;
			}
		} else {
			$exist['status'] = 0;
			return $exist;
		}
	}
		
	public function mobileExist($data) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$exist = $this->CI->userlogin->mobileExist ( $data );
		if (count ( $exist ) > 0) {
			
			if($exist[0]['status'] == 0)
			{
				$exist['msg']="Your account is not activated.To activate your account please verify your registerded email address .";
				$exist['id']=$exist[0]['id'];
				$exist['status'] = 1;
				return $exist;
			}
			else 
			{
				$exist['msg']="Mobile already registered with us.";
				$exist['id']=$exist[0]['id'];
				$exist['status'] = 1;
				return $exist;
			}
		} else {
			$exist['status'] = 0;
			return $exist;
		}
	}


	public function userRegistration($data) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$text_password = $data ['password'];
		$data ['password'] = md5 ( $data ['password'] );
		$data['created_on']=date('Y-m-d H:i:s');
		try {
			$user_id = $this->CI->userlogin->userRegistration ( $data );
			$wallets = array();
			$wallets['userid'] = $user_id;
			$wallets['amount'] = 0;
			$wallets['created_date'] = date('Y-m-d H:i:s');
			$wallets['updated_date'] = date('Y-m-d H:i:s');
			$this->CI->load->model ( 'users/Wallet_model', 'wallet' );
			$this->CI->wallet->createWallet ( $wallets );
			$map = array ();
			if ($user_id > 0) {
				$map ['status'] = 1;
				$map ['message'] = 'Successfully registered.';
				$map ['id'] = $user_id;
				$map ['name'] = $data ['name'];
				$map ['email'] = $data ['email'];
				//$map ['mobile'] = $data ['mobile'];
				if(!empty($data ['mobile'])){
					$map ['mobile'] = $data ['mobile'];
				}else{
					$map ['mobile'] = '';
				}
				$data['password'] = $text_password;
				//$this->sendSignUpEmail ( $data );
				//$this->sendSignUpSMS($data);
				//$this->sendOTPEmail($data);
			} else {
				$map ['status'] = 0;
				$map ['message'] = 'Failed to register.';
			}
		} catch ( Exception $e ) {
			$map ['status'] = 0;
			$map ['message'] = 'Failed to register.';
		}
		
		return $map;
	}
	// public function userRegistration($data) {
	// 	$this->CI->load->model ( 'users/User_model', 'userlogin' );
	// 	$text_password = $data ['password'];
	// 	$data ['password'] = md5 ( $data ['password'] );
	// 	$data['created_on']=date('Y-m-d H:i:s');
	// 	try {
	// 		$user_id = $this->CI->userlogin->userRegistration ( $data );
	// 		$wallets = array();
	// 		$wallets['userid'] = $user_id;
	// 		$wallets['amount'] = 0;
	// 		$wallets['created_date'] = date('Y-m-d H:i:s');
	// 		$wallets['updated_date'] = date('Y-m-d H:i:s');
	// 		$this->CI->load->model ( 'users/Wallet_model', 'wallet' );
	// 		$this->CI->wallet->createWallet ( $wallets );
	// 		$map = array ();
	// 		if ($user_id > 0) {
	// 			$map ['status'] = 1;
	// 			$map ['message'] = 'Successfully registered.';
	// 			$map ['id'] = $user_id;
	// 			$map ['name'] = $data ['name'];
	// 			$map ['email'] = $data ['email'];
	// 			//$map ['mobile'] = $data ['mobile'];
	// 			if(!empty($data ['mobile'])){
	// 				$map ['mobile'] = $data ['mobile'];
	// 			}else{
	// 				$map ['mobile'] = '';
	// 			}
	// 			$data['password'] = $text_password;
	// 			//$this->sendSignUpEmail ( $data );
	// 			//$this->sendSignUpSMS($data);
	// 			//$this->sendOTPEmail($data);
	// 		} else {
	// 			$map ['status'] = 0;
	// 			$map ['message'] = 'Failed to register.';
	// 		}
	// 	} catch ( Exception $e ) {
	// 		$map ['status'] = 0;
	// 		$map ['message'] = 'Failed to register.';
	// 	}
		
	// 	return $map;
	// }

	public function getUserAddressnk($id){
		$this->CI->load->model ( 'users/User_model', 'user' );
		return $this->CI->user->getUserAddressById($id);
	}

	public function sendOTPSMS($details) {
		$sms_msg = 'Please Use This OTP ' . $details ['otp'] . ' (system generated one time password) Your Otp is valid only for 15 mins.';
		$this->CI->load->library ( 'Fbsms' );
		$map = array ();
		$map ['mobile'] = $details ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->fbsms->sendSms ( $map );
	}
	
	public function sendThanksSms($data) {
		$sms_msg = "Dear {$data['name']}, Welcome and thanks for joining the sweet world of Abreeze, your everyday food partner.";
		$this->CI->load->library ( 'Pksms' );
		$map = array ();
		$map ['mobile']  = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
		//exit() ;
	}
	
	public function sendThanksEmail($user) {
		$this->CI->load->library ( 'Pkemail' );
		$this->CI->pkemail->load_system_config();
		$this->CI->pkemail->headline = 'Abreeze welcome';
		$this->CI->pkemail->subject = 'Welcome to Abreeze';
		$this->CI->pkemail->mctag = 'welcome-msg';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $user ['email'];
		$this->CI->template->set ( 'data', $user );
		$this->CI->template->set ( 'page', 'otp-message' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/welcome-email', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}

	public function otpMatch($id, $otp) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$params = array ();
		$params ['id'] = $id;
		$params ['otp'] = $otp;
		$user = $this->CI->userlogin->otpMatch ( $params );
		if(isset($user['email'])){
			$this->sendSignUpEmail ( $user [0] );
		}
		return $user;
	}
	
	public function login($params) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$data = $this->CI->userlogin->login ( $params );
		if (count ( $data ) > 0) {
			$data [0] ['status'] = 1;
			$data[0]['msg'] = 'Logged in successfully.';
		} else {
			$data [0] ['status'] = 0;
			$data[0]['msg'] = 'Invalid Email Or Password.';
		}
		return $data;
	}
	// public function login($params) {
	// 	$this->CI->load->model ( 'users/User_model', 'userlogin' );
	// 	$data = $this->CI->userlogin->login ( $params );
	// 	if (count ( $data ) > 0) {
	// 		$data [0] ['status'] = 1;
	// 		$data[0]['msg'] = 'Logged in successfully.';
	// 	} else {
	// 		$data [0] ['status'] = 0;
	// 		$data[0]['msg'] = 'Invalid Email Or Password.';
	// 	}
	// 	return $data;
	// }
	
	public function updateUser($data) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		return $this->CI->userlogin->updateUser ( $data );
	}
	
	public function updateUser1($data) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		return $this->CI->userlogin->updateUser1 ( $data );
	}
	
	public function updateUser2($data) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		return $this->CI->userlogin->updateUser2 ( $data );
	}
	
	public function getUser1($data) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		return $this->CI->userlogin->getUser1 ( $data );
	}
	
	public function addAddress($data) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		return $this->CI->userlogin->addAddress ( $data );
	}
	
	public function contact($data) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		return $this->CI->userlogin->contact ( $data );
	}
	
	public function getAddressById($data) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$result = $this->CI->userlogin->getAddressById ( $data );
		return $result;
	}
	
	public function updateAddress($data) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$result = $this->CI->userlogin->updateAddress ( $data );
	}
	
	public function getAddressByAddressId($id) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$result = $this->CI->userlogin->getAddressByAddressId ( $id );
		return $result;
	}
	
	public function getProfile($id) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$result = $this->CI->userlogin->getProfile ( $id );
		return $result;
	}
	
	public function getProfileByEmail($email) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$result = $this->CI->userlogin->getProfileByEmail ( $email );
		return $result;
	}
	
	public function getUserByEmail($email) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$result = $this->CI->userlogin->getUserByEmail ( $email );
		return $result;
	}
	
	public function getProfileByMobile($mobile) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$result = $this->CI->userlogin->getProfileByMobile ( $mobile );
		return $result;
	}
	
	public function getProfileByName($name) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$result = $this->CI->userlogin->getProfileByName ( $name );
		return $result;
	}
	
	public function updateUserProfile($data) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$result = $this->CI->userlogin->updateUserProfile ( $data );
		return $result;
	}
	
	public function updateLatLong($data) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$result = $this->CI->userlogin->updateLatLong ( $data );
	}
	
	public function getTodaysRegisteredUsers() {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$result = $this->CI->userlogin->getTodaysRegisteredUsers ();
		return $result;
	}
	
	public function deleteaddress($id) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$result = $this->CI->userlogin->deleteaddress ($id);
		return $result;
	}
	
 //    public function sendOTPSMS($details) {
	// 	//echo "inside sms";
	// 	//$sms_msg = 'Your OTP is ' . $details ['otp'] . '.';
	// 	$name = explode(" ",$details['name']);
	// 	$fname = $name[0];
	// 	$sms_msg = 'Hi '.$fname.', Use verification code ' . $details ['otp'] . ' to complete the registration process on BikeDoctor.';
	// 	$this->CI->load->library ( 'Pksms' );
	// 	$map = array ();
	// 	$map ['mobile'] = $details ['mobile'];
	// 	$map ['message'] = $sms_msg;
	// 	$this->CI->pksms->sendSms ( $map );
	// }
	
	
	public function sendOTPEmail($user) {
		//echo "inside email";
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'BikeDoctor verifyOTP';
		$this->CI->pkemail->subject = 'Verify your email on BikeDoctor';
		$this->CI->pkemail->mctag = 'signup-msg';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $user ['email'];
		$this->CI->template->set ( 'data', $user );
		$this->CI->template->set ( 'page', 'signup-message' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/otp-email', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}
	
	public function forgetPasswordEmail($user) {
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'The Washing Bay';
		$this->CI->pkemail->subject = 'Your Username and Password ';
		$this->CI->pkemail->mctag = 'signup-msg';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $user ['email'];
		$this->CI->template->set ( 'name', $user['name'] );
		$this->CI->template->set ( 'email', $user['email'] );
		$this->CI->template->set ( 'password', $user['password'] );
		$this->CI->template->set ( 'page', 'forgetpassword' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/forget_password', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}
	
	public function sendForgetPasswordSMS($details) {
		$sms_msg = 'Dear  ' . $details ['name'] . 'your new Password is' . $details ['password'] . '.';
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $details ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function sendSignUpEmail($user) {
		//echo "inside email";
		//print_r($user);
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'TWB';
		$this->CI->pkemail->subject = 'Welcome to TWB';
		$this->CI->pkemail->mctag = 'signup-msg';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $user ['email'];
		$this->CI->template->set ( 'data', $user );
		$this->CI->template->set ( 'page', 'otp-message' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/signup', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}
	
	public function sendSubscribeEmail($user) {
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'OLO Newsletter';
		$this->CI->pkemail->subject = 'OLO : Newsletter';
		$this->CI->pkemail->mctag = 'newsletter';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $user ['email'];
		$this->CI->template->set ( 'data', $user );
		$this->CI->template->set ( 'page', 'signup-message' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/subscribe', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}

	
	public function forgetPassword($email){
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$result = $this->CI->userlogin->forgetPassword ( $email );
		if(count ($result)>0)
		{
			$this->forgetPasswordEmail ( $result[0] );
		}
		return $result;
	}
	
	public function resendOTP ($data)
	{
		//$this->CI->load->model ( 'users/User_model', 'userlogin' );
		//$exist = $this->CI->userlogin->userExist ( $data );
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$exist = $this->CI->userlogin->mobileExist ( $data );
		if (count ( $exist ) > 0) {
				$exist['msg']="OTP has been sent in your mobile.";
				$exist['is_verify']=1;
				$exist['exist']=1;
				$exist['id']=$exist[0]['id'];
				$exist['otp']=$exist[0]['otp'];
				$exist['status'] = 1;
				$this->sendOTPSMS ( $exist[0] );
				//$this->sendOTPEmail ( $exist[0] );
				return $exist;
		} else {
			$exist['status'] = 0;
			return $exist;
		}
	}
	
	public function addToWallet($params) {
		$this->CI->load->model ( 'users/Wallet_model', 'wallet' );
		$this->CI->wallet->addToWallet ( $params );
	}
	
	public function removeFromWallet($params) {
		$this->CI->load->model ( 'users/Wallet_model', 'wallet' );
		$this->CI->wallet->removeFromWallet ( $params );
	}
	
	public function getWalletBalance($userid) {
		$this->CI->load->model ( 'users/Wallet_model', 'wallet' );
		return $this->CI->wallet->getWalletBalance ( $userid );
	}
	
	public function getWalletTransactions($userid) {
		$this->CI->load->model ( 'users/Wallet_model', 'wallet' );
		return $this->CI->wallet->getWalletTransactions ( $userid );
	}
	
	public function getOrderDetailByUserId ( $id )
	{
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$order = $this->CI->userlogin->getOrderDetailByUserId ( $id );
		return $order;
		
	}
	
	public function getNotification ( $id )
	{
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$order = $this->CI->userlogin->getNotification ( $id );
		return $order;
	}
	
	public function updateNotification($map) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$notifyid = $this->CI->userlogin->updateNotification ( $map );
		return $notifyid;
	}
	
	public function subscribe($email)
	{
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$data = $this->CI->userlogin->subscribe ( $email );
		if (array_key_exists('email', $data)) {
				$this->sendSubscribeEmail ( $data );
		}
		return $data;
	}
	
	public function getUsersReport($params) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$users = $this->CI->userlogin->getUsersReport ( $params );
		return $users;
	}
	
	public function sendSignUpSMS($data) {
		//print_r($data);
		$sms_msg = 'Welcome ' . 'The Washing Bay OTP ,. Username:'.$data['email'].' OTP:'.$data['otp'].' Regards, The Washing Bay';
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function sendPasswordSMS($data) {
		$sms_msg = 'Welcome ' . $data ['name'] . ' , Hello '.$data['name'].', Your password is '.$data['password'].' . Regards, The Moustache Laundry';
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function is_valid_email($email) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$users = $this->CI->userlogin->forgetPassword ( $email );
		return $users;
	}
	
	public function updateAddressByUserId($map) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$this->CI->userlogin->updateAddressByUserId ( $map );
	}
	
	public function getValidReferralCode($ref_code) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$users = $this->CI->userlogin->getValidReferralCode ( $ref_code );
		return $users;
	}
	
	public function getUserGcmIds() {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		return $this->CI->userlogin->getUserGcmIds ( );
	}
	
	public function getUserGcmIdsbyId($userid) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		return $this->CI->userlogin->getUserGcmIdsbyId ( $userid );
	}
	
	public function getOrder($userid) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		return $this->CI->userlogin->getOrder ( $userid );
	}
	
	public function getOrderbyMobile($mobile) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		return $this->CI->userlogin->getOrderbyMobile ( $mobile );
	}
	
	public function getlastOrder($userid) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		return $this->CI->userlogin->getlastOrder ( $userid );
	}
	
	public function getlastOrderComment($orderid) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		return $this->CI->userlogin->getlastOrderComment ( $orderid );
	}
	
	public function getallComment($userid) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		return $this->CI->userlogin->getallComment ( $userid );
	}
	
	public function getBill($userid) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		return $this->CI->userlogin->getBill ( $userid );
	}
	
	public function setConfirmItem($order_id, $amont, $item_list) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		return $this->CI->userlogin->setConfirmItem($order_id, $amont, $item_list);
	}
	
	public function getReferCode($userid){
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		return $this->CI->userlogin->getReferCode($userid);
	} 
	
	public function getOngoingOrders($id) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$orders = $this->CI->userlogin->getOngoingOrders($id);
		
		$response = array();
		$products = array ();
		foreach ( $orders as $key => $row ) {
			$products [$key] = $row;
			
			$ordercomment = $this->CI->userlogin->getlastOrderComment($row['orderid']);
			$orderbill = $this->CI->userlogin->getOngoingOrderBill($row['orderid']);
			
			$products [$key]['comment'] = $ordercomment;
			$products [$key]['orderbill'] = $orderbill;
			
		}
		$response = $products;
		return $response;
	
		//return $response;
	}
	
	public function getOrderhistory($id) {
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$orders = $this->CI->userlogin->getOrderhistory($id);
		
		$response = array();
		$products = array ();
		foreach ( $orders as $key => $row ) {
			$products [$key] = $row;
			
		//	$ordercomment = $this->CI->userlogin->getlastOrderComment($row['orderid']);
			$orderbill = $this->CI->userlogin->getOngoingOrderBill($row['orderid']);
			
		//	$products [$key]['comment'] = $ordercomment;
			$products [$key]['orderbill'] = $orderbill;
			
		}
		$response = $products;
		return $response;
	
		//return $response;
	}
	
}