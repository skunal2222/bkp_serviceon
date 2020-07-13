<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
Class Home extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$this->load->library('zyk/SlotLib', 'slotlib');
	}
	
	public function index() {
		//$this->template->set ( 'page', 'home' );
		//$this->template->set_theme('default_theme');
		$this->load->library('zyk/EmployeeLib', 'employeelib');
		$users = $this->employeelib->getCustomerList();
		$this->template->set('users',$users);
		$this->template->set_layout (false);
		/*$this->template->set_layout ('default')
		->title ( 'G2G' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );*/
		$this->template->build ('home');
	}
	
	public function Register() {
		$this->template->set ( 'description', 'Just enter few details to register yourself on Garage2Ghar and book car and bike services at the most affordable price anywhere anytime. Register Now' );
		//$this->template->set ( 'page', 'home' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
			->title ( 'Register and get great offers on bike and car servicing on Garage2Ghar' )
			->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('register');
	}
	
	//new services page 27 April 2018 
	
	public function services() {
	    $this->template->set ( 'description', 'Just enter few details to register yourself on Garage2Ghar and book car and bike services at the most affordable price anywhere anytime. Register Now' );
	    //$this->template->set ( 'page', 'home' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'Register and get great offers on bike and car servicing on Garage2Ghar' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('services');
	}
	
	public function servicesApp() {
	    $this->template->set ( 'description', 'Just enter few details to register yourself on Garage2Ghar and book car and bike services at the most affordable price anywhere anytime. Register Now' );
	    //$this->template->set ( 'page', 'home' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'Register and get great offers on bike and car servicing on Garage2Ghar' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('services-app');
	}
	//new services page 27 April 2018 
	
	public function Login() {
		$this->template->set ( 'description', 'You are just one click away from booking the best car and bike services at the best price. Login to your account today.' );
		//$this->template->set ( 'page', 'home' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		 ->title ( 'Login to your Garage2Ghar account to book car and bike servicing online' )
		 ->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('login');
	}
	
	public function Booking() {
		$userid = $_SESSION['olouserid'];
		$this->load->library ( 'zyk/UserLib' );
			if(!empty($userid)){
				$balance = $this->userlib->getWalletBalance($userid);
				if(!empty($balance)){
					$balance = $balance;
				}else{
					$balance[0]['amount'] = 0;
				}
				$this->template->set('balance',$balance);
			}
			
		$categories = $this->servicelib->getActiveCategoriesbook();
		$subcategories = $this->servicelib->getActiveSubCategories1();
		$services = $this->servicelib->getActiveServices();
		$spares = $this->servicelib->getActiveSpares();
		$brands = $this->servicelib->getActiveBrands();
		//print_r($brands);
		$models = $this->servicelib->getActiveModels();
		$visitingslots = $this->slotlib->getActiveVisiting1();
		$this->template->set('models',$models);
		$this->template->set('brands',$brands);
		$this->template->set('categories',$categories);
		$this->template->set('subcategories',$subcategories);
		$this->template->set('services',$services);
		$this->template->set('spares',$spares);
		$this->template->set('visitingslots',$visitingslots);
		//$this->template->set ( 'page', 'home' );
		$this->template->set ( 'description', '' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Book your bike and service online on Garage2Ghar' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking');
	}
	
	public function getDeliveryDates() {
		//echo $_GET['date'];
		$date = date('Y-m-d', strtotime($_GET['date']));
		$current_date = date('Y-m-d');
		$current_time = date('H:i');
		$current_time_ext = date('H:i',strtotime('+45 minutes'));
		$slots = $this->slotlib->getActiveVisiting1();
		$durArray = array();
		$day = date('D',strtotime($date));
		if($date == date('Y-m-d')) {
			foreach ($slots as $slot) {
				$slot_arr = explode('-',$slot['time_slot']);
				$from_time = date('H:i',strtotime($slot_arr[0]));
				$to_time = date('H:i',strtotime($slot_arr[1]));
				if($current_time < $from_time) {
					$durArray[] = $slot['time_slot'];
				}
			}
		} else {
			foreach ($slots as $slot) {
				$durArray[] = $slot['time_slot'];
			}
		}
		//print_r($durArray);
		$html = "";
		$i =0;
		foreach ($durArray as $pickupslot) {
			$a=explode(" ",$pickupslot);
			$i++;
			if($i==1){
				//$html .= '<option value="'.$pickupslot.'">'.$pickupslot.'</option>';
				$html .= '<option value="'.$pickupslot.'">'.$pickupslot.'</option>';
			} else {
				$html .= '<option value="'.$pickupslot.'">'.$pickupslot.'</option>';
					
			}
		}
		if($html == "") {
			$html = '<option value="">No Slots Available</option>';
		}
		echo $html;
	}
	
	public function brandbycatid1() {
		$id = $this->input->post('cat_id');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$brands = $this->servicelib->getBrandId($id);
		$this->template->set('brands',$brands);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		echo $this->template->build ('pages/brand','',true);
	}
	
	public function modelbybrandid1() {
		$id = $this->input->post('brand_id');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$models = $this->servicelib->getModelbyBrandId($id);
		$this->template->set('models',$models);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		echo $this->template->build ('pages/model','',true);
	}
	
	public function subcategorybycatid1() {
		$id = $this->input->post('model_id');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$subcat = $this->servicelib->getSubCatId($id);
		$this->template->set('subcat',$subcat);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		echo $this->template->build ('pages/subcategory','',true);
	}
	
	public function catsubcatbyid1() {
		$id = $this->input->post('subcat_id');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$subcat = $this->servicelib->getCatsubcatid($id);
		$this->template->set('subcat',$subcat);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		echo $this->template->build ('pages/catsubcat','',true);
	}
	
	public function servicebysubcatid() {
		$id = $this->input->post('subcat_id');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$service = $this->servicelib->getSersubCatId($id);
		$this->template->set('service',$service);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		echo $this->template->build ('pages/service','',true);
	}
	
	public function servicebycatid2() {
		$id = $this->input->post('subcat_id');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$service = $this->servicelib->getSerCatId1($id);
		$this->template->set('service',$service);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		echo $this->template->build ('pages/service','',true);
	}
	
	public function addOrder() {
		$params = array();
		$notification = array();
		
		$this->load->library ( 'zyk/UserLib' );
		$address = array();
		/* $abcd= $this->input->post('subcategory_id11');
		if($abcd==1){
			$address['userid'] = $this->input->post('loginid');
			if($this->input->post('landmark2')==''){
				$address['landmark'] = $this->input->post('landmark123');
			}else{
				$address['landmark'] = $this->input->post('landmark2'); 
			}
			$address['address'] = $this->input->post('flat123');
			$address['locality'] = $this->input->post('landmark1');
			$address['latitude'] = $this->input->post('latitude');
			$address['longitude'] = $this->input->post('longitude');
		}else{
			$address['userid'] = $this->input->post('loginid');
			$address['landmark'] = $this->input->post('landmark');
			$address['address'] = $this->input->post('flat');
			$address['locality'] = $this->input->post('landmark1');
			$address['latitude'] = $this->input->post('latitude');
			$address['longitude'] = $this->input->post('longitude');
		}
		 $this->userlib->addAddress($address); */
		
		$reg = array ();
		$reg ['name'] = trim($this->input->post('name'));
		$reg ['email'] = $this->input->post('email');
		$reg ['mobile'] =$this->input->post('mobile2');
		if($this->input->post('mobile3')==''){
			$reg['mobile1'] = 0;
		}else{
			$reg['mobile1'] = $this->input->post('mobile3');
		}
		$reg['address'] = $this->input->post('flat');
		$reg['landmark'] = $this->input->post('landmark');
		$reg ['source'] = 'Frontend';
		
		$register = $this->userlib->updateUser( $reg );
		$params['userid'] =$this->input->post('loginid');
		$params['name'] = $this->input->post('name');
		$params['email'] = $this->input->post('email');
		$params['mobile'] = $this->input->post('mobile');
		$abc= $this->input->post('subcategory_id11');
		if($abc==1)
		{
			if($this->input->post('landmark2')=='')
			{
				$params['landmark'] = $this->input->post('landmark123');
			}else{
				$params['landmark'] = $this->input->post('landmark2');
			}
			//$params['landmark'] = $this->input->post('landmark123');
			$params['address'] = $this->input->post('flat123');
			$params['slot'] = $this->input->post('visit_time123');
			if(!empty($this->input->post('visit_date123')))
			   $params['pickup_date'] = date('Y-m-d',strtotime($this->input->post('visit_date123')));
			else
			   $params['pickup_date'] = date('Y-m-d');
			   $params['delivery_date'] = date('Y-m-d',strtotime('+72 hours',strtotime($params['pickup_date'])));
		}
		else 
	    {
			$params['landmark'] = $this->input->post('landmark');
			$params['address'] = $this->input->post('flat');
			$params['slot'] = $this->input->post('visit_time');
			if(!empty($this->input->post('visit_date')))
				$params['pickup_date'] = date('Y-m-d',strtotime($this->input->post('visit_date')));
			else
			$params['pickup_date'] = date('Y-m-d');
			$params['delivery_date'] = date('Y-m-d',strtotime('+72 hours',strtotime($params['pickup_date'])));
		}
		$params['locality'] = $this->input->post('landmark1');
		$params['latitude'] = $this->input->post('latitude');
		$params['longitude'] = $this->input->post('longitude');
		$params['vendor_id'] = $this->input->post('vendor_id');
		$params['other_vendorid'] = $this->input->post('vendor_id1');
		$params['vendor_response'] =1;
		if($_SESSION['category_id']=='')
		{
		    $params['category_id'] = $this->input->post('category_id');
		}else{
			$params['category_id'] = $_SESSION['category_id'];
		}
		if($_SESSION['brand_id']=='')
		{
			$params['brand_id'] = $this->input->post('brand_id');
		}else{
			$params['brand_id'] = $_SESSION['brand_id'];
		}
		if($_SESSION['subcategory_id1']=='')
		{
			$params['subcategory_id'] = $this->input->post('subcategory_id');
		}else{
			$params['subcategory_id'] = $_SESSION['subcategory_id1'];
		}
		if($_SESSION['model_id']=='')
		{
			$params['vehicle_model'] = $this->input->post('model_id');
		}else{
			$params['vehicle_model'] = $_SESSION['model_id'];
		}
		
		//if(!empty($this->input->post('catsubcat_id'))) {
			if($_SESSION['catsubcat_id']=='')
			{
				if(!empty($this->input->post('catsubcat_id'))) {
					$catofsubcat = implode(",",$this->input->post('catsubcat_id'));
					$params['catsubcat_id'] = $catofsubcat;
				 }
			}else{
				foreach($_SESSION['catsubcat_id'] as $catofsub){
					$user_id = $catofsub;
					$uid[] = $user_id;
				}
				$cat_subcatid = implode(",", $uid);
				$params['catsubcat_id'] = $cat_subcatid;
			}
		//}
		
		$option= $this->input->post('discount_type');
		$couponcode = $this->input->post('coupon_code');
			if($option == 'promocode') {
				if(!empty($couponcode))
					$params['coupon_code'] = $couponcode;
			} else {
				if($option == "credits")
					$params['wallet_discount'] = 1;
			}
		//$params['coupon_code'] =$this->input->post('coupon_code');
		$params['comment'] =$this->input->post('comment');
		$params['status'] = 0;
		
		$params['ordered_on'] = date('Y-m-d H:i:s');
		$params['source'] = 2;
		//print_r($params);
		//exit();
		
		$this->load->library('zyk/OrderLib');
		$orderid = $this->orderlib->addOrder($params);
	
		/* $uid = $_SESSION ['olouserid'];
		$notification['user_id']=$uid;
		$notification['orderid'] = $orderid;
		$notification['message'] ='G2G is happy to receive your order request';
		$notification['status']=1;
		$notification['type']='Booking Notification';
		$this->orderlib->addNotification($notification); */
		//print_r($params);
	    //exit;
		if($orderid > 0) {
			$params['orderid'] = $orderid;
				
			$oupdate = array();
			$oupdate['orderid'] = $orderid;
			$oupdate['ordercode'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($orderid, 10, 36)) ;
			$this->orderlib->updateOrder($oupdate);
			
			$params['ordercode'] = $oupdate['ordercode'];
			$this->orderlib->sendBookingEmail($params);
			$this->orderlib->sendBookingSMS($params);
			
			$response['orderid'] = $orderid;
			$response['status'] = 1;
			$response['msg'] = "Order punched in system";
			$this->session->set_userdata ( 'olouserid', $params['userid'] );
			$this->session->set_userdata ( 'olousername', $reg ['name'] );
			$this->session->set_userdata ( 'olouseremail', $reg ['email'] );
			$this->session->set_userdata ( 'olousermobile', $reg ['mobile'] );
			$_SESSION['orderid']=$orderid ;
			
			$logs = array();
			$logs['orderid'] = $orderid;
			$logs['comment'] = 'Booking Request Sent';
			$logs['created_date'] = date('Y-m-d H:i:s');
			$logs['order_status'] = 0;
			$logs['created_by'] = 0;
			$this->orderlib->addOrderLogs($logs);
			
			$this->session->set_flashdata('msg', 'Order punched in system');
			redirect(base_url().'thankyou');
		} else {
			$response['status'] = 0;
			$response['msg'] = "Failed to add order";
			$this->session->set_flashdata('msg', 'Not Punched');
			redirect(base_url().'booking');
		}
		//echo json_encode($response);
	}
	
	public function About() {
		
		$this->template->set ( 'description', 'Our aim at Garage2Ghar is to provide the best bike and car servicing at unbeatable rates in industry. Our service experts ensure that you keep riding throughout the year without any hassles. Know More.' );
		//$this->template->set ( 'keywords', '' );
		//$this->template->set ( 'page', 'home' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'About Garage2Ghar - Doorstep bike and car servicing' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('aboutus');
	}
	
	public function Offer() {
		$this->template->set ( 'description', 'Get your bike and car serviced at the best rate. Avail great offers on your next bike and car servicing by Garage2Ghar. Avail offers today' );
		//$this->template->set ( 'keywords', '' );
		//$this->template->set ( 'page', 'home' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Latest bike and car servicing offers by Garage2Ghar' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('offer');
	}
	
	public function Policy() {
		$this->template->set ( 'description', 'Not satisfied with our services? Garage2Ghar offer 100% money back guarantee on your bike and car servicing - No questions asked policy.' );
		//$this->template->set ( 'page', 'home' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Refund Policy - 100percent moneyback guarantee on Garage2Ghar' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('refund-policy');
	}
	
	public function Thankyou() {
	
		unset($_SESSION['category_id']);
		unset($_SESSION['brand_id']);
		unset($_SESSION['model_id']);
		unset($_SESSION['subcategory_id']);
		unset($_SESSION['subcategory_id1']);
		unset($_SESSION['catsubcat_id']);
		//$this->template->set ( 'page', 'home' );
		$this->template->set ( 'description', '' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Thank You Garage2Ghar' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('thankyou');
	}
	
	public function applyCoupon() {
		$this->load->library('zyk/General');
		$date = $this->input->post('order_date');
		$data = array();
		$data['email'] = $this->input->post('email');
		$data['coupon_code'] = $this->input->post('coupon_code');
		$data['order_date'] = date('Y-m-d',strtotime($date));
		$data['category_id'] = $this->input->post('category_id');
		$data['brand_id'] = $this->input->post('brand_id');
		//print_r($data);
		//exit;
		$coupon = $this->general->applyCoupon($data);
		echo json_encode($coupon);
	}
	
	public function contact() {
		$this->load->library ( 'zyk/UserLib' );
		$data = array();
		$data['name'] = $this->input->post('name');
		$data['email'] = $this->input->post('email');
		$data['subject'] = $this->input->post('subject');
		//$data['message'] =  $this->input->post('message');
		//print_r($data);
		//exit;
		$response = $this->userlib->contact($data);
		if(!empty($response)) 
		{
			$response['status'] = 1;
		}
		else
		{
			$response['status'] = 0;
			$response['msg'] = "Information is not added";
		}
		echo json_encode($response);
	}
	
	public function payonlinenow($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetails($orderid);
		$orderid1 = $orders[0]['orderid'];
		$items = $this->orderlib->getOrderItems($orderid1);
		$this->template->set ( 'order', $orders[0] );
		$this->template->set ( 'items', $items );
		
		$this->template->set ( 'description', '' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('paymentdefault')
		->title ( 'Garage2Ghar | Pay Now' )
		->set_partial ( 'header', 'partials/header_payment' )
		->set_partial ( 'footer', 'partials/footer_payment' );
		$this->template->build ('payonlinenow');
	}
	
	public function createinstamojotransaction() {
		$orderid = $this->input->post('orderid');
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetails($orderid);
		$data = array();
		$data['name'] = $orders[0]['name'];
		$data['email'] = $orders[0]['email'];
		$data['mobile'] = $orders[0]['mobile'];
		$data['amount'] = $orders[0]['grand_total'];
		$data['orderid'] = $orderid;
		$this->load->library ( 'zyk/PaymentLib' );
		$resp = $this->paymentlib->createInstaTransaction($data);
		echo json_encode($resp);
	}
	
	public function addcontact(){
		//$params['userid'] = $this->input->post('userid');
		if (empty($_SESSION ['olouserid'])) {
			$params['userid'] = 0;
		}else{
			$params['userid'] = $_SESSION ['olouserid'];
		}
		
		$params['name'] = $this->input->post('name');
		$params['email'] = $this->input->post('email');
		$params['mobile'] = $this->input->post('mobile');
		$params['subject'] = $this->input->post('subject');
		$params['description'] = $this->input->post('description');
		$params['created_date'] = date('Y-m-d H:i:s');
		$params['updated_date'] = date('Y-m-d H:i:s');
	
		$this->load->library('zyk/General');
		$id = $this->general->addTicket($params);
	
		if(!empty($id)){
			$ticket_no = 'TT'.$id;
			$tp = array();
			$tp['ticketid'] = $id;
			$tp['ticket_no'] = $ticket_no;
			$this->general->updateTicket($tp);
			$this->general->sendContactUSEmail($params);
				
			$response['status'] = 1;
			$response['msg'] = 'Thanks for getting in touch!';
		}else
		{
			$response['status'] = 0;
			$response['msg'] = 'Form Not submitted';
		}
		echo json_encode($response);
	}
	
}