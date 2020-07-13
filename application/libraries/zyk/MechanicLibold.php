<?php
error_reporting(0);
class MechanicLib {
	
	public function __construct() {
		$this->CI = & get_instance ();
	}
	
	public function otpMatch($reg) {
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechanic_model' );
		$params = array ();
		$params ['mobile'] = $reg['mobile'];
		$params ['otp'] = $reg['otp'];
		$user = $this->CI->mechanic_model->otpMatch ( $params );
		
		return $user;
	}
	
	public function login($params) {
		$params ['password'] = $params ['password'];
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechanic_model' );
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
		
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechanic_model' );
		$data = $this->CI->mechanic_model->reasonlist ();
		
		return $data;
	}
	
	public function suggestServices($param,$userid) {		
		
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechanic_model' );
		$data = $this->CI->mechanic_model->suggestServices ($param,$userid);
		
		return $data;
	}
	
	public function scheduled_services($params) {		
		
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechanic_model' );
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
		
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechanic_model' );
		$data = $this->CI->mechanic_model->serviceOrSparepartsList( $params );
		
		return $data;
	}
	
	public function suggestedServiceList($params) {		
		
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechanic_model' );
		$data = $this->CI->mechanic_model->suggestedServiceList( $params );
		
		return $data;
	}
	
	public function getlastOrder($order_id) {
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechanic_model' );
		return $this->CI->mechanic_model->getlastOrder ( $order_id );
	}
	
	public function mainServicesList($params) {		
		
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechanic_model' );
		$data = $this->CI->mechanic_model->mainServicesList( $params );
		
		return $data;
	}
	
	public function getlastOrderComment($orderid) {
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechanic_model' );
		return $this->CI->mechanic_model->getlastOrderComment ( $orderid );
	}
	
	public function ongoingOrders($params) {		
		
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechanic_model' );
		$data = $this->CI->mechanic_model->ongoingOrders( $params );
		
		return $data;
	}
	
	public function updatePassword($data) {
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->updatePassword ( $data );
		return $result;
	}
	
	public function orderStatus($data) {
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->orderStatus ( $data );
		return $result;
	}
	
	public function getOrder($userid) {
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechnic_model' );
		return $this->CI->mechnic_model->getOrder ( $userid );
	}
	
	public function update_profile($data) {
		
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->update_profile ( $data );
		return $result;
	}
	
	public function paymentStatus($data) {
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->paymentStatus ( $data );
		return $result;
	}
	
	public function service_accept_or_reject_post($data) {
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechnic_model' );
		$result = $this->CI->mechnic_model->service_accept_or_reject_post ( $data );
		return $result;
	}
	
	public function sendOTP ($data)
	{
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'check_mobile' );
		$exist = $this->CI->check_mobile->mobileExist ( $data );
		//echo "".count($exist);
		if(count($exist)>0){
			//$data ['otp'] = mt_rand ( 100000, 999999 );
		    $reg ['otp'] = '123456';
		    
			$data['updated_datetime']=date('Y-m-d H:i:s');
			
				
				$user_id = $this->CI->check_mobile->updatemobileRegistration ( $data );
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
	
	public function getMechanicGcmIdbyId($mecid){
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechanic_model' );
		$result = $this->CI->mechanic_model->getMechanicGcmIdbyId ( $mecid );
		return $result;
	}
	
	public function getMechanicNotificationById($mecid){
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechanic_model' );
		$result = $this->CI->mechanic_model->getMechanicNotificationById ( $mecid );
		return $result;
	}
	
	public function sendOrderAssignedNotification($mecid) {
		$curr_date=date('d-M-Y H:i:s');
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechanic_model' );
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
				$this->CI->load->model ('orders/Order_model','order');
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
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechanic_model' );
		$garagegcm = $this->CI->mechanic_model->getMechanicByGarageid ($garageid);
			//print_r($garagegcm);
			foreach($garagegcm as $result){
				$gcm_ids[] = $result['gcm_token'];
			}
			
			$title = 'Booking accepted';
			$msg = 'You have accepted the booking successfully.';
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
					$this->CI->load->model ('orders/Order_model','order');
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
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechanic_model' );
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
				$this->CI->load->model ('orders/Order_model','order');
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
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechanic_model' );
		$garagegcm = $this->CI->mechanic_model->getMechanicByGarageid ($garageid);
		//print_r($garagegcm);
		foreach($garagegcm as $result){
			$gcm_ids[] = $result['gcm_token'];
		}
			
		$title = 'Confirm Estimate';
		$msg = 'Customer has confirmed the estimate for Booking ID: XYZ';
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
				$this->CI->load->model ('orders/Order_model','order');
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
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechanic_model' );
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
				$this->CI->load->model ('orders/Order_model','order');
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
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechanic_model' );
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
				$this->CI->load->model ('orders/Order_model','order');
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
		$this->CI->load->model ( 'mechanic_model/Mechanic_model', 'mechanic_model' );
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
				$this->CI->load->model ('orders/Order_model','order');
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
	
	
	
}