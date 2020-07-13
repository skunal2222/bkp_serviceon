<?php defined('BASEPATH') OR exit('No direct script access allowed');
Class Order extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$this->load->library('zyk/SlotLib', 'slotlib');
		error_reporting(0);
	}
	
   public function TrackOrderOld() { 
   	$id=$_SESSION['olouserid'];
   	$this->load->library ( 'zyk/UserLib' );
   	if(!empty($id)){
		   	$order = $this->userlib->getlastOrder($id);
		   	$logs= $this->userlib->getlastOrderComment($order[0]['orderid']);
		   	$bill = $this->userlib->getBill($id);  
		   	$this->template->set('order',$order);
		   	$this->template->set('logs',$logs);
		   	$this->template->set('bill',$bill);
		   	    $this->template->set ( 'description', '' );
 		   	    $this->template->set_theme('default_theme');
				$this->template->set_layout ('default')
					->title ( 'Garage2Ghar' )
				->set_partial ( 'header', 'partials/header' )
				->set_partial ( 'footer', 'partials/footer' );
				$this->template->build ('Order/trackorderold');
		}else{
			redirect(base_url ());
		}
	}
	
	public function TrackOrder() { 

		$id=$_SESSION['olouserid'];
		$this->load->library ( 'zyk/UserLib' );
		if(!empty($id)){
			$orders = $this->userlib->getOngoingOrders($id);
			//$order = $this->userlib->getlastOrder($id);
			//$logs= $this->userlib->getlastOrderComment($order[0]['orderid']);
			//$bill = $this->userlib->getBill($id);
			$this->template->set('orders',$orders);
			//$this->template->set('logs',$logs);
			//$this->template->set('bill',$bill);
			$this->template->set ( 'description', '' );
			//$this->template->set ( 'page', 'home' );
			$this->template->set_theme('default_theme');
			$this->template->set_layout ('default')
			->title ( 'bikeDoctor' )
			->set_partial ( 'header', 'partials/header' )
			->set_partial ( 'footer', 'partials/footer' );
			$this->template->build ('order/ongoing-orders');
		}else{
			redirect(base_url ());
		}
	}

	public function Notification() {
		//$this->template->set ( 'page', 'home' );
		//$this->template->set_theme('default_theme');
		$uid = $_SESSION ['olouserid'];
		if(!empty($uid)){
			$this->load->library ( 'zyk/UserLib' );
			$detail = $this->userlib->getNotification($uid);
			$this->template->set('detail',$detail);
			$this->template->set ( 'description', '' );
			$this->template->set_layout (false);
			$this->template->set_layout ('default')
			->title ( 'Garage2Ghar' )
			->set_partial ( 'header', 'partials/header' )
			->set_partial ( 'footer', 'partials/footer' );
			$this->template->build ('Order/notification');
		}else{
			redirect(base_url ());
		}
	}
	
	public function History() {				
		$id=$_SESSION['olouserid'];
		if(!empty($id)){
			$this->load->library ( 'zyk/UserLib' );				
			$order = $this->userlib->getOrder($id);				
			$this->template->set('orders',$order);
			$this->template->set ( 'description', '' );
			$this->template->set_layout (false);
			$this->template->set_layout ('default')
			->title ( 'Garage2Ghar' )
			->set_partial ( 'header', 'partials/header' )
			->set_partial ( 'footer', 'partials/footer' );
			$this->template->build ('Order/history');
		}else{
			redirect(base_url ());
		}
	}
	
	public function Wallet() {
	    $userid = $_SESSION['olouserid'];
	    $this->load->library ( 'zyk/UserLib' );
	    if(!empty($userid)){
		    $balance = $this->userlib->getWalletBalance($userid);
		    $wallet_history =  $this->userlib->getWalletTransactions($userid);
		    	if(!empty($balance)){
		    		$balance = $balance;
		    	}else{
		    		$balance[0]['amount'] = 0;
		    	}
		    	/* if(!empty($wallet_history)){
		    		$wallet_history = $wallet_history;
		    	}else{
		    		$wallet_history = '';
		    	} */
		    $this->template->set('balance',$balance);
		    $this->template->set('wallet_history',$wallet_history);
		    $this->template->set ( 'description', '' );
		    $this->template->set_layout (false);
		    $this->template->set_layout ('default')
		    ->title ( 'Garage2Ghar' )
		    ->set_partial ( 'header', 'partials/header' )
		    ->set_partial ( 'footer', 'partials/footer' );
		    $this->template->build ('Order/wallets');
	    }else{
	    	redirect(base_url ());
	    }
	}
	
	public function Setting() {
		$id=$_SESSION['olouserid'];
		if(!empty($id)){
			//$this->template->set ( 'page', 'home' );
			//$this->template->set_theme('default_theme');
			$this->load->library ( 'zyk/UserLib' );
			$user = $this->userlib->getUser($id);
			$user1 = $this->userlib->getUser1($id);
			$this->template->set('user',$user);
			$this->template->set('user1',$user1);
			$this->template->set ( 'description', '' );
			$this->template->set_layout (false);
			$this->template->set_layout ('default')
			->title ( 'Garage2Ghar' )
			->set_partial ( 'header', 'partials/header' )
			->set_partial ( 'footer', 'partials/footer' );
			$this->template->build ('Order/settings');
		}else{
			redirect(base_url ());
		}
	}
	
	public function Offer() {
 		$id=$_SESSION['olouserid'];
 		if(!empty($id)){
	 		$this->load->library ( 'zyk/UserLib' );
 			$refcode = $this->userlib->getReferCode($id);
	 		$this->template->set('refcode',$refcode);
			$this->template->set ( 'description', '' );
			$this->template->set_theme('default_theme');
			$this->template->set_layout ('default')
			->title ( 'Garage2Ghar' )
			->set_partial ( 'header', 'partials/header' )
			->set_partial ( 'footer', 'partials/footer' );
			$this->template->build ('Order/offer');
		}else{
			redirect(base_url ());
		}
	}
	
	public function Userupdate()
	{
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('fname').' '. $this->input->post('lname');
		$params['email'] = $this->input->post('email');
		$params['mobile'] = $this->input->post('mobile');
		$params['original'] = $this->input->post('password');
		$params['password'] = md5($this->input->post('password'));
		//$params['address'] = $this->input->post('address');
		$params['model'] = $this->input->post('model');
		$params['vehicle_no'] = $this->input->post('vehicleno');
		
		$params1 = array();
		$params1['id'] = $this->input->post('id');
		$params1['model'] = $this->input->post('model1');
		$params1['vehicle_no'] = $this->input->post('vehicleno1');
		$this->load->library ( 'zyk/UserLib' );
		$register = $this->userlib->updateUser1( $params );
		$register1 = $this->userlib->updateUser2( $params1 );
		$response['status'] = 1;
		$response['msg'] = "User updated successfully.";
		echo json_encode($response);
	}
	
	/*public function booking() { 


		


 		$this->load->library('zyk/ServiceLib', 'servicelib');
		$brandList = $this->servicelib->getBrandId('9'); 
		$_SESSION['category_id'] = '9'; 
		$this->template->set('brandList',$brandList);  
  	    $this->template->set ( 'page', 'booking-flow/select-brand' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
 		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
 		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/booking');
		
	}*/



	public function selectBrand() {   
  		$this->load->library('zyk/ServiceLib', 'servicelib');
		$brandList = $this->servicelib->getBrandId('9'); 
   		$_SESSION['category_id'] = '9'; 
    		/*$this->session->unset_userdata('brand_id'); 
   		$this->session->unset_userdata('model_id'); 
   		$this->session->unset_userdata('subcategory_id');
   		$this->session->unset_userdata('catsubcat_id'); 
   		exit();*/


   		//print_r($this->session->userdata());
    		//$this->session->unset_userdata('category_id'); 
 
		$this->template->set('brandList',$brandList);  
  	    $this->template->set ( 'page', 'booking-flow/select-brand' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
 		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
 		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/booking');
		
	}

	public function selectModel() {
		/*$this->session->unset_userdata('model_id'); 
   		$this->session->unset_userdata('subcategory_id');
   		$this->session->unset_userdata('catsubcat_id');*/

  		$this->load->library('zyk/ServiceLib', 'servicelib'); 
		//save brand into session
 	 	echo $data['brand_id']    = $this->session->userdata('brand_id');
	 	$modelList = $this->servicelib->getModelbyBrandId1($data['brand_id']);  

	 	$this->template->set ('modelList',$modelList);
 	    $this->template->set ( 'page', 'booking-flow/select-modal' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
		//->meta ( 'doctors' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/select-modal');
		
	}

	public function selectSubcategory() {
		/*$this->session->unset_userdata('subcategory_id');
   		$this->session->unset_userdata('catsubcat_id');*/

  		$this->load->library('zyk/ServiceLib', 'servicelib'); 
		//get subcategory list
		  //$model_id = $_SESSION['model_id'];

		$subcategoryList = $this->servicelib->getActiveSubcategory(); 
  		$this->template->set('subcategoryList',$subcategoryList);
	    $this->template->set ( 'page', 'booking-flow/select-subcategory' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
 		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
 		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/select-subcategory'); 
	}

	public function selectServices() { 
		 

		$this->load->library('zyk/ServiceLib', 'servicelib'); 
		//get subcategory list   
		$data['sub_id'] = $_SESSION['subcategory_id']; 
		$data['brand_id'] = $_SESSION['brand_id']; 
		$data['model_id'] = $_SESSION['model_id']; 
		$data['category_id'] = $_SESSION['category_id'];  
	//get main subcategory id from subcategory table 
 		$subcategory_id = $this->servicelib->getSubcatId_new($data); 
 		$catsubcatList = array(); 
 
 		if(isset($subcategory_id)){
 			$catsubcatList = $this->servicelib->getCatsubcatid1($subcategory_id);  
 		}
  		$this->template->set( 'catsubcatList',$catsubcatList);
	    $this->template->set( 'page', 'booking-flow/select-part');
		$this->template->set( 'description', '' );
		$this->template->set( 'keywords', '' );
		$this->template->set_theme('default_theme');
 		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
 		->set_partial ( 'header', 'partials/header' )
 				->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/select-catsubcat'); 
	}

	public function selectPackage() {  
		$this->load->library('zyk/ServiceLib', 'servicelib'); 
		//get subcategory list   
		$data['sub_id'] = $_SESSION['subcategory_id']; 
		$data['brand_id'] = $_SESSION['brand_id']; 
		$data['model_id'] = $_SESSION['model_id']; 
		$data['category_id'] = $_SESSION['category_id'];  
	//get main subcategory id from subcategory table 
		$packageList = array();
 	//	$packageList = $this->servicelib->getPackageByModelId($data);  
  		$this->template->set( 'packageList',$packageList);
	    $this->template->set( 'page', 'booking-flow/select-package');
		$this->template->set( 'description', '' );
		$this->template->set( 'keywords', '' );
		$this->template->set_theme('default_theme');
 		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
 		->set_partial ( 'header', 'partials/header' )
 				->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/select-package'); 
	}


	
	public function selectAdd() {
		 
		 $userdata['name'] = $this->session->userdata('olousername');
		 $userdata['email'] = $this->session->userdata('olouseremail');
		 $userdata['mobile'] = $this->session->userdata('olousermobile');

 		$this->template->set('userdata',$userdata);
	    $this->template->set ( 'page', 'booking-flow/select-address' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
		//->meta ( 'doctors' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/select-address');
		
	}

	public function setBrand(){ 
 		$this->session->set_userdata('brand_id',$this->input->post('brand_id'));
		$response = array('msg'=>'Brand added in session','status'=>1);
		echo json_encode($response); 
 	}

	public function setModel(){ 
 		$this->session->set_userdata('model_id',$this->input->post('model_id')); 
		$response = array('msg'=>'Model added in session','status'=>1);
		echo json_encode($response); 
 	}

 	public function setSub(){ 
 		$this->session->set_userdata('subcategory_id',$this->input->post('subcategory_id')); 
		$response = array('msg'=>'Subcategory added in session','status'=>1);
		echo json_encode($response); 
 	}
 	public function setCatsubcat(){  
 		$this->session->set_userdata('catsubcat_id', $this->input->post('catsubcat_id')); 
		$response = array('msg'=>'Catsubcat added in session','status'=>1);
		echo json_encode($response); 
 	}
 	public function setData(){   
 		$this->session->set_userdata('name', $this->input->post('name'));
 		$this->session->set_userdata('email', $this->input->post('email')); 
 		$this->session->set_userdata('mobile', $this->input->post('mobile')); 
 		$this->session->set_userdata('visit_date', $this->input->post('visit_date')); 
 		$this->session->set_userdata('visit_time', $this->input->post('visit_time')); 
 		$this->session->set_userdata('flat', $this->input->post('flat')); 
 		$this->session->set_userdata('landmark', $this->input->post('landmark'));  
		$response = array('msg'=>'Data added in session','status'=>1);
		echo json_encode($response);   
 	} 

	public function bookingSummary() {
		  $subcategory_id = $_SESSION['subcategory_id']; 
		$subcategory = $this->db->select('name')->from('static_subcategory')->where('id',$subcategory_id)->get()->result_array();


 
 		$this->template->set('service_type',$subcategory[0]['name']);
	    $this->template->set ( 'page', 'booking-flow/Booking-summary' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
		//->meta ( 'doctors' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/Booking-summary');
		
	}

	public function thankyou() {
	    $this->template->set ( 'page', 'booking-flow/thank-you' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
		//->meta ( 'doctors' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/thank-you');
		
	}

	public function bookingFail() {
	    $this->template->set ( 'page', 'booking-flow/Booking-failed' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
		//->meta ( 'doctors' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/Booking-failed');
		
	}

}