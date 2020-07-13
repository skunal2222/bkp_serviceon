<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * Auth API
 * @author Pradeep Singh
 * @package Auth
 *
 */
class Api extends REST_Controller {
	
	/**
	 * Fuction For user Login
	 * @return json
	 */
	
	public function login_post() {
		$login = array ();
		$login ['username'] = $this->post ( 'mobile' );
		$login ['password'] = $this->post ( 'password' );
		$contact_details = array();
		if (empty($login ['username']) || empty($login ['password']))
		{
			$response["success"] = "false";
			$response["msg"] = "Please enter mobile number and password";
		}
		else
		{
		   $this->load->library ( 'zyk/UserLoginLib' );
			$user = $this->userloginlib->login ( $login );
			 // print_r($user);
			if(isset($user[0]['status']) && $user[0]['status'] == 1) {
				$data = new stdClass();
				$data->ContactId = $user[0]['id'];
				$data->FirstName = $user[0]['name'];
				$data->Email = $user[0]['email'];
				$data->MobileNumber = $user[0]['mobile'];
				$data->Address = $user[0]['address'];
				$data->Landmark = $user[0]['landmark'];
				$data->AddressType = $user[0]['address_type'];
				//$data->areaid = $user[0]['areaid'];
				array_push($contact_details,$data);
				$response["status"] = "true";
				$response["message"] = "Login successful";
				$response["data"] = $contact_details;
				
				if(empty($user[0]['my_ref_code'])){
					$dataref['my_ref_code'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($user[0]['id'], 10, 36));
					$dataref['id'] = $user[0]['id'];
					$this->userloginlib->updateUserRegistration($dataref);
				}
				
				if (!empty($this->post('gcm_reg_id'))){
					$gcm = array();
					$gcm['id'] = $user[0]['id'];
					$gcm['gcm_reg_id'] = $this->post('gcm_reg_id');
					$this->load->library ( 'zyk/UserLib' );
					$this->userloginlib->updateUserProfile2($gcm);
				}
				
			} else {
				$response["status"] = "false";
				$response["message"] = "Invalid username or password";
				$response["data"] = $contact_details;
			}
		}
		$this->response ($response,200);
	}
	
	public function signup_post() {
		$this->load->library ( 'zyk/UserLoginLib' );
		$success_response = array();
		$reg = array ();
		//$reg ['name'] = trim$this->post ( 'fullname' );
		$reg ['name'] = $this->post ( 'fname' ).' '.$this->post ( 'lname' );
		$reg ['password'] = $this->post ( 'password' );
		$reg ['email'] = $this->post ( 'email' );
		$reg ['mobile'] = $this->post ( 'mobile' );
		
		$reg ['original'] = $this->post ( 'password' );
		$reg ['source'] = 'Friends';
		
		$reg ['otherss'] = '';
		//$reg ['otp'] = mt_rand (100000, 999999);
		
		$reg ['otp'] = '123456';
		
		$reg ['status'] = 1;
		//$this->load->library('zyk/General');
		
		//$this->load->library ( 'zyk/UserLoginLib' );
		if(!empty($this->post ( 'referal_code' ))){
			$reg ['coupon_code'] = $this->post('referal_code');
			$referral = $this->userloginlib->validateReferralCode($reg ['coupon_code']);
			if(count($referral) > 0){
				$reg ['coupon_code'] = $reg ['coupon_code'];
			}else{
				$success_response['status'] = "false";
				//$success_response['refstatus'] = 0;
				$success_response['message'] = 'Invalid refferal code';
				$this->response ($success_response,200);
				exit;
			}
		}else{
			$reg ['coupon_code'] = '';
		}
	
		$contact_details = array();
		if(!empty($reg ['name']) && !empty($reg ['mobile']) && !empty($reg ['email'])) {
			$exist = $this->userloginlib->userAppExist ( $reg );
			if ($exist['exist'] == 0) {
				$register = $this->userloginlib->userRegistration ( $reg );
				
				if ($register ['status'] == 1) {
					
					$data = array();
					$data ['name'] = $reg ['name'];
					$data ['otp'] = $reg['otp'];
					$data ['email'] = $reg ['email'];
					
					//$contact_details = array();
					$data1 = new stdClass();
					$data1->ContactId = $register['id'];
					$data1->FirstName = $reg['name'];
					$data1->Email = $reg['email'];
					$data1->MobileNumber = $reg['mobile'];
					//$data1->areaid = $reg['areaid'];
					//$data->Address = $register['address'];
				    array_push($contact_details,$data1);
					//$this->userlib->sendOTPSMS($data);
					//$this->userlib->sendOTPEmail($data);
					$success_response["status"] = "true";
					$success_response["message"] = "Thank you for your registration";
					$success_response["data"] = $contact_details;
					
					$refdata['my_ref_code'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($register['id'], 10, 36));
					$refdata['id'] = $register['id'];
					$this->userloginlib->updateUserRegistration($data);
				} else {
					$success_response["status"] = "false";
					$success_response["message"] = "Failed to register.";
					$success_response["data"] = $contact_details;
				}
			} else {
				$success_response["status"] = "false";
				//$success_response["message"] = "You are already registered with us.";
				$success_response["message"] = "The Email & mobile is already registered";
				$success_response["data"] = $contact_details;
			}
		} else {
			$success_response["status"] = "false";
			$success_response["message"] = "Name, email or phone is blank";
			$success_response["data"] = $contact_details;
		}
		
		//print_r($success_response);exit ; 
		$this->response ($success_response,200);
		//echo json_encode($success_response);
	}
	
	public function socialLogin_post() {
		$reg = array ();
		$reg ['name'] = trim($this->post ( 'fullname' ));
		$reg ['password'] = "";
		$reg ['email'] = $this->post ( 'email' );
		$reg ['oauth_provider'] = $this->post ( 'oauth_provider' );
		$reg ['oauth_uid'] = $this->post ( 'oauth_uid' );
		$reg ['gcm_reg_id'] = $this->post ( 'gcm_reg_id' );
		//$reg ['mobile'] = $this->post ( 'mobile' );
		//$reg ['address'] = $this->input->post ( 'address' );
		//$reg ['areaid'] = '';
		$reg ['original'] = "";
		$reg ['source'] = 'Friends';
		//$reg ['coupon_code'] = $this->post('referral_code');
		$reg ['otherss'] = '';
		$reg ['otp'] = mt_rand ( 100000, 999999 );
		$reg ['status'] = 1;
		$this->load->library('zyk/General');
		//$areas = $this->general->getAreasById($reg ['areaid']);
		//$reg ['area'] = $areas[0]['name'];
		$success_response = array();
		$contact_details = array();
		if(!empty($reg ['name']) && !empty($reg ['email'])) {
			$this->load->library ( 'zyk/UserLib' );
			$exist = $this->userlib->userExist ( $reg );
			if ($exist['status'] == 0) {
				$register = $this->userlib->userRegistration ( $reg );
				$user = $this->userlib->getUserByEmail ( $reg ['email'] );
				if ($register ['status'] == 1) {
					$data1 = new stdClass();
					$data1->ContactId = $register['id'];
					$data1->FirstName = $reg['name'];
					$data1->Email = $reg['email'];
					$data1->MobileNumber = $user[0]['mobile'];
					$data1->Address = $user[0]['address'];
					$data1->Landmark = $user[0]['landmark'];
					$data1->AddressType = $user[0]['address_type'];
					array_push($contact_details,$data1);
					//$this->userlib->sendOTPSMS($data);
					if(empty($user[0]['my_ref_code'])){
						$dataref['my_ref_code'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($user[0]['id'], 10, 36));
						$dataref['id'] = $user[0]['id'];
						$this->userloginlib->updateUserRegistration($dataref);
					}
					$success_response["status"] = "true";
					$success_response["message"] = "Thank you for your registration";
					$success_response["data"] = $contact_details;
				} else {
					$success_response["status"] = "false";
					$success_response["message"] = "Failed to register.";
					$success_response["data"] = $contact_details;
				}
			} else {
				$user = $this->userlib->getUserByEmail ( $reg ['email'] );
				$data1 = new stdClass();
				$data1->ContactId = $user[0]['id'];
				$data1->FirstName = $user[0]['name'];
				$data1->Email =  $user[0]['email'];
				$data1->MobileNumber = $user[0]['mobile'];
				$data1->Address = $user[0]['address'];
				$data1->Landmark = $user[0]['landmark'];
				$data1->AddressType = $user[0]['address_type'];
				array_push($contact_details,$data1);
				$success_response["status"] = "true";
				$success_response["message"] = "You are already registered with us";
				$success_response["data"] = $contact_details;
			}
		} else {
			$success_response["status"] = "false";
			$success_response["message"] = "Name, email or phone is blank";
			$success_response["data"] = $contact_details;
		}
		$this->response ($success_response,200);
	}
	
	public function signupfacebookold_post() {
		$reg = array ();
		$reg ['name'] = trim($this->post ( 'fullname' ));
		$reg ['password'] = "";
		$reg ['email'] = $this->post ( 'email' );
		$reg ['mobile'] = $this->post ( 'mobile' );
		//$reg ['address'] = $this->input->post ( 'address' );
		//$reg ['areaid'] = '';
		$reg ['original'] = "";
		$reg ['source'] = 'Friends';
		$reg ['coupon_code'] = $this->post('referral_code');
		$reg ['otherss'] = '';
		$reg ['otp'] = mt_rand ( 100000, 999999 );
		$reg ['status'] = 1;
		$this->load->library('zyk/General');
		//$areas = $this->general->getAreasById($reg ['areaid']);
		//$reg ['area'] = $areas[0]['name'];
		$success_response = array();
		if(!empty($reg ['name']) && !empty($reg ['mobile']) && !empty($reg ['email'])) {
			$this->load->library ( 'zyk/UserLib' );
			$exist = $this->userlib->userExist ( $reg );
			if ($exist['status'] == 0) {
				$register = $this->userlib->userRegistration ( $reg );
				$this->load->library('zyk/OldTml');
				$tmlpram = array();
				$tmlpram['fullname'] = $reg ['name'];
				$tmlpram['mobile'] = $reg ['mobile'];
				$tmlpram['email'] = $reg ['email'];
				$tmlpram['referral_code'] = $reg ['coupon_code'];
				$this->oldtml->fbSignupToVtiger($tmlpram);
				if ($register ['status'] == 1) {
					$address = array();
					$address['userid'] = $register['id'];
					$address['address_name'] = 'Home';
					//$address['address'] = $reg['address'];
					//$address['locality'] = $reg['area'];
					//$address['areaid'] = $reg['areaid'];
					$this->userlib->addAddress($address);
					$data = array();
					$data ['name'] = $reg ['name'];
					$data ['otp'] = $reg['otp'];
					$data ['mobile'] = $reg ['mobile'];
					$this->userlib->sendOTPSMS($data);
					$success_response["success"] = "true";
					$success_response["msg"] = "Thank you for your registration";
				} else {
					$success_response["success"] = "false";
					$success_response["msg"] = "Failed to register.";
				}
			} else {
				$success_response["success"] = "true";
				$success_response["msg"] = "You are already registered with us. Please verify using otp.";
			}
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Name, email or phone is blank";
		}
		echo json_encode($success_response);
	}
	
	public function verifyotp_post() {
		//$email = $this->post ( 'username' );
		//$otp = $this->post ( 'otp' );
		$reg = array ();
		$reg ['id'] = $this->post ( 'id' );
		$reg ['otp'] = $this->post ( 'otp' );
		
		$login = array ();
		//$login['gcm_reg_id'] = $this->post ( 'gcm_code' );
		$login ['status'] = 1;
		if(!empty($reg ['id']) && !empty($reg ['otp'])) {
			$this->load->library ( 'zyk/UserLoginLib' );
			$user = $this->userloginlib->otpMatch($reg);
			//if(count($user) > 0) {
				//if($otp == $user[0]['otp']) {
				if($user[0]['status'] == 1) {
					$login['id'] = $user[0]['id'];
					$this->userloginlib->updateUserProfile($login);
					//$this->userlib->sendSignUpEmail ( $user [0] );
					//$this->userlib->sendSignUpSMS ( $user [0] );
					$success_response["success"] = "true";
					$success_response["msg"] = "Thanks for registering with us";
				} else {
					$success_response["success"] = "false";
					$success_response["msg"] = "Incorrect Code.Please enter the correct OTP.";
				}
			/*} else {
				$success_response["success"] = "false";
				$success_response["error"] = "Please register before proceeding.";
			}*/
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Please enter the verification code sent to your mobile number OR email address to proceed.";
		}
		//$this->response ($success_response,200);
		echo json_encode($success_response);
	}
		
	public function loginwithotp_post() {
		$login = array ();
		$login ['mobile'] = $this->post ( 'mobile' );
		$login ['otp'] = $this->post ( 'otp' );
		
		//print_r($login);exit ; 
		$contact_details = array();
		if (empty($login ['mobile']))
		{
			$response["success"] = "false";
			$response["message"] = "Please enter mobile number";
		}
		else
		{
			$this->load->library ( 'zyk/UserLoginLib' );
			$user = $this->userloginlib->loginwithOTP ( $login );
			// print_r($user);exit ; 
			if($user[0]['status'] == 1) {
				$data = new stdClass();
				$data->ContactId = $user[0]['id'];
				$data->FirstName = $user[0]['name'];
				$data->Email = $user[0]['email'];
				$data->MobileNumber = $user[0]['mobile'];
				$data->Address = $user[0]['address'];
				$data->Landmark = $user[0]['landmark'];
				$data->AddressType = $user[0]['address_type'];
				//$data->areaid = $user[0]['areaid'];
				if(empty($user[0]['my_ref_code'])){
					$dataref['my_ref_code'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($user[0]['id'], 10, 36));
					$dataref['id'] = $user[0]['id'];
					$this->userloginlib->updateUserRegistration($dataref);
				}
				array_push($contact_details,$data);
				$response["status"] = "true";
				$response["message"] = "Login successful";
				$response["data"] = $contact_details;
			} else {
				$response["status"] = "false";
				$response["message"] = "Invalid Mobile or OTP";
				$response["data"] = $contact_details;
			}
		}
		$this->response ($response,200);
	}
	
	public function resendotp_post() {
		$data=array();
		$data['mobile']=$this->post('mobile');
		$this->load->library ( 'zyk/UserLib' );
		$result = $this->userlib->resendOTP ( $data );
		$data_res = array();
		if($result['status'] == 1) {
			$data_res['name'] = $result[0]['name'];
			$data_res['email'] = $result[0]['email'];
			$data_res['mobile'] = $result[0]['mobile'];
			$data_res['address'] = $result[0]['address'];
			$data_res['landmark'] = $result[0]['landmark'];
			$data_res['address_type'] = $result[0]['address_type'];
			$success_response["success"] = "true";
			$success_response["msg"] = "Verification code has been resent to your mobile number";
			$success_response["userid"] = $result['id'];
			$success_response["otp"] = $result['otp'];
			$success_response["data"] = $data_res;
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Please enter valid mobile number";
		}
		$this->response ($success_response,200);
		//echo json_encode($success_response);
	}
	
	public function facebooklogin_post() {
		$username = $this->post('username');
		$gcmcode = $this->post('gcm_code');
		if (empty($username))
		{
			$resp["success"] = "false";
			$resp["msg"] = "Authentication failed";
		}
		else
		{
			$this->load->library ( 'zyk/UserLib' );
			$user = $this->userlib->getUserByEmail ( $username );
			if(count($user) > 0) {
				if($user[0]['status'] == 1) {
					$gcm = array();
					$gcm['id'] = $user[0]['id'];
					$gcm['gcm_reg_id'] = $gcmcode;
					$this->userlib->updateUserProfile($gcm);
					$contact_details = array();
					$data = new stdClass();
					$data->ContactId = $user[0]['id'];
					$data->FirstName = $user[0]['name'];
					$data->Email = $user[0]['email'];
					$data->MobileNumber = $user[0]['mobile'];
					$data->Address = $user[0]['address'];
					$data->TMLContactId = $user[0]['id'];
					$data->area = $user[0]['area'];
					$data->landmark = $user[0]['landmark'];
					$data->latitude = $user[0]['latitude'];
					$data->longitude = $user[0]['longitude'];
					array_push($contact_details,$data);
					$resp["success"] = "true";
					$resp["login"] = "valid";
					$resp["data"] = $contact_details;
				} else {
					$resp["success"] = "false";
					$resp["msg"] = "OTP is not verified";
				}
			} else {
				$resp["success"] = "false";
				$resp["error"] = "Invalid username";
			}
		}
		$this->response ($resp,200);
	}
	
	public function myaccount_post() {
		$email = $this->post('username');
		if($email != "") {
			$this->load->library ( 'zyk/UserLib' );
			$user = $this->userlib->getUserByEmail ( $email );
			if(count($user) > 0) {
				$wallet = $this->userlib->getWalletBalance($user[0]['id']);
				$refferal_code = '';
				if(!empty($user[0]['my_ref_code'])) {
					$refferal_code = $user[0]['my_ref_code'];
				} else {
					$length=8;
					$code = '';
					$keys = array_merge(range(1, 9), range('A', 'Z'), range('a', 'z'));
						
					for ($i = 0; $i < $length; $i++)
					{
						$code .= $keys[array_rand($keys)];
					}
					$gcm = array();
					$gcm['id'] = $user[0]['id'];
					$gcm['my_ref_code'] = $code;
					$this->userlib->updateUserProfile($gcm);
					$refferal_code = $code;
				}
				$resp["success"] = "true";
				$resp["referralcode"] = $refferal_code;
				if(count($wallet)  > 0) {
					$resp["balance"] = $wallet[0]['amount'];
				} else {
					$resp["balance"] = 0;
				}
			} else {
				$resp["success"] = "false";
				$resp["msg"] = "contact not found";
			}
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "email is blank";
		}
		$this->response ($resp,200);
	}
	
	public function updatecontact_post() {
		$email = $this->post('email');
		if ( $email != "") {
			$this->load->library ( 'zyk/UserLib' );
			$user = $this->userlib->getUserByEmail ( $email );
			if (count($user) > 0) {
				$mobno = $this->post('mobno');
				$name = $this->post('name');
				$address = $this->post('address');
				$area = $this->post('area');
				$landmark = '';
				if(!empty($this->post('landmark')))
				$landmark = $this->post('landmark');
				$latitude = '';
				if(!empty($this->post('latitude')))
				$latitude = $this->post('latitude');
				$longitude = '';
				if(!empty($this->post('longitude')))
				$longitude = $this->post('longitude');
				if($mobno!="" && $name!="" && $address!="" && $area!="") {
					$usermap = array();
					$usermap['id'] = $user[0]['id'];
					$usermap['name'] = $name;
					$usermap['mobile'] = $mobno;
					$usermap['address'] = $address;
					$usermap['area'] = $area;
					if($area == 'Aundh') {
						$areaid = 1;
					} else if($area == 'Balewadi') {
						$areaid = 4;
					} else if($area == 'Baner') {
						$areaid = 2;
					} else if($area == 'Bavdhan') {
						$areaid = 5;
					} else if($area == 'Pashan') {
						$areaid = 3;
					} else if($area == 'Karve Nagar') {
						$areaid = 9;
					} else if($area == 'Kothrud') {
						$areaid = 6;
					} else if($area == 'Sus') {
						$areaid = 7;
					} else if($area == 'Warje') {
						$areaid = 8;
					} else {
						$areaid = 1;
					}
					$usermap['areaid'] = $areaid;
					$usermap['landmark'] = $landmark;
					$usermap['latitude'] = $latitude;
					$usermap['longitude'] = $longitude;
					$this->userlib->updateUserProfile($usermap);
					$latlong = array();
					$latlong['userid'] = $user[0]['id'];
					$latlong['latitude'] = $usermap['latitude'];
					$latlong['longitude'] = $usermap['longitude'];
					$latlong['locality'] = $usermap['area'];
					$latlong['landmark'] = $usermap['landmark'];
					$latlong['areaid'] = $areaid;
					$latlong['address'] = $usermap['address'];
					$this->userlib->updateAddressByUserId($latlong);
					$resp["success"] = "true";
					$resp["contactid"] = $user[0]['id'];
				} else {
					$resp["success"] = "false";
					$resp["msg"] = "No field should be left blank";
				}
			} else {
				$resp["success"] = "false";
				$resp["msg"] = "contact not found";
			}
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "email id is blank";
		}
		$this->response ($resp,200);
	}
	
	public function forgotpassword_post() {
		$username = $this->post('username');
		if (empty($username))
		{
			$resp["success"] = "false";
			$resp["error"] = "Username not found";
		}
		else
		{
			$username = stripslashes($username);
			//$username = mysql_real_escape_string($username);
			$this->load->library('zyk/UserLib');
			$profile = $this->userlib->getUserByEmail($username);
			if(count($profile) > 0) {
				$data = array();
				$data['email'] = $username;
				$data['mobile'] = $profile[0]['mobile'];
				$data['name'] = $profile[0]['name'];
				$data['password'] = $profile[0]['original'];
				//$this->load->library('zyk/UserLib');
				//$this->userlib->sendPasswordSMS($data);
				$this->userlib->forgetPasswordEmail($data);
				$user = array();
				$user['name'] = $profile[0]['name'];
				$user['phone'] = $profile[0]['mobile'];
				$user['email'] = $profile[0]['email'];
				$user['tmlid'] = $profile[0]['id'];
				$user['address'] = $profile[0]['address'];
				$user['contactid'] = $profile[0]['id'];
				$users[] = $user;
				$resp["status"] = "true";
				$resp["message"] = "Your password has been sent on your registered Email";
				$resp["data"] = $users;
			} else {
				$users = array();
				$resp["status"] = "false";
				$resp["message"] = "contact not found";
				$resp["data"] = $users;
			}
		}
		$this->response ($resp,200);
	}
	
	public function checkaddress_post() {
		$address = $this->post('pincode');
		//$email = $this->post('email');
		$this->load->library('zyk/General');
		$date = date('Y-m-d');
		$contact_details = array();
		if($address != "") {
			$pincode = $address;
			$areas = $this->general->getAreasByPincode($pincode);
			//print_r($areas);
		    /* $this->load->library ( 'zyk/UserLib' );
			$user = $this->userlib->login ( $login ); */
			if($areas[0]['status'] == 1) {
				/* $gcm = array();
				$gcm['id'] = $user[0]['id'];
				$gcm['gcm_reg_id'] = $this->post('gcm_code');
				$this->userlib->updateUserProfile($gcm); */
				//$contact_details = array();
				$data = new stdClass();
				$data->AreaId = $areas[0]['id'];
				$data->AreaName = $areas[0]['name'];
				$data->Pincode = $areas[0]['pincode'];
				/*$data->MobileNumber = $user[0]['mobile'];
				$data->Address = $user[0]['address'];
				$data->TMLContactId = $user[0]['id'];
				$data->area = $user[0]['area'];
				$data->landmark = $user[0]['landmark'];
				$data->latitude = $user[0]['latitude'];
				$data->longitude = $user[0]['longitude'];*/
				array_push($contact_details,$data);
				$response["status"] = "true";
				$response["message"] = "valid";
				$response["data"] = $contact_details;
			} else {
				$response["status"] = "false";
				$response["message"] = "Invalid Address";
				$response["data"] = $contact_details;
			}
			
		} else {
			$response["status"] = "false";
			$response["message"] = "Address is Empty";
			$response["data"] = $contact_details;
		}
		//$this->response ($resp,200);
		echo json_encode($response);
	}
	
	  public function addUseraddress_post() {
			
			$this->load->library ( 'zyk/UserLib' );
			$address = array();
			 
			$address['userid'] = $this->post('userid');
			//$address['areaid'] = $this->post('areaid');
			$address['address_name'] = $this->post('address_name');
			$address['address'] = $this->post('address');
			$address['locality'] = $this->post('locality');
			$address['latitude'] = $this->post('latitude');
			$address['longitude'] = $this->post('longitude');
			$address['landmark'] = $this->post('landmark');
			$address['pincode'] = $this->post('pincode');
			
			$result = $this->userlib->addAddress($address);
		    
			if($result !='0')
			{
				$response["status"] = "true";
				$response["message"] = "Address added Successfully";
			}
			else{
				$response["status"] = "false";
				$response["message"] = "Address Not Added Successfully";
			}
			
			echo json_encode($response);
		}
		
		public function getUseraddress_post() {
			$userid = $this->post('userid');
		    $this->load->library ( 'zyk/UserLib' );
		    
			if($userid != "") {
				    $items = $this->userlib->getAddressById($userid);
									
					$add = array();
					$address = array();
					$address1 = array();
					$address2 = array();
					foreach($items as $item) {
						if($item['address_name'] == 'Home'){
							$add['address_id'] = $item['id'];
							$add['address_name'] = $item['address_name'];
							$add['locality']  = $item['locality'];
							$add['latitude']  = $item['latitude'];
							$add['longitude']  = $item['longitude'];
							$add['address'] = $item['address'];
							$add['landmark']  = $item['landmark'];
							$add['pincode'] = $item['pincode'];
							$add['vendor_id'] = $item['vendor_id'];
							$add['vendor_id1'] = $item['vendor_id1'];
							array_push($address,$add);
						}else if($item['address_name'] == 'Work'){
							$add['address_id'] = $item['id'];
							$add['address_name'] = $item['address_name'];
							$add['locality']  = $item['locality'];
							$add['latitude']  = $item['latitude'];
							$add['longitude']  = $item['longitude'];
							$add['address'] = $item['address'];
							$add['landmark']  = $item['landmark'];
							$add['pincode'] = $item['pincode'];
							$add['vendor_id'] = $item['vendor_id'];
							$add['vendor_id1'] = $item['vendor_id1'];
							array_push($address1,$add);
						}else if($item['address_name'] == 'Other'){
							$add['address_id'] = $item['id'];
							$add['address_name'] = $item['address_name'];
							$add['locality']  = $item['locality'];
							$add['latitude']  = $item['latitude'];
							$add['longitude']  = $item['longitude'];
							$add['address'] = $item['address'];
							$add['landmark']  = $item['landmark'];
							$add['pincode'] = $item['pincode'];
							$add['vendor_id'] = $item['vendor_id'];
							$add['vendor_id1'] = $item['vendor_id1'];
							array_push($address2,$add);
						}
					}
					$response["status"] = "true";
					$response["message"] = "User address";
					$response["home"] = $address;
					$response["work"] = $address1;
					$response["other"] = $address2;
									
			} else {
				$response["status"] = "false";
				$response["message"] = "UserId is Empty";
				$response["data"] = $address;
			}
			//$this->response ($resp,200);
			echo json_encode($response);
		}
		
		public function contact_post() {
		
			$this->load->library('zyk/Adminauth');
			$con = $this->adminauth->getContact();
		
			$contacts = array();
			foreach($con as $contact) {
				//$service['id'] = $item['id'];
				//$service['ratecard_name'] = $item['ratecard_name'];
				$cont['address']  = $contact['address'];
				$cont['tel_no']  = $contact['tel_no'];
				$cont['email']  = $contact['email'];
				$cont['whatsup_no']  = $contact['mobile'];
				$contacts[] = $cont;
		
			}
			$data['status']="true";
			$data['message']="Contact details";
			$data['data']= $contacts;
			
			echo json_encode($data);
		}
		
		public function updatetoken_post(){
			
			$gcm = array();
			$gcm['id'] = $this->post('userid');
			$gcm['gcm_reg_id'] = $this->post('tokenid');
			$this->load->library ( 'zyk/UserLib' );
			$this->userlib->updateUserProfile($gcm);
			
			$contacts = array();
			$data['status']="true";
			$data['message']="Device Id is updated";
			$data['data']= $contacts;
				
			echo json_encode($data);
		}
		
		public function updatepassword_post(){
				
			$gcm = array();
			$gcm['id'] = $this->post('userid');
			$gcm['password'] = md5($this->post('password'));
			$gcm['original'] = $this->post('password');
			$this->load->library ( 'zyk/UserLib' );
			$this->userlib->updateUserProfile($gcm);
				
			$contacts = array();
			$data['status']="true";
			$data['message']="password is updated";
			$data['data']= $contacts;
		
			echo json_encode($data);
		}
		
		public function updateprofile_post(){
		
		/*	$user = array();
			$user['id'] = $this->post('userid');
			//$user['password'] = md5($this->post('fullname'));
			//$user['original'] = $this->post('password');
			$user ['name'] = trim($this->post ( 'fullname' ));
			$user ['mobile'] = $this->post ( 'mobile' );
			$this->load->library ( 'zyk/UserLib' );
			$user = $this->userlib->updateUserProfile($user);
		   
			$contacts = array();
			foreach($user as $contact) {
				//$service['id'] = $item['id'];
				//$service['ratecard_name'] = $item['ratecard_name'];
				$cont['userid']  = $contact['id'];
				$cont['name']  = $contact['name'];
				$cont['email']  = $contact['email'];
				$cont['mobile']  = $contact['mobile'];
				$cont['areaid']  = $contact['areaid'];
				$contacts[] = $cont;
			
			}*/
			
			$params = array();
			$params['id'] = $this->input->post('id');
			$params['name'] = $this->input->post('name');
			$params['email'] = $this->input->post('email');
			$params['mobile'] = $this->input->post('mobile');
			$params['original'] = $this->input->post('password');
			$params['password'] = md5($this->input->post('password'));
			$params['address'] = $this->input->post('address');
			$this->load->library ( 'zyk/UserLib' );
			$register = $this->userlib->updateUser1( $params );
			
			$data['status']="true";
			$data['message']="success";
		
			echo json_encode($data);
		}
		
		public function accountsetting_post(){
		
			$params = array();
			$params['id'] = $this->input->post('id');
			$params['name'] = $this->input->post('name');
			$params['email'] = $this->input->post('email');
			$params['original'] = $this->input->post('password');
			$params['password'] = md5($this->input->post('password'));
			$params['model'] = $this->input->post('model');
		    $params['vehicle_no'] = $this->input->post('vehicleno');
			$this->load->library ( 'zyk/UserLib' );
			$register = $this->userlib->updateUser1( $params );
			
			$params1 = array();
			$params1['id'] = $this->input->post('id');
			$params1['model'] = $this->input->post('model1');
			$params1['vehicle_no'] = $this->input->post('vehicleno1');
			$this->load->library ( 'zyk/UserLib' );
			$register1 = $this->userlib->updateUser2( $params1 );
				
			$data['status']="true";
			$data['message']="success";
		
			echo json_encode($data);
		}
		
		public function getUserProfile_post() {
			$userid = $this->post('userid');
			$this->load->library ( 'zyk/UserLib' );
			
			$user = $this->userlib->getUser($userid);
			$user1 = $this->userlib->getUser1($userid);
			
			$resp['success']='true';
			$resp['userdata'] = $user;
			$resp['uservehical'] = $user1;
			
			echo json_encode($resp);
		
		}
		
		
		public function deleteaddress_post(){
		
			//$gcm = array();
			$id = $this->post('addressid');
			if($id != "") {
				$this->load->library ( 'zyk/UserLib' );
				$result=$this->userlib->deleteaddress($id);
			
				$contacts = array();
				$data['status']="true";
				$data['message']="Address Deleted Successfully";
				$data['data']= $contacts;
			}else{
				
				$contacts = array();
				$data['status']="false";
				$data['message']="Address id is blank";
				$data['data']= $contacts;
				
			}
		
			echo json_encode($data);
		}
		
		public function updateUseraddress_post() {
				
			$this->load->library ( 'zyk/UserLib' );
			$address = array();
		
			$address['id'] = $this->post('addressid');
			//$address['userid'] = $this->post('userid');
			//$address['areaid'] = $this->post('areaid');
			$address['address_name'] = $this->post('address_name');
			$address['address'] = $this->post('address');
			$address['locality'] = $this->post('locality');
			$address['latitude'] = $this->post('latitude');
			$address['longitude'] = $this->post('longitude');
			$address['landmark'] = $this->post('landmark');
			$address['pincode'] = $this->post('pincode');
				
			$result = $this->userlib->updateAddress($address);
		
			if($result !='0')
			{
				$response["status"] = "true";
				$response["message"] = "Address Updated Successfully";
			}
			else{
				$response["status"] = "false";
				$response["message"] = "Address Not Updated Successfully";
			}
				
			echo json_encode($response);
		}
		
		/* public function getUserNotification_post() {
			$userid = $this->post('userid');
			$this->load->library ( 'zyk/UserLib' );
		
			if($userid != "") {
				$items = $this->userlib->getUserNotification($userid);
					
				$add = array();
				$address = array();
				foreach($items as $item) {
					$add['id'] = $item['id'];
					$add['message'] = $item['message'];
					$add['type']  = $item['type'];
					$add['created_date'] = $item['created_date'];
					//$add['landmark']  = $item['landmark'];
					//$add['pincode'] = $item['pincode'];
					//$add['locality']  = $item['locality'];
					$address[] = $add;
				}
				
				$response['status']="true";
				$response['message']="Alert Data";
				$response['data']= $address;
					
			} else {
				$response["status"] = "false";
				$response["message"] = "UserId is Empty";
				$response['data']= $address;
			}
			//$this->response ($resp,200);
			echo json_encode($response);
		} */
		
		
		public function testNotification_post(){
				
			$email = $this->post('email');
				
			$this->load->library ( 'zyk/UserLib' );
			$user = $this->userlib->getUserByEmail($email);
			$userid = $user[0]['id'];
				
				
			$this->load->library('zyk/OrderLib');
			$result = $this->orderlib->sendBookingNotification($userid);
				
			//$contacts = array();
			//$data['status']="false";
			//$data['message']="Address id is blank";
			//$data['data']= $result;
				
			echo json_encode($result);
				
		}
		
		public function getWalletBalance_post(){
			$userid = $this->post('userid');
			if($userid != "") {
						$this->load->library ( 'zyk/UserLib' );
						$balance = $this->userlib->getWalletBalance($userid);
						$wallet_history =  $this->userlib->getWalletTransactions($userid);
						if(!empty($balance)){
							$balance = $balance;
						}else{
							$balance[0]['amount'] = 0;
						}
						
						$response['status']="true";
						$response['message']="Wallet Data";
						$response['balance']= $balance;
						$response['wallet_history']= $wallet_history;
						
					} else {
						$response["status"] = "false";
						$response["message"] = "UserId is Empty";
						//$response['data']= 
					}
			echo json_encode($response);
		}
		
		public function getReferCode_post(){
			$userid = $this->post('userid');
			if($userid != "") {
				$this->load->library ( 'zyk/UserLib' );
				$refercode = $this->userlib->getReferCode($userid);
						
				$response['status']="true";
				$response['message']="Refer Code";
				$response['refercode']= $refercode;
				//$response['wallet_history']= $wallet_history;
		
			} else {
				$response["status"] = "false";
				$response["message"] = "UserId is Empty";
				//$response['data']=
			}
			echo json_encode($response);
		}
		
		public function getUserNotification_post(){
		
			$userid = $this->post('userid');
		
			$this->load->library ( 'zyk/OrderLib' );
			$result = $this->orderlib->getUserNotification($userid);
			
			$response['status']="true";
			$response['message']="Refer Code";
			$response['data']= $result;
				
			echo json_encode($response);
		
		}
	
}	