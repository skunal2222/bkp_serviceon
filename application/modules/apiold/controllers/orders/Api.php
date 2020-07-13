<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * Auth API
 * @author Pradeep Singh
 * @package Auth
 *
 */
class Api extends REST_Controller {
	
	public function addorder_post() {
		$pickuptime = $this->post("pickup_time");
		$pickupdate = $this->post("pickup_date");
		$email = $this->post("email");
		$couponcode = $this->post("offercode");
		$option = $this->post("option");
		$laundry_service = $this->post("service");
		if($pickuptime!="" && $pickupdate!="" && $email!="") {
			$this->load->library('mylib/UserLib');
			$profile = $this->userlib->getUserByEmail($email);
			if(count($profile) > 0) {
				$response = array();
				$params = array();
				$params['userid'] = $profile[0]['id'];
				$params['areaid'] = $profile[0]['areaid'];
				$params['name'] = $profile[0]['name'];
				$params['email'] = $profile[0]['email'];
				$params['mobile'] = $profile[0]['mobile'];
				$params['locality'] = $profile[0]['landmark'];
				$params['latitude'] = $profile[0]['latitude'];
				$params['longitude'] = $profile[0]['longitude'];
				$params['address'] = $profile[0]['address'];
				if($option == 'promocode') {
					if(!empty($couponcode))
					$params['coupon_code'] = $couponcode;
				} else {
					if($option == "credits")
					$params['wallet_discount'] = 1;
				}
				$params['service'] = $laundry_service;
				if(!empty($pickupdate))
					$params['pickup_date'] = date('Y-m-d',strtotime($pickupdate));
				else
					$params['pickup_date'] = date('Y-m-d');
				$pickup_times = explode("-",$pickuptime);
				$pstart_time = date('h A',strtotime($pickup_times[0]));
				$pend_time = date('h A',strtotime($pickup_times[1]));
				$pickuptime = $pstart_time.' - '.$pend_time;
				$del_date = date('Y-m-d',strtotime('+48 hours',strtotime($params['pickup_date'])));
				$day = date('D',strtotime($del_date));
				if($day == 'Wed') {
					$del_date = date('Y-m-d',strtotime('+24 hours',strtotime($del_date)));
				}
				$params['pickup_slot'] = $pickuptime;
				$params['delivery_date'] = date('Y-m-d',strtotime('+72 hours',strtotime($params['pickup_date'])));
				$params['tml_delivery_date'] = $del_date;
				$params['ordered_on'] = date('Y-m-d H:i:s');
				$params['source'] = 1;
				if(empty($profile[0]['latitude'])) {
					$latlong = array();
					$latlong['id'] = $profile[0]['id'];
					$latlong['latitude'] = $params['latitude'];
					$latlong['longitude'] = $params['longitude'];
					$latlong['landmark'] = $params['locality'];
					$this->userlib->updateLatLong($latlong);
				}
				$this->load->library('mylib/OrderLib');
				$orderid = $this->orderlib->addOrder($params);
				$this->load->library('mylib/OldTml');
				$tmlpram = array();
				$tmlpram['pickup_time'] = $params['pickup_slot'];
				$tmlpram['pickup_date'] = $params['pickup_date'];
				$tmlpram['email'] = $params['email'];
				$tmlpram['offercode'] = $couponcode;
				$tmlpram['option'] = $option;
				$tmlpram['service'] = $params['service'];
				$this->oldtml->addToVtiger($tmlpram);
				if($orderid > 0) {
					$params['orderid'] = $orderid;
					//$this->orderlib->addToDack($params);
					$this->orderlib->sendBookingEmail($params);
					//$this->orderlib->notifyMe($params);
					//$this->orderlib->sendBookingSMS($params);
					$oupdate = array();
					$oupdate['orderid'] = $orderid;
					$oupdate['ordercode'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($orderid, 10, 36)) ;
					$this->orderlib->updateOrder($oupdate);
					$resp['orderid'] = $orderid;
					$resp["success"] = "true";
					$resp["msg"] = "salesorder created successfully";
					
					$logs = array();
					$logs['orderid'] = $orderid;
					$logs['comment'] = 'Order punch in system';
					$logs['created_date'] = date('Y-m-d H:i:s');
					$logs['order_status'] = 0;
					$logs['created_by'] = 0;
					$this->orderlib->addOrderLogs($logs);
					
				} else {
					$resp["success"] = "false";
					$resp["msg"] = "Invalid data";
				}
			} else {
				$resp["success"] = "false";
				$resp["msg"] = "no contact exist for this email id";
			}
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "insufficient data";
		}
		$this->response ($resp,200);
	}
	
	public function addorderold_post() {
		$resp = array();
		$pickuptime = $this->post("pickup_time");
		$pickupdate = $this->post("pickup_date");
		$email = $this->post("email");
		$couponcode = $this->post("offercode");
		$option = $this->post("option");
		$laundry_service = $this->post("service");
		if($pickuptime!="" && $pickupdate!="" && $email!="") {
			$this->load->library('mylib/UserLib');
			$profile = $this->userlib->getUserByEmail($email);
			if(count($profile) > 0) {
				$response = array();
				$params = array();
				$params['userid'] = $profile[0]['id'];
				$params['areaid'] = $profile[0]['areaid'];
				$params['name'] = $profile[0]['name'];
				$params['email'] = $profile[0]['email'];
				$params['mobile'] = $profile[0]['mobile'];
				//$params['locality'] = $profile[0]['landmark'];
				//$params['latitude'] = $profile[0]['latitude'];
				//$params['longitude'] = $profile[0]['longitude'];
				$params['address'] = $profile[0]['address'];
				if($option == 'promocode') {
					if(!empty($couponcode))
						$params['coupon_code'] = $couponcode;
				} else {
					if($option == "credits")
					$params['wallet_discount'] = 1;
				}
				$params['service'] = $laundry_service;
				if(!empty($pickupdate))
					$params['pickup_date'] = date('Y-m-d',strtotime($pickupdate));
				else
					$params['pickup_date'] = date('Y-m-d');
				$pickup_times = explode("-",$pickuptime);
				$pstart_time = date('h A',strtotime($pickup_times[0]));
				$pend_time = date('h A',strtotime($pickup_times[1]));
				$pickuptime = $pstart_time.' - '.$pend_time;
				$del_date = date('Y-m-d',strtotime('+48 hours',strtotime($params['pickup_date'])));
				$day = date('D',strtotime($del_date));
				if($day == 'Wed') {
					$del_date = date('Y-m-d',strtotime('+24 hours',strtotime($del_date)));
				}
				$params['pickup_slot'] = $pickuptime;
				$params['delivery_date'] = date('Y-m-d',strtotime('+72 hours',strtotime($params['pickup_date'])));
				$params['tml_delivery_date'] = $del_date;
				$params['ordered_on'] = date('Y-m-d H:i:s');
				$params['source'] = 1;
				/*if(empty($profile[0]['latitude'])) {
					$latlong = array();
					$latlong['id'] = $profile[0]['id'];
					$latlong['latitude'] = $params['latitude'];
					$latlong['longitude'] = $params['longitude'];
					$latlong['landmark'] = $params['locality'];
					$this->userlib->updateLatLong($latlong);
				}*/
				$this->load->library('mylib/OrderLib');
				$orderid = $this->orderlib->addOrder($params);
				$this->load->library('mylib/OldTml');
				$tmlpram = array();
				$tmlpram['pickup_time'] = $params['pickup_slot'];
				$tmlpram['pickup_date'] = $params['pickup_date'];
				$tmlpram['email'] = $params['email'];
				$tmlpram['offercode'] = $couponcode;
				$tmlpram['option'] = $option;
				$tmlpram['service'] = $params['service'];
				$this->oldtml->addToVtiger($tmlpram);
				if($orderid > 0) {
					$params['orderid'] = $orderid;
					$this->orderlib->addToDack($params);
					$this->orderlib->sendBookingEmail($params);
					$this->orderlib->notifyMe($params);
					//$this->orderlib->sendBookingSMS($params);
					$oupdate = array();
					$oupdate['orderid'] = $orderid;
					$oupdate['ordercode'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($orderid, 10, 36)) ;
					$this->orderlib->updateOrder($oupdate);
					$resp['orderid'] = $orderid;
					$resp["success"] = "true";
					$resp["msg"] = "salesorder created successfully";
				} else {
					$resp["success"] = "false";
					$resp["msg"] = "Invalid data";
				}
			} else {
				$resp["success"] = "false";
				$resp["msg"] = "no contact exist for this email id";
			}
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "insufficient data";
		}
		echo json_encode($resp);
	}
	
/*	public function orderhistory_post() {
		$email = $this->post('email');
		$so = array();
		if($email!="") {
			$this->load->library ( 'mylib/UserLib' );
			$profile = $this->userlib->getUserByEmail($email);
			if(count($profile) > 0) {
				$orders = $this->userlib->getOrderDetailByUserId ( $profile[0]['id'] );
				$i = 0;
				foreach ($orders as $order) {
					$all_salesorder = array();
					$all_salesorder['salesorderid'] = $order['orderid'];
					$all_salesorder['TMLSOID'] = $order['orderid'];
					$all_salesorder['contactid'] = $profile[0]['id'];
					$all_salesorder['TMLContactId'] = $profile[0]['id'];
					$all_salesorder['Service'] = $order['service'];
					if(!empty($order['pickup_date'])) {
						$all_salesorder['pickupdate'] = date('d-m-Y',strtotime($order['pickup_date']));
					} else {
						$all_salesorder['pickupdate'] = '';
					}
					$all_salesorder['pickuptime'] = $order['pickup_slot'];
					if(!empty($order['delivery_date'])) {
						$all_salesorder['deliverydate'] = date('d-m-Y',strtotime($order['delivery_date']));
					} else {
						$all_salesorder['deliverydate'] = '';
					}
					//$all_salesorder['deliverytime'] = $order['delivery_slot'];
					
					if($orders[0]['delivery_slot']== null){
						$all_salesorder['deliverytime'] = "";
					}else{
						$all_salesorder['deliverytime'] = $order['delivery_slot'];
					}
					
					$all_salesorder['total_bill'] = $order['grand_total'];
					if($order['status'] == 0) {
						$all_salesorder['status'] = 'Order Booking';
						$all_salesorder['status2'] = 'Order Booking';
					} else if($order['status'] == 1) {
						$all_salesorder['status'] = 'Pickup Assignment';
						$all_salesorder['status2'] = 'Pickup Assignment';
					} else if($order['status'] == 2) {
						$all_salesorder['status'] = 'Quantity Assignment';
						$all_salesorder['status2'] = 'Quantity Assignment';
					} else if($order['status'] == 3) {
						$all_salesorder['status'] = 'Delivery Assignment';
						$all_salesorder['status2'] = 'Delivery Assignment';
					} else if($order['status'] == 4) {
						$all_salesorder['status'] = 'Amount Updation';
						$all_salesorder['status2'] = 'Amount Updation';
					} else if($order['status'] == 5) {
						$all_salesorder['status'] = 'Cancel Order';
						$all_salesorder['status2'] = 'Cancel Order';
					}
					
					$all_salesorder['total'] = $order['order_amount'];
					$all_salesorder['paidbill'] = $order['amount_received'];
					$all_salesorder['payableamount'] = $order['grand_total'];
					$all_salesorder['applieddiscount'] = $order['discount'];
					$all_salesorder['delivery_charge'] = $order['delivery_charge'];
					$all_salesorder['credits'] = 0;
					if(!empty($order['invoice_url']))
						$all_salesorder['invoice_link'] = base_url().$order['invoice_url'];
					else
						$all_salesorder['invoice_link'] = '';
					//$all_salesorder['user_status'] = $user_status;
					if($order['payment_status'] == 'Credit') {
						$all_salesorder['payment_done'] = "yes";
						$payment_message='Payment already done.';
					} else {
						$all_salesorder['payment_done'] = "no";
						$payment_message='Payment Pending.';
					}
					$all_salesorder['payment_message'] = $payment_message;
					$all_salesorder['payment_link'] = base_url().'paynow/'.$order['orderid'];
					if($order['invoice_status'] == 1) {
						if(!empty($order['invoice_url']))
							$all_salesorder['enable_invoice'] = "true";
						else
							$all_salesorder['enable_invoice'] = "false";
					} else {
						$all_salesorder['enable_invoice'] = "false";
					}
					$all_salesorder['click_on_invoice_to_customer'] = 'true';
					
					$so[$i] = $all_salesorder;
					$i++;
				}
				$resp['success']='true';
				$resp['salesorder'] = $so;
			} else {
				$resp["success"] = "false";
				$resp["msg"] = "contact not found";
			}
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "emailid is blank";
		}
		$this->response ($resp,200);
	}*/
						
						public function orderhistory_post() {
							$mobile = $this->post('mobile');
							$so = array();
							if($mobile!="") {
								$this->load->library ( 'zyk/UserLib' );
								$so = $this->userlib->getOrderbyMobile($mobile);
									
									$resp['success']='true';
									$resp['order'] = $so;
							} else {
								$resp["success"] = "false";
								$resp["msg"] = "Mobile is blank";
							}
							$this->response ($resp,200);
						}					
	
	public function orderhistoryold_post() {
		$email = $this->post('email');
		$so = array();
		if($email!="") {
			$this->load->library ( 'mylib/UserLib' );
			$profile = $this->userlib->getUserByEmail($email);
			if(count($profile) > 0) {
				$orders = $this->userlib->getOrderDetailByUserId ( $profile[0]['id'] );
				$i = 0;
				foreach ($orders as $order) {
					$all_salesorder = array();
					$all_salesorder['salesorderid'] = $order['orderid'];
					$all_salesorder['TMLSOID'] = $order['orderid'];
					$all_salesorder['contactid'] = $profile[0]['id'];
					$all_salesorder['TMLContactId'] = $profile[0]['id'];
					$all_salesorder['Service'] = $order['service'];
					if(!empty($order['pickup_date'])) {
						$all_salesorder['pickupdate'] = date('d-m-Y',strtotime($order['pickup_date']));
					} else {
						$all_salesorder['pickupdate'] = '';
					}
					$all_salesorder['pickuptime'] = $order['pickup_slot'];
					if(!empty($order['delivery_date'])) {
						$all_salesorder['deliverydate'] = date('d-m-Y',strtotime($order['delivery_date']));
					} else {
						$all_salesorder['deliverydate'] = '';
					}
					$all_salesorder['deliverytime'] = $order['delivery_slot'];
					$all_salesorder['total_bill'] = $order['grand_total'];
					if($order['status'] == 0) {
						$all_salesorder['status'] = 'Order Booking';
						$all_salesorder['status2'] = 'Order Booking';
					} else if($order['status'] == 1) {
						$all_salesorder['status'] = 'Pickup Assignment';
						$all_salesorder['status2'] = 'Pickup Assignment';
					} else if($order['status'] == 2) {
						$all_salesorder['status'] = 'Quantity Assignment';
						$all_salesorder['status2'] = 'Quantity Assignment';
					} else if($order['status'] == 3) {
						$all_salesorder['status'] = 'Delivery Assignment';
						$all_salesorder['status2'] = 'Delivery Assignment';
					} else if($order['status'] == 4) {
						$all_salesorder['status'] = 'Amount Updation';
						$all_salesorder['status2'] = 'Amount Updation';
					} else if($order['status'] == 5) {
						$all_salesorder['status'] = 'Cancel Order';
						$all_salesorder['status2'] = 'Cancel Order';
					}
					
					$so[$i] = $all_salesorder;
					$i++;
				}
				$resp['success']='true';
				$resp['salesorder'] = $so;
			} else {
				$resp["success"] = "false";
				$resp["msg"] = "contact not found";
			}
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "emailid is blank";
		}
		echo json_encode($resp);
	}
	
	public function orderdetail_post() {
		$orderid = $this->post('salesorderid');
		if($orderid != "") {
			$this->load->library('mylib/OrderLib');
			$orders = $this->orderlib->getOrderDetails($orderid);
			if(count($orders) > 0) {
				$citems = $this->orderlib->getOrderItemCount($orderid);
				$data = array();
				$washniron = 0;
				$drycleaning = 0;
				$ironing = 0;
				$other = 0;
				foreach ($citems as $citem) {
					if($citem['cat_id'] == 1) {
						$drycleaning = $citem['items'];
					} else if($citem['cat_id'] == 2) {
						$washniron = $citem['items'];
					} else if($citem['cat_id'] == 3) {
						$ironing = $citem['items'];
					} else {
						$other = $citem['items'];
					}
				}
				$user_status='Order Booked';
				$all_salesorder=array();
				$all_salesorder['salesorderid'] = $orders[0]['orderid'];
				$all_salesorder['TWBSOID'] = $orders[0]['orderid'];
				$all_salesorder['contactid'] = $orders[0]['userid'];
				$all_salesorder['TWBContactId'] = $orders[0]['userid'];
				$all_salesorder['Service'] = $orders[0]['service'];
				$all_salesorder['locality'] = $orders[0]['locality'];
				$all_salesorder['address'] = $orders[0]['address'];
				$all_salesorder['pincode'] = $orders[0]['pincode'];
				//$all_salesorder['Service'] = $orders[0]['service'];
				if(!empty($orders[0]['pickup_date'])) {
					$all_salesorder['pickupdate'] = date('d M Y',strtotime($orders[0]['pickup_date']));
				} else {
					$all_salesorder['pickupdate'] = '';
				}
				$all_salesorder['pickuptime'] = $orders[0]['pickup_slot'];
				if(!empty($orders[0]['delivery_date'])) {
					$all_salesorder['deliverydate'] = date('d M Y',strtotime($orders[0]['delivery_date']));
				} else {
					$all_salesorder['deliverydate'] = '';
				}
				if($orders[0]['delivery_slot']== null){
					$all_salesorder['deliverytime'] = "";
				}else{
					$all_salesorder['deliverytime'] = $orders[0]['delivery_slot'];
				}
				
				$deladdressid = $orders[0]['del_address_id'];
				$this->load->library('mylib/UserLib');
				$address = $this->userlib->getAddressByAddressId($deladdressid);
				$all_salesorder['dellocality'] = $address[0]['landmark'];
				//$all_salesorder['dellatitude'] = $address[0]['latitude'];
				//$all_salesorder['dellongitude'] = $address[0]['longitude'];
				$all_salesorder['deladdress'] = $address[0]['address'];
				$all_salesorder['delpincode'] = $address[0]['pincode'];
				 
				if($orders[0]['status'] == 0) {
					$all_salesorder['status'] = 'Order Booking';
					$all_salesorder['status2'] = 'Order Booking';
					$user_status = 'Booked';
				} else if($orders[0]['status'] == 1) {
					if($orders[0]['pickup_rescheduled'] == 1) {
						$all_salesorder['status'] = 'Pickup Assignment';
						$all_salesorder['status2'] = 'Pickup Rescheduled';
						$user_status = 'Pickup Rescheduled';
					} else {
						if($orders[0]['pickup_attempted'] == 1) {
							$all_salesorder['status'] = 'Pickup Assignment';
							$all_salesorder['status2'] = 'Pickup Attempted / No Response';
							$user_status = 'Pickup Attempted / No Response';
						} else {
							$all_salesorder['status'] = 'Pickup Assignment';
							$all_salesorder['status2'] = 'Pickup Scheduled';
							$user_status = 'Pickup Scheduled';
						}
					}
				} else if($orders[0]['status'] == 2) {
					if($orders[0]['invoice_status'] == 1) {
						$all_salesorder['status'] = 'Pickup Completed';
						$all_salesorder['status2'] = 'Cleaned';
						$user_status = 'Cleaned';
					} else {
						$current_date = date('Y-m-d');
						if($current_date > $orders[0]['pickup_date']) {
							$all_salesorder['status'] = 'Pickup Completed';
							$all_salesorder['status2'] = 'Sent for Processing';
							$user_status = 'Sent for Processing';
						} else {
							$all_salesorder['status'] = 'Pickup Completed';
							$all_salesorder['status2'] = 'Picked';
							$user_status = 'Picked';
						}
					}
				} else if($orders[0]['status'] == 3) {
					if($orders[0]['delivery_rescheduled'] == 1) {
						$all_salesorder['status'] = 'Delivery Assignment';
						$all_salesorder['status2'] = 'Delivery Rescheduled';
						$user_status = 'Delivery Rescheduled';
					} else {
						if($orders[0]['delivery_attempted'] == 1) {
							$all_salesorder['status'] = 'Delivery Assignment';
							$all_salesorder['status2'] = 'Delivery Attempted / No Response';
							$user_status = 'Delivery Attempted / No Response';
						} else {
							$all_salesorder['status'] = 'Delivery Assignment';
							$all_salesorder['status2'] = 'Delivery Scheduled';
							$user_status = 'Delivery Scheduled';
						}
					}
				} else if($orders[0]['status'] == 4) {
					$all_salesorder['status'] = 'Amount Updation';
					$all_salesorder['status2'] = 'Amount Updation';
					$user_status = 'Delivered';
				} else if($orders[0]['status'] == 5) {
					$all_salesorder['status'] = 'Cancel Order';
					$all_salesorder['status2'] = 'Cancel Order';
					$user_status = 'Cancelled';
				}
				$all_salesorder['dryquantity'] = $drycleaning;
				$all_salesorder['wetquantity'] = $washniron;
				$all_salesorder['ironquantity'] = $ironing;
				$all_salesorder['total'] = $orders[0]['order_amount'];
				$all_salesorder['paidbill'] = $orders[0]['amount_received'];
				$all_salesorder['payableamount'] = $orders[0]['grand_total'];
				$all_salesorder['applieddiscount'] = $orders[0]['discount'];
				$all_salesorder['delivery_charge'] = $orders[0]['delivery_charge'];
				$all_salesorder['credits'] = 0;
				if(!empty($orders[0]['invoice_url']))
					$all_salesorder['invoice_link'] = base_url().$orders[0]['invoice_url'];
				else 
					$all_salesorder['invoice_link'] = '';
				$all_salesorder['user_status'] = $user_status;
				if($orders[0]['payment_status'] == 'Credit') {
					$all_salesorder['payment_done'] = "yes";
					$payment_message='Payment already done.';
				} else {
					$all_salesorder['payment_done'] = "no";
					$payment_message='Payment Pending.';
				}
				$all_salesorder['payment_message'] = $payment_message;
				$all_salesorder['payment_link'] = base_url().'paynow/'.$orders[0]['orderid'];
				if($orders[0]['invoice_status'] == 1) {
					if(!empty($orders[0]['invoice_url']))
						$all_salesorder['enable_invoice'] = "true";
					else 
						$all_salesorder['enable_invoice'] = "false";
				} else {
					$all_salesorder['enable_invoice'] = "false";
				}
				$all_salesorder['click_on_invoice_to_customer'] = 'true';
				$all_salesorder['adjustment'] = $orders[0]['adjustment'];
				if($orders[0]['pickup_boy'] == null)
				{
					$all_salesorder['pickup_boy'] = "";
					$all_salesorder['pickup_boy_mobile'] = "";
				}
				else{
				$all_salesorder['pickup_boy'] = $orders[0]['pickup_boy'];
				$all_salesorder['pickup_boy_mobile'] = $orders[0]['pickup_boy_mobile'];
				}
				if($orders[0]['del_boy'] == null)
				{
					$all_salesorder['del_boy'] = "";
					$all_salesorder['del_boy_mobile'] = "";
				}
				else{
				$all_salesorder['del_boy'] = $orders[0]['del_boy'];
				$all_salesorder['del_boy_mobile'] = $orders[0]['del_boy_mobile'];
				}
				$so[] = $all_salesorder;
				$resp['success'] = 'true';
				$resp['salesorder'] = $so;
			} else {
				$resp["success"] = "false";
				$resp["msg"] = "salesorderid not found";
			}
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "salesorderid is blank";
		}
		$this->response ($resp,200);
	}
	
	public function orderdetailold_post() {
		$orderid = $this->post('salesorderid');
		if($orderid != "") {
			$this->load->library('mylib/OrderLib');
			$orders = $this->orderlib->getOrderDetails($orderid);
			if(count($orders) > 0) {
				$citems = $this->orderlib->getOrderItemCount($orderid);
				$data = array();
				$washniron = 0;
				$drycleaning = 0;
				$ironing = 0;
				$other = 0;
				foreach ($citems as $citem) {
					if($citem['cat_id'] == 1) {
						$drycleaning = $citem['items'];
					} else if($citem['cat_id'] == 2) {
						$washniron = $citem['items'];
					} else if($citem['cat_id'] == 3) {
						$ironing = $citem['items'];
					} else {
						$other = $citem['items'];
					}
				}
				$user_status='Order Booked';
				$all_salesorder=array();
				$all_salesorder['salesorderid'] = $orders[0]['orderid'];
				$all_salesorder['TMLSOID'] = $orders[0]['orderid'];
				$all_salesorder['contactid'] = $orders[0]['userid'];
				$all_salesorder['TMLContactId'] = $orders[0]['userid'];
				$all_salesorder['Service'] = $orders[0]['service'];
				if(!empty($orders[0]['pickup_date'])) {
					$all_salesorder['pickupdate'] = date('d M Y',strtotime($orders[0]['pickup_date']));
				} else {
					$all_salesorder['pickupdate'] = '';
				}
				$all_salesorder['pickuptime'] = $orders[0]['pickup_slot'];
				if(!empty($orders[0]['delivery_date'])) {
					$all_salesorder['deliverydate'] = date('d M Y',strtotime($orders[0]['delivery_date']));
				} else {
					$all_salesorder['deliverydate'] = '';
				}
				$all_salesorder['deliverytime'] = $orders[0]['delivery_slot'];
				if($orders[0]['status'] == 0) {
					$all_salesorder['status'] = 'Order Booking';
					$all_salesorder['status2'] = 'Order Booking';
					$user_status = 'Order Booked';
				} else if($orders[0]['status'] == 1) {
					$all_salesorder['status'] = 'Order Booking';
					$all_salesorder['status2'] = 'Order Booking';
					$user_status = 'Order Booked';
				} else if($orders[0]['status'] == 2) {
					if($orders[0]['invoice_status'] == 1) {
						$all_salesorder['status'] = 'Pickup Completed';
						$all_salesorder['status2'] = 'Picked';
						$user_status = 'We got your clothes';
					} else {
						$current_date = date('Y-m-d');
						if($current_date > $orders[0]['pickup_date']) {
							$all_salesorder['status'] = 'Quantity Assignment';
							$all_salesorder['status2'] = 'Quantity Assignment';
							$user_status = 'Order is in process';
						} else {
							$all_salesorder['status'] = 'Pickup Completed';
							$all_salesorder['status2'] = 'Picked';
							$user_status = 'We got your clothes';
						}
					}
				} else if($orders[0]['status'] == 3) {
					if($orders[0]['delivery_rescheduled'] == 1) {
						$all_salesorder['status'] = 'Delivery Assignment';
						$all_salesorder['status2'] = 'Delivery Assignment';
						$user_status = 'Delivered Soon';
					} else {
						if($orders[0]['delivery_attempted'] == 1) {
							$all_salesorder['status'] = 'Delivery Assignment';
							$all_salesorder['status2'] = 'Delivery Assignment';
							$user_status = 'Delivered Soon';
						} else {
							$all_salesorder['status'] = 'Delivery Assignment';
							$all_salesorder['status2'] = 'Delivery Assignment';
							$user_status = 'Delivered Soon';
						}
					}
				} else if($orders[0]['status'] == 4) {
					$all_salesorder['status'] = 'Amount Updation';
					$all_salesorder['status2'] = 'Amount Updation';
					$user_status = 'Delivered';
				} else if($orders[0]['status'] == 5) {
					$all_salesorder['status'] = 'Cancel Order';
					$all_salesorder['status2'] = 'Cancel Order';
					$user_status = 'Cancelled';
				}
				$all_salesorder['dryquantity'] = $drycleaning;
				$all_salesorder['wetquantity'] = $washniron;
				$all_salesorder['ironquantity'] = $ironing;
				$all_salesorder['total'] = $orders[0]['grand_total'];
				$all_salesorder['paidbill'] = $orders[0]['amount_received'];
				$all_salesorder['payableamount'] = $orders[0]['grand_total'];
				$all_salesorder['applieddiscount'] = $orders[0]['discount'];
				$all_salesorder['delivery_charge'] = $orders[0]['delivery_charge'];
				$all_salesorder['credits'] = 0;
				if(!empty($orders[0]['invoice_url']))
					$all_salesorder['invoice_link'] = base_url().$orders[0]['invoice_url'];
				else
					$all_salesorder['invoice_link'] = '';
				$all_salesorder['user_status'] = $user_status;
				if($orders[0]['payment_status'] = 'Credit') {
					$all_salesorder['payment_done'] = "yes";
					$payment_message='Payment already done.';
				} else {
					$all_salesorder['payment_done'] = "no";
					$payment_message='Payment Pending.';
				}
				$all_salesorder['payment_message'] = $payment_message;
				$all_salesorder['payment_link'] = base_url().'paynow/'.$orders[0]['orderid'];
				if($orders[0]['invoice_status'] == 1) {
					if(!empty($orders[0]['invoice_url']))
						$all_salesorder['enable_invoice'] = "true";
					else
						$all_salesorder['enable_invoice'] = "false";
				} else {
					$all_salesorder['enable_invoice'] = "false";
				}
				$all_salesorder['click_on_invoice_to_customer'] = 'true';
				$all_salesorder['adjustment'] = $orders[0]['adjustment'];
				$all_salesorder['pickup_boy'] = $orders[0]['pickup_boy'];
				$all_salesorder['pickup_boy_mobile'] = $orders[0]['pickup_boy_mobile'];
				$all_salesorder['del_boy'] = $orders[0]['del_boy'];
				$all_salesorder['del_boy_mobile'] = $orders[0]['del_boy_mobile'];
	
				$so[] = $all_salesorder;
				$resp['success'] = 'true';
				$resp['salesorder'] = $so;
			} else {
				$resp["success"] = "false";
				$resp["msg"] = "salesorderid not found";
			}
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "salesorderid is blank";
		}
		echo json_encode($resp);
	}
	
	public function cancelorder_post() {
		$orderid = $this->post('salesorderid');
		$this->load->library('mylib/OrderLib');
		if($orderid == "")
		{
			$resp["success"] = "false";
			$resp["msg"] = "Salesorder is blank";
		}
		else
		{
			$orders = $this->orderlib->getOrderDetails($orderid);
			if(count($orders)) {
				if($orders[0]['status'] == 5)
				{
					$resp["success"] = "false";
					$resp["msg"] = "Your order has been already cancelled.";
				} else if ($orders[0]['status'] == 0 || $orders[0]['status'] == 1) {
					$this->load->library('mylib/OrderLib');
					$orderdata = array();
					$orderdata['orderid'] = $orderid;
					$orderdata['status'] = 5;
					$this->orderlib->updateOrder($orderdata);
					$logs = array();
					$logs['orderid'] = $orderid;
					$logs['comment'] = 'Order Cancelled By User';
					$logs['created_date'] = date('Y-m-d H:i:s');
					$logs['created_by'] = 1;
					$this->orderlib->addOrderLogs($logs);
					$resp["success"] = "true";
					$resp["msg"] = "Salesorder cancelled successfully";
				} else {
					$resp["success"] = "false";
					$resp["msg"] = "Cannot cancel order once it has been picked";
				}
			} else {
				$resp["success"] = "false";
				$resp["msg"] = "Salesorder not found";
			}
		}
		$this->response ($resp,200);
	}
	
	public function cancelorderold_post() {
		$orderid = $this->post('salesorderid');
		$this->load->library('mylib/OrderLib');
		if($orderid == "")
		{
			$resp["success"] = "false";
			$resp["msg"] = "Salesorder is blank";
		}
		else
		{
			$orders = $this->orderlib->getOrderDetails($orderid);
			if(count($orders)) {
				if($orders[0]['status'] == 5)
				{
					$resp["success"] = "false";
					$resp["msg"] = "Your order has been already cancelled.";
				} else if ($orders[0]['status'] == 0 || $orders[0]['status'] == 1) {
					$this->load->library('mylib/OrderLib');
					$orderdata = array();
					$orderdata['orderid'] = $orderid;
					$orderdata['status'] = 5;
					$this->orderlib->updateOrder($orderdata);
					$logs = array();
					$logs['orderid'] = $orderid;
					$logs['comment'] = 'Order Cancelled By User';
					$logs['created_date'] = date('Y-m-d H:i:s');
					$logs['created_by'] = 1;
					$this->orderlib->addOrderLogs($logs);
					$resp["success"] = "true";
					$resp["msg"] = "Salesorder cancelled successfully";
				} else {
					$resp["success"] = "false";
					$resp["msg"] = "Cannot cancel order once it has been picked";
				}
			} else {
				$resp["success"] = "false";
				$resp["msg"] = "Salesorder not found";
			}
		}
		echo json_encode($resp);
	}
	
	public function requestpayment_post() {
		$orderid = $this->post('tmlorderid');
		$response = array();
		$this->load->library('mylib/OrderLib');
		$orders = $this->orderlib->getOrderDetails($orderid);
		$data = array();
		$data['name'] = $orders[0]['name'];
		$data['bill_amount'] = $orders[0]['grand_total'];
		$data['invoice_url'] = $orders[0]['invoice_url'];
		$data['payment_url'] = $payment_url;
		$data['email'] = $orders[0]['email'];
		$data['mobile'] = $orders[0]['mobile'];
		$this->orderlib->sendInvoiceEmail($data);
		$this->orderlib->sendInvoiceSMS($data);
		$response['status'] = 1;
		$response['msg'] = "Payment request sent successfully.";
		echo json_encode($response);
	}
	
	
	public function schedulePickup_post() {
		$pickuptime = $this->post("pickup_time");
		$pickupdate = $this->post("pickup_date");
		$email = $this->post("email");
		//$couponcode = $this->post("offercode");
		//$option = $this->post("option");
		$addid = $this->post("address_id");
		$deladdid = $this->post("del_address_id");
		$laundry_service = $this->post("service");
		if($pickuptime!="" && $pickupdate!="" && $email!="") {
			$this->load->library('mylib/UserLib');
			$profile = $this->userlib->getUserByEmail($email);
			$address = $this->userlib->getAddressByAddressId($addid);
			if(count($profile) > 0) {
				$response = array();
				$params = array();
				$params['userid'] = $profile[0]['id'];
				$params['areaid'] = $profile[0]['areaid'];
				$params['name'] = $profile[0]['name'];
				$params['email'] = $profile[0]['email'];
				$params['mobile'] = $profile[0]['mobile'];
				$params['locality'] = $address[0]['landmark'];
				$params['latitude'] = $address[0]['latitude'];
				$params['longitude'] = $address[0]['longitude'];
				$params['address'] = $address[0]['address'];
				/*if($option == 'promocode') {
					if(!empty($couponcode))
						$params['coupon_code'] = $couponcode;
				} else {
					if($option == "credits")
						$params['wallet_discount'] = 1;
				} */
				$params['service'] = $laundry_service;
				if(!empty($pickupdate))
					$params['pickup_date'] = date('Y-m-d',strtotime($pickupdate));
				else
					$params['pickup_date'] = date('Y-m-d');
				$pickup_times = explode("-",$pickuptime);
				$pstart_time = date('h A',strtotime($pickup_times[0]));
				$pend_time = date('h A',strtotime($pickup_times[1]));
				$pickuptime = $pstart_time.' - '.$pend_time;
				$del_date = date('Y-m-d',strtotime('+48 hours',strtotime($params['pickup_date'])));
				$day = date('D',strtotime($del_date));
				if($day == 'Wed') {
					$del_date = date('Y-m-d',strtotime('+24 hours',strtotime($del_date)));
				}
				$params['pickup_slot'] = $pickuptime;
				$params['delivery_date'] = date('Y-m-d',strtotime('+72 hours',strtotime($params['pickup_date'])));
				$params['tml_delivery_date'] = $del_date;
				$params['del_address_id'] = $deladdid;
				$params['ordered_on'] = date('Y-m-d H:i:s');
				$params['source'] = 1;
				if(empty($profile[0]['latitude'])) {
					$latlong = array();
					$latlong['id'] = $profile[0]['id'];
					$latlong['latitude'] = $params['latitude'];
					$latlong['longitude'] = $params['longitude'];
					$latlong['landmark'] = $params['locality'];
					$this->userlib->updateLatLong($latlong);
				}
				$this->load->library('mylib/OrderLib');
				$orderid = $this->orderlib->addOrderapp($params);
				/*$this->load->library('mylib/OldTml');
				$tmlpram = array();
				$tmlpram['pickup_time'] = $params['pickup_slot'];
				$tmlpram['pickup_date'] = $params['pickup_date'];
				$tmlpram['email'] = $params['email'];
				$tmlpram['offercode'] = $couponcode;
				$tmlpram['option'] = $option;
				$tmlpram['service'] = $params['service'];
				$this->oldtml->addToVtiger($tmlpram);*/
				if($orderid > 0) {
					$params['orderid'] = $orderid;
					//$this->orderlib->addToDack($params);
					//$this->orderlib->sendBookingEmail($params);
					//$this->orderlib->sendBookingNotification($params['userid']);
					//$this->orderlib->notifyMe($params);
					//$this->orderlib->sendBookingSMS($params);
					$oupdate = array();
					$oupdate['orderid'] = $orderid;
					$oupdate['ordercode'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($orderid, 10, 36)) ;
					$this->orderlib->updateOrder($oupdate);
					$resp['orderid'] = $orderid;
					$resp['deliverydate'] = date('d M Y',strtotime($params['delivery_date']));
					$resp['deliverytime'] = "";
					$resp["success"] = "true";
					$resp["msg"] = "salesorder created successfully";
				} else {
					$resp["success"] = "false";
					$resp["msg"] = "Invalid data";
				}
			} else {
				$resp["success"] = "false";
				$resp["msg"] = "no contact exist for this email id";
			}
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "insufficient data";
		}
		$this->response ($resp,200);
		//echo json_encode($resp);
	}
	
	public function scheduleorderdetail_post() {
		$orderid = $this->post('salesorderid');
		if($orderid != "") {
			$this->load->library('mylib/OrderLib');
			$orders = $this->orderlib->getOrderDetails($orderid);
			//print_r($orders);
			if(count($orders) > 0) {
				$citems = $this->orderlib->getOrderItemCount($orderid);
				$data = array();
				$washniron = 0;
				$drycleaning = 0;
				$ironing = 0;
				$other = 0;
				foreach ($citems as $citem) {
					if($citem['cat_id'] == 1) {
						$drycleaning = $citem['items'];
					} else if($citem['cat_id'] == 2) {
						$washniron = $citem['items'];
					} else if($citem['cat_id'] == 3) {
						$ironing = $citem['items'];
					} else {
						$other = $citem['items'];
					}
				}
				$user_status='Order Booked';
				$all_salesorder=array();
				$all_salesorder['salesorderid'] = $orders[0]['orderid'];
				//$all_salesorder['TMLSOID'] = $orders[0]['orderid'];
				$all_salesorder['contactid'] = $orders[0]['userid'];
				//$all_salesorder['TMLContactId'] = $orders[0]['userid'];
				$all_salesorder['address'] = $orders[0]['address'];
				$all_salesorder['locality'] = $orders[0]['locality'];
				$all_salesorder['Service'] = $orders[0]['service'];
				if(!empty($orders[0]['pickup_date'])) {
					$all_salesorder['pickupdate'] = date('d M Y',strtotime($orders[0]['pickup_date']));
				} else {
					$all_salesorder['pickupdate'] = '';
				}
				$all_salesorder['pickuptime'] = $orders[0]['pickup_slot'];
				if(!empty($orders[0]['delivery_date'])) {
					$all_salesorder['deliverydate'] = date('d M Y',strtotime($orders[0]['delivery_date']));
				} else {
					$all_salesorder['deliverydate'] = '';
				}
				$all_salesorder['deliverytime'] = $orders[0]['delivery_slot'];
				
				$deladdressid = $orders[0]['del_address_id'];
				$this->load->library('mylib/UserLib');
				$address = $this->userlib->getAddressByAddressId($deladdressid);
				$all_salesorder['dellocality'] = $address[0]['landmark'];
				//$all_salesorder['dellatitude'] = $address[0]['latitude'];
				//$all_salesorder['dellongitude'] = $address[0]['longitude'];
				$all_salesorder['deladdress'] = $address[0]['address'];
				$all_salesorder['delpincode'] = $address[0]['pincode'];
				
				if($orders[0]['status'] == 0) {
					$all_salesorder['status'] = 'Schedule Pickup';
					//$all_salesorder['status2'] = 'Order Booking';
					$user_status = 'Booked';
				} else if($orders[0]['status'] == 1) {
					if($orders[0]['pickup_rescheduled'] == 1) {
						$all_salesorder['status'] = 'Pickup Assignment';
						$all_salesorder['status2'] = 'Pickup Rescheduled';
						$user_status = 'Pickup Rescheduled';
					} else {
						if($orders[0]['pickup_attempted'] == 1) {
							$all_salesorder['status'] = 'Pickup Assignment';
							$all_salesorder['status2'] = 'Pickup Attempted / No Response';
							$user_status = 'Pickup Attempted / No Response';
						} else {
							$all_salesorder['status'] = 'Pickup Assignment';
							$all_salesorder['status2'] = 'Pickup Scheduled';
							$user_status = 'Pickup Scheduled';
						}
					}
				} else if($orders[0]['status'] == 2) {
					if($orders[0]['invoice_status'] == 1) {
						$all_salesorder['status'] = 'Pickup Completed';
						$all_salesorder['status2'] = 'Cleaned';
						$user_status = 'Cleaned';
					} else {
						$current_date = date('Y-m-d');
						if($current_date > $orders[0]['pickup_date']) {
							$all_salesorder['status'] = 'Pickup Completed';
							$all_salesorder['status2'] = 'Sent for Processing';
							$user_status = 'Sent for Processing';
						} else {
							$all_salesorder['status'] = 'Pickup Completed';
							$all_salesorder['status2'] = 'Picked';
							$user_status = 'Picked';
						}
					}
				} else if($orders[0]['status'] == 3) {
					if($orders[0]['delivery_rescheduled'] == 1) {
						$all_salesorder['status'] = 'Delivery Assignment';
						$all_salesorder['status2'] = 'Delivery Rescheduled';
						$user_status = 'Delivery Rescheduled';
					} else {
						if($orders[0]['delivery_attempted'] == 1) {
							$all_salesorder['status'] = 'Delivery Assignment';
							$all_salesorder['status2'] = 'Delivery Attempted / No Response';
							$user_status = 'Delivery Attempted / No Response';
						} else {
							$all_salesorder['status'] = 'Delivery Assignment';
							$all_salesorder['status2'] = 'Delivery Scheduled';
							$user_status = 'Delivery Scheduled';
						}
					}
				} else if($orders[0]['status'] == 4) {
					$all_salesorder['status'] = 'Amount Updation';
					$all_salesorder['status2'] = 'Amount Updation';
					$user_status = 'Delivered';
				} else if($orders[0]['status'] == 5) {
					$all_salesorder['status'] = 'Cancel Order';
					$all_salesorder['status2'] = 'Cancel Order';
					$user_status = 'Cancelled';
				}
				//$all_salesorder['dryquantity'] = $drycleaning;
				//$all_salesorder['wetquantity'] = $washniron;
				//$all_salesorder['ironquantity'] = $ironing;
				$all_salesorder['total'] = $orders[0]['order_amount'];
				$all_salesorder['paidbill'] = $orders[0]['amount_received'];
				$all_salesorder['payableamount'] = $orders[0]['grand_total'];
				$all_salesorder['applieddiscount'] = $orders[0]['discount'];
				$all_salesorder['delivery_charge'] = $orders[0]['delivery_charge'];
				$all_salesorder['credits'] = 0;
				if(!empty($orders[0]['invoice_url']))
					$all_salesorder['invoice_link'] = base_url().$orders[0]['invoice_url'];
				else
					$all_salesorder['invoice_link'] = '';
				$all_salesorder['user_status'] = $user_status;
				if($orders[0]['payment_status'] == 'Credit') {
					$all_salesorder['payment_done'] = "yes";
					$payment_message='Payment already done.';
				} else {
					$all_salesorder['payment_done'] = "no";
					$payment_message='Payment Pending.';
				}
				$all_salesorder['payment_message'] = $payment_message;
				$all_salesorder['payment_link'] = base_url().'paynow/'.$orders[0]['orderid'];
				if($orders[0]['invoice_status'] == 1) {
					if(!empty($orders[0]['invoice_url']))
						$all_salesorder['enable_invoice'] = "true";
					else
						$all_salesorder['enable_invoice'] = "false";
				} else {
					$all_salesorder['enable_invoice'] = "false";
				}
				$all_salesorder['click_on_invoice_to_customer'] = 'true';
				$all_salesorder['adjustment'] = $orders[0]['adjustment'];
				$all_salesorder['pickup_boy'] = $orders[0]['pickup_boy'];
				$all_salesorder['pickup_boy_mobile'] = $orders[0]['pickup_boy_mobile'];
				$all_salesorder['del_boy'] = $orders[0]['del_boy'];
				$all_salesorder['del_boy_mobile'] = $orders[0]['del_boy_mobile'];  
	
				$so[] = $all_salesorder;
				$resp['success'] = 'true';
				$resp['salesorder'] = $so;
			} else {
				$resp["success"] = "false";
				$resp["msg"] = "salesorderid not found";
			}
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "salesorderid is blank";
		}
		$this->response ($resp,200);
	}
	
	
	public function updateschedulePickup_post() {
		$order_id = $this->post("salesorderid");
		$pickuptime = $this->post("pickup_time");
		$pickupdate = $this->post("pickup_date");
		$email = $this->post("email");
		//$couponcode = $this->post("offercode");
		//$option = $this->post("option");
		$addid = $this->post("address_id");
		$deladdid = $this->post("del_address_id");
		$laundry_service = $this->post("service");
		if($pickuptime!="" && $pickupdate!="" && $email!="") {
			$this->load->library('mylib/UserLib');
			$profile = $this->userlib->getUserByEmail($email);
			$address = $this->userlib->getAddressByAddressId($addid);
			if(count($profile) > 0) {
				$response = array();
				$params = array();
				$params['orderid'] = $order_id;
				$params['userid'] = $profile[0]['id'];
				$params['areaid'] = $profile[0]['areaid'];
				$params['name'] = $profile[0]['name'];
				$params['email'] = $profile[0]['email'];
				$params['mobile'] = $profile[0]['mobile'];
				$params['locality'] = $address[0]['landmark'];
				$params['latitude'] = $address[0]['latitude'];
				$params['longitude'] = $address[0]['longitude'];
				$params['address'] = $address[0]['address'];
				/*if($option == 'promocode') {
				 if(!empty($couponcode))
				 	$params['coupon_code'] = $couponcode;
				 	} else {
						if($option == "credits")
							$params['wallet_discount'] = 1;
				} */
				$params['service'] = $laundry_service;
				if(!empty($pickupdate))
					$params['pickup_date'] = date('Y-m-d',strtotime($pickupdate));
				else
					$params['pickup_date'] = date('Y-m-d');
				$pickup_times = explode("-",$pickuptime);
				$pstart_time = date('h A',strtotime($pickup_times[0]));
				$pend_time = date('h A',strtotime($pickup_times[1]));
				$pickuptime = $pstart_time.' - '.$pend_time;
				$del_date = date('Y-m-d',strtotime('+48 hours',strtotime($params['pickup_date'])));
				$day = date('D',strtotime($del_date));
				if($day == 'Wed') {
					$del_date = date('Y-m-d',strtotime('+24 hours',strtotime($del_date)));
				}
				$params['pickup_slot'] = $pickuptime;
				$params['delivery_date'] = date('Y-m-d',strtotime('+72 hours',strtotime($params['pickup_date'])));
				$params['tml_delivery_date'] = $del_date;
				$params['del_address_id'] = $deladdid;
				$params['ordered_on'] = date('Y-m-d H:i:s');
				$params['source'] = 1;
				if(empty($profile[0]['latitude'])) {
					$latlong = array();
					$latlong['id'] = $profile[0]['id'];
					$latlong['latitude'] = $params['latitude'];
					$latlong['longitude'] = $params['longitude'];
					$latlong['landmark'] = $params['locality'];
					$this->userlib->updateLatLong($latlong);
				}
				$this->load->library('mylib/OrderLib');
				$orderid = $this->orderlib->updateOrderapp($params);
				/*$this->load->library('mylib/OldTml');
					$tmlpram = array();
					$tmlpram['pickup_time'] = $params['pickup_slot'];
					$tmlpram['pickup_date'] = $params['pickup_date'];
					$tmlpram['email'] = $params['email'];
					$tmlpram['offercode'] = $couponcode;
					$tmlpram['option'] = $option;
					$tmlpram['service'] = $params['service'];
				$this->oldtml->addToVtiger($tmlpram);*/
				if($order_id > 0) {
					$params['orderid'] = $order_id;
					//$this->orderlib->addToDack($params);
					//$this->orderlib->sendBookingEmail($params);
					//$this->orderlib->sendBookingNotification($params['userid']);
					//$this->orderlib->notifyMe($params);					
					//$this->orderlib->sendBookingSMS($params);
					$oupdate = array();
					$oupdate['orderid'] = $order_id;
					$oupdate['ordercode'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($orderid, 10, 36)) ;
					$this->orderlib->updateOrder($oupdate);
					$resp['orderid'] = $order_id;
					$resp["success"] = "true";
					$resp["msg"] = "order updated successfully";
				} else {
					$resp["success"] = "false";
					$resp["msg"] = "Invalid data";
				}
			} else {
				$resp["success"] = "false";
				$resp["msg"] = "no contact exist for this email id";
			}
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "insufficient data";
		}
		$this->response ($resp,200);
	}
	
	public function confirmOrder_post() {
		$order_id = $this->post("salesorderid");
		$pickuptime = $this->post("pickup_time");
		$pickupdate = $this->post("pickup_date");
		$email = $this->post("email");
		$couponcode = $this->post("promo_code");
		//$option = $this->post("option");
		$addid = $this->post("address_id");
		$deladdid = $this->post("del_address_id");
		$laundry_service = $this->post("service");
		if($pickuptime!="" && $pickupdate!="" && $email!="") {
			$this->load->library('mylib/UserLib');
			$profile = $this->userlib->getUserByEmail($email);
			$address = $this->userlib->getAddressByAddressId($addid);
			if(count($profile) > 0) {
				$response = array();
				$params = array();
				$params['orderid'] = $order_id;
				$params['userid'] = $profile[0]['id'];
				$params['areaid'] = $profile[0]['areaid'];
				$params['name'] = $profile[0]['name'];
				$params['email'] = $profile[0]['email'];
				$params['mobile'] = $profile[0]['mobile'];
				$params['locality'] = $address[0]['landmark'];
				$params['latitude'] = $address[0]['latitude'];
				$params['longitude'] = $address[0]['longitude'];
				$params['address'] = $address[0]['address'];
				
				//$name = explode(" ",$params['name']);
				
				//$params['fname'] = $name[0];
				//$params['lname'] = $name[1];
				
				
				//if($option == 'promocode') {
				// if(!empty($couponcode))
				 //	$params['coupon_code'] = $couponcode;
				 // 	} else {
				 //	if($option == "credits")
				 //	$params['wallet_discount'] = 1;
				 //}
				 
				 if(!empty($couponcode)) {
				 	$params['coupon_code'] = $couponcode;
				 $coupon = array();
				 $coupon['coupon_code'] = $couponcode;
				 $coupon['order_date'] = date('Y-m-d',strtotime($pickupdate));
				 $this->load->library('mylib/General');
				 $coupondata = $this->general->getCouponByCode($coupon);
				 //print_r($coupondata);
				 if(count($coupondata) > 0){
				 
				 $params['service'] = $laundry_service;
				 if(!empty($pickupdate))
				 	$params['pickup_date'] = date('Y-m-d',strtotime($pickupdate));
				 else
				 	$params['pickup_date'] = date('Y-m-d');
				 $pickup_times = explode("-",$pickuptime);
				 $pstart_time = date('h A',strtotime($pickup_times[0]));
				 $pend_time = date('h A',strtotime($pickup_times[1]));
				 $pickuptime = $pstart_time.' - '.$pend_time;
				 $del_date = date('Y-m-d',strtotime('+48 hours',strtotime($params['pickup_date'])));
				 $day = date('D',strtotime($del_date));
				 if($day == 'Wed') {
				 	$del_date = date('Y-m-d',strtotime('+24 hours',strtotime($del_date)));
				 }
				 $params['pickup_slot'] = $pickuptime;
				 $params['delivery_date'] = date('Y-m-d',strtotime('+72 hours',strtotime($params['pickup_date'])));
				 $params['tml_delivery_date'] = $del_date;
				 $params['del_address_id'] = $deladdid;
				 $params['ordered_on'] = date('Y-m-d H:i:s');
				 $params['source'] = 1;
				 if(empty($profile[0]['latitude'])) {
				 	$latlong = array();
				 	$latlong['id'] = $profile[0]['id'];
				 	$latlong['latitude'] = $params['latitude'];
				 	$latlong['longitude'] = $params['longitude'];
				 	$latlong['landmark'] = $params['locality'];
				 	$this->userlib->updateLatLong($latlong);
				 }
				 $this->load->library('mylib/OrderLib');
				 $orderid = $this->orderlib->updateOrder($params);
				 
				 if($order_id > 0) {
				 	$params['orderid'] = $order_id;
				 	//$this->orderlib->addToDack($params);
				 	$this->orderlib->sendBookingEmail($params);
				 	//$this->orderlib->sendConfirmOrderNotification($params['userid'],$order_id);
				 	//$this->orderlib->notifyMe($params);
				 	$this->orderlib->sendBookingSMS($params);
				 	$oupdate = array();
				 	$oupdate['orderid'] = $order_id;
				 	$oupdate['ordercode'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($orderid, 10, 36)) ;
				 	$this->orderlib->updateOrder($oupdate);
				 	$resp['orderid'] = $order_id;
				 	$resp["success"] = "true";
				 	$resp["msg"] = "order confirm successfully";
				 } else {
				 	$resp["success"] = "false";
				 	$resp["msg"] = "Invalid data";
				 }
				 
				  } else {
				  $resp["success"] = "invalid";
				  $resp["msg"] = "Coupon code Invalid";
				  } 
			}else{
				$params['service'] = $laundry_service;
				if(!empty($pickupdate))
					$params['pickup_date'] = date('Y-m-d',strtotime($pickupdate));
				else
					$params['pickup_date'] = date('Y-m-d');
				$pickup_times = explode("-",$pickuptime);
				$pstart_time = date('h A',strtotime($pickup_times[0]));
				$pend_time = date('h A',strtotime($pickup_times[1]));
				$pickuptime = $pstart_time.' - '.$pend_time;
				$del_date = date('Y-m-d',strtotime('+48 hours',strtotime($params['pickup_date'])));
				$day = date('D',strtotime($del_date));
				if($day == 'Wed') {
					$del_date = date('Y-m-d',strtotime('+24 hours',strtotime($del_date)));
				}
				$params['pickup_slot'] = $pickuptime;
				$params['delivery_date'] = date('Y-m-d',strtotime('+72 hours',strtotime($params['pickup_date'])));
				$params['tml_delivery_date'] = $del_date;
				$params['ordered_on'] = date('Y-m-d H:i:s');
				$params['source'] = 1;
				if(empty($profile[0]['latitude'])) {
					$latlong = array();
					$latlong['id'] = $profile[0]['id'];
					$latlong['latitude'] = $params['latitude'];
					$latlong['longitude'] = $params['longitude'];
					$latlong['landmark'] = $params['locality'];
					$this->userlib->updateLatLong($latlong);
				}
				$this->load->library('mylib/OrderLib');
				$orderid = $this->orderlib->updateOrder($params);
				/*$this->load->library('mylib/OldTml');
				 $tmlpram = array();
				 $tmlpram['pickup_time'] = $params['pickup_slot'];
				 $tmlpram['pickup_date'] = $params['pickup_date'];
				 $tmlpram['email'] = $params['email'];
				 $tmlpram['offercode'] = $couponcode;
				 $tmlpram['option'] = $option;
				 $tmlpram['service'] = $params['service'];
				$this->oldtml->addToVtiger($tmlpram);*/
				if($order_id > 0) {
					$params['orderid'] = $order_id;
					//$this->orderlib->addToDack($params);
					$this->orderlib->sendBookingEmail($params);
					//$this->orderlib->sendConfirmOrderNotification($params['userid'],$order_id);
					//$this->orderlib->notifyMe($params);
					$this->orderlib->sendBookingSMS($params);
					$oupdate = array();
					$oupdate['orderid'] = $order_id;
					$oupdate['ordercode'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($orderid, 10, 36)) ;
					$this->orderlib->updateOrder($oupdate);
					$resp['orderid'] = $order_id;
					$resp["success"] = "true";
					$resp["msg"] = "order confirm successfully";
				} else {
					$resp["success"] = "false";
					$resp["msg"] = "Invalid data";
				}
			 }
			} else {
				$resp["success"] = "false";
				$resp["msg"] = "no contact exist for this email id";
			}
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "insufficient data";
		}
		$this->response ($resp,200);
	}
	
	public function updatescheduleDelivery_post() {
		$order_id = $this->post("salesorderid");
		$deliverytime = $this->post("delivery_time");
		$deliverydate = $this->post("delivery_date");
		$email = $this->post("email");
		$type = $this->post("type");
		
		if($deliverytime!="" && $deliverydate!="" && $email!="") {
			$this->load->library('mylib/UserLib');
			$profile = $this->userlib->getUserByEmail($email);
			if(count($profile) > 0) {
				$response = array();
				$params = array();
				$params['orderid'] = $order_id;
				$params['userid'] = $profile[0]['id'];
				$params['areaid'] = $profile[0]['areaid'];
				$params['name'] = $profile[0]['name'];
				$params['email'] = $profile[0]['email'];
				$params['mobile'] = $profile[0]['mobile'];
				
				if($type == 'deliver') {
					$params['delivery_date'] = date('Y-m-d',strtotime($deliverydate));
					$params['delivery_slot'] = $deliverytime;
				}else{
					$params['pickup_date'] = date('Y-m-d',strtotime($deliverydate));
					$params['pickup_slot'] = $deliverytime;
				} 
				
				$this->load->library('mylib/OrderLib');
				$orderid = $this->orderlib->updateOrderapp($params);
			
				if($order_id > 0) {
					$params['orderid'] = $order_id;
					//$this->orderlib->sendBookingEmail($params);
					//$this->orderlib->notifyMe($params);
					//$this->orderlib->sendBookingSMS($params);
					//$oupdate = array();
					//$oupdate['orderid'] = $order_id;
					//$oupdate['ordercode'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($orderid, 10, 36)) ;
					//$this->orderlib->updateOrder($oupdate);
					$resp['orderid'] = $order_id;
					$resp["success"] = "true";
					$resp["msg"] = "order updated successfully";
				} else {
					$resp["success"] = "false";
					$resp["msg"] = "Invalid data";
				}
			} else {
				$resp["success"] = "false";
				$resp["msg"] = "no contact exist for this email id";
			}
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "insufficient data";
		}
		$this->response ($resp,200);
	}
	
	public function latestorderdetail_post() {
		$userid = $this->post('userid');
		if($userid != "") {
			$this->load->library('mylib/OrderLib');
			$orders = $this->orderlib->getlatestOrderDetails($userid);
			//print_r($orders);
			if(count($orders) > 0) {
				$citems = $this->orderlib->getOrderItemCount($orders[0]['orderid']);
				$data = array();
				$washniron = 0;
				$drycleaning = 0;
				$ironing = 0;
				$other = 0;
				foreach ($citems as $citem) {
					if($citem['cat_id'] == 1) {
						$drycleaning = $citem['items'];
					} else if($citem['cat_id'] == 2) {
						$washniron = $citem['items'];
					} else if($citem['cat_id'] == 3) {
						$ironing = $citem['items'];
					} else {
						$other = $citem['items'];
					}
				}
				$user_status='Order Booked';
				$all_salesorder=array();
				$all_salesorder['salesorderid'] = $orders[0]['orderid'];
				//$all_salesorder['TMLSOID'] = $orders[0]['orderid'];
				$all_salesorder['contactid'] = $orders[0]['userid'];
				//$all_salesorder['TMLContactId'] = $orders[0]['userid'];
				$all_salesorder['address'] = $orders[0]['address'];
				$all_salesorder['locality'] = $orders[0]['locality'];
				$all_salesorder['Service'] = $orders[0]['service'];
				if(!empty($orders[0]['pickup_date'])) {
					$all_salesorder['pickupdate'] = date('d M Y',strtotime($orders[0]['pickup_date']));
				} else {
					$all_salesorder['pickupdate'] = '';
				}
				$all_salesorder['pickuptime'] = $orders[0]['pickup_slot'];
				/*if(!empty($orders[0]['delivery_date'])) {
				 $all_salesorder['deliverydate'] = date('d M Y',strtotime($orders[0]['delivery_date']));
					} else {
					$all_salesorder['deliverydate'] = '';
				}*/
				//$all_salesorder['deliverytime'] = $orders[0]['delivery_slot'];
				if($orders[0]['status'] == 0) {
					$all_salesorder['status'] = 'Schedule Pickup';
					//$all_salesorder['status2'] = 'Order Booking';
					$user_status = 'Booked';
				} else if($orders[0]['status'] == 1) {
					if($orders[0]['pickup_rescheduled'] == 1) {
						$all_salesorder['status'] = 'Pickup Assignment';
						$all_salesorder['status2'] = 'Pickup Rescheduled';
						$user_status = 'Pickup Rescheduled';
					} else {
						if($orders[0]['pickup_attempted'] == 1) {
							$all_salesorder['status'] = 'Pickup Assignment';
							$all_salesorder['status2'] = 'Pickup Attempted / No Response';
							$user_status = 'Pickup Attempted / No Response';
						} else {
							$all_salesorder['status'] = 'Pickup Assignment';
							$all_salesorder['status2'] = 'Pickup Scheduled';
							$user_status = 'Pickup Scheduled';
						}
					}
				} else if($orders[0]['status'] == 2) {
					if($orders[0]['invoice_status'] == 1) {
						$all_salesorder['status'] = 'Pickup Completed';
						$all_salesorder['status2'] = 'Cleaned';
						$user_status = 'Cleaned';
					} else {
						$current_date = date('Y-m-d');
						if($current_date > $orders[0]['pickup_date']) {
							$all_salesorder['status'] = 'Pickup Completed';
							$all_salesorder['status2'] = 'Sent for Processing';
							$user_status = 'Sent for Processing';
						} else {
							$all_salesorder['status'] = 'Pickup Completed';
							$all_salesorder['status2'] = 'Picked';
							$user_status = 'Picked';
						}
					}
				} else if($orders[0]['status'] == 3) {
					if($orders[0]['delivery_rescheduled'] == 1) {
						$all_salesorder['status'] = 'Delivery Assignment';
						$all_salesorder['status2'] = 'Delivery Rescheduled';
						$user_status = 'Delivery Rescheduled';
					} else {
						if($orders[0]['delivery_attempted'] == 1) {
							$all_salesorder['status'] = 'Delivery Assignment';
							$all_salesorder['status2'] = 'Delivery Attempted / No Response';
							$user_status = 'Delivery Attempted / No Response';
						} else {
							$all_salesorder['status'] = 'Delivery Assignment';
							$all_salesorder['status2'] = 'Delivery Scheduled';
							$user_status = 'Delivery Scheduled';
						}
					}
				} else if($orders[0]['status'] == 4) {
					$all_salesorder['status'] = 'Amount Updation';
					$all_salesorder['status2'] = 'Amount Updation';
					$user_status = 'Delivered';
				} else if($orders[0]['status'] == 5) {
					$all_salesorder['status'] = 'Cancel Order';
					$all_salesorder['status2'] = 'Cancel Order';
					$user_status = 'Cancelled';
				}
				//$all_salesorder['dryquantity'] = $drycleaning;
				//$all_salesorder['wetquantity'] = $washniron;
				//$all_salesorder['ironquantity'] = $ironing;
				//$all_salesorder['total'] = $orders[0]['order_amount'];
				//$all_salesorder['paidbill'] = $orders[0]['amount_received'];
				//$all_salesorder['payableamount'] = $orders[0]['grand_total'];
				//$all_salesorder['applieddiscount'] = $orders[0]['discount'];
				//$all_salesorder['delivery_charge'] = $orders[0]['delivery_charge'];
				/*	$all_salesorder['credits'] = 0;
					if(!empty($orders[0]['invoice_url']))
						$all_salesorder['invoice_link'] = base_url().$orders[0]['invoice_url'];
						else
							$all_salesorder['invoice_link'] = '';
							$all_salesorder['user_status'] = $user_status;
							if($orders[0]['payment_status'] == 'Credit') {
							$all_salesorder['payment_done'] = "yes";
							$payment_message='Payment already done.';
							} else {
							$all_salesorder['payment_done'] = "no";
							$payment_message='Payment Pending.';
							}
							$all_salesorder['payment_message'] = $payment_message;
							$all_salesorder['payment_link'] = base_url().'paynow/'.$orders[0]['orderid'];
							if($orders[0]['invoice_status'] == 1) {
							if(!empty($orders[0]['invoice_url']))
								$all_salesorder['enable_invoice'] = "true";
								else
									$all_salesorder['enable_invoice'] = "false";
									} else {
									$all_salesorder['enable_invoice'] = "false";
									}
									$all_salesorder['click_on_invoice_to_customer'] = 'true';
									$all_salesorder['adjustment'] = $orders[0]['adjustment'];
									$all_salesorder['pickup_boy'] = $orders[0]['pickup_boy'];
									$all_salesorder['pickup_boy_mobile'] = $orders[0]['pickup_boy_mobile'];
									$all_salesorder['del_boy'] = $orders[0]['del_boy'];
									$all_salesorder['del_boy_mobile'] = $orders[0]['del_boy_mobile'];  */
	
								$so[] = $all_salesorder;
								$resp['success'] = 'true';
								$resp['salesorder'] = $so;
			} else {
				$resp["success"] = "false";
				$resp["msg"] = "NO latest order";
				//$resp['salesorder']= 
			}
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "userid is blank";
		}
		$this->response ($resp,200);
	}
	
	public function serviceadd_post() {
		$this->load->library('zyk/OrderLib');
		$this->load->library ( 'zyk/UserLib' );
		$this->load->library('zyk/ItemLib');
		 $data11 = $this->post('params');
		 $data = array();
		 $data = json_decode($data11,true);
		 //print_r($data);
		 $orderid = $data['orderid'];
		 $permission = $data['permission'];
		 $ordertotal = 0;
		 $item = array();
		 foreach($permission as $permi){
		
		 $item['orderid'] = $orderid;
		 $item['service_id'] =  $permi['service_id'];
		 $item['service_name']  =  $permi['service_name'];
		 $item['service_price'] =  $permi['service_price'];
		 $item['quantity'] = $permi['quantity'];
		 $item['total_amount'] = $item['service_price']*$item['quantity'];
		 $ordertotal = $ordertotal + $item['total_amount'];
		 $this->orderlib->addOrderItems($item);
		 }
		 $orderdata = array();
		 $orderdata['orderid'] = $orderid;
		 $orderdata['order_amount'] = $ordertotal;
		 $orderdata['delivery_charge'] = 20;
		 $orderdata['grand_total'] = $ordertotal + 20;
		 $orderdata['status'] = 2;
		 $this->orderlib->updateOrder($orderdata);
		
		// if(!empty($roles)){
		 $success_response["status"] = "true";
		 $success_response["message"] = "Services added successfully";
		// } else {
		 //$roleid = $role_exist['id'];
		// $success_response["status"] = "false";
		// $success_response["message"] = "Role Permission not Created";
		// }
		
		 $this->response ($success_response,200); 
		
		/*
		$this->load->library('zyk/OrderLib');
		$this->load->library ( 'zyk/UserLib' );
		$this->load->library('zyk/ItemLib');
		$orderid = $this->input->post('orderid');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$discount = 0;
		$response = array();
		$itemids = $this->input->post('service_id');
		$itemnames = $this->input->post('service_name');
		$itemprices = $this->input->post('service_price');
		$qtys = $this->input->post('quantity');
		$ordertotal = 0;
		$items = array();
		$discountable_total = 0;
		for ($i = 0; $i < count($itemids); $i++) {
		$item = array();
			$item['orderid'] = $orderid;
			$item['service_id'] = $itemids[$i];
			$item['service_name'] = $itemnames[$i];
			$item['service_price'] = $itemprices[$i];
			$item['quantity'] = $qtys[$i];
	     	$item['total_amount'] = $itemprices[$i]*$qtys[$i];
			$items[] = $item;
			$ordertotal = $ordertotal + $item['total_amount'];
		}
		$this->orderlib->addOrderItems($items);
		unset($items);
		$delivery_charge = 20;

		$adjustment = 0;
		$newoutstanding = 0;
		if($orders[0]['outstanding'] != 0) {
			$outstanding = $orders[0]['outstanding'];
			$newoutstanding = 0;
			$nettotal = $ordertotal - $discount + $delivery_charge;
			if($outstanding > 0) {
				$adjustment = $outstanding;
				$newoutstanding = 0;
			} else {
				$outstanding = $outstanding * -1;
				if($outstanding <= $nettotal) {
					$adjustment = $outstanding;
					$newoutstanding = 0;
				} else {
					$adjustment = $nettotal;
					$newoutstanding = $outstanding - $nettotal;
				}
				$adjustment = $adjustment * -1;
				$newoutstanding = $newoutstanding * -1;
			}
		}
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		//$orderdata['delivery_date'] = date('Y-m-d',strtotime($this->input->post('delivery_date')));
		$orderdata['order_amount'] = $ordertotal;
		$orderdata['delivery_charge'] = $delivery_charge;
		$orderdata['vat_tax'] = 0;
		$orderdata['service_tax'] = 0;
		$orderdata['discount'] = $discount;
		$orderdata['adjustment'] = $adjustment;
		$orderdata['net_total'] = $ordertotal - $discount + $delivery_charge;
		$orderdata['grand_total'] = $ordertotal - $discount + $delivery_charge + $adjustment;
		$orderdata['status'] = 2;
		$this->orderlib->updateOrder($orderdata);

		$response['status'] = 1;
		$response['message'] = 'Order Services added successfully.';*/
	}
	
	public function notification_post() {
		$uid = $this->post('user_id');
		$so = array();
		if($uid!="") {
			$this->load->library ( 'zyk/UserLib' );
			$so = $this->userlib->getNotification($uid);
				
			$resp['success']='true';
			$resp['order'] = $so;
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "User Id is blank";
		}
		$this->response ($resp,200);
	}
	
	public function removeNotification_post() {
		$map=array();
		$map['id'] = $this->post('notify_id');
		$map['status'] = 0;
		$so = array();
		
		  $this->load->library ( 'zyk/UserLib' );
		  $so = $this->userlib->updateNotification($map);
	
		  $resp['success'] = 'true';
		  $resp['msg'] = "Notification remove from list";
		
		$this->response ($resp,200);
	}
	
	public function ongoingorderinfo_post() {
		$uid = $this->post('user_id');
		$so = array();
		if($uid!="") {
			$this->load->library ( 'zyk/UserLib' );
			$so = $this->userlib->getlastOrder($uid);
			$logs = $this->userlib->getlastOrderComment($so[0]['orderid']);
				
			$resp['success']='true';
			$resp['order'] = $so;
			$resp['logs'] = $logs;
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "User Id is blank";
		}
		$this->response ($resp,200);
	}
	
	public function ongoingorderlogs_post() {
		$uid = $this->post('user_id');
		$so = array();
		if($uid!="") {
			$this->load->library ( 'zyk/UserLib' );
			$so = $this->userlib->getallComment($uid);
	
			$resp['success']='true';
			$resp['order'] = $so;
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "User Id is blank";
		}
		$this->response ($resp,200);
	}
	
	public function ongoingorderbill_post() {
		$uid = $this->post('user_id');
		$so = array();
		if($uid!="") {
			$this->load->library ( 'zyk/UserLib' );
			$so = $this->userlib->getBill($uid);
	
			$resp['success']='true';
			$resp['order'] = $so;
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "User Id is blank";
		}
		$this->response ($resp,200);
	}
	
	public function setConfirmedItems_post() {
		$order_id = $this->post('orderid');
		$item_list = $this->post('item_list');
		$amont = $this->post('amont');
		
		$so = array();
		if($order_id!="") {
			$this->load->library ( 'zyk/UserLib' );
			$so = $this->userlib->setConfirmItem($order_id, $amont, $item_list);
	
			$resp['success']='true';
			$resp['order'] = $so;
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "Order Id is blank";
		}
		$this->response ($resp,200);
	}
	
	public function getOrderDetailsByOrderId_post() {
		$orderid = $this->post('orderid');
		$so = array();
		$data = array();
		if($orderid!="") {
			$this->load->library ( 'zyk/OrderLib' );
			$so = $this->orderlib->getOrderDetails($orderid);
			
			$data['orderid'] = $so[0]['orderid'];
			$data['invoice_status'] = $so[0]['invoice_status'];
			$data['invoice_url'] = base_url().$so[0]['invoice_url'];
			$data['payment_url'] = base_url().'paynow/'.$so[0]['ordercode'];
			
			$resp['success']='true';
			$resp['order'] = $data;
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "Order Id is blank";
		}
		$this->response ($resp,200);
	}
	
	 public function cancelOrderFromApp_post() {
		//$orderid = $this->post('orderid');
		//$so = array();
		$data = array();
		$data['orderid'] = $this->post('orderid');
		$data['status'] = 5;
		if($this->post('orderid')!="") {
			$this->load->library ( 'zyk/OrderLib' );
			$this->orderlib->updateOrder($data);		
			
			$resp['success']='true';
			$resp["msg"] = "Order Cancelled Successfully";
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "Order Id is blank";
		}
		$this->response ($resp,200);
	} 
	
	 public function rescheduleOrder_post() {
		
		$data = array();
		$data['orderid'] = $this->post('orderid');
		$data['pickup_date'] = $this->post('pickup_date');
		$data['slot'] = $this->post('slot');
		$data['status'] = 0;
		$data['pickup_rescheduled'] = 1;
		$data['ordered_on'] = date('Y-m-d H:i:s');
		$data['updated_datetime'] = date('Y-m-d H:i:s');
		if($this->post('orderid')!="") {
			$this->load->library ( 'zyk/OrderLib' );
			$this->orderlib->updateOrder($data);		
			
			$resp['success']='true';
			$resp["msg"] = "Order Rescheduled Successfully";
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "Order Id is blank";
		}
		$this->response ($resp,200);
	} 
}