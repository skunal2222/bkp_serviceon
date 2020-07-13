<?php
class NotificationLib {
	
	public function __construct(){
		$this->CI =& get_instance();
	}

	/*************** code by kunal ******************/

	// CustomerApp Notification
	public function sendBookingNotification($userid) {
		$curr_date=date('d-M-Y H:i:s');
		// $this->CI->load->model ( 'users/User_model', 'userlogin' );
		// $gcm_id = $this->CI->userlogin->getUserGcmIdsbyId ($userid);
		$this->CI->db->select ( 'gcm_reg_id' );
		$this->CI->db->from ( TABLES::$USER );
		$this->CI->db->where ( 'status', 1 );
		$this->CI->db->where ( 'id', $userid );
		$this->CI->db->where ( 'gcm_reg_id IS NOT NULL AND gcm_reg_id != ""', '',false );
		$query = $this->CI->db->get ();
		$gcm_id = $query->result_array ();

		if(!empty($gcm_id)){
			$gcmid = $gcm_id[0]['gcm_reg_id'];
		
			$title = 'Order booked';
			$msg = 'Order booked. Thank you for choosing '.COMPANY.'. You will be notified once a pickup person is assigned for your bike pickup '.$curr_date.' ';
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
				$notification['source'] = 'customerapp';
				$notification['status'] = 1;
				$notification['created_date'] = date('Y-m-d H:i:s');
				$notification['updated_date'] = date('Y-m-d H:i:s');
				//$notification['created_by'] =
				$this->CI->load->model ('orders/Order_model','order');
				$resp= $this->CI->order->addNotification ($notification);
				
				sendFCMPushNotificationSingle($gcmid, $message, $title);
				//$response['nstatus'] = 1;
				//$response['nmsg'] = 'Notification sent successfully.';
			} else {
				//$response['nstatus'] = 0;
				//$response['nmsg'] = 'Failed to send Notification';
			}
		}
		//echo json_encode($response);
	}

	public function sendAssignedRiderNotification($userid,$orderid) {
		$curr_date=date('d-M-Y H:i:s');
		// $this->CI->load->model ( 'api/users/User_model', 'userlogin' );
		// $gcm_id = $this->CI->userlogin->getUserGcmIdsbyId ( $userid );

		$this->CI->db->select ( 'gcm_reg_id' );
		$this->CI->db->from ( TABLES::$USER );
		$this->CI->db->where ( 'status', 1 );
		$this->CI->db->where ( 'id', $userid );
		$this->CI->db->where ( 'gcm_reg_id IS NOT NULL AND gcm_reg_id != ""', '',false );
		$query = $this->CI->db->get ();
		$gcm_id = $query->result_array ();

		$gcmid = $gcm_id[0]['gcm_reg_id'];

		$title = 'Pickup Person assigned';
		$msg = 'Pickup person assigned to your order. He will come for pick up your bike as per your pickup slot '.$curr_date.' ';
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
			$notification['orderid'] = $orderid;
			//$notification['assigned_to'] = $params['assigned_to'];
			$notification['type'] = $title;
			$notification['source'] = 'customerapp';
			$notification['status'] = 1;
			$notification['created_date'] = date('Y-m-d H:i:s');
			$notification['updated_date'] = date('Y-m-d H:i:s');
			//$notification['created_by'] =
			$this->CI->load->model ('api/orders/Order_model','order');
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

	public function sendOrderUpdateToUser($noti)
	{
		$curr_date=date('d-M-Y H:i:s');
		// $this->CI->load->model ( 'users/User_model', 'userlogin' );
		$user = $this->CI->db->select('userid')->where('orderid',$noti['orderid'])->get('tbl_booking')->row_array();
		// $gcm_id = $this->CI->userlogin->getUserGcmIdsbyId ($user['userid']);
// print_r($user); die();
		$this->CI->db->select ( 'gcm_reg_id' );
		$this->CI->db->from ( TABLES::$USER );
		$this->CI->db->where ( 'status', 1 );
		$this->CI->db->where ( 'id', $user['userid'] );
		$this->CI->db->where ( 'gcm_reg_id IS NOT NULL AND gcm_reg_id != ""', '',false );
		$query = $this->CI->db->get ();
		$gcm_id = $query->result_array ();
		// print_r($gcm_id); die();
		if(!empty($gcm_id)){
			$gcmid = $gcm_id[0]['gcm_reg_id'];

			$title = 'Order update';
			$msg = $noti['msg'].' '.$curr_date.' ';
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
				$notification['user_id'] =  $user['userid'];
				$notification['orderid'] =  $noti['orderid'];
				//$notification['assigned_to'] = $params['assigned_to'];
				$notification['type'] = $title;
				$notification['source'] = 'customerapp';
				$notification['status'] = 1;
				$notification['created_date'] = date('Y-m-d H:i:s');
				$notification['updated_date'] = date('Y-m-d H:i:s');
				//$notification['created_by'] =
				$this->CI->load->model ('orders/Order_model','order');
				$resp= $this->CI->order->addNotification ($notification);
				
				sendFCMPushNotificationSingle($gcmid, $message, $title);
				//$response['nstatus'] = 1;
				//$response['nmsg'] = 'Notification sent successfully.';
			} else {
				//$response['nstatus'] = 0;
				//$response['nmsg'] = 'Failed to send Notification';
			}
		}
	}

	public function sendEstimategeneratedNotification($userid) {
		$curr_date=date('d-M-Y H:i:s');
		// $this->CI->load->model ( 'users/User_model', 'userlogin' );
		// $gcm_id = $this->CI->userlogin->getUserGcmIdsbyId ( $userid );

		$this->CI->db->select ( 'gcm_reg_id' );
		$this->CI->db->from ( TABLES::$USER );
		$this->CI->db->where ( 'status', 1 );
		$this->CI->db->where ( 'id', $userid );
		$this->CI->db->where ( 'gcm_reg_id IS NOT NULL AND gcm_reg_id != ""', '',false );
		$query = $this->CI->db->get ();
		$gcm_id = $query->result_array ();
	
		$gcmid = $gcm_id[0]['gcm_reg_id'];
	
		$title = 'Estimate generated';
		/*$msg = 'Estimate is ready. Detailed inspection report is generated. Please review and let us know the final jobs to be performed '.$curr_date.' ';*/
		$msg = 'Estimate for your service has been generated.';

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
			$notification['source'] = 'customerapp';
			$notification['status'] = 1;
			$notification['created_date'] = date('Y-m-d H:i:s');
			$notification['updated_date'] = date('Y-m-d H:i:s');
			//$notification['created_by'] =
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

	public function sendEstimateconfirmedNotification($userid) {
		$curr_date=date('d-M-Y H:i:s');
		// $this->CI->load->model ( 'users/User_model', 'userlogin' );
		// $gcm_id = $this->CI->userlogin->getUserGcmIdsbyId ( $userid );

		$this->CI->db->select ( 'gcm_reg_id' );
		$this->CI->db->from ( TABLES::$USER );
		$this->CI->db->where ( 'status', 1 );
		$this->CI->db->where ( 'id', $userid );
		$this->CI->db->where ( 'gcm_reg_id IS NOT NULL AND gcm_reg_id != ""', '',false );
		$query = $this->CI->db->get ();
		$gcm_id = $query->result_array ();
	
		$gcmid = $gcm_id[0]['gcm_reg_id'];
	
		$title = 'Estimate confirmed';
		$msg = 'Estimate is confirmed, work will start shortly. You will be notified once the work is complete '.$curr_date.' ';
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
			$notification['source'] = 'customerapp';
			$notification['status'] = 1;
			$notification['created_date'] = date('Y-m-d H:i:s');
			$notification['updated_date'] = date('Y-m-d H:i:s');
			//$notification['created_by'] =
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

	public function sendWorkcompletedNotification($userid) {
		$curr_date=date('d-M-Y H:i:s');
		// $this->CI->load->model ( 'users/User_model', 'userlogin' );
		// $gcm_id = $this->CI->userlogin->getUserGcmIdsbyId ( $userid );

		$this->CI->db->select ( 'gcm_reg_id' );
		$this->CI->db->from ( TABLES::$USER );
		$this->CI->db->where ( 'status', 1 );
		$this->CI->db->where ( 'id', $userid );
		$this->CI->db->where ( 'gcm_reg_id IS NOT NULL AND gcm_reg_id != ""', '',false );
		$query = $this->CI->db->get ();
		$gcm_id = $query->result_array ();
	
		$gcmid = $gcm_id[0]['gcm_reg_id'];
	
		$title = 'Work completed';
		/*$msg = 'Bike is ready. Servicing is complete & your bike is ready for delivery '.$curr_date.' ';*/
		$msg = 'Rejoice!! Service request for your vehicle has been completed.';

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
			$notification['source'] = 'customerapp';
			$notification['status'] = 1;
			$notification['created_date'] = date('Y-m-d H:i:s');
			$notification['updated_date'] = date('Y-m-d H:i:s');
			//$notification['created_by'] =
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

	public function sendGenerateinvoiceNotification($userid,$bill_amount) {
		$curr_date=date('d-M-Y H:i:s');
		// $this->CI->load->model ( 'users/User_model', 'userlogin' );
		// $gcm_id = $this->CI->userlogin->getUserGcmIdsbyId ( $userid );

		$this->CI->db->select ( 'gcm_reg_id' );
		$this->CI->db->from ( TABLES::$USER );
		$this->CI->db->where ( 'status', 1 );
		$this->CI->db->where ( 'id', $userid );
		$this->CI->db->where ( 'gcm_reg_id IS NOT NULL AND gcm_reg_id != ""', '',false );
		$query = $this->CI->db->get ();
		$gcm_id = $query->result_array ();
	
		$gcmid = $gcm_id[0]['gcm_reg_id']; 

		$title = 'Generate invoice';
		$msg = 'Final Bill amount : Rs '.$bill_amount.' Kindly pay the bill amount before the bike delivery or on delivery '.$curr_date.' ';
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
			$notification['source'] = 'customerapp';
			$notification['status'] = 1;
			$notification['created_date'] = date('Y-m-d H:i:s');
			$notification['updated_date'] = date('Y-m-d H:i:s');
			//$notification['created_by'] =
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

	public function sendDeliveryCompleteNotification($userid) {
		$curr_date=date('d-M-Y H:i:s');
		// $this->CI->load->model ( 'users/User_model', 'userlogin' );
		// $gcm_id = $this->CI->userlogin->getUserGcmIdsbyId ( $userid );

		$this->CI->db->select ( 'gcm_reg_id' );
		$this->CI->db->from ( TABLES::$USER );
		$this->CI->db->where ( 'status', 1 );
		$this->CI->db->where ( 'id', $userid );
		$this->CI->db->where ( 'gcm_reg_id IS NOT NULL AND gcm_reg_id != ""', '',false );
		$query = $this->CI->db->get ();
		$gcm_id = $query->result_array ();
	
		$gcmid = $gcm_id[0]['gcm_reg_id'];
	
		$title = 'Ready To Delivery';
		/*$msg = 'Mechanic has delivered the bike, please take a test drive and let us know your feedback '.$curr_date.' ';*/
		$msg = 'Rejoice!! Your vehicle has been ready to deliver with complete service as per request, successfully.';
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
			$notification['source'] = 'customerapp';
			$notification['status'] = 1;
			$notification['created_date'] = date('Y-m-d H:i:s');
			$notification['updated_date'] = date('Y-m-d H:i:s');
			//$notification['created_by'] =
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

	// RiderApp Notification
	public function sendOrderAssignedToRider($riderid,$ordercode) {
		$curr_date=date('d-M-Y H:i:s');
		$map['id '] = $riderid;
		$this->CI->load->model ( 'rider/Rider_model', 'rider' );
		// $gcm_id = $this->CI->rider->getRiderList( $map );
		$gcm_id = $this->CI->db->where('rider_id',$riderid)->get('tbl_rider')->result_array();
		
		$gcmid = $gcm_id[0]['gcm_reg_id'];
		// print_r($gcm_id); die();
		$title = 'New order assigned';
		$msg = 'New order assigned to you. Order Booking ID: '.$ordercode.' '.$curr_date.' ';
		$message = array
		(
			'body' => $msg,
			'title' => $title,
			'subtitle' => 'Notification',
			'tickerText' => '',
			'vibrate' => 1,
			'sound' => 1
		);

		// $message = json_decode($message);

		if(!empty($gcmid)) {
			$notification = array();
			$notification['message'] = $msg;
			$notification['rider_id'] =  $riderid;
			$notification['orderid'] = $ordercode;
			//$notification['assigned_to'] = $params['assigned_to'];
			$notification['type'] = $title;
			$notification['source'] = 'riderapp';
			$notification['status'] = 1;
			$notification['created_date'] = date('Y-m-d H:i:s');
			$notification['updated_date'] = date('Y-m-d H:i:s');
			//$notification['created_by'] =
			// print_r($notification);die();
			$this->CI->db->insert(TABLES::$RIDER_NOTIFICATION,$notification);

			sendFCMPushNotificationSingle($gcmid, $message, $title);
			//$response['nstatus'] = 1;
			//$response['nmsg'] = 'Notification sent successfully.';
		} else {
			//$response['nstatus'] = 0;
			//$response['nmsg'] = 'Failed to send Notification';
		}
		//echo json_encode($response);
	}

	/*************** code by kunal ******************/

	public function getCustomerList() {
		$this->CI->load->model ( 'notification_model/Notification_model', 'notification_model' );
		$response = $this->CI->notification_model->getCustomerList();
		return $response;
	}
	public function sendBulkNotification($notification_title,$notification_message) {
		$curr_date=date('d-M-Y H:i:s');
		//echo $garageid;
		$this->CI->load->model ( 'notification_model/Notification_model', 'notification_model' ); 
			$garagegcm = $this->CI->notification_model->getAllUserlist();
  
			foreach($garagegcm as $result){
				$gcm_ids[] = $result['gcm_reg_id'];
			}
			$title = $notification_title;
			$msg = $notification_message;
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
				
				sendMultipleFCMPushNotificationUser($gcm_ids, $message,$title);
				 foreach($garagegcm as $data){
				 	
					$notification = array();
					$notification['message'] = $msg;
					$notification['user_id'] =  $data['id'];
					//$notification['assigned_to'] = $params['assigned_to'];
					$notification['type'] = $title;
					$notification['source'] = 'Backend';
					$notification['status'] = 1;
					$notification['created_date'] = date('Y-m-d H:i:s');
					$notification['updated_date'] = date('Y-m-d H:i:s');
					//$notification['created_by'] =
					$this->CI->load->model ('api/orders/Order_model','order');
					$resp= $this->CI->order->addNotification ($notification);
				 }
				$response['status'] = 1;
				$response['msg'] = 'Notification sent successfully.';
			} else {
			    $response['status'] = 0;
			    $response['msg'] = 'Gcm Id is Blank';
			} 
			
		return $response;
	}
    
}