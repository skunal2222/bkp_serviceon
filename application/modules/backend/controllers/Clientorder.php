<?php 
class Clientorder extends MX_Controller {

	public function __construct() {
		parent::__construct ();
	} 
	
	public function newOrder() {
		$this->load->library('zyk/ClientLib', 'clientlib');
		$this->load->library('zyk/AreaLib', 'arealib'); 
		$this->load->library('zyk/OutletLib', 'outletlib');  
		$this->template->set('cities', $this->arealib->getActiveCities());
		$this->template->set('clients', $this->clientlib->getClients());
                $this->template->set_theme('default_theme');
		$this->template->set_layout('backend')
                                ->title('Administrator | Client Order')
                                ->set_partial('header', 'partials/header')
                                ->set_partial('leftnav', 'partials/sidebar')
                                ->set_partial('footer', 'partials/footer')
                                ->build('clientorders/ClientNewOrder');
	}
	
	public function addClientOrder() {
                
                $bike_id = $this->input->post('bike_id', TRUE);
                //
                $package_id = $this->input->post('package_id', TRUE);
                
               
                $this->load->library('zyk/ClientorderLib', 'clientorderlib'); 
                
                $bulk = array(
                        'package_payment_mode'=> $_POST['package_payment_mode'],
                        'cheque_no' => $_POST['cheque_no'],
                        'date' => date('Y-m-d H:i:s')
                        );
                $this->db->insert('tbl_bulk_invoice', $bulk);
                $bulk_id = $this->db->insert_id();
                foreach ($bike_id as $key => $value) {
                   
                    if(!isset($_POST['service_id_'.$value]) && $package_id[$key] == 0) {
                        echo json_encode(array('status' => 0, 'msg' => 'Service or packages required for Sr. no '. ($key + 1)));
                        exit;
                    }
                }    
                $rate = $this->db->select('rate_card_id')->from('tbl_outlets')->where('id', $this->input->post('outlet_id', TRUE))->get()->result_array();
                $rate_id = $rate[0]['rate_card_id'];
                foreach ($bike_id as $key => $value) {
                    
                    
                    $insert = array(
                            'client_id' => $this->input->post('client_id', TRUE),
                            'city_id' => $this->input->post('city_id', TRUE),
                            'outlet_id' => $this->input->post('outlet_id', TRUE),
                            'created_by' => $this->session->adminsession['id'],
                            'status' => 0,
                            'bulk_id' => $bulk_id,
                            'ordered_on' => date('Y-m-d H:i:s'),
                        );
                    
                    $insert['bike_id'] = $value;
                    if($package_id[$key] != 0) {
                        $insert['package_id'] = $package_id[$key];
                    }
                    $response_data = $this->clientorderlib->add_order($insert); 
                    $order_id = $response_data['order_id'];
                    $logs = array(
                        'order_id' => $order_id,
                        'comment' => 'Booking Request Sent.',
                        'created_date' => date('Y-m-d H:i:s'),
                        'created_by' => $this->session->adminsession['id']
                        );
		    $this->clientorderlib->add_order_logs($logs);
                    $Inserdata = array();
                    $amount = 0;
                    
                    if(isset($_POST['service_id_'.$value])) {
                        $service_id = $_POST['service_id_'.$value]; 
                        $service = $this->clientorderlib->get_services_by_id($service_id);
                        foreach ($service as $value) {
                           
                            $price = $value['special_price'] > 0 ? $value['special_price'] : $value['price'];
                            $amount = $amount + $price;
                            $Inserdata[] = array(
                                        'order_id' => $order_id,
                                        'service_id' => $value['id'],
                                        'service_name' => $value['service_name'],
                                        'service' => $value['type'],
                                        'price' => $price
                                        ); 
                        }
                        $this->clientorderlib->add_booking_services($Inserdata);
                    }
                    $oupdate = array();
                    $oupdate['order_id'] = $order_id;
                    $oupdate['amount'] = $amount;
                    $oupdate['rate_id'] = $rate_id;
                    $oupdate['package_price'] = $response_data['package_price'];
                    $oupdate['ordercode'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($order_id, 10, 36)) ;
                    $this->clientorderlib->update_order($oupdate);
                    $response['orderid'] = $order_id;
                    $response['status'] = 1;
                    $response['msg'] = "Order punched in system";
                } 
                echo json_encode($response);
	}



    public function get_services_by_id() {
        $data = $this->input->post('service_id', FALSE);
        $this->load->library('zyk/ClientorderLib');
        echo json_encode($this->clientorderlib->get_services_by_id($data));
    }
    
    public function get_vendor_by_name() {
        $name = $this->input->get('name', FALSE);
        $this->load->library('zyk/ClientorderLib');
        echo json_encode($this->clientorderlib->get_vendor_by_name($name));
    }

    public function pendingOrders() {
        $current_date = date('Y-m-d');
        $this->load->library('zyk/ClientorderLib');
        $adminsession = $this->session->userdata ( 'adminsession' ); 

        //$store_id = $adminsession['store_id'];
        //$role_id = $adminsession['user_role'];

        if(empty($this->input->post('client_id')) && empty($this->input->post('outlet_id')) && empty($this->input->post('bike_id')) ) {
            $orders = $this->clientorderlib->getPendingOrdersByDate(); 

        } else {
            $map = array();
            $map['status'] = 0;
            //$map['role_id'] = $role_id;
            //$map['store_id'] = $store_id;
            if(!empty($this->input->post('client_id')))
                $map['client_id'] = $this->input->post('client_id');
            if(!empty($this->input->post('outlet_id')))
                $map['outlet_id'] = $this->input->post('outlet_id');
            if(!empty($this->input->post('bike_id')))
                $map['bike_id'] = $this->input->post('bike_id'); 
            $orders = $this->clientorderlib->filterOrders($map);
        }
        //$orders = $this->orderlib->allOrders();
        $this->template->set('page','porders');
        $this->template->set('orders',$orders);
        $this->template->set_theme('default_theme');
        $this->template->set_layout ('backend')
        ->title ( 'Administrator | Order Dashboard' )
        ->set_partial ( 'header', 'partials/header' )
        ->set_partial ( 'leftnav', 'partials/sidebar' )
        ->set_partial ( 'footer', 'partials/footer' );
        $this->template->build ('clientorders/PendingOrders');
    }

    public function orderDetail($orderid) {
        $current_date = date('Y-m-d');
        $this->load->library('zyk/ClientorderLib');  
        $orders = $this->clientorderlib->getOrderDetails($orderid);
    //  print_r($orders);exit;
   
        $package = array();
        $packageservices = array();
        $servicecnt = array();
        $tbl_booking_packges = array();
        $items = $this->clientorderlib->getOrderItems($orderid);
        $logs  = $this->clientorderlib->getOrderLogs($orderid);
        $garage = $this->clientorderlib->getVendorDetails();
        
        if($orders[0]['package_id'] != 0) {
            $this->load->library('zyk/PackageLib'); 
            $package  = $this->clientorderlib->get_package_deatails2($orders[0]['package_id'], $orders[0]['bike_id'], $orderid);
            
            $packageservices = $this->packagelib->getPackageServices2($orders[0]['package_id']);
            $servicecnt = $this->clientorderlib->getservicecount($package[0]['order_ids']);
            $tbl_booking_packges = $this->clientorderlib->order_packege_services($orderid);
        }
        
        $this->template->set('package', $package);
        $this->template->set('packageservices', $packageservices);
        $this->template->set('servicecnt', $servicecnt);
        $this->template->set('tbl_booking_packges', $tbl_booking_packges);
        $this->template->set('order',$orders[0]);
       // $this->template->set('status',$status); 
        $this->template->set('items',$items);
        $this->template->set('logs',$logs); 
        $this->template->set('garage',$garage);
    //  $this->template->set_theme('default_theme');
        $this->template->set_layout ('backend')
        ->title ( 'Administrator | Order' )
        ->set_partial ( 'header', 'partials/header' )
        ->set_partial ( 'leftnav', 'partials/sidebar' )
        ->set_partial ( 'footer', 'partials/footer' );
        $this->template->build ('clientorders/OrderDetails');
    }   
    public function updateOrderAdjustment($orderid) {
		$this->load->library('zyk/ClientorderLib');
		$adj_type = $this->input->post('adj_type');
		$adjustment = $this->input->post('adjustment');
		$orders = $this->clientorderlib->getOrderDetails($orderid);
		if($adj_type == 1) {
			$adjustment = $adjustment * -1;
		}
		$orderdata = array();
		$orderdata['order_id'] = $orderid;
		$orderdata['amount'] = $orders[0]['amount'] + $adjustment;
		$orderdata['adjustment'] = $adjustment;
		$this->clientorderlib->updateOrder($orderdata);
		$response['status'] = 1;
		$response['msg'] = 'Order Updated Successfully.';
		echo json_encode($response);
	}
    public function assignDelivery($orderid) {
        $this->load->library('zyk/ClientorderLib');
        $this->load->library('zyk/MechanicLib');
        $garage_id = $this->input->get('vendor_id');
        $vendor_mobiles = $this->input->get('vendor_mobiles');
        $response = array();
        $orderdata = array();
        $orderdata['order_id'] = $orderid;
        //$orderdata['delivery_slot'] = $this->input->get('delivery_slot');
        $orderdata['vendor_id'] = $this->input->get('vendor_id');
        $orderdata['assign_vendor_id'] = $this->input->get('vendor_id');
        $orderdata['other_vendorid'] = $this->input->get('other_vendor');
        //$orderdata['tml_delivery_date'] = date('Y-m-d',strtotime($this->input->get('delivery_date')));
        $orderdata['vendor_response'] =1;
        //$orderdata['status'] = 2;
        $orderdata['status'] = 1; 

        $this->clientorderlib->updateOrder($orderdata);
        $orders = $this->clientorderlib->getOrderDetailsByOrderId($orderid); 

       /* $data['ordercode'] = $orders[0]['ordercode'];
        $data['name'] = $orders[0]['name'];
        $data['poc_mob'] = $orders[0]['poc_mob'];
        $data['poc_email'] = $orders[0]['poc_email'];
        $data['locality'] = $orders[0]['locality'];
        $data['address'] = $orders[0]['address'];   
        $data['pickup_date'] = $orders[0]['pickup_date'];
        $data['time_slot'] = $orders[0]['slot'];
        $this->clientorderlib->sendOrderConfirmEmail($data);
        $this->clientorderlib->sendOrderConfirmSMS($data);
        $this->clientorderlib->sendAssignedgarageNotification($orders[0]['userid']);
        $this->mechaniclib->sendGarageAssignedNotification($garage_id);
        if(!empty($vendor_mobiles)){
            $this->clientorderlib->sendOrderSMSToNumbers($data,$vendor_mobiles);
        } */
        $logs = array();
        $logs['order_id'] = $orderid;
        $logs['comment'] = 'Mechanic Assigned.';
        $logs['created_date'] = date('Y-m-d H:i:s');
        $logs['order_status'] = 1;
        $logs['created_by'] = $this->session->userdata('adminsession')['id'];
        $this->clientorderlib->add_order_logs($logs); 
        $response['status'] = 1;
        $response['message'] = 'Order Assigned To Mechanic.';
        echo json_encode($response);
    }
    public function assignedOrders() {
        $current_date = date('Y-m-d');
        $this->load->library('zyk/ClientorderLib');
       // $adminsession = $this->session->userdata ( 'adminsession' );
        //$store_id = $adminsession['store_id'];
        //$role_id = $adminsession['user_role'];
        $orders = $this->clientorderlib->getAssignedOrdersByDate(); 
         
        $this->template->set('page','porders');
        $this->template->set('orders',$orders);
        $this->template->set_theme('default_theme');
        $this->template->set_layout ('backend')
        ->title ( 'Administrator | Order Dashboard' )
        ->set_partial ( 'header', 'partials/header' )
        ->set_partial ( 'leftnav', 'partials/sidebar' )
        ->set_partial ( 'footer', 'partials/footer' );
        $this->template->build ('clientorders/AssignedOrders');
    }

    public function ongoingOrders() {  

        $this->load->library('zyk/ClientorderLib');
        $orders = $this->clientorderlib->allOngoingOrders(); 

        $this->template->set('orders',$orders);
        $this->template->set_theme('default_theme');
        $this->template->set_layout ('backend')
        ->title ( 'Administrator | Order Dashboard' )
        ->set_partial ( 'header', 'partials/header' )
        ->set_partial ( 'leftnav', 'partials/sidebar' )
        ->set_partial ( 'footer', 'partials/footer' );
        $this->template->build ('clientorders/OngoingOrders');
    }
    public function approvalOrders() {
        $current_date = date('Y-m-d'); 

        $this->load->library('zyk/ClientorderLib');
        $orders = $this->clientorderlib->getApprovalOrdersByDate(); 
 
        $this->template->set('orders',$orders);
        $this->template->set_theme('default_theme');
        $this->template->set_layout ('backend')
        ->title ( 'Administrator | Order Dashboard' )
        ->set_partial ( 'header', 'partials/header' )
        ->set_partial ( 'leftnav', 'partials/sidebar' )
        ->set_partial ( 'footer', 'partials/footer' );
        $this->template->build ('clientorders/ApprovalOrders');
    }
    public function completedOrders() {
        $current_date = date('Y-m-d'); 

        $this->load->library('zyk/ClientorderLib');
        $orders = $this->clientorderlib->getCompletedOrdersByDate();  

        $this->template->set('orders',$orders);
        $this->template->set_theme('default_theme');
        $this->template->set_layout ('backend')
        ->title ( 'Administrator | Order Dashboard' )
        ->set_partial ( 'header', 'partials/header' )
        ->set_partial ( 'leftnav', 'partials/sidebar' )
        ->set_partial ( 'footer', 'partials/footer' );
        $this->template->build ('clientorders/CompletedOrders');
    }
    public function deliveryCompletedOrders() {
        $current_date = date('Y-m-d'); 

        $this->load->library('zyk/ClientorderLib');
        $orders = $this->clientorderlib->getDeliveryCompletedOrdersByDate();  
   
        $this->template->set('orders',$orders);
        $this->template->set_theme('default_theme');
        $this->template->set_layout ('backend')
        ->title ( 'Administrator | Order Dashboard' )
        ->set_partial ( 'header', 'partials/header' )
        ->set_partial ( 'leftnav', 'partials/sidebar' )
        ->set_partial ( 'footer', 'partials/footer' );
        $this->template->build ('clientorders/DeliveryCompletedOrders');
    }
    public function cancelledOrders(){
        $current_date = date('Y-m-d'); 

        $this->load->library('zyk/ClientorderLib');
        $orders = $this->clientorderlib->getCancelledOrdersByDate();  
   
        $this->template->set('orders',$orders);
        $this->template->set_theme('default_theme');
        $this->template->set_layout ('backend')
        ->title ( 'Administrator | Order Dashboard' )
        ->set_partial ( 'header', 'partials/header' )
        ->set_partial ( 'leftnav', 'partials/sidebar' )
        ->set_partial ( 'footer', 'partials/footer' );
        $this->template->build ('clientorders/CancelledOrders');
    }
    
      
    public function get_services_by_outlet_id($outlet_id) {   
        $this->load->library('zyk/ClientorderLib');
        echo json_encode($this->clientorderlib->get_services_by_outlet_id($outlet_id));
    }
    public function add_type_into_session() {
            $_SESSION['type_a'] = $_POST['a'];
            echo json_encode('success');
        }
    
    public function searchItem($rate_id) {
        
        $product_name = $this->input->get('name');
        $params['type'] = $_SESSION['type_a']; 
        $params['rate_id'] = $rate_id; 
        $params['name'] = $product_name;
        
        $this->load->library('zyk/ClientorderLib');
        $response = $this->clientorderlib->searchItemName($params);
        echo json_encode($response);
    }
    public function getItem($service_id) { 
        $this->load->library('zyk/ClientorderLib'); 
        $response = $this->clientorderlib->getItemById($service_id);
        //print_r($response);
        if(!empty($response)) {
           $price = $response[0]['special_price'] > 0 ? $response[0]['special_price'] : $response[0]['price'];
            echo json_encode(array('id' => $response[0]['id'], 'price' => $price));
        }
        
    }
    
    public function additems() {
         $this->load->library('zyk/ClientorderLib');
        $service_id = $_POST['itemid'];
        $service = $this->clientorderlib->get_services_by_id($service_id);
        $Inserdata = array();
        $amount = 0;
        $order_id = $_POST['order_id'] ;    
                foreach ($service as $value) {
                    
                    $price = $value['special_price'] > 0 ? $value['special_price'] : $value['price'];
                    $amount = $amount + $price;
                    $Inserdata[] = array(
                                'order_id' => $order_id,
                                'service_id' => $value['id'],
                                'service_name' => $value['service_name'],
                                'service' => $value['type'],
                                'price' => $price
                                ); 
                }
        $this->clientorderlib->remove_booking_services($order_id);        
        $this->clientorderlib->add_booking_services($Inserdata);
        $oupdate['order_id'] = $order_id;
        $oupdate['amount'] = $amount;
        $oupdate['status'] = 2;
        $this->clientorderlib->update_order($oupdate);
        $response['status'] = 1;
        $response['message'] = 'Services updated.';
        echo json_encode($response);
    }
    
    public function service_approved() {
        
        $this->load->library('zyk/ClientorderLib');
        $itemcheck = $this->input->post('is_checked');
    	$itemids = $this->input->post('itemid');
    	$itemnames = $this->input->post('itemname');
    	$itemprices = $this->input->post('price');
    	$itemtypes = $this->input->post('itemtype');
    	$itempriority = $this->input->post('priority');
    	$orderid = $this->input->post('order_id');
	$ordertotal = 0;
    	$items = array();
    	for ($i = 0; $i < count($itemids); $i++) {
    		$item = array();
    		$item['order_id'] = $orderid;
    		$item['service_id'] = $itemids[$i];
    		$item['service_name'] = $itemnames[$i];
    		$item['price'] = $itemprices[$i];
    		$item['service'] = $itemtypes[$i];
    		$item['priority'] = $itempriority[$i];
    		$item['is_checked'] = $itemcheck[$i];
    		//echo $itemcheck[i];
    		if($item['is_checked'] == 1){
    			//echo "itemcheck";
    			$ordertotal = $ordertotal + $itemprices[$i];;
    		}
    		$items[] = $item;
   	}
        $this->clientorderlib->remove_booking_services($orderid);        
        $this->clientorderlib->add_booking_services($items);
        $oupdate['order_id'] = $orderid;
        $oupdate['amount'] = $ordertotal;
        $oupdate['status'] = 2;
        $this->clientorderlib->update_order($oupdate);
        echo json_encode(array('status' => '1', 'message' => 'Item updated successfully'));
    }
    
    function confirmApproval($order_id) {
        $this->load->library('zyk/ClientorderLib');
    	$orderdata['order_id'] = $order_id;
    	$orderdata['status'] = 3;
    	$this->clientorderlib->update_order($orderdata);
    	$logs['order_id'] = $order_id;
    	$logs['comment'] = 'Estimate Confirmed.';
    	$logs['created_date'] = date('Y-m-d H:i:s');
    	$logs['created_by'] = $this->session->userdata('adminsession')['id'];
    	$this->clientorderlib->add_order_logs($logs);
    	echo json_encode(array('msg'=>'Estimate Confirm successfully.'));
    }
    
    function markworkCompleted($order_id) {
        $this->load->library('zyk/ClientorderLib');
    	$orderdata['order_id'] = $order_id;
    	$orderdata['status'] = 4;
    	$this->clientorderlib->update_order($orderdata);
    	$logs['order_id'] = $order_id;
    	$logs['comment'] = 'Work Completed.';
    	$logs['created_date'] = date('Y-m-d H:i:s');
    	$logs['created_by'] = $this->session->userdata('adminsession')['id'];
    	$this->clientorderlib->add_order_logs($logs);
    	echo json_encode(array('msg'=>'Work Completed successfully'));
    }
    
    public function invoice_generate($order_id) {
        $this->load->library('zyk/ClientorderLib');
        //status 5 for cancel
        $data = $this->clientorderlib->get_order_for_invoice($order_id);
 
        $html = $this->load->view('clientorders/client_invoice', $data, TRUE);
        $file_name = "B2B_invoice_".$order_id.".pdf";
        $this->load->library('MyPdfLib');
        $url = $this->mypdflib->getPdf($html, $file_name);
        $orderdata['order_id'] = $order_id;
    	$orderdata['status'] = 6;
        $orderdata['invoice_status'] = 1;
        $orderdata['invoice_url'] = $url;
        $orderdata['invoice_date'] = date('Y-m-d'); 
        
    	$this->clientorderlib->update_order($orderdata);

        $orders = $this->clientorderlib->getOrderDetails($order_id); 
       /* $data1['name'] = $orders[0]['outlet_name'];
        $data1['email'] = $orders[0]['manager_email'];
        $data1['mobile'] = $orders[0]['manager_mobile'];
        $data1['invoice_url'] = $orderdata['invoice_url']; 

        $this->clientorderlib->sendOutletInvoiceEmail($data1);*/
    	$logs['order_id'] = $order_id;
    	$logs['comment'] = 'Invoice Generated';
    	$logs['created_date'] = date('Y-m-d H:i:s');
    	$logs['created_by'] = $this->session->userdata('adminsession')['id'];
    	$this->clientorderlib->add_order_logs($logs);
    	echo json_encode(array('msg'=>'Invoice Generated Successfully.'));
    }
    public function cancel_order($order_id) {
        $this->load->library('zyk/ClientorderLib');
        $orderdata['order_id'] = $order_id;
    	$orderdata['status'] = 5;
        $this->clientorderlib->update_order($orderdata);
        $logs['order_id'] = $order_id;
    	$logs['comment'] = 'Order cancelled.(' . $_GET['reason'] . ')';
    	$logs['created_date'] = date('Y-m-d H:i:s');
    	$logs['created_by'] = $this->session->userdata('adminsession')['id'];
    	$this->clientorderlib->add_order_logs($logs);
        echo json_encode(array('message'=>'Order cancelled Successfully.'));
    }
    public function completed($order_id) {
        $orderdata['order_id'] = $order_id;
        $orderdata['status'] = 7;
        $orderdata['pay_mode'] = $this->input->get('pay_mode');
        $this->load->library('zyk/ClientorderLib');
        $this->clientorderlib->update_order($orderdata);
        if ($orderdata['pay_mode'] == 1) {
            $orders = $this->clientorderlib->getOrderDetails($order_id);
           
            $data1['name'] = $orders[0]['first_name'];
            $data1['email'] = $orders[0]['manager_email'];
            $data1['mobile'] = $orders[0]['manager_mobile'];
            $data1['amount'] = $orders[0]['amount'];
            $data1['orderid'] = $order_id;
            $this->load->library ( 'zyk/ClientpaymentLib' );
            $resp = $this->clientpaymentlib->getPaymentUrl($data1); 
        }
        $logs['order_id'] = $order_id;
        $logs['comment'] = 'Order Delivery Completed';
        $logs['created_date'] = date('Y-m-d H:i:s');
        $logs['order_status'] = 7;
        $logs['created_by'] = $this->session->userdata('adminsession')['id'];
        $this->clientorderlib->add_order_logs($logs);
        $response['status'] = 1;
        $response['msg'] = 'Order Marked completed successfully.';
        echo json_encode($response);
    }
    public function invoices() {
        $this->load->library('zyk/ClientorderLib');
        $orders = $this->clientorderlib->invoices(); 
        
        $this->template->set('orders', $orders);
        $this->template->set_theme('default_theme');
        $this->template->set_layout ('backend')
                ->title ( 'Administrator | Order Dashboard' )
                ->set_partial ( 'header', 'partials/header' )
                ->set_partial ( 'leftnav', 'partials/sidebar' )
                ->set_partial ( 'footer', 'partials/footer' );
        $this->template->build ('clientorders/invoices');
    }
   public function get_bike_by_id() {
       $this->load->library('zyk/ClientorderLib');
       echo json_encode($this->clientorderlib->get_bike_by_id($_POST['bike_id']));
   }
   public function approvalPackageUpdate() {
       $this->load->library('zyk/OrderLib');
                $result = array();
                //$all_serviceid = $_POST['all_serviceid'];
                if(isset($_POST['chk_serviceid']) && !empty($_POST['chk_serviceid'])) {
                    $service_use = isset($_POST['service_use']) ? $_POST['service_use'] : array();
                    $chk_serviceid = $_POST['chk_serviceid'];
                    $result = array_diff($chk_serviceid, $service_use);
                    
                }
                if(isset($_POST['remaining_zero'])) {
                    foreach ($_POST['remaining_zero'] as  $value) {
                        $result[] = $value;
                    }
                }
                
                $this->load->library('zyk/SearchLib'); 
		$packageData = $this->searchlib->getPackageDetailsbyId2($_POST['package_id']);
                $all = 0;
                if(empty($result)) {
                    $all = 1;
                }
               
                if(!empty($packageData['services'])){
                        $items = array();
                        foreach ($packageData['services'] as $row) {
                                if(!in_array($row['id'], $result) || $all == 1)  {
                                        $item = array();
                                        $item['order_id'] = $_POST['orderidhidden'];
                                        $item['service_id'] = $row['id'];
                                        $item['service_name'] = $row['name'];
                                        $item['is_checked'] = 1 ;
                                        $item['service'] = 1 ; 
                                        $item['priority'] = 1;
                                        $item['is_package_service'] = $_POST['user_package_id'];  
                                      $items[] = $item;
                                }  
                        }    
                        
                                
                                        $this->db->insert_batch('tbl_client_booking_services',$items); 
                }
                echo json_encode(array('status'=> 1 ,'message' => 'Package services saved successfully'));
   }
   public function cofirm_estimate_list() {
        $this->load->library('zyk/ClientorderLib');
        $orders = $this->clientorderlib->cofirm_estimate_list(); 
        
        $this->template->set('orders',$orders);
        $this->template->set_theme('default_theme');
        $this->template->set_layout ('backend')
        ->title ( 'Administrator | Order Dashboard' )
        ->set_partial ( 'header', 'partials/header' )
        ->set_partial ( 'leftnav', 'partials/sidebar' )
        ->set_partial ( 'footer', 'partials/footer' );
        $this->template->build ('clientorders/cofirm_estimate_list');
   }
   public function confirm_estimate_view() {
       $this->load->library('zyk/ClientorderLib');
       $orderid = $_POST['id'];
       $orders = $this->clientorderlib->getOrderDetails($orderid);
       $data['order'] = $orders[0];
       $data['items'] = $this->clientorderlib->getOrderItems($orderid);
       
       $this->load->view('clientorders/confirm_estimate_view', $data);
   }
   public function confirm_estimate_client() {
       $this->load->library('zyk/ClientorderLib');
        $itemcheck = $this->input->post('is_checked');
    	$itemids = $this->input->post('itemid');
    	$itemnames = $this->input->post('itemname');
    	$itemprices = $this->input->post('price');
    	$itemtypes = $this->input->post('itemtype');
    	$itempriority = $this->input->post('priority');
    	$orderid = $this->input->post('order_id');
	$ordertotal = 0;
    	$items = array();
    	for ($i = 0; $i < count($itemids); $i++) {
    		$item = array();
    		$item['order_id'] = $orderid;
    		$item['service_id'] = $itemids[$i];
    		$item['service_name'] = $itemnames[$i];
    		$item['price'] = $itemprices[$i];
    		$item['service'] = $itemtypes[$i];
    		$item['priority'] = $itempriority[$i];
    		$item['is_checked'] = $itemcheck[$i];
    		//echo $itemcheck[i];
    		if($item['is_checked'] == 1){
    			//echo "itemcheck";
    			$ordertotal = $ordertotal + $itemprices[$i];;
    		}
    		$items[] = $item;
   	}
        $this->clientorderlib->remove_booking_services($orderid);        
        $this->clientorderlib->add_booking_services($items);
        $oupdate['order_id'] = $orderid;
        $oupdate['amount'] = $ordertotal;
        $oupdate['status'] = 3;
        $this->clientorderlib->update_order($oupdate);
        $logs['order_id'] = $orderid;
    	$logs['comment'] = 'Estimate Confirmed.';
    	$logs['created_date'] = date('Y-m-d H:i:s');
    	$logs['created_by'] = $this->session->userdata('adminsession')['id'];
    	$this->clientorderlib->add_order_logs($logs);
    	echo json_encode(array('status' => '1', 'message' =>'Estimate Confirm successfully (By client).'));
   }
   public function get_package_count() {
       $this->load->library('zyk/ClientorderLib');
       $response['msg'] = '';
       $data = $this->clientorderlib->get_package_count($_POST['bike_id'], $_POST['package_id']);
       if(empty($data)) {
           $data = $this->clientorderlib->get_package_service_used_validity($_POST['package_id']);
           $response['msg'] = "Booking count = {$data[0]['service_used_validity']}, Validity = {$data[0]['year']} Year";
       } else {
           $response['msg'] = "Remaining booking count = {$data[0]['remaining_service_count']}";
       }
       echo json_encode($response);
   }
   function generate_bulk_invoice() {
       $this->load->library('zyk/ClientorderLib');
       $id = $_GET['bulk_id'];
       $data = $this->clientorderlib->order_details_by_bulk_id($id);
       foreach ($data as $key => $value) {
           $data[$key]['package'] = array();
          if($value['package_id'] != 0) { 
             $data[$key]['package'] = $this->clientorderlib->get_package_deatails2($value['package_id'], $value['bike_id'], $value['order_id']);
          }
            
       }
       $data = array_values($data);
     $html =   $this->template->set('data', $data)
                      ->set_theme('default_theme')
                      ->set_layout(false)
                      ->title ( 'Invoice' )
                      ->build ('clientorders/bulk_invoice','',true); 
  
    $file_name = "invoice".time().".pdf"; 
    $this->load->library('MyPdfLib');
    $url = $this->mypdflib->getPdf($html,$file_name); 
    $update['invoice_url'] = $url;
    $this->db->where('id', $id);
    $this->db->update('tbl_bulk_invoice', $update);

    $client_id = $data[0]['client_id'];
  
    $client_details=$this->db->select('*')
                             ->from('tbl_client')
                             ->where('id',$client_id)
                             ->get()
                             ->result_array();
 
    $temp = array();
    $temp['name'] = $client_details[0]['first_name']; 
    $temp['invoice_url'] = $url; 
    $temp['email'] = $client_details[0]['poc_email'];
    $temp['mobile'] = $client_details[0]['poc_mob']; 
    //print_r($temp);


    $outlet_id = $data[0]['outlet_id'];

    $outlet_details=$this->db->select('*')
                             ->from('tbl_outlets')
                             ->where('id',$outlet_id)
                             ->get()
                             ->result_array();

    $temp1 = array();
    $temp1['name'] = $outlet_details[0]['manager_name']; 
    $temp1['invoice_url'] = $url; 
    $temp1['email'] = $outlet_details[0]['manager_email'];
    $temp1['mobile'] = $outlet_details[0]['manager_mobile']; 
    //print_r($temp1);
 

    $this->clientorderlib->sendBulkBookingInvoiceEmail($temp);
    $this->clientorderlib->sendOutletInvoiceEmail($temp1); 
    $this->clientorderlib->sendBulkBookingInvoiceSMS($temp);

    echo json_encode(array('status' => 1, 'url' => $url));
   }
    
}