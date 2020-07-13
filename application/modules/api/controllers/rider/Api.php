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
	**/

	/**** code by kunal *****/

	public function tempFCM_post()
	{
		$gcmid = $this->post('gcmid');
		$msg = $this->post('msg');
		$title = 'test notification';

		// $msg = 'New order assigned to you. Order Booking ID: '.$ordercode.' '.$curr_date.' ';
		$message = array
		(
			'body' => $msg,
			'title' => $title,
			'subtitle' => 'Notification',
			'tickerText' => '',
			'vibrate' => 1,
			'sound' => 1
		);


		$re = sendFCMPushNotificationSingle($gcmid, $message, $title);
		return $re;
	}

	public function updateRiderDetails_post()
	{
		$data['rider_id'] = $this->post('riderid');
		if (empty($data['rider_id'])) {
			$response['status'] = "false";
			$response['msg'] = "Rider ID missing.";
		}
		else
		{
			$data['rider_name'] = !empty($this->post('rider_name'))?$this->post('rider_name'):"";
			$data['mobile'] = !empty($this->post('mobile'))?$this->post('mobile'):"";
			$data['vehicle_no'] = !empty($this->post('vehicle_no'))?$this->post('vehicle_no'):"";
			$this->load->library ( 'api/RiderLib', 'riderlib' );
			$this->riderlib->updateRider($data);

			$response['status'] = "true";
			$response['msg'] = "Data updated successfully.";
		}
		$this->response($response,200);
	}

	public function showRiderDetails_post()
	{
		$riderid = $this->post('riderid');

		if (empty($riderid)) {
			$response['status'] = "false";
			$response['msg'] = "Rider ID missing.";
		}
		else
		{
			$this->load->library ( 'api/RiderLib', 'riderlib' );
			$result = $this->riderlib->getRiderDataByRiderID($riderid);
			$profiledata = [];
			$document = [];

			foreach ($result as $value) {
				$profiledata['rider_name'] = $value['rider_name'];
				$profiledata['mobile'] = $value['mobile'];
				$profiledata['email'] = $value['email'];
				$profiledata['dob'] = $value['dob'];
				$profiledata['address'] = $value['address'];
				$profiledata['landmark'] = $value['landmark'];
				$profiledata['opration_area'] = $value['opration_area'];
				$profiledata['pincode'] = $value['pincode'];
				$profiledata['vehicle_no'] = $value['vehicle_no'];
				$profiledata['my_referral_code'] = $value['my_referral_code'];
				$profiledata['created_date'] = $value['created_at'];

				$document[0]['doc'] = $value['profile_photo'];
				$document[0]['doc_name'] = $value['id_name'];
				$document[1]['doc'] = $value['profile_photo2'];
				$document[1]['doc_name'] = $value['id_name2'];
				$document[2]['doc'] = $value['profile_photo3'];
				$document[2]['doc_name'] = $value['id_name3'];
				$document[3]['doc'] = $value['profile_photo4'];
				$document[3]['doc_name'] = $value['id_name4'];
				$document[4]['doc'] = $value['profile_photo5'];
				$document[4]['doc_name'] = $value['id_name5'];
			}


			$riderdata['profiledata'] = $profiledata;
			$riderdata['document'] = $document;
			$riderdata['invoicedata'] = $this->riderlib->getInvoicesOfRider($riderid);

			// print_r($result); die();
			if (!empty($riderdata)) {
				$response['status'] = "true";
				$response['msg'] = "Data found.";
				$response['data'][] = $riderdata;
			} else {
				$response['status'] = "false";
				$response['msg'] = "Data not found.";
			}
		}
		$this->response($response,200);
	}

	public function saveCollectionAmountAtDelivery_post()
	{
		$riderid = $this->post('riderid');
		$orderid = $this->post('orderid');
		if (empty($orderid) && empty($riderid)) {
			$response['status'] = "false";
			$response['msg'] = "Order ID or Rider ID missing.";
		}
		else
		{
			$is_total_amt_paid = $this->post('is_total_amt_paid');
			$garage_charges = $this->post('garage_charges');
			$ride_charges = $this->post('ride_charges');
			$total_collection = $this->post('total_collection');
			$data['orderid'] = $orderid;

			if ($is_total_amt_paid == 1) {
				$data['cod_collection_date'] = date('Y-m-d H:i:s');
				$data['garage_amount_received_by_cod'] = $garage_charges;
				$data['is_ride_paid'] = 1;
				$data['cod_payment_collect_rider_id'] = $riderid;

				if ($garage_charges != 0) {
					$data['garage_charges_collect_by_rider'] = 1;
				}

				if ($ride_charges != 0) {
					$data['handling_charges_collect_by_rider'] = 1;
				}

				$this->load->library ( 'api/RiderLib', 'riderlib' );
				$this->riderlib->updateOrder($data);
				$response['status'] = "true";
				$response['msg'] = "Order updated successfully.";
			} else {
				$response['status'] = "false";
				$response['msg'] = "Something went wrong!";
			}
		}
		$this->response($response,200);
	}

	public function showCollectionAmountAtDelivery_post()
	{
		// $riderid = $this->post('riderid');
		$orderid = $this->post('orderid');
		if (empty($orderid)) {
			$response['status'] = "false";
			$response['msg'] = "Order ID missing.";
		}
		else
		{
			$this->load->library ( 'api/RiderLib', 'riderlib' );
			$orders = $this->riderlib->getOrderDetails($orderid);

			$data['ride_charges'] = 0;
			$data['garage_charges'] = 0;

			// for rider charges mod selected cod or not paid by online gateway.
			$is_ride_paid = $orders[0]['is_ride_paid'];
			$applied_ride_charge = $orders[0]['applied_ride_charge'];
			if ($is_ride_paid == 0) {
				$data['ride_charges'] = $applied_ride_charge;
			}

			// for garage charges not paid by longurl(instamojo)
			$garage_payment_status = $orders[0]['payment_status'];
			$grand_total = $orders[0]['grand_total'];
			if ($garage_payment_status == "Pending") {
				$data['garage_charges'] = $grand_total;
			}

			$data['total_collection'] = $data['ride_charges'] + $data['garage_charges'];

			$data['collection_status'] = "";
			if ($data['total_collection'] <= 0) {
				$data['collection_status'] = "Bill Paid.";
			} else {
				$data['collection_status'] = "Collect the given amount by customer.";
			}

			$response['status'] = "true";
			$response['msg'] = "data found.";
			$response['data'] = $data;
		}
		$this->response($response,200);
	}
	
	//image upload by rider
	public function delete_images_post()
	{
		$imageid = $this->post('image_id');
		if (empty($imageid)) {
			$response['status'] = "false";
			$response['msg'] = "Image ID missing.";
		}
		else
		{
			$img = $this->db->select('file_path')->where('id',$imageid)->get('tbl_order_images_by_rider')->row_array();
			$file_path = $img['file_path'];
			if(file_exists('./assets/'.$file_path))
			{
			    unlink('./assets/'.$file_path);
			}
			$this->db->where('id',$imageid)->delete('tbl_order_images_by_rider');
			$response['status'] = "true";
			$response['msg'] = "Image deleted successfully.";
		}
		$this->response($response,200);
	}

	public function update_images_post()
	{
		$imageid = $this->post('image_id');
		if (empty($imageid)) {
			$response['status'] = "false";
			$response['msg'] = "Image ID missing.";
		}
		else
		{
			$filename = $this->post('imageName');
			if(!empty($_FILES['images']['name'])) {

	            $ext = pathinfo($_FILES['images']['name'], PATHINFO_EXTENSION);
				$rand = rand(100000,999999);

				$img = $this->db->select('rider_id,order_id,file_path')->where('id',$imageid)->get('tbl_order_images_by_rider')->row_array();

				$file_path = $img['file_path'];
				$riderid = $img['rider_id'];
				$orderid = $img['order_id'];

				$config['upload_path']        = './assets/rider_orderimages/'.$orderid.$riderid.'/';
		        $config['allowed_types']      = 'jpeg|jpg|png';
		        $config['max_size']           = 10 * 1024 * 1024;
		        $config['file_name']          = date('YmdHis').$rand.".".$ext;

		        $this->load->library('upload', $config);
				$this->upload->initialize($config);

		        if ( ! $this->upload->do_upload('images'))
		        {
		            $error = $this->upload->display_errors();
		            $response['status'] = "false";
		            $response['msg'] = "Filename :".$filename[$i].", Error: ". json_encode($error);
		            $this->response($response,200);
		            exit;
		        }
		        else
		        {
					$data['file_path'] = "rider_orderimages/".$orderid.$riderid."/".$config['file_name'];

					if(file_exists('./assets/'.$file_path))
					{
					    unlink('./assets/'.$file_path);
					}
		        }
		    }

		    $data['file_name'] = (isset($filename))?$filename:"";
			$data['updated_date'] = date('Y-m-d H:i:s');
			$this->db->where('id',$imageid)->update('tbl_order_images_by_rider',$data);

			$response['status'] = "true";
			$response['msg'] = "Data updated successfully.";
		}
		$this->response($response,200);
	}

	public function save_images_post()
	{
		// print_r($_FILES); die();
		$orderid = $this->post('orderid');
		$riderid = $this->post('riderid');
		if (empty($orderid) || empty($riderid)) {
			$response['status'] = "false";
			$response['msg'] = "Invalid data.";
		}
		else
		{
			$filename = $this->post('imageName');
			$cn = count($_FILES['images']['name']);

			for ($i=0; $i < $cn; $i++) {

				$_FILES['file']['name']     = $_FILES['images']['name'][$i]; 
	            $_FILES['file']['type']     = $_FILES['images']['type'][$i]; 
	            $_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$i]; 
	            $_FILES['file']['error']    = $_FILES['images']['error'][$i]; 
	            $_FILES['file']['size']     = $_FILES['images']['size'][$i];

	            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				$rand = rand(100000,999999);

	            // echo $ext; die();

	            if (!is_dir('assets/rider_orderimages/'.$orderid.$riderid)) {
				    mkdir('./assets/rider_orderimages/'.$orderid.$riderid, 0777, TRUE);
				}

				$config['upload_path']          = './assets/rider_orderimages/'.$orderid.$riderid.'/';
		        $config['allowed_types']        = 'jpeg|jpg|png';
		        $config['max_size']             = 10 * 1024 * 1024;
		        $config['file_name']            = date('YmdHis').$rand.".".$ext;

		        $this->load->library('upload', $config);
				$this->upload->initialize($config);

		        if ( ! $this->upload->do_upload('file'))
		        {
		            $error = $this->upload->display_errors();
		            $response['status'] = "false";
		            $response['msg'] = "Filename :".$filename[$i].", Error: ". json_encode($error);
		            // $response['filedata'] = print_r($_FILES);
		            $this->response($response,200);
		            exit;
		        }
		        else
		        {
					$data['rider_id'] = $riderid;
					$data['order_id'] = $orderid;
					$data['file_name'] = (isset($filename[$i]))?$filename[$i]:"";
					$data['file_path'] = "rider_orderimages/".$orderid.$riderid."/".$config['file_name'];
					$data['created_date'] = date('Y-m-d H:i:s');

					$this->db->insert('tbl_order_images_by_rider',$data);
		        }
			}

			$response['status'] = "true";
			$response['msg'] = "Images uploaded successfully.";
		}
		$this->response($response,200);
	}
	//image upload by rider


	public function saveRiderAvailability_post()
	{
		$data['rider_id'] = $this->post('rider_id');
		$data['is_available'] = $this->post('is_available');
		if (empty($data['rider_id']) || empty($data['is_available'])) {
			$response['status'] = "false";
			$response['msg'] = "Invalid data.";
		}
		else
		{
			$this->load->library('api/RiderLib','riderlib');
			$result = $this->riderlib->updateRider($data);
			if ($result) {
				$response['status'] = "true";
				$response['msg'] = "Data updated successfully.";
			} else {
				$response['status'] = "true";
				$response['msg'] = "Data not updated.";
			}
		}
		$this->response($response,200);
	}

	public function getDashboardData_post()
	{
		$rider_id = $this->post('rider_id');
		if (empty($rider_id)) {
			$response['status'] = "false";
			$response['msg'] = "rider id missing.";
		}
		else
		{
			$this->load->library ( 'api/RiderLib', 'riderlib' );
			$result = $this->riderlib->getDashboardData($rider_id);

			// print_r($result); die;
			$orderlist = $this->riderlib->getOrderListByRiderID($rider_id);
			$count = [];
			$new = $ongoing = $completed = 0;
			foreach ($result['pickup'] as $data) {
				if ($data['rider_response'] == 1) {
					++$new;
				}
				if (($data['rider_response'] >= 3 &&  $data['rider_response'] <= 5)) {
					++$ongoing;
					$order_id = $data['orderid'];
				}
				if ($data['rider_response'] == 6 && $data['delivery_rider_response'] == 0) {
					++$completed;
				}
			}

			foreach ($result['delivery'] as $data) {
				if ($data['delivery_rider_response'] == 1) {
					++$new;
				}
				if(($data['delivery_rider_response'] >= 3 && $data['delivery_rider_response'] <= 5)){
					++$ongoing;
					$order_id = $data['orderid'];
				}
				if ($data['delivery_rider_response'] == 6) {
					++$completed;
				}
			}

			$count['new'] = $new;
			$count['ongoing'] = $ongoing;
			$count['completed'] = $completed;
			$response["data"]['today_trips'] = $count;

			if (!empty($orderlist)) {
				$response['data']['total_trips'] = count($orderlist);
			}
			else
			{
				$response['data']['total_trips'] = 0;
			}

			if (!empty($order_id)) {
				$orders = $this->riderlib->getOrderDetails($order_id);
				if (!empty($orders[0])) {
					$response['data']['current_trip'] = $orders[0];
				}
			}

			$income = $this->riderlib->getTotalIncomeOfRider($rider_id);
			$todayIncome = $this->riderlib->getTodayIncomeOfRider($rider_id);
			$weeklyIncome = $this->riderlib->getWeeklyIncomeOfRider($rider_id);
			// print_r($weeklyIncome); die;
			$totalIncome = isset($income[0]['totalIncome'])?$income[0]['totalIncome']:0;

			$response['data']['total_income'] = round($totalIncome);
			$response['data']['today_income'] = round($todayIncome['todayIncome']);
			$response['data']['weekly_income'] = round($weeklyIncome['weeklyIncome']);

			$response["status"] = "true";
			$response["msg"] = "Dashboard data found.";
		}
		$this->response ($response,200);			
	}

	public function send_otp_post() {
		$data=array();
		$data['mobile']=$this->post('mobile_number');
		$is_resend=$this->post('is_resend');

		$this->load->library ( 'api/RiderLib', 'riderlib' );
		$result = $this->riderlib->sendOTP ( $data );
		if($result == 1) {
			$response["status"] = "true";
			$response["msg"] = "OTP sent successfully";
			if ($is_resend == 1) {
				$response['msg'] = "OTP resent successfully";
			}
		} else {
			$response["status"] = "false";
			$response["msg"] = "Mobile number not found";
		}
		$this->response ($response,200);
	}

	public function verify_otp_post() {
		$reg = array ();
		$reg ['mobile'] = $this->post ( 'mobile' );
		$reg ['otp'] = $this->post ( 'otp' );
		
		if(!empty($reg ['mobile']) && !empty($reg ['otp'])) {
			$this->load->library ( 'api/RiderLib', 'riderlib' );		
			$result = $this->riderlib->otpMatch($reg);
			
			if($result['status'] == 1) {
				$response["status"] = "true";
				$response["msg"] = "OTP Matched";
				$response['data'] = $result;
			} else {
				$response["status"] = "false";
				$response["msg"] = "Incorrect OTP.Please enter the correct OTP.";
				$response['data'] = [];
			}
		} else {
			$response["status"] = "false";
			$response["msg"] = "Please enter the OTP sent to your mobile number";
		}
		$this->response ($response,200);
	}

	public function addFirebaseToken_post()
	{
		$tokenData = array ();
		$tokenData['rider_id'] = $this->input->post ( 'rider_id' );
		$tokenData['gcm_reg_id'] = $this->input->post ( 'token' );

		if (empty($tokenData['rider_id'])) {
			$response["status"] = "false";
			$response["msg"] = "Rider id missing.";
		} else {
			$this->db->set($tokenData);
			$this->db->where('rider_id', $tokenData['rider_id']);
			$this->db->update('tbl_rider');

			$response["status"] = "true";
			$response["msg"] = "Token save successfully.";
		}
		$this->response ($response,200);
	}

	public function getOrderListByRiderID_post()
	{
		$rider_id = $this->post ( 'rider_id' );		
		if(!empty($rider_id)) {
			$this->load->library ( 'api/RiderLib', 'riderlib' );		
			$result = $this->riderlib->getOrderListByRiderID($rider_id);
			
			if(!empty($result)) {
				$response["status"] = "true";
				$response["msg"] = "Data found.";
				$response['data'] = $result;
			} else {
				$response["status"] = "true";
				$response["msg"] = "Data not found.";
				$response['data'] = [];
			}
		} else {
			$response["status"] = "false";
			$response["msg"] = "Rider id missing.";
		}
		$this->response ($response,200);	
	}

	public function getOrderDetails_post()
	{
		$order_id = $this->post ( 'order_id' );
		if(!empty($order_id)) {
			$this->load->library ( 'api/RiderLib', 'riderlib' );
			$result = $this->riderlib->getOrderDetails($order_id);

			if(!empty($result)) {

				$img = $this->riderlib->getOrderImgData($result[0]['orderid']);
				$result[0]['images']=$img;
				
				$response["status"] = "true";
				$response["msg"] = "Data found.";
				$response['data'] = $result;
			} else {
				$response["status"] = "true";
				$response["msg"] = "Data not found.";
				$response['data'] = [];
			}
		} else {
			$response["status"] = "false";
			$response["msg"] = "Order id missing.";
		}
		$this->response ($response,200);
	}

	public function save_rider_status_of_order_post()
	{
		$rider_id = $this->post ( 'rider_id' );
		$rider_name = $this->post ( 'rider_name' );
		$data['orderid'] = $this->post ( 'order_id' );
		$rider_response = $this->post ( 'rider_response' );
		$ride_type = $this->post ( 'ride_type' );
		$data['status_updated_date'] = date('Y-m-d');
		$vend_id = $this->post ( 'vendor_id' );
		if(!empty($data['orderid']) && !empty($ride_type)) {
			if ($ride_type == 1) {
				$data['rider_response'] = $rider_response;
				$data['ride_type'] = 1;
				$data['status'] = 0;
				if ($data['rider_response'] == 6) {
					$data['status'] = 1;
					$data['ride_type'] = 0;
					$data['rider_latitude'] = null;
					$data['rider_longitude'] = null;
				}
				$this->load->library ( 'zyk/NotificationLib', 'notificationlib' );
				$this->load->library ( 'api/RiderLib', 'riderlib' );
				$result = $this->riderlib->updateOrder($data);

				$vendor = $this->db->select('garage_name')->where('id',$vend_id)->get('vendor')->row_array();
				$vendor_name = $vendor['garage_name'];
				$reason = (empty($this->post('cancel_reason')))?"NA":$this->post('cancel_reason');
				$noti = [];
				$noti['riderid'] = $rider_id;
				$noti['orderid'] = $data['orderid'];
				if($result) {
					$comment = "";
					$logs = array();
					$logs['orderid'] = $data['orderid'];
					if ($data['rider_response'] == 2) {
						$noti['msg'] = "Order accepted by rider.";
						echo $this->notificationlib->sendOrderUpdateToUser($noti); //die();
	        			$comment = "Order has been accepted by ".$rider_name;
	        		} else if ($data['rider_response'] == 3) { 
	        			$noti['msg'] = "Pickup person is on the way.";
						$this->notificationlib->sendOrderUpdateToUser($noti);
	        			$comment = $rider_name." is on the way to pick up customer bike.";
	        		} else if ($data['rider_response'] == 4) { 
	        			$noti['msg'] = "Pickup person reached.";
						$this->notificationlib->sendOrderUpdateToUser($noti);
	        			$comment = $rider_name." has arrived at customer location for pickup.";
	        		} else if ($data['rider_response'] == 5) { 
	        			$noti['msg'] = "Pickup person is on the way to garage.";
						$this->notificationlib->sendOrderUpdateToUser($noti);
	        			$comment = $rider_name." is on the way to ".$vendor_name;
	        		} else if ($data['rider_response'] == 6) { 
	        			$noti['msg'] = "Your bike reached at garage.";
						$this->notificationlib->sendOrderUpdateToUser($noti);
	        			$comment = "Customer bike reached to ".$vendor_name;
						$logs['order_status'] = 1;
	        		} else if ($data['rider_response'] == 7) {
	        			$comment = "Pickup ride cancelled by ".$rider_name." Reason:".$reason;
	        		}
					$logs['comment'] = $comment;
					$logs['created_date'] = date('Y-m-d H:i:s');
					$logs['created_by'] = $rider_id;
					$logs['is_rider'] = 1;
					$this->load->library ( 'api/OrderLib', 'orderlib' );
					$this->orderlib->addOrderLogs($logs);

					$response["status"] = "true";
					$response["msg"] = "Rider status updated.";
				} else {
					$response["status"] = "true";
					$response["msg"] = "Rider status not update.";
				}
			}
			else if ($ride_type == 2) {
				$data['delivery_rider_response'] = $rider_response;
				$data['ride_type'] = 2;
				if ($data['delivery_rider_response'] == 6) {
					$data['ride_type'] = 0;
					$data['rider_latitude'] = null;
					$data['rider_longitude'] = null;
				}
				$this->load->library ( 'zyk/NotificationLib', 'notificationlib' );
				$this->load->library ( 'api/RiderLib', 'riderlib' );
				$result = $this->riderlib->updateOrder($data);

				$vendor = $this->db->select('garage_name')->where('id',$vend_id)->get('vendor')->row_array();
				$vendor_name = $vendor['garage_name'];
				$reason = (empty($this->post('cancel_reason')))?"NA":$this->post('cancel_reason');

				$noti = [];
				$noti['riderid'] = $rider_id;
				$noti['orderid'] = $data['orderid'];
				if($result) {
					$comment = "";
					$logs = array();
					$logs['orderid'] = $data['orderid'];
					if ($data['delivery_rider_response'] == 2) { 
						$noti['msg'] = "Order accepted by delivery person.";
						$this->notificationlib->sendOrderUpdateToUser($noti);
	        			$comment = "Order has been accepted by ".$rider_name; 
	        		} else if ($data['delivery_rider_response'] == 3) { 
	        			$noti['msg'] = "Delivery person is on the way to garage.";
						$this->notificationlib->sendOrderUpdateToUser($noti);
	        			$comment = $rider_name." is on the way to pickup bike from garage.";
	        		} else if ($data['delivery_rider_response'] == 4) { 
	        			$noti['msg'] = "Delivery person reached at garage.";
						$this->notificationlib->sendOrderUpdateToUser($noti);
	        			$comment = $rider_name." has arrived at garage location.";
	        		} else if ($data['delivery_rider_response'] == 5) { 
	        			$noti['msg'] = "Delivery person is on the way to your location.";
						$this->notificationlib->sendOrderUpdateToUser($noti);
	        			$comment = $rider_name." is on the way to customer location.";
	        		} else if ($data['delivery_rider_response'] == 6) { 
	        			$noti['msg'] = "Delivery person reached at your location.";
						$this->notificationlib->sendOrderUpdateToUser($noti);
	        			$comment = "Bike delivered successfully at customer location.";
	        		} else if ($data['delivery_rider_response'] == 7) {
	        			$comment = "Delivery ride cancelled by ".$rider_name." Reason:".$reason;
	        		}
					$logs['comment'] = $comment;
					$logs['created_date'] = date('Y-m-d H:i:s');
					$logs['created_by'] = $rider_id;
					$logs['order_status'] = 7;
					$logs['is_rider'] = 1;
					$this->load->library ( 'api/OrderLib', 'orderlib' );
					$this->orderlib->addOrderLogs($logs);

					$response["status"] = "true";
					$response["msg"] = "Rider status updated.";
				} else {
					$response["status"] = "true";
					$response["msg"] = "Rider status not update.";
				}
			}
		} else {
			$response["status"] = "false";
			$response["msg"] = "Invalid Data.";
		}
		$this->response ($response,200);
	}

	public function updateRiderLatLong_post()
	{
		$riderid = $this->post ( 'rider_id' );

		if (empty($riderid)) {
			$response['status'] = "false";
			$response['msg'] = "Rider id missing.";
		} else {
			$this->load->library ( 'api/RiderLib', 'riderlib' );
			$orderlist = $this->riderlib->getOrderListByRiderID($riderid);
			$order_id = 0;
			foreach ($orderlist as $order) {
				if ($order['ride_type'] == 1) {
					if ($order['rider_response'] >= 3 && $order['rider_response'] <= 5 && $order['status_updated_date'] == date('Y-m-d')) {
						$order_id = $order['orderid'];
					}
				} else if ($order['ride_type'] == 2) {
					if ($order['delivery_rider_response'] >= 3 && $order['delivery_rider_response'] <= 5 && $order['status_updated_date'] == date('Y-m-d')) {
						$order_id = $order['orderid'];
					}
				}
			}

			if(empty($order_id)) {
				$response["status"] = "false";
				$response["msg"] = "Yet, No any current trip found.";
			} else {
				$data['orderid'] = $order_id;
				$data['rider_latitude'] = $this->post ( 'lat' );
				$data['rider_longitude'] = $this->post ( 'long' );
				$this->load->library ( 'api/RiderLib', 'riderlib' );
				$result = $this->riderlib->updateOrder($data);

				if(!empty($result)) {
					$response["status"] = "true";
					$response["msg"] = "Data updated.";
				} else {
					$response["status"] = "true";
					$response["msg"] = "Data not updated.";
				}
			}
		}
		$this->response ($response,200);
	}

	/**** code by kunal *****/
	
	public function login_post() {
		$login = array ();
		$login ['mobile'] = $this->post ( 'mobile' );
		$login ['password'] = $this->post ( 'password' );
		$login ['gcm_token'] = $this->post ( 'gcm_token' );
		$contact_details = array();
		if (empty($login ['mobile']) || empty($login ['password']))
		{
			$response["success"] = "false";
			$response["msg"] = "Please enter mobile number and password";
		}
		else
		{
		   $this->load->library ( 'api/MechanicLib' );
			$user = $this->mechaniclib->login ( $login );
			 // print_r($user);
			if($user[0]['status'] == 1) {
				$data = new stdClass();
				$data->id = $user[0]['id'];
				$data->name = $user[0]['name'];
				$data->email = $user[0]['email'];
				$data->mobile = $user[0]['mobile'];
				$data->password = $user[0]['password'];
				$data->role = $user[0]['role'];
				
				//$data->areaid = $user[0]['areaid'];
				array_push($contact_details,$data); 
				$response["status"] = "true";
				$response["message"] = "Logged in successfully";
				$response["data"] = $contact_details;
			} else {
				$response["status"] = "false";
				$response["message"] = "Invalid username or password";
				$response["data"] = $contact_details;
			}
		}
		$this->response ($response,200);
	}
	
	public function update_profile_post() {
		$login = array ();
		$login ['id'] = $this->post ( 'user_id' );
		$login ['name'] = $this->post ( 'name' );
		$login ['password'] = $this->post ( 'password' );
		$login ['email'] = $this->post ( 'email' );
		$contact_details = array();
		
		if (empty($login ['email']) || empty($login ['password']))
		{
			$response["success"] = "false";
			$response["msg"] = "Please enter Email number Or password";
		}
		else
		{
			
		   $this->load->library ( 'api/MechanicLib' );
			$result = $this->mechaniclib->update_profile ( $login );
			 // print_r($user);
			if($result == 1) {				
				$response["success"] = "true";
				$response["msg"] = "Account Setting Changed successfully";
			} else {
				$response["success"] = "false";
				$response["msg"] = "Error in changing Account Setting";
			}
			//echo json_encode($success_response);
		}
		$this->response ($response,200);
	}
	
	public function reason_list_post() {
		
		
		$reason_details = array();
		
		$this->load->library ( 'api/MechanicLib' );
		$list = $this->mechaniclib->reasonList ();
			 // print_r($user);
			if(count($list)>0) {				
				foreach ($list as $value) {
					array_push($reason_details,$value); 
				}
				$response["status"] = "true";
				$response["message"] = "Reason List";
				$response["data"] = $reason_details;
			} else {
				$response["status"] = "false";
				$response["message"] = "Reason List Not Found";
				$response["data"] = $reason_details;
			}
		$this->response ($response,200);
	}

	public function main_services_list_post() {

		$myFile = APPPATH."/third_party/sample.json";
        $arr_data = $_POST; // create empty array
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        file_put_contents($myFile, '');
        file_put_contents($myFile, $_POST); 
 
		$params = array ();	
		$params['type'] = $this->post ('type');
		$params['category_id'] = $this->post ('category_id');
		$params['brand_id'] = $this->post ('brand_id');
		$params['model_id'] = $this->post ('model_id');
		$params['subcategory_id'] = $this->post ('subcategory_id');
		
		
		$service_details = array();
		if (empty($params ['type']) || empty($params ['category_id']) || empty($params ['brand_id']) || empty($params ['model_id']))
		{
			$response["status"] = "false";
			$response["msg"] = "Please provide required field";
		}
		else
		{
		   $this->load->library ( 'api/MechanicLib' );
			$data = $this->mechaniclib->mainServicesList ($params);
			  //print_r($data);
			if($data[0]['status'] == 1) {
				
				foreach ($data as $value) {
					array_push($service_details,$value); 
				}				
				
				$response["status"] = "true";
				$response["message"] = "Service list";
				$response["data"] = $service_details;
			} else {
				$response["status"] = "false"; 
				$response["message"] = "Service list not Found";
				$response["data"] = $service_details;
			}
		}
		$this->response ($response,200);
	}
	
	public function ongoing_orders_post() {
		
		$params = array ();	
		
		$params['user_id'] = $this->post ('user_id');
		$params['role'] = $this->post ('role');
		
		
		$service_details = array();
		if (empty($params ['user_id']))
		{
			$response["success"] = "false";
			$response["msg"] = "Please provide required fiels";
		}
		else
		{
		   $this->load->library ( 'api/MechanicLib' );
			$data = $this->mechaniclib->ongoingOrders ($params);
			  //print_r($data);
			if(count($data)>0) {
				
				foreach ($data as $value) {
					array_push($service_details,$value); 
				}				
				
				$response["status"] = "true";
				$response["message"] = "Ongoing Order list";
				$response["data"] = $service_details;
			} else {
				$response["status"] = "false"; 
				$response["message"] = "Service list not Found";
				$response["data"] = $service_details;
			}
		}
		$this->response ($response,200);
	}
	
	public function getOrderHistory_post(){
		$params = array ();	
		
		$params['id'] = $this->post ('user_id');
		$params['role'] = $this->post ('role');
		
		$this->load->library ( 'api/MechanicLib' );
		$order = $this->mechaniclib->getOrder($params);
		
		if(!empty($order)){
			$success_response['status'] = "1";
			$success_response['message'] = "Order history";
			$success_response['data'] = $order;
		}else{
			$success_response['status'] = "0";
			$success_response['message'] = "No records found.";
		}
	
		$this->response ($success_response,200);
	
	}
	
	public function ongoingorderinfo_post() {
		$uid = $this->post('user_id');
		$order_id = $this->post ('order_id');
		$so = array();
		if($uid!="") {
			//$this->load->library ( 'api/UserLib' );
			
			
			$this->load->library ( 'api/MechanicLib' );
			$so = $this->mechaniclib->getlastOrder($order_id);
			$logs = $this->mechaniclib->getlastOrderComment ($order_id);
			
				
			$resp['success']='true';
			$resp['order'] = $so;
			$resp['logs'] = $logs;
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "User Id is blank";
		}
		$this->response ($resp,200);
	}

	public function service_or_spareparts_list_post() {
		

		$params = array ();	
		
		$params['type'] = $this->post ('type');
		$params['category_id'] = $this->post ('category_id');
		$params['brand_id'] = $this->post ('brand_id');
		$params['model_id'] = $this->post ('model_id');
		$params['subcategory_id'] = $this->post ('subcategory_id');
		$params['catsubcat_id'] = $this->post ('catsubcat_id');
		$params['booking_id'] = $this->post ('booking_id');
		
		$service_details = array();
		if (empty($params ['type']) || empty($params ['category_id']) || empty($params ['brand_id']) || empty($params ['model_id']))
		{
			$response["status"] = "false";
			$response["msg"] = "Please provide required field";
		}
		else
		{
		   $this->load->library ( 'api/MechanicLib' );
			$data = $this->mechaniclib->serviceOrSparepartsList ($params); 
			
			$items = $this->orderlib->getOrderItems($params['booking_id']);
			
			if(!empty($data)) {

			foreach ($data as $key => $value) {
				$data[$key]['isChecked'] = 0;
				foreach ($items as $k => $val) {
					if($val['service_id'] == $value['id']){
						$data[$key]['isChecked'] = 1;
					}
				}
			}
			
				if($data[0]['status'] == 1) {
					
					foreach ($data as $value) {
	                                        $value['type'] = $params['type'];
						array_push($service_details,$value); 
					}				
					
					$response["status"] = "true";
					$response["message"] = "Service or spare parts list";
					$response["data"] = $service_details;
				} else {
					$response["status"] = "false"; 
					$response["message"] = "Service or spare parts list not Found";
					$response["data"] = $service_details;
				}
			} else {
					$response["status"] = "false"; 
					$response["message"] = "Service or spare parts list not Found";
					$response["data"] = $service_details;
				}

		}
		$this->response ($response,200);
	}

	
	public function suggested_services_list_post() {
		
		$params = array ();	
		
		$params['orderid'] = $this->post ('order_id');
		
		
		$service_details = array();
		if (empty($params ['orderid']))
		{
			$response["success"] = "false";
			$response["msg"] = "Please provide required fiels";
		}
		else
		{
		   $this->load->library ( 'api/MechanicLib' );
			$data = $this->mechaniclib->suggestedServiceList ($params);
			  //print_r($data);
			if(count($data)>0) {
				
				foreach ($data['service_details'] as $value) {
					array_push($service_details,$value); 
				}				
				
				$response["status"] = "true";
				$response["message"] = "Suggested service list";
				$response["data"] = $service_details;
                                $response["order_details"] = $data['order_details'];
			} else {
				$response["status"] = "false"; 
				$response["message"] = "Suggested service list not Found";
				$response["data"] = $service_details;
			}
		}
		$this->response ($response,200);
	}
	
	public function suggest_services_post() {

		$myFile = APPPATH."/third_party/sample.json";
        $arr_data = $_POST; // create empty array
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        file_put_contents($myFile, '');
        file_put_contents($myFile, $_POST); 
 
		$params = array ();
		$params ['suggested_list'] = $this->post ('suggested_list');
		$userid = $this->post ('user_id');  

		$jsondata1= json_decode($params['suggested_list'],true);

		
		$orders = $this->orderlib->getOrderDetails($jsondata1[0]['orderid']);
 
		$cust_id = $orders[0]['userid'];

 
		$allservices = '';

		foreach ($jsondata1 as $value) {
			# code...
			 $allservices.= $value['service_name'].',';
		}
		    //$services = $jsondata1[0]['service_name'];

		$services = rtrim($allservices,',');
		  
		$service_details = array();
		if (empty($params ['suggested_list']))
		{
			$response["success"] = "false";
			$response["msg"] = "Please provide required fields";
		}
		else
		{
		   $this->load->library ( 'api/MechanicLib' );
			$data = $this->mechaniclib->suggestServices ($params['suggested_list'],$userid); 

			if($data == 0) {
				$params['role_id'] = 2;
				$this->mechaniclib->sendSuggestServicesNotification($services,$cust_id);
				$response["status"] = "true";
				$response["message"] = "Suggested services added successfully";
				//$response["data"] = $service_details;
			} else {
				$response["status"] = "false"; 
				$response["message"] = "Error in add services";
				//$response["data"] = $service_details;
			}
		}
		$this->response ($response,200);
	}
	
	public function scheduled_services_post() {
		$service_data = array ();
		$service_data ['service_day'] = $this->post ( 'service_day' );
		$service_data ['user_id'] = $this->post ( 'user_id' );
		
 		$service_details = array();
		if (empty($service_data ['user_id']) || empty($service_data ['service_day']))
		{
			$response["success"] = "false";
			$response["msg"] = "Please provide required fiels";
		}
		else
		{
		    $this->load->library ( 'api/MechanicLib' );
		    $this->load->library ( 'api/ServiceLib' );


			$data = $this->mechaniclib->scheduled_services ( $service_data ); 

  			if($data[0]['status'] == 1) {
				
				foreach ($data as $value) {
					array_push($service_details,$value); 
				}	 
 				foreach ($service_details as $key => $order) {
 									 $catSubCatNames  = array();

					$catsubcatList = $this->servicelib->getCatsubcatid($order['subcategory_id']);  

					foreach ($catsubcatList as $key2 => $catsub) {  
						$catsubcatArray = explode(',', $order['catsubcat_id']);
						if(in_array($catsub['id'], $catsubcatArray)){
							$currentArray['name'] =  $catsub['name'];
							$catSubCatNames[] = $currentArray;
						} 
 					}
 					$service_details[$key]['catsubcatList']=  $catSubCatNames;
 				} 
  				
 				$response["status"] = "true";
				$response["message"] = "Schedule service list";
				$response["data"] = $service_details;
			} else {
				$response["status"] = "false"; 
				$response["message"] = "Schedule service list not Found";
				$response["data"] = $service_details;
			}
		}
		$this->response ($response,200);
	}

	public function service_accept_or_reject_post() {
		
		$user_id = $this->post ( 'user_id' );
		$accept_reject_flag = $this->post ( 'accept_reject_flag' );
		$order_id = $this->post ( 'order_id' );
		
		$data = array ();
		$data['user_id'] = $user_id;
		$data['accept_reject_flag'] = $accept_reject_flag;
		$data['order_id'] = $order_id;
		$data['reason_id'] = $this->post ( 'reason_id' );
		  
		if(!empty($user_id) && !empty($accept_reject_flag) && !empty($order_id)) {
			$this->load->library ( 'api/MechanicLib' );		
			$result = $this->mechaniclib->service_accept_or_reject_post($data);	 
			$orders = $this->orderlib->getOrderDetails($order_id);
			if($result == 1) {
				$this->load->library('api/OrderLib');
				$logs = array();
				$logs['orderid'] = $data['order_id'];
				if($data['accept_reject_flag'] == 2){
					$logs['comment'] = 'Order rejected by garage';
					$logs['order_status'] = 50;
				}
				$logs['created_date'] = date('Y-m-d H:i:s');
				$logs['created_by'] = $orders[0]['assign_vendor_id'];
				$logs['source'] = 'Mechanic App'; 

				$this->orderlib->addOrderLogs($logs);
				$success_response["success"] = "true";
				$success_response["msg"] = "Order status changed successfully";
			} else {
				$success_response["success"] = "false";
				$success_response["msg"] = "Error in changing order status.";
			}
			
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Please fill the required details.";
		}
		echo json_encode($success_response);
	}
	
	public function setpassword_post() {
		
		$mobile = $this->post ( 'mobile' );
		$password = $this->post ( 'password' );
		
		$data = array ();
		$data['mobile'] = $mobile;
		$data['password'] = $password;
		
		if(!empty($mobile) && !empty($password)) {
			
			$this->load->library ( 'api/MechanicLib' );		
			$result = $this->mechaniclib->updatePassword($data);			
			
			if($result == 1) {
				
				$success_response["success"] = "true";
				$success_response["msg"] = "Password set successfully";
			} else {
				$success_response["success"] = "false";
				$success_response["msg"] = "Please enter the correct Password.";
			}
			
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Please fill the required details.";
		}
		echo json_encode($success_response);
	}
	
	public function order_status_post() {
		$myFile = APPPATH."/third_party/sample.json";
        $arr_data = $_POST; // create empty array
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        file_put_contents($myFile, '');
        file_put_contents($myFile, $jsondata);

		$user_id = $this->post ('user_id');
		$order_id = $this->post ('order_id');
		$order_status = $this->post ('order_status');
		
		$data = array ();
		$data['user_id'] = $user_id;
		$data['order_id'] = $order_id;
		$data['order_status'] = $order_status;
		$status = $this->db->get_where('tbl_booking',array('orderid'=>$data['order_id']))->row('status');
		if($data['order_status'] == 5 && $status == 2)
		{
			$success_response["success"] = "false";
			$success_response["msg"] = "Please wait estimate not yet confirmed..!!";
			echo json_encode($success_response);exit;
		}
		if(!empty($user_id) && !empty($order_id)) {
			
			$this->load->library ( 'api/MechanicLib' );		
			$result = $this->mechaniclib->orderStatus($data);			
			$orders = $this->orderlib->getOrderDetails($order_id);
			if($result == 1) {
				$this->load->library('api/OrderLib');
				$logs = array();
				$logs['orderid'] = $order_id;
				if($data['order_status'] == 1){
					$logs['comment'] = 'Order processing start';
					$logs['order_status'] = 21;
				}else if($data['order_status'] == 2){
					$logs['comment'] = 'Mechanic reached at destination.';
					$logs['order_status'] = 22;
				}elseif($data['order_status'] == 3){
					$logs['order_status'] = 23;
					$logs['comment'] = 'Mechanic Inspection completed.';
				}elseif($data['order_status'] == 5){
					$logs['order_status'] = 4;
					$logs['comment'] = 'Work Completed..';
				}

				$logs['created_date'] = date('Y-m-d H:i:s');
				$logs['created_by'] = $orders[0]['assign_vendor_id'];;
				$logs['source'] = 'Mechanic App';
 
				$this->orderlib->addOrderLogs($logs);
				if($data['order_status'] == 5){
					$this->markworkCompleted($order_id);
					$this->generateInvoice($order_id,$data['user_id']);
				}
				$success_response["success"] = "true";
				$success_response["msg"] = "Order Status Changed successfully";
			} else {
				$success_response["success"] = "false";
				$success_response["msg"] = "Error in change order status";
			}
			
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Please fill the required details.";
		}
		echo json_encode($success_response);
	}
	
	public function payment_post() {
		$myFile = APPPATH."/third_party/sample.json";
        $arr_data = $_POST; // create empty array
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        file_put_contents($myFile, '');
        file_put_contents($myFile, $jsondata);
        
		$user_id = $this->post ('user_id');
		$order_id = $this->post ('order_id');
		$order_status = $this->post ('order_status');
		$received_amount = $this->post ('received_amount');
		$payment_mode = $this->post ('payment_mode');
		$remarks = $this->post ('remarks');
		$data = array ();
		$data['user_id'] = $user_id;
		$data['order_id'] = $order_id;
		$data['order_status'] = $order_status;
		$data['received_amount'] = $received_amount; 
		$data['pay_mode'] = $payment_mode;
        $data['remarks'] = $remarks;
		
		if(!empty($user_id) && !empty($order_id)) {
			$this->load->library('mylib/OrderLib');
			$this->load->library ( 'api/MechanicLib' );
                        
			$result = $this->mechaniclib->paymentStatus($data);
			$orders = $this->orderlib->getOrderDetails($order_id);
                        if($payment_mode == 1) {
                            $data1['name'] = $orders[0]['name'];
                            $data1['email'] = $orders[0]['email'];
                            $data1['mobile'] = $orders[0]['mobile'];
                            $data1['amount'] = $orders[0]['grand_total'];
                            $data1['orderid'] = $order_id;
                            $this->load->library ( 'zyk/PaymentLib' );
                            $this->paymentlib->getPaymentUrl($data1);
                        }
			if($data['received_amount'] > $orders[0]['grand_total']){
				$creditAmt = round($data['received_amount'] - $orders[0]['grand_total']);
				$this->load->library('api/UserLib');
				$wallet = array(
					'user_id' => $orders[0]['userid'],
					'amount' => $creditAmt,
					'trans_type' => 0,
					'order_id' => $data['order_id'],
					'comment' => "Extra amount Rs- $creditAmt received against order-".$data['order_id']
				);
				$resp = $this->userlib->updateUserWallet($wallet);
				if($resp > 0){
					//update order log.
					$logs = array();
					$logs['orderid'] = $data['order_id'];
					$logs['comment'] = "Extra amount Rs- $creditAmt received against order-".$data['order_id'];
					$logs['created_date'] = date('Y-m-d H:i:s');
					$logs['order_status'] = $orders[0]['status'];
					$logs['created_by'] = $orders[0]['assign_vendor_id'];
					$logs['source'] = 'Mechanic App';
					$this->orderlib->addOrderLogs($logs);
				}
			}
						
			if($result == 1) {
				
				$success_response["success"] = "true";
				$success_response["msg"] = "Payment received successfully";
			} else {
				$success_response["success"] = "false";
				$success_response["msg"] = "Error in payment";
			}
			
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Please fill the required details.";
		}
		echo json_encode($success_response);
	}
	
	public function getMechanicNotificationById_post(){
	
		$mecid = $this->post('mec_id');
		$this->load->library ( 'api/MechanicLib' );
		$user = $this->mechaniclib->getMechanicNotificationById($mecid);
		
		$success_response["status"] = "true";
		$success_response["message"] = "Notification data";
		$success_response["data"] = $user;
		
		echo json_encode($success_response);
	
	}
	
	public function testNotification_post(){
		$mecid = $this->post('mec_id');
		$this->load->library ( 'api/MechanicLib' );
		$user = $this->mechaniclib->sendOrderAssignedNotification($mecid);
		echo json_encode($user);
	}
	
	public function testGarageNotification_post(){
		$garage_id = $this->post('garage_id');
		$this->load->library ( 'api/MechanicLib' );
		$user = $this->mechaniclib->sendGarageAssignedNotification($garage_id);
		echo json_encode($user);
	}

	public function getOrderListByMechanic_post() {
	   $data = array ();
	   $data['vendor_id']= $this->post ( 'vendor_id' );
 	   $data['mec_id']= $this->post ( 'mec_id' );

		 if (empty($data ['vendor_id']) && empty($data['mec_id']))
	   {
		   $response["success"] = "false";
		   $response["msg"] = "Invalid data";
	   }
	   else
	   {
		  $this->load->library ( 'api/OrderLib' );
		  $this->load->library ( 'api/ServiceLib' );
		   $orderList = $this->orderlib->getOrderListByMechanic ( $data );

 		   if(!empty($orderList)) { 
 		   		foreach ($orderList as $key => $value) {
					$orderList[$key]['catsubcatList'] = $this->servicelib->getCatsubcatid($value['subcategory_id']);
 				}

			   $response["status"] = "true";
			   $response["message"] = "Order list get successfully";
			   $response["data"] = $orderList;
		   } else {
			   $response["status"] = "false";
			   $response["message"] = "Invalid data";
			}
	   }
	  echo json_encode($response);
   }
		
		
	public function getMechnicList_post() {
		$params = array ();
		$params ['vendor_id'] = $this->post ('vendor_id');
		//$userid = $this->post ('mech_id');
		
		$service_details = array();
		if (empty($params ['vendor_id']))
		{
			$response["success"] = "false";
			$response["msg"] = "Please provide required fields";
		}
		else
		{
		   $this->load->library ( 'api/MechanicLib' );
			$data = $this->mechaniclib->getMechnicList ($params);
			  //print_r($data);
			if(count($data)>0) {
				//array_push($service_details,$data); 
				$response["status"] = "true";
				$response["message"] = "Mechanic List get successfully";
				$response["data"] = $data;
			} else {
				$response["status"] = "false"; 
				$response["message"] = "No Data found";
				//$response["data"] = $service_details;
			}
		}
		$this->response ($response,200);
	}
	
	public function assignMechnic_post() {
		$params = array ();
		$params ['mec_id'] = $this->post ('mec_id');
		$params ['order_id'] = $this->post ('order_id');
		//$userid = $this->post ('mech_id');
		
		$service_details = array();
		if (empty($params ['mec_id']) || empty($params ['order_id']))
		{

			$response["success"] = "false";
			$response["msg"] = "Please provide required fields";
		}
		else
		{
		   $this->load->library ( 'api/MechanicLib' );
			$data = $this->mechaniclib->assignMechnic ($params);
			if($data == 1) {
				$params['role_id'] = 2;
				$this->mechaniclib->sendAssignNotification($params);
				//array_push($service_details,$data); 
				$response["success"] = "true";
				$response["msg"] = "Order assigned to mechanic";
				//$response["data"] = $data;
			} else {
				$response["success"] = "false"; 
				$response["msg"] = "Error in assign mechanic";
				//$response["data"] = $service_details;
			}
		}
		$this->response ($response,200);
	}
	
	public function addMechanic_post() {
		
		$data=array();
		$data['name']=$this->post('name');
		$data['mobile']=$this->post('mobile');
		$data['email']=$this->post('email');
		$data['emergency_mobile']=$this->post('emergency_mobile');
		$data['password']=$this->post('password');
		$data['garage_id']=$this->post('garage_id');
		$data['role_id']=$this->post('role_id');
		$data['status']=$this->post('status');
		$data['created_by']=$this->post('created_by');
		$data['document']=$this->post('document');
		
		$this->load->library ( 'api/MechanicLib' );
		$result = $this->mechaniclib->addMechanic ( $data );
		if($result >0) {
			$success_response["success"] = "true";
			$success_response["msg"] = "Mechanic added successfully";
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Error in upload data";
		}
		echo json_encode($success_response);
	}
	 
	public function getRoleList_post() {
		
		
		$this->load->library ( 'api/MechanicLib' );
		$result = $this->mechaniclib->getRoleList ();
		if(count($result) > 0) {
			$success_response["status"] = "true";
			$success_response["message"] = "Role List";
			$success_response["data"] = $result;
		} else {
			$success_response["status"] = "false";
			$success_response["message"] = "List Not Found";
		}
		echo json_encode($success_response);
	}
	
	public function uploadDocument_post() {
	
		$path = "assets/images/vendor/";
		$saveurl = "images/vendor/";
			
		$upload_url = base_url().$path;
		$response = array();
	
		if(isset($_POST['vendor_id']) && isset($_FILES['pdf']['name'])){
			//$vendorid = $_POST['vendor_id'];
			//$doctype = $_POST['doc_type'];
			
			$randomid = mt_rand(10000,99999);
			
			
			$docid = "empdoc".$randomid;
			
			//getting file info from the request
			$fileinfo = pathinfo($_FILES['pdf']['name']);
				
			//getting the file extension
			$extension = $fileinfo['extension'];
				
			//file url to store in the database
			$file_url = $saveurl . $docid . '.' . $extension;
				
			$file_path = $path . $docid . '.'. $extension;
				
			move_uploaded_file($_FILES['pdf']['tmp_name'],$file_path);
			
			$data = array ();
			//$data['vendor_id'] = $vendorid;			
			
			$data['emp_doc_url'] = $file_url;
							
			
			
			$success_response['success'] = "true";
			$success_response['msg'] = "File Uploded Succesfully";
			$success_response['data'] = asset_url().$file_url;
	
		}else{
			$success_response['success'] = "false";
			$success_response['msg'] = "Please choose a file";
			$success_response['data'] = '';
			
		}
		
		echo json_encode($success_response);
	
	}

	public function generateInvoice($orderid,$userid) {
		ini_set('max_execution_time', 300);
		//echo $orderid;
		$response = array();
		$this->load->library('api/OrderLib');
		$orders = $this->orderlib->getOrderDetails($orderid);

		$walletuserid	= $this->orderlib->getOrdercount($orders[0]['orderid'],$orders[0]['userid']);

		$referpoint= wallet_config(); 
		if($walletuserid > 0)
		{

				$wallets = array();
				$wallets['userid'] = $walletuserid; 
				$wallets['updated_date'] = date('Y-m-d H:i:s'); 
				$wallets['amount'] = $referpoint['other_referral'];
				 
				$this->userlib->addToWallet($wallets);
			 
		}  

		$walletuserid1	= $this->orderlib->getOrdercountFromUserPackage1($orders[0]['orderid'],$orders[0]['userid']);
 
		if($walletuserid1 > 0)
		{
			 if (!empty($orders[0]['package_id'])) {

			  $packagewallet = $this->db->select('*')->from('packages')->where('id',$orders[0]['package_id'])->get()->result_array(); 
  
			
			  $userpackagecount = $this->orderlib->getUserPackageCount($orders[0]['userid'],$orders[0]['package_id']);     

		        if ($userpackagecount == 1 ) {  
 	
					$wallet = array();
					$wallet['userid'] = $walletuserid1;
					$wallet['updated_by'] = 1;
					$wallet['orderid'] = $orderid;
					$wallet['amount'] = $packagewallet[0]['other_referral']; 

					/*echo "<pre>";
					print_r($wallet); 
					exit();*/
					$this->userlib->addToWallet($wallet);

				}

			} 
		}  

		$ordercode = $orders[0]['ordercode'];
		//print_r($orders);
		if($orders[0]['invoice_status'] == 0) {

			$items = $this->orderlib->getOrderItems($orderid);


			$adjustment = $orders[0]['adjustment'];
			$orderdata = array();
			$orderdata['orderid'] = $orderid;
			$orderdata['order_amount'] = $orders[0]['order_amount'];
			$orderdata['discount'] = $orders[0]['discount'];
			$orderdata['adjustment'] = $adjustment;
			$orderdata['delivery_charge'] = $orders[0]['delivery_charge'];;
			$orderdata['net_total'] = $orders[0]['order_amount'] - $orderdata['discount'];
			$orderdata['grand_total'] = $orderdata['net_total'] + $adjustment;
			$invoice  = array();
			$invoice['orderid'] = $orders[0]['orderid'];
			$invoice['order_amount'] = $orders[0]['order_amount'];
			$invoice['discount'] = $orders[0]['discount'];
			$invoice['service_tax'] = $orders[0]['service_tax'];
			$invoice['net_total'] = $orderdata['net_total'];
			$invoice['adjustment'] = $orderdata['adjustment'];
			$invoice['grand_total'] = $orderdata['grand_total'];
			$invoice['invoice_date'] = date('Y-m-d H:i:s');
			$invoice['status'] = 0; 
			$number = round($invoice['grand_total']);
			$invoice['total_words'] = getIndianCurrency($number); 
			$invoice_id = $this->orderlib->generateInvoice($invoice);
			if($invoice_id > 0) {
				$orderdata['invoice_status'] = 1;
				//$orderdata['invoice_status'] = 0;
			}  

				 if($orders[0]['package_id'] != 0) {
                                $this->load->library('zyk/SearchLib'); 
				$packageData = $this->searchlib->getPackageDetailsbyId($orders[0]['package_id']);  
 				$packageUsages = $this->searchlib->getPackageUsagesByUser($packageData['id'], $orders[0]['userid'], $orders[0]['vehicle_id']); 
                                //if(count(explode(",", $packageUsages['order_ids'])) > 1) {
                                    $package_details['package_name'] = $packageData['package_name'];
                                    $package_details['use'] = count(explode(",", $packageUsages['order_ids']));
                                    $package_details['remaining'] = $packageData['service_used_validity'] - count(explode(",", $packageUsages['order_ids'])) ;  
                                    $this->template->set('package_details',$package_details);
                                //}
                        } 

			$this->orderlib->updateOrder($orderdata);
			$orders[0]['order_amount'] = $orderdata['order_amount'];
			$orders[0]['grand_total'] = $orderdata['grand_total'];
			$orders[0]['net_total'] = $orderdata['net_total'];
			$orders[0]['delivery_charge'] = $orderdata['delivery_charge'];
			$orders[0]['adjustment'] = $orderdata['adjustment'];
			$orders[0]['discount'] = $orderdata['discount'];
			$orders[0]['invoice_date'] = date('Y-m-d H:i:s');
			
			$brand				   = $orders[0]['brand'] ;
			$model 				   = $orders[0]['model'] ; 

			if (!empty($orders[0]['vehicle_id'])) {
				
				$vehicles = $this->orderlib->get_vehicles_by_id($orders[0]['vehicle_id']); 

				$vehicle_number	= $vehicles[0]['vehicle_no'];
				$this->template->set('vehicle_number',$vehicle_number);
			}


			$this->template->set('order',$orders[0]);
			$this->template->set('invoice_number',$invoice_id);
			$this->template->set('items',$items); 
			$this->template->set('brand',$brand);
			$this->template->set('model',$model);
			$this->template->set_theme('default_theme');
			$this->template->set_layout (false)
						   ->title ( 'Administrator | Generate Invoice' );
			$html = $this->template->build ('backend/orders/InvoiceDetails','',true);
			$file_name = "invoice_".$ordercode.".pdf";
			$this->load->library('MyPdfLib');
			$url = $this->mypdflib->getPdf($html,$file_name);

			$data1= array();
			$data1['name'] = $orders[0]['name'];
	        $data1['email'] = $orders[0]['email'];
	        $data1['mobile'] = $orders[0]['mobile'];
	        $data1['amount'] = $orders[0]['grand_total'];
	        $data1['orderid'] = $orderid;
	        $this->load->library ( 'zyk/PaymentLib' );
	        $payment_url = $this->paymentlib->getPaymentUrl($data1);
 
			$newinvoice = array();
			$newinvoice['id'] = $invoice_id;
			$newinvoice['invoice_url'] = $url; 
 
			$this->orderlib->updateInvoice($newinvoice);
			$data = array();
			$data['name'] = $orders[0]['name'];
			$data['bill_amount'] = $orders[0]['grand_total'];
			$data['invoice_url'] = $url;
			$data['payment_url'] = $payment_url;
			$data['email'] = $orders[0]['email'];
			$data['mobile'] = $orders[0]['mobile'];
			$this->orderlib->sendInvoiceEmail($data);
			$this->orderlib->sendInvoiceSMS($data);
			$this->orderlib->sendGenerateinvoiceNotification($orders[0]['userid'],$orders[0]['grand_total']);
			$data['name'] = $orders[0]['name'];
			$data['email'] = $orders[0]['email'];
			$data['mobile'] = $orders[0]['mobile'];
			$data['amount'] = $orders[0]['grand_total'];
			$data['orderid'] = $orderid;
			$this->load->library ( 'zyk/PaymentLib' );
			//$resp = $this->paymentlib->getPaymentUrl($data);
			$logs = array();
			$logs['orderid'] = $orderid;
			$logs['comment'] = 'Invoice Generated';
			$logs['created_date'] = date('Y-m-d H:i:s');
			$logs['order_status'] = 6;
			$logs['created_by'] = $userid;
			$this->orderlib->addOrderLogs($logs);
		}
	}

	public function refresh_payment_post(){
		$response = array();
		$orderid = $this->post('order_id');
		if($orderid == ''){
			$response['success'] = "false";
			$response['msg'] = "Order id cant be null";
			$response['data'] = '';
		}else{
			$this->load->library('api/OrderLib');
			$orders = $this->orderlib->getOrderDetails($orderid); 

			if(!empty($orders)){
				$details = array();
				$details[0]['grand_total'] = $orders[0]['grand_total'];
				$details[0]['pay_mode'] = $orders[0]['pay_mode'];
				$response['success'] = "true";
				$response['msg'] = "Details Listed Successfully";
				$response['data'] = $details;
			}else{
				$response['success'] = "false";
				$response['msg'] = "No records found.";
				$response['data'] = '';
			}
		}
		$this->response ($response,200);
	}

	public function vendor_invoice_post(){
		$response = array();
		$filter['vendor_id'] = $this->input->post('vendor_id');
		$filter['condition'] = $this->input->post('filter');
		if($filter['vendor_id'] == ''){
			$response['success'] = "false";
			$response['msg'] = "Vendor Id can not be null.";
		}else if($filter['condition'] == ''){
			$response['success'] = "false";
			$response['msg'] = "Unrecognized Condition.";	
		}else{
			$this->load->library ( 'api/MechanicLib' );
			$invoice = $this->mechaniclib->invoice ( $filter );
			if(!empty($invoice)){
				$response['success'] = "true";
				$response['msg'] = "Details Listed Successfully";
				$response['data'] = $invoice;
			}else{
				$response['success'] = "false";
				$response['msg'] = "No records found.";
			}
		}
		$this->response ($response,200);
	}


	public function markworkCompleted($orderid) {
    	$this->load->library('api/OrderLib');
    	$this->load->library('api/UserLib');
    	$this->load->library('api/MechanicLib');
    	$orders = $this->orderlib->getOrderDetails($orderid);
    	
    	$data['ordercode'] = $orders[0]['ordercode'];
    	$data['mobile'] = $orders[0]['mobile'];
    	$data['email'] = $orders[0]['email'];
    	$data['name'] = $orders[0]['name'];
    	$data['assign_vendor_id'] = $orders[0]['assign_vendor_id']; 
    	$data['orderid'] = $orders[0]['orderid'];

    	$vendordetails =  $this->orderlib->getVendorDetailsByVendorId($data['assign_vendor_id']);   
    	$services	   =  $this->orderlib->getServiceDetailsByOrderId($data['orderid']); 
		 
    	$service = '';
    	foreach ($services as  $value) {
    		# code...
    		$service.=$value['service_name'].',';

    	}
    	$allservices = rtrim($service,','); 

		$temp_array=[];

        $temp_array['name']=$data['name'];
        $temp_array['mobile']=$data['mobile'];
        $temp_array['email']=$data['email'];
        $temp_array['orderid']=$data['orderid'];
        $temp_array['ordercode']=$data['ordercode'];
        $temp_array['allservices']=$allservices;
        $temp_array['vendor_name']= $vendordetails[0]['garage_name'];
        $temp_array['vendor_mobile']=$vendordetails[0]['mobile'];  

    	
    	$discountable_total = $orders[0]['grand_total'];
    	//$final_total = $orders[0]['grand_total'];
    	$coupon_code = $orders[0]['coupon_code'];
    	$order_date = $orders[0]['pickup_date'];
    	$cpresp = array('status'=>0);
		$discount = 0; 
		
    	if(!empty($coupon_code)) {
			//echo 'hii';exit ; 
    		$this->load->library('api/General');
    		$cp = array();
    		$coupon = $this->db->get_where('coupon',array('coupon_code'=>$coupon_code))->result_array();
    		$cpresp['status'] = 1;
    		if(!empty($coupon))
    		{
    			$cpresp['coupon'] = $coupon[0];
    		}
    		/*$cp['coupon_code'] = $coupon_code;
    		$cp['order_date'] = $order_date;
    		$cpresp = $this->general->applyCoupon($cp);*/
    	} else {
    		if($orders[0]['wallet_discount'] == 1) {
    			$wallet = $this->userlib->getWalletBalance($orders[0]['userid']);
    			if($wallet[0]['amount'] > 0) {
    				$discount = $wallet[0]['amount'];
    			}
    		}
    	}

    //print_r($cpresp);
		if(!empty($coupon_code)) {

			if($cpresp['status'] == 1) {

				if($cpresp['coupon']['coupon_type'] == 0){
					if($discountable_total >= $cpresp['coupon']['min_order_value']) {
						if($cpresp['coupon']['discount_type'] == 1) {
							//echo "in discount %";
							$discount = ceil($cpresp['coupon']['discount'] * $discountable_total/100);
							if($cpresp['coupon']['max_discount'] > 0) {
								if($discount > $cpresp['coupon']['max_discount']) {
									$discount = $cpresp['coupon']['max_discount'];
								}
							}
						}
						else{
							//echo "in discoun flat";
							$discount = $cpresp['coupon']['discount'];
							if($cpresp['coupon']['max_discount'] > 0) {
								if($discount > $cpresp['coupon']['max_discount']) {
									$discount = $cpresp['coupon']['max_discount'];
								}
							}
						}
					}

				}else if($cpresp['coupon']['coupon_type'] == 2){
					if($discountable_total >= $cpresp['coupon']['min_order_value']) {
						if($cpresp['coupon']['cashback_type'] == 1) {
							//echo "in casback %";
							$cashback = ceil($cpresp['coupon']['cashback'] * $discountable_total/100);
							if($cpresp['coupon']['max_cashback'] > 0) {
								if($cashback> $cpresp['coupon']['max_cashback']) {
									$cashback = $cpresp['coupon']['max_cashback'];
									//exit;
								}
							}
						}else{
							//echo "in casback flat";
								$cashback = $cpresp['coupon']['cashback'];
								if($cpresp['coupon']['max_cashback'] > 0) {
									if($cashback> $cpresp['coupon']['max_cashback']) {
										$cashback = $cpresp['coupon']['max_cashback'];
										//exit;
								}
							}
						}
					}
					if($cashback > 0){
						//echo "add to wallet";
						$wallet = array();
						$wallet['userid'] = $orders[0]['userid'];
						$wallet['updated_by'] = 1;
						$wallet['orderid'] = $orderid;
						$wallet['amount'] = $cashback;
						$this->userlib->addToWallet($wallet);
					}
				}else{
					if($discountable_total >= $cpresp['coupon']['min_order_value']) {
						if($cpresp['coupon']['discount_type'] == 1) {
							//echo "in discount % both";
							$discount = ceil($cpresp['coupon']['discount'] * $discountable_total/100);
							if($cpresp['coupon']['max_discount'] > 0) {
								if($discount > $cpresp['coupon']['max_discount']) {
									$discount = $cpresp['coupon']['max_discount'];
								}
							}
						}
						else{
							//echo "in discount flat both";
							$discount = $cpresp['coupon']['discount'];
							if($cpresp['coupon']['max_discount'] > 0) {
								if($discount > $cpresp['coupon']['max_discount']) {
									$discount = $cpresp['coupon']['max_discount'];
								}
							}
						}
							if($cpresp['coupon']['cashback_type'] == 1) {
								//echo "in casback % both";
								$cashback = ceil($cpresp['coupon']['cashback'] * $discountable_total/100);
								if($cpresp['coupon']['max_cashback'] > 0) {
									if($cashback> $cpresp['coupon']['max_cashback']) {
										$cashback = $cpresp['coupon']['max_cashback'];
										//exit;
									}
								}
							}else{
								//echo "in casback flat both";
								$cashback = $cpresp['coupon']['cashback'];
								if($cpresp['coupon']['max_cashback'] > 0) {
									if($cashback> $cpresp['coupon']['max_cashback']) {
										$cashback = $cpresp['coupon']['max_cashback'];
										//exit;
									}
								}
							}
						//}
					}
					if($cashback > 0){
						//echo "add to wallet both";
						$wallet = array();
						$wallet['userid'] = $orders[0]['userid'];
						$wallet['updated_by'] = 1;
						$wallet['orderid'] = $orderid;
						$wallet['amount'] = $cashback;
						$this->userlib->addToWallet($wallet);
					}
				}
				
			}   //if status 1 end 
			
		} else {
			if($orders[0]['wallet_discount'] == 1) {
				//if($discountable_total >= 400) {
					if($discount > 0) {
						$wallet = array();
						$wallet['userid'] = $orders[0]['userid'];
						$wallet['updated_by'] = 1;
						$wallet['amount'] = $discount;
						$wallet['orderid'] = $orderid;
						$this->userlib->removeFromWallet($wallet);
					}
				/* } else {
					$discount = 0;
				} */
			}
		}


		$walletuserid = $this->orderlib->getOrdercountFromUserPackage($orders[0]['orderid'],$orders[0]['userid']); 


		if ($walletuserid > 0 ) {


			if (!empty($orders[0]['package_id'])) {
  
				$packagewallet = $this->db->select('*')->from('packages')->where('id',$orders[0]['package_id'])->get()->result_array(); 
					
				$userpackagecount = $this->orderlib->getUserPackageCount($orders[0]['userid'],$orders[0]['package_id']);     

		        if ($userpackagecount == 1 ) {  
 

					$my_referral =	 $packagewallet[0]['my_referral']; 

		 			$wallet = array();
					$wallet['userid'] = $orders[0]['userid'];
					$wallet['updated_by'] = 1;
					$wallet['orderid'] = $orderid;
					$wallet['amount'] = $my_referral;
	 
					$this->userlib->addToWallet($wallet);

			    }
 
			}  

		}  
 
    	
    	$sndSms   = $this->orderlib->markworkCompleted_sms($data);
    	$sndEmail = $this->orderlib->markworkCompleted_email($temp_array);
    	$this->orderlib->sendWorkcompletedNotification($orders[0]['userid'],$orderid);
    	$this->mechaniclib->sendWorkCompletedNotification($orders[0]['vendor_id']);
    	
    	$final_total = $discountable_total - $discount;
    	$orderdata = array();
    	$orderdata['orderid'] = $orderid;
    	$orderdata['status'] = 4;
    	$orderdata['discount'] = $discount;
    	$orderdata['grand_total'] = $final_total;
    	$this->orderlib->updateOrder($orderdata);
    }

    public function save_vehicle_post(){
		$data=array();
		$data['vehicle_no'] = $this->input->post('vehicle_no');
		$data['vehicle_alias_no'] = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "", $this->input->post('vehicle_no')));
		$data['brand_id'] = $this->input->post('brand_id');
		$data['model_id'] = $this->input->post('model_id');
		$data['user_id'] = $this->input->post('user_id');
		$data['created_datetime'] = date('Y-m-d H:i:s');  
 
		$data['status'] = 1;
		$this->load->library ( 'api/MechanicLib' );
		$result = $this->mechaniclib->addUserVehicle ( $data );
		if($result['id'] >0) {
			$success_response["success"] = "true";
			$success_response["msg"] = $result['msg'];
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = $result['msg'] ;
		}
		 echo json_encode($success_response);
	}

	public function vehicle_list_post(){

		$myFile = APPPATH."/third_party/sample.json";
        $arr_data = $_POST; // create empty array
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        file_put_contents($myFile, '');
        file_put_contents($myFile, $jsondata);
 

		$params['user_id'] = $this->input->post('user_id');
		$params['status'] = 1;
		$this->load->library ( 'api/MechanicLib' );
		$result = $this->mechaniclib->getVehicleListByID ( $params );
		if(!empty($result)) {
			$success_response["success"] = "true";
			$success_response["msg"] = "Vehicle list get successfully";
			$success_response["data"] = $result;
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Sorry, you have not added any vehicle." ;
		}
		echo json_encode($success_response);
	}

	public function vehicle_update_post()
	{
		$data=array();
		$data['id'] = $this->input->post('id');
		$data['vehicle_no'] = $this->input->post('vehicle_no');
		$data['vehicle_alias_no'] = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "", $this->input->post('vehicle_no')));
		$data['brand_id'] = $this->input->post('brand_id');
		$data['model_id'] = $this->input->post('model_id');
		$data['user_id'] = $this->input->post('user_id');
		$data['status'] = 1;
		$this->load->library ( 'api/MechanicLib' );
		$result = $this->mechaniclib->updateUserVehicle ( $data );
		if($result['id'] >0) {
			$success_response["success"] = "true";
			$success_response["msg"] = $result['msg'];
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = $result['msg'] ;
		}
		echo json_encode($success_response);
	}

	public function vehicle_delete_post()
	{
		$data=array();
		$data['id'] = $this->input->post('id');
		$data['status'] = 0;
		$this->load->library ( 'api/MechanicLib' );
		$result = $this->mechaniclib->deleteUserVehicle ( $data );
		if($result > 0)
		{
			$success_response["success"] = "true";
			$success_response["msg"] = "Vehicle deleted successfully";
		}
		else
		{
			$success_response["success"] = "false";
			$success_response["msg"] = "Unable to delete vehicle." ;
		}
		echo json_encode($success_response);
	}

	public function vehicle_pakagelist_post()
	{
		$this->load->library ( 'api/MechanicLib' );
		$params['vehicle_id'] = $this->input->post('vehicle_id');
		$params['user_id'] = $this->input->post('user_id');

		$model = $this->mechaniclib->getModelByParams ( $params );

		if(!empty($model)){
			$params['model_id'] = $model[0]['model_id'];
			$result = $this->mechaniclib->getPackageListByModel ( $params ); 
 
			if(!empty($result)) {
				foreach ($result as $key => $value) {
					
					$result[$key]['isused'] = 0;

					$data = $this->db->get_where('tbl_user_package',
					array('user_id' => $params['user_id'], 'vehicle_id'=>$params['vehicle_id'],'package_id' =>$value['id'],'is_expire'=>1))->result_array();  

					if(!empty($data))
					{
						$result[$key]['isused'] = 1;
					}
				}
 			
				$success_response["success"] = "true";
				$success_response["msg"] = "Package list get successfully";
				$success_response["data"] = $result;
			} else {
				$success_response["success"] = "false";
				$success_response["msg"] = "Records Not Found." ;
			}
		}else{
			$success_response["success"] = "false";
			$success_response["msg"] = "Records not found for these vehicle." ;
		}
		echo json_encode($success_response);
	}

	public function vehicle_servicelist_post(){
		$this->load->library ( 'api/MechanicLib' );
		$serviceGroup = array();
		$params['vehicle_id'] = $this->input->post('vehicle_id');
		$params['subcategory_id'] = $this->input->post('subcategory_id');
		$model = $this->mechaniclib->getModelByParams ( $params ); 


		if(!empty($model)){
			$params['model_id'] = $model[0]['model_id'];
			$params['brand_id'] = $model[0]['brand_id'];
 
			$serviceGroup = $this->mechaniclib->getServiceGroup( $params ); 
			 
			if(!empty($serviceGroup))
			{

				foreach ($serviceGroup as $key => $group) {
					$service = array();
					$service[] = $this->mechaniclib->getDisplayData( $group, $params );
					$serviceGroup[$key]['include'] = $service;
				}
				/*echo "<pre>";
				print_r($serviceGroup);
				exit;*/
				foreach ($serviceGroup as $key => $value) {
					$serviceGroup[$key]['price'] = $value['include'][0]['service_price'];
				}
				$success_response["success"] = "true";
				$success_response["msg"] = "Services list get successfully";
				$success_response["data"] = $serviceGroup;
				
			}
			else
			{
				$success_response["success"] = "false";
				$success_response["msg"] = "Records Not Found." ;
			}
			
		}else{
			$success_response["success"] = "false";
			$success_response["msg"] = "Records Not Found." ;
		}
		echo json_encode($success_response);
	}
	 public function save_driving_license_post(){
 
    	$myFile = APPPATH."/third_party/sample.json";
        $arr_data = $_POST; // create empty array
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        file_put_contents($myFile, '');
        file_put_contents($myFile, $jsondata);


		$data=array();
		 
		$data['user_id'] = $this->input->post('user_id');
		$user_name = $this->input->post('user_name');  
  		$image =$this->input->post('image');

  		if (!empty($data['user_id'] )) { 

	  		if(!empty($image))
			{
				$imageid = $user_name.'_DL'.mt_rand(10000,99999);
				$path = "assets/images/vehicles_documents/".$imageid.".png";
				$actualpath = base_url().$path;
				file_put_contents($path,base64_decode($image)); 
				$data['license_url'] = $actualpath;
			} 
 
		$this->load->library ( 'api/MechanicLib' );
		$result = $this->mechaniclib->add_user_vehicle_license( $data );
		 
			$success_response["success"] = "true";
			$success_response["msg"] = $result['msg'];
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "user id is blank" ;
		}
		 echo json_encode($success_response);
	}
	public function user_driving_license_post(){

		$myFile = APPPATH."/third_party/sample.json";
        $arr_data = $_POST; // create empty array
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        file_put_contents($myFile, '');
        file_put_contents($myFile, $jsondata);


		$params['user_id'] = $this->input->post('user_id'); 
		$this->load->library ( 'api/MechanicLib' );
		$result = $this->mechaniclib->getVehicleLicenseByID ( $params );
		if(!empty($result)) {
			$success_response["success"] = "true";
			$success_response["msg"] = "Vehicle License get successfully";
			$success_response["data"] = $result;
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Sorry, you have not added any license." ;
		}
		echo json_encode($success_response);
	}
	public function driving_license_delete_post()
	{
		$data=array();
		$data['id'] = $this->input->post('user_id'); 
		$this->load->library ( 'api/MechanicLib' );
		$result = $this->mechaniclib->delete_vehicle_license ( $data );

		if($result > 0)
		{
			$success_response["success"] = "true";
			$success_response["msg"] = "License deleted successfully";
		}
		else
		{
			$success_response["success"] = "false";
			$success_response["msg"] = "Unable to delete license." ;
		}
		echo json_encode($success_response);
	}
	public function driving_license_update_post()
	{
		$data=array();
		$data['id'] = $this->input->post('id'); 
		$data['user_id'] = $this->input->post('user_id'); 
		$user_name = $this->input->post('user_name'); 
  		$image =$this->input->post('image');
  		if(!empty($image))
		{
			$imageid = $user_name.'_DL'.mt_rand(10000,99999);
			$path = "assets/images/vehicles_documents/".$imageid.".png";
			$actualpath = base_url().$path;
			file_put_contents($path,base64_decode($image)); 
			$data['license_url'] = $actualpath;
		} 
	 	 
		$this->load->library ( 'api/MechanicLib' );
		$result = $this->mechaniclib->update_vehicle_license ( $data );
		if($result['id'] >0) {
			$success_response["success"] = "true";
			$success_response["msg"] = $result['msg'];
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = $result['msg'] ;
		}
		echo json_encode($success_response);
	}

	public function save_user_vehicles_documents_post(){
 
    	$myFile = APPPATH."/third_party/sample.json";
        $arr_data = $_POST; // create empty array
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        file_put_contents($myFile, '');
        file_put_contents($myFile, $jsondata);
 

		$data=array();
		 
		$data['user_id'] = $this->input->post('user_id');
		$data['vehicle_id'] = $this->input->post('vehicle_id'); 
		$data['type'] = $this->input->post('type');
		$vehicleno = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "", $this->input->post('vehicle_no'))); 
		$data['created_datetime'] = date('Y-m-d H:i:s');  
		$data['document_name'] = $this->input->post('document_name'); 

  		$image =$this->input->post('image');
  		
  		if ($data['type'] == 1) {
  			 
  			if(!empty($image))
			{
				$imageid = $vehicleno.'_RC'.mt_rand(10000,99999);
				$path = "assets/images/vehicles_documents/".$imageid.".png";
				$actualpath = base_url().$path;
				file_put_contents($path,base64_decode($image)); 
				$data['url'] = $actualpath;
			} 


  		} else if ($data['type'] == 2) {
  			 
  			 if(!empty($image))
			{
				$imageid = $vehicleno.'_Insurance'.mt_rand(10000,99999);
				$path = "assets/images/vehicles_documents/".$imageid.".png";
				$actualpath = base_url().$path;
				file_put_contents($path,base64_decode($image)); 
				$data['url'] = $actualpath;
			} 
  		} else if ($data['type'] == 3) {
  			
  			if(!empty($image))
			{
				$imageid = $vehicleno.'_PUC'.mt_rand(10000,99999);
				$path = "assets/images/vehicles_documents/".$imageid.".png";
				$actualpath = base_url().$path;
				file_put_contents($path,base64_decode($image)); 
				$data['url'] = $actualpath;
			} 
  		} 

  		/*echo "<pre>";
  		print_r($data);
  		exit();*/
		 
		$this->load->library ( 'api/MechanicLib' );
		$result = $this->mechaniclib->add_vehicle_documents( $data );
		if($result['id'] >0) {
			$success_response["success"] = "true";
			$success_response["msg"] = $result['msg'];
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = $result['msg'] ;
		}
		 echo json_encode($success_response);
	}

	public function update_user_vehicles_documents_post(){
 
    	$myFile = APPPATH."/third_party/sample.json";
        $arr_data = $_POST; // create empty array
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        file_put_contents($myFile, '');
        file_put_contents($myFile, $jsondata); 

		$data=array();
		 
		$data['id'] = $this->input->post('id');
		$data['user_id'] = $this->input->post('user_id');
		$data['vehicle_id'] = $this->input->post('vehicle_id'); 
		$data['type'] = $this->input->post('type');
		$vehicleno = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "", $this->input->post('vehicle_no'))); 
		$data['updated_datetime'] = date('Y-m-d H:i:s');  
  		$image =$this->input->post('image');
  		
  		if ($data['type'] == 1) {
  			 
  			if(!empty($image))
			{
				$imageid = $vehicleno.'_RC'.mt_rand(10000,99999);
				$path = "assets/images/vehicles_documents/".$imageid.".png";
				$actualpath = base_url().$path;
				file_put_contents($path,base64_decode($image)); 
				$data['url'] = $actualpath;
			} 


  		} else if ($data['type'] == 2) {
  			 
  			 if(!empty($image))
			{
				$imageid = $vehicleno.'_Insurance'.mt_rand(10000,99999);
				$path = "assets/images/vehicles_documents/".$imageid.".png";
				$actualpath = base_url().$path;
				file_put_contents($path,base64_decode($image)); 
				$data['url'] = $actualpath;
			} 
  		} else if ($data['type'] == 3) {
  			
  			if(!empty($image))
			{
				$imageid = $vehicleno.'_PUC'.mt_rand(10000,99999);
				$path = "assets/images/vehicles_documents/".$imageid.".png";
				$actualpath = base_url().$path;
				file_put_contents($path,base64_decode($image)); 
				$data['url'] = $actualpath;
			} 
  		} 

  		  
		$this->load->library ( 'api/MechanicLib' ); 
		$result = $this->mechaniclib->update_vehicle_documents( $data );
		if($result['id'] >0) {
			$success_response["success"] = "true";
			$success_response["msg"] = $result['msg'];
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = $result['msg'] ;
		}
		 echo json_encode($success_response);
	}

	public function all_user_vehicles_documents_post(){

		$myFile = APPPATH."/third_party/sample.json";
        $arr_data = $_POST; // create empty array
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        file_put_contents($myFile, '');
        file_put_contents($myFile, $jsondata);


		$params['user_id'] = $this->input->post('user_id'); 
		$params['vehicle_id'] = $this->input->post('vehicle_id'); 
		$params['type'] = $this->input->post('type'); 

		$this->load->library ( 'api/MechanicLib' );
		$result = $this->mechaniclib->getVehicleDocuments( $params );
		if(!empty($result)) {
			$success_response["success"] = "true";
			$success_response["msg"] = "Document get successfully";
			$success_response["data"] = $result;
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Sorry, you have not added any document." ;
		}
		echo json_encode($success_response);
	}

 
	public function vehicle_documents_list_post(){

		$myFile = APPPATH."/third_party/sample.json";
        $arr_data = $_POST; // create empty array
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        file_put_contents($myFile, '');
        file_put_contents($myFile, $jsondata);


		$params['user_id'] = $this->input->post('user_id'); 
		$params['vehicle_id'] = $this->input->post('vehicle_id'); 

		$this->load->library ( 'api/MechanicLib' );
		$result = $this->mechaniclib->getVehicleDocumentByID ( $params );
		if(!empty($result)) {
			$success_response["success"] = "true";
			$success_response["msg"] = "document get successfully";
			$success_response["data"] = $result;
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Sorry, you have not added any document." ;
		}
		echo json_encode($success_response);
	}
	 
	public function vehicle_documents_delete_post()
	{
		$data=array();
		$data['id'] = $this->input->post('id'); 
		$data['type'] = $this->input->post('type');
		$this->load->library ( 'api/MechanicLib' );
		$result = $this->mechaniclib->delete_vehicle_documents ( $data );

		if($result > 0)
		{
			$success_response["success"] = "true";
			$success_response["msg"] = "Document deleted successfully";
		}
		else
		{
			$success_response["success"] = "false";
			$success_response["msg"] = "Unable to delete document." ;
		}
		echo json_encode($success_response);
	}
	public function save_user_other_documents_post(){
 
    	$myFile = APPPATH."/third_party/sample.json";
        $arr_data = $_POST; // create empty array
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        file_put_contents($myFile, '');
        file_put_contents($myFile, $jsondata);
 

		$data=array();
		 
		$data['user_id'] = $this->input->post('user_id');
		$document_name = $this->input->post('document_name'); 
		$data['type'] = NULL; 
		$data['created_datetime'] = date('Y-m-d H:i:s');  
  		$image =$this->input->post('image');
  		$data['document_name'] = $document_name;
  		
  		if ($data['type'] == '') {
  			 
  			if(!empty($image))
			{
				$imageid = $document_name.'_Other'.mt_rand(10000,99999);
				$path = "assets/images/vehicles_documents/".$imageid.".png";
				$actualpath = base_url().$path;
				file_put_contents($path,base64_decode($image)); 
				$data['url'] = $actualpath;
			} 


  		}  
 
		 
		$this->load->library ( 'api/MechanicLib' );
		$result = $this->mechaniclib->add_other_vehicle_documents( $data );
		if($result['id'] >0) {
			$success_response["success"] = "true";
			$success_response["msg"] = $result['msg'];
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = $result['msg'] ;
		}
		 echo json_encode($success_response);
	}

	public function update_user_other_documents_post(){
 
    	$myFile = APPPATH."/third_party/sample.json";
        $arr_data = $_POST; // create empty array
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        file_put_contents($myFile, '');
        file_put_contents($myFile, $jsondata);
 

		$data=array();
		 
		$data['id'] = $this->input->post('id'); 
		$data['user_id'] = $this->input->post('user_id');
		$user_name = $this->input->post('user_name'); 
		$data['type'] = NULL; 
		$data['updated_datetime'] = date('Y-m-d H:i:s');  
  		$image =$this->input->post('image');
  		
  		if ($data['type'] == '') {
  			 
  			if(!empty($image))
			{
				$imageid = $user_name.'_Other'.mt_rand(10000,99999);
				$path = "assets/images/vehicles_documents/".$imageid.".png";
				$actualpath = base_url().$path;
				file_put_contents($path,base64_decode($image)); 
				$data['url'] = $actualpath;
			} 


  		}  
 
		 
		$this->load->library ( 'api/MechanicLib' );
		$result = $this->mechaniclib->update_other_vehicle_documents( $data );
		if($result['id'] >0) {
			$success_response["success"] = "true";
			$success_response["msg"] = $result['msg'];
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = $result['msg'] ;
		}
		 echo json_encode($success_response);
	}

	public function other_document_list_post(){

		$myFile = APPPATH."/third_party/sample.json";
        $arr_data = $_POST; // create empty array
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        file_put_contents($myFile, '');
        file_put_contents($myFile, $jsondata);


		$params['user_id'] = $this->input->post('user_id');  
		$params['type'] = ''; 

		$this->load->library ( 'api/MechanicLib' );
		$result = $this->mechaniclib->getVehicleOtherDocuments( $params );
		if(!empty($result)) {
			$success_response["success"] = "true";
			$success_response["msg"] = "Document get successfully";
			$success_response["data"] = $result;
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Sorry, you have not added any document." ;
		}
		echo json_encode($success_response);
	}




	public function uploadOtherDocument_post() {
	

		$myFile = APPPATH."/third_party/sample.json";
        $arr_data = $_POST; // create empty array
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        file_put_contents($myFile, '');
        file_put_contents($myFile, $jsondata);



		$path = "assets/images/vehicles_documents/";
		$saveurl = "assets/images/vehicles_documents/";
			
		$upload_url = base_url().$path;
		$response = array();
	
		if(isset($_POST['userid']) && isset($_FILES['pdf']['name'])){
			$userid = $_POST['userid'];
			$type = $_POST['type'];
			$vehicle_id = $_POST['vehicle_id'];
			$document_name = $_POST['document_name'];

			$randomid = mt_rand(10000,99999);
			
			if($type == 1){
				$docid = "_RC".$randomid;
			}else if($type == 2){
				$docid = "_Insurance".$randomid;
			}else if($type == 3){
				$docid = "_PUC".$randomid;
			}else if($type == ''){
				$docid = "_Other".$randomid;
			}  

			//getting file info from the request
			$fileinfo = pathinfo($_FILES['pdf']['name']);
				
			//getting the file extension
			$extension = $fileinfo['extension'];
				
			//file url to store in the database
			$file_url = $saveurl . $docid . '.' . $extension;
				
			$file_path = $path . $docid . '.'. $extension;
				
			move_uploaded_file($_FILES['pdf']['tmp_name'],$file_path);
			
			$data = array ();
			$data['user_id'] = $userid;
			$data['vehicle_id'] = $vehicle_id; 
			$data['document_name'] = $document_name; 
			$data['created_datetime'] = date('Y-m-d H:i:s'); 

			if($type == 1){ 
				$data['type'] = 1;
				$data['url'] = base_url().$file_url;
			}else if($type == 2){
				$data['type'] = 2;
				$data['url'] = base_url().$file_url;
			}else if($type == 3){
				$data['type'] = 3;
				$data['url'] = base_url().$file_url;
			}else if($type == ''){
				$data['type'] = NULL; 
				$data['url'] = base_url().$file_url;
			}  
			 
			 
			$this->load->library ( 'api/MechanicLib' );
			$result = $this->mechaniclib->uploadVehicleALLDocument($data);
			
			$success_response['success'] = "true";
			$success_response['message'] = "File Uploded Succesfully";
			$success_response['data'] = base_url().$file_url;
	
		}else{
			$success_response['success'] = "false";
			$success_response['message'] = "Please choose a file";
			$success_response['data'] = "";
			
		}
		
		echo json_encode($success_response);
	
	}

	public function updateOtherDocument_post() {
	

		$myFile = APPPATH."/third_party/sample.json";
        $arr_data = $_POST; // create empty array
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        file_put_contents($myFile, '');
        file_put_contents($myFile, $jsondata);





		$path = "assets/images/vehicles_documents/";
		$saveurl = "assets/images/vehicles_documents/";
			
		$upload_url = base_url().$path;
		$response = array();
	
		if(isset($_POST['userid']) && isset($_FILES['pdf']['name'])){
		
			$id = $_POST['id'];
			$userid = $_POST['userid'];
			$type = $_POST['type'];
			$vehicle_id = $_POST['vehicle_id'];
			$document_name = $_POST['document_name'];

			$randomid = mt_rand(10000,99999);
			
			if($type == 1){
				$docid = "_RC".$randomid;
			}else if($type == 2){
				$docid = "_Insurance".$randomid;
			}else if($type == 3){
				$docid = "_PUC".$randomid;
			} 
			//getting file info from the request
			$fileinfo = pathinfo($_FILES['pdf']['name']);
				
			//getting the file extension
			$extension = $fileinfo['extension'];
				
			//file url to store in the database
			$file_url = $saveurl . $docid . '.' . $extension;
				
			$file_path = $path . $docid . '.'. $extension;
				
			move_uploaded_file($_FILES['pdf']['tmp_name'],$file_path);
			
			$data = array ();
			$data['id'] = $id;
			$data['user_id'] = $userid;
			$data['vehicle_id'] = $vehicle_id; 
			$data['document_name'] = $document_name; 
			$data['updated_datetime'] = date('Y-m-d H:i:s'); 
			if($type == 1){ 
				$data['type'] = 1;
				$data['url'] = base_url().$file_url;
			}else if($type == 2){
				$data['type'] = 2;
				$data['url'] = base_url().$file_url;
			}else if($type == 3){
				$data['type'] = 3;
				$data['url'] = base_url().$file_url;
			}else if($type == ''){
				$data['type'] = NULL;
				$data['url'] = base_url().$file_url;
			}  


			$this->load->library ( 'api/MechanicLib' );
			$result = $this->mechaniclib->updateVehicleALLDocument($data);
			
			$success_response['success'] = "true";
			$success_response['message'] = "File Uploded Succesfully";
			$success_response['data'] = base_url().$file_url;
	
		}else{
			$success_response['success'] = "false";
			$success_response['message'] = "Please choose a file";
			$success_response['data'] = "";
			
		}
		
		echo json_encode($success_response);
	
	}

	public function uploadLicenseDocument_post() {
	

		$myFile = APPPATH."/third_party/sample.json";
        $arr_data = $_POST; // create empty array
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        file_put_contents($myFile, '');
        file_put_contents($myFile, $jsondata);



		$path = "assets/images/vehicles_documents/";
		$saveurl = "assets/images/vehicles_documents/";
			
		$upload_url = base_url().$path;
		$response = array();
	 
		if(isset($_POST['userid']) && isset($_FILES['pdf']['name'])){
			$userid = $_POST['userid'];
			$user_name = $_POST['user_name']; 
			
			$randomid = mt_rand(10000,99999);
			 
			$docid = $user_name."_License".$randomid;
			  
			//getting file info from the request
			$fileinfo = pathinfo($_FILES['pdf']['name']);
				
			//getting the file extension
			$extension = $fileinfo['extension'];
				
			//file url to store in the database
			$file_url = $saveurl . $docid . '.' . $extension;
				
			$file_path = $path . $docid . '.'. $extension;
				
			move_uploaded_file($_FILES['pdf']['tmp_name'],$file_path);
			
			$data = array ();
			$data['user_id'] = $userid;
			$data['created_datetime'] = date('Y-m-d H:i:s');  
			$data['license_url'] = base_url().$file_url; 
 
 	

			$this->load->library ( 'api/MechanicLib' );
			$result = $this->mechaniclib->uploadLicenseDocument($data);
			
			$success_response['success'] = "true";
			$success_response['message'] = "File Uploded Succesfully";
			$success_response['data'] = base_url().$file_url;
	
		}else{
			$success_response['success'] = "false";
			$success_response['message'] = "Please choose a file";
			$success_response['data'] = "";
			
		}
		
		echo json_encode($success_response);
	
	}
	public function  package_search_post()
	{
 
		$myFile = APPPATH."/third_party/sample.json";
        $arr_data = $_POST; // create empty array
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        file_put_contents($myFile, '');
        file_put_contents($myFile, $jsondata);

		$this->load->library ( 'api/MechanicLib' ); 

 		$params['user_id'] = $this->input->post('user_id');
		$params['subcategory_id'] = $this->input->post('subcategory_id'); 
		$params['brand_id'] = $this->input->post('brand_id');
		$params['model_id'] = $this->input->post('model_id');
		$params['service_id'] = $this->input->post('service_id');
 
			 
			if($params['subcategory_id'] != '' || $params['brand_id'] != '' || $params['model_id'] != '' || $params['service_id'] != ''){ 
				    $result = $this->mechaniclib->getallPackageByids ($params);  

					if(!empty($result)) { 
						 
						$success_response["success"] = "true";
						$success_response["msg"] = "Package list get successfully";
						$success_response["data"] = $result;
					} else {
 
						$success_response["success"] = "false";
						$success_response["msg"] = "Records Not Found." ;
						 
					} 

			}else{
 
				$result = $this->mechaniclib->getPackageList (); 
				if(!empty($result)) { 
					$success_response["success"] = "true";
					$success_response["msg"] = "Package list get successfully";
					$success_response["data"] = $result ; 
				}

			}
		 
		echo json_encode($success_response); 
	}
	public function pakagelist_post()
	{
		$this->load->library ( 'api/MechanicLib' ); 

		$params['user_id'] = $this->input->post('user_id'); 

		if(!empty($params['user_id'])){ 
			$result = $this->mechaniclib->getPackageList (); 
  
			if(!empty($result)) {
				foreach ($result as $key => $value) {
					
					$result[$key]['isused'] = 0;

					$data = $this->db->get_where('tbl_user_package',
					array('user_id' => $params['user_id'], 'vehicle_id'=>$params['vehicle_id'],'package_id' =>$value['id'],'is_expire'=>1))->result_array();  

					if(!empty($data))
					{
						$result[$key]['isused'] = 1;
					}
				}
 			
				$success_response["success"] = "true";
				$success_response["msg"] = "Package list get successfully";
				$success_response["data"] = $result;
			} else {
				$success_response["success"] = "false";
				$success_response["msg"] = "Records Not Found." ;
			}
		}else{
			$success_response["success"] = "false";
			$success_response["msg"] = "Records not found for these vehicle." ;
		}
		echo json_encode($success_response);
	}
	public function package_servicelist_post()
	{
		$this->load->library ( 'api/MechanicLib' ); 

		$params['user_id'] = $this->input->post('user_id'); 

		if(!empty($params['user_id'])){ 
			$result = $this->mechaniclib->getallpackageservices (); 

			if(!empty($result)) { 
 			
				$success_response["success"] = "true";
				$success_response["msg"] = "Package Service list get successfully";
				$success_response["data"] = $result;
			} else {
				$success_response["success"] = "false";
				$success_response["msg"] = "Records Not Found." ;
			}
		}else{
			$success_response["success"] = "false";
			$success_response["msg"] = "Records not found." ;
		}
		echo json_encode($success_response);
	}
}