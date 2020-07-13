<?php 
class Order extends MX_Controller {

	public function __construct() {
		parent::__construct ();
		
		error_reporting(0);
	}

	///************* code by kunal *////////////
	public function getVendorList()
	{
		$vendors = [];
		$map['latitude'] = $this->input->post('latitude');
		$map['longitude'] = $this->input->post('longitude');
		if($this->input->post('brand'))
		{
			$map['brand'] = $this->input->post('brand');
		}

		if($this->input->post('model'))
		{
			$map['model'] = $this->input->post('model');
		}

		if (!empty($map['latitude']) && !empty($map['longitude'])) {
			$this->load->library('zyk/RestaurantLib');
			$vendors['vendorlist'] = $this->restaurantlib->getSearchedVendor($map);
			if ($vendors['vendorlist'] == false) {
				$vendors['errmsg'] = "Vendor List not found this location! Please add valid address.";
			}
		} else {
			$vendors['errmsg'] = "Vendor List not found this location! Please add valid address.";
		}
		echo json_encode($vendors);
	}

	public function orderDetail($orderid) {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$this->load->library('zyk/UserLib');
		$this->load->library('zyk/General');
		$this->load->library('zyk/SlotLib', 'slotlib');
		$this->load->library('zyk/RestaurantLib');
		$this->load->library('zyk/ItemLib');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$this->load->library('zyk/PackageLib'); 

		$map = array();
		$map['status'] = $this->input->get('status');
 		$restaurants = $this->restaurantlib->getRestaurants($map);
		$orders = $this->orderlib->getOrderDetails($orderid); 
		$sgdata['id'] = explode(",", $orders[0]['service_group_id']);
		$addressData['addressid'] = $orders[0]['address_id'];
		$orderAddress = $this->userlib->getAddressByIDs($addressData);
		$sg = $this->servicelib->getActiveServiceGroupsName($sgdata);

		$status = $this->servicelib->getActiveMainStatus1();
		$catofsubcat = $this->servicelib->getActiveListcatSubcat($orderid);
		$catofsubcatbysubid = $this->servicelib->getCatsubcatid($orders[0]['subcategory_id']);

		// echo "<pre>";
		// print_r($sg);
		// exit;

		$orders[0]['service_group_name']=$sg;
		$orders[0]['locality']=$orderAddress[0]['locality'];
		$orders[0]['latitude']=$orderAddress[0]['latitude'];
		$orders[0]['longitude']=$orderAddress[0]['longitude'];
		$orders[0]['landmark']=$orderAddress[0]['landmark'];
		$orders[0]['address']=$orderAddress[0]['address'].", ".$orderAddress[0]['landmark'].", ".$orderAddress[0]['locality'].", ".$orderAddress[0]['cityname'].", ".$orderAddress[0]['statename']." - ".$orderAddress[0]['pincode'];

		$data3=array();
		$data3['vendor_id']=$orders[0]['assign_vendor_id'];
		/*$data3['locality']=$orders[0]['locality'];
		$data3['latitude']=$orders[0]['latitude'];
		$data3['longitude']=$orders[0]['longitude'];
		*/$data3['service_id']=$orders[0]['service_id'];

		/*echo "<pre>";
		print_r($data3);
		echo "<br>";
		print_r($orders);die();*/

		if($data3['vendor_id']!=''){
			$garage = $this->restaurantlib->garageDetailsByVendorID2($data3);
		}

        $riderarray['select'] = "rider_id, rider_name";
        $riderarray['is_available'] = 1;
        $this->load->library('zyk/RiderLib');
        $rider= $this->riderlib->getRiderList($riderarray);
                
		// print_r($garage);
		// exit;
		$items = $this->orderlib->getOrderItems($orderid);
        $Userpackages = array();
        $packageservices = array();
        $servicecnt = array();
        $tbl_booking_packges = array();
		$this->load->library('zyk/PackageLib');
	        
 		$this->load->library('zyk/SearchLib','searchlib');
 		if($orders[0]['package_id'] > 0)
 		{      
            $Userpackages = $this->orderlib->getUserpackageDetails($orders[0]['userid'],$orders[0]['package_id']);

            $packageservices = $this->packagelib->getPackageServices($orders[0]['package_id']);
            if($Userpackages[0]['order_ids'] !='')
            {
            	$servicecnt = $this->searchlib->getservicecount($Userpackages[0]['order_ids']);
            }
            $tbl_booking_packges = $this->orderlib->order_packege_services($orderid);
        }
                
 	    //$servicecnt=$this->searchlib->getservicecount($Userpackages[0]['order_ids']);
		$this->template->set('tbl_booking_packges', $tbl_booking_packges);
		$this->template->set('userpackage', $Userpackages);
	    $this->template->set('packageservices',$packageservices); 
		$this->template->set ( 'servicecnt', $servicecnt);
              
		/*echo "<pre>";
		print_r($servicecnt);
		exit();*/

	    $logs = $this->orderlib->getOrderLogs($orderid);
	   	// $admin_comments = $this->orderlib->getAdminComment($orderid);
	    $vendor_comments = $this->orderlib->getVendorComment($orders[0]['vendor_id']); 

		//$executives = $this->general->getActiveFieldExecutives();
		$visitingslots = $this->slotlib->getActiveVisiting1(); 
		
 		//$pickupslots = $this->general->getActivePickupSlots();
		//$deliveryslots = $this->general->getActiveDeliverySlots();
		$wallet = $this->userlib->getWalletBalance($orders[0]['userid']);
		$reasons = $this->general->getActiveReasons();
		$payment = $this->db->get_where('tbl_payment_details',array('orderid'=>$orderid,'status'=>'Credit'))->result_array();
		$this->template->set('payment',$payment);
		$this->template->set('order',$orders[0]);
		//$this->template->set('products',$product);
		$this->template->set('items',$items); 
		$this->template->set('status',$status);
		$this->template->set('garage',$garage);
		$this->template->set('rider',$rider);
		$this->template->set('restaurants',$restaurants);
		$this->template->set('catofsubcat',$catofsubcat);
		$this->template->set('catofsubcatbysubid',$catofsubcatbysubid);
		$this->template->set('logs',$logs);
		$this->template->set('admin_comments',$admin_comments);
	    $this->template->set('vendor_comments',$vendor_comments);
	//	$this->template->set('executives',$executives);
	//	$this->template->set('pickupslots',$pickupslots);
	//	$this->template->set('deliveryslots',$deliveryslots);
		$this->template->set('visitingslots',$visitingslots);
		
		$this->template->set('wallet',$wallet);
		$this->template->set('reasons',$reasons);
		$this->template->set('Userpackages',$Userpackages);

		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/OrderDetails');
	}

	public function getRiderList($orderid)
	{
		$ridetype = $this->input->get('ride_type');
		$lat = $this->input->get('lat');
		$long = $this->input->get('long');

		$riderarray['select'] = "rider_id, rider_name";
        $riderarray['is_available'] = 1;
		$this->load->library('zyk/RiderLib','riderlib');
        $rider= $this->riderlib->getRiderList($riderarray);

        if (!empty($rider)) 
        {
        	$response['status'] = 1;
        	$response['list'] = $rider;
        }
        else
        {
        	$response['status'] = 0;
        }
        echo json_encode($response);
	}

	public function assignRider($orderid) {
		$this->load->library('zyk/OrderLib');
		$this->load->library('zyk/MechanicLib');
		$this->load->library('zyk/UserLib','userlib');
		$this->load->library('zyk/RiderLib','riderlib');
		$rider_id = $this->input->get('rider_id');
		$ridetype = $this->input->get('ride_type');
		$rider_mobiles = $this->input->get('rider_mobiles');
		$response = array();
		$orderdata = array();
		$data1 = array();
		if ($ridetype == 1) {
			$orderdata['orderid'] = $orderid;
			$orderdata['assign_rider_id'] = $rider_id;
			$orderdata['rider_response'] = 1;
			$orderdata['status_updated_date'] = date('Y-m-d');
			$orderdata['ride_type'] = 1;
			$orderdata['status'] = 0;
			$this->orderlib->updateOrder($orderdata);

			$riderdata['id'] = $rider_id;
			$riders = $this->riderlib->getRiderList($riderdata);
			$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
			$orders_address = $this->userlib->getAddressByIDs($orders[0]['address_id']);
			$vendordetails = $this->orderlib->getVendorDetailsByVendorId($orders[0]['assign_vendor_id']);
			
			$data['orderid'] = $orders[0]['orderid'];
			$data['ordercode'] = $orders[0]['ordercode'];
			$data['vendor_name'] = $vendordetails[0]['garage_name'];
			$data['vendor_mobile'] = $vendordetails[0]['mobile'];
			$data['vendor_address'] = $vendordetails[0]['locality'].", ".$vendordetails[0]['landmark'].", ".$vendordetails[0]['address'];
			$data['name'] = $orders[0]['name'];
			$data['mobile'] = $orders[0]['mobile'];
			$data['email'] = $orders[0]['email'];
			$data['address'] = $orders_address[0]['locality'].", ".$orders_address[0]['address'];
			$data['rider_name'] = $riders[0]['rider_name'];
			$data['rider_mobile'] =  (!empty($rider_mobiles))?$rider_mobiles."/".$riders[0]['mobile']:$riders[0]['mobile'];
			$data['pickup_date'] = $orders[0]['pickup_date'];
			$data['time_slot'] = $orders[0]['slot'];
			$data['ordered_on'] = $orders[0]['ordered_on'];

			$this->orderlib->sendOrderConfirmEmail($data);
			$this->orderlib->sendOrderConfirmSMS($data);
			$this->orderlib->sendPickUpBoySMS($data);
			if(!empty($data['vendor_mobile'])){
				$this->orderlib->sendOrderSMSToNumbers($data,$data['vendor_mobile']);
			}

			$this->load->library ( 'zyk/NotificationLib', 'notificationlib' );
			$this->notificationlib->sendOrderAssignedToRider($rider_id,$data['ordercode']);

			/*$this->orderlib->sendAssignedgarageNotification($orders[0]['userid']);
			$this->mechaniclib->sendGarageAssignedNotification($garage_id);*/

			$logs = array();
			$logs['orderid'] = $orderid;
			$logs['comment'] = 'Order Assigned to '.$data['rider_name'].'(Rider).';
			$logs['created_date'] = date('Y-m-d H:i:s');
			$logs['order_status'] = 0;
			$logs['created_by'] = $this->session->userdata('adminsession')['id']; 
			$this->orderlib->addOrderLogs($logs);


		} 
		else if ($ridetype == 2)
		{
			$orderdata['orderid'] = $orderid;
			$orderdata['delivery_assign_rider_id'] = $rider_id;
			$orderdata['delivery_rider_response'] = 1;
			$orderdata['status_updated_date'] = date('Y-m-d');
			$orderdata['ride_type'] = 2;
			$this->orderlib->updateOrder($orderdata);

			$riderdata['id'] = $rider_id;
			$riders = $this->riderlib->getRiderList($riderdata);
			$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
			$orders_address = $this->userlib->getAddressByIDs($orders[0]['address_id']);
			$vendordetails = $this->orderlib->getVendorDetailsByVendorId($orders[0]['assign_vendor_id']);
			
			$data['orderid'] = $orders[0]['orderid'];
			$data['ordercode'] = $orders[0]['ordercode'];
			$data['vendor_name'] = $vendordetails[0]['garage_name'];
			$data['vendor_mobile'] = $vendordetails[0]['mobile'];
			$data['vendor_address'] = $vendordetails[0]['locality'].", ".$vendordetails[0]['landmark'].", ".$vendordetails[0]['address'];
			$data['name'] = $orders[0]['name'];
			$data['mobile'] = $orders[0]['mobile'];
			$data['email'] = $orders[0]['email'];
			$data['address'] = $orders_address[0]['locality'].", ".$orders_address[0]['address'];
			$data['rider_name'] = $riders[0]['rider_name'];
			$data['rider_mobile'] =  (!empty($rider_mobiles))?$rider_mobiles."/".$riders[0]['mobile']:$riders[0]['mobile'];
/*			$data['pickup_date'] = $orders[0]['pickup_date'];
			$data['time_slot'] = $orders[0]['slot'];*/
			$data['ordered_on'] = $orders[0]['ordered_on'];

			/*$this->orderlib->sendOrderConfirmEmail($data);
			$this->orderlib->sendOrderConfirmSMS($data);
			$this->orderlib->sendPickUpBoySMS($data);
			if(!empty($data['vendor_mobile'])){
				$this->orderlib->sendOrderSMSToNumbers($data,$data['vendor_mobile']);
			}
			*/
			$this->load->library ( 'zyk/NotificationLib', 'notificationlib' );
			$this->notificationlib->sendOrderAssignedToRider($rider_id,$data['ordercode']);

			/*$this->orderlib->sendAssignedgarageNotification($orders[0]['userid']);
			$this->mechaniclib->sendGarageAssignedNotification($garage_id);*/

			$logs = array();
			$logs['orderid'] = $orderid;
			$logs['comment'] = 'Order Assigned for delivery to '.$data['rider_name'].'(Rider).';
			$logs['created_date'] = date('Y-m-d H:i:s');
			$logs['order_status'] = 7;
			$logs['created_by'] = $this->session->userdata('adminsession')['id']; 
			$this->orderlib->addOrderLogs($logs);
		}


		$response['status'] = 1;
		$response['message'] = 'Rider Assigned To Order.';
		echo json_encode($response);
	}
	///************* code by kunal *////////////



	public function index() {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getTodaysOrderCount();
		$pickup_orders = $this->orderlib->getTodaysPickupOrderCount();
		$this->template->set('orders',$orders);
		$this->template->set('pickup_orders',$pickup_orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/dashboard');
	}
        public function add_type_into_session() {
            $_SESSION['type'] = $_POST['a'];
            echo json_encode('success');
        }
	
	public function pendingOrders() {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$adminsession = $this->session->userdata ( 'adminsession' );
		//$store_id = $adminsession['store_id'];
		//$role_id = $adminsession['user_role'];
		if(empty($this->input->post('name')) && empty($this->input->post('pickup_date')) && empty($this->input->post('mobile')) && empty($this->input->post('email'))) {
			$orders = $this->orderlib->getPendingOrdersByDate();
		} else {
			$map = array();
			$map['status'] = 0;
			//$map['role_id'] = $role_id;
			//$map['store_id'] = $store_id;
			if(!empty($this->input->post('pickup_date')))
				$map['pickup_date'] = $this->input->post('pickup_date');
			if(!empty($this->input->post('email')))
				$map['email'] = $this->input->post('email');
			if(!empty($this->input->post('name')))
				$map['name'] = $this->input->post('name');
			if(!empty($this->input->post('mobile')))
				$map['mobile'] = $this->input->post('mobile');
			$orders = $this->orderlib->filterOrders($map);
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
		$this->template->build ('orders/PendingOrders');
	}
	
	public function pickupOrders() {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		/* $adminsession = $this->session->userdata ( 'adminsession' );
		$store_id = $adminsession['store_id'];
		$role_id = $adminsession['user_role'];
		if(empty($this->input->post('name')) && empty($this->input->post('pickup_date')) && empty($this->input->post('mobile')) && empty($this->input->post('email'))) {
			$orders = $this->orderlib->getPickupOrdersByDate($store_id,$role_id);
		} else {
			$map = array();
			$map['status'] = 1;
			$map['role_id'] = $role_id;
			$map['store_id'] = $store_id;
			if(!empty($this->input->post('pickup_date')))
				$map['pickup_date'] = $this->input->post('pickup_date');
			if(!empty($this->input->post('name')))
				$map['name'] = $this->input->post('name');
			if(!empty($this->input->post('email')))
				$map['email'] = $this->input->post('email');
			if(!empty($this->input->post('mobile')))
				$map['mobile'] = $this->input->post('mobile');
			$orders = $this->orderlib->filterOrders($map);
		} */
		$this->template->set('page','porders');
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/PickupOrders');
	}
	
	public function scheduledOrders() {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$adminsession = $this->session->userdata ( 'adminsession' );
		$store_id = $adminsession['store_id'];
		$role_id = $adminsession['user_role'];
		$orders = $this->orderlib->getOrdersUnderProcess($store_id,$role_id);
		if(empty($this->input->post('name')) && empty($this->input->post('pickup_date')) && empty($this->input->post('mobile')) && empty($this->input->post('email'))) {
			$orders = $this->orderlib->getOrdersUnderProcess($store_id,$role_id);
		} else {
			$map = array();
			$map['status'] = 2;
			$map['role_id'] = $role_id;
			$map['store_id'] = $store_id;
			if(!empty($this->input->post('pickup_date')))
				$map['pickup_date'] = $this->input->post('pickup_date');
			if(!empty($this->input->post('email')))
				$map['email'] = $this->input->post('email');
			if(!empty($this->input->post('name')))
				$map['name'] = $this->input->post('name');
			if(!empty($this->input->post('mobile')))
				$map['mobile'] = $this->input->post('mobile');
			$orders = $this->orderlib->filterOrders($map);
		}
		$this->template->set('page','porders');
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/ScheduledOrders');
	}
	
	public function deliveryOrders() {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$adminsession = $this->session->userdata ( 'adminsession' );
		$store_id = $adminsession['store_id'];
		$role_id = $adminsession['user_role'];
		if(empty($this->input->post('name')) && empty($this->input->post('delivery_date')) && empty($this->input->post('mobile')) && empty($this->input->post('email'))) {
			$orders = $this->orderlib->getDeliveryOrdersByDate($store_id,$role_id);
		} else {
			$map = array();
			$map['status'] = 3;
			$map['role_id'] = $role_id;
			$map['store_id'] = $store_id;
			if(!empty($this->input->post('delivery_date')))
				$map['delivery_date'] = $this->input->post('delivery_date');
			if(!empty($this->input->post('email')))
				$map['email'] = $this->input->post('email');
			if(!empty($this->input->post('name')))
				$map['name'] = $this->input->post('name');
			if(!empty($this->input->post('mobile')))
				$map['mobile'] = $this->input->post('mobile');
			$orders = $this->orderlib->filterOrders($map);
		}
		$this->template->set('page','porders');
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/DeliveryOrders');
	}
	
	public function assignedOrders() {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$adminsession = $this->session->userdata ( 'adminsession' );
		//$store_id = $adminsession['store_id'];
		//$role_id = $adminsession['user_role'];
		if(empty($this->input->post('name')) && empty($this->input->post('delivery_date')) && empty($this->input->post('mobile')) && empty($this->input->post('email'))) {
			$orders = $this->orderlib->getAssignedOrdersByDate();
		} else {
			$map = array();
			$map['status'] = 1;
			//$map['role_id'] = $role_id;
			//$map['store_id'] = $store_id;
			if(!empty($this->input->post('delivery_date')))
				$map['delivery_date'] = $this->input->post('delivery_date');
			if(!empty($this->input->post('email')))
				$map['email'] = $this->input->post('email');
			if(!empty($this->input->post('name')))
				$map['name'] = $this->input->post('name');
			if(!empty($this->input->post('mobile')))
				$map['mobile'] = $this->input->post('mobile');
			$orders = $this->orderlib->filterOrders($map);
		}
		$this->template->set('page','porders');
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/AssignedOrders');
	}
	
	public function ongoingOrders() {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$adminsession = $this->session->userdata ( 'adminsession' );
		//$store_id = $adminsession['store_id'];
		//$role_id = $adminsession['user_role'];
		if(empty($this->input->post('name')) && empty($this->input->post('delivery_date')) && empty($this->input->post('mobile')) && empty($this->input->post('email'))) {
			$orders = $this->orderlib->getOngoingOrdersByDate();
		} else {
			$map = array();
			$map['status'] = 2;
			//$map['role_id'] = $role_id;
			//$map['store_id'] = $store_id;
			if(!empty($this->input->post('delivery_date')))
				$map['delivery_date'] = $this->input->post('delivery_date');
			if(!empty($this->input->post('email')))
				$map['email'] = $this->input->post('email');
			if(!empty($this->input->post('name')))
				$map['name'] = $this->input->post('name');
			if(!empty($this->input->post('mobile')))
				$map['mobile'] = $this->input->post('mobile');
			$orders = $this->orderlib->filterOrders($map);
		}
		$this->template->set('page','porders');
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/OngoingOrders');
	}
	
	public function approvalOrders() {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$adminsession = $this->session->userdata ( 'adminsession' );
		//$store_id = $adminsession['store_id'];
		//$role_id = $adminsession['user_role'];
		if(empty($this->input->post('name')) && empty($this->input->post('delivery_date')) && empty($this->input->post('mobile')) && empty($this->input->post('email'))) {
			$orders = $this->orderlib->getApprovalOrdersByDate();
		} else {
			$map = array();
			$map['status'] = 2;
			//$map['role_id'] = $role_id;
			//$map['store_id'] = $store_id;
			if(!empty($this->input->post('delivery_date')))
				$map['delivery_date'] = $this->input->post('delivery_date');
			if(!empty($this->input->post('email')))
				$map['email'] = $this->input->post('email');
			if(!empty($this->input->post('name')))
				$map['name'] = $this->input->post('name');
			if(!empty($this->input->post('mobile')))
				$map['mobile'] = $this->input->post('mobile');
			$orders = $this->orderlib->filterOrders($map);
		}
		$this->template->set('page','porders');
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/ApprovalOrders');
	}
	
	public function completedOrders() {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
	    $adminsession = $this->session->userdata ( 'adminsession' );
		//$store_id = $adminsession['store_id'];
		//$role_id = $adminsession['user_role'];
		if(empty($this->input->post('name')) && empty($this->input->post('delivery_date')) && empty($this->input->post('mobile')) && empty($this->input->post('email'))) {
			$orders = $this->orderlib->getCompletedOrdersByDate();
		} else {
			$map = array();
			$map['status'] = 4;
			//$map['role_id'] = $role_id;
			//$map['store_id'] = $store_id;
			if(!empty($this->input->post('delivery_date')))
				$map['delivery_date'] = $this->input->post('delivery_date');
			if(!empty($this->input->post('email')))
				$map['email'] = $this->input->post('email');
			if(!empty($this->input->post('name')))
				$map['name'] = $this->input->post('name');
			if(!empty($this->input->post('mobile')))
				$map['mobile'] = $this->input->post('mobile');
			$orders = $this->orderlib->filterOrders($map);
		}
		$this->template->set('page','porders');
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/CompletedOrders');
	}
	
	public function deliveryCompletedOrders() {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$adminsession = $this->session->userdata ( 'adminsession' );
		//$store_id = $adminsession['store_id'];
		//$role_id = $adminsession['user_role'];
		if(empty($this->input->post('name')) && empty($this->input->post('delivery_date')) && empty($this->input->post('mobile')) && empty($this->input->post('email'))) {
			$orders = $this->orderlib->getDeliveryCompletedOrdersByDate();
		} else {
			$map = array();
			$map['status'] = 7;
			//$map['role_id'] = $role_id;
			//$map['store_id'] = $store_id;
			if(!empty($this->input->post('delivery_date')))
				$map['delivery_date'] = $this->input->post('delivery_date');
			if(!empty($this->input->post('email')))
				$map['email'] = $this->input->post('email');
			if(!empty($this->input->post('name')))
				$map['name'] = $this->input->post('name');
			if(!empty($this->input->post('mobile')))
				$map['mobile'] = $this->input->post('mobile');
			$orders = $this->orderlib->filterOrders($map);
		}
		$this->template->set('page','porders');
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/DeliveryCompletedOrders');
	}
	
	public function cancelledOrders() {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$adminsession = $this->session->userdata ( 'adminsession' );
		//$store_id = $adminsession['store_id'];
		//$role_id = $adminsession['user_role'];
		if(empty($this->input->post('pickup_date')) && empty($this->input->post('mobile')) && empty($this->input->post('email'))) {
			$orders = $this->orderlib->getCancelledOrdersByDate();
		} else {
			$map = array();
			$map['status'] = 5;
			//$map['role_id'] = $role_id;
			//$map['store_id'] = $store_id;
			if(!empty($this->input->post('pickup_date')))
				$map['pickup_date'] = $this->input->post('pickup_date');
			if(!empty($this->input->post('email')))
				$map['email'] = $this->input->post('email');
			if(!empty($this->input->post('name')))
				$map['name'] = $this->input->post('name');
			if(!empty($this->input->post('mobile')))
				$map['mobile'] = $this->input->post('mobile');
			$orders = $this->orderlib->filterOrders($map);
		} 
		$this->template->set('page','porders');
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/CancelledOrders');
	}
	
	public function todaysOrders() {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$adminsession = $this->session->userdata ( 'adminsession' );
		$store_id = $adminsession['store_id'];
		$role_id = $adminsession['user_role'];
		$orders = $this->orderlib->getTodaysOrders($store_id,$role_id);
		$this->template->set('page','porders');
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/TodaysOrders');
	}
	
	public function todaysOrdersBooked() {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$adminsession = $this->session->userdata ( 'adminsession' );
		$store_id = $adminsession['store_id'];
		$role_id = $adminsession['user_role'];
		$orders = $this->orderlib->getTodaysOrdersBooked($store_id,$role_id);
		$this->template->set('page','porders');
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/TodaysOrders');
	}
	
	public function todaysDeliveries() {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$adminsession = $this->session->userdata ( 'adminsession' );
		$store_id = $adminsession['store_id'];
		$role_id = $adminsession['user_role'];
		$orders = $this->orderlib->getTodaysDeliveries($store_id,$role_id);
		$this->template->set('page','porders');
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/TodaysDeliveries');
	}
	
	public function deliveryInvoices() {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$adminsession = $this->session->userdata ( 'adminsession' );
		$store_id = $adminsession['store_id'];
		$role_id = $adminsession['user_role'];
		$orders = $this->orderlib->getTodaysDeliveries($store_id,$role_id);
		$this->template->set('page','porders');
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/GenerateInvoice');
	}
	
	public function searchOrders() {
		$this->load->library('zyk/OrderLib');
		$adminsession = $this->session->userdata ( 'adminsession' );
		$store_id = $adminsession['store_id'];
		$role_id = $adminsession['user_role'];
		$map = array();
		if(empty($this->input->post('pickup_date')) && empty($this->input->post('name')) && empty($this->input->post('mobile')) && empty($this->input->post('email')) && empty($this->input->post('delivery_date')) && $this->input->post('status') == "") {
			$orders = array();
		} else {
			if($this->input->post('status') != "") {
				$map['status'] = $this->input->post('status');
			} else {
				$map['status'] = "";
			}
			$map['role_id'] = $role_id;
			$map['store_id'] = $store_id;
			if(!empty($this->input->post('pickup_date')))
				$map['pickup_date'] = $this->input->post('pickup_date');
			if(!empty($this->input->post('delivery_date')))
				$map['delivery_date'] = $this->input->post('delivery_date');
			if(!empty($this->input->post('email')))
				$map['email'] = $this->input->post('email');
			if(!empty($this->input->post('name')))
				$map['name'] = $this->input->post('name');
			if(!empty($this->input->post('mobile')))
				$map['mobile'] = $this->input->post('mobile');
			$orders = $this->orderlib->filterOrders($map);
		}
		$this->template->set('page','porders');
		$this->template->set('orders',$orders);
		$this->template->set('map',$map);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/SearchOrders');
	}
	
	
	
	public function orderHistory($userid) {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$this->load->library('zyk/UserLib');
		$this->load->library('zyk/General');
		$this->load->library('zyk/SlotLib', 'slotlib');
		$this->load->library('zyk/RestaurantLib');
		$this->load->library('zyk/ItemLib');
		$map = array();
		$map['status'] = $this->input->get('status');
		$data = $this->orderlib->getAllDetails($userid);
		$orders = $this->orderlib->getOrderDetails($data[0]['orderid']);
		$reasons = $this->general->getActiveReasons();
		$this->template->set('data',$data);
		$this->template->set('order',$orders[0]);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/OrderHistory');
	}
	
	
	public function placeOrder($orderid) {
		$this->load->library('zyk/OrderLib');
		$response = array();
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['pickup_slot'] = $this->input->get('pickup_slot');
		$orderdata['pickup_exe_id'] = $this->input->get('executive_id');
		$orderdata['status'] = 1;
		$this->orderlib->updateOrder($orderdata);
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$dack = array();
		$dack['task_def'] = 'P';
		$dack['rider_code'] = $orders[0]['pickup_dack_rider_code'];
		$dack['order_id'] = $orders[0]['tracking_id'];
		$dack['crm_order_id'] = $orderid;
		$dack['tracking_id'] = $orders[0]['tracking_id'];
		$this->load->library ( 'zyk/Dack' );
		$resp = $this->dack->assignToDack($dack);
		$data = array();
		$data['name'] = $orders[0]['name'];
		$data['mobile'] = $orders[0]['mobile'];
		$data['email'] = $orders[0]['email'];
		$data['pickup_executive'] = $orders[0]['pickup_executive'];
		$data['pickup_executive_mobile'] = $orders[0]['pickup_executive_mobile'];
		$data['address'] = $orders[0]['address'];
		$flag = $this->orderlib->sendPickUpEmail($data);
		$this->orderlib->sendPickUpSMS($data);
		$data['pickup_slot'] = $orders[0]['pickup_slot'];
		$this->orderlib->sendPickUpBoySMS($data);
		$logs = array();
		$logs['orderid'] = $orderid;
		$logs['comment'] = 'Assigned For PickUp';
		$logs['created_date'] = date('Y-m-d H:i:s');
		$logs['created_by'] = $orders[0]['vendor_id'];
		$this->orderlib->addOrderLogs($logs);
		if(!empty($orders[0]['gcm_reg_id'])) {
			$title = 'Hi There! Our Moustache Man '.$data['pickup_executive'].' ('.$data['pickup_executive_mobile'].') is out for your pick up. Thank you';
			$message = array
			(
					'message' => $title,
					'title' => $title,
					'subtitle' => 'Pickup Assigned',
					'tickerText' => '',
					'vibrate' => 1,
					'sound' => 1
			);
			$gcmid[] = $orders[0]['gcm_reg_id'];
			sendGCMPushNotification($gcmid, $message,$title);
		}
		$response['status'] = 1;
		$response['message'] = 'Order Confirmed For PickUp.';
		echo json_encode($response);
	}
	
	public function reassignPickUp($orderid) {
		$this->load->library('zyk/OrderLib');
		$response = array();
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['pickup_slot'] = $this->input->get('pickup_slot');
		$orderdata['pickup_exe_id'] = $this->input->get('executive_id');
		$this->orderlib->updateOrder($orderdata);
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$dack = array();
		$dack['dack_rider_code'] = $orders[0]['pickup_dack_rider_code'];
		$dack['dack_tracking_id'] = $orders[0]['tracking_id'];
		$this->load->library ( 'zyk/Dack' );
		$resp = $this->dack->reassignToDack($dack);
		$data = array();
		$data['name'] = $orders[0]['name'];
		$data['mobile'] = $orders[0]['mobile'];
		$data['email'] = $orders[0]['email'];
		$data['pickup_executive'] = $orders[0]['pickup_executive'];
		$data['pickup_executive_mobile'] = $orders[0]['pickup_executive_mobile'];
		$flag = $this->orderlib->sendPickUpEmail($data);
		$this->orderlib->sendPickUpSMS($data);
		$data['address'] = $orders[0]['address'];
		$data['pickup_slot'] = $orders[0]['pickup_slot'];
		$this->orderlib->sendPickUpBoySMS($data);
		$logs = array();
		$logs['orderid'] = $orderid;
		$logs['comment'] = 'Re-Assigned For PickUp';
		$logs['created_date'] = date('Y-m-d H:i:s');
		$logs['created_by'] = $orders[0]['vendor_id'];
		$this->orderlib->addOrderLogs($logs);
		$response['status'] = 1;
		$response['message'] = 'Order Re-Assigned For PickUp.';
		echo json_encode($response);
	}
	

	public function assignDelivery($orderid) {
		$this->load->library('zyk/OrderLib');
		$this->load->library('zyk/MechanicLib');
		$garage_id = $this->input->get('vendor_id');
		$vendor_mobiles = $this->input->get('vendor_mobiles');
		$response = array();
		$orderdata = array();
		$data1 = array();
		$orderdata['orderid'] = $orderid;
		//$orderdata['delivery_slot'] = $this->input->get('delivery_slot');
		$orderdata['vendor_id'] = $this->input->get('vendor_id');
		$orderdata['assign_vendor_id'] = $this->input->get('vendor_id');
		$orderdata['other_vendorid'] = $this->input->get('other_vendor');
		//$orderdata['tml_delivery_date'] = date('Y-m-d',strtotime($this->input->get('delivery_date')));
		$orderdata['vendor_response'] =1;
		//$orderdata['status'] = 2;
		$orderdata['status'] = 1;
		$this->orderlib->updateOrder($orderdata);
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		
		$data['orderid'] = $orders[0]['orderid'];
		$data['ordercode'] = $orders[0]['ordercode'];
		$data['name'] = $orders[0]['name'];
		$data['mobile'] = $orders[0]['mobile'];
		$data['email'] = $orders[0]['email'];
		$data['locality'] = $orders[0]['locality'];
		$data['address'] = $orders[0]['address'];	
		$data['pickup_date'] = $orders[0]['pickup_date'];
		$data['time_slot'] = $orders[0]['slot'];
		$data['ordered_on'] = $orders[0]['ordered_on'];


		$vendordetails =  $this->orderlib->getVendorDetailsByVendorId($orderdata['vendor_id']);  
		 
		$temp_array=[]; 

        $temp_array['name']=$data['name'];
        $temp_array['email']=$data['email'];
        $temp_array['ordercode']=$data['ordercode'];
        $temp_array['orderid']=$data['orderid'];
        $temp_array['pickup_date']=$data['pickup_date'];
        $temp_array['time_slot']=$data['time_slot']; 
        $temp_array['ordered_on']=$data['ordered_on'];
        $temp_array['locality']=$data['locality']; 
        $temp_array['vendor_name']= $vendordetails[0]['garage_name'];
        $temp_array['vendor_mobile']=$vendordetails[0]['mobile'];  
        
		/*
		$this->orderlib->sendOrderConfirmEmail($data);
		$this->orderlib->sendOrderConfirmSMS($data);
		$this->orderlib->sendAssignedgarageNotification($orders[0]['userid']);
		$this->mechaniclib->sendGarageAssignedNotification($garage_id);
		*/
		$this->orderlib->sendOrderConfirmEmail($temp_array);
		$this->orderlib->sendOrderConfirmSMS($temp_array);
		$this->orderlib->sendAssignedgarageNotification($orders[0]['userid']);
		$this->mechaniclib->sendGarageAssignedNotification($garage_id);
		if(!empty($vendor_mobiles)){
			$this->orderlib->sendOrderSMSToNumbers($data,$vendor_mobiles);
		}
		/*$items_count = $this->orderlib->getOrderItemCount($orderid);
		$delivery_items = 0;
		foreach ($items_count as $item_count) {
			$delivery_items = $delivery_items + $item_count['items'];
		}
		$this->load->library ( 'zyk/Dack' );
		$delivery_times = explode("-",$orderdata['delivery_slot']);
		$delivery_time = $delivery_times[0];
		$params = array();
		$params['task_def'] = 'D';
		$params['rider_code'] = $orders[0]['delivery_dack_rider_code'];
		$params['rider_mobile'] = $orders[0]['delivery_executive_mobile'];
		$params['delivery_customer_name'] = $orders[0]['name'];
		$params['delivery_customer_contact'] = $orders[0]['mobile'];
		$params['delivery_datetime'] = date('Y-m-d H-i-s',strtotime(date('Y-m-d',strtotime($orderdata['tml_delivery_date'])).' '.date('H:i:s',strtotime($delivery_time))));
		$params['delivery_address'] = $orders[0]['address'];
		$params['delivery_nearby_address'] = $orders[0]['locality'];
		$params['delivery_mapLat'] = $orders[0]['latitude'];
		$params['delivery_mapLng'] = $orders[0]['longitude'];
		$params['delivery_customer_id'] = $orders[0]['userid'];
		$params['invoice_number'] = $orders[0]['orderid'];
		$params['crm_order_id'] = $orders[0]['orderid'];
		$params['item_description'] = '';
		$params['item_quantity'] = 0;
		$params['order_amount'] = $orders[0]['grand_total'];
		$params['time_slot'] = $orderdata['delivery_slot'];
		$params['tracking_id'] = $orders[0]['tracking_id'];
		$params['dack_tracking_id'] = $orders[0]['tracking_id'];
		$params['item_quantity'] = $delivery_items;
		$params['cod'] = 'Y';
		if($orders[0]['amount_received'] == $orders[0]['grand_total']) {
			$params['cod'] = 'N';
		}
		$resp = $this->dack->moveToDack($params);
		$data = array();
		$data['name'] = $orders[0]['name'];
		$data['mobile'] = $orders[0]['mobile'];
		$data['email'] = $orders[0]['email'];
		$data['bill_amount'] = $orders[0]['grand_total'];
		$data['delivery_executive'] = $orders[0]['delivery_executive'];
		$data['delivery_executive_mobile'] = $orders[0]['delivery_executive_mobile'];
		$flag = $this->orderlib->sendDeliveryEmail($data);
		$this->orderlib->sendDeliverySMS($data);
		$data['address'] = $orders[0]['address'];
		if($orders[0]['payment_status'] == 'Credit') {
			$data['grand_total'] = 0;
		} else {
			$data['grand_total'] = $orders[0]['grand_total'];
		}
		$this->orderlib->sendDeliveryBoySMS($data);*/
		$logs = array();
		$logs['orderid'] = $orderid;
		$logs['comment'] = 'Mechanic Assigned.';
		$logs['created_date'] = date('Y-m-d H:i:s');
		$logs['order_status'] = 1;
		//$logs['created_by'] = $this->session->userdata('adminsession')['id'];
		$logs['created_by'] = $orderdata['vendor_id']; 
		$this->orderlib->addOrderLogs($logs); 
		$response['status'] = 1;
		$response['message'] = 'Order Assigned To Mechanic.';
		echo json_encode($response);
	}
	
	public function updateassigndelivery($orderid) {
		$this->load->library('zyk/OrderLib');
		$this->load->library('zyk/MechanicLib');
		$garage_id = $this->input->get('vendor_id');
		$vendor_mobiles = $this->input->get('vendor_mobiles');
		$response = array();
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		//$orderdata['delivery_slot'] = $this->input->get('delivery_slot');
		$orderdata['vendor_id'] = $this->input->get('vendor_id');
		$orderdata['assign_vendor_id'] = $this->input->get('vendor_id');
		$orderdata['other_vendorid'] = $this->input->get('other_vendor');
		//$orderdata['tml_delivery_date'] = date('Y-m-d',strtotime($this->input->get('delivery_date')));
		$orderdata['vendor_response'] =1;
		//$orderdata['status'] = 2;
		$orderdata['status'] = 1;
		$this->orderlib->updateOrder($orderdata);
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$data['ordercode'] = $orders[0]['ordercode'];
		$data['orderid'] = $orders[0]['orderid'];
		$data['name'] = $orders[0]['name'];
		$data['mobile'] = $orders[0]['mobile'];
		$data['email'] = $orders[0]['email'];
		$data['locality'] = $orders[0]['locality'];
		$data['address'] = $orders[0]['address'];
		$data['pickup_date'] = $orders[0]['pickup_date'];
		$data['time_slot'] = $orders[0]['slot'];
		$data['ordered_on'] = $orders[0]['ordered_on'];

		$vendordetails =  $this->orderlib->getVendorDetailsByVendorId($orderdata['vendor_id']);  
		 
		$temp_array=[];

        $temp_array['name']=$data['name'];
        $temp_array['mobile']=$data['mobile']; 
        $temp_array['email']=$data['email'];
        $temp_array['orderid']=$data['orderid'];
        $temp_array['ordercode']=$data['ordercode']; 
        $temp_array['ordered_on']=$data['ordered_on'];
        $temp_array['vendor_name']= $vendordetails[0]['garage_name'];
        $temp_array['vendor_mobile']=$vendordetails[0]['mobile'];  
        

		$this->orderlib->sendOrderConfirmEmail($temp_array);
		$this->orderlib->sendOrderConfirmSMS($temp_array);
		$this->orderlib->sendAssignedgarageNotification($orders[0]['userid']);
		$this->mechaniclib->sendGarageAssignedNotification($garage_id);
		if(!empty($vendor_mobiles)){
			$this->orderlib->sendOrderSMSToNumbers($data,$vendor_mobiles);
		}
		$logs = array();
		$logs['orderid'] = $orderid;
		$logs['comment'] = 'Mechanic Re-assigned.';
		$logs['created_date'] = date('Y-m-d H:i:s');
		$logs['order_status'] = 12;
		$logs['created_by'] = $orderdata['vendor_id'];
		$this->orderlib->addOrderLogs($logs);
		$response['status'] = 1;
		$response['message'] = 'Order Assigned To Mechanic.';
		echo json_encode($response);
	}
	
	public function reassignDelivery($orderid) {
		$this->load->library('zyk/OrderLib');
		$response = array();
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['delivery_slot'] = $this->input->get('delivery_slot');
		$orderdata['delivery_exe_id'] = $this->input->get('executive_id');
		$orderdata['tml_delivery_date'] = date('Y-m-d',strtotime($this->input->get('delivery_date')));
		$this->orderlib->updateOrder($orderdata);
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$dack = array();
		$dack['dack_rider_code'] = $orders[0]['delivery_dack_rider_code'];
		$dack['dack_tracking_id'] = $orders[0]['tracking_id'];
		$this->load->library ( 'zyk/Dack' );
		$resp = $this->dack->reassignToDack($dack);
		$data = array();
		$data['name'] = $orders[0]['name'];
		$data['mobile'] = $orders[0]['mobile'];
		$data['email'] = $orders[0]['email'];
		$data['bill_amount'] = $orders[0]['grand_total'];
		$data['delivery_executive'] = $orders[0]['delivery_executive'];
		$data['delivery_executive_mobile'] = $orders[0]['delivery_executive_mobile'];
		//$flag = $this->orderlib->sendDeliveryEmail($data);
		//$this->orderlib->sendDeliverySMS($data);
		$data['address'] = $orders[0]['address'];
		if($orders[0]['payment_status'] == 'Credit') {
			$data['grand_total'] = 0;
		} else {
			$data['grand_total'] = $orders[0]['grand_total'];
		}
		//$this->orderlib->sendDeliveryBoySMS($data);
		$logs = array();
		$logs['orderid'] = $orderid;
		$logs['comment'] = 'Re-Assigned For Delivery';
		$logs['created_date'] = date('Y-m-d H:i:s');
		$logs['created_by'] = $orders[0]['vendor_id'];
		$this->orderlib->addOrderLogs($logs);
		$response['status'] = 1;
		$response['message'] = 'Order Re-Assigned For Delivery.';
		echo json_encode($response);
	}
	
	public function cancelOrder($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);

		//$Userpackages = $this->orderlib->getUserpackageDetails($orders[0]['userid'],$orders[0]['package_id']);
		$this->load->model('search/Search_model','search_model');
		$Userpackages=$this->search_model->getPackageUsagesByUser6789($orders[0]['userid'],$orders[0]['package_id'],$orderid);
		 
			if(!empty($Userpackages))
			{
				$user_package['remaining_service_count'] = $Userpackages['remaining_service_count'] + 1;
				$user_package['is_expire'] = 1;
				$orderid_array=explode(',',$Userpackages['order_ids']);
				if(count($orderid_array)){
			    if (($key = array_search($orderid, $orderid_array)) !== false) {
                unset($orderid_array[$key]);
                  }
               $orderids=implode(',',$orderid_array);
               $user_package['order_ids'] = $orderids;
				}

			$this->db->where('id',$Userpackages['id']);
			$this->db->update('tbl_user_package',$user_package); 

			$this->db->where('orderid',$orderid);
			$this->db->where('is_package_service',1);
			$this->db->delete('tbl_booking_services'); 

			} 




		$orders[0]['reason'] = $this->input->get('comment');
		$data = array();
		$data['name'] = $orders[0]['name'];
		$data['ordercode'] = $orders[0]['ordercode'];
		$data['mobile'] = $orders[0]['mobile'];
		$data['email'] = $orders[0]['email'];
		$data['reason'] = $orders[0]['reason'];
		$flag = $this->orderlib->sendCancelEmail($data);
		$flag = 1;
		$response = array();
		if($flag) {
			$csms = array();
			$csms['name'] = $orders[0]['name'];
			$csms['mobile'] = $orders[0]['mobile'];
			$csms['ordercode'] = $orders[0]['ordercode'];
			$csms['orderid'] = $orders[0]['orderid'];
			$csms['reason'] = $orders[0]['reason']; 
			$this->orderlib->sendCancelSMS($csms);
			$orderdata = array();
			$orderdata['orderid'] = $orderid;
			$orderdata['status'] = 5;
			$this->orderlib->updateOrder($orderdata);
			$corder = array();
			$corder['orderid'] = $orderid;
			$corder['reason_id'] = $this->input->get('reason_id');
			$this->orderlib->addCancelOrderReason($corder);
			/* $dack = array();
			$dack['dack_tracking_id'] = $orders[0]['tracking_id'];
			$dack['cancel_reason'] = $csms['reason'];
			$this->load->library ( 'zyk/Dack' );
			$resp = $this->dack->cancelOrderToDack($dack); */
			$logs = array();
			$logs['orderid'] = $orderid;
			$logs['comment'] = 'Order Cancelled.';
			$logs['created_date'] = date('Y-m-d H:i:s');
			$logs['order_status'] = 5;
			$logs['created_by'] = $orders[0]['vendor_id'];
			$this->orderlib->addOrderLogs($logs);
			$response['status'] = 1;
			$response['message'] = 'Order cancelled.';
		} else {
			$response['status'] = 0;
			$response['message'] = 'Failed to cancel order.';
		}
		echo json_encode($response);
	}
	
	public function deleteOrder($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$orders[0]['reason'] = $this->input->get('comment');
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['status'] = 5;
		$this->orderlib->updateOrder($orderdata);
		$corder = array();
		$corder['orderid'] = $orderid;
		$corder['reason_id'] = $this->input->get('reason_id');
		$this->orderlib->addCancelOrderReason($corder);
		/*$dack = array();
		$dack['dack_tracking_id'] = $orders[0]['tracking_id'];
		$dack['cancel_reason'] = $orders[0]['reason'];
		$this->load->library ( 'zyk/Dack' );
		$resp = $this->dack->cancelOrderToDack($dack); */
		$logs = array();
		$logs['orderid'] = $orderid;
		$logs['comment'] = 'Order Deleted';
		$logs['created_date'] = date('Y-m-d H:i:s');
		$logs['created_by'] = $orders[0]['vendor_id'];
		$this->orderlib->addOrderLogs($logs);
		$response = array();
		$response['status'] = 1;
		$response['message'] = 'Order deleted.';
		echo json_encode($response);
	}
	
	public function addItems() {
            if(isset($_POST['itemname']) ) {
                foreach($_POST['itemname'] as $val) {
                    if($val == '') {
                        $response['status'] = 0;
                        $response['message'] = 'Please enter service';
                        echo json_encode($response);
                        exit;
                    }
                }
            } else {
                $response['status'] = 0;
				$response['message'] = 'Please enter service';
                echo json_encode($response);
                exit;
            }
		$this->load->library('zyk/OrderLib');
		$this->load->library ( 'zyk/UserLib' );
		$this->load->library('zyk/ItemLib');
		$this->load->library('zyk/MechanicLib');
		$orderid = $this->input->post('orderid');
		$order_date = $this->input->post('m_pickup_date');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
	
		$response = array();
		$itemids = $this->input->post('itemid');
		$itemnames = $this->input->post('itemname');
		$itemprices = $this->input->post('price');
		$itemtaxes = $this->input->post('itemtax');
		$itemtypes = $this->input->post('itemtype');
		$itempriority = $this->input->post('priority');
	    $ordertotal = 0;
		$items = array();
		$discountable_total = 0;
		for ($i = 0; $i < count($itemids); $i++) {
			$item = array();
			$item['orderid'] = $orderid;
			$item['service_id'] = $itemids[$i];
			$item['service_name'] = $itemnames[$i];
			$item['service_price'] = $itemprices[$i];
			$item['tax'] = $itemtaxes[$i];
			$item['service'] = $itemtypes[$i];
			$item['priority'] = $itempriority[$i];
			$cal=$itemtaxes[$i] /100 * $itemprices[$i];
			$item['total_amount']= $itemprices[$i] + $cal;
			$item['quantity'] = 1 ;
			$items[] = $item;
			$ordertotal = $ordertotal + $item['total_amount'];
		}
		//print_r($ordertotal);
		//print_r($items);
	   // exit;
		//if package booking is already placed

		$this->orderlib->addOrderItems($items);
		$delivery_charge = 0;
		$adjustment = 0;
		$newoutstanding = 0;
		$discount = 0;
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
		$orderdata['delivery_charge'] = 0;
		$orderdata['vat_tax'] = 0;
		$orderdata['service_tax'] = 0;
		$orderdata['discount'] = $discount;
		$orderdata['adjustment'] = $adjustment;
		$orderdata['net_total'] = $ordertotal - $discount + $delivery_charge;
		$orderdata['grand_total'] = $ordertotal - $discount + $delivery_charge + $adjustment;
		$orderdata['status'] = 2;
		//add package price in total order gbk  
		/*$orderData = $this->db->get_where('tbl_booking',array('orderid'=>$orderid,'package_id !='=>NULL))->result_array();
		if(!empty($orderData))
		{
		
			$order_ids = $this->db->get_where('tbl_user_package',array('package_id'=>$orderData[0]['package_id'],'user_id'=>$orderData[0]['userid']))->row('order_ids');
			$orderids =  explode(',', $order_ids);
			
			if(count($orderids) == 1)			
			{
				$orderdata['order_amount'] = $orderdata['order_amount'] + $orderData[0]['order_amount'];
  		    	$orderdata['net_total'] = $orderdata['net_total'] + $orderData[0]['net_total'];
  		    	$orderdata['grand_total'] = $orderdata['grand_total'] + $orderData[0]['grand_total'];
			}
		}*/

		/*Added */
		//Update order price 
    	$orderdata['order_amount'] =  $orders[0]['old_price'];
    	$orderdata['net_total'] =  $orders[0]['old_price'];
    	$orderdata['grand_total'] =  $orders[0]['old_price'];
		$this->orderlib->updateOrder($orderdata);
		//net_total grand_total
		$data = array();
		$data['name'] = $orders[0]['name'];
		$data['mobile'] = $orders[0]['mobile'];
		$data['email'] = $orders[0]['email'];
		$data['orderid'] = $orders[0]['orderid'];
		$data['ordercode'] = $orders[0]['ordercode']; 
		$data['pickup_date'] = $orders[0]['pickup_date'];
		$data['items'] = $items;
		//$data['delivery_date'] = date('Y-m-d',strtotime($this->input->post('delivery_date')));
		$data['order_amount'] = $ordertotal;
		//$flag = $this->orderlib->sendGenrateEstimateEmail($data);
		$this->orderlib->sendGenrateEstimateSMS($data);
		$this->load->library ( 'zyk/NotificationLib', 'notificationlib' );
		$this->notificationlib->sendEstimategeneratedNotification($orders[0]['userid']);
		// $this->mechaniclib->sendEstimateGenratedNotification($orders[0]['vendor_id']);
		//$this->orderlib->sendPickedUpSMS($data);
		
		$logs = array();
		$logs['orderid'] = $orderid;
		$logs['comment'] = 'Estimate Generated';
		$logs['created_date'] = date('Y-m-d H:i:s');
		$logs['order_status'] = 2;
		$logs['created_by'] = $orders[0]['vendor_id'];
		$this->orderlib->addOrderLogs($logs);
	
		$response['status'] = 1;
		$response['message'] = 'Order Services added successfully.';
		echo json_encode($response);
	}
	
	public function updateItems() {
            if(isset($_POST['itemname']) ) {
                foreach($_POST['itemname'] as $val) {
                    if($val == '') {
                        $response['status'] = 0;
                        $response['message'] = 'Please enter service';
                        echo json_encode($response);
                        exit;
                    }
                }
            } else {
                $response['status'] = 0;
		$response['message'] = 'Please enter service';
                echo json_encode($response);
                exit;
            }
		$this->load->library('zyk/OrderLib');
		$this->load->library ( 'zyk/UserLib' );
		$this->load->library('zyk/ItemLib');
		$orderid = $this->input->post('orderid');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		
		$adjustment = $orders[0]['adjustment'];
		$response = array();
		$itemids = $this->input->post('itemid');
		$itemnames = $this->input->post('itemname');
		$itemprices = $this->input->post('price');
		$itemtaxes = $this->input->post('itemtax');
		$itemtypes = $this->input->post('itemtype');
                $is_checked = $this->input->post('is_checked');
		$itempriority = $this->input->post('priority');
		$qtys = $this->input->post('qty');
		$wts = $this->input->post('weight');
		$ordertotal = 0;
		$items = array();
		for ($i = 0; $i < count($itemids); $i++) {
			$item = array();
			$item['orderid'] = $orderid;
			$item['service_id'] = $itemids[$i];
			$item['service_name'] = $itemnames[$i];
			$item['service_price'] = $itemprices[$i];
			$item['service'] = $itemtypes[$i];
			$item['tax'] = $itemtaxes[$i];
                        $item['is_checked'] = $is_checked[$i] != '' ? $is_checked[$i] : 0 ;
			$item['priority'] = $itempriority[$i];
			$cal=$itemtaxes[$i] /100 * $itemprices[$i];
			$item['total_amount']= $itemprices[$i] + $cal;
			//$total_amt += $item['total_amount'];
		        $items[] = $item;
			$ordertotal = $ordertotal +$item['total_amount'];
		}
		//print_r($ordertotal);
		//print_r($items);
		//exit;
                
		$this->orderlib->removeOrderItems($orderid);
		$this->orderlib->addOrderItems($items);
		$items = $this->orderlib->getOrderItems($orderid);
		$delivery_charge = 0;
		$discountable_total = 0;
		$discount = 0;
		$newoutstanding = 0;
//		if($orders[0]['outstanding'] != 0) {
//			$outstanding = $orders[0]['outstanding'] + $adjustment;
//			$newoutstanding = 0;
//			$nettotal = $ordertotal - $discount + $delivery_charge;
//			if($outstanding > 0) {
//				$adjustment = $outstanding;
//				$newoutstanding = 0;
//			} else {
//				$outstanding = $outstanding * -1;
//				if($outstanding <= $nettotal) {
//					$adjustment = $outstanding;
//					$newoutstanding = 0;
//				} else {
//					$adjustment = $nettotal;
//					$newoutstanding = $outstanding - $nettotal;
//				}
//				$adjustment = $adjustment * -1;
//				$newoutstanding = $newoutstanding * -1;
//			}
//		}
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['order_amount'] = $ordertotal;
		$orderdata['delivery_charge'] = $delivery_charge;
		$orderdata['vat_tax'] = 0;
		$orderdata['service_tax'] = 0;
		$orderdata['discount'] = $discount;
		$orderdata['adjustment'] = $adjustment;
		$orderdata['net_total'] = $ordertotal - $discount + $delivery_charge;
		$orderdata['grand_total'] = $ordertotal - $discount + $adjustment + $delivery_charge;

		//Update order price added 
    	$orderdata['order_amount'] = $orderdata['order_amount'] + $orders[0]['old_price'];
    	$orderdata['net_total'] = $orderdata['net_total'] + $orders[0]['old_price'];
    	$orderdata['grand_total'] = $orderdata['grand_total'] + $orders[0]['old_price'];
		$this->orderlib->updateOrder($orderdata);
		
		/*$data = array();
		$data['name'] = $orders[0]['name'];
		$data['mobile'] = $orders[0]['mobile'];
		$data['email'] = $orders[0]['email'];
		$data['orderid'] = $orders[0]['orderid'];
		$data['delivery_date'] = date('Y-m-d',strtotime($orders[0]['delivery_date'])); */
		//$flag = $this->orderlib->sendPickedUpEmail($data);
		//$this->orderlib->sendPickedUpSMS($data);
		$data = array();
		$data['name'] = $orders[0]['name'];
		$data['mobile'] = $orders[0]['mobile'];
		$data['email'] = $orders[0]['email'];
		$data['orderid'] = $orders[0]['orderid'];
		$data['ordercode'] = $orders[0]['ordercode'];
		$data['pickup_date'] = $orders[0]['pickup_date'];
		$data['items'] = $items;
		//$data['delivery_date'] = date('Y-m-d',strtotime($this->input->post('delivery_date')));
		$data['order_amount'] = $ordertotal;
		$this->orderlib->sendGenrateEstimateEmail($data);
		$this->orderlib->sendEstimategeneratedNotification($orders[0]['userid']);
		
		$logs = array();
		$logs['orderid'] = $orderid;
		$logs['comment'] = 'Estimate Updated';
		$logs['created_date'] = date('Y-m-d H:i:s');
		$logs['order_status'] = 10;
		$logs['created_by'] = $orders[0]['vendor_id'];
		$this->orderlib->addOrderLogs($logs);
		
		$response['status'] = 1;
		$response['message'] = 'Order Services updated successfully.';
		echo json_encode($response);
	}
	
	public function completeOrder($orderid) {
		$this->load->library('zyk/OrderLib');
		$this->load->library('zyk/UserLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		// $amount_received = $this->input->get('net_total');
		$pay_mode = $this->input->get('pay_mode');
		$final_total = $orders[0]['grand_total'];
		// $adjustment = $final_total - $amount_received;
		// $orderdata['amount_received'] = $amount_received;
		$orderdata['amount_received'] = 0;
		$orderdata['status'] = 7;
		$orderdata['pay_mode'] = $pay_mode;
		$this->orderlib->updateOrder($orderdata);
		/*if($adjustment != 0) {
			$outbill = array();
			$outbill['id'] = $orders[0]['userid'];
			$outbill['outstanding'] = $adjustment;
			$this->userlib->updateLatLong($outbill);
		}*/
		
		if($pay_mode == 1) {
			$data1['name'] = $orders[0]['name'];
            $data1['email'] = $orders[0]['email'];
            $data1['mobile'] = $orders[0]['mobile'];
            $data1['amount'] = $orders[0]['grand_total'];
            $data1['orderid'] = $orderid;
            $this->load->library ( 'zyk/PaymentLib' );
            $this->paymentlib->getPaymentUrl($data1);
		}
		
		$data = array();
		$data['name'] = $orders[0]['name'];
		$data['mobile'] = $orders[0]['mobile'];
		$data['email'] = $orders[0]['email'];
		$data['ordercode'] = $orders[0]['ordercode'];
		$data['orderid'] = $orders[0]['orderid']; 
		$data['grand_total'] =  $orders[0]['grand_total'];
		$data['pay_mode'] = $orderdata['pay_mode'];
		$data['assign_vendor_id'] = $orders[0]['assign_vendor_id']; 

    	$vendordetails =  $this->orderlib->getVendorDetailsByVendorId($data['assign_vendor_id']);   
    	$services	   =  $this->orderlib->getServiceDetailsByOrderId($data['orderid']); 
		$invoicedetails=  $this->orderlib->getInvoiceDetailsByOrderId($data['orderid']);  

		$invoice_url   = $invoicedetails[0]['invoice_url'];
    	$allservices = '';
    	foreach ($services as  $value) {
    		# code...
    		$allservices.=$value['service_name'].',';

    	}
    	$allservices = rtrim($allservices,','); 

    	if($data['pay_mode']=='1')
    	{
    		$pay_mode	= 'Online Paid';
    	}
    	elseif ($data['pay_mode']=='2') {
    		$pay_mode	= 'Cash On Delivery';
    	}
    	elseif ($data['pay_mode']=='3') {
    		$pay_mode	= 'Paytm';
    	} 


		$temp_array=[];

        $temp_array['name']=$data['name'];
        $temp_array['mobile']=$data['mobile'];
        $temp_array['email']=$data['email'];
        $temp_array['orderid']=$data['orderid'];
        $temp_array['ordercode']=$data['ordercode']; 
        $temp_array['grand_total']=$data['grand_total'];
        $temp_array['invoice_url']=$invoice_url;
        $temp_array['pay_mode']=$pay_mode;
        $temp_array['allservices']=$allservices;
        $temp_array['vendor_name']= $vendordetails[0]['garage_name'];
        $temp_array['vendor_mobile']=$vendordetails[0]['mobile'];

		$this->orderlib->sendConfirmDeliverySMS($temp_array);
		$this->orderlib->sendDeliveryEmail($temp_array);
		$this->load->library( 'zyk/NotificationLib', 'notificationlib' );
		$this->notificationlib->sendDeliveryCompleteNotification($orders[0]['userid']);

		//$this->addtowallet($orders[0]['userid']);
		$logs = array();
		$logs['orderid'] = $orderid;
		$logs['comment'] = 'Vehicle Ready To Delivery.';
		$logs['created_date'] = date('Y-m-d H:i:s');
		$logs['order_status'] = 7;
		$logs['created_by'] = $orders[0]['vendor_id'];
		$this->orderlib->addOrderLogs($logs);
		$response['status'] = 1;
		$response['msg'] = 'Order Marked completed successfully.';
		echo json_encode($response);
		
		/* if($orderdata['status'] == 6){
			$this->addtowallet($notification['userid']);
		} */
	}
	public function get_services_by_group() {
            $this->load->library('zyk/OrderLib');
            echo json_encode($this->orderlib->get_services_by_group($_POST['service_id']));
        }
        
        public function get_services_by_id() {
            $this->load->library('zyk/OrderLib');
            echo json_encode($this->orderlib->get_services_by_id($_POST));
        }
        
	public function generateInvoice($orderid) {
		//echo $orderid;
		$response = array();
		$this->load->library('zyk/OrderLib');
		$this->load->library('zyk/UserLib');
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
			 if(!empty($orders[0]['package_id'])) {

			  $packagewallet = $this->db->select('*')->from('packages')->where('id',$orders[0]['package_id'])->get()->result_array(); 
  
			  $userpackagecount = $this->orderlib->getUserPackageCount($orders[0]['userid'],$orders[0]['package_id']);     

		        if ($userpackagecount == 1 ) {  
 
				$wallet = array();
				$wallet['userid'] = $walletuserid1;
				$wallet['updated_by'] = 1;
				$wallet['orderid'] = $orderid;
				$wallet['amount'] = $packagewallet[0]['other_referral']; 
 
				$this->userlib->addToWallet($wallet);

				}

			} 
		}
  
		$ordercode = $orders[0]['ordercode'];
		//print_r($orders);
		if($orders[0]['invoice_status'] == 0) {
			$items = $this->orderlib->getOrderItems($orderid);
			$adjustment = $this->input->post('adjustment');
			$orderdata = array();
			$orderdata['orderid'] = $orderid;
			$orderdata['order_amount'] = $orders[0]['order_amount'];
			$orderdata['discount'] = $this->input->post('discount');
			$orderdata['adjustment'] = $adjustment;
			//$orderdata['delivery_charge'] = 20;
			$orderdata['net_total'] = $orders[0]['order_amount'] - $orderdata['discount'];
			$orderdata['grand_total'] = $orderdata['net_total'] + $adjustment;
			$invoice  = array();
			$invoice['orderid'] = $orders[0]['orderid'];
			$invoice['order_amount'] = $orders[0]['order_amount'];
			$invoice['discount'] = $orderdata['discount'];
			$invoice['service_tax'] = $orders[0]['service_tax'];
			$invoice['net_total'] = $orderdata['net_total'];
			$invoice['adjustment'] = $orderdata['adjustment'];
			$invoice['grand_total'] = round($orderdata['grand_total']);
			$invoice['invoice_date'] = date('Y-m-d H:i:s');
			$invoice['status'] = 0;
			$invoice_id = $this->orderlib->generateInvoice($invoice); 

			if($invoice_id > 0) {
				$orderdata['invoice_status'] = 1;
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
			//$orders[0]['delivery_charge'] = $orderdata['delivery_charge'];
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
			$html = $this->template->build ('orders/InvoiceDetails','',true);
                        //exit();
			$file_name = "invoice_".$ordercode.".pdf";
			$this->load->library('MyPdfLib');
			$url = $this->mypdflib->getPdf($html,$file_name);
			
			
			//$payment_url = base_url().'paynow/'.$orderid;
 
			$data1['name'] = $orders[0]['name'];
	        $data1['email'] = $orders[0]['email'];
	        $data1['mobile'] = $orders[0]['mobile'];
	        $data1['amount'] = $orders[0]['grand_total'];
	        $data1['orderid'] = $orderid;
	        $this->load->library ( 'zyk/PaymentLib' );
	        $payment_url = $this->paymentlib->getPaymentUrl($data1);
	        
	        //print_r($payment_url);

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

			/*echo "<pre>";
			print_r($data);
			exit();*/ 

			$this->orderlib->sendInvoiceEmail($data); 
			$this->orderlib->sendInvoiceSMS($data);
			$this->load->library ( 'zyk/NotificationLib', 'notificationlib' );
			$this->notificationlib->sendGenerateinvoiceNotification($orders[0]['userid'],$data['bill_amount']);
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
			$logs['created_by'] = $orders[0]['vendor_id'];
			$this->orderlib->addOrderLogs($logs);
		
			if(!empty($invoice_id)) {
				$response['status'] = 1;
				$response['msg'] = 'Invoice Generated Successfully.';
			} else {
				$response['status'] = 1;
				$response['msg'] = 'Failed to generate invoice.';
			}
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Invoice already generated.';
		}
		echo json_encode($response);
	}
	
	public function updatePickUpDate($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$pickupdate = $this->input->post('pickup_date');
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['pickup_date'] = date('Y-m-d',strtotime($pickupdate));
		$del_date = date('Y-m-d',strtotime('+48 hours',strtotime($orderdata['pickup_date'])));
		$orderdata['delivery_date'] = date('Y-m-d',strtotime('+72 hours',strtotime($orderdata['pickup_date'])));
		if($orders[0]['status'] == 1) {
			$orderdata['pickup_rescheduled'] = 1;
			$orderdata['pickup_notes'] = 'Pickup Rescheduled';
			$this->orderlib->updateOrder($orderdata);
			$picktimes = explode("-",$orders[0]['pickup_slot']);
			$dack = array();
			$dack['dack_tracking_id'] = $orders[0]['tracking_id'];
			$dack['new_time'] = date('Y-m-d',strtotime($orderdata['pickup_date']))." ".date('H:i:s',strtotime($picktimes[0]));
			$dack['old_time'] = date('Y-m-d',strtotime($orders[0]['pickup_date']))." ".date('H:i:s',strtotime($picktimes[0]));
			$this->load->library ( 'zyk/Dack' );
			$resp = $this->dack->rescheduleOrderToDack($dack);
		} else {
			$orderdata['pickup_notes'] = 'Pickup Rescheduled';
			$this->orderlib->updateOrder($orderdata);
		}
		$response['status'] = 1;
		$response['msg'] = 'Updated successfully.';
		echo json_encode($response);
	}
	
	public function updatePickUpSlot($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$pickupslot = $this->input->post('pickup_slot');
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['slot'] = $pickupslot;
		if($orders[0]['status'] == 1) {
			$orderdata['pickup_rescheduled'] = 1;
			$orderdata['pickup_notes'] = 'Pickup Rescheduled';
			$this->orderlib->updateOrder($orderdata);
			$picktimes = explode("-",$orderdata['pickup_slot']);
			$oldpicktimes = explode("-",$orders[0]['pickup_slot']);
			$dack = array();
			$dack['dack_tracking_id'] = $orders[0]['tracking_id'];
			$dack['new_time'] = date('Y-m-d',strtotime($orders[0]['pickup_date']))." ".date('H:i:s',strtotime($picktimes[0]));
			$dack['old_time'] = date('Y-m-d',strtotime($orders[0]['pickup_date']))." ".date('H:i:s',strtotime($oldpicktimes[0]));
			$this->load->library ( 'zyk/Dack' );
			$resp = $this->dack->rescheduleOrderToDack($dack);
		} else {
			$orderdata['pickup_notes'] = 'Pickup Rescheduled';
			$this->orderlib->updateOrder($orderdata);
		}
		$response['status'] = 1;
		$response['msg'] = 'Updated successfully.';
		echo json_encode($response);
	}
	
	public function reschedulePickUp($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		if(empty($this->input->post('pickup_date'))) {
			$response['status'] = 0;
			$response['msg'] = 'Pickup Date Required.';
			echo json_encode($response);
			exit;
		}
		if(empty($this->input->post('pickup_slot'))) {
			$response['status'] = 0;
			$response['msg'] = 'Pickup Slot Required.';
			echo json_encode($response);
			exit;
		}
		$pickupslot = $this->input->post('pickup_slot');
		$pickupdate = $this->input->post('pickup_date');
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['pickup_date'] = date('Y-m-d',strtotime($pickupdate));
		$orderdata['slot'] = $pickupslot;
		$orderdata['pickup_rescheduled'] = 1;
		if(!empty($this->input->post('notes'))) {
			$orderdata['pickup_notes'] = $this->input->post('notes');
		} else {
			$orderdata['pickup_notes'] = 'Pickup Rescheduled';
		}
		$orderdata['status'] = 0;
		$orderdata['pickup_exe_id'] = null;
		$orderdata['is_pickup_accepted'] = 0;
 
		$this->orderlib->updateOrder($orderdata);
		
		$data = array();
		$data['name'] = $orders[0]['name'];
		$data['email'] = $orders[0]['email'];
		$data['mobile'] = $orders[0]['mobile'];
		$data['orderid'] = $orders[0]['orderid'];
		$data['ordercode'] = $orders[0]['ordercode'];
		$data['oldpickdate'] = $orders[0]['pickup_date'];
		$data['oldpicktime'] = $orders[0]['slot'];
		$data['pickup_date'] = $$orderdata['pickup_date'];
		$data['pickup_slot'] = $pickupslot;
		
		$this->orderlib->sendRescheduleSMS($data);
		$this->orderlib->sendRescheduleEmail($data);
		
		$picktimes = explode("-",$orderdata['pickup_slot']);
		$oldpicktimes = explode("-",$orders[0]['pickup_slot']);
		$logs = array();
		$logs['orderid'] = $orderid;
		$logs['comment'] = 'Order Reschedule';
		$logs['created_date'] = date('Y-m-d H:i:s');
		$logs['order_status'] = 11;
		$logs['created_by'] =  $orders[0]['vendor_id'];
		$this->orderlib->addOrderLogs($logs);
		
		$response['status'] = 1;
		$response['msg'] = 'Updated successfully.';
		echo json_encode($response);
	}
	
	public function updateDeliveryDate($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$deliverydate = $this->input->post('delivery_date');
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['delivery_date'] = date('Y-m-d',strtotime($deliverydate));
		$orderdata['tml_delivery_date'] = date('Y-m-d',strtotime('-1 day',strtotime($deliverydate)));
		if($orders[0]['status'] == 3) {
			$orderdata['delivery_rescheduled'] = 1;
			$orderdata['delivery_notes'] = 'Delivery Rescheduled';
			$this->orderlib->updateOrder($orderdata);
			$picktimes = explode("-",$orders[0]['delivery_slot']);
			$dack = array();
			$dack['dack_tracking_id'] = $orders[0]['tracking_id'];
			$dack['new_time'] = date('Y-m-d',strtotime($orderdata['delivery_date']))." ".date('H:i:s',strtotime($picktimes[0]));
			$dack['old_time'] = date('Y-m-d',strtotime($orders[0]['delivery_date']))." ".date('H:i:s',strtotime($picktimes[0]));
			$this->load->library ( 'zyk/Dack' );
			$resp = $this->dack->rescheduleOrderToDack($dack);
		} else {
			$orderdata['delivery_notes'] = 'Delivery Rescheduled';
			$this->orderlib->updateOrder($orderdata);
		}
		$response['status'] = 1;
		$response['msg'] = 'Updated successfully.';
		echo json_encode($response);
	}
	
	public function updateDeliverySlot($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$delivery_slot = $this->input->post('delivery_slot');
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['delivery_slot'] = $delivery_slot;
		if($orders[0]['status'] == 3) {
			$orderdata['delivery_rescheduled'] = 1;
			$orderdata['delivery_notes'] = 'Delivery Rescheduled';
			$this->orderlib->updateOrder($orderdata);
			$picktimes = explode("-",$orderdata['delivery_slot']);
			$oldpicktimes = explode("-",$orders[0]['delivery_slot']);
			$dack = array();
			$dack['dack_tracking_id'] = $orders[0]['tracking_id'];
			$dack['new_time'] = date('Y-m-d',strtotime($orders[0]['delivery_date']))." ".date('H:i:s',strtotime($picktimes[0]));
			$dack['old_time'] = date('Y-m-d',strtotime($orders[0]['delivery_date']))." ".date('H:i:s',strtotime($oldpicktimes[0]));
			$this->load->library ( 'zyk/Dack' );
			$resp = $this->dack->rescheduleOrderToDack($dack);
		} else {
			$orderdata['delivery_notes'] = 'Delivery Rescheduled';
			$this->orderlib->updateOrder($orderdata);
		}
		$response['status'] = 1;
		$response['msg'] = 'Updated successfully.';
		echo json_encode($response);
	}
	
	public function rescheduleDelivery($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		if(empty($this->input->post('delivery_date'))) {
			$response['status'] = 0;
			$response['msg'] = 'Delivery Date Required.';
			echo json_encode($response);
			exit;
		}
		if(empty($this->input->post('delivery_slot'))) {
			$response['status'] = 0;
			$response['msg'] = 'Delivery Slot Required.';
			echo json_encode($response);
			exit;
		}
		$deliveryslot = $this->input->post('delivery_slot');
		$deliverydate = date('Y-m-d',strtotime($this->input->post('delivery_date')));
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		if($deliverydate > $orders[0]['delivery_date']) {
			$orderdata['delivery_date'] = date('Y-m-d',strtotime($deliverydate));
		}
		$orderdata['tml_delivery_date'] = date('Y-m-d',strtotime($deliverydate));
		$orderdata['delivery_slot'] = $deliveryslot;
		$orderdata['delivery_rescheduled'] = 1;
		if(!empty($this->input->post('notes'))) {
			$orderdata['delivery_notes'] = $this->input->post('notes');
		} else {
			$orderdata['delivery_notes'] = 'Delivery Rescheduled';
		}
		$orderdata['status'] = 2;
		$orderdata['delivery_exe_id'] = null;
		$orderdata['is_delivery_accepted'] = 0;
		$this->orderlib->updateOrder($orderdata);
		$picktimes = explode("-",$orderdata['delivery_slot']);
		$oldpicktimes = explode("-",$orders[0]['delivery_slot']);
		$dack = array();
		$dack['dack_tracking_id'] = $orders[0]['tracking_id'];
		$dack['new_time'] = date('Y-m-d',strtotime($orderdata['tml_delivery_date']))." ".date('H:i:s',strtotime($picktimes[0]));
		$dack['old_time'] = date('Y-m-d',strtotime($orders[0]['tml_delivery_date']))." ".date('H:i:s',strtotime($oldpicktimes[0]));
		$dack['time_slot'] = $orderdata['delivery_slot'];
		$this->load->library ( 'zyk/Dack' );
		$resp = $this->dack->rescheduleOrderToDack($dack);
		$response['status'] = 1;
		$response['msg'] = 'Updated successfully.';
		echo json_encode($response);
	}
	
	public function requestPayment($orderid) {
		$response = array();
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetails($orderid);
		$payment_url = base_url().'paynow/'.$orderid;
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
		$response['msg'] = 'Payment Link Send Successfully.';
		echo json_encode($response);
	}
	
	public function newOrder() {
		$this->load->library('zyk/General');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$this->load->library('zyk/SlotLib', 'slotlib');
		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$categories = $this->servicelib->getActiveCategories();
		$models = $this->servicelib->getActiveModels();
		$visitingslots = $this->slotlib->getActiveVisiting1();
	//	$slots = $this->general->getActivePickupSlots();
		$areas = $this->general->getActiveAreas();
	//	$vendors = $this->itemlib->getActiveVendor();  
        $brands = $this->vehicallib->getActiveBikeBrands();  
        $models = $this->servicelib->getActiveModels(); 
        $servicegroup = $this->servicelib->getActiveServiceGroupsName();
        $this->template->set('brands',$brands);
       // $this->template->set('categories',$categories);
        $this->template->set('servicegroup',$servicegroup);
        $this->template->set('models',$models);
		$this->template->set('areas',$areas);
		$this->template->set('categories',$categories);
		$this->template->set('visitingslots',$visitingslots);
	//	$this->template->set('vendors',$vendors);
		$this->template->set('models',$models);
		$this->template->set('page','porders');
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/NewOrder');
	}
	
	public function addOrder() {
            
		$data = $this->input->post('item');
		//print_r($data);exit ; 
                if($data ['latitude'] == '' || $data['longitude'] == '') {
                    echo json_encode(array('status' => 0, 'msg' => 'Please enter valid address'));
                    exit;
                }
                /*if(empty($_POST['single_services']) || empty($_POST['spare_id'])) {
                    echo json_encode(array('status' => 0, 'msg' => 'Please select service or spare'));
                    exit;
                }*/
		$params = array();
		$notification = array();
		if(empty($data['userid'])) {
			$reg = array ();
			$reg ['name'] = trim($data['name']);
			$reg ['password'] = '123456';
			$reg ['email'] = $data['email'];
			$reg ['mobile'] = $data['mobile']; 
			$reg ['locality'] = $data['landmark'];
			$reg ['latitude'] = $data['latitude'];
			$reg ['longitude'] =$data['longitude'];  
			$reg ['original'] = '123456';
			$reg ['source'] = 'Backend'; 

			$this->load->library('zyk/General');
			$this->load->library ( 'zyk/UserLib' );
			$exist = $this->userlib->userExist ( $reg );
			if($exist['status'] == 0) {
				$register = $this->userlib->userRegistration ( $reg );
				
				$params['userid'] = $register['id'];

				$vehicles =  array(

					'user_id' => $params['userid'],
				);

				$this->db->where('id', $data['vehical_no']);
				$this->db->update ('tbl_user_vehicles',$vehicles);

			} else {
				$params['userid'] = $exist['id'];
			}
		} else {
			$params['userid'] = $data['userid'];
		}
		$params ['locality'] = $data['landmark'];
		$params['latitude'] = $data['latitude'];
		$params['longitude'] =$data['longitude'];
		$params['name'] = $data['name'];
		$params['email'] = $data['email'];
		$params['mobile'] = $data['mobile'];
		$params['category_id'] = 9 ;
		//$params['brand_id'] = $data['brand_id']; 

			$this->load->library('zyk/RestaurantLib');
			/*$vendors = $this->restaurantlib->getSearchedVendor($params);
			/*print_r($vendors);
			exit;/
			if(!empty($vendors))
			{
			//	echo "if";
				$response['status'] = 1;
				$response['msg'] = 'Our service is available for this area.'; 
				$params['latitude'] = $params['latitude'];
				$params['longitude'] = $params['longitude'];
				$params['locality'] = $params['locality']; 
			}
			else 
			{
				//	echo "else";
				$response['status'] = 0;
				$response['msg'] = 'Our service is not available for this area.';
				echo json_encode($response);exit();
			}*/ 

	
		$params['vehicle_id'] = $data['vehical_no']; 

		$vehicles = $this->orderlib->get_vehicles_by_id($data['vehical_no']);
 
		$service_id = $this->input->post('service_id');
		$package_id = $this->input->post('package_id');
		$subcategory_id = $this->input->post('subcategory_id');
		$serid = '0'; 
		if(count($service_id)>0){
		    $serid = implode(",",$service_id);
		}
		$subid = implode(",",$subcategory_id);
		$params['service_id'] = $serid;
		$params['package_id'] = $package_id;
		$params['subcategory_id'] = $subid;
		$params['catsubcat_id'] = $serid;
		$params['slot'] = $data['slot'];
		$params['comment'] = $data['comment'];
		$params['brand_id'] = $vehicles[0]['brand_id'];
		$params['vehicle_model'] = $vehicles[0]['model_id'];
		$params['vendor_id'] = $data['vendor_id'];
		$params['status'] = 0;
		$params['service'] = '';
		if(!empty($data['pickup_date']))
			$params['pickup_date'] = date('Y-m-d',strtotime($data['pickup_date']));
		else
			$params['pickup_date'] = date('Y-m-d');
		$del_date = date('Y-m-d',strtotime('+48 hours',strtotime($params['pickup_date'])));
		/*$day = date('D',strtotime($del_date));
		if($day == 'Wed') {
			$del_date = date('Y-m-d',strtotime('+24 hours',strtotime($del_date)));
		}*/
		$params['delivery_date'] = date('Y-m-d',strtotime('+72 hours',strtotime($params['pickup_date'])));
		$params['ordered_on'] = date('Y-m-d H:i:s');
		$params['source'] = 3;
		$this->load->library('zyk/OrderLib'); 

		if($data['latitude']=='' && $data['longitude']==''){
			$new = getLatLong($data['landmark']);
 			$params['latitude'] = $new['lat'];
			$params['longitude'] =$new['lng']; 
		}  
		if($params['latitude']=="" && $params['longitude']==""){
			$response['status'] = 0;
			$response['msg'] = "Failed to add order ...Please enter valid address..!";
			echo json_encode($response);
			exit;
		}
 

		$orderid = $this->orderlib->addOrder($params); 
		//$orderid = 33; 
		//print_r($orderid);
		if($orderid > 0) {
			$params['orderid'] = $orderid;
			
			$oupdate = array();
			$oupdate['orderid'] = $orderid;
			$oupdate['ordercode'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($orderid, 10, 36)) ;
			//$this->orderlib->updateOrder($oupdate);  
			$params['ordercode'] = $oupdate['ordercode'];

		if(!empty($params['package_id'])) { 
   
 				//new package 1st time changes 
					$this->load->library('zyk/SearchLib'); 
					$packageData = $this->searchlib->getPackageDetailsbyId($params['package_id']); 
					$oupdate['old_price'] = $packageData['special_price']; 
 				//check previous used
                    $userid = $params['userid'];
		 		//get package usages
 					$packageUsages = $this->searchlib->getPackageUsagesByUser($packageData['id'], $userid, $params['vehicle_id']);  
                                //check count with year  
                                if(isset($packageUsages['remaining_service_count']) && $packageUsages['remaining_service_count'] == 0 || empty($packageUsages)){ 						 
 				error_reporting(0);		
                                                $this->template->set('order',$params);
						$this->template->set('ordercode',$oupdate['ordercode']);
						$this->template->set('packageData',$packageData); 
		 	 			$this->template->set_theme('default_theme');
						$this->template->set_layout (false)
									   ->title ( 'Administrator | Generate Invoice' ); 
						$html = $this->template->build ('orders/PackageInvoiceDetails','',true); 
 		 	 			$file_name = "invoice_package".$oupdate['ordercode'].".pdf"; 
		 				$this->load->library('MyPdfLib');
						$url = $this->mypdflib->getPdf($html,$file_name);  
                                            //insert data into tbl_user_package
                                            $user_package['user_id'] = $userid;
                                            $user_package['is_expire'] = 1;
                                            $user_package['invoice_url'] =$url ;
                                            $user_package['service_used_validity'] = $packageData['service_used_validity']; 
                                            $user_package['remaining_service_count'] = $packageData['service_used_validity']-1;
                                            $user_package['created_date'] = date('Y-m-d');
                                            $user_package['expiry_date'] = date('Y-m-d', strtotime("+{$packageData['year']} years")); 
                                            $user_package['year'] = $packageData['year'];
                                            $user_package['order_ids'] = $orderid;
                                            $user_package['package_id'] = $packageData['id'];
                                            $user_package['vehicle_id'] = $params['vehicle_id']; 
                                            $this->db->insert('tbl_user_package',$user_package);
                                            $user_packageid=$this->db->insert_id();
                                        } else { 
 
                                            $this->load->library('zyk/SearchLib'); 
                                            $userid = $params['userid'];
                                            $usercnt = $packageUsages['remaining_service_count'] - 1;
                                                if($usercnt == 0){
                                                $user_package['is_expire'] = 0;
                                                }  
                                                $user_package['remaining_service_count'] = $usercnt;
                                                $user_package['order_ids'] = $packageUsages['order_ids'].','.$orderid;

                                                $this->db->where('id',$packageUsages['id']);
                                                $this->db->update('tbl_user_package',$user_package);

                                                $oupdate['old_price'] = 0;
                                                $this->orderlib->updateOrder($oupdate); 
  
 		 			}  //package close
				 
			}
			if(!empty($_POST['single_services'])) {
				 
                $services['single_services'] = $_POST['single_services'];
                $services['spare_id'] = isset($_POST['spare_id']) ? $_POST['spare_id'] : 0;
                $items = $this->orderlib->get_services_by_id($services);
                $Interdata = array();
                $ordertotal = 0;
                if(!empty($items['service'])) {
                    foreach($items['service'] as $value) {
                        $cal = $value['tax'] == 0 ? 0 : $value['tax'] / 100 * $value['price'];
                        $total_amount = $cal + $value['price'];
                        $Interdata[] = array(
                            'orderid' => $orderid,
                            'service_id' => $value['id'],
                            'service_name' => $value['name'],
                            'service_price' => $value['price'],
                            'tax' => $value['tax'],
                            'service' => 1,
                            'quantity' => 1,
                            'priority' => 1,
                            'total_amount' => round($total_amount),
					);
					$ordertotal = $ordertotal + $total_amount;
				    }
                }
                if(!empty($items['spare'])) {
                    foreach($items['spare'] as $value) {
                         $cal = $value['tax'] == 0 ? 0 : $value['tax'] / 100 * $value['price'];
                        $total_amount = $cal + $value['price'];
                        $Interdata[] = array(
                            'orderid' => $orderid,
                            'service_id' => $value['id'],
                            'service_name' => $value['name'],
                            'service_price' => $value['price'],
                            'tax' => $value['tax'],
                            'service' => 2,
                            'quantity' => 1,
                            'priority' => 1,
                            'total_amount' => round($total_amount),
							);
					$ordertotal = $ordertotal + $total_amount;
		                    }
		            }   
		         
                $this->orderlib->addOrderItems($Interdata);

                $oupdate['order_amount'] = round($ordertotal);  
	 			$oupdate['net_total'] = $oupdate['order_amount']; 
	 			$oupdate['grand_total'] = $oupdate['order_amount'];
	 			$oupdate['discount'] = 0 ; 	 

		 		$this->orderlib->updateOrder($oupdate);  

			} 
			$this->orderlib->updateOrder($oupdate); 
			$this->orderlib->sendBookingEmail($params);
			$this->orderlib->sendBookingSMS($params);
			$this->orderlib->sendEstimategeneratedNotification($params['userid']);
			
			$response['orderid'] = $orderid;
			$response['status'] = 1;
			$response['msg'] = "Order punched in system";

			$logs = array();
			$logs['orderid'] = $orderid;
			$logs['comment'] = 'Booking Request Sent.';
			$logs['created_date'] = date('Y-m-d H:i:s');
			$logs['order_status'] = 0;
			$logs['created_by'] = $this->session->userdata('adminsession')['id'];
			$this->orderlib->addOrderLogs($logs); 

			$response['status'] = 1;
			$response['msg'] = "Order punched in system";  

		} else {
			$response['status'] = 0;
			$response['msg'] = "Failed to add order";
		}
                
		echo json_encode($response);
	} 
	
	public function getUserByEmail() {
		$email = $this->input->get('email');
		$this->load->library('zyk/UserLib');
		$user = $this->userlib->getProfileByEmail($email);
		echo json_encode($user);
	}
	
	public function getUserByMobile() {
		$mobile = $this->input->get('mobile');
		$this->load->library('zyk/UserLib');
		$user = $this->userlib->getProfileByMobile($mobile);
		echo json_encode($user);
	}
	
	public function getUserByName() {
		$name = $this->input->get('name');
		$this->load->library('zyk/UserLib');
		$user = $this->userlib->getProfileByName($name);
		echo json_encode($user);
	}
	
	public function userDetail($id) {
		$this->load->library('zyk/UserLib');
		$user = $this->userlib->getProfile($id);
		echo json_encode($user[0]);
	}
	
	public function updateCustomerName($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$name = $this->input->post('name');
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['name'] = $name;
		$this->orderlib->updateOrder($orderdata);
		$this->load->library('zyk/UserLib');
		$user = array();
		$user['id'] = $orders[0]['userid'];
		$user['name'] = $name;
		$this->userlib->updateUserProfile($user);
		$response['status'] = 1;
		$response['msg'] = 'Updated successfully.';
		echo json_encode($response);
	}
	
	public function updateRatecard($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$rate_id = $this->input->post('rate_id');
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['rate_id'] = $rate_id;
		$this->orderlib->updateOrder($orderdata);
		$this->load->library('zyk/UserLib');
		$response['status'] = 1;
		$response['msg'] = 'Updated successfully.';
		echo json_encode($response);
	}
	
	public function updateCustomerEmail($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$email = $this->input->post('email');
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['email'] = $email;
		$this->orderlib->updateOrder($orderdata);
		$this->load->library('zyk/UserLib');
		$user = array();
		$user['id'] = $orders[0]['userid'];
		$user['email'] = $email;
		$this->userlib->updateUserProfile($user);
		$response['status'] = 1;
		$response['msg'] = 'Updated successfully.';
		echo json_encode($response);
	}
	
	public function updateCustomerMobile($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$mobile = $this->input->post('mobile');
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['mobile'] = $mobile;
		$this->orderlib->updateOrder($orderdata);
		$this->load->library('zyk/UserLib');
		$user = array();
		$user['id'] = $orders[0]['userid'];
		$user['mobile'] = $mobile;
		$this->userlib->updateUserProfile($user);
		$response['status'] = 1;
		$response['msg'] = 'Updated successfully.';
		echo json_encode($response);
	}
	
	public function updateCustomerGst($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$gst_no = $this->input->post('gst_no');
		/*$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['gst_no'] = $gst_no;
		$this->orderlib->updateOrder($orderdata);*/
		$this->load->library('zyk/UserLib');
		$user = array();
		$user['id'] = $orders[0]['userid'];
		$user['gst_no'] = $gst_no;
		$this->userlib->updateUserProfile($user);
		$response['status'] = 1;
		$response['msg'] = 'Updated successfully.';
		echo json_encode($response);
	}
	public function updateCustomerGstname($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$gst_name= $this->input->post('gst_name');
		/*$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['gst_no'] = $gst_no;
		$this->orderlib->updateOrder($orderdata);*/
		$this->load->library('zyk/UserLib');
		$user = array();
		$user['id'] = $orders[0]['userid'];
		$user['gst_name'] = $gst_name;
		$this->userlib->updateUserProfile($user);
		$response['status'] = 1;
		$response['msg'] = 'Updated successfully.';
		echo json_encode($response);
	}
	
	public function updateCustomerAddress($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$address = $this->input->post('address');
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['address'] = $address;
		$this->orderlib->updateOrder($orderdata);
		$this->load->library('zyk/UserLib');
		$user = array();
		$user['id'] = $orders[0]['userid'];
		$user['address'] = $address;
		$this->userlib->updateUserProfile($user);
		$addrs = array();
		$addrs['userid'] = $orders[0]['userid'];
		$addrs['address'] = $address;
		$this->userlib->updateAddressByUserId($addrs);
		$response['status'] = 1;
		$response['msg'] = 'Updated successfully.';
		echo json_encode($response);
	}
	
	public function updateCustomerLandmark($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$landmark = $this->input->post('landmark');
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['landmark'] = $landmark;
		$this->orderlib->updateOrder($orderdata);
		$this->load->library('zyk/UserLib');
		$user = array();
		$user['id'] = $orders[0]['userid'];
		$user['landmark'] = $landmark;
		$this->userlib->updateUserProfile($user);
		$addrs = array();
		$addrs['userid'] = $orders[0]['userid'];
		$addrs['landmark'] = $landmark;
		$this->userlib->updateAddressByUserId($addrs);
		$response['status'] = 1;
		$response['msg'] = 'Updated successfully.';
		echo json_encode($response);
	}
	
	public function generateInvoices() {
		$orderids = $this->input->post('orderids');
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByIds($orderids);
		$orderupdates = array();
		$oinvoices = array();
		foreach ($orders as $order) {
			if($order['invoice_status'] == 0) {
				if($order['order_amount'] > 0) {
					$items = $this->orderlib->getOrderItems($order['orderid']);
					$invoice  = array();
					$invoice['orderid'] = $order['orderid'];
					$invoice['order_amount'] = $order['order_amount'];
					$invoice['discount'] = $order['discount'];
					$invoice['service_tax'] = $order['service_tax'];
					$invoice['net_total'] = $order['net_total'];
					$invoice['adjustment'] = $order['adjustment'];
					$invoice['grand_total'] = $order['grand_total'];
					$invoice['invoice_date'] = date('Y-m-d H:i:s');
					$invoice['status'] = 0;
					$invoice_id = $this->orderlib->generateInvoice($invoice);
					$orderdata = array();
					if($invoice_id > 0) {
						$orderdata['orderid'] = $order['orderid'];
						$orderdata['invoice_status'] = 1;
						$orderupdates[] = $orderdata;
					}
					$this->template->set('order',$order);
					$this->template->set('invoice_number',$invoice_id);
					$this->template->set('items',$items);
					$this->template->set_theme('default_theme');
					$this->template->set_layout (false)
					->title ( 'Administrator | Generate Invoice' );
					$html = $this->template->build ('orders/InvoiceDetails','',true);
					$file_name = "invoice_".$invoice_id.".pdf";
					$this->load->library('MyPdfLib');
					$url = $this->mypdflib->getPdf($html,$file_name);
					$newinvoice = array();
					$newinvoice['id'] = $invoice_id;
					$newinvoice['invoice_url'] = $url;
					$oinvoices[] = $newinvoice;
					$payment_url = base_url().'paynow/'.$order['orderid'];
					$data = array();
					$data['name'] = $order['name'];
					$data['bill_amount'] = $order['grand_total'];
					$data['invoice_url'] = $url;
					$data['payment_url'] = $payment_url;
					$data['email'] = $order['email'];
					$data['mobile'] = $order['mobile'];
					$this->orderlib->sendInvoiceEmail($data);
					$this->orderlib->sendInvoiceSMS($data);
					$data['name'] = $order['name'];
					$data['email'] = $order['email'];
					$data['mobile'] = $order['mobile'];
					$data['amount'] = $order['grand_total'];
					$data['orderid'] = $order['orderid'];
					$this->load->library ( 'zyk/PaymentLib' );
					$resp = $this->paymentlib->getPaymentUrl($data);
				}
			}
		}
		if(count($oinvoices) > 0)
		$this->orderlib->updateBulkInvoice($oinvoices);
		if(count($orderupdates) > 0)
		$this->orderlib->updateBulkOrder($orderupdates);
		$response = array();
		if(count($oinvoices) > 0) {
			$response['status'] = 1;
			$response['message'] = 'Invoice Generated Successfully.';
		} else {
			$response['status'] = 1;
			$response['message'] = 'Failed to generate invoice.';
		}
		echo json_encode($response);
	}
	
	public function updateOrderStatus($orderid) {
		$status = $this->input->post('status');
		$this->load->library('zyk/OrderLib');
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['status'] = $status;
		$this->orderlib->updateOrder($orderdata);
		$response['status'] = 1;
		$response['msg'] = 'Order Status Updated Successfully.';
		echo json_encode($response);
	}
	
	public function updateOrderAdjustment($orderid) {
		$this->load->library('zyk/OrderLib');
		$adj_type = $this->input->post('adj_type');
		$adjustment = $this->input->post('adjustment');
		$orders = $this->orderlib->getOrderDetails($orderid);
		if($adj_type == 1) {
			$adjustment = $adjustment * -1;
		}
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['grand_total'] = $orders[0]['net_total'] + $adjustment;
		$orderdata['adjustment'] = $adjustment;
		$this->orderlib->updateOrder($orderdata);
		$response['status'] = 1;
		$response['msg'] = 'Order Updated Successfully.';
		echo json_encode($response);
	}
	
	public function updateBatchDeliveryDate() {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getPreviousDayPendingDeliveries();
		$orderdata = array();
		foreach ($orders as $order) {
			$newOrder = array();
			$newOrder['orderid'] = $order['orderid'];
			$newOrder['tml_delivery_date'] = date('Y-m-d');
			$newOrder['delivery_date'] = date('Y-m-d',strtotime('+1 day'));
			$orderdata[] = $newOrder;
		}
		$this->orderlib->updateBatchDelivery($orderdata);
	}
	
	public function updateCustomDeliveryDate() {
		$this->load->library('zyk/OrderLib');
		$orderids = $this->input->post('orderids');
		$delivery_date = $this->input->post('delivery_date');
		$delivery_date = date('Y-m-d',strtotime($delivery_date));
		$orders = explode(",",$orderids);
		$orderdata = array();
		foreach ($orders as $order) {
			$newOrder = array();
			$newOrder['orderid'] = $order;
			$newOrder['delivery_date'] = date('Y-m-d',strtotime('+1 day',strtotime($delivery_date)));
			$newOrder['tml_delivery_date'] = $delivery_date;
			$orderdata[] = $newOrder;
		}
		if(count($orderdata) > 0)
		$this->orderlib->updateBatchDelivery($orderdata);
		$response['status'] = 1;
		$response['message'] = 'Delivery date Updated Successfully.';
		echo json_encode($response);
	}
	
	public function resendPaymentLink($orderid) {
		$response = array();
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetails($orderid);
		$data = array();
		$data['name'] = $orders[0]['name'];
		$data['bill_amount'] = $orders[0]['grand_total'];
		$data['invoice_url'] = $orders[0]['invoice_url'];
		$data['payment_url'] = base_url().'paynow/'.$orderid;
		$data['email'] = $orders[0]['email'];
		$data['mobile'] = $orders[0]['mobile'];
		$this->orderlib->sendInvoiceEmail($data);
		$this->orderlib->sendInvoiceSMS($data);
		$response['status'] = 1;
		$response['msg'] = 'Payment Link Resend Successfully.';
		echo json_encode($response);
	}
	
	public function deliveryAttemptedSMS($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetails($orderid);
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['delivery_rescheduled'] = 2;
		$orderdata['delivery_notes'] = 'In process - Attempted';
		$this->orderlib->updateOrder($orderdata);
		$data = array();
		$data['mobile'] = $orders[0]['mobile'];
		$this->orderlib->deliveryAttemptedSMS($data);
		$logs = array();
		$logs['orderid'] = $orderid;
		$logs['comment'] = 'Delivery Attempted';
		$logs['created_date'] = date('Y-m-d H:i:s');
		$logs['created_by'] = $orders[0]['vendor_id'];
		$this->orderlib->addOrderLogs($logs);
		echo json_encode(array('msg'=>'SMS sent successfully.'));
	}
	
	public function deliveryCallAnsweredSMS($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetails($orderid);
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['delivery_rescheduled'] = 3;
		$orderdata['delivery_notes'] = 'In process - Answered';
		$this->orderlib->updateOrder($orderdata);
		$data = array();
		$data['mobile'] = $orders[0]['mobile'];
		$this->orderlib->deliveryCallAnsweredSMS($data);
		$logs = array();
		$logs['orderid'] = $orderid;
		$logs['comment'] = 'Delivery Call Answered';
		$logs['created_date'] = date('Y-m-d H:i:s');
		$logs['created_by'] = $orders[0]['vendor_id'];
		$this->orderlib->addOrderLogs($logs);
		echo json_encode(array('msg'=>'SMS sent successfully.'));
	}
	
	public function pickupAttemptedSMS($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetails($orderid);
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['pickup_rescheduled'] = 2;
		$orderdata['pickup_notes'] = 'Pickup Attempted';
		$this->orderlib->updateOrder($orderdata);
		$data = array();
		$data['mobile'] = $orders[0]['mobile'];
		$this->orderlib->pickupAttemptedSMS($data);
		$logs = array();
		$logs['orderid'] = $orderid;
		$logs['comment'] = 'Pickup Attempted';
		$logs['created_date'] = date('Y-m-d H:i:s');
		$logs['created_by'] = $orders[0]['vendor_id'];
		$this->orderlib->addOrderLogs($logs);
		echo json_encode(array('msg'=>'SMS sent successfully.'));
	}
	
	
	public function paymentResponse() {
	    //echo "payment response";
			
        error_log("Resp: POST: ".json_encode($_POST));
        $params = array();
        $params['longurl'] = $_REQUEST['longurl'];
        $params['email'] = $_REQUEST['buyer'];    //emailid
        $params['shorturl'] = $_REQUEST['shorturl'];
        $params['transactionid'] = $_REQUEST['payment_request_id'];
        $params['mac'] = $_REQUEST['mac'];
        $params['phone'] = $_REQUEST['buyer_phone'];
        $params['status'] = $_REQUEST['status'];
        $params['amount'] = $_REQUEST['amount'];
        $params['fees'] = $_REQUEST['fees'];    
        $params['paymentid'] = $_REQUEST['payment_id'];
		$params['payment_date'] = date('Y-m-d H:i:s');
		
		/*$params['longurl'] = $_POST['longurl'];
        $params['email'] = $_POST['buyer'];    //emailid
        $params['shorturl'] = $_POST['shorturl'];
        $params['transactionid'] = $_POST['payment_request_id'];
        $params['mac'] = $_POST['mac'];
        $params['mobile'] = $_POST['buyer_phone'];
        echo $params['status'] = $_POST['status'];
        $params['amount'] = $_POST['amount'];
        $params['fees'] = $_POST['fees'];    
        $params['paymentid'] = $_POST['payment_id'];
        $params['payment_date'] = date('Y-m-d H:i:s');*/
        $this->load->library ( 'zyk/PaymentLib' );
        $this->paymentlib->updatePayment($params);
        error_log($_REQUEST['amount']."\n".$_REQUEST['payment_request_id']."\n".$_REQUEST['status']."\n\n",0);
    }
    
    public function confirmApproval($orderid) {
    	 
    	$this->load->library('zyk/OrderLib');
    	$this->load->library('zyk/MechanicLib');
    	$orders = $this->orderlib->getOrderDetails($orderid);

    	$this->load->model('search/Search_model','search_model');
    	$packageid=$orders[0]['package_id'];
    	$package_name= $this->search_model->getPackagebyId($packageid); 

    	$items = $this->orderlib->getOrderItems($orderid);

    	/*echo "<pre>";
    	print_r($items);
    	exit();*/

    	if(!empty($items && $items['is_package_service'] == 0 )) {
  	 
            $confirm = 1;
            foreach($items as $value) {
                if($value['is_checked'] == 1) {
                   $confirm = 2; 
                }
            }
            if($confirm == 1) {
                echo json_encode(array('msg'=>'Please Approve services'));
                exit;
            }
        }else if($orders[0]['package_id'] != 0) {
            $booking_packges = $this->orderlib->order_packege_services($orderid);
            if(empty($booking_packges)) {  
                echo json_encode(array('msg'=>'Please Confirm package services'));
                exit;
            }
        } else if(empty($items) && $orders[0]['package_id'] == 0) { 
            echo json_encode(array('msg'=>'Please add services/spares'));
            exit;
        } /*else if(!empty($items && $items['is_package_service'] == 0 )) {
  	
  			echo "string";

            $confirm = 1;
            foreach($items as $value) {
                if($value['is_checked'] == 1) {
                   $confirm = 2; 
                }
            }
            if($confirm == 1) {
                echo json_encode(array('msg'=>'Please Approve services'));
                exit;
            }
        }
        */

       
        $orderdata = array();
    	$orderdata['orderid'] = $orderid;
    	$orderdata['status'] = 3; 

    	/*echo "<pre>";
        print_r($orderdata);exit();
*/

    	$this->orderlib->updateOrder($orderdata);
    	$data = array();
    	$items = $this->orderlib->getOrderItems($orderid);

    	//$packageitems = $this->orderlib->getPackageOrderItems($orderid);

    	$data = array();
    	$data['name'] = $orders[0]['name'];
    	$data['mobile'] = $orders[0]['mobile'];
    	$data['email'] = $orders[0]['email'];
    	$data['orderid'] = $orders[0]['orderid'];
    	$data['ordercode'] = $orders[0]['ordercode'];
    	$data['pickup_date'] = $orders[0]['pickup_date'];
    	$data['order_amount'] = $orders[0]['order_amount'];
    	$data['items'] = $items; 
    	//$data['packageitems'] = $packageitems; 
    	$data['package_name']= $package_name[0]['package_name'];
    	$data['package_amount'] = $orders[0]['old_price'];

    	//print_r($data);  

    	$sndSms   = $this->orderlib->confirmApproval_sms($data);
    	$sndEmail = $this->orderlib->confirmApproval_email($data);
    	$this->load->library ( 'zyk/NotificationLib', 'notificationlib' );
    	$this->notificationlib->sendEstimateconfirmedNotification($orders[0]['userid']);
    	// $this->mechaniclib->sendEstimateConfirmedNotification($orders[0]['vendor_id']);
    	 
    	
    	$logs = array();
    	$logs['orderid'] = $orderid;
    	$logs['comment'] = 'Estimate Confirmed.';
    	$logs['created_date'] = date('Y-m-d H:i:s');
    	$logs['order_status'] = 3;
    	$logs['created_by'] = $orders[0]['vendor_id'];
    	$this->orderlib->addOrderLogs($logs);
    	
    	echo json_encode(array('msg'=>'Estimate Confirmed successfully.'));
    }
	
    public function markworkCompleted($orderid) {
    	$this->load->library('zyk/OrderLib');
    	$this->load->library('zyk/UserLib');
    	$this->load->library('zyk/MechanicLib');
    	$orders = $this->orderlib->getOrderDetails($orderid);

    	$data['orderid'] = $orders[0]['orderid'];
    	$data['ordercode'] = $orders[0]['ordercode'];
    	$data['mobile'] = $orders[0]['mobile'];
    	$data['email'] = $orders[0]['email'];
    	$data['name'] = $orders[0]['name'];
    	$data['assign_vendor_id'] = $orders[0]['assign_vendor_id']; 

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
    		$this->load->library('zyk/General');
    		$cp = array();
    		/*$cp['coupon_code'] = $coupon_code;
    		$cp['order_date'] = $order_date;*/
    		$coupon = $this->db->get_where('coupon',array('coupon_code'=>$coupon_code))->result_array();
    		$cpresp['status'] = 1;
    		if(!empty($coupon))
    		{
    			$cpresp['coupon'] = $coupon[0];
    		}
    	} else {
    		if(!empty($orders[0]['redeem_amount']) || $orders[0]['wallet_discount'] == 1) {
    			$wallet = $this->userlib->getWalletBalance($orders[0]['userid']);
    			if (!empty($orders[0]['redeem_amount']) && $wallet[0]['amount'] > 0 ) {  

    				$discount = $orders[0]['redeem_amount'];
    			} 
    			elseif($wallet[0]['amount'] > 0) {
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
			if(!empty($orders[0]['redeem_amount']) || $orders[0]['wallet_discount'] == 1) {
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

    	//print_r($temp_array);

    	$sndSms   = $this->orderlib->markworkCompleted_sms($temp_array);
    	$sndEmail = $this->orderlib->markworkCompleted_email($temp_array);
    	$this->load->library ( 'zyk/NotificationLib', 'notificationlib' );
    	$this->notificationlib->sendWorkcompletedNotification($orders[0]['userid']);
    	// $this->mechaniclib->sendWorkCompletedNotification($orders[0]['vendor_id']);
    	
    	$final_total = $discountable_total - $discount;
    	$orderdata = array();
    	$orderdata['orderid'] = $orderid;
    	$orderdata['status'] = 4;
    	$orderdata['discount'] = $discount;
    	$orderdata['grand_total'] = $final_total;
    	$this->orderlib->updateOrder($orderdata);
    	
    	$logs = array();
    	$logs['orderid'] = $orderid;
    	$logs['comment'] = 'Work Completed.';
    	$logs['created_date'] = date('Y-m-d H:i:s');
    	$logs['order_status'] = 4;
    	//$logs['created_by'] = $this->session->userdata('adminsession')['id'];
    	$logs['created_by'] = $orders[0]['vendor_id'];
    	$this->orderlib->addOrderLogs($logs);
    	echo json_encode(array('msg'=>'Work Completed successfully.'));
    }
    
    public function addAdminComment($orderid) {
    	$this->load->library('zyk/OrderLib');
    	//$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
    	$comment = $this->input->post('admincomment');
    	$orderdata = array();
    	$orderdata['orderid'] = $orderid;
    	$orderdata['comment'] = $comment;
    	$orderdata['created_datetime'] = date('Y-m-d H:i:s');
    	$orderdata['created_by'] = $this->session->userdata('adminsession')['id'];
    	$commentid = $this->orderlib->addAdminComment($orderdata);
    	if($commentid > 0) {
	    	$response['status'] = 1;
	    	$response['msg'] = 'Added successfully.';
    	}else {
    		$response['status'] = 0;
    		$response['msg'] = 'Not Added successfully.';
    	}
    	echo json_encode($response);
    	
    }
    
    public function addtowallet($userid){
    	$this->load->library('zyk/OrderLib', 'orderlib');
    	$this->load->library ( 'zyk/UserLoginLib' );
    	$ordercount = $this->orderlib->checkorder($userid);
    	//print_r($ordercount);
    	if(!empty($ordercount)){
    		if(count($ordercount) > 1){
    			$this->load->library('zyk/CoupanLib');
    			$coupon = $this->coupanlib->getCouponCodeByCode($ordercount[0]['coupon_code']);
    			if(!empty($coupon)){
    				if($coupon[0]['coupon_type'] == 0){
    					if($ordercount[0]['grand_total'] >= $coupon[0]['min_oder_value']){
    						$wallet['userid'] = $userid;
    						$wallet['amount'] = $coupon[0]['max_discount'];
    						$wallet['updated_date'] = date('Y-m-d H:i:s');
    						$wallet['updated_by'] = 0;
    						$this->load->library ( 'zyk/UserLoginLib' );
    						$this->userloginlib->addToWallet($wallet);
    					}
    				}else{
    					if($ordercount[0]['grand_total'] >= $coupon[0]['min_oder_value']){
    						$wallet['userid'] = $userid;
    						$wallet['amount'] = $coupon[0]['max_cashback'];
    						$wallet['updated_date'] = date('Y-m-d H:i:s');
    						$wallet['updated_by'] = 0;
    						$this->load->library ( 'zyk/UserLoginLib' );
    						$this->userloginlib->addToWallet($wallet);
    					}
    				}
    			}
    		}else{
    			
    			$userorder = $this->userloginlib->getProfile($ordercount[0]['userid']);
    			$user = $this->userloginlib->validateReferralCode($userorder[0]['coupon_code']);
    			//echo "add to wallet";
    			//print_r($user);
    			if(!empty($user)){
    				$wallet['userid'] = $user[0]['id'];
    				$wallet['amount'] = 50;
    				$wallet['updated_date'] = date('Y-m-d H:i:s');
    				$wallet['updated_by'] = 0;
    				$this->userloginlib->addToWallet($wallet);
    			}
    		}
    	}
    }
    
    public function updateServices() {
    	$this->load->library('zyk/OrderLib');
    	$this->load->library ( 'zyk/UserLib' );
    	$this->load->library('zyk/ItemLib');
    	$orderid = $this->input->post('orderidhidden');
    	$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
    	$adjustment = $orders[0]['adjustment'];
    	$response = array();
    	$itemcheck = $this->input->post('is_checked');
    	$itemids = $this->input->post('itemidhidden');
    	$itemnames = $this->input->post('itemnameA');
    	$itemprices = $this->input->post('pric');
    	$itemtaxes = $this->input->post('tax1');
    	$itemtypes = $this->input->post('itemtype');
    	$itempriority = $this->input->post('itempriority');
    	$qtys = $this->input->post('qty');
		$wts = $this->input->post('weight');
		$itemqty = $this->input->post('quantity'); 
		//echo "<pre>"; print_r($_POST); exit();

    	
    	$ordertotal = 0;
    	$items = array();
    	for ($i = 0; $i < count($itemids); $i++) {
    		$item = array();
    		$item['orderid'] = $orderid;
    		$item['service_id'] = $itemids[$i];
    		$item['service_name'] = $itemnames[$i];
    		$item['service_price'] = $itemprices[$i];
    		/*$item['quantity'] = 1;*/
    		$item['service'] = $itemtypes[$i];
    		$item['tax'] = $itemtaxes[$i];
    		$item['priority'] = $itempriority[$i];
    		$item['quantity'] = $itemqty[$i];
    		$cal=$itemtaxes[$i] /100 * $itemprices[$i];
    		$item['total_amount']= $itemprices[$i] + $cal;
    		$item['is_checked'] = $itemcheck[$i];
    		//echo $itemcheck[i];
    		if($item['is_checked'] == 1){
    			//echo "itemcheck";
    			$total_amount = $itemprices[$i] + $cal;
    		}else{
    			//echo "itemchecktest";
    			$total_amount = 0;
    		}
    		//$total_amt += $item['total_amount'];
    		$items[] = $item;
   			$ordertotal = $ordertotal + $total_amount ;
   			
    	}
    	$this->orderlib->removeOrderItems($orderid);
            
    	$this->orderlib->addOrderItems($items);
    	$items = $this->orderlib->getOrderItems($orderid);
    	$delivery_charge = 0;
    	$discountable_total = 0;
    	$discount = 0;
    	$newoutstanding = 0;
    	if($orders[0]['outstanding'] != 0) {
    		$outstanding = $orders[0]['outstanding'] + $adjustment;
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
    	$orderdata['order_amount'] = $ordertotal;
    	$orderdata['delivery_charge'] = $delivery_charge;
    	$orderdata['vat_tax'] = 0;
    	$orderdata['service_tax'] = 0;
    	$orderdata['discount'] = $discount;
    	$orderdata['adjustment'] = $adjustment;
    	$orderdata['net_total'] = $ordertotal - $discount + $delivery_charge;
    	$orderdata['grand_total'] = $ordertotal - $discount + $adjustment + $delivery_charge;

    	//Update order price  added
    	$orderdata['order_amount'] = $orderdata['order_amount'] + $orders[0]['old_price'];
    	$orderdata['net_total'] = $orderdata['net_total'] + $orders[0]['old_price'];
    	$orderdata['grand_total'] = $orderdata['grand_total'] + $orders[0]['old_price'];
    	$this->orderlib->updateOrder($orderdata);
    	
    	
    	$logs = array();
    	$logs['orderid'] = $orderid;
    	$logs['comment'] = 'Approval Updated';
    	$logs['created_date'] = date('Y-m-d H:i:s');
    	$logs['order_status'] = 2;
    	$logs['created_by'] = $orders[0]['vendor_id'];
    	$this->orderlib->addOrderLogs($logs);
    	
    	$response['status'] = 1;
    	$response['message'] = 'Order Services updated successfully.';
    	echo json_encode($response);
    	
    }
    
    public function getallorders(){
    	$this->load->library('zyk/OrderLib');
    	$orders = $this->orderlib->allOrders();
    	 
    	$response['newordercount'] = count($orders);
    	$response['message'] = 'Count incremented .';
    	echo json_encode($response);
    	 
    }
     
    public function getReminderuserdata() {
    	$current_date = date('Y-m-d');
    	$this->load->library('zyk/OrderLib');
    	$ordersremind = $this->orderlib->getallReminderOrders();
    	 
    	$this->template->set('page','porders');
    	$this->template->set('ordersremind',$ordersremind);
    	$this->template->set_theme('default_theme');
    	$this->template->set_layout ('backend')
    	->title ( 'Administrator | Order Dashboard' )
    	->set_partial ( 'header', 'partials/header' )
    	->set_partial ( 'leftnav', 'partials/sidebar' )
    	->set_partial ( 'footer', 'partials/footer' );
    	$this->template->build ('orders/ReminderOrders');
    } 
    
    public function getSpareList()
    {
    	$params['type'] = 2;
		$params['category_id'] = $this->input->post ('category_id');
		$params['brand_id'] = $this->input->post ('brand_id');
		$params['model_id'] = $this->input->post ('model_id');
		$params['subcategory_id'] = $this->input->post ('subcategory_id');
    	$this->load->library ( 'api/MechanicLib' );
		$data = $this->mechaniclib->serviceOrSparepartsList ($params);
		echo json_encode($data);
    }


    function notFirstOrder()
	{   //pretag($_SESSION);
		 
		$data = $this->input->post('item');
		//print_r($data);exit ; 
                if($data ['latitude'] == '' || $data['longitude'] == '') {
                    echo json_encode(array('status' => 0, 'msg' => 'Please enter valid address'));
                    exit;
                }
                /*if(empty($_POST['single_services']) || empty($_POST['spare_id'])) {
                    echo json_encode(array('status' => 0, 'msg' => 'Please select service or spare'));
                    exit;
                }*/
		$params = array();
		$notification = array();
		if(empty($data['userid'])) {
			$reg = array ();
			$reg ['name'] = trim($data['name']);
			$reg ['password'] = '123456';
			$reg ['email'] = $data['email'];
			$reg ['mobile'] = $data['mobile']; 
			$reg ['landmark'] = $data['landmark'];
			$reg ['latitude'] = $data['latitude'];
			$reg ['longitude'] =$data['longitude'];  
			$reg ['original'] = '123456';
			$reg ['source'] = 'Backend';
			$this->load->library('zyk/General');
			$this->load->library ( 'zyk/UserLib' );
			$exist = $this->userlib->userExist ( $reg );
			if($exist['status'] == 0) {
				$register = $this->userlib->userRegistration ( $reg );
				
				$params['userid'] = $register['id'];
			} else {
				$params['userid'] = $exist['id'];
			}
		} else {
			$params['userid'] = $data['userid'];
		}
		$params ['locality'] = $data['landmark'];
		$params['latitude'] = $data['latitude'];
		$params['longitude'] =$data['longitude'];
		$params['name'] = $data['name'];
		$params['email'] = $data['email'];
		$params['mobile'] = $data['mobile'];
		$params['category_id'] = 9 ;
		//$params['brand_id'] = $data['brand_id'];
	
		$params['vehicle_id'] = $data['vehical_no']; 

		$vehicles = $this->orderlib->get_vehicles_by_id($params['vehicle_id']);
 
		$service_id = $this->input->post('service_id');
		$package_id = $this->input->post('package_id');
		$subcategory_id = $this->input->post('subcategory_id');
		$serid = '0'; 
		if(count($service_id)>0){
		    $serid = implode(",",$service_id);
		}
		$subid = implode(",",$subcategory_id);
		$params['service_id'] = $serid;
		$params['package_id'] = $package_id;
		$params['subcategory_id'] = $subid;
		$params['catsubcat_id'] = $serid;
		$params['slot'] = $data['slot'];
		$params['comment'] = $data['comment'];
		$params['brand_id'] = $vehicles[0]['brand_id'];
		$params['vehicle_model'] = $vehicles[0]['model_id'];
		$params['status'] = 0;
		$params['service'] = '';
		if(!empty($data['pickup_date']))
			$params['pickup_date'] = date('Y-m-d',strtotime($data['pickup_date']));
		else
			$params['pickup_date'] = date('Y-m-d');
		$del_date = date('Y-m-d',strtotime('+48 hours',strtotime($params['pickup_date'])));
		/*$day = date('D',strtotime($del_date));
		if($day == 'Wed') {
			$del_date = date('Y-m-d',strtotime('+24 hours',strtotime($del_date)));
		}*/
		$params['delivery_date'] = date('Y-m-d',strtotime('+72 hours',strtotime($params['pickup_date'])));
		$params['ordered_on'] = date('Y-m-d H:i:s');
		$params['source'] = 3;
		$this->load->library('zyk/OrderLib'); 

		if($data['latitude']=='' && $data['longitude']==''){
			$new = getLatLong($data['landmark']);
 			$params['latitude'] = $new['lat'];
			$params['longitude'] =$new['lng']; 
		}  
		if($params['latitude']=="" && $params['longitude']==""){
			$response['status'] = 0;
			$response['msg'] = "Failed to add order ...Please enter valid address..!";
			echo json_encode($response);
			exit;
		} 

		$orderid = $this->orderlib->addOrder($params);
		 //$orderid = 1;
 		if($orderid > 0) {
			$params['orderid'] = $orderid; 
			$oupdate = array();
			$oupdate['orderid'] = $orderid;
			$oupdate['ordercode'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($orderid, 10, 36)); 
			$params['ordercode']  = $oupdate['ordercode'];  
			//invoice generate and save data 

			if($params['package_id']!=""){  
 				//new package 1st time changes 
					$this->load->library('zyk/SearchLib'); 
						$packageData = $this->searchlib->getPackageDetailsbyId($params['package_id']);  
		 			$userid = $param['userid'];
		 		 
		  		//get package usages
 					$packageUsages = $this->searchlib->getPackageUsagesByUser($packageData['id'],$userid);  
 					$selectedpackageid = $this->searchlib->getorderbypackage($userid,$packageData['id']);
                     $usercnt=$selectedpackageid[0]['remaining_service_count']-1;
                    if($usercnt<=0){
                    $user_package['is_expire'] = 0;
                    }

 				   
					$user_package['remaining_service_count'] = $packageData['remaining_service_count']-1;
				/*	$user_package['created_date'] = date('Y-m-d');
					$user_package['expiry_date'] = date('Y-m-d', strtotime("+{$packageData['year']} years")); 
					$user_package['year'] = $packageData['year'];
 					$user_package['order_ids'] = $orderid;
					$user_package['package_id'] = $packageData['id']; 
					$user_package['vehicle_id'] = 0;  */
                    $this->db->where('id',$selectedpackageid[0]['id']);
					$this->db->update('tbl_user_package',$user_package);
                    
		  	 			$items = array();
		 	 			foreach ($packageData['services'] as $row) {
		 	 				  
		 	 				foreach ($_SESSION['service_use'] as $row2) {
	                    	    if($row['id']==$row2) {
	                    	         $item = array();
									$item['orderid'] = $orderid;
									$item['service_id'] = $row['id'];
									$item['service_name'] = $row['name'];
									$item['service_price'] = $row['price'];
			 						$item['tax'] = $row['tax'];
			 						$item['total_amount'] = $row['tax'] + $row['price']; 
						            $item['is_checked'] = 0 ;
									$item['service'] = 1 ; 
									$item['priority'] = 1;
									$item['is_package_service'] =$selectedpackageid[0]['id']; 
									$items[] = $item; 
	                                }
	                    	     }
								
							   
		 					}  

		 					//print_r($items);exit();
		  					$this->db->insert_batch('tbl_booking_services',$items);  


		 			//get total amount from the package data 

		 		/*	$oupdate['order_amount'] = $packageData['best_price'];  
		 			$oupdate['net_total'] = $packageData['best_price']; 
		 			$oupdate['grand_total'] = $packageData['special_price'];
		 			$oupdate['discount'] = $packageData['best_price'] - $packageData['special_price'] ;  */
		 			$this->orderlib->updateOrder($oupdate); 

					
 		 		//package close
					
				}else{
					$response = array('msg'=>"Package is already applied.Please buy from myprofile ",'status'=>0); 
						echo json_encode($response);
						exit();	
				}  
			$params['ordercode'] = $oupdate['ordercode'];  
		//set data for the page order,package data,order code  
			$this->orderlib->sendBookingEmail($params);
			$this->orderlib->sendBookingSMS($params); 
			$response['orderid'] = $orderid;
			$response['status'] = 1;
			$response['msg'] = "Order punched in system"; 
			
			$logs = array();
			$logs['orderid'] = $orderid;
			$logs['comment'] = 'Booking Request Sent';
			$logs['created_date'] = date('Y-m-d H:i:s');
			$logs['order_status'] = 0;
			$logs['created_by'] = $orders[0]['vendor_id'];

			$this->orderlib->addOrderLogs($logs);  

			$response['status'] = 1;
			$response['msg'] = "Order punched in system";  
		} else {
			$response['status'] = 0;
			$response['msg'] = "Failed to add order"; 
		}
		echo json_encode($response);

	} 

	   public function updatePackageServices() {
                $this->load->library('zyk/OrderLib');
                $result = array();
                //$all_serviceid = $_POST['all_serviceid'];

                /* if(empty($_POST['service_use'])) {
                    echo json_encode(array('status' => 0, 'message' => 'Please select package service'));
                    exit;
                }
*/

               /* if(isset($_POST['service_use']) && !empty($_POST['service_use'])) {
                    $service_use = $_POST['service_use'];
                    $all_serviceid = $_POST['chk_serviceid'];
                    $result = array_diff($all_serviceid, $service_use);
                }
                if(isset($_POST['remaining_zero'])) {
                    foreach ($_POST['remaining_zero'] as  $value) {
                        $result[] = $value;
                    }
                } */

                $this->load->library('zyk/SearchLib'); 
		        $packageData = $this->searchlib->getPackageDetailsbyId($_POST['package_id']);
               
                if(!empty($packageData['services'])){
                        $items = array();
                        foreach ($packageData['services'] as $row) {
                                if(in_array($row['id'], $_POST['all_serviceid']))  {
                                        $item = array();
                                        $item['orderid'] = $_POST['orderidhidden'];
                                        $item['service_id'] = $row['id'];
                                        $item['service_name'] = $row['name'];
                                        $item['service_price'] = 0;
                                        $item['tax'] = 0;
                                        $item['total_amount'] = 0; 
                                        $item['is_checked'] = 1 ;
                                        $item['service'] = 1 ; 
                                        $item['priority'] = 1;
                                        $item['is_package_service'] = $_POST['user_package_id'];  
                                      $items[] = $item;
                                }  
                        }              
                    $this->db->insert_batch('tbl_booking_services',$items); 
                }
                echo json_encode(array('status'=> 1 ,'message' => 'Package services saved successfully'));
            }	

    public function AddVehicle() { 
    	$this->load->library('zyk/VehicalLib', 'vehicallib');
        $params = array(); 
        
        $item = $this->input->post('item'); 
        
        $params['user_id'] = $item['userid']; 
        $params['vehical_no'] = $item['vehicle_no1'];
        $params['brand_id'] = $item['brand_id1'];
        $params['model_id'] = $item['model_id1'];  
        /*$params['license_number'] = $item['license_number1'];
        $params['insurance_brand'] = $item['insurance_brand1'];
        $params['insurance_number'] = $item['insurance_number1'];*/
        $params['status'] =   $item['status1'];   
        $params['created_datetime'] = date('Y-m-d H:i:s');  

        $response = $this->vehicallib->AddVehical($params); 
        echo json_encode($response);  
    } 
    public function Uservehicle($id)
    {
 		$this->load->library('zyk/OrderLib');
    	$result = $this->orderlib->get_vehicles_by_id($id);	 
    	echo json_encode($result); 
    }

}