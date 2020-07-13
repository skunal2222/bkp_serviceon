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
	
	public function signup() {
		$this->load->library ( 'zyk/UserLoginLib' );
		$fbdata = $this->userloginlib->facebooklogin();
		$godata = $this->userloginlib->googlelogin();

		if(!empty($fbdata['authUrl'])) {
			$this->template->set('fbauthUrl',$fbdata['authUrl']);
		}
		if(!empty($godata['goauthUrl'])) {
			$this->template->set('goauthUrl',$godata['goauthUrl']);
		}
		
		$this->template->set_theme('default_theme');
		$this->template->set ( 'page', 'signup' );
		$this->template->set_layout ('default')
		->title ( 'Petpedia' )
		->set_partial ( 'header', 'default/header' )
		->set_partial ( 'footer', 'default/footer' );
		$this->template->build ('booking');
	}
	
	public function loginDisplay() {
		$this->load->library ( 'zyk/UserLoginLib' );
		$fbdata = $this->userloginlib->facebooklogin();
		$godata = $this->userloginlib->googlelogin();
	
		if(!empty($fbdata['authUrl'])) {
			$this->template->set('fbauthUrl',$fbdata['authUrl']);
		}
		if(!empty($godata['goauthUrl'])) {
			$this->template->set('goauthUrl',$godata['goauthUrl']);
		}
	
		$this->template->set_theme('default_theme');
		$this->template->set ( 'page', 'login' );
		$this->template->set_layout ('default')
		->title ( 'Petpedia' )
		->set_partial ( 'header', 'default/header' )
		->set_partial ( 'footer', 'default/footer' );
		$this->template->build ('login');
	}
	
	public function UserRegistration() {
		$da = array ();
		$reg = array ();
		$reg ['name'] = $this->input->post ( 'fname' ).' '.$this->input->post ( 'lname' );
		$reg ['password'] = $this->input->post ( 'password' );
		$reg ['original'] = $this->input->post ( 'password' );
		$reg ['email'] = $this->input->post ( 'email' );
		$reg ['mobile'] = $this->input->post ( 'mobile' );
		
		$this->load->library ( 'zyk/UserLoginLib' );
		if(!empty($this->input->post ( 'referal_code' ))){
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
		
		$exist = $this->userloginlib->userExist ( $reg );
		if ($exist['status'] == 0) {
			$register = $this->userloginlib->userRegistration ( $reg );
			//print_r($register);
			//exit;
			if ($register ['status'] == 1) {
				$this->session->set_userdata ( 'active', 1 );
				
				$response['status'] = 0;
				$response['refstatus'] = 1;
				$response['id'] =$register['id'];
				$response['email'] =$this->input->post ( 'email' );
				$data['my_ref_code'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($register['id'], 10, 36));
				$data['id'] = $register['id'];
				$this->userloginlib->updateUserRegistration($data);
			} else {
				$this->session->set_userdata ( 'active', 0 );
				
				$response['status'] = 1;
				
			}
			//echo json_encode ( $register );
			echo json_encode ( $response );
			//print_r($response);
					
		} else {
			echo json_encode ( $exist );
		}
		
	}
	
	public function addOtp() {
		$da = array ();
		$reg = array ();
		$reg ['mobile'] = $this->input->post ( 'mobile' );
		$reg ['name'] = $this->input->post ( 'name' ).' '.$this->input->post ( 'name1' );
		$reg ['email'] = $this->input->post ( 'email' );
		$reg ['original'] = $this->input->post ( 'password' );
		$reg ['password'] = md5 ( $this->input->post ( 'password' ));
	
	
		$this->load->library ( 'zyk/UserLoginLib' );
		$exist = $this->userloginlib->mobileExist ( $reg );
	    if ($exist['exist'] == 0) // register user
		{
			
			$da = $this->userloginlib->mobileRegistration ( $reg );
			$exist['is_register'] = 1;
			$exist['id'] = $da['id'];
			$exist['msg'] = 'Mobile registered successfully';
			
			if(empty($da['my_ref_code'])){
				$dataref['my_ref_code'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($da['id'], 10, 36));
				$dataref['id'] = $da['id'];
				$this->userloginlib->updateUserRegistration($dataref);
			}
	
				
		} else {
			if($exist['status'] == 0)
			{
				$da = $this->userloginlib->updatemobileRegistration ( $reg );
				//print_r($id);
				$exist['is_register'] = 1;
				$exist['id'] = $da[0]['id'];
				$exist['msg'] = 'Otp successfully submitted';
				
				if(empty($da['my_ref_code'])){
					$dataref['my_ref_code'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($da['id'], 10, 36));
					$dataref['id'] = $da['id'];
					$this->userloginlib->updateUserRegistration($dataref);
				}
			}
			else
			{
			$exist['is_register'] = 0;
			$exist['msg'] = 'Mobile already registered';
			}
		}
		
		echo json_encode($exist);
	}
	
	public function otpMatch() {
		$this->load->library ( 'zyk/UserLoginLib' );
		$reg = array ();
		$reg ['id'] = $this->input->post ( 'id' );
		$reg ['otp'] = $this->input->post ( 'otp' );
		
		$category_id = $this->input->post('category_id');
		$brand_id = $this->input->post('brand_id');
		$subcategory_id = $this->input->post('subcategory_id');
		$subcategory_id1 = $this->input->post('subcategory_id1');
		$model_id = $this->input->post('model_id');
		$catsubcat_id = $this->input->post('catsubcat_id[]');
		$user = $this->userloginlib->otpMatch ( $reg );
		$data = $user[0];
		//print_r($user[0]);
		//	exit;
		if($user[0]['status'] == 1) {
			$data = $user[0];
			$_SESSION['category_id']=$category_id;
			$_SESSION['brand_id']=$brand_id;
			$_SESSION['subcategory_id']=$subcategory_id;
			$_SESSION['subcategory_id1']=$subcategory_id1;
			$_SESSION['model_id']=$model_id ;
			$_SESSION['catsubcat_id']=$catsubcat_id ;
			$data['session'] = 1;
			
			if(empty($user[0]['my_ref_code'])){
				$dataref['my_ref_code'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($user[0]['id'], 10, 36));
				$dataref['id'] = $user[0]['id'];
				$this->userloginlib->updateUserRegistration($dataref);
			}
		
		} else {
			$data['status'] = 0;
			$data['msg'] = "please enter the correct otp";
		}
		if ($data ['status'] == '1') {
			$this->session->set_userdata ( 'olouserid', $data['id'] );
			$this->session->set_userdata ( 'olousername', $data['name'] );
			$this->session->set_userdata ( 'olouseremail',$data ['email'] );
			$this->session->set_userdata ( 'olousermobile', $data['mobile'] );
			$this->session->set_userdata ( 'olouserpassword', $data['original'] );
		}
		echo json_encode ( $data);
	}
	
	public function otpResend() {
		$this->load->library ( 'zyk/UserLoginLib' );
		$reg = array ();
		$reg ['email'] = $this->input->post ( 'email' );
	
		$user = $this->userloginlib->otpResend( $reg );
		//print_r($user);
		//exit;
		//$da = $user[0];
	
		echo json_encode ( $user );
	}
	
	public function userProfile() {
		if (! isset ( $_SESSION ['olouserid'] )) {
			redirect ( base_url () );
		}
		$userid = $_SESSION ['olouserid'];
		$this->load->library ( 'zyk/UserLoginLib' );
		$profile = $this->userloginlib->getProfile ( $userid );
		$address = $this->userloginlib->getAddressById ( $userid );
		$this->template->set ( 'address', $address );
		$this->template->set ( 'profile', $profile[0] );
		$this->template->set ( 'page', 'home' );
		$this->template->set_theme ( 'default_theme' );
		$this->template->set_layout ( 'default' )->title ( 'Order food online | Home Delivery | Takeaway, Dine In' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'profile' );
	}
	
	public function editProfile() {
		if (! isset ( $_SESSION ['olouserid'] )) {
			redirect ( base_url () );
		}
		$userid = $_SESSION ['olouserid'];
		$this->load->library ( 'zyk/UserLoginLib' );
		$profile = $this->userloginlib->getProfile ( $userid );
		$address = $this->userloginlib->getAddressById ( $userid );
		$this->template->set ( 'address', $address );
		$this->template->set ( 'profile', $profile[0] );
		$this->template->set ( 'page', 'profile' );
		$this->template->set_theme ( 'default_theme' );
		$this->template->set_layout ( 'default' )->title ( 'Order food online | Home Delivery | Takeaway, Dine In' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'profile_edit' );
	}
	
	public function userAddress() {
		if (! isset ( $_SESSION ['olouserid'] )) {
			redirect ( base_url () );
		}
		$userid = $_SESSION ['olouserid'];
		$this->load->library ( 'zyk/UserLoginLib' );
		$profile = $this->userloginlib->getProfile ( $userid );
		$address = $this->userloginlib->getAddressById ( $userid );
		$this->template->set ( 'addresses', $address );
		$this->template->set ( 'page', 'home' );
		$this->template->set ( 'userId', '' );
		$this->template->set_theme ( 'default_theme' );
		$this->template->set_layout ( 'default' )->title ( 'Order food online | Home Delivery | Takeaway, Dine In' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'address' );
	}
	public function addNewAddress() {
		$data ['address'] = $this->input->post ( 'address' );
		$data ['address_name'] = $this->input->post ( 'address_name' );
		$data ['longitude'] = $this->input->post ( 'longitude' );
		$data ['latitude'] = $this->input->post ( 'latitude' );
		$data ['areaid'] = $this->input->post ( 'areaid' );
		$data ['userid'] = $this->input->post('userid');
		$data ['locality'] = $this->input->post ( 'locality' );
		$data ['landmark'] = $this->input->post ( 'landmark' );
		$data ['is_primary'] = 0;
		$this->load->library ( 'zyk/UserLoginLib' );
		$add_id = $this->userloginlib->addAddress ( $data );
		$resp = array('status'=>1,'msg'=>'Added Successfully.','address_id'=>$add_id);
		echo json_encode($resp);
	}
	public function userOrder() {
		if (! isset ( $_SESSION ['olouserid'] )) {
			redirect ( base_url () );
		}
		$userid = $_SESSION ['olouserid'];
		$this->load->library ( 'zyk/UserLoginLib' );
		$orders = $this->userloginlib->getOrderDetailByUserId ( $userid );
		$this->template->set ( 'orders', $orders );
		$this->template->set ( 'page', 'home' );
		$this->template->set ( 'userId', '' );
		$this->template->set_theme ( 'default_theme' );
		$this->template->set_layout ( 'default' )->title ( 'Order food online | Home Delivery | Takeaway, Dine In' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'userorders' );
	}
	public function updateAddress() {
		$data ['address'] = $this->input->post ( 'address' );
		$data ['address_name'] = $this->input->post ( 'address_name' );
		$data ['longitude'] = $this->input->post ( 'longitude' );
		$data ['latitude'] = $this->input->post ( 'latitude' );
		$data ['areaid'] = $this->input->post ( 'areaid' );
		$data ['userid'] = $this->session->userdata ( 'olouserid' );
		$data ['locality'] = $this->input->post ( 'locality' );
		$data ['landmark'] = $this->input->post ( 'landmark' );
		$data ['is_primary'] = 0;
		$data ['id'] = $this->input->post ( 'id' );
		$this->load->library ( 'zyk/UserLoginLib' );
		$this->userloginlib->updateAddress ( $data );
		$resp = array('status'=>1,'msg'=>'Updated Successfully.');
		echo json_encode($resp);
	}
	
	//Edit address
	public function getAddressByAddressId($id) {
		$this->load->library ( 'zyk/UserLoginLib' );
		$address = $this->userloginlib->getAddressByAddressId ( $id );
		$this->template->set ( 'address', $address[0] );
		$this->template->set ( 'page', 'home' );
		$this->template->set ( 'userId', '' );
		$this->template->set_theme ( 'default_theme' );
		$this->template->set_layout ( 'default' )->title ( 'Order food online | Home Delivery | Takeaway, Dine In' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'address_edit' );
	}
	public function updateUserProfile() {
		$data = array ();
		if ($this->input->post ( 'name' ) != '') {
			$data ['name'] = $this->input->post ( 'name' );
		}
		$data ['id'] = $_SESSION ['olouserid'];
		if ($this->input->post ( 'password' ) != '') {
			$data ['password'] = md5 ( $this->input->post ( 'password' ) );
		}
		$this->load->library ( 'zyk/UserLoginLib' );
		$this->userloginlib->updateUserProfile ( $data );
		$da = array('status'=>1,'msg'=>'Updated Successfully.');
		if ($da ['status'] == 1) {
			$this->session->set_userdata ( 'olousername', $data ['name'] );
		} else {
			$this->session->set_userdata ( 'active', 0 );
		}
		echo json_encode($da);
	}
	
	public function login2() {
		$login = array ();
		//$login ['email'] = $this->input->post ( 'email' );
		$login ['mobile'] = $this->input->post ( 'mobile' );
		$login ['password'] = $this->input->post ( 'password' );
	
		
		$this->load->library ( 'zyk/UserLoginLib' );
		$exist = $this->userloginlib->mobileExist ( $login );
		if ($exist['status'] == 0) {
			$data['is_verify'] = 1;
			$data['msg'] = "Invalid Mobile.Please Register";
				
		}
		else
		{
			$user = $this->userloginlib->login ( $login );
			if($user[0]['status'] == 1) {
				if($user[0]['otp_chk']==1)
				{
					$data = $user[0];
					$data['otp_verify'] = 1;
					$data['session'] = 1;
					if(empty($user[0]['my_ref_code'])){
						$dataref['my_ref_code'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($user[0]['id'], 10, 36));
						$dataref['id'] = $user[0]['id'];
						$this->userloginlib->updateUserRegistration($dataref);
					}
				}
				else
				{
					$login ['otp'] = mt_rand(100000,999999);
					$user = $this->userloginlib->login1 ( $login );
					$data = $user[0];
					$data['otp_verify'] = 0;
					$data['msg'] = "please verify otp";
				}
	
			} else
			{
					
				$data['status'] = 0;
				$data['msg'] = "User name or password wrong";
			}
		}
	
		if ($data['otp_verify'] == '1') {
			$this->session->set_userdata ( 'olouserid', $data['id'] );
			$this->session->set_userdata ( 'olousername', $data['name'] );
			$this->session->set_userdata ( 'olouseremail', $data['email'] );
			$this->session->set_userdata ( 'olousermobile', $data['mobile'] );
			$this->session->set_userdata ( 'olouserpassword', $data['original'] );
			$this->session->set_userdata ( 'olouseraddr', $data['address'] );
		}
		echo json_encode ( $data );
	}
	
	public function login() {
		$login = array ();
		//$login ['email'] = $this->input->post ( 'email' );
		$login ['mobile'] = $this->input->post ( 'mobile' );
		$login ['password'] = $this->input->post ( 'password' );
		
		$category_id = $this->input->post('category_id');
		$brand_id = $this->input->post('brand_id');
		$subcategory_id = $this->input->post('subcategory_id');
		$subcategory_id1 = $this->input->post('subcategory_id1');
		$model_id = $this->input->post('model_id');
		$catsubcat_id = $this->input->post('catsubcat_id[]');
		
		$this->load->library ( 'zyk/UserLoginLib' );
		$exist = $this->userloginlib->mobileExist ( $login );
		if ($exist['status'] == 0) {
			$data['is_verify'] = 1;
			$data['msg'] = "The email ID/ mobile number entered is not registered. Kindly use a registered ID or sign up to continue.";
			
		}
		else 
		{
		$user = $this->userloginlib->login ( $login );
			if($user[0]['status'] == 1) {
				if($user[0]['otp_chk']==1)
				{
					 $data = $user[0];
				    $_SESSION['category_id']=$category_id;
					 $_SESSION['brand_id']=$brand_id;
					 $_SESSION['subcategory_id']=$subcategory_id;
					 $_SESSION['subcategory_id1']=$subcategory_id1;
					$_SESSION['model_id']=$model_id ;
					$_SESSION['catsubcat_id']=$catsubcat_id ;
					 $data['otp_verify'] = 1;
					 $data['session'] = 1;
					 
					 if(empty($user[0]['my_ref_code'])){
					 	$dataref['my_ref_code'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($user[0]['id'], 10, 36));
					 	$dataref['id'] = $user[0]['id'];
					 	$this->userloginlib->updateUserRegistration($dataref);
					 }
				}
				else
				{
					$login ['otp'] = mt_rand(100000,999999);
					$user = $this->userloginlib->login1 ( $login );
					$data = $user[0];
					$data['otp_verify'] = 0;
					$data['msg'] = "please verify otp";
				}
				
			} else 
			{
			
				$data['status'] = 0;
				$data['msg'] = "The username or password entered is incorrect. Try again.";
			}
		}
		
		if ($data['otp_verify'] == '1') {
			$this->session->set_userdata ( 'olouserid', $data['id'] );
			$this->session->set_userdata ( 'olousername', $data['name'] );
			$this->session->set_userdata ( 'olouseremail', $data['email'] );
			$this->session->set_userdata ( 'olousermobile', $data['mobile'] );
			$this->session->set_userdata ( 'olouserpassword', $data['original'] );
			$this->session->set_userdata ( 'olouseraddr', $data['address'] );
		}
		
		echo json_encode ( $data );
	}
	
	public function sendOtp() {
		$login = array ();
		//$login ['email'] = $this->input->post ( 'email' );
		$login ['mobile'] = $this->input->post ( 'mobile' );
	
		$this->load->library ( 'zyk/UserLoginLib' );
		$exist = $this->userloginlib->mobileExist ( $login );
		//print_r($exist);
		if ($exist['status'] == 1) 
		{
			$data['is_verify'] = 0;
			$login ['otp'] = mt_rand(100000,999999);
			$user = $this->userloginlib->login1 ( $login );
			$data['id'] =$exist[0]['id'];
			$data['email'] =$exist[0]['email'];
			if(empty($exist[0]['my_ref_code'])){
				$dataref['my_ref_code'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($exist[0]['id'], 10, 36));
				$dataref['id'] = $exist[0]['id'];
				$this->userloginlib->updateUserRegistration($dataref);
			}
		}
	   else
		{
			$data['msg'] = "The email ID/ mobile number entered is not registered. Kindly use a registered ID or sign up to continue.";
		}
		
	
		if ($data['otp_verify'] == '1') {
			$this->session->set_userdata ( 'olouserid', $data['id'] );
			$this->session->set_userdata ( 'olousername', $data['name'] );
			$this->session->set_userdata ( 'olouseremail', $data['email'] );
			$this->session->set_userdata ( 'olousermobile', $data['mobile'] );
			$this->session->set_userdata ( 'olouserpassword', $data['original'] );
			$this->session->set_userdata ( 'olouseraddr', $data['address'] );
		}
		echo json_encode ( $data );
	}
	
	function logout() {
		$this->session->unset_userdata ( 'olouserid' );
		$this->session->unset_userdata ( 'olousername' );
		$this->session->unset_userdata ( 'olouseremail' );
		$this->session->unset_userdata ( 'olousermobile' );
		$this->session->set_userdata ( 'olouserpassword');
		unset($_SESSION['subcategory_id']);
		session_destroy();
		redirect ( base_url () );
	}
	
	/*function forgetPassword(){
		$this->load->library ( 'zyk/UserLoginLib' );
		$data = $this->userloginlib->forgetPassword ( $this->input->get ( 'forgetPassword' ));
		echo json_encode($data);
	}*/
	function resendOTP()
	{
		$data=array();
		$data['email']=$this->input->get('email');
		$data['mobile']=$this->input->get('mobile');
		$this->load->library ( 'zyk/UserLoginLib' );
		$result = $this->userloginlib->resendOTP ( $data );
		echo json_encode($result);
	}
	function newAddress()
	{
		if (! isset ( $_SESSION ['active'] )) {
			redirect ( base_url () );
		}
		$this->load->library ( 'zyk/General' );
		$city = $this->general->getCities ();
		$this->load->library ( 'zyk/UserLoginLib' );
		$this->template->set ( 'city', $city );
		$this->template->set ( 'page', 'home' );
		$this->template->set ( 'userId', '' );
		$this->template->set_theme ( 'default_theme' );
		$this->template->set_layout ( 'default' )->title ( 'Order food online | Home Delivery | Takeaway, Dine In' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'NewAddress' );
	}
	
	function subscribe()
	{
		$email = array();
		$email['date'] = date("Y-m-d");
		$email['email']=$this->input->get('email');
		$this->load->library ( 'zyk/UserLoginLib' );
		$data = $this->userloginlib->subscribe ( $email );
		
		echo json_encode($data);
	}
	function changePassword()
	{
		$data ['id'] = $_SESSION ['userId'];
		
		if ($this->input->post ( 'password' ) != '') {
			$data ['password'] = md5 ( $this->input->post ( 'password' ) );
		}
		$this->load->library ( 'zyk/UserLoginLib' );
		$da = $this->userloginlib->updateUserProfile ( $data );
		redirect('user/profile/'.$data ['id']);
	}
	
	public function newPassword() {
		$this->template->set ( 'page', 'profile' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
					   ->title ( 'Order food online | Home Delivery | Takeaway, Dine In' )
					   ->set_partial ( 'header', 'partials/header' )
					   ->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('changepassword');
	}
	function changePwd()
	{
		$this->load->library ( 'zyk/UserLoginLib' );
		$params = array();
		$params['id'] = $this->input->post ( 'userid' );
		$params['password'] = md5($this->input->post ( 'password' ));
		if(empty($params['id'])) {
			$result = array('msg'=>'User Id Required.','status'=>0);
			exit;
		}
		if(empty($params['password'])) {
			$result = array('msg'=>'Password Required.','status'=>0);
			exit;
		}
		$result = array();
		$this->userloginlib->updateUserProfile ( $params );
		$result['status'] = 1;
		$result['msg'] = 'success';
		$result['id'] = $params['id'];
		echo json_encode($result);
	}
	
	public function userWallet() {
		if (! isset ( $_SESSION ['olouserid'] )) {
			redirect ( base_url () );
		}
		$userid = $_SESSION ['olouserid'];
		$this->load->library ( 'zyk/UserLoginLib' );
		$wallet = $this->userloginlib->getWalletBalance($userid);
		$transactions = $this->userloginlib->getWalletTransactions($userid);
		$this->template->set ( 'wallet', $wallet );
		$this->template->set ( 'transactions', $transactions );
		$this->template->set ( 'page', 'home' );
		$this->template->set_theme ( 'default_theme' );
		$this->template->set_layout ( 'default' )->title ( 'Order food online | Home Delivery | Takeaway, Dine In' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'userwallet' );
	}
	
	public function resetPassword() {
		$this->load->library ( 'zyk/UserLoginLib' );
		$email = $this->input->post ( 'email' );
		$data = $this->userloginlib->forgetPassword ($email);
		$result = array();
	    if($data[0]['status'] == 1) {
			$result['status'] = 1;
			$result['msg'] = 'success';
			unset($data[0]['password']);
			$result['msg'] = 'Instructions to reset your password.';
			$result['data'] = $data[0];
		} else {
			$result['status'] = 0;
			$result['msg'] = 'The email id or Mobile submitted has not been registered. Kindly submit a registered email address or Mobile.';
		}
		echo json_encode($result);
	}
	
	function forgetPassword(){
		$this->load->library ( 'zyk/userloginlib' );
		$email = $this->input->post('email');
		$data = $this->userloginlib->forgetPassword($email);
		$resp = array();
		if(count($data) > 0) {
			$resp['status'] = 1;
			$resp['msg'] = 'Email send to your registered email with password.';
		} else {
			$resp['status'] = 0;
			$resp['msg'] = 'Sorry this email is not registered with us.';
		}
		echo json_encode($resp);
	}
	
	function resetPassword1()
	{
		$reg = array ();
		$reg ['original'] = $this->input->post ( 'password' );
		$reg ['password'] = md5($this->input->post ( 'password' ));
		$reg ['id'] = $this->input->post ( 'id' );
		$this->load->library ( 'zyk/UserLoginLib' );
		$da = $this->userloginlib->updateUserProfile ( $reg );
		$resp = array();
		if(count($da) > 0) {
			$resp['status'] = 1;
			$resp['msg'] = 'Password updated successfully.';
		} else {
			$resp['status'] = 0;
			$resp['msg'] = 'Password is not updated.';
		}
		echo json_encode($resp);
	}
	
}

