<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Cron extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->load->library ( 'zyk/RestaurantLib' );
		$this->load->library ( 'zyk/OrderLib' );
	}
	
	function Assign() {
		$newvendors = array ();
		$orders = $this->orderlib->getAllOrderDetails ();
		foreach ( $orders as $order ) {
			$newvendor = array ();
			if (! empty ( $order ['other_vendorid'] )) {
				$vendor_ids = explode ( ',', $order ['other_vendorid'] );
				$len = count ( $vendor_ids ) - 1;
				$newvendor ['orderid'] = $order ['orderid'];
				;
				$newvendor ['vendor_id'] = $vendor_ids [0];
				$newvendor ['updated_datetime'] = date ( 'Y-m-d H:i:s' );
				$newvendor ['vendor_response'] = 0;
				if ($len == 0) {
					$newvendor ['other_vendorid'] = '';
				} else {
					for($i = 1; $i <= $len; $i ++) {
						$newvendor ['other_vendorid'] = $vendor_ids [$i];
					}
				}
			} else {
				$newvendor ['orderid'] = $order ['orderid'];
				$newvendor ['vendor_id'] = 1;
				$newvendor ['updated_datetime'] = date ( 'Y-m-d H:i:s' );
				$newvendor ['vendor_response'] = 1;
				$newvendor ['other_vendorid'] = '';
				$newvendor ['accepted_by'] = 1;
			}
			$newvendors [] = $newvendor;
		}
		print_r ( $newvendors );
		// $response = $this->orderlib->updateCrondetails($newvendors);
	}
	
	public function getOrdersafterSixty() {
		// $this->load->library('mylib/OrderLib');
		$result = $this->orderlib->getServicedate ();
		foreach ( $result as $data ) {
			$todaydate = date ( 'Y-m-d' );
			$deliverydate = $data ['pickup_date'];
			$userid = $data ['userid'];
			$name = $data ['name'];
			$email = $data ['email'];
			$mobile = $data ['mobile'];
			$gcmregid = $data ['gcm_reg_id'];
			$date1 = date_create ( $todaydate );
			$date2 = date_create ( $deliverydate );
			$diff = date_diff ( $date1, $date2 );
			$daycount = $diff->format ( "%a" );
			//echo "total order" . count ( $daycount );
			//echo "<br>day count:" . $daycount;
			if ($daycount > 60 && $daycount <= 61) {
				if (! empty ( $mobile )) {
					// $usermobile[] = $mobile;
					$sms_msg = 'The ';
					$map = array ();
					//echo "<br>mobile no: ";
					echo $userid . ' ' . $mobile;
					$map ['mobile'] = $mobile;
					$map ['message'] = $sms_msg;
					// $sms_res = $this->orderlib->reminderNotification($map);
					$remind = array ();
					$remind ['userid'] = $userid;
					$remind ['name'] = $name;
					$remind ['email'] = $email;
					$remind ['mobile'] = $mobile;
					$remind ['last_order_date'] = $deliverydate;
					$remind ['status'] = '1';
					$remind ['created_datetime'] = date ( 'Y-m-d H:i:s' );
					$result = $this->orderlib->addRemindOrder ( $remind );
				}
				if (! empty ( $gcmregid )) {
					$gcm_ids [] = $gcmregid;
				}
			} // end of if to check greater than 2
		}
		/*
		   $title = 'We miss you and so we got an exclusive 25% off just for YOU. Use code TML25 on your next booking. (code expires in next 3days) Book now! upto a max of Rs 100';
		   $message = array
		   (
			   'message' => $title,
			   'title' => 'Notification',
			   'subtitle' => 'Notification',
			   'tickerText' => '',
			   'vibrate' => 1,
			   'sound' => 1
		   );
		   if(!empty($gcm_ids) && !empty($title)) {
			   sendGCMPushNotification($gcm_ids, $message,$title);
			   echo "notification sent succesfully";
		   }
		 */
	}
}