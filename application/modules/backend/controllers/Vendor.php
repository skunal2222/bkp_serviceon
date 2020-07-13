<?php defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(0);
Class Vendor extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$this->load->library('zyk/RestaurantLib');
		
		$this->load->library('zyk/QualityLib', 'qualitylib');
	}
	
	public function index() { 

		$this->load->library('zyk/General');
		$this->load->library('zyk/RestaurantLib');
		$map = array();
		$map['status'] = $this->input->get('status');
		$restaurants = $this->restaurantlib->getRestaurants($map);
		$this->template->set('restaurants',$restaurants);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Vendor' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('vendor/VendorList');
	}
	
	public function Trial() {
		$this->load->library('zyk/General');
		$this->load->library('zyk/RestaurantLib');
		$map = array();
		$map['status'] = $this->input->get('status');
		$restaurants = $this->restaurantlib->getRestaurants($map);
		$this->template->set('restaurants',$restaurants);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Vendor Trial' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('vendor/VendorList_Trial');
	}

	
public function newRestaurant() {
		$id = $this->input->post('cat_id');
		$this->load->library('zyk/General');
		$this->load->library('zyk/AreaLib');
		$map = array();
		$_SESSION['vendor_id'] = 0;
		$map['status'] = $this->input->get('status');
		$vendors = $this->restaurantlib->getRestaurants($map);
		$this->template->set('vendors',$vendors);
		$cities = $this->general->getCities();
		$areas = $this->arealib->getActiveAreas2();
		$zones =  $this->arealib->getActiveZones();
		$categories = $this->servicelib->getActiveCategories();  
		$subcategories = $this->servicelib->getSubCatIdAll();
		// print_r($subcategories);die();
		/*$categoriesByVendorId = $this->servicelib->getCategoriesByVendorId();
		$subcategories = $this->servicelib->getActiveSubCategories();
		$brandByVendorId = $this->servicelib->getBrandByVendorId();
		$modelByVendorId = $this->servicelib->getModelByVendorId();*/

		$services = $this->servicelib->getActiveServices();
		$spares = $this->servicelib->getActiveSpares();
		$grades = $this->qualitylib->getmainActiveGrade();
		$restaurants = $this->restaurantlib->getRestaurants1();
		$this->template->set('restaurants',$restaurants);
		$this->template->set('categories',$categories); 
		$this->template->set('subcategories',$subcategories);
		$this->template->set('grades',$grades);

		/*$this->template->set('categoriesByVendorId',$categoriesByVendorId);
		$this->template->set('brandByVendorId',$brandByVendorId);
		$this->template->set('modelByVendorId',$modelByVendorId);*/
		
		$this->template->set('services',$services);
		$this->template->set('spares',$spares);
		//$cuisines = $this->general->getCuisines();
		$this->template->set('cities',$cities);
		$this->template->set('areas',$areas);
		$this->template->set('zones',$zones);
		//$this->template->set('cuisines',$cuisines);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Vendor' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('vendor/VendorAdd');
	}
	
	
		public function newRestaurant1() {
		$this->load->library('zyk/ServiceLib', 'servicelib');			
		$model_id = $this->input->post('model_id');
		$subcat = $this->servicelib->getSubCatId($model_id);
		$services = $this->servicelib->getActiveServices();
		$this->template->set('subcat',$subcat);
		$this->template->set('services',$services);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		echo $this->template->build ('vendor/checklist','',true);
	}
		
	public function addRestaurant() {
		$response = array();
		$rest = array();
		$id = $this->input->post('id');
		$rest['garage_name'] = $this->input->post('garage_name');
		$rest['name'] = $this->input->post('name');
		$rest['address'] = $this->input->post('address');
		$rest['email'] = $this->input->post('email');
		$rest['password'] = 123456;
		$rest['pincode'] = $this->input->post('pincode');
		$rest['mobile'] = $this->input->post('mobile');
		$rest['landline'] = $this->input->post('landline');
		// $rest['review'] = $this->input->post('review');
		$rest['rating'] = $this->input->post('rating');
		$rest['status'] = $this->input->post('status');
		$rest['description'] = $this->input->post('description');
		$rest['created_date'] = date('Y-m-d');
		$rest['created_date'] = date('Y-m-d H:i:s');
		$rest['category_id'] = $this->input->post('category_id');
		$ser_type = $this->input->post('serviceType');
		$brand_id = $this->input->post('brand_id');
		$model_id = $this->input->post('model_id');
		$st = implode(",",$ser_type);
		$brandid = implode(",",$brand_id);
		$modelid = implode(",",$model_id);
		$rest['service_type'] = $st;
		$rest['brand_id'] = $brandid;
		$rest['model_id'] = $modelid;
		$rest['status'] = 1;
        $config = array ();
        $config ['upload_path'] = 'assets/images/employee/';
        $config ['allowed_types'] = 'gif|jpg|png|PNG|JPEG';
        $config ['max_size'] = 204800;
        $config ['max_width'] = 2048;
        $config ['max_height'] = 2048;

        $this->load->library ( 'upload', $config );
        if ($this->upload->do_upload ( 'image' )) {
                $rest['image'] = 'images/employee/' . $this->upload->data ( 'file_name' );
        }
		$params = array();
		$params['rest'] = $rest;

		/*echo "<pre>";
		print_r($params);
		exit();*/

		$this->load->library('zyk/RestaurantLib');
		
		if(empty($id)){
			$response = $this->restaurantlib->addRestaurant($params);
			// $this->sendVendorEmail($rest);  
		}else{
			$rest['id'] = $id;
			$response = $this->restaurantlib->updateRestaurantDetails($rest);
		}
		// print_r($response); die();
		$response['model_id']=$rest['model_id'];
		$data['session'] = 1;
		//$_SESSION['vendor_id'] = $response['id'];
		echo json_encode($response);
	}

	 public function sendVendorEmail($rest){
        $this->load->library ( 'Pkemail' );
        $this->pkemail->load_system_config ();
        $this->pkemail->headline = 'Service on ';
        $this->pkemail->subject = 'Vendor Added';
        $this->pkemail->mctag = 'newuser-msg';
        $this->pkemail->attachment = 0;
        $this->pkemail->to = $rest ['email'];
        $this->template->set ( 'rest', $rest );
       // $this->template->set ( 'page', 'newuser-message' );
        $this->template->set_layout ( false );
        $text_body = $this->template->build ( 'backend/emails/vendor-email', '', true );
        $this->pkemail->send_email ( $text_body );
    } 
        
	public function updateVen() {
		$response = array();
		$rest = array();
		$rest1 = array();
		
		$rest['landmark'] = $this->input->post('landmark');
		$rest['locality'] = $this->input->post('locality');
		$rest['latitude'] = $this->input->post('latitude');
		$rest['longitude'] = $this->input->post('longitude');
		$rest['radius'] = $this->input->post('radius');
		$rest['id'] = $this->input->post('id');
	    
                $billing = array();
                $billing['billing_cycle'] = $this->input->post('billing_cycle');
                $billing['with_service_tax'] = $this->input->post('with_service_tax');
                $billing['payment_mode'] = $this->input->post('payment_mode');
                
                
                $billing['company_name'] = $this->input->post('company_name');
                $billing['cheque_favour_of'] = $this->input->post('cheque_favour_of');
                $billing['account_name'] = $this->input->post('account_name');
                $billing['account_number'] = $this->input->post('account_number');
                $billing['bank_name'] = $this->input->post('bank_name');
                $billing['branch_name'] = $this->input->post('branch_name');
                $billing['ifsc_code'] = $this->input->post('ifsc_code');
                $billing['gstin'] = $this->input->post('gstin');
               // $billing['wallet_name'] = $this->input->post('wallet_name');
               // $billing['mob_no'] = $this->input->post('mob_no');
                $billing['min_amount'] = $this->input->post('min_amount');

                $billing['hard_copy'] = $this->input->post('hard_copy');
                $billing['commission_service'] = $this->input->post('comm_ser');
                $billing['commission_spare'] = $this->input->post('comm_spare');
                $cycle_date = date('Y-m-d',strtotime($this->input->post('cycle_effective_date')));
                $gateway_charge = $this->input->post('gateway_charge');
                $gateway_date = date('Y-m-d',strtotime($this->input->post('gateway_effective_date')));
                $billing_fields = array();
                $billing_fields[] = array('billing_field'=>'cycle_effective_date','value'=>$billing['billing_cycle'],'from_date'=>$cycle_date);
                $billing_fields[] = array('billing_field'=>'gateway_effective_date','value'=>$gateway_charge,'from_date'=>$gateway_date);
			
		$params = array();
		    $params['rest'] = $rest;
		   
			$params['billing'] = $billing;
			$params['billingfields'] = $billing_fields;
		
		
		$this->load->library('zyk/RestaurantLib');
		$response = $this->restaurantlib->updateVendor($params);
	
		echo json_encode($response);	
	}
	
	public function editRestaurant($id) {
		$this->load->library('zyk/General');
		$this->load->library('zyk/RestaurantLib');
		//$logs = $this->restaurantlib->getLogsByrestid($id);
		$this->load->library('zyk/adminauth');
		$this->load->library('zyk/AreaLib');
		$user = $this->adminauth->getUserList();
		$areas = $this->arealib->getActiveAreas2();
		$zones =  $this->arealib->getActiveZones();
		$categories = $this->servicelib->getActiveCategories();
		// $subcategories = $this->servicelib->getActiveSubCategories1();
		$subcategories = $this->servicelib->getSubCatIdAll();
		$services = $this->servicelib->getActiveServices($id);
		//print_r($id); die();
		$spares = $this->servicelib->getActiveSpares($id);
		$brands = $this->servicelib->getActiveBrands();
		$models = $this->servicelib->getActiveModels();
		$grades = $this->qualitylib->getmainActiveGrade();
		$this->template->set('categories',$categories);
		$this->template->set('subcategories',$subcategories);
		$this->template->set('services',$services);
		$this->template->set('spares',$spares);
		$this->template->set('areas',$areas);
		$this->template->set('zones',$zones);
		$this->template->set('brands',$brands);
		$this->template->set('models',$models);
		$this->template->set('grades',$grades);
		$details = $this->restaurantlib->getRestaurantBasicDetails($id);
		$coords = json_decode($details[0]['fence'],true);
		$bconfig = $this->restaurantlib->getRestaurantBillingConfig($id);               
		$cycle = $this->restaurantlib->getRestaurantBillingField($id,'cycle_effective_date');
		$gateway = $this->restaurantlib->getRestaurantBillingField($id,'gateway_effective_date');               
		//$config = $this->restaurantlib->getRestaurantConfig($id);
		
       // if($props[0]['is_custom_time'] == "1"){
         //	$timings = $this->restaurantlib->getRestaurantCustomTimings($id);
        //}
		/*$score = $config[0]['basic'] + $config[0]['contact'] + $config[0]['property'] + $config[0]['del_slab'] + $config[0]['del_mov'] + $config[0]['del_time'] + $config[0]['billing'] + $config[0]['menu'];
		$progress = ($score/8)*100;  
		
		$this->template->set('cities',$cities);
		$this->template->set('areas',$areas);
		$this->template->set('cuisines',$cuisines);*/
		$this->template->set('basic',$details);
		$this->template->set('coords',$coords);
	/*	$this->template->set('contacts',$contacts);
		$this->template->set('restcuisines',$restcuisines);
		$this->template->set('props',$props);              
		$this->template->set('slabs',$slabs);
		$this->template->set('deltimes',$deltimes);
		$this->template->set('movs',$mov);*/
		$this->template->set('bconfig',$bconfig);
		$this->template->set('cycle',$cycle);
		$this->template->set('gateway',$gateway);
		//$this->template->set('progress',$progress);
		//$this->template->set('logs',$logs);
		$this->template->set('users',$user);
       	/*if($props[0]['is_custom_time'] == "1"){
          	$this->template->set('timings',$timings);
        }*/
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Vendor' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		//$this->template->build ('restaurants/RestaurantEdit');
		$this->template->build ('vendor/VendorEdit');
	}
	
	
		public function editRestaurant_trial($id) {
		$this->load->library('zyk/General');
		$this->load->library('zyk/RestaurantLib');
		//$logs = $this->restaurantlib->getLogsByrestid($id);
		$this->load->library('zyk/adminauth');
		$this->load->library('zyk/AreaLib');
		$user = $this->adminauth->getUserList();
		$areas = $this->arealib->getActiveAreas2();
		$zones =  $this->arealib->getActiveZones();
		$categories = $this->servicelib->getActiveCategories();
		$subcategories = $this->servicelib->getActiveSubCategories();
		$services = $this->servicelib->getActiveServices();
		$brands = $this->servicelib->getActiveBrands();
		$models = $this->servicelib->getActiveModels();
		$grades = $this->qualitylib->getmainActiveGrade();
		$this->template->set('categories',$categories);
		$this->template->set('subcategories',$subcategories);
		$this->template->set('services',$services);
		$this->template->set('areas',$areas);
		$this->template->set('zones',$zones);
		$this->template->set('brands',$brands);
		$this->template->set('models',$models);
		$this->template->set('grades',$grades);
		$details = $this->restaurantlib->getRestaurantBasicDetails($id);
		$coords = json_decode($details[0]['fence'],true);
		$bconfig = $this->restaurantlib->getRestaurantBillingConfig($id);               
		$cycle = $this->restaurantlib->getRestaurantBillingField($id,'cycle_effective_date');
		$gateway = $this->restaurantlib->getRestaurantBillingField($id,'gateway_effective_date');               
		//$config = $this->restaurantlib->getRestaurantConfig($id);
		
       // if($props[0]['is_custom_time'] == "1"){
         //	$timings = $this->restaurantlib->getRestaurantCustomTimings($id);
        //}
		/*$score = $config[0]['basic'] + $config[0]['contact'] + $config[0]['property'] + $config[0]['del_slab'] + $config[0]['del_mov'] + $config[0]['del_time'] + $config[0]['billing'] + $config[0]['menu'];
		$progress = ($score/8)*100;  
		
		$this->template->set('cities',$cities);
		$this->template->set('areas',$areas);
		$this->template->set('cuisines',$cuisines);*/
		$this->template->set('basic',$details);
		$this->template->set('coords',$coords);
	/*	$this->template->set('contacts',$contacts);
		$this->template->set('restcuisines',$restcuisines);
		$this->template->set('props',$props);              
		$this->template->set('slabs',$slabs);
		$this->template->set('deltimes',$deltimes);
		$this->template->set('movs',$mov);*/
		$this->template->set('bconfig',$bconfig);
		$this->template->set('cycle',$cycle);
		$this->template->set('gateway',$gateway);
		//$this->template->set('progress',$progress);
		//$this->template->set('logs',$logs);
		$this->template->set('users',$user);
       	/*if($props[0]['is_custom_time'] == "1"){
          	$this->template->set('timings',$timings);
        }*/
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Vendor' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		//$this->template->build ('restaurants/RestaurantEdit');
		$this->template->build ('vendor/VendorEdit_trial');
	}
	
	public function updateRestaurantBasicInfo() {
		
		$rest = array();
		$rest['id'] = $this->input->post('restid');
		$rest['garage_name'] = $this->input->post('garage_name');
		$rest['name'] = $this->input->post('name');
		$rest['address'] = $this->input->post('address');
		$rest['email'] = $this->input->post('email');
		$rest['mobile'] = $this->input->post('mobile');
		$rest['landline'] = $this->input->post('landline');
		$rest['pincode'] = $this->input->post('pincode');
		$rest['review'] = $this->input->post('review');
		$rest['rating'] = $this->input->post('rating');
		$rest['status'] = $this->input->post('status');
		$rest['description'] = $this->input->post('description');
		$rest['category_id'] = $this->input->post('category_id');
		$ser_type = $this->input->post('serviceType');
		$brand_id = $this->input->post('brand_id');
		$model_id = $this->input->post('model_id');
		$st = implode(",",$ser_type);
		$brandid = implode(",",$brand_id);
		$modelid = implode(",",$model_id);
		$rest['service_type'] = $st;
		$rest['brand_id'] = $brandid;
		$rest['model_id'] = $modelid;
                if(!empty($_FILES['image'])) {
                    $config = array ();
                    $config ['upload_path'] = 'assets/images/employee/';
                    $config ['allowed_types'] = 'gif|jpg|png|PNG|JPEG';
                    $config ['max_size'] = 204800;
                    $config ['max_width'] = 2048;
                    $config ['max_height'] = 2048;

                    $this->load->library ( 'upload', $config );
                    if ($this->upload->do_upload ( 'image' )) {
                            $rest['image'] = 'images/employee/' . $this->upload->data ( 'file_name' );
                    }
             }
		//$rest['comment'] = $this->input->post('comment');
		/* $subcategory_id = $this->input->post('subcategory_id');
		$service_id = $this->input->post('service_id');
		//$rest['zone_id'] = $this->input->post('zone_id');
		//$rest['area_id'] = $this->input->post('area_id');
		$rest['landmark'] = $this->input->post('landmark');
		$rest['locality'] = $this->input->post('locality');
		$rest['latitude'] = $this->input->post('latitude');
		$rest['longitude'] = $this->input->post('longitude');
		$rest['radius'] = $this->input->post('radius');
		//$rest['id'] = $this->input->post('id');
	
			$subcat_id = implode(",",$subcategory_id);
			$ser_id = implode(",",$service_id);
	
			$rest['subcategory_id'] = $subcat_id;
			$rest['service_id'] = $ser_id;
		
		$rest['created_date'] = date('Y-m-d H:i:s'); */
			
		// print_r($rest);die;

		$this->load->library('zyk/RestaurantLib');
		$response = $this->restaurantlib->updateRestaurantDetails($rest);
		echo json_encode($response);
	}	
	
public function updateRestaurantBillingInfo() {
		
		$restid = $this->input->post('restid');
		$billing = array();
		$billing['restid'] = $this->input->post('restid');
		$billing['billing_cycle'] = $this->input->post('billing_cycle');
		$billing['with_service_tax'] = $this->input->post('with_service_tax');
		$billing['payment_mode'] = $this->input->post('payment_mode');
		$billing['cheque_favour_of'] = $this->input->post('cheque_favour_of');
		$billing['account_name'] = $this->input->post('account_name');
		$billing['account_number'] = $this->input->post('account_number');
		$billing['bank_name'] = $this->input->post('bank_name');
		$billing['branch_name'] = $this->input->post('branch_name');
		$billing['gstin'] = strtoupper($this->input->post('gstin'));
		$billing['ifsc_code'] = $this->input->post('ifsc_code');
		$billing['min_amount'] = $this->input->post('min_amount');
		$billing['is_official'] = $this->input->post('is_official');
		$billing['commission_service'] = $this->input->post('comm_ser');
		$billing['commission_spare'] = $this->input->post('comm_spare');
		$billing['mob_no'] = $this->input->post('mob_no');
		$billing['wallet_name'] = $this->input->post('wallet_name');
		
        /*        $billing['is_trial'] = $this->input->post('is_trial');
		if(!empty($this->input->post('trial_start_date')))
			$billing['trial_start_date'] = date('Y-m-d',strtotime($this->input->post('trial_start_date')));
		if(!empty($this->input->post('trial_end_date')))
			$billing['trial_end_date'] = date('Y-m-d',strtotime($this->input->post('trial_end_date')));
		$billing['hard_copy'] = $this->input->post('hard_copy'); */
	//	$billing['delivery_type'] = $this->input->post('delivery_type');
		//$billing['comment'] = $this->input->post('comment');
		$billing['company_name'] = $this->input->post('company_name');
		
		$cycle_date = date('Y-m-d',strtotime($this->input->post('cycle_effective_date')));
		$gateway_charge = $this->input->post('gateway_charge');
		$gateway_date = date('Y-m-d',strtotime($this->input->post('gateway_effective_date')));
		$billing_fields = array('restid'=>$restid,'billing_field'=>'cycle_effective_date','value'=>$billing['billing_cycle'],'from_date'=>$cycle_date);
		$billing_fields2 = array('restid'=>$restid,'billing_field'=>'gateway_effective_date','value'=>$gateway_charge,'from_date'=>$gateway_date);
		$this->load->library('zyk/RestaurantLib');
 
		$response = $this->restaurantlib->updateRestaurantBillingConfig($billing);
		
		$this->restaurantlib->updateRestaurantBillingFields($billing_fields);
		$this->restaurantlib->updateRestaurantBillingFields($billing_fields2);
		/* $rest = array();
		$rest['id'] = $restid;
		$rest['comment'] = $this->input->post('comment');
		$rest['delivery_type'] = $this->input->post('delivery_type');
		$this->restaurantlib->updateRestaurantDetails($rest); */
		echo json_encode($response);
	}
	
	public function verifyRestaurant($restid) {
		$this->load->library('zyk/RestaurantLib');
		$response = $this->restaurantlib->verifyRestaurant($restid);
		echo json_encode($response);
	}
	
	public function makeRestaurantLive($restid) {
		$this->load->library('zyk/RestaurantLib');
		$response = $this->restaurantlib->makeRestaurantLive($restid);
		echo json_encode($response);
	}
        

	public function turnOnResto() {
        $data['comment'] = $this->input->get('comment'); 
        $data['id'] = $this->input->get('id');       
		$this->load->library('zyk/RestaurantLib');
		$response = $this->restaurantlib->turnOnResto($data);
		redirect(base_url().'admin/restaurant/list');
	}
	
	public function turnOffResto() {
		$data['comment'] = $this->input->get('comment');
		$data['id'] = $this->input->get('id');
		$this->load->library('zyk/RestaurantLib');
		$response = $this->restaurantlib->turnOffResto($data);
		redirect(base_url().'admin/restaurant/list');
	}
	
	public function restClients() {
		$this->load->library('zyk/clientauth');
		$clients = $this->clientauth->getClients();
		$this->template->set('clients',$clients);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Vendor' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'restaurants/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('restaurants/ClientList');
	}
	
	public function newClient() {
		$this->load->library('zyk/RestaurantLib');
		$restaurants = $this->restaurantlib->getRestaurants('');
		$this->template->set('restaurants',$restaurants);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Vendor' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'restaurants/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('restaurants/ClientAdd');
	}
	
	public function editClient($id) {
		$this->load->library('zyk/clientauth');
		$this->load->library('zyk/RestaurantLib');
		$restaurants = $this->restaurantlib->getRestaurants('');
		$client = $this->clientauth->getClientById($id);
		$client_rests = $this->clientauth->getClientRestaurants($id);
		$this->template->set('client',$client);
		$this->template->set('client_rests',$client_rests);
		$this->template->set('restaurants',$restaurants);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Vendor' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'restaurants/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('restaurants/ClientEdit');
	}
	
	public function addClient() {
		$response = array();
		$restids = $this->input->post('restid');
		$client = array();
		$client['username'] = $this->input->post('username');
		$client['password'] = $this->input->post('password');
		$client['text_password'] = $this->input->post('password');
		$client['brand_name'] = $this->input->post('brand_name');
		$client['brand_email'] = $this->input->post('brand_email');
		$client['brand_email_password'] = $this->input->post('brand_email_password');
		$client['sms_provider'] = $this->input->post('sms_provider');
		$client['sms_username'] = $this->input->post('sms_username');
		$client['sms_password'] = $this->input->post('sms_password');
		$client['client_status'] = 1;
		$this->load->library('zyk/clientauth');
		$client_id = $this->clientauth->addClient($client);
		if($client_id) {
			$rests = array();
			foreach ($restids as $restaurant) {
				$rest = array();
				$rest['client_id'] = $client_id;
				$rest['restid'] = $restaurant;
				$rests[] = $rest;
			}
			$this->clientauth->addClientRestaurant($rests);
			$response['status'] = 1;
			$response['msg'] = 'Added successfully.';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Failed to add client.';
		}
		echo json_encode($response);
	}
	
	public function updateClient() {
		$client = array();
		$client['id'] = $this->input->post('id');
		$client['username'] = $this->input->post('username');
		$client['password'] = $this->input->post('password');
		$client['text_password'] = $this->input->post('password');
		$client['brand_name'] = $this->input->post('brand_name');
		$client['brand_email'] = $this->input->post('brand_email');
		$client['brand_email_password'] = $this->input->post('brand_email_password');
		$client['sms_provider'] = $this->input->post('sms_provider');
		$client['sms_username'] = $this->input->post('sms_username');
		$client['sms_password'] = $this->input->post('sms_password');
		$this->load->library('zyk/clientauth');
		$this->clientauth->updateClient($client);
		$response['status'] = 1;
		$response['msg'] = 'Updated successfully.';
		echo json_encode($response);
	}
	
	public function turnOnClient($id) {
		$client = array();
		$client['id'] = $id;
		$client['status'] = 1;
		$this->load->library('zyk/clientauth');
		$this->clientauth->updateClient($client);
		redirect(base_url().'admin/restaurant/clients');
	}
	
	public function turnOffClient($id) {
		$client = array();
		$client['id'] = $id;
		$client['status'] = 0;
		$this->load->library('zyk/clientauth');
		$this->clientauth->updateClient($client);
		redirect(base_url().'admin/restaurant/clients');
	}
	
	public function restaurant_detail($id) {
		$this->load->library('zyk/RestaurantLib');
		$restaurant = $this->restaurantlib->getRestaurantBasicDetails($id);
		echo json_encode($restaurant);
	}
	public function getgeofance($restid)
	{
		$this->load->library('zyk/RestaurantLib');
		$response = $this->restaurantlib->getgeofance($restid);
		echo json_encode($response);
	}
	public function promoteRestaurantList()
	{
		$restaurants = array();
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$this->template->set('cities',$cities);
		$this->load->library('zyk/RestaurantLib');
		$restaurants = $this->restaurantlib->getpromotedRestaurant();
		$this->template->set('restaurants',$restaurants);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Vendor' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'restaurants/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('restaurants/Promote_Restaurant');
	}
	public function promote()
	{
		$data = array();
		$id = $this->input->get('id');
		$restaurant = $this->input->get('restid');
		$start_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');
		$priority = $this->input->get('priority');
		$promoted = array();
		$updatepromoted = array();
		foreach ($restaurant as $key=>$restid) {
			$rests = array();
			$rests['restid'] = $restid;
			$rests['start_date'] = date('Y-m-d',strtotime($start_date[$key]));
			$rests['end_date'] = date('Y-m-d',strtotime($end_date[$key]));
			$rests['priority'] = $priority[$key];
			$rests['status'] = $this->input->get('status'.$restid);
			if(!empty($start_date[$key]) && !empty($end_date[$key])) {
				if(!empty($id[$key])) {
					$rests['id'] = $id[$key];
					$updatepromoted[] = $rests;
				} else {
					$promoted[] = $rests;
				}
			}
		}
		$this->load->library('zyk/RestaurantLib');
		if(count($promoted) > 0)
			$restaurant = $this->restaurantlib->addPromtedRestaurants($promoted);
		if(count($updatepromoted) > 0)
			$restaurant = $this->restaurantlib->updatePromtedRestaurants($updatepromoted);
	}
	
	public function turnoffPromotedResto ()
	{
		$data['comment'] = $this->input->get('comment');
		$data['restid'] = $this->input->get('id');
		$this->load->library('zyk/RestaurantLib');
		$restaurant = $this->restaurantlib->turnoffpromotedresto($data);
	}
	public function turnonPromotedResto ()
	{
		$data['comment'] = $this->input->get('comment');
		$data['restid'] = $this->input->get('id');
		$this->load->library('zyk/RestaurantLib');
		$restaurant = $this->restaurantlib->turnonPromotedResto($data);
	}
	public function searchPromotedRestro()
	{
		$this->input->get('zone_id');
		$restaurants = array();
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$this->template->set('cities',$cities);
		$this->load->library('zyk/RestaurantLib');
		$restaurants = $this->restaurantlib->searchPromotedRestro($this->input->get('zone_id'));
		$this->template->set('restaurants',$restaurants);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Vendor' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'restaurants/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('restaurants/Promote_Restaurant');
	}
	public function updateAllPromotedRestaurants() {
		$this->load->library('zyk/RestaurantLib');
		$this->restaurantlib->schedulePromotedRestaurants();
	}
	public function promoteUpdate()
	{
		$data = array();
		$check = $this->input->get('promote');
		$data['restid'] = $check[0];
		$data['comment'] = $this->input->get('comment');
		$data['start_date'] = date('Y-m-d',strtotime($this->input->get('start_date'.$check[0])));
		$data['end_date'] = date('Y-m-d',strtotime($this->input->get('end_date'.$check[0])));
		$data['priority'] = $this->input->get('priority'.$check[0]);
		$data['status'] = $this->input->get('status'.$check[0]);
		$this->load->library('zyk/RestaurantLib');
		unset($data['comment']);
		$restaurant = $this->restaurantlib->promoteUpdate($data);
	}
	
	public function manufactureList() {
		$this->load->library('zyk/General');
		$this->load->library('zyk/RestaurantLib');
		$details = $this->restaurantlib->getManufactureDetails();
		$this->template->set('details',$details);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Manufacture' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('vendor/ManufactureList');
	}
	
	public function manufactureNew() {
		$this->load->library('zyk/General');
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Manufacture' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('vendor/ManufactureAdd');
	}
	
	public function addManufacture() {
		$response = array();
		$rest = array();
	
		$rest['name'] = $this->input->post('mname');
		$rest['sort_order'] = $this->input->post('sort_order');
	
		/*$rest['created_date'] = date('Y-m-d H:i:s');
			$rest['live_date'] = "0000-00-00 00:00:00";
		$rest['verification_date'] = date('Y-m-d H:i:s');*/
	
		if (!empty($_FILES['image']['name'])) {
			$profilelocation = 'assets/images/manufacture/';
			$logo_image = uploadImage($_FILES['image'],$profilelocation,array('jpeg','jpg','png','gif'),2097152,'logo');
			if($logo_image['status'] == 1) {
				$rest['image'] =  $logo_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$logo_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$errorMsg["errors"] = $errors;
				$logo_image['errormsg'] = $errorMsg;
				echo json_encode($logo_image);
				exit;
			}
		}
		 
		$this->load->library('zyk/RestaurantLib');
		$response = $this->restaurantlib->addManufacture($rest);
	
		echo json_encode($response);
	
	}
	
	public function manufactureEdit($id) {
		$this->load->library('zyk/RestaurantLib');
		$details = $this->restaurantlib->getManufactureDetailsById($id);
		$this->template->set('details',$details);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Manufacture' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('vendor/ManufactureEdit');
	}
	
	public function updateManufacture() {
		$rest = array();
		$rest['manufacturer_id'] = $this->input->post('mid');
	
		$rest['name'] = $this->input->post('mname');
		$rest['sort_order'] = $this->input->post('sort_order');
	
		if (!empty($_FILES['image']['name'])) {
			$profilelocation = 'assets/images/manufacture/';
			$logo_image = uploadImage($_FILES['image'],$profilelocation,array('jpeg','jpg','png','gif'),2097152,'logo');
			if($logo_image['status'] == 1) {
				$rest['image'] =  $logo_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$logo_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$errorMsg["errors"] = $errors;
				$logo_image['errormsg'] = $errorMsg;
				echo json_encode($logo_image);
				exit;
			}
		}
	
		$this->load->library('zyk/RestaurantLib');
		$response = $this->restaurantlib->updateManufactureDetails($rest);
		echo json_encode($response);
	}
	
	public function updateVendorDeliveryInfo() {
		//echo "Hiii";
		$this->load->library('zyk/RestaurantLib');
		$vendor_id= $this->input->post('vendor_id');
		$latlongstr = $this->input->post('geofencestr');
		//print_r($latlongstr);
		
		$latlongarr = explode("#",$latlongstr);
		$geofence = array();
		$i = 1;
		foreach ($latlongarr as $latlong) {
			$fence = array();
			$latlangpair = explode(",",$latlong);
			$fence['id'] = $vendor_id;
			$fence['fence_pos'] = $i;
			$fence['latitude'] = $latlangpair[0];
			$fence['longitude'] = $latlangpair[1];
			$geofence[] = $fence;
			$i++;
		}
	
		$config = array();
		$basic = array();
		$basic['id'] = $vendor_id;
		//$basic['comment'] = $this->input->post('comment');
		$basic['have_gf'] = $this->input->post('have_gf');
		$basic['fence'] = json_encode($geofence);
		$basic['locality'] = $this->input->post('locality');
		$basic['latitude'] = $this->input->post('latitude');
		$basic['longitude'] = $this->input->post('longitude');
		$basic['radius'] = $this->input->post('radius');
		$response = $this->restaurantlib->updateVendorDetails($basic);
		echo json_encode($response);
	}
	
	public function updateVendorArea() {
		 $rest['landmark'] = $this->input->post('landmark');
		 $rest['locality'] = $this->input->post('locality');
		 $rest['latitude'] = $this->input->post('latitude');
		 $rest['longitude'] = $this->input->post('longitude');
		 $rest['radius'] = $this->input->post('radius');
		 $rest['id'] = $this->input->post('rid');
		
		/*  $subcat_id = implode(",",$subcategory_id);
		 $ser_id = implode(",",$service_id);
		
		 $rest['subcategory_id'] = $subcat_id;
		 $rest['service_id'] = $ser_id; */
		
		
		 //$rest['created_date'] = date('Y-m-d H:i:s');
		
		$this->load->library('zyk/RestaurantLib');
		//$rest['comment'] = $this->input->post('comment'); 

		$response = $this->restaurantlib->updateRestaurantDetails($rest); 
		echo json_encode($response);
		
	}
	
	
}
