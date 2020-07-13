<?php

class ClientorderLib {

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('orders/Clientorder_model', 'order_model'); 
    }

    public function get_services_by_id($data) {
        return $this->CI->order_model->get_services_by_id($data);
    }
    public function get_vendor_by_name($param) {
        return $this->CI->order_model->get_vendor_by_name($param);
    }
    public function add_order($param) { 
        return $this->CI->order_model->add_order($param);
    }
    public function add_booking_services($param) {
        return $this->CI->order_model->add_booking_services($param);
    }
    public function update_order($param) {
         return $this->CI->order_model->update_order($param);
    }
    public function add_order_logs($param) {
         return $this->CI->order_model->add_order_logs($param);
    }
   public function getPendingOrdersByDate() { 
        return $this->CI->order_model->getPendingOrdersByDate();
    }
    public function allOngoingOrders() { 
        return $this->CI->order_model->allOngoingOrders();
    }
    public function allWorkingOrders() { 
        return $this->CI->order_model->allWorkingOrders();
    }
    public function getApprovalOrdersByDate() { 
        return $this->CI->order_model->getApprovalOrdersByDate();
    }
    public function getCompletedOrdersByDate() { 
        return $this->CI->order_model->getCompletedOrdersByDate();
    }
    public function getDeliveryCompletedOrdersByDate() { 
        return $this->CI->order_model->getDeliveryCompletedOrdersByDate();
    }
    public function getCancelledOrdersByDate() { 
        return $this->CI->order_model->getCancelledOrdersByDate();
    }
    public function allCompletedOrders() { 
        return $this->CI->order_model->allCompletedOrders();
    }
    public function allDeliveryCompletedOrders() { 
        return $this->CI->order_model->allDeliveryCompletedOrders();
    } 
    public function allCanceledOrders() { 
        return $this->CI->order_model->allCanceledOrders();
    }  
   public function getOrderDetails($orderid) { 
        return $this->CI->order_model->getOrderDetails($orderid);
    }
   public function getActiveMainStatus() { 
        $response = $this->CI->order_model->getActiveMainStatus();
        return $response;
    }
   public function getOrderLogs($orderid) { 
        return $this->CI->order_model->getOrderLogs($orderid);
    }
   public function getOrderItems($orderid) { 
        return $this->CI->order_model->getOrderItems($orderid);
    } 
   public function updateOrder($orderdata) { 
        return $this->CI->order_model->updateOrder($orderdata);
    }  
   public function getOrderDetailsByOrderId($orderid) { 
        return $this->CI->order_model->getOrderDetailsByOrderId($orderid);
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
   public function getVendorDetails() {
        return $this->CI->order_model->getVendorDetails();
    } 
    public function getAssignedOrdersByDate() { 
        return $this->CI->order_model->getAssignedOrdersByDate();
    }
    public function get_services_by_outlet_id($data) {
        return $this->CI->order_model->get_services_by_outlet_id($data);
    }
    public function searchItemName($params) { 
        return $this->CI->order_model->searchItemName($params);
    }
    public function getItemById($service_id) { 
        $response = $this->CI->order_model->getItemById ($service_id);
        return $response;
    }
    public function remove_booking_services($order_id) {
        $this->CI->order_model->remove_booking_services ($order_id);
    }
    public function get_order_for_invoice($order_id) {
        return $this->CI->order_model->get_order_for_invoice ($order_id);
    }
    
    public function invoices() {
        return $this->CI->order_model->invoices();
    }
    
    public function get_bike_by_id($param) {
         return $this->CI->order_model->get_bike_by_id($param);
    }
    
    
//    public function get_package_deatils($package_id, $bike_id, $order_id) {
//        return $this->CI->order_model->get_package_deatils($package_id, $bike_id, $order_id);
//    }
    
    public function order_packege_services($param) {
        return $this->CI->order_model->order_packege_services($param);
    }
    public function getservicecount($param) {
        return $this->CI->order_model->getservicecount($param);
    }
    public function get_package_deatails2($param, $bk, $id) {
         return $this->CI->order_model->get_package_deatails2($param, $bk, $id);
    }
    public function cofirm_estimate_list() {
        return $this->CI->order_model->cofirm_estimate_list();
    }
    public function get_package_count($bike_id, $package_id) {
        return $this->CI->order_model->get_package_count($bike_id, $package_id);
    }
    public function get_package_service_used_validity($package_id) {
        return $this->CI->order_model->get_package_service_used_validity($package_id);
    }
    public function order_details_by_bulk_id($param) {
        return $this->CI->order_model->order_details_by_bulk_id($param);
    }
    public function sendBulkBookingInvoiceEmail($data) {
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
        $text_body = $this->CI->template->build ( 'frontend/emails/bulk-invoice', '', true );
        $this->CI->pkemail->send_email ( $text_body ); 
    }
    public function sendBulkBookingInvoiceSMS($data) {
        $name = explode(" ",$data['name']);
        $fname = $name[0];
        $invoiceurl = base_url().$data['invoice_url'];
         
        $sms_msg = 'Dear '.$fname.'! Your service is completed sucessfully. Thank you choosing Bikedoctor as a service partner. Invoice Details: Please refer your e-mail for detailed invoice HAPPY RIDING!!!'; 

        $this->CI->load->library ( 'Pksms' );
        $map = array ();
        $map ['mobile'] = $data ['mobile'];
        $map ['message'] = $sms_msg;
        $this->CI->pksms->sendSms ( $map );
    }

    public function sendOutletInvoiceEmail($data) {
        $this->CI->load->library ( 'pkemail' );
        $this->CI->pkemail->load_system_config ();
        $this->CI->pkemail->headline = 'Your Order Invoice |'. COMPANY;
        $this->CI->pkemail->subject = 'Your Order Invoice | '. COMPANY;  
        $this->CI->pkemail->mctag = 'invoice';
        $this->CI->pkemail->attachment = 0;
        $this->CI->pkemail->to = $data ['email'];
        $this->CI->template->set ( 'data', $data );
        $this->CI->template->set ( 'page', 'invoice' );
        $this->CI->template->set_layout ( false );
        $text_body = $this->CI->template->build ( 'frontend/emails/bulk-invoice', '', true );
        $this->CI->pkemail->send_email ( $text_body );
    }

}
