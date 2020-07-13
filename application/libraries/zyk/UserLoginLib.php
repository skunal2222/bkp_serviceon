<?php
//error_reporting(0);
class UserLoginLib {
	
	public function __construct() {
		$this->CI = & get_instance ();
	}
	
	public function userExist($data) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
	    $exist = $this->CI->userlogin->userExist ( $data );
	   if (count ( $exist ) > 0) {
			
			if($exist[0]['status'] == 0)
			{
				$exist['msg']="Your account is not activated.To activate your account please verify your registered email address.Please login to verify your account.";
				$exist['id']=$exist[0]['id'];
				$exist['status'] = 1;
				return $exist;
			}
			else 
			{
				$exist['msg']="The email id or mobile entered is already registered.";
				$exist['id']=$exist[0]['id'];
				$exist['status'] = 1;
				return $exist;
			}
		} else {
			$exist['status'] = 0;
			return $exist;
		}
	}
        public function otpSendSocial($data) {
            $data ['otp'] = mt_rand ( 10000, 99999 );
            $result ['msg'] = "OTP Send on Mobile No.";
            $result ['status'] = 0;
            $result ['otp'] = $data ['otp'];
            $data['fname'] = $data['name'];
            $data['mobile'] = $_POST['mobile'];
            //$this->session->set_userdata('opt', $result['otp']);
            $this->sendOTPSMS ( $data);
           // $this->sendOTPEmail ( $data );
            return $result['otp'];
        }
	public function userRegistration($data) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		//$data ['coupon_code'] = mt_rand ( 10000, 99999 );
	//	$data ['otp'] = mt_rand ( 100000, 999999 );
		$data ['password'] = md5 ( $data ['password'] );
		$data['created_on']=date('Y-m-d H:i:s');
		try {
			$user_id = $this->CI->userlogin->userRegistration ( $data );
			$referpoint= wallet_config();
		
				$wallets = array();
				$wallets['userid'] = $user_id;
				if(!empty($data ['coupon_code'])){
					$wallets['amount'] =$referpoint['my_referral'];
				}else{
					$wallets['amount'] = 0;
				}
				//$wallets['amount'] = 0;
				$wallets['created_date'] = date('Y-m-d H:i:s');
				$wallets['updated_date'] = date('Y-m-d H:i:s');
				$this->CI->load->model ( 'users/Wallet_model', 'wallet' );
				$this->CI->wallet->createWallet ( $wallets );
				
				$trans = array();
				$trans['userid'] = $user_id;
				$trans['amount'] = $wallets['amount'];
				$trans['is_debit'] = 0;
				$trans['updated_by'] = 0;
				$trans['updated_date'] = date('Y-m-d H:i:s');
				$this->CI->wallet->createTransaction ( $trans );
			$map = array ();
			if ($user_id > 0) {
				$map ['status'] = 1;
				$map ['message'] = 'Successfully registered.';
				$map ['id'] = $user_id;
				$map ['name'] = $data ['name'];
				$map ['email'] = $data ['email'];
				$map ['mobile'] = $data ['mobile'];
				$map ['original'] = $data ['password'];
				//$this->sendOTPSMS ( $data );
				//$this->sendOTPEmail ( $data );
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

	//optlogin check userexist or not   nitin
	public function userLoginExist($data) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		return	$exist = $this->CI->userlogin->userLoginExist ( $data );
	}


	public function login($params) {
		$params ['password'] = md5 ( $params ['password'] );
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$data = $this->CI->userlogin->login ( $params );
		if(empty($data))    $data['status'] = 0;
		else   $data['status'] = 1;
		return $data;
	}
	
	public function otpSend($data) {
		
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$exist = $this->CI->userlogin->userExist ( $data );
		$data ['otp'] = mt_rand ( 100000, 999999 );
		$result = array();
		if (count ( $exist ) > 0) {
			$result ['msg'] = "You are already registered with us.";
			$result ['status'] = 1;
			$result ['id'] = $exist [0] ['id'];
			return $result;
		}else{	
		    $result['status'] = 0;
			$result['otp'] = $data['otp'];
			$otp = $data['otp'];
			$data['fname']=$data['fname'];
	    // load Session Library
        $this->CI->load->library('session');
         // set single item in session
        $this->CI->session->set_userdata('otp',$otp);
		$this->sendOTPSMS ($data);
		//$this->sendOTPEmail ($data);
		return $result;
		}
	}
	
	public function loginwithOTP($params) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$data = $this->CI->userlogin->loginwithOTP ( $params );
		
		if (count ( $data ) > 0) {
			$data [0] ['status'] = 1;
			$data[0]['msg'] = 'Logged in successfully.';
		} else {
			$data [0] ['status'] = 0;
			$data[0]['msg'] = 'Invalid mobile Or OTP.';
		}
		return $data;
	}
	
	public function createWallet($params) {
		$this->CI->load->model ( 'users/Wallet_model', 'wallet' );
		$this->CI->wallet->createWallet ( $params );
	}

	public function userUpdate($data){
		$this->CI->load->model ( 'users/UserLogin_model', 'userloginmodel' );
		$response = $this->CI->userloginmodel->updateUserProfile_full($data);
		return $response ;
	}

	public function validateReferralCode($reffralcode){
		$this->CI->load->model ( 'users/UserLogin_model', 'userloginmodel' );
		return $this->CI->userloginmodel->validateReferralCode($reffralcode);
	}
	
	public function updateUserRegistration($data){
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$this->CI->userlogin->updateUserRegistration($data);
	}

	public function getReferCode($data){
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		return $this->CI->userlogin->getReferCode($data);
	}

	public function getWalletBalance($userid) {
		$this->CI->load->model ( 'users/Wallet_model', 'wallet' );
		return $this->CI->wallet->getWalletBalance ( $userid );
	}

	public function getNotificationByuserId($userid){
		$this->CI->load->model ( 'users/UserLogin_model', 'userloginmodel' );
		return $this->CI->userloginmodel->getNotificationByuserId($userid);
	}

	public function getNotificationCount($userid){
		$this->CI->load->model ( 'users/UserLogin_model', 'userloginmodel' );
		return $this->CI->userloginmodel->getNotificationCount($userid);
	}

	public function forgetPassword($email){
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$result = $this->CI->userlogin->forgetPassword ( $email );
		/*if(count ($result)>0)
		{
			$this->forgetPasswordEmail ( $result[0] );
		}*/
		return $result;
	}
	public function updateUserPassword($data) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$result = $this->CI->userlogin->updateUserPassword ( $data );
		return $result;
	}
	public function updateUserProfile($data) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$result = $this->CI->userlogin->updateUserProfile( $data );
		return $result;
	}
        public function updateUserProfile2($data) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$result = $this->CI->userlogin->updateUserProfile2( $data );
		return $result;
	}

	public function forgetPasswordEmail($user) {
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'ServiceOn';
		$this->CI->pkemail->subject = 'Recover Password';
		$this->CI->pkemail->mctag = 'signup-msg';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $user ['email'];
		$this->CI->template->set ( 'data', $user ); 
		$this->CI->template->set ( 'page', 'forgetPassword' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/forget_password', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}

	public function getProfile($id) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$result = $this->CI->userlogin->getProfile ( $id );
		return $result;
	}

	public function getUserAddressnk($id){
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$result = $this->CI->userlogin->getUserAddressById ( $id );
	}




/*---- old ----------------------*/	
	
	public function userAppExist($data) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$exist = $this->CI->userlogin->userExist ( $data );
		if (count ( $exist ) > 0) {
				
			if($exist[0]['status'] == 0)
			{
				$exist['msg']="Your account is not activated.To activate your account please verify your registered email address.Please login to verify your account.";
				$exist['id']=$exist[0]['id'];
				$exist['exist'] = 1;
				return $exist;
			}
			else
			{
				$exist['msg']="The email id or mobile entered is already registered.";
				$exist['id']=$exist[0]['id'];
				$exist['exist'] = 1;
				return $exist;
			}
		} else {
			$exist['status'] = 0;
			$exist['exist'] = 0;
			return $exist;
		}
	}
	
	
	public function mobileExist($data) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$exist = $this->CI->userlogin->mobileExist ( $data );
		//print_r($exist);
		if (count ( $exist ) > 0) {
				
			if($exist[0]['status']==0)
			{
				//echo "if";
				$exist['msg']="You are already registered with us.";
				$exist['is_verify']=1;
				$exist['exist']=1;
				$exist['id'] = $exist[0]['id'];
				$exist['mobile'] = $exist[0]['mobile'];
				$exist['status'] = 1;
				return $exist;
			}
			else
			{
				//echo "else";
				$exist['msg']="Mobile already registered.";
				$exist['is_verify']=0;
				$exist['exist']=1;
				$exist['id'] = $exist[0]['id'];
				$exist['mobile'] = $exist[0]['mobile'];
				$exist['status'] = 1;
				return $exist;
			}
		} else {
			//echo "elseeeee";
			$exist['exist'] = 0;
			return $exist;
		}
	}
	
	public function mobileRegistration($data) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$data ['otp'] = mt_rand ( 100000, 999999 );
		$data['created_on']=date('Y-m-d H:i:s');
		try {
			$user_id = $this->CI->userlogin->mobileRegistration ( $data );
			$map = array ();
			if ($user_id > 0) {
				$map ['status'] = 1;
				$map ['message'] = 'Successfully registered.';
				$map ['id'] = $user_id;
				$map ['mobile'] = $data ['mobile'];
				$this->sendOTPSMS ( $data );
				$this->sendOTPEmail ( $data );
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
	
	public function updatemobileRegistration($data) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$data ['otp'] = mt_rand ( 100000, 999999 );
		$id = $this->CI->userlogin->updatemobileRegistration ( $data );
		//print_r($id);
		$this->sendOTPSMS ( $data );
		return $id;
	}
	
	public function otpMatch($reg) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$params = array ();
		$params ['id'] = $reg['id'];
		$params ['otp'] = $reg['otp'];
		$user = $this->CI->userlogin->otpMatch ( $params );
		$this->sendSignUpEmail ( $user[0] );
		$this->sendSignUpSMS ( $user[0] );
		/*if(isset($user['email'])){
			$this->sendSignUpEmail ( $user[0] );
		}
		if($user[0]['status'] = "1"){
			$this->sendSignUpEmail ( $user[0] );
		}*/
		return $user;
	}
	
	public function otpResend ($data)
	{
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$exist = $this->CI->userlogin->userExist ( $data );
		if (count ( $exist ) > 0) {
			$exist['msg']="OTP has been sent in your email address.";
			$exist['is_verify']=1;
			$exist['exist']=1;
			$exist['id']=$exist[0]['id'];
			$exist['status'] = 1;
			$this->sendOTPSMS ( $exist[0] );
			$this->sendOTPEmail ( $exist[0] );
			return $exist;
		} else {
			$exist['status'] = 0;
			return $exist;
		}
	}
	
	public function addAddress($data) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		return $this->CI->userlogin->addAddress ( $data );
	}
	
	public function getAddressById($data) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$result = $this->CI->userlogin->getAddressById ( $data );
		return $result;
	}
	
	public function updateAddress($data) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$result = $this->CI->userlogin->updateAddress ( $data );
	}
	
	public function getAddressByAddressId($id) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$result = $this->CI->userlogin->getAddressByAddressId ( $id );
		return $result;
	}
	
	
		
		
	public function sendOTPSMS($details) {
		//echo "inside sms";
		//$sms_msg = 'Your OTP is ' . $details ['otp'] . '.';
		//$name = explode(" ",$details['name']);

		//$fname = $details['fname'];
		/*$sms_msg = 'Hi '.$fname.', Use verification code ' . $details ['otp'] . ' to complete the registration process on ServiceOn.';*/
		$sms_msg = 'Hi, Use verification code ' . $details ['otp'] . ' to complete the registration or login process on ServiceOn.';
		$this->CI->load->library ( 'Pksms' );
		$map = array ();
		$map ['mobile'] = $details ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	
	public function sendOTPEmail($user) {
		//echo "inside email";
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'ServiceOn verifyOTP';
		$this->CI->pkemail->subject = 'Verify your email on ServiceOn';
		$this->CI->pkemail->mctag = 'signup-msg';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $user ['email'];
		$this->CI->template->set ( 'data', $user );
		$this->CI->template->set ( 'page', 'signup-message' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/otp-email', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}
	
	/*public function forgetPasswordEmail($user) {
		$this->CI->load->library ( 'fbemail' );
		$this->CI->fbemail->load_system_config ();
		$this->CI->fbemail->headline = 'OLOTime Forgot Password';
		$this->CI->fbemail->subject = 'Forgot Password ';
		$this->CI->fbemail->mctag = 'signup-msg';
		$this->CI->fbemail->attachment = 0;
		$this->CI->fbemail->to = $user ['email'];
		$this->CI->template->set ( 'data', $user );
		$this->CI->template->set ( 'page', 'forgetpassword' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/forgetpassword', '', true );
		$this->CI->fbemail->send_email ( $text_body );
	} */
	
	
	
	public function sendForgetPasswordSMS($details) {
		$sms_msg = 'Dear ' . $details ['name'] . ' your new password is ' . $details ['password'] . ' .';
		$this->CI->load->library ( 'Fbsms' );
		$map = array ();
		$map ['mobile'] = $details ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->fbsms->sendSms ( $map );
	}
	
	public function sendSignUpSMS($details) {
		//echo "inside sms";
		//$sms_msg = 'Your OTP is ' . $details ['otp'] . '.';
		$name = explode(" ",$details['name']);
		$fname = $name[0];
		//$sms_msg = 'Hi '.$fname.',Use verification code ' . $details ['otp'] . ' to complete the registration process on Garage 2 Ghar.';
		$sms_msg = 'Hi '.$fname.', Thank you for signing up with ServiceOn - Doorstep Two-wheeler Servicing. Our team is ready to provide you the best service you deserve.';
 
		$this->CI->load->library ( 'Pksms' );
		$map = array ();
		$map ['mobile'] = $details ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function sendSignUpEmail($user) {
		//echo "inside";
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'ServiceOn';
		$this->CI->pkemail->subject = 'Welcome to ServiceOn';
		$this->CI->pkemail->mctag = 'reg-msg';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $user ['email'];
		$this->CI->template->set ( 'data', $user );
		$this->CI->template->set ( 'page', 'reg-message' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/signup-message', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}
	
	public function sendSubscribeEmail($user) {
		$this->CI->load->library ( 'fbemail' );
		$this->CI->fbemail->load_system_config ();
		$this->CI->fbemail->headline = 'olotime Newsletter';
		$this->CI->fbemail->subject = 'olotime : Newsletter';
		$this->CI->fbemail->mctag = 'newsletter';
		$this->CI->fbemail->attachment = 0;
		$this->CI->fbemail->to = $user ['email'];
		$this->CI->template->set ( 'data', $user );
		$this->CI->template->set ( 'page', 'signup-message' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/subscribe', '', true );
		$this->CI->fbemail->send_email ( $text_body );
	}
	
	/* public function forgetPassword($mobile,$client_id){
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$result = $this->CI->userlogin->forgetPassword ( $mobile,$client_id );
		if(count ($result)>0)
		{
			$this->sendOTPSMS ( $result[0] );
			$result[0]['status'] = '1';
		}
		else {
			$result[0]['status'] = '0';
		}
		
		return $result;
		
	} */
	
	
	
	public function resendOTP ($data)
	{
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$exist = $this->CI->userlogin->userExist ( $data );
		if (count ( $exist ) > 0) {
				$exist['msg']="OTP has been sent in your email address.";
				$exist['is_verify']=1;
				$exist['exist']=1;
				$exist['id']=$exist[0]['id'];
				//$this->sendOTPSMS ( $exist[0] );
				$this->sendOTPEmail ( $exist[0] );
				return $exist;
		}
	}
	public function getOrderDetailByUserId ( $id )
	{
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$order = $this->CI->userlogin->getOrderDetailByUserId ( $id );
		return $order;
		
	}
	public function subscribe($email)
	{
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$data = $this->CI->userlogin->subscribe ( $email );
		if (array_key_exists('email', $data)) {
			$this->sendSubscribeEmail ( $data );
		}
		return $data;
	}
	
	
	
	public function addToWallet($params) {
		$this->CI->load->model ( 'users/Wallet_model', 'wallet' );
		$this->CI->wallet->addToWallet ( $params );
	}
	
	public function removeFromWallet($params) {
		$this->CI->load->model ( 'users/Wallet_model', 'wallet' );
		$this->CI->wallet->removeFromWallet ( $params );
	}
	
	
	
	public function getWalletTransactions($userid) {
		$this->CI->load->model ( 'users/Wallet_model', 'wallet' );
		return $this->CI->wallet->getWalletTransactions ( $userid );
	}
	
	public function facebooklogin()
	{
		//$this->CI->load->model ( 'User', 'fblogin' );
		//$response = $this->CI->fblogin->checkUser ($id);
		//return $response;
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		//$data = $this->CI->userlogin->login ( $params );
	
		include_once APPPATH."libraries/facebook/facebook.php";
	
		// Facebook API Configuration
		$appId = '1808190342824411';
		$appSecret = 'd5343325f24e5b39abde02a32a29749a';
		$redirectUrl = base_url() . 'facebook/login';
		$fbPermissions = 'email';
	
		//Call Facebook API
		$facebook = new Facebook(array(
				'appId'  => $appId,
				'secret' => $appSecret
	
		));
		$fbuser = $facebook->getUser();
	   // echo $fbuser;
		if ($fbuser) {
			$userProfile = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
			// Preparing data for database insertion
			$userData['oauth_provider'] = 'facebook';
			$userData['oauth_uid'] = $userProfile['id'];
			$userData['name'] = $userProfile['first_name'];
			$userData['lname'] = $userProfile['last_name'];
			$userData['email'] = $userProfile['email'];
			//$userData['mobile'] = $userProfile['mobile'];
			/*$userData['gender'] = $userProfile['gender'];
				$userData['locale'] = $userProfile['locale'];
				$userData['profile_url'] = 'https://www.facebook.com/'.$userProfile['id'];
			$userData['picture_url'] = $userProfile['picture']['data']['url'];*/
			// Insert or update user data
			//$userID = $this->user->checkUser($userData);
			//$data['userData'] = $this->CI->userlogin->checkUserfb($userData);
			//$user_id = $this->CI->userlogin->userRegistration ( $userData );
			$userID = $this->CI->userlogin->checkUserfb($userData);
			$data = $this->CI->userlogin->getProfile ( $userID );
			//$data = $this->CI->userlogin->checkUserfb($userData);
			//print_r($data);
			//exit();
			if (count ( $data ) > 0) {
			/*	$data [0] ['id'] = $userID;				$data [0] ['name'] = $userData['name'];				$data [0] ['lname'] = $userData['lname'];				$data [0] ['email'] = $userData['email'];				$data [0] ['status'] = 1;				$data [0] ['type'] = 2;				$data[0]['msg'] = 'Logged in successfully.';*/								    $data['id'] = $userID;				$data['name'] = $userData['name'];				$data['lname'] = $userData['lname'];				$data['email'] = $userData['email'];				$data['status'] = 1;				$data['type'] = 2;				$data['msg'] = 'Logged in successfully.';				
			} else {
				$data['status'] = 0;				$data['type'] = 2;				$data['msg'] = 'Invalid facebook id';
			}
			/*if(!empty($userID)){
			 $data['userData'] = $userData;
			 //$this->session->set_userdata('userData',$userData);
				} else {
				$data['userData'] = array();
				}*/
		} else {
			$fbuser = '';
			$data['authUrl'] = $facebook->getLoginUrl(array('redirect_uri'=>$redirectUrl,'scope'=>$fbPermissions));
		}
		//$this->load->view('user_authentication/index',$data);
		//$this->load->view('signup',$data);
		return $data;
	
	}
	
	public function googlelogin()
	{
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
	
		include_once APPPATH."libraries/google/Google_Client.php";
		include_once APPPATH."libraries/google/contrib/Google_Oauth2Service.php";
	
		// Google Project API Credentials
		/*$clientId = '664719372866-9i5hp4a0oi63sena18dlh1imn4s35een.apps.googleusercontent.com';
			$clientSecret = '0d_7nbtjgvKxOoG_Lfh6xvn3';
			$redirectUrl = base_url() . 'google/login';*/
	
		$clientId = '257075493605-d1g90b54bilvnjd4nh0f0ia78th9e21b.apps.googleusercontent.com';
		$clientSecret = 'uWEwyWD_C2AujHvj1Xog2UK7';
		$redirectUrl = base_url() . 'google/login';
	
		// Google Client Configuration
		$gClient = new Google_Client();
		$gClient->setApplicationName('Workkar');
		$gClient->setClientId($clientId);
		$gClient->setClientSecret($clientSecret);
		$gClient->setRedirectUri($redirectUrl);
		$google_oauthV2 = new Google_Oauth2Service($gClient);
	
		if (isset($_REQUEST['code'])) {
			$gClient->authenticate();
			$this->CI->session->set_userdata('token', $gClient->getAccessToken());
			redirect($redirectUrl);
		}
	
		$token = $this->CI->session->userdata('token');
		//$this->CI->session->set_userdata($form_id.'captcha',$cap['word']);
		if (!empty($token)) {
			$gClient->setAccessToken($token);
		}
	
		if ($gClient->getAccessToken()) {
			$userProfile = $google_oauthV2->userinfo->get();
			// Preparing data for database insertion
			$userData['oauth_provider'] = 'google';
			$userData['oauth_uid'] = $userProfile['id'];
			$userData['name'] = $userProfile['given_name'];
			$userData['lname'] = $userProfile['family_name'];
			$userData['email'] = $userProfile['email'];
			//$userData['gender'] = $userProfile['gender'];
			//$userData['locale'] = $userProfile['locale'];
			//$userData['profile_url'] = $userProfile['link'];
			//$userData['picture_url'] = $userProfile['picture'];
			// Insert or update user data
			//$userID = $this->user->checkUser($userData);
			$userID = $this->CI->userlogin->checkUsergo($userData);
			$data = $this->CI->userlogin->getProfile ( $userID );
			//$data['userData'] = $this->CI->userlogin->checkUserfb($userData);
				
			if (count ( $data ) > 0) {
				$data ['id'] = $userID;
				$data ['fname'] = $userData['fname'];
				$data ['lname'] = $userData['lname'];
				$data ['email'] = $userData['email'];
				$data ['status'] = 1;
				$data ['type'] = 2;
				$data ['msg'] = 'Logged in successfully.';
			} else {
				$data [0] ['status'] = 0;
				$data [0] ['type'] = 2;
				$data[0]['msg'] = 'Invalid Google id';
			}
			/*if(!empty($userID)){
			 $data['userData'] = $userData;
			 $this->CI->session->set_userdata('userData',$userData);
				} else {
				$data['userData'] = array();
				}*/
		} else {
			$data['goauthUrl'] = $gClient->createAuthUrl();
		}
		return $data;
		//$this->load->view('user_authentication/index',$data);
	
	}
	
	
}