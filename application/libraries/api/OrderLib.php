<?php
class OrderLib {
	
	public function __construct(){
		$this->CI =& get_instance();
	}

	/****** code by kunal **********/
	public function getOrderListByuserID($userid) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getOrderListByuserID($userid);
	}

	public function getOrderListByRiderID($rider_id) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getOrderListByRiderID($rider_id);
	}

	public function getOrderDetails($orderid) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getOrderDetails($orderid);
	}

	/****** code by kunal **********/
	
	public function addOrder($orderdata) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->addOrder($orderdata);
	}
	
	public function addNotification($orderdata) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->addNotification($orderdata);
	}
	
	public function addOrderapp($orderdata) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->addOrder($orderdata);
		$this->sendBookingEmail($orderdata);
	}
	
	public function addCategory($data) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->addCategory($data);
	}
	
	public function updateOrder($orderdata) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->updateOrder($orderdata);
	}	

	public function updateOrderapp($orderdata) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->updateOrder($orderdata);
		$this->sendBookingEmail($orderdata);
	}
	
	public function getAllOrderDetails() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getAllOrderDetails();
	}


	
	public function getAllDetails($userid){
		$this->CI->load->model ('api/orders/Order_model','order');
		$data = $this->CI->order->getAllDetails($userid);
		return $data;
	}
	
	public function allOrders() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->allOrders();
	}
	
	public function allPendingOrders() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->allPendingOrders();
	}
	
	public function allCompletedOrders() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->allCompletedOrders();
	}
	
	public function getPendingOrdersByDate() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getPendingOrdersByDate();
	}
	
	public function getAssignedOrdersByDate() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getAssignedOrdersByDate();
	}

	public function getRejectedOrdersByDate() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getRejectedOrdersByDate();
	}
	
	public function getOngoingOrdersByDate() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getOngoingOrdersByDate();
	}
	
	public function getApprovalOrdersByDate() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getApprovalOrdersByDate();
	}
 
	public function getCompletedOrdersByDate() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getCompletedOrdersByDate();
	}
	
	public function getDeliveryCompletedOrdersByDate() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getDeliveryCompletedOrdersByDate();
	}
	
	public function getPickupOrdersByDate() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getOrdersForPickup();
	}
	
	public function getOrdersUnderProcess() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getOrdersUnderProcess();
	}
	
	public function getDeliveryOrdersByDate() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getOrdersForDelivery();
	}
	
	public function getCancelledOrdersByDate() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getCancelledOrdersByDate();
	}
	
	public function searchOrders($map) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->searchOrders($map);
	}
	
	public function getTodaysOrders() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getTodaysOrders();
	}
	
	public function getTodaysOrdersBooked($store_id,$role_id) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getTodaysOrdersBooked($store_id,$role_id);
	}
	
	public function getTodaysDeliveries($store_id,$role_id) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getTodaysDeliveries($store_id,$role_id);
	}
	
	public function getTodaysPendingDeliveries() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getTodaysPendingDeliveries();
	}
	
	public function getPreviousDayPendingDeliveries() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getPreviousDayPendingDeliveries();
	}
	
	public function getOrderDetailsByOrderId($orderid) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getOrderDetailsByOrderId($orderid);
	}
	
	public function getOrderInfoByOrderId($orderid) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getOrderInfoByOrderId($orderid);
	}
	
	public function getTodaysOrderCount() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getTodaysOrderCount();
	}
	
	public function getTodaysPickupOrderCount() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getTodaysPickupOrderCount();
	}
	
	public function addCancelOrderReason($map) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->addCancelOrderReason($map);
	}
	
	public function addOrderLogs($params) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->addOrderLogs($params);
	}
	
	public function getOrderLogs($orderid) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getOrderLogs($orderid);
	}
	
	public function addOrderItems($params) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->addOrderItems($params);
	}
	
	public function removeOrderItems($orderid) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->removeOrderItems($orderid);
	}
	
	public function getOrderItems($orderid) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getOrderItems($orderid);
	}
	
	public function getOrderProducts($orderid) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getOrderProducts($orderid);
	}
	
	
	public function getOrderItemCount($orderid) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getOrderItemCount($orderid);
	}
	
	public function generateInvoice($map) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->generateInvoice($map);
	}
	
	public function updateInvoice($map) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->updateInvoice($map);
	}
	
	public function updateBulkInvoice($map) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->updateBulkInvoice($map);
	}
	
	public function updateBulkOrder($map) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->updateBulkOrder($map);
	}
	
	public function filterOrders($map) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->filterOrders($map);
	}
	
	public function getOrderDetailsByIds($orderids) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getOrderDetailsByIds($orderids);
	}
	
	public function updateBatchDelivery($orderdata) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->updateBatchDelivery($orderdata);
	}
	
	public function addAdminComment($data) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->addAdminComment($data);
	}
	
	public function getAdminComment($orderid) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getAdminComment($orderid);
	}
	
	public function checkorder($userid){
		$this->CI->load->model('api/orders/Order_Model','order');
		return $this->CI->order->checkorder($userid);
	}
	
	public function sendBookingEmail($data) {
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'Booking Request | '.COMPANY;
		$this->CI->pkemail->subject = 'We have received your order.';
		$this->CI->pkemail->mctag = 'booking';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $data ['email'];
		$this->CI->template->set ( 'data', $data );
		$this->CI->template->set ( 'page', 'booking' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/booking', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}
	
	public function sendCancelEmail($data) {
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'Booking Request Cancelled | '.COMPANY;
		$this->CI->pkemail->subject = 'Booking Request Cancelled | '.COMPANY;
		$this->CI->pkemail->mctag = 'cancel';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $data ['email'];
		$this->CI->template->set ( 'data', $data );
		$this->CI->template->set ( 'page', 'cancel' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/cancel', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	} 
	
	public function sendOrderConfirmEmail($data) {
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'Booking order confirm | '.COMPANY;
		$this->CI->pkemail->subject = 'Your order confirm.';
		$this->CI->pkemail->mctag = 'booking';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $data ['email'];
		$this->CI->template->set ( 'data', $data );
		$this->CI->template->set ( 'page', 'booking' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/order-confirm', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}
	
	public function sendRescheduleEmail($data) {
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'Reschedule order | '.COMPANY;
		$this->CI->pkemail->subject = 'Your order reschedule.';
		$this->CI->pkemail->mctag = 'booking';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $data ['email'];
		$this->CI->template->set ( 'data', $data );
		$this->CI->template->set ( 'page', 'booking' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/reschedule-order', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}
	
	public function sendGenrateEstimateEmail($data) {
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'Estimate Genrated | '.COMPANY;
		$this->CI->pkemail->subject = 'Estimate Genrated for your order';
		$this->CI->pkemail->mctag = 'Estimate';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $data ['email'];
		$this->CI->template->set ( 'data', $data );
		$this->CI->template->set ( 'page', 'pickedup' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/genrate-estimate', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}
	
	public function sendPickUpEmail($data) {
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'Order Ready For PickUp | '.COMPANY;
		$this->CI->pkemail->subject = 'Order Ready For PickUp | '.COMPANY;
		$this->CI->pkemail->mctag = 'pickup';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $data ['email'];
		$this->CI->template->set ( 'data', $data );
		$this->CI->template->set ( 'page', 'pickup' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/pickup', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}
	
	public function sendPickedUpEmail($data) {
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'Your Order Got Tagged in your name | '.COMPANY;
		$this->CI->pkemail->subject = 'Your Order Got Tagged in your name | '.COMPANY;
		$this->CI->pkemail->mctag = 'pickedup';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $data ['email'];
		$this->CI->template->set ( 'data', $data );
		$this->CI->template->set ( 'page', 'pickedup' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/pickedup', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}
	
	public function sendDeliveryEmail($data) {
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'Your Order is ready to be delivered | '.COMPANY;
		$this->CI->pkemail->subject = 'Your Order is ready to be delivered | '.COMPANY;
		$this->CI->pkemail->mctag = 'delivery';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $data ['email'];
		$this->CI->template->set ( 'data', $data );
		$this->CI->template->set ( 'page', 'delivery' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/delivery', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}
	
	public function sendInvoiceEmail($data) {
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'Your Order Invoice | '.COMPANY;
		$this->CI->pkemail->subject = 'Your Order Invoice | '.COMPANY;
		$this->CI->pkemail->mctag = 'invoice';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $data ['email'];
		$this->CI->template->set ( 'data', $data );
		$this->CI->template->set ( 'page', 'invoice' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/invoice', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}
	
	public function notifyMe($data) {
		$this->CI->load->library ( 'pkemail' );
		$messages ="<html>
		Dear Team,<br /><br />
		You have received a order <br />
		Customer Name: ".$data['name']." <br />
		mobile no:".$data['mobile']." <br />
		email id : ".$data['email']." <br />
		Pick up Address : ".$data['address']." <br /><br />
		Order Details : <br /><br />
		Pick up Date : ".date('d-m-Y',strtotime($data['pickup_date']))." <br />
		Pick up Time : ".$data['pickup_slot']." <br />
		Regards, <br />
		The Moustache Laundry
		</body>
		</html>";
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'ServiceOn';
		$this->CI->pkemail->subject = 'New Order Received';
		$this->CI->pkemail->mctag = 'invoice';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = "themoustachelaundry@gmail.com";
		$this->CI->pkemail->send_email ( $messages );
	}
	
	public function sendBookingSMS($data) {
 
		$name = explode(" ",$data['name']);
		$fname = $name[0];
		$bookingid = $data['orderid'];
		$date	=  date('Y-m-d' ,$data['ordered_on']);
		$time	=  date('H:i:s' ,$data['ordered_on']);

/*		echo "<pre>";
		print_r($fname,$date,$time);*/

       //$sms_msg = 'Hi '.$fname.', ServiceOn is happy to receive your appointment request. Our team will confirm the request shortly.';
        $sms_msg = 'Dear '.$fname.'!, Thank you for booking. Booking ID- '.$bookingid.' Our Professional will contact you shortly.'; 

        $this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function sendCancelSMS($data) {
		$name = explode(" ",$data['name']);
		$fname = $name[0];
		//$sms_msg = 'Dear ' . $data ['name'] . ' , Your order has been cancelled. We would like to hear from you. Please get in touch with us. Regards, ServiceOn';
		$sms_msg = 'Hi '.$fname.', Apologies for cancelling the appointment because of '.$data['reason'].' ';
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	} 
	
	public function sendRescheduleSMS($data) {
		$name = explode(" ",$data['name']);
		$fname = $name[0];
		//$sms_msg = 'Dear ' . $data ['name'] . ' , Your order has been cancelled. We would like to hear from you. Please get in touch with us. Regards, ServiceOn';
		//$sms_msg = 'Hi '.$fname.', Apologies for cancelling the appointment because of '.$data['reason'].' ';
		$sms_msg = 'Hi '.$fname.', since our mechanics are already occupied, have rescheduled your appointment on '.$data['pickup_date'].' at '.$data['pickup_slot'].'. Apologies for the inconvenience';
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function sendOrderConfirmSMS($data) {
		$name = explode(" ",$data['name']);
		$fname = $name[0];
		//$sms_msg = 'Hi '.$fname.', your appointment has been confirmed and we will be there to serve you at the given time and address. Thanks for choosing ServiceOn.';
		$sms_msg = 'Mechanic is been assigned for your vehicle. You will receive a call from the mechanic to confirm your availability & service location';
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function sendInvoiceSMS($data) {
		$name = explode(" ",$data['name']);
		$fname = $name[0];
		$invoiceurl = base_url().$data['invoice_url'];
		//$sms_msg = 'Hello ' . $data ['name'] . ' , Your bill amounts to Rs. '.$data['bill_amount'].'. Please Check your invoice. '.$data['payment_url'].' Regards, ServiceOn';
		//$sms_msg = 'Hello ' . $fname . ' , Thanks again for choosing ServiceOn. Kindly check Invoice & Pay '.$data['payment_url'].'.';
		$sms_msg = 'Invoice is Generated. Invoice Link: '.$invoiceurl.' Bill amount : Rs '.$data['bill_amount'].' Payment Link: '.$data['payment_url'].' Kindly pay the bill amount before the vehicle delivery or on delivery.';
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
// 	public function sendOrderSMSToNumbers($data,$vendor_mobiles) {
// 		$date = date('j M Y',strtotime($data['pickup_date']));
// 		$sms_msg = 'New order assign Name: '.$data['name'].', Mobile no:'.$data['mobile'].', Address:'.$data['address'].', locality:'.$data['locality'].', Date:'.$date;
// 		$this->CI->load->library ( 'pksms' );
// 		$map = array ();
// 		$map ['mobile'] = $vendor_mobiles;
// 		$map ['message'] = $sms_msg;
// 		$this->CI->pksms->sendSms ( $map );
// 	}
	
	public function sendOrderSMSToNumbers($data,$vendor_mobiles) {
		$date = date('j M Y',strtotime($data['pickup_date']));
		$sms_msg = 'New order assign Name: '.$data['name'].', Mobile no:'.$data['mobile'].', Address:'.$data['address'].', locality:'.$data['locality'].', Date:'.$date.', Slot:'.$data['time_slot'].', Vehicle Details:'.$data['category_name'].'/'.$data['brand_name'].'/'.$data['model_name'].', Comment:'.$data['comment'];
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $vendor_mobiles;
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function sendPickUpSMS($data) {
		$sms_msg = 'Hi There! Our Moustache Man '.$data['pickup_executive'].' ('.$data['pickup_executive_mobile'].') is out for your pick up. Thank you';
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function sendPickedUpSMS($data) {
		$sms_msg = 'Your order got tagged in your name. Here is your order detail: Order Number: '.$data['orderid'].' Wash and Iron: '.$data['washniron'].' Dry-cleaning: '.$data['drycleaning'].' Ironing: '.$data['ironing'].' Delivery Date: '.date('d-m-Y',strtotime($data['delivery_date'])).' Thank you';
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function sendDeliverySMS($data) {
	//	$sms_msg = 'Hi ' . $data ['name'] . ' , Your order is ready to be delivered. The bill amounts to Rs '.$data['bill_amount'].'. The Moustache Man, '.$data['delivery_executive'].' ('.$data['delivery_executive_mobile'].') will be there at the schedule time, be there to say Hi! Regards, The Moustache Laundry';
		$sms_msg = 'Clean clothes ready! ServiceOn will call you shortly to confirm delivery today. Check Invoice & Pay: <URL>';
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	/* public function sendInvoiceSMS($data) {
		$sms_msg = 'Hello ' . $data ['name'] . ' , Your bill amounts to Rs. '.$data['bill_amount'].'. Please Check your invoice. '.$data['payment_url'].' Regards, ServiceOn';
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	} */
	
	public function sendPickUpBoySMS($data) {
		$sms_msg = 'Name: '.$data['name'].', Mobile no:'.$data['mobile'].', Address:'.$data['address'].', Pick up time:'.$data['pickup_slot'];
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['pickup_executive_mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function sendDeliveryBoySMS($data) {
		$sms_msg = 'Name: '.$data['name'].', Mobile no:'.$data['mobile'].', Address:'.$data['address'].', Amount:'.$data['grand_total'];
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['delivery_executive_mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	public function addToDack($data) {
		$pickup_times = explode("-",$data['pickup_slot']);
		$pickup_time = $pickup_times[0];
		$this->CI->load->library ( 'mylib/Dack' );
		$params = array();
		$params['task_def'] = 'P';
		$params['ride_code'] = null;
		$params['rider_mobile'] = null;
		$params['pickup_customer_name'] = $data['name'];
		$params['pickup_customer_contact'] = $data['mobile'];
		$params['pickup_datetime'] = date('Y-m-d H-i-s',strtotime(date('Y-m-d',strtotime($data['pickup_date'])).' '.date('H:i:s',strtotime($pickup_time))));
		$params['pickup_address'] = $data['address'];
		if(!empty($data['locality'])) {
			$params['pickup_nearby_address'] = $data['locality'];
		} else {
			$params['pickup_nearby_address'] = 'Pune';
		}
		if(!empty($data['latitude'])) {
			$params['pickup_mapLat'] = $data['latitude'];
		} else {
			$params['pickup_mapLat'] = '18.5204303';
		}
		if(!empty($data['longitude'])) {
			$params['pickup_mapLng'] = $data['longitude'];
		} else {
			$params['pickup_mapLng'] = '73.85674369999992';
		}
		$params['pickup_customer_id'] = $data['userid'];
		$params['invoice_number'] = $data['orderid'];
		$params['item_description'] = '';
		$params['item_quantity'] = 0;
		$params['order_amount'] = 0;
		$params['time_slot'] = $data['pickup_slot'];
		$resp = $this->CI->dack->moveToDack($params);
		if($resp['Response'] == 'Success') { 
			$this->CI->load->model ('api/orders/Order_model','order');
			$orderdata['orderid'] = $data['orderid'];
			$orderdata['tracking_id'] = $resp['Tracking No'];
			$this->CI->order->updateOrder($orderdata);
		}
	}
	
	public function addPaymentDetail($payment) {
		$this->CI->load->model ('api/orders/Order_model','order');
		$this->CI->order->addPaymentDetail($payment);
	}
	
	public function getTodaysPendingPayments() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getTodaysPendingPayments();
	}
	
	public function deliveryAttemptedSMS($data) {
		$sms_msg = 'Hi There, We were unsuccessful in our attempt to deliver your order. Please call us back. Regards, ServiceOn';
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function deliveryCallAnsweredSMS($data) {
		$sms_msg = 'Hi There, We tried reaching you but couldn\'t connect. Please let us know time for your delivery or call us back. Regards, ServiceOn';
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function pickupAttemptedSMS($data) {
		$sms_msg = 'Hi There, We were unsuccessful in our attempt to pick up your order. Please call us back. Regards, ServiceOn';
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function getlatestOrderDetails($userid) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getlatestOrderDetails($userid);
	}
	
	public function updateCrondetails($data){
		$this->CI->load->model ('api/orders/Order_model','order');
		$data = $this->CI->order->updateCrondetails($data);
		return $data;
	}
	
	/* 
	 * CONFIRMATION MAIL AND SMS
	 *  
	 */
	
	public function confirmApproval_sms($data) {
		$name = explode(" ",$data['name']);
		$fname = $name[0];
		//$sms_msg = 'Hi '.$fname.', Thanks for confirming the estimate. Have mailed you the details. Will inform you once we complete the services. Thanks, ServiceOn!';
		$sms_msg = 'As per your request the estimate is updated and confirmed, The work will start shortly. You will be notified once the work is complete';
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function confirmApproval_email($data) { 
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'Estimate confirmation | '.COMPANY;
		$this->CI->pkemail->subject = 'Estimate confirmation for your order';
		$this->CI->pkemail->mctag = 'Estimate';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $data ['email'];
		$this->CI->template->set ( 'data', $data );
		$this->CI->template->set ( 'page', 'confirmation' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/genrate-estimate_final', '', true );
		
		$this->CI->pkemail->send_email ( $text_body );
	}
	
	/*  
	 * MARK WORK COMPLETED SMS AND MAIL
	 * 
	 */
	
	public function markworkCompleted_sms($data) {
		$name = explode(" ",$data['name']);
		$fname = $name[0];
		//$sms_msg = 'Hi '.$fname.', Your Bike is ready ! Thanks, Team ServiceOn!';
		$sms_msg = 'Servicing is complete & your vehicle is ready for delivery. The Mechanic will contact you for delivery';
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	} 
	
	/* public function markworkCompleted_email($data) {
		$name = explode(" ",$data['name']);
		$fname = $name[0];
		$this->CI->load->library ( 'pkemail' );
		$messages ="<html>
		Hi ". $fname.",<br><br>Your Bike is ready! Thanks again for choosing ServiceOn.<br/><br /> 
				Thanks, <br />
				Team ServiceOn!
				</body>
				</html>";
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'ServiceOn';
		$this->CI->pkemail->subject = 'Work Completed';
		$this->CI->pkemail->mctag = 'Work Completed';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $data['email'];
		$this->CI->pkemail->send_email ( $messages );
	} */
	
	public function markworkCompleted_email($data) {
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'Work Completed | '.COMPANY;
		$this->CI->pkemail->subject = 'Work Completed for your order';
		$this->CI->pkemail->mctag = 'Work Completed';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $data ['email'];
		$this->CI->template->set ( 'data', $data );
		$this->CI->template->set ( 'page', 'confirmation' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/work-completed', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}
	
	public function sendGenrateEstimateSMS($data) {
		$name = explode(" ",$data['name']);
		$fname = $name[0];
		//$sms_msg = 'Hi '.$fname.', We have generated and mailed you an estimate based on our expert inspection. Kindly check and confirm the same to start the services. Thanks, Team ServiceOn!';
		$sms_msg = 'A detailed inspection report for your vehicle is generated. You can check the report here: '.base_url().'order/trackorder in billing section. Please verify the estimate and confirm the job list.';
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function sendConfirmDeliverySMS($data) {
		$name = explode(" ",$data['name']);
		$fname = $name[0];
		//$sms_msg = 'A detailed inspection report for your vehicle is generated. You can check the report here: '.base_url().'order/trackorder in billing section. Please verify the estimate and confirm the job list.';
		$sms_msg = 'Dear '.$fname.', Mechanic has delivered the vehicle, take a test drive and let us know your feedback If you are satisfied with the service take some time to review us on google / facebook Google : https://goo.gl/1w6uop and/or Facebook https://goo.gl/4LF8et If you are not satisfied please contact 9011941194 immediately, so we could schedule rework to solve the issues.';
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function getUserNotification($userid) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getUserNotification($userid);
	}
	
	public function sendBookingNotification($userid) {
		$curr_date=date('d-M-Y H:i:s');
		$this->CI->load->model ( 'api/users/User_model', 'userlogin' );
		$gcm_id = $this->CI->userlogin->getUserGcmIdsbyId ($userid);
		if(!empty($gcm_id)){
			$gcmid = $gcm_id[0]['gcm_reg_id'];
		
			$title = 'Appointment booked';
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
				$this->CI->load->model ('api/orders/Order_model','order');
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
		$this->CI->load->model ( 'api/users/User_model', 'userlogin' );
		$gcm_id = $this->CI->userlogin->getUserGcmIdsbyId ( $userid );
		
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
	
	public function sendAssignedgarageNotification($userid,$orderid) {
		$curr_date=date('d-M-Y H:i:s');
		$this->CI->load->model ( 'api/users/User_model', 'userlogin' );
		$gcm_id = $this->CI->userlogin->getUserGcmIdsbyId ( $userid );
		
		$gcmid = $gcm_id[0]['gcm_reg_id'];
	
		$title = 'Mechanic assigned';
		$msg = 'Mechanic booked. Mechanic is been assigned for your service. He will call you before leaving for your appointment '.$curr_date.' ';
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
	
	public function sendEstimategeneratedNotification($userid,$orderid) {
		$curr_date=date('d-M-Y H:i:s');
		$this->CI->load->model ( 'api/users/User_model', 'userlogin' );
		$gcm_id = $this->CI->userlogin->getUserGcmIdsbyId ( $userid );
	
		$gcmid = $gcm_id[0]['gcm_reg_id'];
	
		$title = 'Estimate generated';
		$msg = 'Estimate is ready. Detailed inspection report is generated. Please review and let us know the final jobs to be performed '.$curr_date.' ';
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
			$notification['orderid'] =  $orderid;


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
	
	public function sendEstimateconfirmedNotification($userid) {
		$curr_date=date('d-M-Y H:i:s');
		$this->CI->load->model ( 'api/users/User_model', 'userlogin' );
		$gcm_id = $this->CI->userlogin->getUserGcmIdsbyId ( $userid );
	
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
	
	public function sendWorkcompletedNotification($userid,$orderid) {
		$curr_date=date('d-M-Y H:i:s');
		$this->CI->load->model ( 'api/users/User_model', 'userlogin' );
		$gcm_id = $this->CI->userlogin->getUserGcmIdsbyId ( $userid );
	
		$gcmid = $gcm_id[0]['gcm_reg_id'];
	
		$title = 'Work completed';
		$msg = 'Bike is ready. Servicing is complete & your bike is ready for delivery '.$curr_date.' ';
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
	
	public function sendGenerateinvoiceNotification($userid,$orderid) {
		$curr_date=date('d-M-Y H:i:s');
		$this->CI->load->model ( 'api/users/User_model', 'userlogin' );
		$gcm_id = $this->CI->userlogin->getUserGcmIdsbyId ( $userid );
	
		$gcmid = $gcm_id[0]['gcm_reg_id'];
	
		$title = 'Generate invoice';
		$msg = 'Final Bill amount : Rs XXXXX. Kindly pay the bill amount before the bike delivery or on delivery '.$curr_date.' ';
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
	
	public function sendDeliveryCompleteNotification($userid,$orderid) {
		$curr_date=date('d-M-Y H:i:s');
		$this->CI->load->model ( 'api/users/User_model', 'userlogin' );
		$gcm_id = $this->CI->userlogin->getUserGcmIdsbyId ( $userid );
	
		$gcmid = $gcm_id[0]['gcm_reg_id'];
	
		$title = 'Delivery Complete';
		$msg = 'Mechanic has delivered the bike, please take a test drive and let us know your feedback '.$curr_date.' ';
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
			$notification['orderid'] =  $orderid;


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
	
	public function getServicedate() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getServicedate();
	}
	
	public function addRemindOrder($userid) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->addRemindOrder($userid);
	}
	
	public function getallReminderOrders() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getallReminderOrders();
	}

	public function getTodaysReminderOrders() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getTodaysReminderOrders();
	}
	
	public function getTodaysTickets(){
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getTodaysTickets();
	}

	public function getOrderListByVendor($data) { 
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getOrderListByVendor($data);
	}

	public function getOrderListByMechanic($data) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getOrderListByMechanic($data);
	}
	public function assignOrderToMechanic($data) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->assignOrderToMechanic($data);
	}

	public function getOngoingOrder($data) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->ongoingOrdersByUSer($data);
	}

	public function addReminder($data) {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->addReminder($data);
	}

	public function getRemindercron() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getRemindercron();
	}
// 	public function getAdminDetails() {
// 		$this->CI->load->model ('orders/Order_model','order');
// 		return $this->CI->order->getAdminDetails();
// 	}
	public function getReminderList() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getReminderList();
	}
	
	public function sendReminderEmail($datanew) {
	$this->CI->load->library ( 'pkemail' );
	foreach($datanew as $data){
		$messages ="<html>
		Dear Team,<br /><br />
		You have a Reminder for <br />
		<b><u>Customer Details</u></b> <br />
		<b>Customer Name :</b> ".$data['user_name']." <br />
		<b>Mobile no :</b>".$data['usermob']." <br /><br />
		<b><u>Order Details</u></b> <br />
		<b>Order Code :</b> ".$data['ordercode']." <br />
		<b>Slot :</b> ".$data['slot']." <br />
		<b>Vendor Name :</b> ".$data['vendor_name']." <br />
		<b>Mechanic Mobile Number :</b> ".$data['garage_name']." <br />
		<b>Mechanic Name :</b> ".$data['garage_name']." <br />
		<b>Reminder Comment :</b> ".$data['reminder_comment']." <br /><br />
		Thanks!<br />
		Regards, <br />
		ServiceOn
		</body>
		</html>";
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'ServiceOn';
		$this->CI->pkemail->subject = 'Reminder for Today';
		$this->CI->pkemail->mctag = 'Reminder';
		$this->CI->pkemail->attachment = 0;
		//$this->CI->pkemail->to = "shrutimhadgut7@gmail.com";
	//	$this->CI->pkemail->to = "shrutim@brandzgarage.com";
		$this->CI->pkemail->to = "contact@ServiceOn.com";
		$this->CI->pkemail->send_email ( $messages );
	}
	}
	
// 	public function sendReminderSMS($datanew,$admin) {
// 		$this->CI->load->library ( 'pksms' );
// 		foreach($datanew as $data){
// 			$user_name = $data['user_name'];
// 			$usermob = $data['usermob'];
// 			$ordercode = $data['ordercode'];
// 			$slot = $data['slot'];
// 			$vendor_name = $data['vendor_name'];
// 			$garage_name = $data['garage_name'];
// 			$vendor_mobile = $data['vendor_mobile'];
// 			$comment = $data['reminder_comment'];
// 			$admin_mobile = $admin[0]['mobile'];
// 			$admin_email = $admin[0]['email'];
			
// 			$sms_msg = 'Hello, You Set Reminder for '.$user_name.', Mobile:'.$usermob.', Order Code:'.$ordercode.', Selected Slot:'.$slot.', Vendor Name:'.$vendor_name.', Garage Name:'.$garage_name.', Garage Mobile Number:'.$vendor_mobile.', Reminder Comment:'.$comment;
// 			$map = array ();
// 			$map ['mobile'] = 9421047572;
// 			$map ['message'] = $sms_msg;
// 			$this->CI->pksms->sendSms ( $map );
// 		}
// 	}
	
	public function rejectedOrders() {
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->rejectedOrders();
	}
        
        public function getBookingServices($param, $subcat_id, $model_id) {
            $this->CI->load->model ('api/orders/Order_model','order');
            return $this->CI->order->getBookingServices($param,  $subcat_id, $model_id);
        }
        public function my_packges($param) {
            $this->CI->load->model ('api/orders/Order_model','order');
            return $this->CI->order->my_packges($param);
        }
}