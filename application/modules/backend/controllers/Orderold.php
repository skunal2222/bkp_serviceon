<?php 
class Order extends MX_Controller {

	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		error_reporting(0);
	}



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
	
	public function orderDetail($orderid) {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$this->load->library('zyk/UserLib');
		$this->load->library('zyk/General');
		$this->load->library('zyk/SlotLib', 'slotlib');
		$this->load->library('zyk/RestaurantLib');
		$this->load->library('zyk/ItemLib');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$map = array();
		$map['status'] = $this->input->get('status');
		$restaurants = $this->restaurantlib->getRestaurants($map);
		$orders = $this->orderlib->getOrderDetails($orderid);
		$status = $this->servicelib->getActiveMainStatus1();
		$catofsubcat = $this->servicelib->getActiveListcatSubcat();
		$catofsubcatbysubid = $this->servicelib->getCatsubcatid($orders[0]['subcategory_id']);
		
		$data3=array();
		$data3['locality']=$orders[0]['locality'];
		$data3['latitude']=$orders[0]['latitude'];
		$data3['longitude']=$orders[0]['longitude'];
		$data3['service_id']=$orders[0]['service_id'];
		$garage= $this->restaurantlib->getGarage($data3);
		//print_r($garage);
		//exit;
		$items = $this->orderlib->getOrderItems($orderid);
	    $logs = $this->orderlib->getOrderLogs($orderid);
	    $admin_comments = $this->orderlib->getAdminComment($orderid);
		//$executives = $this->general->getActiveFieldExecutives();
		$visitingslots = $this->slotlib->getActiveVisiting1();
		//$pickupslots = $this->general->getActivePickupSlots();
		//$deliveryslots = $this->general->getActiveDeliverySlots();
		$wallet = $this->userlib->getWalletBalance($orders[0]['userid']);
		$reasons = $this->general->getActiveReasons();
		$this->template->set('order',$orders[0]);
		$this->template->set('products',$product);
		$this->template->set('items',$items);
		$this->template->set('status',$status);
		$this->template->set('garage',$garage);
		$this->template->set('restaurants',$restaurants);
		$this->template->set('catofsubcat',$catofsubcat);
		$this->template->set('catofsubcatbysubid',$catofsubcatbysubid);
		$this->template->set('logs',$logs);
		$this->template->set('admin_comments',$admin_comments);
	//	$this->template->set('executives',$executives);
	//	$this->template->set('pickupslots',$pickupslots);
	//	$this->template->set('deliveryslots',$deliveryslots);
		$this->template->set('visitingslots',$visitingslots);
		$this->template->set('wallet',$wallet);
		$this->template->set('reasons',$reasons);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/OrderDetails');
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
		$logs['created_by'] = $this->session->userdata('adminsession')['id'];
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
		$logs['created_by'] = $this->session->userdata('adminsession')['id'];
		$this->orderlib->addOrderLogs($logs);
		$response['status'] = 1;
		$response['message'] = 'Order Re-Assigned For PickUp.';
		echo json_encode($response);
	}
	
	public function assignDelivery($orderid) {
		$this->load->library('zyk/OrderLib');
		$this->load->library('zyk/MechanicLib');
		$garage_id = $this->input->get('vendor_id');
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
		$data['name'] = $orders[0]['name'];
		$data['mobile'] = $orders[0]['mobile'];
		$data['email'] = $orders[0]['email'];
		$data['locality'] = $orders[0]['locality'];
		$data['address'] = $orders[0]['address'];	
		$data['pickup_date'] = $orders[0]['pickup_date'];
		$data['time_slot'] = $orders[0]['slot'];
		$this->orderlib->sendOrderConfirmEmail($data);
		$this->orderlib->sendOrderConfirmSMS($data);
		$this->orderlib->sendAssignedgarageNotification($orders[0]['userid']);
		$this->mechaniclib->sendGarageAssignedNotification($garage_id);
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
		$logs['comment'] = 'Garage Assigned.';
		$logs['created_date'] = date('Y-m-d H:i:s');
		$logs['order_status'] = 1;
		$logs['created_by'] = $this->session->userdata('adminsession')['id'];
		$this->orderlib->addOrderLogs($logs); 
		$response['status'] = 1;
		$response['message'] = 'Order Assigned To Garage.';
		echo json_encode($response);
	}
	
	public function updateassigndelivery($orderid) {
		$this->load->library('zyk/OrderLib');
		$this->load->library('zyk/MechanicLib');
		$garage_id = $this->input->get('vendor_id');
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
		$data['name'] = $orders[0]['name'];
		$data['mobile'] = $orders[0]['mobile'];
		$data['email'] = $orders[0]['email'];
		$data['locality'] = $orders[0]['locality'];
		$data['address'] = $orders[0]['address'];
		$data['pickup_date'] = $orders[0]['pickup_date'];
		$data['time_slot'] = $orders[0]['slot'];
		$this->orderlib->sendOrderConfirmEmail($data);
		$this->orderlib->sendOrderConfirmSMS($data);
		$this->orderlib->sendAssignedgarageNotification($orders[0]['userid']);
		$this->mechaniclib->sendGarageAssignedNotification($garage_id);
		$logs = array();
		$logs['orderid'] = $orderid;
		$logs['comment'] = 'Garage Re-assigned.';
		$logs['created_date'] = date('Y-m-d H:i:s');
		$logs['order_status'] = 12;
		$logs['created_by'] = $this->session->userdata('adminsession')['id'];
		$this->orderlib->addOrderLogs($logs);
		$response['status'] = 1;
		$response['message'] = 'Order Assigned To Garage.';
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
		$flag = $this->orderlib->sendDeliveryEmail($data);
		$this->orderlib->sendDeliverySMS($data);
		$data['address'] = $orders[0]['address'];
		if($orders[0]['payment_status'] == 'Credit') {
			$data['grand_total'] = 0;
		} else {
			$data['grand_total'] = $orders[0]['grand_total'];
		}
		$this->orderlib->sendDeliveryBoySMS($data);
		$logs = array();
		$logs['orderid'] = $orderid;
		$logs['comment'] = 'Re-Assigned For Delivery';
		$logs['created_date'] = date('Y-m-d H:i:s');
		$logs['created_by'] = $this->session->userdata('adminsession')['id'];
		$this->orderlib->addOrderLogs($logs);
		$response['status'] = 1;
		$response['message'] = 'Order Re-Assigned For Delivery.';
		echo json_encode($response);
	}
	
	public function cancelOrder($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$orders[0]['reason'] = $this->input->get('comment');
		$data = array();
		$data['name'] = $orders[0]['name'];
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
			$logs['created_by'] = $this->session->userdata('adminsession')['id'];
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
		$logs['created_by'] = $this->session->userdata('adminsession')['id'];
		$this->orderlib->addOrderLogs($logs);
		$response = array();
		$response['status'] = 1;
		$response['message'] = 'Order deleted.';
		echo json_encode($response);
	}
	
	public function addItems() {
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
			$items[] = $item;
			$ordertotal = $ordertotal + $item['total_amount'];
		}
		//print_r($ordertotal);
		//print_r($items);
	   // exit;
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
	
		$this->orderlib->updateOrder($orderdata);
		
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
		$flag = $this->orderlib->sendGenrateEstimateEmail($data);
		$this->orderlib->sendGenrateEstimateSMS($data);
		$this->orderlib->sendEstimategeneratedNotification($orders[0]['userid']);
		$this->mechaniclib->sendEstimateGenratedNotification($orders[0]['vendor_id']);
		//$this->orderlib->sendPickedUpSMS($data);
		
		$logs = array();
		$logs['orderid'] = $orderid;
		$logs['comment'] = 'Estimate Generated';
		$logs['created_date'] = date('Y-m-d H:i:s');
		$logs['order_status'] = 2;
		$logs['created_by'] = $this->session->userdata('adminsession')['id'];
		$this->orderlib->addOrderLogs($logs);
	
		$response['status'] = 1;
		$response['message'] = 'Order Services added successfully.';
		echo json_encode($response);
	}
	
	public function updateItems() {
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
		$logs['created_by'] = $this->session->userdata('adminsession')['id'];
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
		$amount_received = $this->input->get('net_total');
		$pay_mode = $this->input->get('pay_mode');
		$final_total = $orders[0]['grand_total'];
		$adjustment = $final_total - $amount_received;
		$orderdata['amount_received'] = $amount_received;
		$orderdata['status'] = 7;
		$orderdata['pay_mode'] = $pay_mode;
		$this->orderlib->updateOrder($orderdata);
		if($adjustment != 0) {
			$outbill = array();
			$outbill['id'] = $orders[0]['userid'];
			$outbill['outstanding'] = $adjustment;
			$this->userlib->updateLatLong($outbill);
		}
		
		if($pay_mode == 1) {
			$payment = array();
			$payment['orderid'] = $orderid;
			$payment['email'] = $orders[0]['email'];
			$payment['amount'] = $amount_received;
			$payment['phone'] = $orders[0]['mobile'];
			$payment['shorturl'] = '';
			$payment['status'] = 'Credit';
			$payment['gateway'] = 'instamojo';
			$payment['payment_date'] = date('Y-m-d H:i:s');
			$this->orderlib->addPaymentDetail($payment);
		}
		
		$data = array();
		$data['name'] = $orders[0]['name'];
		$data['mobile'] = $orders[0]['mobile'];
		$data['email'] = $orders[0]['email'];
		$data['ordercode'] = $orders[0]['ordercode'];
		$this->orderlib->sendConfirmDeliverySMS($data);
		$this->orderlib->sendDeliveryCompleteNotification($orders[0]['userid']);
		
		$this->addtowallet($orders[0]['userid']);
		$logs = array();
		$logs['orderid'] = $orderid;
		$logs['comment'] = 'Order Delivery Completed';
		$logs['created_date'] = date('Y-m-d H:i:s');
		$logs['order_status'] = 7;
		$logs['created_by'] = $this->session->userdata('adminsession')['id'];
		$this->orderlib->addOrderLogs($logs);
		$response['status'] = 1;
		$response['msg'] = 'Order Marked completed successfully.';
		echo json_encode($response);
		
		/* if($orderdata['status'] == 6){
			$this->addtowallet($notification['userid']);
		} */
	}
	
	public function generateInvoice($orderid) {
		//echo $orderid;
		$response = array();
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetails($orderid);
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
			$invoice['grand_total'] = $orderdata['grand_total'];
			$invoice['invoice_date'] = date('Y-m-d H:i:s');
			$invoice['status'] = 0;
			$invoice_id = $this->orderlib->generateInvoice($invoice);
			if($invoice_id > 0) {
				$orderdata['invoice_status'] = 1;
			}
			$this->orderlib->updateOrder($orderdata);
			$orders[0]['order_amount'] = $orderdata['order_amount'];
			$orders[0]['grand_total'] = $orderdata['grand_total'];
			$orders[0]['net_total'] = $orderdata['net_total'];
			$orders[0]['delivery_charge'] = $orderdata['delivery_charge'];
			$orders[0]['adjustment'] = $orderdata['adjustment'];
			$orders[0]['discount'] = $orderdata['discount'];
			$orders[0]['invoice_date'] = date('Y-m-d H:i:s');
			$this->template->set('order',$orders[0]);
			$this->template->set('invoice_number',$invoice_id);
			$this->template->set('items',$items);
			$this->template->set_theme('default_theme');
			$this->template->set_layout (false)
						   ->title ( 'Administrator | Generate Invoice' );
			$html = $this->template->build ('orders/InvoiceDetails','',true);
			$file_name = "invoice_".$ordercode.".pdf";
			$this->load->library('MyPdfLib');
			$url = $this->mypdflib->getPdf($html,$file_name);
			$payment_url = base_url().'paynow/'.$orderid;
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
			$this->orderlib->sendGenerateinvoiceNotification($orders[0]['userid']);
			$data['name'] = $orders[0]['name'];
			$data['email'] = $orders[0]['email'];
			$data['mobile'] = $orders[0]['mobile'];
			$data['amount'] = $orders[0]['grand_total'];
			$data['orderid'] = $orderid;
			$this->load->library ( 'zyk/PaymentLib' );
			$resp = $this->paymentlib->getPaymentUrl($data);
			$logs = array();
			$logs['orderid'] = $orderid;
			$logs['comment'] = 'Invoice Generated';
			$logs['created_date'] = date('Y-m-d H:i:s');
			$logs['order_status'] = 6;
			$logs['created_by'] = $this->session->userdata('adminsession')['id'];
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
		$orderdata['pickup_slot'] = $pickupslot;
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
		$data['pickup_date'] = $pickupdate;
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
		$logs['created_by'] = $this->session->userdata('adminsession')['id'];
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
		$categories = $this->servicelib->getActiveCategories();
		$models = $this->servicelib->getActiveModels();
		$visitingslots = $this->slotlib->getActiveVisiting1();
	//	$slots = $this->general->getActivePickupSlots();
		$areas = $this->general->getActiveAreas();
	//	$vendors = $this->itemlib->getActiveVendor();
	//	$this->template->set('slots',$slots);
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
		$params['category_id'] = $data['category_id'];
		$params['brand_id'] = $data['brand_id'];
		$service_id = $this->input->post('service_id');
		$subcategory_id = $this->input->post('subcategory_id');
		$serid = implode(",",$service_id);
		$subid = implode(",",$subcategory_id);
		$params['service_id'] = $serid;
		$params['subcategory_id'] = $subid;
		$params['catsubcat_id'] = $serid;
		$params['slot'] = $data['slot'];
		$params['comment'] = $data['comment'];
		$params['vehicle_model'] = $data['model_id'];
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
		$orderid = $this->orderlib->addOrder($params);
		
		/* $uid = $_SESSION ['olouserid'];
		$notification['user_id']= $params['userid'];
		$notification['message'] ='G2G is happy to receive your order request';
		$notification['status']=1;
		$notification['type']='Booking Notification';
		$this->orderlib->addNotification($notification); */
		
		$logs = array();
		$logs['orderid'] = $orderid;
		$logs['comment'] = 'Booking Request Sent.';
		$logs['created_date'] = date('Y-m-d H:i:s');
		$logs['order_status'] = 0;
		$logs['created_by'] = $this->session->userdata('adminsession')['id'];
		$this->orderlib->addOrderLogs($logs);
		
		//print_r($orderid);
		if($orderid > 0) {
			$params['orderid'] = $orderid;
			
			$oupdate = array();
			$oupdate['orderid'] = $orderid;
			$oupdate['ordercode'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($orderid, 10, 36)) ;
			$this->orderlib->updateOrder($oupdate);
			
			$params['ordercode'] = $oupdate['ordercode'];
			$this->orderlib->sendBookingEmail($params);
			$this->orderlib->sendBookingSMS($params);
			//$this->orderlib->sendEstimategeneratedNotification($params['userid']);
			
			$response['orderid'] = $orderid;
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
		$logs['created_by'] = $this->session->userdata('adminsession')['id'];
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
		$logs['created_by'] = $this->session->userdata('adminsession')['id'];
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
		$logs['created_by'] = $this->session->userdata('adminsession')['id'];
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
    	 
    	$orderdata = array();
    	$orderdata['orderid'] = $orderid;
    	$orderdata['status'] = 3;
    	$this->orderlib->updateOrder($orderdata);
    	$data = array();
    	$items = $this->orderlib->getOrderItems($orderid);
    	$data = array();
    	$data['name'] = $orders[0]['name'];
    	$data['mobile'] = $orders[0]['mobile'];
    	$data['email'] = $orders[0]['email'];
    	$data['orderid'] = $orders[0]['orderid'];
    	$data['ordercode'] = $orders[0]['ordercode'];
    	$data['pickup_date'] = $orders[0]['pickup_date'];
    	$data['order_amount'] = $orders[0]['order_amount'];
    	$data['items'] = $items;
    	 
    	$sndSms   = $this->orderlib->confirmApproval_sms($data);
    	$sndEmail = $this->orderlib->confirmApproval_email($data);
    	$this->orderlib->sendEstimateconfirmedNotification($orders[0]['userid']);
    	$this->mechaniclib->sendEstimateConfirmedNotification($orders[0]['vendor_id']);
    	 
    	
    	$logs = array();
    	$logs['orderid'] = $orderid;
    	$logs['comment'] = 'Estimate Confirmed.';
    	$logs['created_date'] = date('Y-m-d H:i:s');
    	$logs['order_status'] = 3;
    	$logs['created_by'] = $this->session->userdata('adminsession')['id'];
    	$this->orderlib->addOrderLogs($logs);
    	
    	echo json_encode(array('msg'=>'Estimate Confirm successfully.'));
    }
	
    public function markworkCompleted($orderid) {
    	$this->load->library('zyk/OrderLib');
    	$this->load->library('zyk/UserLib');
    	$this->load->library('zyk/MechanicLib');
    	$orders = $this->orderlib->getOrderDetails($orderid);
    	
    	$data['mobile'] = $orders[0]['mobile'];
    	$data['email'] = $orders[0]['email'];
    	$data['name'] = $orders[0]['name'];
    	
    	$discountable_total = $orders[0]['grand_total'];
    	//$final_total = $orders[0]['grand_total'];
    	$coupon_code = $orders[0]['coupon_code'];
    	$order_date = $orders[0]['pickup_date'];
    	$cpresp = array('status'=>0);
    	$discount = 0;
    	if(!empty($coupon_code)) {
    		$this->load->library('zyk/General');
    		$cp = array();
    		$cp['coupon_code'] = $coupon_code;
    		$cp['order_date'] = $order_date;
    		$cpresp = $this->general->applyCoupon($cp);
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
    	
    	$sndSms   = $this->orderlib->markworkCompleted_sms($data);
    	$sndEmail = $this->orderlib->markworkCompleted_email($data);
    	$this->orderlib->sendWorkcompletedNotification($orders[0]['userid']);
    	$this->mechaniclib->sendWorkCompletedNotification($orders[0]['vendor_id']);
    	
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
    	$logs['created_by'] = $this->session->userdata('adminsession')['id'];
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
}