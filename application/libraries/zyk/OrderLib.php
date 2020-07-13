<?php
class OrderLib {
	
	public function __construct(){
		$this->CI =& get_instance();
	}
	
	/**** code by kunal *****/
	public function getOrderListByUserID($userid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getOrderListByUserID($userid);
	}

	/**** code by kunal *****/

	public function addOrder($orderdata) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->addOrder($orderdata);
	}
	
	public function addNotification($orderdata) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->addNotification($orderdata);
	}
	
	public function addOrderapp($orderdata) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->addOrder($orderdata);
		$this->sendBookingEmail($orderdata);
	}
	
	public function addCategory($data) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->addCategory($data);
	}
	public function getOrderListByVendor($data) { 
		
            $this->CI->load->model ('orders/Order_model','order');
            return $this->CI->order->getOrderListByVendor($data);
        }
	public function updateOrder($orderdata) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->updateOrder($orderdata);
	}	

	public function updateOrderapp($orderdata) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->updateOrder($orderdata);
		$this->sendBookingEmail($orderdata);
	}
	
	public function getOrderDetails($orderid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getOrderDetails($orderid);
	}
	public function getAllInvoiceOrderDetails($orderid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getAllInvoiceOrderDetails($orderid);
	}
	
	public function getAllOrderDetails() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getAllOrderDetails();
	}

	public function getMyPackageList($userid)
	{
 
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->getMyPackageList($userid);
	}

	public function particular_package($package_id)
	{
		$this->CI->load->model ('api/orders/Order_model','order');
		return $this->CI->order->particular_package($package_id);
	}

	public function getAllDetails($userid){
		$this->CI->load->model ('orders/Order_model','order');
		$data = $this->CI->order->getAllDetails($userid);
		return $data;
	}
	
	public function allOrders() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->allOrders();
	}
	
	public function allPendingOrders() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->allPendingOrders();
	}
	public function allAssignedOrders() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->allAssignedOrders();
	}

	public function allNewOrders() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->allNewOrders();
	}

	public function pickupRiderAssignedOrders() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->pickupRiderAssignedOrders();
	}

	public function deliveryRiderAssignedOrders() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->deliveryRiderAssignedOrders();
	}

	public function allEstimateGeneratedOrders() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->allEstimateGeneratedOrders();
	}

	public function allOngoingOrders() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->allOngoingOrders();
	}
	public function allWorkingOrders() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->allWorkingOrders();
	}
	
	public function allCompletedOrders() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->allCompletedOrders();
	}
	
	public function allDeliveryCompletedOrds() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->allDeliveryCompletedOrds();
	} 

	public function allDeliveryCompletedOrders() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->allDeliveryCompletedOrders();
	} 
	public function allCanceledOrders() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->allCanceledOrders();
	}  
	public function getPendingOrdersByDate() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getPendingOrdersByDate();
	}
	
	public function getAssignedOrdersByDate() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getAssignedOrdersByDate();
	}
	
	public function getOngoingOrdersByDate() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getOngoingOrdersByDate();
	}
	
	public function getApprovalOrdersByDate() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getApprovalOrdersByDate();
	}
 
	public function getCompletedOrdersByDate() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getCompletedOrdersByDate();
	}
	
	public function getDeliveryCompletedOrdersByDate() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getDeliveryCompletedOrdersByDate();
	}
	
	public function getPickupOrdersByDate() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getOrdersForPickup();
	}
	
	public function getOrdersUnderProcess() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getOrdersUnderProcess();
	}
	
	public function getDeliveryOrdersByDate() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getOrdersForDelivery();
	}
	
	public function getCancelledOrdersByDate() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getCancelledOrdersByDate();
	}
	
	public function searchOrders($map) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->searchOrders($map);
	}
	
	public function getTodaysOrders() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getTodaysOrders();
	}
	
	public function getTodaysOrdersBooked($store_id,$role_id) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getTodaysOrdersBooked($store_id,$role_id);
	}
	
	public function getTodaysDeliveries($store_id,$role_id) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getTodaysDeliveries($store_id,$role_id);
	}
	
	public function getTodaysPendingDeliveries() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getTodaysPendingDeliveries();
	}
	
	public function getPreviousDayPendingDeliveries() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getPreviousDayPendingDeliveries();
	}
	
	public function getOrderDetailsByOrderId($orderid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getOrderDetailsByOrderId($orderid);
	}
	
	public function getOrderInfoByOrderId($orderid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getOrderInfoByOrderId($orderid);
	}
	
	public function getTodaysOrderCount() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getTodaysOrderCount();
	}
	
	public function getTodaysPickupOrderCount() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getTodaysPickupOrderCount();
	}
	
	public function addCancelOrderReason($map) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->addCancelOrderReason($map);
	}
	
	public function addOrderLogs($params) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->addOrderLogs($params);
	}
	
	public function getOrderLogs($orderid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getOrderLogs($orderid);
	}
	
	public function addOrderItems($params) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->addOrderItems($params);
	}
	
	public function removeOrderItems($orderid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->removeOrderItems($orderid);
	}
	
	public function getOrderItems($orderid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getOrderItems($orderid);
	}
	public function getPackageOrderItems($orderid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getPackageOrderItems($orderid);
	}
	
	public function getOrderProducts($orderid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getOrderProducts($orderid);
	}
	
	
	public function getOrderItemCount($orderid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getOrderItemCount($orderid);
	}
	
	public function generateInvoice($map) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->generateInvoice($map);
	}
	
	public function updateInvoice($map) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->updateInvoice($map);
	}
	
	public function updateBulkInvoice($map) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->updateBulkInvoice($map);
	}
	
	public function updateBulkOrder($map) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->updateBulkOrder($map);
	}
	
	public function filterOrders($map) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->filterOrders($map);
	}
	
	public function getOrderDetailsByIds($orderids) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getOrderDetailsByIds($orderids);
	}
	
	public function updateBatchDelivery($orderdata) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->updateBatchDelivery($orderdata);
	}
	
	public function addAdminComment($data) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->addAdminComment($data);
	}
	
	public function getAdminComment($orderid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getAdminComment($orderid);
	}
	public function getVendorComment($vendor_id) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getVendorComment($vendor_id);
	}
	
	public function checkorder($userid){
		$this->CI->load->model('orders/Order_Model','order');
		return $this->CI->order->checkorder($userid);
	}
	
	public function sendBookingEmail($data) {
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'Booking Request |'. COMPANY;
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
		$this->CI->pkemail->headline = 'Booking Request Cancelled | '. COMPANY;
		$this->CI->pkemail->subject = 'Booking Request Cancelled | '. COMPANY;
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
		$this->CI->pkemail->headline = 'Booking order confirm |'. COMPANY;
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
		$this->CI->pkemail->headline = 'Reschedule order |'. COMPANY;
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
		$this->CI->pkemail->headline = 'Estimate Genrated | '. COMPANY;
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
		$this->CI->pkemail->headline = 'Order Ready For PickUp | '. COMPANY;
		$this->CI->pkemail->subject = 'Order Ready For PickUp | '. COMPANY;
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
		$this->CI->pkemail->headline = 'Your Order Got Tagged in your name | '. COMPANY;
		$this->CI->pkemail->subject = 'Your Order Got Tagged in your name | '. COMPANY;
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
		$this->CI->pkemail->headline = 'Your Order is ready to be delivered | '. COMPANY;
		$this->CI->pkemail->subject = 'Your Order is ready to be delivered | '. COMPANY;
		$this->CI->pkemail->mctag = 'delivery';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $data ['email'];
		$this->CI->template->set ( 'data', $data );
		$this->CI->template->set ( 'page', 'delivery' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/delivery-completed', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}
	
	public function sendInvoiceEmail($data) {
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'Your Order Invoice | '. COMPANY;
		$this->CI->pkemail->subject = 'Your Order Invoice | '. COMPANY;
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
		$this->CI->pkemail->headline = ''. COMPANY;
		$this->CI->pkemail->subject = 'New Order Received';
		$this->CI->pkemail->mctag = 'invoice';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = "themoustachelaundry@gmail.com";
		$this->CI->pkemail->send_email ( $messages );
	}
	
	public function sendBookingSMS($data) { 

		$name = explode(" ",$data['name']);
		$fname = $name[0]; 
        $bookingid = $data['ordercode'];
		$date	=  date('Y-m-d' ,strtotime($data['ordered_on']));
		$time	=  date('H:i:s' ,strtotime($data['ordered_on']));

        //$sms_msg = 'Dear '.$fname.', Thank you for choosing '.COMPANY.'. You will be notified once a mechanic is assigned for your service. For queries contact us on '.CONTACT.'';
 
		/*$sms_msg = 'Dear '.$fname.'!, Thank you for booking. 
        Booking ID- '.$bookingid.'\n'.'
        Booking time: '.$time.' \n'.'
		Booking date: '.$date.' \n'.'
		Our Professional will contact you shortly.'; */ 

		$sms_msg = 'Dear '.$fname.' ! Thank you for booking. Booking ID- '.$bookingid.' Our Professional will contact you shortly.';  
        $this->CI->load->library ( 'Pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg; 
		//print_r($map);
		$this->CI->pksms->sendSms($map);
	}
	
	public function sendCancelSMS($data) {
		$name = explode(" ",$data['name']);
		$fname = $name[0];
		//$sms_msg = 'Dear ' . $data ['name'] . ' , Your order has been cancelled. We would like to hear from you. Please get in touch with us. Regards, '. COMPANY;
		/*$sms_msg = 'Hi '.$fname.', Apologies for cancelling the appointment because of '.$data['reason'].' ';
		*/
		$bookingid = $data['ordercode'];
		$sms_msg = 'Dear '.$fname.', Your service request has been cancelled. Booking ID: '.$bookingid .' Reason for cancellation: '.$data['reason'].' Please call +91-8850699195 for assistance'; 
		$this->CI->load->library ( 'pksms' );
 
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	} 
	
	public function sendRescheduleSMS($data) {
		$name = explode(" ",$data['name']);
		$fname = $name[0];
		
		/*$sms_msg = 'Hi '.$fname.', since our mechanics are already occupied, have rescheduled your appointment on '.$data['pickup_date'].' at '.$data['pickup_slot'].'. Apologies for the inconvenience';
*/
		$bookingid = $data['ordercode'];
		$sms_msg = 'Dear '.$fname.', Your service has been rescheduled Booking ID: '.$bookingid .' Rescheduled Service Time: '.$data['pickup_slot'].' Rescheduled Service Date: '.$data['pickup_date'].' Please call +91-8850699195 for assistance'; 

		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function sendOrderConfirmSMS($data) {
		$name = explode(" ",$data['name']);
		$fname = $name[0];
		//$sms_msg = 'Hi '.$fname.', your appointment has been confirmed and we will be there to serve you at the given time and address. Thanks for choosing '.COMPANY.'.';
		/*$sms_msg = 'Mechanic is been assigned for your vehicle. You will receive a call from the mechanic to confirm your availability & service location';*/

		$bookingid = $data['ordercode'];
		$vendor_name   =   $data['vendor_name'];
		$vendor_mobile   =   $data['vendor_mobile']; 
		$rider_name   =   $data['rider_name'];
		$rider_mobile   =   $data['rider_mobile']; 

		$sms_msg = 'Dear '.$fname.'! Your booking has been confirmed. Booking ID: '.$bookingid.' Professionals Name: '.$vendor_name.' Contact Info:'.$vendor_mobile.' Rider Name: '.$rider_name.' Rider_contact: '.$rider_mobile.' Our Professional will contact you shortly.';  

		$this->CI->load->library ( 'Pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
 
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function sendInvoiceSMS($data) {
		$name = explode(" ",$data['name']);
		$fname = $name[0];
		$invoiceurl = base_url().$data['invoice_url'];
		 
		/*$sms_msg = 'Invoice is Generated. Invoice Link: '.$invoiceurl.' Bill amount : Rs '.$data['bill_amount'].' Payment Link: '.$data['payment_url'].' Kindly pay the bill amount before the vehicle delivery or on delivery.';*/

		$sms_msg = 'Dear '.$fname.'! Your service is completed sucessfully. Invoice Link: '.$invoiceurl.' Thank you choosing ServiceOn as a service partner. Please rate us to improve our service'; 
		
		$this->CI->load->library ( 'Pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function sendOrderSMSToNumbers($data,$vendor_mobiles) {
		$date = date('j M Y',strtotime($data['pickup_date']));
		$sms_msg = 'New order assign! BookingID: '.$data['ordercode'].' Name: '.$data['name'].', Mobile no:'.$data['mobile'].', Rider name:'.$data['rider_name'].', Rider mobile:'.$data['rider_mobile'].', Date:'.$date;
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
		$sms_msg = 'Clean clothes ready! '.COMPANY.' will call you shortly to confirm delivery today. Check Invoice & Pay: <URL>';
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	/* public function sendInvoiceSMS($data) {
		$sms_msg = 'Hello ' . $data ['name'] . ' , Your bill amounts to Rs. '.$data['bill_amount'].'. Please Check your invoice. '.$data['payment_url'].' Regards, '. COMPANY;
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	} */
	
	public function sendPickUpBoySMS($data) {
		$sms_msg = 'Dear Rider, here is new order bookingID: '.$data['ordercode'].' to pickup bike From \n Name:'.$data['name'].', Mobile no:'.$data['mobile'].', \n Address:'.$data['address'].', \n Pick up time:'.$data['pickup_date']. $data['pickup_slot'].' \n And deliver to \n Garage Name:'.$data['vendor_name'].', Garage Mobile:'.$data['vendor_mobile'].', \n Garage Address:'.$data['vendor_address'];
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = (isset($data ['pickup_executive_mobile']))?$data ['pickup_executive_mobile']:$data['rider_mobile'];
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
			$this->CI->load->model ('orders/Order_model','order');
			$orderdata['orderid'] = $data['orderid'];
			$orderdata['tracking_id'] = $resp['Tracking No'];
			$this->CI->order->updateOrder($orderdata);
		}
	}
	
	public function addPaymentDetail($payment) {
		$this->CI->load->model ('orders/Order_model','order');
		$this->CI->order->addPaymentDetail($payment);
	}
	
	public function getTodaysPendingPayments() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getTodaysPendingPayments();
	}
	
	public function deliveryAttemptedSMS($data) {
		$sms_msg = 'Hi There, We were unsuccessful in our attempt to deliver your order. Please call us back. Regards, '.COMPANY;
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function deliveryCallAnsweredSMS($data) {
		$sms_msg = 'Hi There, We tried reaching you but couldn\'t connect. Please let us know time for your delivery or call us back. Regards, '.COMPANY;
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function pickupAttemptedSMS($data) {
		$sms_msg = 'Hi There, We were unsuccessful in our attempt to pick up your order. Please call us back. Regards, '.COMPANY;
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function getlatestOrderDetails($userid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getlatestOrderDetails($userid);
	}
	
	public function updateCrondetails($data){
		$this->CI->load->model ('orders/Order_model','order');
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
		//$sms_msg = 'Hi '.$fname.', Thanks for confirming the estimate. Have mailed you the details. Will inform you once we complete the services. Thanks, '.COMPANY.'!';
		$sms_msg = 'As per your request the estimate is updated and confirmed, The work will start shortly. You will be notified once the work is completed';
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function confirmApproval_email($data) { 
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'Estimate confirmation | '. COMPANY;
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
		//$sms_msg = 'Hi '.$fname.', Your Bike is ready ! Thanks, Team '.COMPANY.'!';
		// $sms_msg = 'Servicing is complete & your vehicle is ready for delivery. The Mechanic will contact you for delivery';
		$bookingid = $data['ordercode'];

		$sms_msg = 'Dear '.$fname.'! Your service has been completed. Booking ID: '.$bookingid.' Payment Details: Please refer your e-mail for detailed invoice HAPPY RIDING!!!'; 

		/*$sms_msg = 'Dear '.$fname.'!'; 
		$sms_msg.="\r\n";
		$sms_msg ='Your service has been completed.';
		$sms_msg.="\r\n";
		$sms_msg =''.$bookingid.'';
		$sms_msg.="\r\n";
		$sms_msg ='Payment Details:';
		$sms_msg.="\r\n";
		$sms_msg ='Please refer your e-mail for detailed invoice.';
		$sms_msg.="\r\n";
		$sms_msg ='HAPPY RIDING!!!'; 
 */
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
		Hi ". $fname.",<br><br>Your Bike is ready! Thanks again for choosing '.COMPANY.'.<br/><br /> 
				Thanks, <br />
				Team '.COMPANY.'!
				</body>
				</html>";
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = ''. COMPANY;
		$this->CI->pkemail->subject = 'Work Completed';
		$this->CI->pkemail->mctag = 'Work Completed';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $data['email'];
		$this->CI->pkemail->send_email ( $messages );
	} */
	
	public function markworkCompleted_email($data) {
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'Work Completed | '. COMPANY;
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
		//$sms_msg = 'Hi '.$fname.', We have generated and mailed you an estimate based on our expert inspection. Kindly check and confirm the same to start the services. Thanks, Team '.COMPANY.'!';
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
		/*$sms_msg = 'Dear '.$fname.', Mechanic has delivered the vehicle, take a test drive and let us know your feedback If you are satisfied with the service take some time to review us on google / facebook Google : https://goo.gl/1w6uop and/or Facebook https://goo.gl/4LF8et If you are not satisfied please contact 9011941194 immediately, so we could schedule rework to solve the issues.';*/

		$bookingid = $data['ordercode'];

		$sms_msg = 'Dear '.$fname.'! Your service has been completed. Booking ID: '.$bookingid.' Payment Details: Please refer your e-mail for detailed invoice HAPPY RIDING!!!'; 

		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function getUserNotification($userid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getUserNotification($userid);
	}
	
	public function sendBookingNotification($userid) {
		$curr_date=date('d-M-Y H:i:s');
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$gcm_id = $this->CI->userlogin->getUserGcmIdsbyId ($userid);
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
/*			$this->CI->load->model ('orders/Order_model');
			$resp= $this->CI->Order_model->addNotificationRider($notification);*/

			sendFCMPushNotificationSingle($gcmid, $message, $title);
			//$response['nstatus'] = 1;
			//$response['nmsg'] = 'Notification sent successfully.';
		} else {
			//$response['nstatus'] = 0;
			//$response['nmsg'] = 'Failed to send Notification';
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
	
	public function sendAssignedgarageNotification($userid) {
		$curr_date=date('d-M-Y H:i:s');
		$this->CI->load->model ( 'users/User_model', 'userlogin' );
		$gcm_id = $this->CI->userlogin->getUserGcmIdsbyId ( $userid );
		
		//print_r($gcm_id);

		$gcmid = $gcm_id[0]['gcm_reg_id'];
	
		$title = 'Mechanic assigned';
		/*$msg = 'Mechanic booked. Mechanic is been assigned for your service. He will call you before leaving for your appointment '.$curr_date.' ';*/
		$msg = 'Professional for your service request has been assigned. Lay back and enjoy!!';

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
	
	public function getServicedate() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getServicedate();
	}
	
	public function addRemindOrder($userid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->addRemindOrder($userid);
	}
	
	public function getallReminderOrders() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getallReminderOrders();
	}
    public function get_services_by_group($param) {
        $this->CI->load->model ('orders/Order_model','order');
    return $this->CI->order->get_services_by_group($param);
    }
    
    public function get_services_by_id($param) {
        $this->CI->load->model ('orders/Order_model','order');
    return $this->CI->order->get_services_by_id($param);
    }

    public function get_spare_by_id($param) {
        $this->CI->load->model ('orders/Order_model','order');
    return $this->CI->order->get_spare_by_id($param);
    }
    public function get_vehicles_by_id($id) {
        $this->CI->load->model ('orders/Order_model','order'); 
    return $this->CI->order->get_vehicles_by_id($id);
    }
	public function getUserpackageDetails($userid,$package_id) {
        $this->CI->load->model ('orders/Order_model','order');
    return $this->CI->order->getUserpackageDetails($userid,$package_id);
    }
    public function updatePackageServices($param) {
         $this->CI->load->model ('orders/Order_model','order'); 
         return $this->CI->order->updatePackageServices($param);
    }
    public function order_packege_services($order_id) {
         $this->CI->load->model ('orders/Order_model','order');
         return $this->CI->order->order_packege_services($order_id); 
    }   
    public function get_subcategory_id_by_modelId($sub_id,$model_id) { 
        $this->CI->load->model ('orders/Order_model','order');
    return $this->CI->order->get_subcategory_id_by_modelId($sub_id,$model_id);
    }
    public function vehicle_id_by_packageId($userid,$package_id) { 
        $this->CI->load->model ('orders/Order_model','order');
    return $this->CI->order->vehicle_id_by_packageId($userid,$package_id);
    } 
    public function getVendorDetailsByVendorId($id) { 
        $this->CI->load->model ('orders/Order_model','order');
    return $this->CI->order->getVendorDetailsByVendorId($id);
    } 
    public function getServiceDetailsByOrderId($id) { 
        $this->CI->load->model ('orders/Order_model','order');
    return $this->CI->order->getServiceDetailsByOrderId($id);
    }
     public function getInvoiceDetailsByOrderId($id) { 
        $this->CI->load->model ('orders/Order_model','order');
    return $this->CI->order->getInvoiceDetailsByOrderId($id);
    }
    public function getOrdercount($orderid,$userid) {
        $this->CI->load->model ('orders/Order_model','order');
    return $this->CI->order->getOrdercount($orderid,$userid);
    }
    public function getOrdercountFromUserPackage($orderid,$userid) {
        $this->CI->load->model ('orders/Order_model','order');
    return $this->CI->order->getOrdercountFromUserPackage($orderid,$userid);
    }
    public function getUserPackageCount($userid,$package_id) {
        $this->CI->load->model ('orders/Order_model','order');
    return $this->CI->order->getUserPackageCount($userid,$package_id);
    } 
    public function getOrdercountFromUserPackage1($orderid,$userid) {
        $this->CI->load->model ('orders/Order_model','order');
    return $this->CI->order->getOrdercountFromUserPackage1($orderid,$userid);
    }
    public function UpdateWallet($wallets,$walletuserid) {
   		$this->CI->load->model ( 'users/Wallet_model', 'wallet' );
		$this->CI->wallet->UpdateWallet ( $wallets );
		$this->CI->wallet->createTransaction ( $wallets ); 

    }
    public function addReferPointWallet($wallets) {
   		$this->CI->load->model ( 'users/Wallet_model', 'wallet' );
		$this->CI->wallet->addToWallet ( $wallets ); 

    }
    public function getWalletBalance($userid) {
		$this->CI->load->model ( 'users/Wallet_model', 'wallet' );
		return $this->CI->wallet->getWalletBalance ( $userid );
	}

    
}