<?php
//error_reporting(0);
class MechanicLib {
	
	public function __construct() {
		$this->CI = & get_instance ();
	}
	
	public function otpMatch($reg) {
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$params = array ();
		$params ['mobile'] = $reg['mobile'];
		$params ['otp'] = $reg['otp'];
		$user = $this->CI->mechanic_model->otpMatch ( $params );
		
		return $user;
	}
	
	public function login($params) {
		$params ['password'] = $params ['password'];
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$data = $this->CI->mechanic_model->login ( $params );
		
	    if (count ( $data ) > 0) {
			if($data[0]['status']==1)
			{
			
				$data[0] ['status'] = 1;
				$data[0]['msg'] = 'Logged in successfully.';
			}
			else 
			{
				
				$data[0] ['status'] = 1;
				$data[0]['msg'] = 'Invalid Email Or Password';
			}
			
		} else {
			$data[0] ['status'] = 0;
			$data[0]['msg'] = 'Invalid Email Or Password.';
		}
		return $data;
	}
	
	public function reasonList() {		
		
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$data = $this->CI->mechanic_model->reasonlist ();
		
		return $data;
	}
	
	public function suggestServices($param,$userid) {		
		
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$data = $this->CI->mechanic_model->suggestServices ($param,$userid);
		
		return $data;
	}
	 public function sendSuggestServicesNotification( $services,$userid) { 

	 	//print_r($services);

		$curr_date=date('d-M-Y H:i:s');
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$gcm_id = $this->CI->userlogin->getUserGcmIdsbyId ( $userid );
	
		$gcmid = $gcm_id[0]['gcm_reg_id'];
	
		$title = 'Mechanic Suggested Service';
		/*$msg = 'Bike is ready. Servicing is complete & your bike is ready for delivery '.$curr_date.' ';*/
		$msg = 'Mechanic Suggested Services: '. $services .'';
		//$msg = 'Mechanic Suggested Service for your vehicle.';
		 
		$message = array
		(
				'body' => $msg, 
				'title' => $title,
				'subtitle' => 'Notification',
				'tickerText' => '',
				'vibrate' => 1,
				'sound' => 1
		);
		if(!empty($gcmid)) {
			$notification = array();
			$notification['message'] = $msg;
			$notification['user_id'] =  $userid;
			//$notification['assigned_to'] = $params['assigned_to'];
			$notification['type'] = $title;
			$notification['source'] = 'Mechanic App';
			$notification['status'] = 1;
			$notification['created_date'] = date('Y-m-d H:i:s');
			$notification['updated_date'] = date('Y-m-d H:i:s');
			//$notification['created_by'] = $userid;
			$this->CI->load->model ('orders/Order_model','order');

			$resp= $this->CI->order->addNotification ($notification); 

			sendFCMPushNotificationSingle($gcmid, $message, $title);
			//$response['nstatus'] = 1;
			//$response['nmsg'] = 'Notification sent successfully.';
		} else {
			//$response['nstatus'] = 0;
			//$response['nmsg'] = 'Failed to send Notification';
		}
		//echo json_encode($response);
	}


	public function scheduled_services($params) {		
		
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$data = $this->CI->mechanic_model->scheduled_services ( $params );
		 
	    if (count ( $data ) > 0) {
			
			$data[0] ['status'] = 1;
			$data[0]['msg'] = 'Schedule service list.';
			
		} else {
			$data[0] ['status'] = 0;
			$data[0]['msg'] = 'Schedule service list.';
		}
		return $data;
	}
	
	public function serviceOrSparepartsList($params) {		
		
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$data = $this->CI->mechanic_model->serviceOrSparepartsList( $params );
		
		return $data;
	}
	
	public function suggestedServiceList($params) {		
		
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$data = $this->CI->mechanic_model->suggestedServiceList( $params );
		
		return $data;
	}
	
	public function getlastOrder($order_id) {
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		return $this->CI->mechanic_model->getlastOrder ( $order_id );
	}
	
	public function mainServicesList($params) {		
		
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$data = $this->CI->mechanic_model->mainServicesList( $params );
		
		return $data;
	}
	
	public function getlastOrderComment($orderid) {
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		return $this->CI->mechanic_model->getlastOrderComment ( $orderid );
	}
	
	public function ongoingOrders($params) {		
		
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$data = $this->CI->mechanic_model->ongoingOrders( $params );
		
		return $data;
	}
	
	public function updatePassword($data) {
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->updatePassword ( $data );
		return $result;
	}
	
	public function orderStatus($data) {
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->orderStatus ( $data );
		return $result;
	}
	
	public function getOrder($userid) {
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		return $this->CI->mechnic_model->getOrder ( $userid );
	}
	
	public function update_profile($data) {
		
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->update_profile ( $data );
		return $result;
	}
	
	public function paymentStatus($data) {
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->paymentStatus ( $data );
		return $result;
	}
	
	public function service_accept_or_reject_post($data) {
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->service_accept_or_reject_post ( $data );
		return $result;
	}
	
	public function sendOTP ($data)
	{
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'check_mobile' );
		$exist = $this->CI->check_mobile->mobileExist ( $data );
        
        
		//echo "".count($exist); 
		if(count($exist)>0){
        	$data['name'] = $exist[0]['name']; 
			$data ['otp'] = mt_rand ( 100000, 999999 );
			//$data['updated_datetime']=date('Y-m-d H:i:s');
                        $user = $exist['user'];
			
				
				$user_id = $this->CI->check_mobile->updatemobileRegistration ( $data, $user );
				//echo "".$user_id;
				
				if ($user_id > 0) {
					$this->sendOTPSMS ( $data );
					return 1;
				} else {
					return 0; 
				}
				
		}
		return 0;
		
	}

	public function sendOTPSMS($details) {
		//echo "inside sms";
		//$sms_msg = 'Your OTP is ' . $details ['otp'] . '.';
		$name = explode(" ",$details['name']);
		$fname = $name[0];
		$sms_msg = 'Hi '.$fname.', Use verification code ' . $details ['otp'] . ' to complete the registration process on ServiceOn.\n 7B00P2Wdl3N';
		$this->CI->load->library ( 'Pksms' );
		$map = array ();
		$map ['mobile'] = $details ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function getMechanicGcmIdbyId($mecid){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$result = $this->CI->mechanic_model->getMechanicGcmIdbyId ( $mecid );
		return $result;
	}
	
	public function getMechanicNotificationById($mecid){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$result = $this->CI->mechanic_model->getMechanicNotificationById ( $mecid );
		return $result;
	}
	
	public function sendOrderAssignedNotification($mecid) {
		$curr_date=date('d-M-Y H:i:s');
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$gcm_id = $this->CI->mechanic_model->getMechanicGcmIdbyId ($mecid);
		if(!empty($gcm_id)){
			$gcmid = $gcm_id[0]['gcm_token'];
	
			$title = 'Booking Available';
			$msg = 'New Booking Available';
			$message = array
			(
					'body' => $msg,
					'title' => $title,
					'subtitle' => 'Notification',
					'tickerText' => '',
					'vibrate' => 1,
					'sound' => 1
			);
			if(!empty($gcmid)) {
				$notification = array();
				$notification['message'] = $msg;
				$notification['mec_id'] =  $mecid;
				//$notification['assigned_to'] = $params['assigned_to'];
				$notification['type'] = $title;
				$notification['source'] = 'mechanicapp';
				$notification['status'] = 1;
				$notification['created_date'] = date('Y-m-d H:i:s');
				$notification['updated_date'] = date('Y-m-d H:i:s');
				//$notification['created_by'] =
				$this->CI->load->model ('api/orders/Order_model','order');
				$resp= $this->CI->order->addNotification ($notification);
	
				sendFCMPushNotificationMechanic($gcmid, $message, $title);
				$response['nstatus'] = 1;
				$response['nmsg'] = 'Notification sent successfully.';
			} /* else {
				$response['nstatus'] = 0;
				$response['nmsg'] = 'Gcm Id is Blank';
			} */
		}else{
			$response['nstatus'] = 0;
			$response['nmsg'] = 'Gcm Id is Blank';
		}
		return $response;
	}
	
	public function sendGarageAssignedNotification($garageid) {
		$curr_date=date('d-M-Y H:i:s');
		//echo $garageid;
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		//$garagegcm = $this->CI->mechanic_model->getMechanicByGarageid ($garageid);
			$garagegcm = $this->CI->mechanic_model->getVendorByGarageid ($garageid);
			//print_r($garagegcm);
			foreach($garagegcm as $result){
				$gcm_ids[] = $result['gcm_token'];
			}
			$title = 'New Order Assign';
			$msg = 'New Order Assign on date '.$curr_date.' ';
			$message = array
			(
					'body' => $msg,
					'title' => $title,
					'subtitle' => 'Notification',
					'tickerText' => '',
					'vibrate' => 1,
					'sound' => 1
			);
			if(!empty($gcm_ids)) {
				
				sendMultipleFCMPushNotificationMechanic($gcm_ids, $message,$title);
				 foreach($garagegcm as $data){
				 	
					$notification = array();
					$notification['message'] = $msg;
					$notification['mec_id'] =  $data['id'];
					//$notification['assigned_to'] = $params['assigned_to'];
					$notification['type'] = $title;
					$notification['source'] = 'mechanicapp';
					$notification['status'] = 1;
					$notification['created_date'] = date('Y-m-d H:i:s');
					$notification['updated_date'] = date('Y-m-d H:i:s');
					//$notification['created_by'] =
					$this->CI->load->model ('api/orders/Order_model','order');
					$resp= $this->CI->order->addNotification ($notification);
				 }
				$response['nstatus'] = 1;
				$response['nmsg'] = 'Notification sent successfully.';
			} else {
			    $response['nstatus'] = 0;
			    $response['nmsg'] = 'Gcm Id is Blank';
			} 
			
		return $response;
	}
	
	public function sendEstimateGenratedNotification($garageid) {
		$curr_date=date('d-M-Y H:i:s');
		//echo $garageid;
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$garagegcm = $this->CI->mechanic_model->getMechanicByGarageid ($garageid);
		//print_r($garagegcm);
		foreach($garagegcm as $result){
			$gcm_ids[] = $result['gcm_token'];
		}
			
		$title = 'Genrate Estimate';
		$msg = 'Generated estimated has been sent to the user successfully.';
		$message = array
		(
				'body' => $msg,
				'title' => $title,
				'subtitle' => 'Notification',
				'tickerText' => '',
				'vibrate' => 1,
				'sound' => 1
		);
		if(!empty($gcm_ids)) {
	
			sendMultipleFCMPushNotificationMechanic($gcm_ids, $message,$title);
			foreach($garagegcm as $data){
	
				$notification = array();
				$notification['message'] = $msg;
				$notification['mec_id'] =  $data['id'];
				//$notification['assigned_to'] = $params['assigned_to'];
				$notification['type'] = $title;
				$notification['source'] = 'mechanicapp';
				$notification['status'] = 1;
				$notification['created_date'] = date('Y-m-d H:i:s');
				$notification['updated_date'] = date('Y-m-d H:i:s');
				//$notification['created_by'] =
				$this->CI->load->model ('api/orders/Order_model','order');
				$resp= $this->CI->order->addNotification ($notification);
			}
			$response['nstatus'] = 1;
			$response['nmsg'] = 'Notification sent successfully.';
		} else {
			$response['nstatus'] = 0;
			$response['nmsg'] = 'Gcm Id is Blank';
		}
			
		return $response;
	}
	
	public function sendEstimateConfirmedNotification($garageid) {
		$curr_date=date('d-M-Y H:i:s');
		//echo $garageid;
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$garagegcm = $this->CI->mechanic_model->getMechanicByGarageid ($garageid);
		//print_r($garagegcm);
		foreach($garagegcm as $result){
			$gcm_ids[] = $result['gcm_token'];
		}
			 
		$title = 'Confirm Estimate';
		$msg = 'Customer has confirmed the estimate';
		$message = array
		(
				'body' => $msg,
				'title' => $title,
				'subtitle' => 'Notification',
				'tickerText' => '',
				'vibrate' => 1,
				'sound' => 1
		);
		if(!empty($gcm_ids)) {
	
			sendMultipleFCMPushNotificationMechanic($gcm_ids, $message,$title);
			foreach($garagegcm as $data){
	
				$notification = array();
				$notification['message'] = $msg;
				$notification['mec_id'] =  $data['id'];
				//$notification['assigned_to'] = $params['assigned_to'];
				$notification['type'] = $title;
				$notification['source'] = 'mechanicapp';
				$notification['status'] = 1;
				$notification['created_date'] = date('Y-m-d H:i:s');
				$notification['updated_date'] = date('Y-m-d H:i:s');
				//$notification['created_by'] =
				$this->CI->load->model ('api/orders/Order_model','order');
				$resp= $this->CI->order->addNotification ($notification);
			}
			$response['nstatus'] = 1;
			$response['nmsg'] = 'Notification sent successfully.';
		} else {
			$response['nstatus'] = 0;
			$response['nmsg'] = 'Gcm Id is Blank';
		}
			
		return $response;
	}
	
	public function sendInvoiceGenratedNotification($garageid) {
		$curr_date=date('d-M-Y H:i:s');
		//echo $garageid;
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$garagegcm = $this->CI->mechanic_model->getMechanicByGarageid ($garageid);
		//print_r($garagegcm);
		foreach($garagegcm as $result){
			$gcm_ids[] = $result['gcm_token'];
		}
			
		$title = 'Invoice Genrated';
		$msg = 'Invoice Genrated Notifiaction';
		$message = array
		(
				'body' => $msg,
				'title' => $title,
				'subtitle' => 'Notification',
				'tickerText' => '',
				'vibrate' => 1,
				'sound' => 1
		);
		if(!empty($gcm_ids)) {
	
			sendMultipleFCMPushNotificationMechanic($gcm_ids, $message,$title);
			foreach($garagegcm as $data){
	
				$notification = array();
				$notification['message'] = $msg;
				$notification['mec_id'] =  $data['id'];
				//$notification['assigned_to'] = $params['assigned_to'];
				$notification['type'] = $title;
				$notification['source'] = 'mechanicapp';
				$notification['status'] = 1;
				$notification['created_date'] = date('Y-m-d H:i:s');
				$notification['updated_date'] = date('Y-m-d H:i:s');
				//$notification['created_by'] =
				$this->CI->load->model ('api/orders/Order_model','order');
				$resp= $this->CI->order->addNotification ($notification);
			}
			$response['nstatus'] = 1;
			$response['nmsg'] = 'Notification sent successfully.';
		} else {
			$response['nstatus'] = 0;
			$response['nmsg'] = 'Gcm Id is Blank';
		}
			
		return $response;
	}
	
	public function sendWorkCompletedNotification($garageid) {
		$curr_date=date('d-M-Y H:i:s');
		//echo $garageid;
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$garagegcm = $this->CI->mechanic_model->getMechanicByGarageid ($garageid);
		//print_r($garagegcm);
		foreach($garagegcm as $result){
			$gcm_ids[] = $result['gcm_token'];
		}
			
		$title = 'Work Completed';
		$msg = 'Work Completed';
		$message = array
		(
				'body' => $msg,
				'title' => $title,
				'subtitle' => 'Notification',
				'tickerText' => '',
				'vibrate' => 1,
				'sound' => 1
		);
		if(!empty($gcm_ids)) {
	
			sendMultipleFCMPushNotificationMechanic($gcm_ids, $message,$title);
			foreach($garagegcm as $data){
	
				$notification = array();
				$notification['message'] = $msg;
				$notification['mec_id'] =  $data['id'];
				//$notification['assigned_to'] = $params['assigned_to'];
				$notification['type'] = $title;
				$notification['source'] = 'mechanicapp';
				$notification['status'] = 1;
				$notification['created_date'] = date('Y-m-d H:i:s');
				$notification['updated_date'] = date('Y-m-d H:i:s');
				//$notification['created_by'] =
				$this->CI->load->model ('api/orders/Order_model','order');
				$resp= $this->CI->order->addNotification ($notification);
			}
			$response['nstatus'] = 1;
			$response['nmsg'] = 'Notification sent successfully.';
		} else {
			$response['nstatus'] = 0;
			$response['nmsg'] = 'Gcm Id is Blank';
		}
			
		return $response;
	}
	
	public function sendDeliveryCompletedNotification($garageid) {
		$curr_date=date('d-M-Y H:i:s');
		//echo $garageid;
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$garagegcm = $this->CI->mechanic_model->getMechanicByGarageid ($garageid);
		//print_r($garagegcm);
		foreach($garagegcm as $result){
			$gcm_ids[] = $result['gcm_token'];
		}
			
		$title = 'Delivery Completed';
		$msg = 'Delivery Completed Notifiaction';
		$message = array
		(
				'body' => $msg,
				'title' => $title,
				'subtitle' => 'Notification',
				'tickerText' => '',
				'vibrate' => 1,
				'sound' => 1
		);
		if(!empty($gcm_ids)) {
	
			sendMultipleFCMPushNotificationMechanic($gcm_ids, $message,$title);
			foreach($garagegcm as $data){
	
				$notification = array();
				$notification['message'] = $msg;
				$notification['mec_id'] =  $data['id'];
				//$notification['assigned_to'] = $params['assigned_to'];
				$notification['type'] = $title;
				$notification['source'] = 'mechanicapp';
				$notification['status'] = 1;
				$notification['created_date'] = date('Y-m-d H:i:s');
				$notification['updated_date'] = date('Y-m-d H:i:s');
				//$notification['created_by'] =
				$this->CI->load->model ('api/orders/Order_model','order');
				$resp= $this->CI->order->addNotification ($notification);
			}
			$response['nstatus'] = 1;
			$response['nmsg'] = 'Notification sent successfully.';
		} else {
			$response['nstatus'] = 0;
			$response['nmsg'] = 'Gcm Id is Blank';
		}
			
		return $response;
	}
	
	public function getMechnicList($param) {		
		
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$data = $this->CI->mechanic_model->getMechnicList($param);
		
		return $data;
	}
	
	public function assignMechnic($param) {		
		
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$data = $this->CI->mechanic_model->assignMechnic ($param);
		
		return $data;
	}
	
	public function addMechanic($param) {		
		
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$data = $this->CI->mechanic_model->addMechanic ($param);
		
		return $data;
	}
	
	public function getRoleList() {		
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$data = $this->CI->mechanic_model->getRoleList ();
		return $data;
	}

	public function get_payment_details($orderid) {
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->get_payment_details ( $orderid );
		return $result;
	}

	public function invoice($filter_array){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->invoice ( $filter_array );
		return $result;
	}

	public function getMechanic($mec_id){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$data = $this->CI->mechanic_model->getMechanic ($mec_id);
		return $data;
	}

	public function sendAssignNotification($data) {
		
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$mec = $this->CI->mechanic_model->getMechanic ($data['mec_id']);
		if(!empty($mec))
		{
			$curr_date=date('d-M-Y H:i:s');
			$gcmid = $mec[0]['gcm_token'];
			$title = 'New Order Assign';
			$msg = 'New Order Assign on date '.$curr_date.' ';
			$message = array
			(
					'body' => $msg,
					'title' => $title,
					'subtitle' => 'Notification',
					'tickerText' => '',
					'vibrate' => 1,
					'sound' => 1
			);
			$notification = array();
			$notification['message'] = $msg;
			$notification['user_id'] = $data['mec_id'];
			$notification['orderid'] = $data['order_id'];
			$notification['role_id'] = $data['role_id'];
			$notification['type'] = $title;
			$notification['source'] = 'Mechanic App';
			$notification['status'] = 1;
			$notification['created_date'] = date('Y-m-d H:i:s');
			$notification['updated_date'] = date('Y-m-d H:i:s');
			$this->CI->load->model ('api/orders/Order_model','order');
			$resp= $this->CI->order->addNotification ($notification);
			sendFCMPushNotificationMechanic($gcmid, $message, $title);
		}
	}

	public function sendGarageAssignedEmail($garageid,$data){

		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechanic_model' );
		$mec = $this->CI->mechanic_model->getVendorByGarageid ($garageid);
		if(!empty($mec)){
			$data['name'] = $mec[0]['name'];
			$this->CI->load->library ( 'pkemail' );
			$this->CI->pkemail->load_system_config ();
			$this->CI->pkemail->headline = 'New Order Assign |ServiceOn';
			$this->CI->pkemail->subject = 'New Order assign to you.';
			$this->CI->pkemail->mctag = 'New Order';
			$this->CI->pkemail->attachment = 0;
			$this->CI->pkemail->to = $mec [0]['email'];
			$this->CI->template->set ( 'data', $data );
			$this->CI->template->set ( 'page', 'booking' );
			$this->CI->template->set_layout ( false );
			$text_body = $this->CI->template->build ( 'frontend/emails/assign', '', true );
			$this->CI->pkemail->send_email ( $text_body );
		}
	}

	public function addUserVehicle($data) {
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->addUserVehicle ( $data );
		return $result;
	}

	public function getVehicleListByID($params){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->getVehicleListByID ( $params );
		return $result;
	}  

	public function getVehicleListByVehicleID($params){

		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->getVehicleListByVehicleID ( $params );
		return $result;
	} 

	public function deleteUserVehicle($params){  
 
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->deleteUserVehicle ( $params );
		return $result;
	}

	public function getPackageListByModel($params){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->getPackageListByModel ( $params );
		if(!empty($result))
		{
			foreach ($result as $key => $value) {
				$result[$key]['services'] = $this->CI->mechnic_model->getServiceByPackageID ( $value['id'] );
			}
		}
		return $result;
	}

	public function getModelByParams($params){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->getModelByParams ( $params );
		return $result;
	}

	public function getServiceGroup($params){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->getServiceGroup ( $params );
		return $result;

	}
	public function getSubcatId_new($params){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->getSubcatId_new ( $params );
		return $result;
	} 
	public function getServiceGroup1($subcat_id){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->getServiceGroup1 ( $subcat_id );
		return $result;

	}


	public function getServicesDataByID($id){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->getServicesDataByID ( $id );
		return $result;

	}
	
	public function getDisplayData($group,$params){
		$included = array();
		$description = '';
		$price = 0;
		$spare_description = '';
		$spare_price = 0;

		$servies = $this->CI->mechnic_model->getServiceListByGroupID ( $group['id'] );
		foreach ($servies as $key => $value) {
			$description .= ucfirst($value['name']).',';
			$price = $price + $value['price'];
		}
		$spare = $this->CI->mechnic_model->getSpareList ( $params );
		foreach ($spare as $key => $value) {
			$spare_description .= ucfirst($value['name']).',';
			$spare_price = $price + $value['price'];
		}
		$included['service_description'] = rtrim($description,',');
		$included['service_price'] = $price;
		$included['spare_description'] = rtrim($spare_description,',');
		$included['spare_price'] = $spare_price;
		return $included;
	} 

	public function add_user_vehicle_license($data) {
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->add_user_vehicle_license( $data );
		return $result;
	}

	public function add_vehicle_documents($data) {
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->add_vehicle_documents( $data );
		return $result;
	}

	public function update_vehicle_documents($data) {
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->update_vehicle_documents( $data );
		return $result;
	}
 	public function getVehicleLicenseByID($params){

		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->getVehicleLicenseByID ( $params );
		return $result;
	}
	public function getVehicleDocumentByID($params){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->getVehicleDocumentByID ( $params );
		return $result;
	}

	public function getVehicleDocuments($params){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->getVehicleDocuments ( $params );
		return $result;
	}


	public function getActiveVehicleListByID($params){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->getVehicleListByID ( $params );
		return $result;
	}

	public function updateUserVehicle($params){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->updateUserVehicle ( $params );
		return $result;
	}

	public function update_vehicle_license($params){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->update_vehicle_license ( $params );
		return $result;
	} 

	public function uploadLicenseDocument($params){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->uploadLicenseDocument ( $params );
		return $result;
	}  

	public function delete_vehicle_license($params){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->delete_vehicle_license ( $params );
		return $result;
	} 

	public function delete_vehicle_documents($params){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->delete_vehicle_documents ( $params );
		return $result;
	} 

	public function add_other_vehicle_documents($params){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->add_other_vehicle_documents ( $params );
		return $result;
	}
 

	public function uploadVehicleALLDocument($params){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->uploadVehicleALLDocument ( $params );
		return $result;
	}

	public function updateVehicleALLDocument($data) {
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->updateVehicleALLDocument( $data );
		return $result;
	}

	public function getVehicleOtherDocuments($params){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->getVehicleOtherDocuments ( $params );
		return $result;
	}

	public function update_other_vehicle_documents($params){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->update_other_vehicle_documents ( $params );
		return $result;
	}
	public function getallPackageByids($params){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->getallPackageByids ( $params );
		if(!empty($result))
		{
			foreach ($result as $key => $value) {
				$result[$key]['services'] = $this->CI->mechnic_model->getServiceByPackageID ( $value['id'] );
			}
		}
		return $result;
	} 
	public function getPackageList(){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->getPackageList ();
		if(!empty($result))
		{
			foreach ($result as $key => $value) {
				$result[$key]['services'] = $this->CI->mechnic_model->getServiceByPackageID ( $value['id'] );
			}
		}
		return $result;
	}

	public function getallpackageservices(){
		$this->CI->load->model ( 'api/mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->getallpackageservices ();
		return $result;
	}




}

/*
<pre>Array
(
    [0] => Array
        (
            [id] => 1
            [user_id] => 32
            [vehicle_no] => MH-14-2018
            [vehicle_alias_no] => mh142018
            [brand_id] => 39
            [model_id] => 344
            [status] => 1
        )

)
*/